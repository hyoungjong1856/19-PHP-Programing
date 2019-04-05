# TableBoard_Shop
게시판-Shop 의 TODO 완성하기!

## 기존 파일
```
 .
├── css - board_form.php와 index.php 에서 사용하는 stylesheet
│   └── ...
├── fonts - 폰트
│   └── ...
├── images - 아이콘 이미지
│   └── ...
├── vender - 외부 라이브러리
│   └── ...
├── js - board_form.php와 index.php 에서 사용하는 javascript
│   └── ...
├── function
│   └── insert.php - 게시글 작성 기능 구현
│   └── update.php - 게시글 수정 기능 구현
│   └── delete.php - 게시글 삭제 기능 구현
├── board_form.php - 게시글 작성/수정 시 사용하는 form이 포함된 php 파일
├── index.php - 게시글 조회 기능 구현
```

## MySQL 테이블 생성!

[여기에 테이블 생성 시, 사용한 Query 를 작성하세요.]
Note: 
- table 이름은 tableboard_shop 으로 생성
- 기본키는 num 으로, 그 외의 속성은 board_form.php 의 input 태그 name 에 표시된 속성 이름으로 생성
- 각 속성의 type 은 자유롭게 설정 (단, 입력되는 값의 타입과 일치해야 함)
    - ex) price -> int
    - ex) name -> char or varchar

## 공통사항
// MySQL 데이터베이스 연결
$connect = mysql_connect("localhost","khj","111");
// DB 선택
mysql_select_db("khj_db", $connect);

// select 쿼리 스트링 생성
$sql = "select * from tableboard_shop";
// select 쿼리 스트링 실행
$result = mysql_query($sql, $connect);

## index.php 수정
화면에 하나하나 항목을 추가하는 부분을 제거하고
while문을 통해 DB에서 가져온 데이터를 한줄한줄 불러와 각각 이름에 맞게
출력하였고, 총합의 경우는 가격과 개수 변수를 만들어 곱한 값이 출력되게하였다.

## board_form.php 수정
특정 튜플을 클릭했을 때 받아온 num값을 이용해 DB에서 일치하는 num값의 데이터들을
출력하게 하였다.

## function
### insert.php 수정
입력받는 값이 date, order_id, name, price, quantity이므로 
DB에서 테이블에 자료를 넣는 insert into문을 사용하여 POST형식으로 입력받은 값을
DB에 저장하였다.

### update.php 수정
클릭한 특정 튜플의 num값에 맞는 데이터에서 튜플 내용을 수정하는
update set문을 이용하여 POST형식으로 입력받은 값을 DB에 저장하였다.

### delete.php 수정
클릭한 특정 튜플의 num값에 맞는 데이터에서 튜플을 제거하는
delete from을 이용하여 num값에 맞는 튜플을 DB에서 제거하였다.
