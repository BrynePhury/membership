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

        $this->SetTitle('Receipt');

        $this->AddPage();

        // Add your image at the top
        $imagePath = $company->company_logo;
        $this->Image($imagePath, 10, 10, 20);

        // Set font
        $this->SetFont('Arial', 'B', 12);

        // "Invoice Number" section
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 10, 'Receipt Number:', 0, 1, 'C');
        $this->SetFont('Arial', '', 12);
        $this->Cell(0, 10, 'Receipt ID: ' . $data['receipt_number'], 0, 1, 'C');

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
        $this->Output($member->fname . '_' . $member->lname .'_receipt'.  '.pdf', 'D');

    }

}

class View_receipt extends Controller
{
    public function index()
    {
        $data['page_title'] = "View Receipt";

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
        $receiptNo = $_GET['receipt'];

        $data['receipt_number'] = $receiptNo;

        // Create a new instance of the Database class
        $DB = new Database();

        // Get the invoice details
        $query = "SELECT r.*, cd.*
                FROM receipts r
                JOIN company_details cd ON r.company_id = cd.admin_id
                WHERE r.receipt_no = :receiptNo";
        
            $params = array(':receiptNo' => $receiptNo);
            $receipt = $DB->read($query, $params);


        if (!$receipt) {
            // Handle the case when the invoice is not found
            echo "Invoice not found.";
            return;
        }

        $data['receipt'] = $receipt[0];

        // Get the member details
        $memberId = $receipt[0]->member_id;
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
        $sessionCode = $receipt[0]->session_code;
        $query = "SELECT * FROM m_sessions WHERE session_code = :session_code";
        $params = array(':session_code' => $sessionCode);
        $session = $DB->read($query, $params);

        if (!$session) {
            // Handle the case when the session is not found
            echo "Session not found.";
            return;
        }

        $data['session'] = $session[0];

        // Query the database to retrieve the fees for the specified class ID
        $query = "SELECT rd.*, fl.*
            FROM receipt_details rd
            JOIN fees_list fl ON fl.fee_id = rd.fee_id
            WHERE rd.receipt_id = :receipt_id
            ORDER BY fl.fee_description";
            $params = array(':receipt_id' => $receiptNo); // Replace $receiptId with the actual receipt ID you want to filter by
            $receiptDetails = $DB->read($query, $params);

        foreach ($receiptDetails as $receiptDetail) {
            $fees[] = $receiptDetail;

        }
           
        $data['fees'] = $fees;
        $totalAmount = $this->calculateTotalAmount($fees);
        $data['totalAmount'] = $totalAmount;   
        
        if (isset($_GET['download']) && $_GET['download']) {

            $company = $this->getCompanyByUserId($_SESSION['user']->id_number);
            $data['company'] = $company;

            $this->generateReceipt($data);
        }

        $this->view("view_receipt", $data);
    }

    private function generateReceipt($data) {

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
            $totalAmount += $fee->amount_paid;
        }
        
        return $totalAmount;
    }

    private function getReceipt($receiptNo){
        // Create a new instance of the Database class
        $DB = new Database();

        // Get the invoice details
        $query = "SELECT * FROM receipts WHERE receipt_no = :receiptNo";
        $params = array(':receiptNo' => $receiptNo);
        $receipts = $DB->read($query, $params);

        return $receipts[0];
    }
}