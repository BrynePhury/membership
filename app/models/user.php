<?php 

Class User 
{

	function login($POST)
	{
		$DB = new Database();

		$_SESSION['error'] = "";
		if(isset($POST['username']) && isset($POST['password']))
		{

			$arr['username'] = $POST['username'];
			$arr['password'] = $POST['password'];

			$query = "select * from users where username = :username && password = :password limit 1";
			$data = $DB->read($query,$arr);
			if(is_array($data))
			{
 				//logged in
 				$_SESSION['user_name'] = $data[0]->username;
				$_SESSION['user_url'] = $data[0]->url_address;

				header("Location:". ROOT . "home");
				die;

			}else{

				$_SESSION['error'] = "wrong username or password";
			}
		}else{

			$_SESSION['error'] = "please enter a valid username and password";
		}

	}

	function signup($POST)
	{

		$DB = new Database();

		$_SESSION['error'] = "";
		if(isset($POST['username']) && isset($POST['password']))
		{

			$arr['username'] = $POST['username'];
			$arr['password'] = $POST['password'];
			$arr['email'] = $POST['email'];
			$arr['url_address'] = get_random_string_max(60);
			$arr['date'] = date("Y-m-d H:i:s");

			$query = "insert into users (username,password,email,url_address,date) values (:username,:password,:email,:url_address,:date)";
			$data = $DB->write($query,$arr);
			if($data)
			{
				
				header("Location:". ROOT . "login");
				die;
			}

		}else{

			$_SESSION['error'] = "please enter a valid username and password";
		}
	}

	function check_logged_in()
	{

		$DB = new Database();
		if(isset($_SESSION['user_url']))
		{

			$arr['user_url'] = $_SESSION['user_url'];

			$query = "select * from users where url_address = :user_url limit 1";
			$data = $DB->read($query,$arr);
			if(is_array($data))
			{
				//logged in
 				$_SESSION['user_name'] = $data[0]->username;
				$_SESSION['user_url'] = $data[0]->url_address;

				return true;
			}
		}

		return false;

	}

	function logout()
	{
		//logged in
		unset($_SESSION['user_name']);
		unset($_SESSION['user_url']);

		header("Location:". ROOT . "login");
		die;
	}

	public function getAllMembers()
    {
		$DB = new Database();
        // Retrieve members from the database using prepared statements
        $query = "SELECT members.*, classes.*
		FROM members
		LEFT JOIN classes ON members.class_id = classes.class_id;";
        return $DB->read($query);
    }

	

	public function searchMembers($query)
    {
        $DB = new Database();
        $searchQuery = "SELECT * FROM members WHERE fname LIKE :query OR lname LIKE :query";
        $params = array(':query' => '%' . $query . '%');
        
        return $DB->read($searchQuery, $params);
    }

	public function getAllNotices()
    {
        $db = new Database();

        $query = "SELECT n.*, a.fname AS admin_fname, a.lname AS admin_lname, a.photo AS admin_photo
        	FROM notices n
        	INNER JOIN admins a ON n.user_id = a.id_number
        	ORDER BY n.date_created DESC
        	LIMIT 5";

        $notices = $db->read($query);

        if ($notices !== false) {
            return $notices; // Return the fetched notices as an array
        } else {
            return []; // Return an empty array if no notices found
        }
    }


}