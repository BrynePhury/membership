<?php

class Add_fees extends Controller
{
    public function index()
    {
        $data['page_title'] = "Add Fees";

        if (!isset($_SESSION['user'])){
			echo "<script>
            location=('http://localhost/membership/public/login');
            </script>";
                
		}
		
        $user = $this->loadModel("user");

    	// Get all members from the model
        $notices = $user->getAllNotices();

		$data['notices'] = $notices;

        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['fee_id']) && isset($_GET['class_id'])) {
            $feeId = $_GET['fee_id'];
            $classId = $_GET['class_id'];
            
            // Call the removeFee function to remove the fee
            $this->deleteGroupedFee($classId, $feeId);
            
            // Redirect back to the add_fees page or any other appropriate page
            header('Location: http://localhost/membership/public/add_fees?class_id=' . $classId);
            exit;
        } 

        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['fees']) && isset($_GET['class_id'])) {
            $classId = $_GET['class_id'];
            $selectedFees = $_GET['fees'];

            $feeIds = explode(',', $selectedFees);
    
            // Process and create the grouped fees
            $this->createGroupedFees($classId, $feeIds);
    
            // Redirect back to the add_fees page or any other appropriate page
            header('Location: http://localhost/membership/public/add_fees?class_id=' . $classId);
            exit;
        } 

        // Get the class ID from the URL parameter
        $classId = $_GET['class_id'];

        // Load the grouped fees associated with the class
        $groupedFees = $this->loadGroupedFees($classId);

        // Load the corresponding fee objects from the fees_list table
        $fees = array();

        foreach ($groupedFees as $groupedFee) {
            $fee = $this->loadFee($groupedFee->fee_id);
            if ($fee) {
                $fees[] = $fee;
            }
        }

        $data['fees'] = $fees;

        // Load all fees from the fees_list table
        $data['all_fees'] = $this->loadAllFees();

        $data['class_id'] = $classId;

        $data['class_name'] = $this->getClassName($classId);

        $this->view("add_fees", $data);
    }
    private function getClassName($classId)
    {
        $DB = new Database();
        $query = "SELECT class_name FROM classes WHERE class_id = :class_id LIMIT 1";
        $result = $DB->read($query, [':class_id' => $classId]);

        if ($result && !empty($result)) {
            return $result[0]->class_name;
        }

        return null;
    }


    private function loadGroupedFees($classId)
{
    // Create a new instance of the Database class
    $DB = new Database();

    // Retrieve grouped fees from the database for the given class ID
    $query = "SELECT * FROM grouped_fees WHERE class_id = :class_id";
    $params = array(':class_id' => $classId);

    $fees = $DB->read($query, $params);

    if ($fees === false || empty($fees)) {
        // Return an empty array if no fees are found
        return array();
    }

    return $fees;
}


    private function loadFee($feeId)
    {
        // Create a new instance of the Database class
        $DB = new Database();

        // Retrieve the fee from the fees_list table for the given fee ID
        $query = "SELECT * FROM fees_list WHERE fee_id = :fee_id";
        $params = array(':fee_id' => $feeId);

        $result = $DB->read($query, $params);

        if (!empty($result)) {
            return $result[0]; // Return the first row (assuming fee_id is unique)
        }

        return null; // Return null if no fee found
    }

    public function loadAllFees()
    {
        // Create a new instance of the Database class
        $DB = new Database();

        // Retrieve all fees from the fees_list table
        $query = "SELECT * FROM fees_list";
        $fees = $DB->read($query);

        return $fees;
    }

    private function deleteGroupedFee($classId, $feeId)
    {

        echo "Here";

        $DB = new Database();
        $query = "DELETE FROM grouped_fees WHERE class_id = :class_id AND fee_id = :fee_id LIMIT 1";
        $DB->write($query, [':class_id' => $classId, ':fee_id' => $feeId]);
    }

    private function createGroupedFees($classId, $feeIds)
    {
        // Create a new instance of the Database class
        $DB = new Database();

        try {
            // Insert the grouped fees into the grouped_fees table
            foreach ($feeIds as $feeId) {
                $query = "INSERT INTO grouped_fees (class_id, fee_id) VALUES (:class_id, :fee_id)";
                $params = array(':class_id' => $classId, ':fee_id' => $feeId);
                $DB->write($query, $params);
            }
            
            echo "Grouped fees created successfully!";
        } catch (PDOException $e) {
            echo "Error creating grouped fees: " . $e->getMessage();
        }
    }




}

