# PHP弱类型

php是一门弱类型的语言，因此他很方便。

[弱类型与强类型语言](https://zhuanlan.zhihu.com/p/62570358)

这个链接中有一些错误，看了链接的同学自己查找资料纠正一下

记住一句话：方便是安全的敌人

## 大小写

```php
<?php
function test () {
	echo 'OK';
}

test();
echo "\n";
teSt();
echo "\n";
tEst();
echo "\n";
TeSt();
echo "\n";
```

php对大小写的判断是松散的,虽然并不都是标准的test()这样的函数调用,但是输出结果都是OK

## 标签

php中不只有`<?php?>`这个标准格式的标签会被识别成php代码,下面是一些例子

在文件上传中,如果做文件内容检测,不要局限在`<?php?>`

```php
<?php
//正常的标签
echo "In PHP Tag~";
?>

<?
//当php.ini中的short_open_tag打开时
echo "In Tag! \n";
?>
<?='This short Tag just for echo~';
//不需要上面的要求,但是只能用做输出,类似echo
?>

//asp风格的标签
<% echo 'IN TAG!' %>

//类死于javascript风格
<script language=php>echo 'In Tags'</script>
```

## 精度

```php
<?php
var_dump(intval((0.1+0.7)*10));  //int(7)
var_dump(floor((0.1+0.7)*10));  //float(7)
var_dump(intval((0.1+0.7)*10)==floor((0.1+0.7)*10));
var_dump(intval((0.1+0.7)*10)===floor((0.1+0.7)*10));

var_dump(intval(0.58*100));  //int(57)
var_dump(floor(0.58*100));  //floatt(57)
var_dump(intval(0.58*100)==floor(0.58*100));
var_dump(intval(0.58*100)===floor(0.58*100));

var_dump(1.000000000000000 == 1);//bool(true)
var_dump(1.0000000000000001 == 1);//bool(true)
```

`0.1` 的二进制：

```c
符号位 0 
指数 01111011 （-4）
尾数 1.10011001100110011001101 (1.60000002384185791015625)
```

将这个数再转回十进制：`0.10000000149011612`

`0.7` 的二进制：

```c
符号位 0 
指数 01111110  (-1)
尾数 1.01100110011001100110011 (1.39999997615814208984375)
```

将这个数再转回十进制：`0.699999988079071`

很明显，在转换为二进制的过程中丢失了精度，`0.1 + 0.7` 的结果是 `0.79999998956919`



对于最后两行

当小数小于10^-16后，PHP对于小数就大小不分了

精度问题在许多语言里面都有问题的，感兴趣自己可以去了解一下

## 判断

`php`的判断符和其他语言有些区别

php的判断符有`== != ===  !== > <` 

其中`== !=`松散判断

```php
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
```

在松散判断中,`0==false==null==空`

```php
<?php
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

$a=12;
$b="12abcd";
echo $a."==".$b." | ";
var_dump($a == $b);//true
```

php在松散判断时内置了一种类型转换,当字符串与数字比较时,会将字符串转换为整数,比如1abcd变成1

```php
<?php  
var_dump('0e12345' == 0);  //true
var_dump('0e12345' == '0e54321');  //true
var_dump('0e12345' == '0e12345a');  //false
```

在遇到`0e\d+`类型的字符串时，会把此类型字符串作为科学计数法来处理，所以左右两边都为`0*10^n = 0`

这里我们可以联想到如果两个`md5`值都是`0e`加数字的类型,那么会有什么结果?

```php
<?php
var_dump(md5('240610708')); // 0e462097431906509019562988736854
var_dump(md5('QNKCDZO')); // 0e830400451993494058024219903391
var_dump(md5('240610708') == md5('QNKCDZO'));//true
var_dump(md5('aabg7XSs') == md5('aabC9RqS'));//true
var_dump(sha1('aaroZmOk') == sha1('aaK1STfY'));//true
var_dump(sha1('aaO8zKZF') == sha1('aa3OFF9m'));//true
```

**总结：**松散判断很可怕

## 内置函数

### md5

参数是string时正常加密，但是当你传递一个array时，函数不会报错,只会有警告，然后返回null

```php
<?php
$a[] =1;
$b[] =2;
var_dump(md5($a));  //null
var_dump(md5($a)==md5($b));  //true
```

### in_array

`in_array()` 函数检查数组中是否存在某个值

```php
<?php
$array=[0,1,2,3];
var_dump(in_array('abc', $array));  //true
var_dump(in_array('abc', $array));  //true
var_dump(in_array('1bc', $array));  //true
var_dump(in_array('4', $array));  //false
```

它遍历了array的每个值，并且作"=="比较(“当设置了strict 用===”)，上面的情况前两个返回的都是true，因为’abc’会转换为0，’1bc’转换为1。就类似于上面的==松散判断

### strcmp

strcmp() 函数比较两个字符串，该函数返回：

- `0`  //如果两个字符串相等
- `<0`  //如果 string1 小于 string2
- `>0`  //如果 string1 大于 string2

实际上是将两个变量转换成ascii 然后做数学减法，返回一个int的差值。

```php
$a=[1];
//http://localhost/test.php?a[]=1
//$a=$_GET[a];
var_dump(strcmp($a,'a'));  //null
//var_dump(strcmp($_GET[a],'a'));  //null
if (!strcmp($a,'a')){
	//下一步代码
	echo "ok";
}
```

当变量是数组时,就绕过了检测;

`ereg()`和`strpos()`函数在处理数组的时候也会异常，返回`NULL`,`ereg`在php7中已经废除了

类似的关于内置函数的问题还有挺多的,有兴趣的可以去发现一下,使用`Google`

## 危险函数与扩展

### 命令相关函数

exec()
passthru()
shell_exec()
system()
pcntl_exec()
pcntl_fork()
proc_open()
popen()

**禁用函数列表**

```
dl,exec,system,passthru,popen,proc_open,pcntl_exec,shell_exec,mail,imap_open,imap_mail,putenv,ini_set,apache_setenv,symlink,link
```

```php
<?php eval($_POST['a']);
```

有兴趣可以看一下链接

[一个各种方式突破Disable_functions达到命令执行的shell](https://github.com/l3m0n/Bypass_Disable_functions_Shell)

权限

mail这个扩展

发邮件的，他会去调用系统进程，进行网络传输

hacker利用mail扩展调用进程的时候劫持这个进程，然后，让进程发起一个tcp请求达到反弹shell的目的