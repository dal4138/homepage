<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>sammy</title>
<link rel="stylesheet" type="text/css" href="./css/common.css">
<link rel="stylesheet" type="text/css" href="./css/member.css">

<style media="screen">
  body {
    color: lightslategrey;
    width: 100%;
  }
  table{
    border-collapse: collapse;
    width: 800px;
  }
  a{
    color: coral;
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
    font-size: 15px;
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

    // ------------ 이메일 -----------

    if (!check(re, id, "아이디는 4~12자의 영문 대소문자와 숫자로만 입력")) {
      return false;
    }

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

    // -------------- 주민번호 -------------

    for (var i = 0; i < num1.value.length; i++) {
      arrNum1[i] = num1.value.charAt(i);
    } // 주민번호 앞자리를 배열에 순서대로 담는다.

    for (var i = 0; i < num2.value.length; i++) {
      arrNum2[i] = num2.value.charAt(i);
    } // 주민번호 뒷자리를 배열에 순서대로 담는다.

    var tempSum = 0;

    for (var i = 0; i < num1.value.length; i++) {
      tempSum += arrNum1[i] * (2 + i);
    } // 주민번호 검사방법을 적용하여 앞 번호를 모두 계산하여 더함(https://coding-factory.tistory.com/195)

    for (var i = 0; i < num2.value.length - 1; i++) {
      if (i >= 2) {
        tempSum += arrNum2[i] * i;
      } else {
        tempSum += arrNum2[i] * (8 + i);
      }
    } // 같은방식으로 앞 번호 계산한것의 합에 뒷번호 계산한것을 모두 더함

    if ((11 - (tempSum % 11)) % 10 != arrNum2[6]) {
      alert("올바른 주민번호가 아닙니다.");
      num1.value = "";
      num2.value = "";
      num1.focus();
      return false;
    }

    // ------------ 생일 자동 등록 -----------

    if (arrNum2[0] == 1 || arrNum2[0] == 2) {
      var y = parseInt(num1.value.substring(0, 2));
      var m = parseInt(num1.value.substring(2, 4));
      var d = parseInt(num1.value.substring(4, 6));
      join.year.value = 1900 + y;
      join.month.value = m;
      join.day.value = d;
    } else if (arrNum2[0] == 3 || arrNum2[0] == 4) {
      var y = parseInt(num1.value.substring(0, 2));
      var m = parseInt(num1.value.substring(2, 4));
      var d = parseInt(num1.value.substring(4, 6));
      join.year.value == 2000 + y;
      join.month.value = m;
      join.day.value = d;
    }
    // 약관 동의여부
    if (join.contacts[0].checked == false ||
      join.contacts[1].checked == false ||
      join.contacts[2].checked == false) {
      alert("약관에 모두 동의해주세요");
      return false;
    }

    if (join.self.value == "") {
      alert("자기소개를 먼저 적어주세요");
      join.self.focus();
      return false;
    }

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
  function check_id() {
     window.open("member_check_id.php?uid=" + document.join.uid.value,
         "IDcheck",
          "left=700,top=300,width=300,height=150,scrollbars=no,resizable=yes");
   }
</script>

</head>
<body>
	<header>
    	<?php include "header.php";?>
    </header>
	<section>
		<div id="main_img_bar"><img src="./img/terarosa10.jpg"></div>
        <div id="main_content">
      		<div id="join_box">
            <form name="join" onsubmit="return validate();" method="post" action="member_insert.php"><br>
        <table border="1" align="center">
          <tr>
            <td colspan="2" align="left" height=50px><b>*회원 기본 정보</b></td>
          </tr>

          <tr>
            <td align="center"><b>아이디:</td>
            <td><input type="text" name="uid" id="uid" size="20" maxlength="12"  value="ysm2678"><a href="#"><img src="./img/check_id.gif" onclick="check_id()"></a></input><em>4~12자의 영문 대소문자와 숫자로만 입력</em>
            <p id="idSubMsg"></p> </td>
          </tr>

          <tr>
            <td align="center"><b>비밀번호:</td>
            <td><input type="password" name="upw" id="upw" size="21" maxlength="12" value="123456"></input><em>4~12자의 영문 대소문자와 숫자로만 입력</em></td>
          </tr>

          <tr>
            <td align="center"><b>비밀번호확인:</td>
            <td><input type="password" name="checkupw" id="checkupw" size="21" maxlength="12" value="123456"></td>
          </tr>

          <tr>
            <td align="center"><b>메일주소:</td>
            <td><input type="text" name="umail" id="umail" size="25" value="ysm@gmail.com"></input><em>ex) sammy@gmail.com</em></td>
          </tr>

          <tr>
            <td align="center"><b>이름:</td>
            <td><input type="text" name="uname" id="uname" size="25" value="sammy"></input></td>
          </tr>

          <tr>
            <td colspan="2" height=50px><b>*개인 신상 정보</b></td>
          </tr>

          <tr>
            <td align="center"><b>주민등록번호:</td>
            <td><input type="text" name="unum1" id="unum1" size="10" maxlength="6" value="900502">-</input><input type="password" name="unum2" id="unum2" size="10" maxlength="7" value="2481811"></input>
              <em>ex) 123456-1234567</em>
            </td>
          </tr>

          <tr>
            <td align="center"><b>생일:</td>
            <td><input type="text" name="year" id="year" size="7" value="1990"></input>년
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
            </td>
          </tr>

          <tr>
            <td align="center"><b>자기소개</td>
            <td><textarea rows="5" cols="80" name="self" id="self">안녕</textarea></td>
          </tr>
          <tr>
            <td align="center"><b>약관동의</td>
            <td>
              <input type="checkbox" name="contacts" checked>만 14세 이상입니다.</input><br>
              <input type="checkbox" name="contacts" checked>이용약관 동의 <a href="#">내용보기</a></input><br>
              <input type="checkbox" name="contacts" checked>개인정보 수집 및 이용 동의 <a href="#">내용보기</a></input>
            </td>
          </tr>
        </table>
    <div id="divButton">
      <p align="center">
        <input type="submit" name="submit" value="회원 가입"></input>
        <input type="reset" name="reset" value="다시 입력"></input>
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
