<?php  

class Database {

	public $connection;

	function __construct() {
		$this->open_db_connection();
	}

	public function open_db_connection() {
	  $this->connection = new mysqli('localhost', 'root', '', 'blog_db');

	  if($this->connection->connect_errno) {
	  	die("Database connection failed badly" . $this->connection->connect_error);
	  }
	}

	public function query($sql) {
		$result = $this->connection->query($sql);

		$this->confirm_query($result);

		return $result;
	}

	private function confirm_query($result) {
		if(!$result) {
			die("Query failed" . $this->connection->error);
		}
	}

	public function escape_string($string) {
		$escaped_string = $this->connection->real_escape_string($string);
		return $escaped_string;
	}

	public function the_insert_id() {
		return mysqli_insert_id($this->connection);
	}


}

$database = new Database();

?>