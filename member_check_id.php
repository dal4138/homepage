<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>I D C H E C K</title>
<style>
h3 {
   padding-left: 10px;
   border-left: solid 10px black;
}
#close {
   cursor:pointer;
   margin-left: 280px;
}
</style>
</head>
<body>
<h3>아이디 중복체크</h3>
<p>
<?php
   $uid = $_GET["uid"];

   if (!$uid) {
       echo("<li>아이디를 입력해 주세요!</li>");
   } else {
       $con = mysqli_connect("localhost", "root", "123456", "samlpe");

       $sql = "select * from members where uid='$uid'";
       $result = mysqli_query($con, $sql);

       $num_record = mysqli_num_rows($result);

       if ($num_record) {
           echo "<li>".$uid." 아이디는 중복됩니다.</li>";
           echo "<li>다른 아이디를 사용해 주세요!</li>";
       } else {
           echo "<li>".$uid." 아이디는 사용 가능합니다.</li>";
       }

       mysqli_close($con);
   }
?>
</p>
<div id="close">
   <img src="./img/closeButton.png" onclick="javascript:self.close()">
</div>
</body>
</html>
