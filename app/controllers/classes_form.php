<?php

Class Classes_form extends Controller
{
	function index(){

		$data['page_title'] = "Classes Form";

        if (!isset($_SESSION['user'])){
			echo "<script>
            location=('http://localhost/membership/public/login');
            </script>";
                
		}
		
        $user = $this->loadModel("user");

    	// Get all members from the model
        $notices = $user->getAllNotices();

		$data['notices'] = $notices;

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_class'])) {
            $this->handleClassForm();
        }

		$this->view("classes_form",$data);
	}

    public function handleClassForm()
    {
        $className = $_POST['class_name'];
        $experienceRequired = $_POST['experience_required'];

        $this->saveClassToDatabase($className, $experienceRequired);
    }

    public function saveClassToDatabase($className, $experienceRequired)
    {
        $db = new Database(); // Instantiate your database class

        // Prepare the SQL query
        $query = "INSERT INTO classes (class_name, experience_required) VALUES (?, ?)";

        // Bind the parameter values
        $values = array($className, $experienceRequired);

        // Execute the query using the write() method of the Database class
        if ($db->write($query, $values)) {
            // Data inserted successfully
            echo "<script>alert('Class Added');
                location=('http://localhost/membership/public/classes');
                </script>";
        } else {
            // Error occurred while inserting data
            echo "<script>alert('Some Error Occured');
                location=('http://localhost/membership/public/classes_form');
                </script>";
        }
    }

}