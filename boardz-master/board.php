<!-- 구글 검색 : galley board css => CSS Only Pinterest-like Responsive Board Layout - Boardz.css | CSS ... -->
<!-- 출처 : https://www.cssscript.com/css-pinterest-like-responsive-board-layout-boardz-css/ -->
<?php
# TODO: MySQL 데이터베이스 연결 및 레코드 가져오기!
// MySQL 데이터베이스 연결
$connect = mysql_connect("localhost","khj","111");
// DB 선택
mysql_select_db("khj_db", $connect);

$sql = "select * from boardz where title like '%$_GET[search]%'";

// select 쿼리 스트링 실행
$result = mysql_query($sql, $connect);

$dataNum = 0;

while($row = mysql_fetch_array($result)){
    $dataNum++;
}
?>

<!doctype html>

<html lang="en">
<head>
    <meta charset="UTF-8"> 

    <title>Boardz Demo</title>
    <meta name="description" content="Create Pinterest-like boards with pure CSS, in less than 1kB.">
    <meta name="author" content="Burak Karakan">
    <meta name="viewport" content="width=device-width; initial-scale = 1.0; maximum-scale=1.0; user-scalable=no" />
    <link rel="stylesheet" href="src/boardz.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/wingcss/0.1.8/wing.min.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>
    <div class="seventyfive-percent  centered-block">
        <!-- Sample code block -->
        <div>    
            <hr class="seperator">

            <!-- Example header and explanation -->
            <div class="text-center">
                <h2>Beautiful <strong>Boardz</strong></h2>
                <div style="display: block; width: 50%; margin-right: auto; margin-left: auto; position: relative;">
                    <form class="example" method="get" action="board.php">
                        <input type="text" placeholder="Search.." name="search">
                        <button type="submit"><i class="fa fa-search"></i></button>
                    </form>
                </div>
            </div>

            <!--<hr class="seperator fifty-percent">-->

            <!-- Example Boardz element. -->
            <div class="boardz centered-block beautiful">
                <?php
                $result = mysql_query($sql, $connect); // 위에서 while문으로 사용해서 새로 값 불러옴

                $colNumCount = 1; // 열을 구분할 때 쓰기위해 현재 열에 자료가 몇개있는지 나타내는 값
                $colIndex = 0; // 현재 몇번째 열인지 나타내는 인덱스 값
                $maxCol = $dataNum; // 총 데이터 개수(튜플 수)에 따른 출력할 때 표현할 열의 개수 설정
                if($dataNum > 3) // 최대 열은 3까지
                    $maxCol = 3;

                switch($maxCol){ // 열 개수(1~3)에 따라, 다음 열로 넘어가기 위해 필요한 데이터 개수(튜플 수)를 저장해 놓은 배열설정
                    case 1:
                        $nextColNum = array(1); // 데이터 개수가 1개면 열은 1개
                        break;
                    case 2:
                        $nextColNum = array(1,1); // 데이터 개수가 2개면 열은 2개
                        break;
                    case 3:
                        if($dataNum % 3 == 1) // 열 개수가 3개이고 전체 데이터를 3으로 나눴을 때 나머지가 1일 때(ex.4, 7),
                            // 각각의 열에 존재하는 데이터 개수는 3으로 나눈 값에 (올림,내림,내림)한 값이다
                            // ex) 7 일경우 3으로 나눈값은 2.333, 첫번째열~세번째열에 존재하는 데이터 수는
                            // ((올림)2.3, (내림)2.3, (내림)2.3)인 (3개,2개,2개)이다.
                            // 아래도 이와같은 규칙으로 설정하였다.
                            $nextColNum = array(ceil($dataNum / 3), floor($dataNum / 3), floor($dataNum / 3));
                        else if($dataNum % 3 == 2)
                            $nextColNum = array(ceil($dataNum / 3), ceil($dataNum / 3), floor($dataNum / 3));
                        else
                            $nextColNum = array($dataNum / 3, $dataNum / 3, $dataNum / 3);
                        break;
                }

                while($row = mysql_fetch_array($result)){
                    if($colNumCount == 1){
                        echo "<ul>";
                    }

                    echo "<li>";
                    echo "<h1>$row[title]</h1>";
                    echo "$row[contents]";
                    echo "<img src=\"$row[image_url]\" alt=\"demo image\"/>";
                    echo "</li>";

                    if($colNumCount == $nextColNum[$colIndex]){ // 현재 열에 있어야할 데이터 개수만큼 채워지면 다음 열로 이동
                        echo "</ul>";
                        $colNumCount = 0;
                        $colIndex++;
                    }
                    $colNumCount++;
                };
                ?>

            </div>
        </div>

        <hr class="seperator">

    </div>
</body>
</html>