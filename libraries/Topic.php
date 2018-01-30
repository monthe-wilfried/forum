<?php
class Topic{
//Init DB Variable
	private $db;
	
	/*
	 *	Constructor
	 */
	 public function __construct(){
		$this->db = new Database;
	 }
	 
	 /*
	  *	Get All Topics
	  */
	  public function getAllTopics(){
		$this->db->query("SELECT topics.*, users.username, users.avatar, categories.name FROM topics
							INNER JOIN users
							ON topics.user_id = users.id
							INNER JOIN categories
							ON topics.category_id = categories.id
							ORDER BY create_date DESC
							");
		//Assign Result Set
		$results = $this->db->resultset();
		
		return $results;
	  }

	  /*
	  *	Get All Categories
	  */
	  public function getAllCategories(){
		$this->db->query("SELECT * FROM categories");
		//Assign Result Set
		$results = $this->db->resultset();
		
		return $results;
	  }

	  /*
	  *	Get topics by categories
	  */
	  public function getTopicsByCategory($category_id){
		$this->db->query("SELECT topics.*, users.username, users.avatar, categories.name FROM topics
							INNER JOIN users
							ON topics.user_id = users.id
							INNER JOIN categories
							ON topics.category_id = categories.id
							WHERE category_id = :category_id
							ORDER BY create_date DESC
							");
		$this->db->bind(':category_id', $category_id);

		return $results = $this->db->resultset();
	  }

	   /*
	  *	Get topics by categories
	  */
	  public function getTopicsByUser($user_id){
		$this->db->query("SELECT topics.*, users.username, users.avatar, categories.name FROM topics
							INNER JOIN users
							ON topics.user_id = users.id
							INNER JOIN categories
							ON topics.category_id = categories.id
							WHERE user_id = :user_id
							ORDER BY create_date DESC
							");
		$this->db->bind(':user_id', $user_id);

		return $results = $this->db->resultset();
	  }


	  /*
	  *  Get Replies for each topic
	  */
	  public function getRepliesById($topic_id){
	  	$this->db->query("SELECT replies.*, users.avatar, users.username FROM replies 
	  					  INNER JOIN users
	  					  ON replies.user_id = users.id 
	  					  WHERE topic_id = :topic_id"
	  					);
	  	$this->db->bind(':topic_id', $topic_id);

	  	return $results = $this->db->resultset();
	  }


	  /*
	  *	Topics Title
	  */
	  public function title($category_id){
		$this->db->query("SELECT * FROM categories WHERE id = :category_id");
		$this->db->bind(':category_id', $category_id);

		return $result = $this->db->single();
	  }

	  /*
	 * Create Topic
	*/
	public function create($data){
		//Insert Query
		$this->db->query("INSERT INTO topics (category_id, user_id, title, body, last_activity)
											VALUES (:category_id, :user_id, :title, :body,:last_activity)");
		//Bind Values
		$this->db->bind(':category_id', $data['category_id']);
		$this->db->bind(':user_id', $data['user_id']);
		$this->db->bind(':title', $data['title']);
		$this->db->bind(':body', $data['body']);
		$this->db->bind(':last_activity', $data['last_activity']);
		//Execute
		if($this->db->execute()){
			return true;
		} else {
			return false;
		}
	}

	  /*
	  *	Get total # of topics
	  */
	  public function totalTopics(){
		$this->db->query("SELECT * FROM topics");
		//Assign Result Set
		$results = $this->db->resultset();
		
		return $count = $this->db->rowCount();
	  }

	  /*
	  *	Get total # of categories
	  */
	  public function totalCategories(){
		$this->db->query("SELECT * FROM categories");
		//Assign Result Set
		$results = $this->db->resultset();
		
		return $count = $this->db->rowCount();
	  }
}

?>