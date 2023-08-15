<?php
class Receipts extends Controller
{
    public function index()
    {
        $data['page_title'] = "Receipts";

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
        $data['members'] = $user->getAllMembers();

        $data['receipts'] = $this->getAllReceipts();
        $data['is_user'] = false;  

        $this->view("receipts", $data);
    }

    public function getAllReceipts()
    {
        $DB = new Database();
        
        $query = "SELECT receipts.receipt_no,receipts.member_id,receipts.session_code,members.id_number,members.fname,members.lname,m_sessions.session_name,m_sessions.session_code FROM receipts join members on members.id_number = receipts.member_id join m_sessions on m_sessions.session_code = receipts.session_code order by members.fname";

        $receipts = $DB->read($query);

        return $receipts;
    }
    
    public function getReceipts($member_id)
    {
        $DB = new Database();
        
        $query = "SELECT receipts.receipt_no,receipts.member_id,receipts.session_code,members.id_number,members.fname,members.lname,m_sessions.session_name,m_sessions.session_code FROM receipts join members on members.id_number = receipts.member_id join m_sessions on m_sessions.session_code = receipts.session_code where receipts.member_id = :member_id order by members.fname";
        $params = array(':member_id' => $member_id);
        $receipts = $DB->read($query,$params);

        return $receipts;
    }
}