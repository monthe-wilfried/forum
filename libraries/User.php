<?php
/**
* 
*/
class User{

	private $db;

	/*
	*  Constructor
	*/
	public function __construct()
	{
		$this->db = new Database;
	}

	/*
	*  Get Total number of Users
	*/
	public function totalUsers(){
		$this->db->query("SELECT * FROM users");
		$results = $this->db->resultset();

		return $count = $this->db->rowCount();
	}

	/*
	 * Register User
	 */
	public function register($data){
			//Insert Query
			$this->db->query('INSERT INTO users (name, email, avatar, username, password, about, last_activity) 
											VALUES (:name, :email, :avatar, :username, :password, :about, :last_activity)');
			//Bind Values
			$this->db->bind(':name', $data['name']);
			$this->db->bind(':email', $data['email']);
			$this->db->bind(':avatar', $data['avatar']);
			$this->db->bind(':username', $data['username']);
			$this->db->bind(':password', $data['password']);
			$this->db->bind(':about', $data['about']);
			$this->db->bind(':last_activity', $data['last_activity']);
			//Execute
			if($this->db->execute()){
				return true;
			} else {
				return false;
			}
			//echo $this->db->lastInsertId();
	}

	/*
	 * Login User
	 */
	public function login($username, $password){
			//Insert Query
			$this->db->query("SELECT * FROM users WHERE username = :username AND password = :password ");
			//Bind Values
			$this->db->bind(':username', $username);
			$this->db->bind(':password', $password);

			$row = $this->db->single();
			
			// Check Rows
			if($this->db->rowCount() > 0){
				$this->setUserData($row);
				return true;
			} else {
				return false;
			}
			//echo $this->db->lastInsertId();
	}

	/*
	* Set User Data
	*/
	private function setUserData($row){
		$_SESSION['is_logged_in'] = true;
		$_SESSION['user_id'] = $row['id'];
		$_SESSION['username'] = $row['username'];
		$_SESSION['name'] = $row['name'];

	}

	/*
	* Logout User
	*/
	public function logout(){
		unset($_SESSION['is_logged_in']); 
		unset($_SESSION['user_id']);
		unset($_SESSION['username']);
		unset($_SESSION['name']);
		return true;
	}

	/*
	*  Upload Avatar
	*/
	public function uploadAvatar(){
		$allowedExts = array('png','.jpg','jpeg','gif');
		$temp = explode('.', $_FILES['avatar']['name']);
		/* The end() is used to display the last element in an array
		*  current() for the first element in the array
		*  next() and prev() for the next and previous elements respectively.
		*/
		$extension = end($temp);

		// Check the file types
		if(($_FILES['avatar']['type'] == 'image/gif') || ($_FILES['avatar']['type'] == 'image/png') || ($_FILES['avatar']['type'] == 'image/x-png') || ($_FILES['avatar']['type'] == 'image/jpg') || ($_FILES['avatar']['type'] == 'image/jpeg') || ($_FILES['avatar']['type'] == 'image/pjpeg') && ($_FILES['avatar']['size'] < 20000) && in_array($extension, $allowedExts)){
			if($_FILES['avatar']['error'] > 0){
				redirect('register.php', $_FILES['avatar']['error'], 'error');
			}else
				if (file_exists("img/avatars/".$_FILES['avatar']['name'])) {
					redirect('register.php', 'File already exist.', 'error');
				}else{
					move_uploaded_file($_FILES['avatar']['tmp_name'], "img/avatars/".$_FILES['avatar']['name']);
					return true;
				}
		}else{
			redirect('register.php', 'Invalid File Type.', 'error');
		}
	}
}

?>