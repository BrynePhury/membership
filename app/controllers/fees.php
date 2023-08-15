<?php

Class Fees extends Controller
{
	function index()
	{
		$data['page_title'] = "Fees";

        if (!isset($_SESSION['user'])){
			echo "<script>
            location=('http://localhost/membership/public/login');
            </script>";
                
		}
		
        $user = $this->loadModel("user");

    	// Get all members from the model
        $notices = $user->getAllNotices();

		$data['notices'] = $notices;

		
		
        $fees = $this->loadFees();

        $data['fees'] = $fees;


		$this->view("fees",$data);
	}

	public function loadFees()
    {
        $DB = new Database();

        $query = "SELECT * FROM fees_list";

        return $DB->read($query);
    }

}