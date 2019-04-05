<?php
/**
 * Created by PhpStorm.
 * User: HyoungJong
 * Date: 2019-03-28
 * Time: 오후 2:22
 */

$connect = mysql_connect("localhost","khj","111");
mysql_select_db("khj_db", $connect);

$sql = "select * from business_card where name=$_POST[name]";
$result = mysql_query($sql, $connect);

$row = mysql_fetch_array($result);

//if(!$row){
    $sql = "insert into business_card(name, password, email, company, side, job, blog_url, facebook_id, twitter_id, github_id) 
    values('$_POST[name]', '$_POST[password]', '$_POST[email]', '$_POST[company]', '$_POST[side]', '$_POST[job]', '$_POST[blog_url]', '$_POST[facebook_id]', '$_POST[twitter_id]', '$_POST[github_id]');";

$result = mysql_query($sql, $connect);

if(!$result){
    echo "<script> alert('에러입니다!!'); </script>";
}
//}

mysql_close();
?>

<script>
    location.href = "login_form.php";
</script>
