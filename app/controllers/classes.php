<?php

class Classes extends Controller
{
    public function index()
    {
        $data['page_title'] = "Classes";

        if (!isset($_SESSION['user'])){
			echo "<script>
            location=('http://localhost/membership/public/login');
            </script>";
                
		}
		
        $user = $this->loadModel("user");

    	// Get all members from the model
        $notices = $user->getAllNotices();

		$data['notices'] = $notices;

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save'])) {
            $this->save();
            return; // Exit the method after calling the save function
        }

        // Load the classes
        $classes = $this->loadClasses();

        // Get the fees for each class
        foreach ($classes as $class) {
            $class->fees = $this->loadFees($class->class_id);
        }

        //Load Fees
        $allFees = $this->loadAllFees();

        $data['classes'] = $classes;
        $data['all_fees'] = $allFees;

        $this->view("classes", $data);
    }

    public function loadClasses()
    {
        // Create a new instance of the Database class
        $DB = new Database();

        // Retrieve classes from the database using prepared statements
        $query = "SELECT * FROM classes";

        return $DB->read($query);
    }

    public function loadFees($classId)
    {
        // Create a new instance of the Database class
        $DB = new Database();

        // Retrieve fees for the given class ID from the database
        $query = "SELECT fees_list.* FROM grouped_fees
                INNER JOIN fees_list ON grouped_fees.fee_id = fees_list.fee_id
                WHERE grouped_fees.class_id = :class_id";

        $params = array(':class_id' => $classId);

        return $DB->read($query, $params);
    }

    public function loadAllFees()
    {
        $DB = new Database();

        // Retrieve fees from the database
        $query = "SELECT * FROM fees_list";

        return $DB->read($query);
    }

    public function save()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            var_dump($_POST);
            $fees = $_POST['fees'];
            
            // Process and save the selected fees to the database
            $classId = $_POST['class_id']; // Assuming you have the class_id in the POST request
            
            // Clear existing fees for the class
            $this->clearClassFees($classId);
            
            // Insert the selected fees for the class
            foreach ($fees as $feeId) {
                $this->insertClassFee($classId, $feeId);
            }
            // echo "<script>alert('Save Success');
            //     location=('http://localhost/membership/public/classes');
            //     </script>";
            
        } 
    }

    private function clearClassFees($classId)
    {
        $DB = new Database();
        $query = "DELETE FROM grouped_fees WHERE class_id = :class_id";
        $DB->write($query, [':class_id' => $classId]);
    }

    private function insertClassFee($classId, $feeId)
    {
        $DB = new Database();
        $query = "INSERT INTO grouped_fees (class_id, fee_id) VALUES (:class_id, :fee_id)";
        $DB->write($query, [':class_id' => $classId, ':fee_id' => $feeId]);
    }



}
