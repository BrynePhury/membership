<?php
class Sessions extends Controller
{
    public function index()
    {
        $data['page_title'] = "Sessions";

        if (!isset($_SESSION['user'])){
			echo "<script>
            location=('http://localhost/membership/public/login');
            </script>";
                
		}
		
        $user = $this->loadModel("user");

    	// Get all members from the model
        $notices = $user->getAllNotices();

		$data['notices'] = $notices;
        
        $sessions = $this->loadSess();

        $data['sessions'] = $sessions;
       

        $this->view("sessions", $data);
    }

    public function loadSess()
    {
        $DB = new Database();

        $query = "SELECT * FROM m_sessions";

        return $DB->read($query);
    }
}