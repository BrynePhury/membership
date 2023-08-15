<?php
class Change_password extends Controller
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }
    
    public function index()
    {
        $data['page_title'] = "Change Password";

        if (!isset($_SESSION['user'])){
			echo "<script>
            location=('http://localhost/membership/public/login');
            </script>";
                
		}
		
        $user = $this->loadModel("user");

    	// Get all members from the model
        $notices = $user->getAllNotices();

		$data['notices'] = $notices;

        if ($_SERVER["REQUEST_METHOD"] === "POST" &&
            isset($_POST['oldPassword']) &&
            isset($_POST['newPassword']) &&
            isset($_POST['conPassword'])
        ) {
            // Retrieve form data
            $oldPassword = $_POST['oldPassword'];
            $newPassword = $_POST['newPassword'];
            $conPassword = $_POST['conPassword'];

            // Validate the input data
            if ($newPassword !== $conPassword) {
                echo "New password and confirm password do not match.";
                exit; // Stop further execution if validation fails
            }

            // Retrieve user data from the session or database (Assuming you have the user ID available in the session)
            $userID = $_SESSION['user']->id_number;
            $query = "SELECT * FROM members WHERE id_number = :userID LIMIT 1";
            $data = [
                'userID' => $userID,
            ];
            $user = $this->db->read($query, $data);

            if ($user) {
                $hashedPassword = $user[0]->password;

                // Verify if the old password matches the stored hashed password
                if (password_verify($oldPassword, $hashedPassword)) {
                    // Hash the new password before updating in the database
                    $newHashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

                    // Prepare the query to update the password in the members table
                    $updateQuery = "UPDATE members SET password = :newPassword WHERE id_number = :userID";
                    $updateData = [
                        'newPassword' => $newHashedPassword,
                        'userID' => $userID,
                    ];

                    // Execute the query using the Database class's write method
                    $updated = $this->db->write($updateQuery, $updateData);

                    if ($updated) {
                        echo "<script>
                                location=('http://localhost/membership_members/public/dashboard');
                            </script>";
                    } else {
                        echo "Failed to update the password.";
                    }
                } else {
                    echo "Old password is incorrect.";
                }
            } else {
                echo "User data not found.";
            }

            exit; // Stop further execution after processing the password change
        }



        $this->view("change_password", $data);
    }

   
}