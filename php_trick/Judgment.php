<?php
$a = null;
$b = '';
echo $a."==".$b." | ";
var_dump($a == $b);//true

$a = null;
$b = false;
echo $a."==".$b." | ";
var_dump($a == $b);//true

$a = 0;
$b = false;
echo $a."==".$b." | ";
var_dump($a == $b);//true

$a = 0;
$b = null;
echo $a."==".$b." | ";
var_dump($a == $b);//true

$a = [];
$b = null;
echo $a."==".$b." | ";
var_dump($a == $b);//true

$a = 0;
$b = '0';
echo $a."=='".$b."' | ";
var_dump($a == $b);//true

$a = 0;
$b = '0';
echo $a."==='".$b."' | ";
var_dump($a === $b);//false

$a = 0;
$b = 'string';
echo $a."==".$b." | ";
var_dump($a == $b);//true
//如果字符串前面有数比如1abcd,那么他就会内置转换为1
//如果字符串没有数,他就会转换为0

$a=12;
$b="12abcd";
echo $a."==".$b." | ";
var_dump($a == $b);//true

//nen
var_dump('0e12345' == 0);  //true
var_dump('0e12345' == '0e54321');  //true
var_dump('0e12345' == '0e12345a');  //false



var_dump(md5('240610708')); // 0e462097431906509019562988736854

var_dump(md5('QNKCDZO')); // 0e830400451993494058024219903391

var_dump(md5('240610708') === md5('QNKCDZO'));//true

var_dump(md5('aabg7XSs') === md5('aabC9RqS'));//true

var_dump(sha1('aaroZmOk') === sha1('aaK1STfY'));//true

var_dump(sha1('aaO8zKZF') === sha1('aa3OFF9m'));//true