<?php
class Save_acc extends Controller{

    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }
    
    public function index()
    {

        $data['page_title'] = "Save Account";

        if (!isset($_SESSION['user'])){
			echo "<script>
                    location=('http://localhost/membership/public/login');
                </script>";

                
		}

        // Check if the form is submitted
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Check if a file was uploaded successfully
            if (isset($_FILES["picture"]) && $_FILES["picture"]["error"] === UPLOAD_ERR_OK) {
                // Get the temporary location of the uploaded file
                $tempFilePath = $_FILES["picture"]["tmp_name"];
                
                // Define the directory where you want to save the uploaded image
                $uploadDir = "./uploads/";

                // Generate a unique filename to avoid conflicts
                $fileName = uniqid() . "_" . $_FILES["picture"]["name"];

                // Final path for the uploaded file
                $uploadFilePath = $uploadDir . $fileName;

                // Move the uploaded file to the desired location
                if (move_uploaded_file($tempFilePath, $uploadFilePath)) {
                    // File upload success! You can now save the $uploadFilePath in your database or use it as needed.
                    // Get the member ID from the form (You may need to modify this part according to your form structure)
                    $memberID = $_SESSION['user']->id_number;

                    // Prepare the query to update the photo link in the members table
                    $query = "UPDATE admins SET photo = :photoLink WHERE id_number = :memberID";

                    // Bind the photo link and member ID to the prepared statement
                    $params = array(
                        ':photoLink' => $uploadFilePath,
                        ':memberID' => $memberID,
                    );

                    // Execute the query using the Database class's write method
                    $updated = $this->db->write($query, $params);

                    if ($updated) {
                        // Retrieve form data
                        $email = $_SESSION['user']->email;
                       
                        $query = "SELECT * FROM admins WHERE email = :email limit 1";
                        $data = [
                            'email' => $email,
                        ];
                        $user = $this->db->read($query, $data);
                        if ($user){
                            unset($_SESSION['user']);
                            $_SESSION['user'] = $user[0];

                            echo "<script>
                                    location=('http://localhost/membership/public/dashboard');
                                </script>";

                        }
                        
                    } else {
                        echo "Failed to save the file link in the database.";
                    }
                    
                } else {
                    // File upload failed
                    echo "Failed to upload the file.";
                }
            } else {
                // No file uploaded or an error occurred during the upload process
                echo "Please choose a file to upload.";
            }
        }


        $this->view("save_acc", $data);
    }

   
}