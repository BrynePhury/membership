<?php
class Account_info extends Controller
{
    public function index()
    {
        $data['page_title'] = "Account";

        if (!isset($_SESSION['user'])){
			echo "<script>
            location=('http://localhost/membership/public/login');
            </script>";
                
		}
		
        $user = $this->loadModel("user");

    	// Get all members from the model
        $notices = $user->getAllNotices();

		$data['notices'] = $notices;

        $this->view("account_info", $data);
    }

   
}