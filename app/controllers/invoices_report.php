<?php

Class Invoices_report extends Controller
{
    function index(){
        $data['page_title'] = "Invoice Report";

		if (!isset($_SESSION['user'])){
			echo "<script>
            location=('http://localhost/membership/public/login');
            </script>";
                
		}
		
        $user = $this->loadModel("user");

    	// Get all members from the model
        $notices = $user->getAllNotices();

		$data['notices'] = $notices;

        // Check if filter_date is an array with at least two elements
        if (isset($_POST['from_date']) && isset($_POST['to_date'])) {
	
			$fromDate = $this->convertDateToMySQLFormat($_POST['from_date']);
			$toDate = $this->convertDateToMySQLFormat($_POST['to_date']);

			$invoices = $this->getFilteredInvoices($fromDate,$toDate);

			$data['invoices'] = $invoices; 
        }


        $this->view("invoices_report", $data);
    }

	private function getFilteredInvoices($fromDate, $toDate) {
		$db = new Database();

		$query = 
			"SELECT 
				i.invoice_no,
				DATE_FORMAT(i.date_created, '%d %b, %Y') AS formatted_date,
				m.fname,
				m.lname,
				s.session_name
			FROM 
				invoices AS i
			JOIN
				members AS m ON i.member_id = m.id_number
			JOIN
				m_sessions AS s ON i.session_code = s.session_code
			WHERE
				i.date_created BETWEEN :fromDate AND :toDate";

		$data = array(
			':fromDate' => $fromDate,
			':toDate' => $toDate
		);

		$filteredInvoices = $db->read($query, $data);

		if ($filteredInvoices) {
			return $filteredInvoices;
		} else {
			$empty = array();
			return $empty;
		}
	}

	function convertDateToMySQLFormat($date)
	{
		// Convert the date from "d/m/Y" format to "Y-m-d" format
		$dateObj = DateTime::createFromFormat('d/m/Y', $date);
		if ($dateObj) {
			return $dateObj->format('Y-m-d');
		} else {
			return null; // Return null in case of invalid date format
		}
	}



    
    
}
