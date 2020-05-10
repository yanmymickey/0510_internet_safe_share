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