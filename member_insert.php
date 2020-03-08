<?php
    $uid = $_POST["uid"];
    $upw = $_POST["upw"];
    $umail = $_POST["umail"];
    $uname = $_POST["uname"];
    $unum1 = $_POST["unum1"];
    $byear = $_POST["year"];
    $bmonth = $_POST["month"];
    $bday = $_POST["day"];
    $self = $_POST["self"];
    //$userlevel = $_POST[""];
    //$userpoint = $_POST[""];

    $con = mysqli_connect("localhost", "root", "123456", "samlpe");

    $sql = "insert into members(uid, upw, umail, uname, unum1, byear, bmonth, bday, self, userlevel, userpoint)";
    $sql .= "values('$uid', '$upw', '$umail', '$uname', '$unum1', '$byear', '$bmonth', '$bday', '$self', '7', '8')";

    mysqli_query($con, $sql);  // $sql 에 저장된 명령 실행
    mysqli_close($con);

    echo "
	      <script>
	          location.href = 'index.php';
	      </script>
	  ";
?>
