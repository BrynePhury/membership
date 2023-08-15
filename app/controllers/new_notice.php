<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/phpmailer/src/Exception.php';
require __DIR__ . '/phpmailer/src/PHPMailer.php';
require __DIR__ . '/phpmailer/src/SMTP.php';

class New_notice extends Controller
{

    private $user;
    private $members;

    public function __construct()
    {
        $this->user = $this->loadModel("user");
        $this->members = $this->user->getAllMembers();
    }
    public function index()
    {
        $data['page_title'] = "New Notice";

        if (!isset($_SESSION['user'])){
			echo "<script>
            location=('http://localhost/membership/public/login');
            </script>";
                
		}

        if(isset($_POST['title']) && isset($_POST['details']) && isset($_POST['notice_to'])){

            $file_path = $this->uploadFile();


            $this->saveNotice($_POST['title'], $_POST['details'], $_SESSION['user']->id_number, $_POST['notice_to'], $file_path);
        }

    	// Get all members from the model
        $notices = $this->user->getAllNotices();

		$data['notices'] = $notices;

        // Load the classes
        $classes = $this->loadClasses();

        $data["classes"] = $classes;

        $this->view("new_notice", $data);
    }

    public function loadClasses()
    {
        // Create a new instance of the Database class
        $DB = new Database();

        // Retrieve classes from the database using prepared statements
        $query = "SELECT * FROM classes";

        return $DB->read($query);
    }

    private function saveNotice($title, $details, $userId,$noticeTo, $file_path)
    {
        $db = new Database();

        
        $query = "INSERT INTO notices (user_id, notice_title, notice_details,attachment) VALUES (:user_id, :notice_title, :notice_details, :file_path)";
        $data = [
            'user_id' => $userId,
            'notice_title' => $title,
            'notice_details' => $details,
            'file_path' => $file_path,
        ];

        $success = $db->write($query, $data);

        if ($success) {

            $notice_id = $db->lastInsertId();
            $notice_status = "unseen";

            if ($noticeTo === 'everyone'){

                foreach ($this->members as $member){
                    $notice_to_id = $member->id_number;

                    $query = "INSERT INTO notice_details (notice_id, notice_to_id, notice_status) VALUES (:notice_id, :notice_to_id, :notice_status)";
                    $data = [
                        'notice_id' => $notice_id,
                        'notice_to_id' => $notice_to_id,
                        'notice_status' => $notice_status,
                        ];

                    $db->write($query, $data);
                }

            } else {

                foreach ($this->members as $member){
                    if ($member->class_id == $noticeTo){
                        $notice_to_id = $member->id_number;

                        $this->sendEmail($member->email,$title,$details,$file_path);

                        $query = "INSERT INTO notice_details (notice_id, notice_to_id, notice_status) VALUES (:notice_id, :notice_to_id, :notice_status)";
                        $data = [
                            'notice_id' => $notice_id,
                            'notice_to_id' => $notice_to_id,
                            'notice_status' => $notice_status,
                            ];
    
                        $db->write($query, $data);
                    }

                    
                }

            }
        } else {
            echo "Failed to insert data.";
        }
    }

    private function uploadFile(){
        if (isset($_FILES["attachment"]) && $_FILES["attachment"]["error"] === UPLOAD_ERR_OK) {
            // Get the temporary location of the uploaded file
            $tempFilePath = $_FILES["attachment"]["tmp_name"];
                
            // Define the directory where you want to save the uploaded image
            $uploadDir = "./uploads/";

            // Generate a unique filename to avoid conflicts
            $fileName = uniqid() . "_" . $_FILES["attachment"]["name"];

            // Final path for the uploaded file
            $uploadFilePath = $uploadDir . $fileName;

            // Move the uploaded file to the desired location
            if (move_uploaded_file($tempFilePath, $uploadFilePath)) {
                    
                return $uploadFilePath;
                    
            } else {
                return "";
            }
        } else {
            // No file uploaded or an error occurred during the upload process
            return "";
        }
    }

    private function sendEmail($address,$subject,$message,$attachmentPath){
        try {
            $mail = new PHPMailer(true);

            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'brynephury@gmail.com';
            $mail->Password = 'poccngsbvtmmnxkr';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            $mail->setFrom('brynephury@gmail.com');

            $mail->addAddress($address);

            $mail->isHTML(true);

            $mail->Subject = $subject;
            $mail->Body = $message;

            if ($attachmentPath != ''){
            // Add attachment
            $mail->addAttachment($attachmentPath); 
            }
            $mail->send();

            echo "<script>
            alert('Sent Successfully')
            </script>";
        } catch (Exception $e) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        }

    }

   
}