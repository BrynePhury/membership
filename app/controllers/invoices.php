<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/phpmailer/src/Exception.php';
require __DIR__ . '/phpmailer/src/PHPMailer.php';
require __DIR__ . '/phpmailer/src/SMTP.php';

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
        $this->Output('invoice.pdf', 'D');

        // Generate a unique file name
        $filename = 'invoice_' . uniqid() . '.pdf';

        // Save the PDF to a temporary directory
        $pdfPath = __DIR__ . '/tmp/' . $filename;
        $this->Output($pdfPath, 'F');

        return $pdfPath;

    }

}


class Invoices extends Controller
{
    public function index()
    {
        $data['page_title'] = "Invoices";

        if (!isset($_SESSION['user'])){
			echo "<script>
            location=('http://localhost/membership/public/login');
            </script>";
                
		}
		
        $user = $this->loadModel("user");

    	// Get all members from the model
        $notices = $user->getAllNotices();

		$data['notices'] = $notices;

        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['members'])) {
            // Get the class ID and members from the URL parameters


            $members = $_GET['members'];

            // Process and generate the invoices
            $this->generateInvoices($members);

            

            // Redirect back to the invoices page or any other appropriate page
            // header('Location: http://localhost/membership/public/invoices');
            // exit;
            
        }

        
        $invoices = $this->loadInvoices();
        $data['is_user'] = false;

        $membersArr = array();
        $sessionsArr = array();

        if (is_array($invoices)) {
            $DB = new Database();

            foreach ($invoices as $invoice) {
                $id_number = $invoice->member_id;

                $query = "SELECT * FROM members WHERE id_number = :id_number LIMIT 1";
                $params = array(':id_number' => $id_number);
                $member = $DB->read($query, $params);

                if ($member) {
                    $membersArr[] = $member[0];
                }

                $session_code = $invoice->session_code;

                $query = "SELECT * FROM m_sessions WHERE session_code = :session_code LIMIT 1";
                $params = array(':session_code' => $session_code);
                $session = $DB->read($query, $params);

                if ($session) {
                    $sessionsArr[] = $session[0];
                }
            }
        }

        // Get all members from the model
        $data['members'] = $this->getAcceptedRequests($user->getAllMembers());

        $data['invoices'] = $invoices;
        $data['invoice_members'] = $membersArr;
        $data['invoice_sessions'] = $sessionsArr;

        $this->view("invoices", $data);
    }

    private function getAcceptedRequests($members) {
		$req = array();
		foreach ($members as $member) {
			if ($member->m_status === 'accepted') {
				$req[] = $member;
			}
		}
		return $req;
	}


    public function generateInvoices($members){

        
        
		if (is_array($members) && !empty($members)) {
			// Create a new instance of the Database class
			$DB = new Database();
            
			try {
				foreach ($members as $memberId) {
					// Get the member's class ID
					$query = "SELECT * FROM members WHERE id_number = :member_id";
					$params = array(':member_id' => $memberId);
					$result = $DB->read($query, $params);   
                    
					if ($result) {
                        $memb = $result[0];
						$classId = $memb->class_id;

						// Get the grouped fees for the member's class
						$groupedFees = $this->getGroupedFees($classId);

						$invoiceNo = $this->generateInvoiceNumber();

                        $m_status = "Open";

                        $open_session = $this->getOpenSessionId($m_status);

						// Insert into invoices table
						$this->insertInvoice($invoiceNo, $memberId,$open_session,$_SESSION['user']->id_number);

						if ($groupedFees) {
							foreach ($groupedFees as $groupedFee) {
								$feeId = $groupedFee->fee_id;

								// Get the fee details from fees_list
								$feeDetails = $this->getFeeDetails($feeId);

								if ($feeDetails) {
									$feeDescription = $feeDetails[0]->fee_description;
									$amount = $feeDetails[0]->amount;

									// Insert into invoice_details table
									$this->insertInvoiceDetails($invoiceNo, $feeId, '', $amount);
								}
							}
						}

                        // $attachment = $this->generateInvoiceAttachment($invoiceNo);

                        $this->sendEmail($memb->email,"INVOICE GENERATION", "Your invoice has been generated, check attached document.\r\n Click the link to view. \r\n http://localhost/membership_members/public/view_invoice?invoice=" . $invoiceNo,"");

					}
				}

			
			} catch (PDOException $e) {
				echo "Error generating invoices: " . $e->getMessage();
			}
		}
	}

    private function generateInvoiceAttachment($invoiceNo) {
        $data = $this->getInvoiceAttachmentData($invoiceNo);

        $pdf = new PDFInvoice();

        // Generate the invoice and get the PDF file path
        $pdfFilePath = $pdf->generateInvoice($data);

        return $pdfFilePath;
    }


    private function getInvoiceAttachmentData($invoiceNo) {
        $data['invoice_number'] = $invoiceNo;
        
        $DB = new Database();
        
        // Get invoice details
        $invoice = $this->fetchData($DB, "SELECT * FROM invoices WHERE invoice_no = :invoice_no", [':invoice_no' => $invoiceNo]);
        $data['invoice'] = $invoice[0] ?? null;
    
        // Get member details
        $memberId = $data['invoice']->member_id ?? null;
        $member = $this->fetchData($DB, "SELECT * FROM members WHERE id_number = :id_number", [':id_number' => $memberId]);
        $data['member'] = $member[0] ?? null;
    
        // Get session details
        $sessionCode = $data['invoice']->session_code ?? null;
        $session = $this->fetchData($DB, "SELECT * FROM m_sessions WHERE session_code = :session_code", [':session_code' => $sessionCode]);
        $data['session'] = $session[0] ?? null;
    
        // Get grouped fees for member's class
        $classId = $data['member']->class_id ?? null;
        $groupedFees = $this->fetchData($DB, "SELECT fee_id FROM grouped_fees WHERE class_id = :class_id", [':class_id' => $classId]);
        
        $fees = [];
        if ($groupedFees) {
            foreach ($groupedFees as $groupedFee) {
                $feeId = $groupedFee->fee_id;
                $feeDetails = $this->fetchData($DB, "SELECT * FROM fees_list WHERE fee_id = :fee_id", [':fee_id' => $feeId]);
                if ($feeDetails) {
                    $fees[] = $feeDetails[0];
                }
            }
        }
        $data['fees'] = $fees;
        $data['totalAmount'] = $this->calculateTotalAmount($fees);
        
        // Get invoice details
        $invoiceDetails = $this->fetchData($DB, "SELECT * FROM invoice_details WHERE invoice_no = :invoice_no", [':invoice_no' => $invoiceNo]);
        $data['invoiceDetails'] = $invoiceDetails;

        $company = $this->getCompanyByUserId($_SESSION['user']->id_number);
        $data['company'] = $company;
        
        // Return the data
        return $data;
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

    private function fetchData($db, $query, $params = []) {
        return $db->read($query, $params);
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

    private function sendEmail($address,$subject,$message,$attachmentPath){
        
        try {
            $mail = new PHPMailer(true);

            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'brynephury@gmail.com';
            $mail->Password = 'poccngsbvtmmnxkr';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            $mail->setFrom('brynephury@gmail.com');

            $mail->addAddress($address);

            $mail->isHTML(true);

            $mail->Subject = $subject;
            $mail->Body = $message;

            if ($attachmentPath != ''){
            // Add attachment
            $mail->addAttachment($attachmentPath); 
            }
            $mail->send();

            // echo "<script>
            // alert('Sent Successfully')
            // </script>";
        } catch (Exception $e) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        }

    }

    private function getGroupedFees($classId)
    {
        $DB = new Database();
        $query = "SELECT * FROM grouped_fees WHERE class_id = :class_id";
        $params = array(':class_id' => $classId);
        return $DB->read($query, $params);
    }

    private function getOpenSessionId($m_status)
    {

        $DB = new Database();
        $query = "SELECT * FROM m_sessions WHERE m_status = :m_status";
        $params = array(':m_status' => $m_status);
        $sess = $DB->read($query, $params);

        return $sess[0]->session_code;
    }

    private function getFeeDetails($feeId)
    {
        $DB = new Database();
        $query = "SELECT * FROM fees_list WHERE fee_id = :fee_id";
        $params = array(':fee_id' => $feeId);
        return $DB->read($query, $params);
    }

    private function insertInvoice($invoiceNo,$memberId,$session_code,$company_id)
	{
		$DB = new Database();
		$query = "INSERT INTO invoices (invoice_no,member_id,session_code,company_id) VALUES (:invoice_no, :member_id, :session_code,:company_id)";
		$params = array(':invoice_no' => $invoiceNo,':member_id' => $memberId, ':session_code' => $session_code , ':company_id' =>$company_id);
		$DB->write($query, $params);
	}


    private function insertInvoiceDetails($invoiceNo, $feeId, $period, $amount)
    {
        $DB = new Database();
        $query = "INSERT INTO invoice_details (invoice_no, fee_id, period, amount) VALUES (:invoice_no, :fee_id, :period, :amount)";
        $params = array(
            ':invoice_no' => $invoiceNo,
            ':fee_id' => $feeId,
            ':period' => $period,
            ':amount' => $amount
        );
        $DB->write($query, $params);
    }

    public function loadInvoices()
    {
        $DB = new Database();
        $query = "SELECT * FROM invoices";
        return $DB->read($query);
    }
    public function loadInvoice($member_id)
        {
            $DB = new Database();
            $query = "SELECT * FROM invoices where member_id = :member_id";
            $params = array(':member_id' => $member_id);
            return $DB->read($query,$params);
        }

    private function generateInvoiceNumber()
    {
        // Replace this placeholder implementation with your actual code to generate a unique invoice number
        return uniqid(); // Example: using uniqid() function to generate a unique ID
    }
}
