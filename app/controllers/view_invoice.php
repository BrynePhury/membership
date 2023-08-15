<?php

require __DIR__ . '/fpdf186/fpdf.php';

class PDFInvoice extends FPDF {
    function Header() {
        // Header content goes here (if needed)
    }

    function Footer() {
        // Footer content goes here (if needed)
    }

    function generateInvoice($data) {
        $member = $data['member'];
        $company = $data['company'];

        $this->SetTitle('Invoice');

        $this->AddPage();

        // Add your image at the top
        $imagePath = $company->company_logo;
        $this->Image($imagePath, 10, 10, 20);

        // Set font
        $this->SetFont('Arial', 'B', 12);

        // Badge
        $this->SetTextColor(255, 0, 0);
        $this->Cell(0, 10, 'OVERDUE', 0, 1, 'C');
        $this->SetTextColor(0, 0, 0);

        // "Invoice Number" section
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 10, 'Invoice Number:', 0, 1, 'C');
        $this->SetFont('Arial', '', 12);
        $this->Cell(0, 10, 'Invoice ID: ' . $data['invoiceDetails'][0]->invoice_No, 0, 1, 'C');

        // From
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 10, 'FROM', 0, 1, 'L');

        $this->SetFont('Arial', '', 12);
        $this->Cell(0, 10, $company->company_name, 0, 1, 'L');
        $this->Cell(0, 10, 'Mobile: +26' . $company->company_phone, 0, 1, 'L');
        $this->Cell(0, 10, 'Email: ' . $company->company_email, 0, 1, 'L');

        // "TO (Member)" section
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 10, 'TO (Member)', 0, 1, 'R');

        $this->SetFont('Arial', '', 12);
        $this->Cell(0, 10, $member->fname . ' ' . $member->lname, 0, 1, 'R');
        $this->Cell(0, 10, 'Mobile: +26' . $member->contact1, 0, 1, 'R');
        $this->Cell(0, 10, 'Email: ' . $member->email, 0, 1, 'R');

        // Table headers
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(60, 10, 'Description', 1);
        $this->Cell(60, 10, 'Session', 1);
        $this->Cell(70, 10, 'Cost', 1);
        $this->Ln();

        // Table rows
        $this->SetFont('Arial', '', 12);
        foreach ($data['fees'] as $fee) {
            $this->Cell(60, 10, $fee->fee_description, 1);
            $this->Cell(60, 10, $data['session']->session_name, 1);
            $this->Cell(70, 10, 'K' . number_format($fee->amount, 2), 1);
            $this->Ln();
        }

        // Total amount due
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(120, 10, 'Total amount due', 1, 0, 'R');
        $this->Cell(70, 10, 'K' . number_format($data['totalAmount'], 2), 1);

        // Notes
        $this->Ln();
        $this->SetFont('Arial', '', 12);
        $this->MultiCell(0, 10, "Notes\nWe appreciate your business. Should you need us to add VAT or extra notes let us know!", 1);

        // Output the PDF
        $this->Output($member->fname . '_' . $member->lname .'_invoice'.  '.pdf', 'D');

    }

}

class View_invoice extends Controller
{
    public function index()
    {
        $data['page_title'] = "View Invoice";

        if (!isset($_SESSION['user'])){
			echo "<script>
            location=('http://localhost/membership/public/login');
            </script>";
                
		}
        
		
        $user = $this->loadModel("user");

    	// Get all members from the model
        $notices = $user->getAllNotices();

		$data['notices'] = $notices;

        // Get the invoice number from the $_GET global
        $invoiceNo = $_GET['invoice'];

        $data['invoice_number'] = $invoiceNo;

        // Create a new instance of the Database class
        $DB = new Database();

        // Get the invoice details
        $query = "SELECT i.*, c.*
                FROM invoices i
                JOIN company_details c ON i.company_id = c.admin_id
                WHERE i.invoice_no = :invoice_no";
        $params = array(':invoice_no' => $invoiceNo);
        $invoice = $DB->read($query, $params);

        if (!$invoice) {
            // Handle the case when the invoice is not found
            echo "Invoice not found.";
            return;
        }

        $data['invoice'] = $invoice[0];

        // Get the member details
        $memberId = $invoice[0]->member_id;
        $query = "SELECT * FROM members WHERE id_number = :id_number";
        $params = array(':id_number' => $memberId);
        $member = $DB->read($query, $params);

        if (!$member) {
            // Handle the case when the member is not found
            echo "Member not found.";
            return;
        }

        $data['member'] = $member[0];

        // Get the session details
        $sessionCode = $invoice[0]->session_code;
        $query = "SELECT * FROM m_sessions WHERE session_code = :session_code";
        $params = array(':session_code' => $sessionCode);
        $session = $DB->read($query, $params);

        if (!$session) {
            // Handle the case when the session is not found
            echo "Session not found.";
            return;
        }

        $data['session'] = $session[0];

        // Get the grouped fees for the member's class
        $classId = $member[0]->class_id;
        $query = "SELECT fee_id FROM grouped_fees WHERE class_id = :class_id";
        $params = array(':class_id' => $classId);
        $groupedFees = $DB->read($query, $params);

        if ($groupedFees) {
            $fees = array();
            foreach ($groupedFees as $groupedFee) {
                $feeId = $groupedFee->fee_id;

                // Get the fee details from fees_list
                $query = "SELECT * FROM fees_list WHERE fee_id = :fee_id";
                $params = array(':fee_id' => $feeId);
                $feeDetails = $DB->read($query, $params);

                if ($feeDetails) {
                    $fees[] = $feeDetails[0];
                }
            }
            $data['fees'] = $fees;
            $totalAmount = $this->calculateTotalAmount($fees);
            $data['totalAmount'] = $totalAmount;
        } else {
            // Handle the case when there are no grouped fees available
            $data['fees'] = array();
        }

        // Get the invoice details
        $query = "SELECT * FROM invoice_details WHERE invoice_no = :invoice_no";
        $params = array(':invoice_no' => $invoiceNo);
        $invoiceDetails = $DB->read($query, $params);

        if (!$invoiceDetails) {
            // Handle the case when the invoice details are not found
            echo "Invoice details not found.";
            return;
        }

        $data['invoiceDetails'] = $invoiceDetails;

        

        if (isset($_GET['download']) && $_GET['download']) {

            $company = $this->getCompanyByUserId($_SESSION['user']->id_number);
            $data['company'] = $company;

            $this->generateInvoice($data);
        }
        

        $this->view("view_invoice", $data);
    }
    private function generateInvoice($data) {

        $pdf = new PDFInvoice();

        // Generate the invoice and get the PDF file path
        $pdfFilePath = $pdf->generateInvoice($data);

        
    }

    public function getCompanyByUserId($userId) {
        $db = new Database();

        $query = "SELECT * FROM company_details WHERE admin_id = :admin_id LIMIT 1";
        $data = [':admin_id' => $userId];
    
        $company = $db->read($query, $data);
    
        if ($company) {
            return $company[0];
        } else{
            return null;
        }

    }

    // Calculate the total amount from the fees
    private function calculateTotalAmount($fees)
    {
        $totalAmount = 0;
        
        foreach ($fees as $fee) {
            $totalAmount += $fee->amount;
        }
        
        return $totalAmount;
    }


}
