<?php
class View_cv extends Controller
{
    public function index()
    {
        $data['page_title'] = "View CV";

        if (!isset($_SESSION['user'])){
			echo "<script>
            location=('http://localhost/membership/public/login');
            </script>";
                
		}
		
        $user = $this->loadModel("user");

    	// Get all members from the model
        $notices = $user->getAllNotices();

		$data['notices'] = $notices;
        
        $data['cv_file'] = $_GET['cv_file'];

        $this->view("view_cv", $data);
    }

  
    
}
