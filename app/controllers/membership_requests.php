<?php

Class Membership_requests extends Controller 
{

	function index()
	{
 	 	
 	 	$data['page_title'] = "Membership Requests";

		  if (!isset($_SESSION['user'])){
			echo "<script>
            location=('http://localhost/membership/public/login');
            </script>";
                
		}
		
        $user = $this->loadModel("user");

    	// Get all members from the model
        $notices = $user->getAllNotices();

		$data['notices'] = $notices;

        // Get all members from the model
        $members = $user->getAllMembers();

		
  
        // Pass $members variable to the view
        $data['members'] = $members;
  
        $pending_requests = $this->getPendingRequests($members);
  
        $data['pending_members'] = $pending_requests;

		$this->view("membership_requests",$data);
	}

    private function getPendingRequests($members) {
		$req = array();
		foreach ($members as $member) {
			if ($member->m_status === 'pending') {
				$req[] = $member;
			}
		}
		return $req;
	}



	
}