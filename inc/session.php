<?php

class Session {
	private $self_file = 'session.php';
	private $mysqli = false;
	
	public function __construct($m) { $this->mysqli = $m; }
	
	public function isLogged() {
		if(!isset($_SESSION['logged']) || !is_array($_SESSION['logged']))
			return false;
		
		if(!isset($_SESSION['logged']['u']) || !isset($_SESSION['logged']['p']))
			return false;
		
		$u = $_SESSION['logged']['u'];
		$p = $_SESSION['logged']['p'];
		
		$prepared = $this->prepare("SELECT count(*) as c FROM users WHERE username=? && password=?", 'isLogged()');
		$this->bind_param($prepared->bind_param('ss', $u, $p), 'isLogged()');
		$this->execute($prepared, 'isLogged()');
		
		$result = $prepared->get_result();
		$row = $result->fetch_object();
		
		if($row->c == 1)
			return true;
		return false;
	}
	
	public function refresh_password($pass) {
		$_SESSION['logged']['p'] = md5($pass);
		return true;
	}
	
	public function login($u, $p) {
		$p = md5($p);
		
		$prepared = $this->prepare("SELECT count(*) as c FROM users WHERE username=? && password=?", 'isLogged()');
		$this->bind_param($prepared->bind_param('ss', $u, $p), 'login()');
		$this->execute($prepared, 'login()');
		
		$result = $prepared->get_result();
		$row = $result->fetch_object();
		
		if($row->c != 1)
			return false;
			
		$_SESSION['logged']['u'] = $u;
		$_SESSION['logged']['p'] = $p;
		
		return true;
	}
	
	public function logout() {
		if(isset($_SESSION['logged']))
			$_SESSION['logged'] = false;
		unset($_SESSION);
		session_destroy();
		return true;
	}
	
	public function get_user_id() {
		$username = $_SESSION['logged']['u'];
		
		$prepared = $this->prepare("SELECT id FROM users WHERE username=?", 'get_user_id()');
		$this->bind_param($prepared->bind_param('s', $username), 'get_user_id()');
		$this->execute($prepared, 'get_user_id()');
		
		$result = $prepared->get_result();
		$row = $result->fetch_object();
		
		return $row->id;
	}
	
	public function get_user_name_by_id($id) {
		$prepared = $this->prepare("SELECT username FROM users WHERE id=?", 'get_user_name_by_id()');
		$this->bind_param($prepared->bind_param('i', $id), 'get_user_name_by_id()');
		$this->execute($prepared, 'get_user_name_by_id()');
		
		$result = $prepared->get_result();
		$row = $result->fetch_object();
		
		return $row->username;
	}
	
	public function get_user_role() {
		$id = $this->get_user_id();
		
		$prepared = $this->prepare("SELECT role FROM users WHERE id=?", 'get_user_role()');
		$this->bind_param($prepared->bind_param('i', $id), 'get_user_role()');
		$this->execute($prepared, 'get_user_role()');
		
		$result = $prepared->get_result();
		$row = $result->fetch_object();
		
		return $row->role;
	}
	
	
	/***
	  *  Private functions
	  *
	***/
	private function prepare($query, $func) {
		$prepared = $this->mysqli->prepare($query);
		if(!$prepared)
			die("Couldn't prepare query. inc/{$this->self_file} - $func");
		return $prepared;
	}
	private function bind_param($param, $func) {
		if(!$param)
			die("Couldn't bind parameters. inc/{$this->self_file} - $func");
		return $param;
	}
	private function execute($prepared, $func) {
		$exec = $prepared->execute();
		if(!$exec)
			die("Couldn't execute query. inc/{$this->self_file} - $func");
		return $exec;
	}
	private function query($query, $func) {
		$q = $this->mysqli->query($query);
		if(!$q)
			die("Couldn't run query. inc/{$this->self_file} - $func");
		return $q;
	}
	public function __destruct() {
		if(is_resource($this->mysqli) && get_resource_type($this->mysqli) == 'mysql link')
			$this->mysqli->close();
	}
}

$_session = new Session($mysqli);