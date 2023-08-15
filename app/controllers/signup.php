<?php

class Signup extends Controller
{
    public function index()
    {
        $data['page_title'] = "Signup";

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signup'])) {
            $this->handleSignupForm();
        }

        $this->view("signup", $data);
    }

    public function handleSignupForm()
    {
        // Retrieve form data
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $contact1 = $_POST['contact1'];
        $contact2 = $_POST['contact2'];
        $email = $_POST['email'];
        $id_number = $_POST['id_number'];
        $cv = $_FILES['cv'];
        $status = "pending";

        // Validate file format
        $allowedExtensions = array('pdf');
        $fileExtension = strtolower(pathinfo($cv['name'], PATHINFO_EXTENSION));

        if (!in_array($fileExtension, $allowedExtensions)) {
            echo "Invalid file format. Only PDF files are allowed.";
            return;
        }

        $cv['name'] = uniqid() . $cv['name'];

        $newPassword = "12345678";

        $newHashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // Insert data into the members table
        $query = "INSERT INTO admins (fname, lname, contact1, contact2, email, id_number, cv_file,m_status,password) VALUES (?,?,?, ?, ?, ?, ?, ?,?)";
        $data = array($first_name, $last_name, $contact1, $contact2, $email, $id_number, $cv['name'],$status,$newHashedPassword);

        // Create an instance of the Database class
        $db = new Database();

        // Insert the data into the table
        if ($db->write($query, $data)) {

            // Upload the CV file
            $uploadDirectory = './uploads/';
            if (!file_exists($uploadDirectory)) {
                mkdir($uploadDirectory, 0777, true);
            }
            $destinationFilePath = $uploadDirectory . $cv['name'];

            if (is_uploaded_file($cv['tmp_name'])) {
                if (move_uploaded_file($cv['tmp_name'], $destinationFilePath)) {
                    echo "<script>alert('Registered Successfully'); location=('http://localhost/membership/public/login');</script>";
                } else {
                    echo "Error: Failed to move the file.";
                }
            } else {
                echo "Error: File not uploaded.";
            }

        } else {
            echo "<script>alert('Error: Registration Failed');</script>";
        }
    }


}
