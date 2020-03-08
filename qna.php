<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Hell</title>
<link rel="shortcut icon" href="./img/drop.png">
<link rel="stylesheet" href="./css/common.css">
<link rel="stylesheet" href="./css/greet.css">
<link rel="stylesheet" href="./css/normalize.css">
<link rel="stylesheet" href="./css/main.css">
<script src="./js/vendor/modernizr.custom.min.js"></script>
<script src="./js/vendor/jquery-1.10.2.min.js"></script>
<script src="./js/vendor/jquery-ui-1.10.3.custom.min.js"></script>
<script src="./js/main.js"></script>
</head>
<body>
	<header>
    	<?php include "header.php";?>
    </header>
	<section>
		<div class="slideshow">
			<div class="slideshow_slides">
				<a href="#"><img src="./img/test1.jfif" alt="slide1"> </a>
				<a href="#"><img src="./img/test2.jfif" alt="slide2"> </a>
				<a href="#"><img src="./img/test3.jpg" alt="slide3"> </a>
				<a href="#"><img src="./img/test4.jfif" alt="slide4"> </a>
				<a href="#"><img src="./img/test5.jfif" alt="slide4"> </a>
				<a href="#"><img src="./img/test6.jfif" alt="slide4"> </a>
			</div>
			<div class="slideshow_nav">
				<a href="#" class="prev">prev</a>
				<a href="#" class="next">next</a>
			</div>
			<div class="slideshow_indicator">
				<a href="#">&nbsp;</a>
				<a href="#">&nbsp;</a>
				<a href="#">&nbsp;</a>
				<a href="#">&nbsp;</a>
				<a href="#">&nbsp;</a>
				<a href="#">&nbsp;</a>
			</div>
		</div>
    <?php
    include $_SERVER['DOCUMENT_ROOT']."/ansisung/lib/db_connector.php";
    include $_SERVER['DOCUMENT_ROOT']."/ansisung/lib/create_table.php";

    create_table($conn,'qna');//가입인사게시판테이블생성

    define('SCALE', 10);
    //*****************************************************
    $sql=$result=$total_record=$total_page=$start="";
    $row="";
    $memo_id=$memo_num=$memo_date=$memo_nick=$memo_content="";
    $total_record=0;
    //*****************************************************

    if(isset($_GET["mode"])&&$_GET["mode"]=="search"){
      //제목, 내용, 아이디
      $find = test_input($_POST["find"]);
      $search = test_input($_POST["search"]);
      $q_search = mysqli_real_escape_string($conn, $search);
      $sql="SELECT * from `qna` where $find like '%$q_search%' order by num desc;";
    }else{
      $sql="SELECT * from `qna` order by group_num desc, ord asc;";
    }

    $result=mysqli_query($conn,$sql);
    $total_record=mysqli_num_rows($result);
    $total_page=($total_record % SCALE == 0 )?
    ($total_record/SCALE):(ceil($total_record/SCALE));

    //2.페이지가 없으면 디폴트 페이지 1페이지
    if(empty($_GET['page'])){
      $page=1;
    }else{
      $page=$_GET['page'];
    }

    //3.현재페이지 시작번호계산함.
    $start=($page -1) * SCALE;
    //4. 리스트에 보여줄 번호를 최근순으로 부여함.
    $number = $total_record - $start;
    ?>
    <div id="wrap">
      <div id="content">
         <div id="list_content">
         <?php
          for ($i = $start; $i < $start+SCALE && $i<$total_record; $i++){
            mysqli_data_seek($result,$i);
            $row=mysqli_fetch_array($result);
            $num=$row['num'];
            $id=$row['id'];
            $name=$row['name'];
            $nick=$row['nick'];
            $hit=$row['hit'];
            $date= substr($row['regist_day'],0,10);
            $subject=$row['subject'];
            $subject=str_replace("\n", "<br>",$subject);
            $subject=str_replace(" ", "&nbsp;",$subject);
            $depth=(int)$row['depth'];//공간을 몆칸을 띄어야할지 결정하는 숫자임
            $space="";
            for($j=0;$j<$depth;$j++){
              $space="&nbsp;&nbsp;".$space;
            }
        ?>
            <div id="list_item">
              <div id="list_item1"><?=$number?></div>
              <div id="list_item2">
                  <a href="./view.php?num=<?=$num?>&page=<?=$page?>&hit=<?=$hit+1?>"><?=$space.$subject?></a>
              </div>
              <div id="list_item3"><?=$id?></div>
              <div id="list_item4"><?=$date?></div>
              <div id="list_item5"><?=$hit?></div>
            </div><!--end of list_item -->
            <div id="memo_content"><?=$memo_content?></div>
        <?php
            $number--;
         }//end of for
        ?>
				<div id="page_button">
          <div id="page_num">이전◀ &nbsp;&nbsp;&nbsp;&nbsp;
          <?php
            for ($i=1; $i <= $total_page ; $i++) {
              if($page==$i){
                echo "<b>&nbsp;$i&nbsp;</b>";
              }else{
                echo "<a href='./list.php?page=$i'>&nbsp;$i&nbsp;</a>";
              }
            }
          ?>
          &nbsp;&nbsp;&nbsp;&nbsp;▶ 다음
          <br><br><br><br><br><br><br>
        </div><!--end of page num -->
        <div id="button">
          <!--목록 버튼  -->
          <a href="./qna.php?page=<?=$page?>"> <img src="./img/list.png" alt="">&nbsp;</a>
          <?php
            //세션아디가 있으면 글쓰기 버튼을 보여줌.
            if(!empty($_SESSION['uid'])){
            echo '<a href="write_edit_form.php"><img src="./img/write.png"></a>';
            }
          ?>
        </div><!--end of button -->
      </div><!--end of page button -->
      </div><!--end of list content -->

      </div><!--end of col2  -->
      </div><!--end of content -->
    </div><!--end of wrap  -->
	</section>
	<footer>
    	<?php include "footer.php";?>
    </footer>
</body>
</html>
