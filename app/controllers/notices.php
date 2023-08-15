<?php
class Notices extends Controller
{
    public function index()
    {
        $data['page_title'] = "Notices";

        if (!isset($_SESSION['user'])){
			echo "<script>
            location=('http://localhost/membership/public/login');
            </script>";
                
		}
		
        $user = $this->loadModel("user");

    	// Get all members from the model
        $notices = $user->getAllNotices();

		$data['notices'] = $notices;
        
        $notices = $this->getAllNotices();

        $data['noticesb'] = $notices;


        $this->view("notices", $data);
    }

    private function getAllNotices()
    {
        $db = new Database();

        $query = "SELECT n.*, a.fname AS admin_fname, a.lname AS admin_lname 
                FROM notices n
                INNER JOIN admins a ON n.user_id = a.id_number
                ORDER BY n.date_created DESC";

        $notices = $db->read($query);

        if ($notices !== false) {
            return $notices; // Return the fetched notices as an array
        } else {
            return []; // Return an empty array if no notices found
        }
    }


   
}