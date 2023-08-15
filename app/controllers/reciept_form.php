<?php
class Reciept_form extends Controller
{
    public function index()
    {
        $data['page_title'] = "Receipt Form";

        if (!isset($_SESSION['user'])){
			echo "<script>
            location=('http://localhost/membership/public/login');
            </script>";
                
		}
		
        $user = $this->loadModel("user");

    	// Get all members from the model
        $notices = $user->getAllNotices();

		$data['notices'] = $notices;

        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['member_id']) && isset($_GET['fee_id']) && isset($_GET['amount_paid'])) {
            // The GET request is from the form
            $memberId = $_GET['member_id'];
            $feeId = $_GET['fee_id'];
            $amountPaid = $_GET['amount_paid'];

            // Call a function to retrieve the invoice number
            $invoiceNo = $this->getInvoiceNumber($memberId);

            $receiptNo = $this->generateReceiptNumber($invoiceNo);

            $sessionCode = $this->getSessionCode($invoiceNo);

            $receiptNo = $this->saveNewReceipt($receiptNo,$invoiceNo,$memberId,$sessionCode);

            $this->saveReceiptDetails($amountPaid,$receiptNo);

            
        }

        // Get the member ID from the $_GET request
        $memberId = $_GET['member_id'];

        // Get the member from the database
        $member = $this->getMember($memberId);

        if (!$member) {
            // Member not found, handle the error
            echo "Member not found";
            return;
        }

        // Get the applicable fees for the member
        $fees = $this->getApplicableFees($member->class_id);

        $data['member'] = $member;
        $data['fees'] = $fees;

        $this->view("reciept_form", $data);
    }

    private function generateReceiptNumber($invoiceNo)
    {
        $db = new Database();

        // Check if there is a receipt with the same invoice number
        $query = "SELECT receipt_no FROM receipts WHERE invoice_no = :invoiceNo";
        $params = array(':invoiceNo' => $invoiceNo);
        $existingReceipts = $db->read($query, $params);

        if ($existingReceipts && !empty($existingReceipts)) {
            // Retrieve the receipt number of the receipt that has an invoice number that matches the given invoice number
            $existingReceiptNo = $existingReceipts[0]->receipt_no;

            return $existingReceiptNo;
        } else {
            return uniqid(); // Generate a unique receipt number
        }
    }
    
    private function saveReceiptDetails($amountPaid, $receiptNo)
    {
        $db = new Database();

        // Insert a new receipt details entry
        $query = "INSERT INTO receipt_details (amount_paid, receipt_id) VALUES (:amountPaid, :receiptNo)";
        $params = array(':amountPaid' => $amountPaid, ':receiptNo' => $receiptNo);
        $db->write($query, $params);
    }


    private function saveNewReceipt($receiptNo, $invoiceNo, $memberId, $sessionCode)
    {
        $db = new Database();

        // Check if the database already contains a receipt with the same receipt number
        $query = "SELECT receipt_no FROM receipts WHERE receipt_no = :receiptNo";
        $params = array(':receiptNo' => $receiptNo);
        $existingReceipts = $db->read($query, $params);

        if ($existingReceipts && !empty($existingReceipts)) {
            // A receipt with the same receipt number already exists, return without saving
            return $existingReceipts[0]->receipt_no;
        }

        // No existing receipt found, add a new one
        $query = "INSERT INTO receipts (receipt_no, member_id, invoice_no, date_created, session_code) VALUES (:receiptNo, :memberId, :invoiceNo, NOW(), :sessionCode)";
        $params = array(
            ':receiptNo' => $receiptNo,
            ':memberId' => $memberId,
            ':invoiceNo' => $invoiceNo,
            ':sessionCode' => $sessionCode
        );
        $db->write($query, $params);

        return $receiptNo;

    }

    private function getInvoiceNumber($memberId)
    {
        $db = new Database();

        // Query the database to retrieve the invoice number
        $query = "SELECT invoice_no FROM invoices WHERE member_id = :memberId";
        $params = array(':memberId' => $memberId);
        $result = $db->read($query, $params);

        if ($result && !empty($result)) {
            return $result[0]->invoice_no; // Return the invoice number
        } else {
            return null; // Return null if no invoice number found
        }
    }

    private function getSessionCode($invoiceNo)
    {
        $db = new Database();

        // Query the database to retrieve the session code
        $query = "SELECT session_code FROM invoices WHERE invoice_no = :invoiceNo";
        $params = array(':invoiceNo' => $invoiceNo);
        $result = $db->read($query, $params);

        if ($result && !empty($result)) {
            return $result[0]->session_code; // Return the session code
        } else {
            return null; // Return null if no session code found
        }
    }


    private function getMember($memberId)
    {
        $db = new Database();

        // Query to retrieve the member from the database
        $query = "SELECT * FROM members WHERE id_number = :memberId";
        $params = array(':memberId' => $memberId);
        $result = $db->read($query, $params);

        if ($result && !empty($result)) {
            return $result[0]; // Return the first row as the member object
        } else {
            return null; // Return null if no member found
        }
    }

    private function getApplicableFees($classId)
    {
        $db = new Database();

        // Query to retrieve the applicable fees for the class
        $query = "SELECT fl.* 
                  FROM grouped_fees gf
                  INNER JOIN fees_list fl ON gf.fee_id = fl.fee_id
                  WHERE gf.class_id = :classId";
        $params = array(':classId' => $classId);
        $result = $db->read($query, $params);

        if ($result && !empty($result)) {
            return $result; // Return the array of applicable fees
        } else {
            return array(); // Return an empty array if no applicable fees found
        }
    }
}
