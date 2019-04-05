<?php
/**
 * Created by PhpStorm.
 * User: kim2
 * Date: 2019-04-04
 * Time: 오전 9:39
 */

# TODO: MySQL DB에서, POST로 받아온 내용 입력하기!
// MySQL 데이터베이스 연결
$connect = mysql_connect("localhost","khj","111");
// DB 선택
mysql_select_db("khj_db", $connect);

// select 쿼리 스트링 생성
$sql = "select * from tableboard_shop where num = $_GET[num]";

// select 쿼리 스트링 실행
$result = mysql_query($sql, $connect);

$row = mysql_fetch_array($result);

$sql = "insert into tableboard_shop(date, order_id, name, price, quantity) 
    values('$_POST[date]', '$_POST[order_id]', '$_POST[name]', '$_POST[price]', '$_POST[quantity]');";

$result = mysql_query($sql, $connect);

if($result){
    echo "<script> alert('insert success!!!') </script>";
} else {
    echo "<script> alert('insert - error message') </script>";
}

?>

<script>
    location.replace('../index.php');
</script>
