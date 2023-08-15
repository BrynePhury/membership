<?php
class Members extends Controller
{
    public function index()
    {
        $data['page_title'] = "Members";

		// Check if it's a GET request with a search query
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['searchQuery'])) {
            $this->search();
            return;
        }

        if (!isset($_SESSION['user'])){
			echo "<script>
            location=('http://localhost/membership/public/login');
            </script>";
                
		}
        // Check if it's a GET request with a search query
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $arr = explode(",",$_POST['selected_class']);
            
            $member_id= $arr[1];
            $class_id = $arr[0];

            $this->saveClass($class_id,$member_id);
        }
		
        $user = $this->loadModel("user");

    	// Get all members from the model
        $notices = $user->getAllNotices();

        // Load the classes
        $classes = $this->loadClasses();

		$data['notices'] = $notices;

		$data['classes'] = $classes;

        // Get all members from the model
        $members = $user->getAllMembers();

        // Pass $members variable to the view
        $data['members'] = $members;

        $this->view("members", $data);
    }

    private function saveClass($class_id, $member_id) {
        $db = new Database();
    
        $query = "UPDATE members SET class_id = :class_id WHERE id_number = :member_id";
        $params = array(
            ":class_id" => $class_id,
            ":member_id" => $member_id
        );
    
        $result = $db->write($query, $params);
    
        return $result; // Return true on success, false on failure
    }
    

    public function loadClasses()
    {
        // Create a new instance of the Database class
        $DB = new Database();

        // Retrieve classes from the database using prepared statements
        $query = "SELECT * FROM classes";

        return $DB->read($query);
    }

    function search()
    {
        $data['page_title'] = "Search Results";

        // Retrieve the search query from the GET parameters
        $searchQuery = $_GET['searchQuery'];

        // Perform the search using the search query
        $user = $this->loadModel("user");
        $members = $user->searchMembers($searchQuery);

        // Pass the search results to the view
        $data['members'] = $members;

        $this->view("search_results", $data);
    }
}
