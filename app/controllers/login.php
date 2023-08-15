<?php

Class Login extends Controller 
{

	private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

	function index()
	{
 	 	
 	 	$data['page_title'] = "Login";

		  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
            $this->handleLoginForm();
        }

		$this->view("login",$data);
	}

	public function handleLoginForm(){

        // Retrieve form data
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Perform the necessary validation and authentication
        // You can add your own logic here to validate the login credentials

        // Example: Perform authentication using a database query
        $query = "SELECT * FROM admins WHERE email = :email limit 1";
        $data = [
            'email' => $email,
        ];
        $user = $this->db->read($query, $data);

      

        $hashedPasswordFromDatabase = $user[0]->password; // Assuming the hashed password column in the database is named 'password'

        if (password_verify($password, $hashedPasswordFromDatabase)) {

            if ($user) {
                // Successful login
                // You can perform any necessary actions here (e.g., set session variables, redirect to a dashboard page)
    
                $_SESSION['user'] = $user[0];
                        
                echo "<script>
                    location=('http://localhost/membership/public/member_dashboard');
                    </script>";

                //alert('Log in Success');

                // Redirect to the desired page
                //header("Location: " . ROOT . "dashboard");
                die;
            } else {
                // Failed login
                // You can display an error message or perform any necessary actions
    
                echo "Invalid email or password";
            }
                
        }


    }

}