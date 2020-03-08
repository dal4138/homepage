<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>PHP 프로그래밍 입문</title>
<link rel="stylesheet" type="text/css" href="./css/common.css">
<link rel="stylesheet" type="text/css" href="./css/board.css">
</head>
<body>
<header>
    <?php include "header.php";?>
</header>
<section>
	<div id="main_img_bar">
        <img src="./img/mainCenterImg.jpg">
    </div>
   	<div id="board_box">
	    <h3 class="title">
			게시판 > 내용보기
		</h3>
<?php
    $num  = $_GET["num"];
    $page  = $_GET["page"];

    $con = mysqli_connect("localhost", "root", "123456", "samlpe");
    $sql = "select * from board where num=$num";
    $result = mysqli_query($con, $sql);

    $row = mysqli_fetch_array($result);
    $id      = $row["id"];
    $name      = $row["name"];
    $regist_day = $row["regist_day"];
    $subject    = $row["subject"];
    $content    = $row["content"];
    $file_name    = $row["file_name"];
    $file_type    = $row["file_type"];
    $file_copied  = $row["file_copied"];
    $hit          = $row["hit"];

    $content = str_replace(" ", "&nbsp;", $content);
    $content = str_replace("\n", "<br>", $content);

    $new_hit = $hit + 1;
    $sql = "update board set hit=$new_hit where num=$num";
    mysqli_query($con, $sql);
?>
	    <ul id="view_content">
			<li>
				<span class="col1"><b>제목 :</b> <?=$subject?></span>
				<span class="col2"><?=$name?> | <?=$regist_day?></span>
			</li>
			<li>
				<?php
                    if ($file_name) {
                        $real_name = $file_copied;
                        $file_path = "./data/".$real_name;//관리자 권한을 줘아한다. https://answers.microsoft.com/ko-kr/windows/forum/windows_10-files/%EC%9D%B4-%ED%8C%8C%EC%9D%BC%EC%9D%84-%EB%B3%BC/6e52063c-03cf-4e41-a156-a35f0dbf6bf5
                        $file_size = filesize($file_path);

                        echo "▷ 첨부파일 : $file_name ($file_size Byte) &nbsp;&nbsp;&nbsp;&nbsp;
			       		<a href='board_download.php?num=$num&real_name=$real_name&file_name=$file_name&file_type=$file_type'>[저장]</a><br><br>";
                    }
                ?>

				<?=$content?>
        <?php
          if (strpos($file_type, "image") !== false) {
              echo "&nbsp;&nbsp;&nbsp;&nbsp; <img src='./data/$file_copied'>";
          } else {
              echo "";
          }
         ?>
			</li>
	    </ul>
	    <ul class="buttons">
				<li><button onclick="location.href='board_list.php?page=<?=$page?>'">목록</button></li>

        <?php
        if ($uid === $id) {
            echo "<li><button onclick=\"location.href='board_modify_form.php?num=$num&page=$page'\">수정</button></li>";
            echo "&nbsp";
            echo "<li><button onclick=\"location.href='board_delete.php?num=$num&page=$page'\">삭제</button></li>";
        }?>


				<li><button onclick="location.href='board_form.php'">글쓰기</button></li>
		</ul>
	</div> <!-- board_box -->
</section>
<footer>
    <?php include "footer.php";?>
</footer>
</body>
</html>
