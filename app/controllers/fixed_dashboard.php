<?php

Class Fixed_dashboard extends Controller 
{

	function index()
	{
 	 	
 	 	$data['page_title'] = "Invoices Form";

		// if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
        //     $this->handleLoginForm();
        // }

		if (!isset($_SESSION['user'])){
			echo "<script>
            location=('http://localhost/membership/public/login');
            </script>";
                
		}
		
        $user = $this->loadModel("user");

    	// Get all members from the model
        $notices = $user->getAllNotices();

		$data['notices'] = $notices;

		

		$this->view("fixed_dashboard",$data);
	}

	
}