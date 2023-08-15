<?php

Class Fees_form extends Controller
{
	function index()
	{
		$data['page_title'] = "Add Fee";
        
        if (!isset($_SESSION['user'])){
			echo "<script>
            location=('http://localhost/membership/public/login');
            </script>";
                
		}
		
        $user = $this->loadModel("user");

    	// Get all members from the model
        $notices = $user->getAllNotices();

		$data['notices'] = $notices;

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_fee'])) {
            $this->handleClassForm();
        }
		
		$this->view("fees_form",$data);
	}

    public function handleClassForm()
    {
        $amount = $_POST['amount'];
        $description = $_POST['description'];

        $this->saveFeeToDatabase($amount, $description);
    }

    public function saveFeeToDatabase($amount, $description)
    {
        $db = new Database(); // Instantiate your database class

        // Prepare the SQL query
        $query = "INSERT INTO fees_list (amount, fee_description) VALUES (?, ?)";

        // Bind the parameter values
        $values = array($amount, $description);

        // Execute the query using the write() method of the Database class
        if ($db->write($query, $values)) {
            // Data inserted successfully
            echo "<script>alert('Class Added');
                location=('http://localhost/membership/public/fees');
                </script>";
        } else {
            // Error occurred while inserting data
            echo "<script>alert('Some Error Occured');
                location=('http://localhost/membership/public/fees_form');
                </script>";
        }
    }

}

