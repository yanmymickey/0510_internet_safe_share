<?php
$mysql=new  mysqli('127.0.0.1','root','root','sql_injection');
$username=$_POST['username'];
$password=$_POST['password'];
$type=$_GET['type'];
if (!$type){
	echo "please 'get' a type";
}
//var_dump($username);
//var_dump($password);
if ($type==='register'){
	$result=$mysql->query("INSERT INTO `users`(`username`, `password`) VALUES ($username,$password)");
	var_dump($result);
}

if ($type=='login'){
	$sql="SELECT * FROM users WHERE username='$username' AND password='$password'";
	$result= $mysql->query($sql);
	echo "your sql query stings is:$sql"."<br/>".PHP_EOL;
	var_dump($result);
	$row=$result->fetch_row();
	//	echo "hello ".$result[''];
	var_dump($row);
	echo '<br/>'.PHP_EOL;
	echo "hello $row[1]";
}
