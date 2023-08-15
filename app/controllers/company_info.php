<?php
class Company_info extends Controller{

    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    public function index(){
        $data['page_title'] = "Company Info";

        if (!isset($_SESSION['user'])){
			echo "<script>
            location=('http://localhost/membership/public/login');
            </script>";  
		}

        $company = $this->getCompanyByUserId($_SESSION['user']->id_number);


        $data['company'] = $company;
       

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['co_name'])) {
            if ($company){
                $this->saveCompanyData($_POST,$company->company_id);
            } else{
                $this->saveCompanyData($_POST,'');
            }
            
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES["logo"])) {
            if (isset($_FILES["logo"]) && $_FILES["logo"]["error"] === UPLOAD_ERR_OK) {
                // Get the temporary location of the uploaded file
                $tempFilePath = $_FILES["logo"]["tmp_name"];
                
                // Define the directory where you want to save the uploaded image
                $uploadDir = "./uploads/";

                // Generate a unique filename to avoid conflicts
                $fileName = uniqid() . "_" . $_FILES["logo"]["name"];

                // Final path for the uploaded file
                $uploadFilePath = $uploadDir . $fileName;

                // Move the uploaded file to the desired location
                if (move_uploaded_file($tempFilePath, $uploadFilePath)) {
                    // File upload success! You can now save the $uploadFilePath in your database or use it as needed.
                    // Get the member ID from the form (You may need to modify this part according to your form structure)
                    $memberID = $_SESSION['user']->id_number;

                    // Prepare the query to update the photo link in the members table
                    $query = "UPDATE company_details SET company_logo = :company_logo WHERE admin_id = :memberID";

                    // Bind the photo link and member ID to the prepared statement
                    $params = array(
                        ':company_logo' => $uploadFilePath,
                        ':memberID' => $memberID,
                    );

                    // Execute the query using the Database class's write method
                    $updated = $this->db->write($query, $params);

                    if ($updated) {
 
                        echo "<script>
                                location=('http://localhost/membership/public/dashboard');
                            </script>";
                        
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
        
		
        $user = $this->loadModel("user");

    	// Get all members from the model
        $notices = $user->getAllNotices();

		$data['notices'] = $notices;

        $this->view("company_info", $data);
    }

    public function getCompanyByUserId($userId) {
        $db = new Database();

        $query = "SELECT * FROM company_details WHERE admin_id = :admin_id LIMIT 1";
        $data = [':admin_id' => $userId];
    
        $company = $db->read($query, $data);
    
        if ($company) {
            return $company[0];
        } else{
            return null;
        }
    
        
    }
    
    private function saveCompanyData($_PST,$id){
        $companyName = $_PST['co_name'];
        $companyDescription = $_PST['desc'];
        $companyEmail = $_PST['co_email'];
        $companyPhone = $_PST['co_phone'];
        $companyTel = $_PST['co_tel'];
        $companyTpin = $_PST['co_tpin'];
        $companyAddress = $_PST['co_address'];
        $adminId = $_SESSION['user']->id_number;
        
        // Create an instance of the Database class
        $db = new Database();

        
        if ($id != '') {
            // Update the company details
            $query = "UPDATE company_details 
                    SET company_name = :company_name,
                        address = :company_address,
                        tpin_number = :tpin_number,
                        company_email = :company_email,
                        company_phone = :company_phone,
                        company_tel = :company_tel,
                        admin_id = :admin_id,
                        description = :description 
                    WHERE company_id = :id";

            // Bind the parameters
            $data = [
                ':company_name' => $companyName,
                ':company_address' => $companyAddress,
                ':tpin_number' => $companyTpin,
                ':company_email' => $companyEmail,
                ':company_phone' => $companyPhone,
                ':company_tel' => $companyTel,
                ':admin_id' => $adminId,
                ':description' => $companyDescription,
                ':id' => $id
            ];
        } else {
            // Insert new company details
            $query = "INSERT INTO company_details (company_name, address, tpin_number, company_email, company_phone, company_tel, admin_id, description)
                    VALUES (:company_name, :company_address, :tpin_number, :company_email, :company_phone, :company_tel, :admin_id, :description)";

            // Bind the parameters
            $data = [
                ':company_name' => $companyName,
                ':company_address' => $companyAddress,
                ':tpin_number' => $companyTpin,
                ':company_email' => $companyEmail,
                ':company_phone' => $companyPhone,
                ':company_tel' => $companyTel,
                ':admin_id' => $adminId,
                ':description' => $companyDescription
            ];
        }
        
        // Execute the write method from the Database class
        if ($db->write($query, $data)) {
            echo "<script>
            location=('http://localhost/membership/public/');
            </script>";
        } else {
            echo "Error inserting data.";
        }
    }

   
}