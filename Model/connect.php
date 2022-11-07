<?php
class connect
{
	var $db=null;
	public function __construct() 
	{
		// Kết nối tới database shopgiaydatdat bằng class PDO
		// $dsn='mysql:host=localhost;dbname=shopgiaydatdat';
		// $user='root';
		// $pass='';
		$host = 'mysql-94879-0.cloudclusters.net';
		$db   = 'shopgiaydatdat';
		$user = 'admin';
		$pass = '04MqYC9g';
		$port = "18820";
		$charset = 'utf8';

		$dsn = "mysql:host=$host;dbname=$db;charset=$charset;port=$port";

		$this->db=new PDO($dsn,$user,$pass,array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8"));
	}
//	lấy 1 row
	public function getInstance($select)
	{
		$results=$this->db->query($select);
		$result=$results->fetch();
		return $result;
	}
	
//	Lấy nhiều rows
	public function getList($select)
	{
		$results=$this->db->query($select);
		return($results);
	}

// Thực thi query
	public function exec($query)
	{
		$results=$this->db->exec($query);
		return($results);
	}
	
// Thực thi query với prepare
	public function execP($query)
	{
		$statement=$this->db->prepare($query);
		return $statement;
	}
	
}
?>