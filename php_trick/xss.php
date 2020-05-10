<?php

setcookie("user","admin");

$msg=$_POST['msg'];
//存储型
$mysql=new  mysqli('127.0.0.1','root','root','sql_injection');
$insert=$mysql->query("INSERT INTO `xss`(`msg`) VALUES ('$msg')");
var_dump($insert);
$result=$mysql->query("SELECT * FROM `xss`");
if ($result->num_rows > 0) {
	// 输出数据
	while($row = $result->fetch_assoc()) {
		echo "id: " . $row["id"]. " - msg: " . $row["msg"]."<br>";
	}
} else {
	echo "0 结果";
}

//反射型
//echo $msg;

//dom型
//和反射型差不多,利用你注入的代码去操作dom
