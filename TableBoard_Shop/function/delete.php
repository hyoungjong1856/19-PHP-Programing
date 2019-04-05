<?php
/**
 * Created by PhpStorm.
 * User: kim2
 * Date: 2019-04-04
 * Time: 오전 9:39
 */

# TODO: MySQL DB에서, num에 해당하는 레코드 삭제하기!
$connect = mysql_connect("localhost","khj","111");
// DB 선택
mysql_select_db("khj_db", $connect);

// select 쿼리 스트링 생성
$sql = "select * from tableboard_shop where num = $_GET[num]";

// select 쿼리 스트링 실행
$result = mysql_query($sql, $connect);

$row = mysql_fetch_array($result);

$sql = "delete from tableboard_shop
    where num = $_GET[num];";

$result = mysql_query($sql, $connect);

if($result){
    echo "<script> alert('delete success!!!') </script>";
} else {
    echo "<script> alert('delete - error message') </script>";
}

?>

<script>
    location.replace('../index.php');
</script>
