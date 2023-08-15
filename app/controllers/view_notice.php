<?php
class View_notice extends Controller
{
    public function index()
    {
        $data['page_title'] = "View Notice";

        if (!isset($_SESSION['user'])){
			echo "<script>
            location=('http://localhost/membership/public/login');
            </script>";
                
		}
		
        $user = $this->loadModel("user");

    	// Get all members from the model
        $notices = $user->getAllNotices();

		$data['notices'] = $notices;

        if (isset($_GET['id'])){
            $notice = $this->getNotice($_GET['id']);

            $data['notice'] = $notice;
        }

    
        $this->view("view_notice", $data);
    }

    private function getNotice($id)
    {
        $db = new Database();

        $query = "SELECT * FROM notices WHERE notice_id = :id";
        $data = ['id' => $id];

        $notice = $db->read($query, $data);

        if ($notice !== false && count($notice) > 0) {
            // Return the first (and only) element of the result as the notice
            return $notice[0];
        } else {
            return null; // Return null if no notice found with the given ID
        }
    }


   
}