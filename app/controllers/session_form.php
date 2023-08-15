<?php
class Session_form extends Controller
{
    public function index()
    {
        $data['page_title'] = "Sessions form";

        if (!isset($_SESSION['user'])){
			echo "<script>
            location=('http://localhost/membership/public/login');
            </script>";
                
		}
		
        $user = $this->loadModel("user");

    	// Get all members from the model
        $notices = $user->getAllNotices();

		$data['notices'] = $notices;
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_session'])) {
            $this->handleClassForm();
        }

        $this->view("session_form", $data);
    }

    public function handleClassForm()
    {
        $session_name = $_POST['session_name'];
        $status = $_POST['status'];

        $this->saveClassToDatabase($session_name, $status);
    }

    public function saveClassToDatabase($session_name, $status)
    {
        $db = new Database(); // Instantiate your database class

        // Prepare the SQL query
        $query = "INSERT INTO m_sessions (session_name, m_status) VALUES (?, ?)";

        // Bind the parameter values
        $values = array($session_name, $status);

        // Execute the query using the write() method of the Database class
        if ($db->write($query, $values)) {
            // Data inserted successfully
            echo "<script>alert('Class Added');
                location=('http://localhost/membership/public/sessions');
                </script>";
        } else {
            // Error occurred while inserting data
            echo "<script>alert('Some Error Occured');
                location=('http://localhost/membership/public/session_form');
                </script>";
        }
    }

}