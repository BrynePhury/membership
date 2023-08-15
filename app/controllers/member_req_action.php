<?php
class Member_req_action extends Controller
{
    public function index()
    {
        $data['page_title'] = "Member Request Action";

        $extractedList = json_decode($_GET['selectedMembers']);

        if($_GET['action'] === 'delete'){

            $this->deleteMembers($extractedList);

        } else if ($_GET['action'] === 'accept'){

            $this->acceptMembers($extractedList);
            
        }

        $this->view("member_req_action", $data);
    }

    private function deleteMembers($extractedList) {
        // Ensure $extractedList is an array before proceeding
        if (is_array($extractedList)) {
            
            $db = new Database();

            $query = "DELETE FROM members WHERE id_number = :id";

            // Loop through the IDs in $extractedList and delete corresponding members
            foreach ($extractedList as $id) {
                // Use the write method of the Database class to execute the DELETE query with the ID as data
                $result = $db->write($query, [':id' => $id]);

                if ($result) {
                    // Redirect back to the add_fees page or any other appropriate page
                    header('Location: http://localhost/membership/public/membership_requests');
                    exit;
                } else {
                    echo "Failed to delete member with ID $id.<br>";
                }
            }
        } else {
            echo "Invalid input data. Expected an array of member IDs.";
        }
    }


    private function acceptMembers($extractedList) {
        // Ensure $extractedList is an array before proceeding
        if (is_array($extractedList)) {
            
            $db = new Database();

            $query = "UPDATE members SET m_status = 'accepted' WHERE id_number = :id";

            // Loop through the IDs in $extractedList and update the status for each member
            foreach ($extractedList as $id) {
                // Use the write method of the Database class to execute the UPDATE query with the ID as data
                $result = $db->write($query, [':id' => $id]);

                if ($result) {
                    header('Location: http://localhost/membership/public/membership_requests');
                    exit;
                } else {
                    echo "Failed to update member with ID $id status.<br>";
                }
            }
        } else {
            echo "Invalid input data. Expected an array of member IDs.";
        }
    }



}

