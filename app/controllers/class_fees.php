<?php

Class Class_fees extends Controller
{
    public function index()
    {
        $data['page_title'] = "Class Fees";

        if (!isset($_SESSION['user'])){
			echo "<script>
            location=('http://localhost/membership/public/login');
            </script>";
                
		}
		
        $user = $this->loadModel("user");

    	// Get all members from the model
        $notices = $user->getAllNotices();

		$data['notices'] = $notices;

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['class_id'])) {
            $classId = $_POST['class_id'];
            
            $feesData = $this->loadFees($classId);
            if (isset($feesData['fees'])) {
                $data['fees'] = $feesData['fees'];
            } else {
                $data['fees'] = [];
            }
            if (isset($feesData['class_name'])) {
                $data['class_name'] = $feesData['class_name'];
            } else {
                $data['class_name'] = 'Unknown Class';
            }

        } else {
            $data['fees'] = []; // Set an empty array if no fees are available
            $data['class_name'] = 'Unknown Class';
        }

        $this->view("class_fees", $data);
    }

    public function loadFees($classId)
    {
        $DB = new Database();
        $data = [];

        // Retrieve the class name from the database based on the class_id
        $classQuery = "SELECT class_name FROM classes WHERE class_id = :class_id";
        $classData = $DB->read($classQuery, [':class_id' => $classId]);

        $className = $classData[0]->class_name;

        $data['class_name'] = $className;

        if (is_array($classData) && !empty($classData)) {
           

            // Retrieve the fees for the class from the database
            $feesQuery = "SELECT fees_list.* FROM grouped_fees
                          INNER JOIN fees_list ON grouped_fees.fee_id = fees_list.fee_id
                          WHERE grouped_fees.class_id = :class_id";
            $feesData = $DB->read($feesQuery, [':class_id' => $classId]);

            if (is_array($feesData) && !empty($feesData)) {
                // Combine the fees data and class name in the $data array
                $data['fees'] = $feesData;
                
            }
        }

        return $data;
    }
}


