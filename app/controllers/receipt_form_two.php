<?php
class Receipt_form_two extends Controller
{
    public function index()
    {
        $data['page_title'] = "Receipts";

        if (!isset($_SESSION['user'])){
			echo "<script>
            location=('http://localhost/membership/public/login');
            </script>";
                
		}
		
        $user = $this->loadModel("user");

    	// Get all members from the model
        $notices = $user->getAllNotices();

		$data['notices'] = $notices;
        

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['fee_str']) && isset($_POST['member_id'])){

            $feesArray = explode(',',$_POST['fee_str']);

            $membId = $_POST['member_id'];
            var_dump($_POST);

            

            //Call a function to retrieve the invoice number
            $invoiceNo = $this->getInvoiceNumber($membId);

            $receiptNo = $this->generateReceiptNumber($invoiceNo);

            $sessionCode = $this->getSessionCode($invoiceNo);

            $receiptNo = $this->saveNewReceipt($receiptNo,$invoiceNo,$membId,$sessionCode,$_SESSION['user']->id_number);

            $this->saveReceiptDetails($receiptNo,$feesArray);

             // Redirect back to the add_fees page or any other appropriate page
             header('Location: http://localhost/membership/public/reciepts');
             exit;

        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['selector'])) {

            $arr = $_POST['selector'];
            $n = count($arr);

            $memberId= -1;
            $feeIds = array();

            for ($i=0; $i < $n; $i++){
            $actualArray = explode(',',$arr[$i]);

            $feeIds[] = $actualArray[0];
            $memberId= $actualArray[1];

            }

            $fees = $this->getFeesByIds($feeIds);

            // Get the member from the database
            $member = $this->getMember($memberId);

            if (!$member) {
                // Member not found, handle the error
                echo "Member not found";
                return;
            }


            $data['member'] = $member;
            $data['fees'] = $fees;
        }

        $this->view("Receipt_form_two", $data);
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

    private function getFeesByIds($feeIds)
    {
        // Create an instance of the Database class
        $DB = new Database();

        // Prepare the placeholder for the fee IDs in the SQL query
        $placeholders = implode(',', array_fill(0, count($feeIds), '?'));

        // Query to retrieve the fees by their IDs
        $query = "SELECT * FROM fees_list WHERE fee_id IN ($placeholders)";
        $params = $feeIds;

        // Execute the query with parameters
        $result = $DB->read($query, $params);

        // Check if fees are found
        if ($result && !empty($result)) {
            return $result; // Return the array of fee objects
        } else {
            return array(); // Return an empty array if no fees found
        }
    }

    private function generateReceiptNumber($invoiceNo)
    {
        // $db = new Database();

        // // Check if there is a receipt with the same invoice number
        // $query = "SELECT receipt_no FROM receipts WHERE invoice_no = :invoiceNo";
        // $params = array(':invoiceNo' => $invoiceNo);
        // $existingReceipts = $db->read($query, $params);

        // if ($existingReceipts && !empty($existingReceipts)) {
        //     // Retrieve the receipt number of the receipt that has an invoice number that matches the given invoice number
        //     $existingReceiptNo = $existingReceipts[0]->receipt_no;

        //     return $existingReceiptNo;
        // } else {
            return uniqid(); // Generate a unique receipt number
        // }
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

    private function saveReceiptDetails($receiptNo,$feesArray)
    {
        $db = new Database();

        foreach ($feesArray as $feeName) {

            $amt = $_POST[$feeName];

            // Insert a new receipt details entry
            $query = "INSERT INTO receipt_details (amount_paid, receipt_id, fee_id) VALUES (:amt, :receiptNo, :fee_id)";
            $params = array(':amt' => $amt, ':receiptNo' => $receiptNo, 'fee_id' => $feeName);
            $db->write($query, $params);
        }
    }

    private function saveNewReceipt($receiptNo, $invoiceNo, $memberId, $sessionCode,$company_id)
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
        $query = "INSERT INTO receipts (receipt_no, member_id, invoice_no, date_created, session_code,company_id) VALUES (:receiptNo, :memberId, :invoiceNo, NOW(), :sessionCode,:company_id)";
        $params = array(
            ':receiptNo' => $receiptNo,
            ':memberId' => $memberId,
            ':invoiceNo' => $invoiceNo,
            ':sessionCode' => $sessionCode,
            ':company_id' => $company_id
        );
        $db->write($query, $params);

        return $receiptNo;

    }

}