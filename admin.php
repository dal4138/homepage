<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>PHP 프로그래밍 입문</title>
<link rel="stylesheet" type="text/css" href="./css/common.css">
<link rel="stylesheet" type="text/css" href="./css/admin.css">
</head>
<body>
<header>
    <?php include "header.php";?>
</header>
<section>
   	<div id="admin_box">
	    <h3 id="member_title">
	    	관리자 모드 > 회원 관리
		</h3>
	    <ul id="member_list">
				<li>
					<span class="col1">아이디</span>
					<span class="col2">이름</span>
					<span class="col3">주민번호</span>
					<span class="col4">레벨</span>
					<span class="col5">포인트</span>
					<span class="col6">메일 주소</span>
					<span class="col7">수정</span>
					<span class="col8">삭제</span>
				</li>
<?php
    $con = mysqli_connect("localhost", "root", "123456", "samlpe");
    $sql = "select * from members";
    $result = mysqli_query($con, $sql);
    $total_record = mysqli_num_rows($result); // 전체 회원 수

    $number = $total_record;

   while ($row = mysqli_fetch_array($result)) {
     //세션값이랑 겹침 수정 할 부분
       $id=$row["uid"];
       $mail=$row["umail"];
       $name=$row["uname"];
       $level=$row["userlevel"];
       $point=$row["userpoint"];
       $num1=$row["unum1"]; ?>

		<li>
		<form method="post" action="admin_member_update.php?uid=<?=$uid?>">
      <!-- num 값이 hidden input 타입이 더 좋았을것을 -->
			<span class="col1"><?=$id?></span>
			<span class="col2"><?=$name?></a></span>
			<span class="col3"><?=$num1?></span>
			<span class="col4"><input type="text" name="userlevel" value="<?=$level?>"></span>
			<span class="col5"><input type="text" name="userpoint" value="<?=$point?>"></span>
			<span class="col6"><?=$mail?></span>
			<span class="col7"><button type="submit">수정</button></span>
			<span class="col8"><button type="button" onclick="location.href='admin_member_delete.php?uid=<?=$id?>'">삭제</button></span>
		</form>
		</li>

<?php
       $number--;
   }
?>
	    </ul>
	    <h3 id="member_title">
	    	관리자 모드 > 게시판 관리
		</h3>
	    <ul id="board_list">
		<li class="title">
			<span class="col1">선택</span>
			<span class="col2">번호</span>
			<span class="col3">이름</span>
			<span class="col4">제목</span>
			<span class="col5">첨부파일명</span>
			<span class="col6">작성일</span>
		</li>
		<form method="post" action="admin_board_delete.php">
<?php
    $sql = "select * from board order by num desc";
    $result = mysqli_query($con, $sql);
    $total_record = mysqli_num_rows($result); // 전체 글의 수

    $number = $total_record;

   while ($row = mysqli_fetch_array($result)) {
       $num         = $row["num"];
       $name        = $row["name"];
       $subject     = $row["subject"];
       $file_name   = $row["file_name"];
       $regist_day  = $row["regist_day"];
       $regist_day  = substr($regist_day, 0, 10)
?>
		<li>
			<span class="col1"><input type="checkbox" name="item[]" value="<?=$num?>"></span>
			<span class="col2"><?=$number?></span>
			<span class="col3"><?=$name?></span>
			<span class="col4"><?=$subject?></span>
			<span class="col5"><?=$file_name?></span>
			<span class="col6"><?=$regist_day?></span>
		</li>
<?php
       $number--;
   }
   mysqli_close($con);
?>
				<button type="submit">선택된 글 삭제</button>
			</form>
	    </ul>
	</div> <!-- admin_box -->
</section>
<footer>
    <?php include "footer.php";?>
</footer>
</body>
</html>
