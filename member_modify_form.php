<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Sammy's Website</title>
<link rel="stylesheet" type="text/css" href="./css/common.css">
<link rel="stylesheet" type="text/css" href="./css/member.css">

<style media="screen">
  body {
    color: lightslategrey;
    width: 100%;
  }
  table{
    border: 8px solid lavenderblush;
    border-collapse: collapse;
    width: 800px;
    font-size: 13px;
  }
  a{
    color: blue;
  }
  #main_content{
    height: 600px;
  }
  #divButton{
    margin: auto;
    width: 820px;
    padding-top: 20px;
  }
  em{
    font-size: 10px;
  }

  #unum1, #unum2, #year, #month, #day{
    background-color: gray;
  }

</style>

<script language="javascript">
  function validate() {
    var re = /^[a-zA-Z0-9]{4,12}$/ // 아이디와 패스워드가 적합한지 검사할 정규식
    var re2 = /^[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*.[a-zA-Z]{2,3}$/i;
    // 이메일이 적합한지 검사할 정규식
    var id = document.getElementById("uid");
    var pw = document.getElementById("upw");
    var umail = document.getElementById("umail");
    var num1 = document.getElementById("unum1");
    var num2 = document.getElementById("unum2");

    var arrNum1 = new Array(); // 주민번호 앞자리숫자 6개를 담을 배열
    var arrNum2 = new Array(); // 주민번호 뒷자리숫자 7개를 담을 배열

    if (!check(re, pw, "패스워드는 4~12자의 영문 대소문자와 숫자로만 입력")) {
      return false;
    }

    if (join.upw.value != join.checkupw.value) {
      alert("비밀번호가 다릅니다. 다시 확인해 주세요.");
      join.checkupw.value = "";
      join.checkupw.focus();
      return false;
    }

    if (umail.value == "") {
      alert("이메일을 입력해 주세요");
      umail.focus();
      return false;
    }

    if (!check(re2, umail, "적합하지 않은 이메일 형식입니다.")) {
      return false;
    }

    if (join.uname.value == "") {
      alert("이름을 입력해 주세요");
      join.uname.focus();
      return false;
    }

    if (join.self.value == "") {
      alert("자기소개를 먼저 적어주세요");
      join.self.focus();
      return false;
    }
    document.join.submit();

  }

  function check(re, what, message) {
    if (re.test(what.value)) {
      return true;
    }
    alert(message);
    what.value = "";
    what.focus();
    //return false;
  }

</script>

</head>
<body>
	<header>
    	<?php include "header.php";?>
    </header>
<?php
    $con = mysqli_connect("localhost", "root", "123456", "samlpe");
    $sql    = "select * from members where uid='$uid'";
    $result = mysqli_query($con, $sql);
    $row    = mysqli_fetch_array($result);

        $upw = $row["upw"];
        $umail = $row["umail"];
        $uname = $row["uname"];
        $unum1 = $row["unum1"];
        $byear = $row["byear"];
        $bmonth = $row["bmonth"];
        $bday = $row["bday"];
        $self = $row["self"];

    mysqli_close($con);
?>
	<section>
		<div id="main_img_bar">
            <img src="./img/mainCenterImg.jpg">
        </div>
				<div id="main_content">
      		<div id="join_box">
            <form name="join" method="post" action="member_modify.php?uid=<?=$uid?>"><br>
        <table border="1" align="center">
          <tr>
            <td colspan="2" align="left" height=50px><b>*회원 기본 정보</b></td>
          </tr>

          <tr>
            <td align="center"><b>아이디:</td>
            <td><input type="text" name="uid" id="uid" value="<?=$uid?>" readonly>&nbsp #수정불가능항목입니다</input>
          </tr>

          <tr>
            <td align="center"><b>비밀번호:</td>
            <td><input type="password" name="upw" id="upw" size="21" maxlength="12"></input><span>&nbsp #4~12자의 영문 대소문자와 숫자로만 입력</span></td>
          </tr>

          <tr>
            <td align="center"><b>비밀번호확인:</td>
            <td><input type="password" name="checkupw" id="checkupw" size="21" maxlength="12" ></td>
          </tr>

          <tr>
            <td align="center"><b>메일주소:</td>
            <td><input type="text" name="umail" id="umail" size="25" value="<?=$umail?>"></input><span>&nbsp #ex) sammy@gmail.com</span></td>
          </tr>

          <tr>
            <td align="center"><b>이름:</td>
            <td><input type="text" name="uname" id="uname" size="25" value="<?=$uname?>"></input></td>
          </tr>

          <tr>
            <td colspan="2" height=50px><b>*개인 신상 정보</b></td>
          </tr>

          <tr>
            <td align="center"><b>주민등록번호:</td>
            <td><input type="text" name="unum1" id="unum1" size="10" maxlength="6" value="<?=$unum1?>" readonly>-</input><input type="password" name="unum2" id="unum2" size="10" maxlength="7" value="*******" readonly>
              <span>&nbsp #수정불가능항목입니다.</span>
            </input>

            </td>
          </tr>

          <tr>
            <td align="center"><b>생일:</td>
            <td><input type="text" name="year" id="year" size="7" value="<?=$byear?>"></input>년
              <select name="month" id="month">
                <OPTION>1</OPTION>
                <OPTION>2</OPTION>
                <OPTION>3</OPTION>
                <OPTION>4</OPTION>
                <OPTION>5</OPTION>
                <OPTION>6</OPTION>
                <OPTION>7</OPTION>
                <OPTION>8</OPTION>
                <OPTION>9</OPTION>
                <OPTION>10</OPTION>
                <OPTION>11</OPTION>
                <OPTION>12</OPTION>
              </SELECT>월
              <select name="day" id="day">
                <OPTION>1</OPTION>
                <OPTION>2</OPTION>
                <OPTION>3</OPTION>
                <OPTION>4</OPTION>
                <OPTION>5</OPTION>
                <OPTION>6</OPTION>
                <OPTION>7</OPTION>
                <OPTION>8</OPTION>
                <OPTION>9</OPTION>
                <OPTION>10</OPTION>
                <OPTION>11</OPTION>
                <OPTION>12</OPTION>
                <OPTION>13</OPTION>
                <OPTION>14</OPTION>
                <OPTION>15</OPTION>
                <OPTION>16</OPTION>
                <OPTION>17</OPTION>
                <OPTION>18</OPTION>
                <OPTION>19</OPTION>
                <OPTION>20</OPTION>
                <OPTION>21</OPTION>
                <OPTION>22</OPTION>
                <OPTION>23</OPTION>
                <OPTION>24</OPTION>
                <OPTION>25</OPTION>
                <OPTION>26</OPTION>
                <OPTION>27</OPTION>
                <OPTION>28</OPTION>
                <OPTION>29</OPTION>
                <OPTION>30</OPTION>
                <OPTION>31</OPTION>
              </select>일
              <span>&nbsp #수정불가능항목입니다.</span>
            </td>
          </tr>

          <tr>
            <td align="center"><b>자기소개</td>
            <td><textarea rows="5" cols="80" name="self" id="self"><?=$self?></textarea></td>
          </tr>
        </table>
    <div id="divButton">
      <p align="center">
        <!-- <input type="submit" name="submit" onclick="validate()" value="수정 완료"></input> -->
        <!-- <img style="cursor:pointer" src="./img/button_save.gif" onclick="validate()"> -->
        <button type="button" name="button" onclick="validate()">수정완료</button>
      </p>
    </div>
        	</div> <!-- join_box -->
        </div> <!-- main_content -->
	</section>
	<footer>
    	<?php include "footer.php";?>
    </footer>
</body>
</html>
