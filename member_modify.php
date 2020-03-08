<?php
    $uid = $_POST["uid"];
    $upw = $_POST["upw"];
    $umail = $_POST["umail"];
    $uname = $_POST["uname"];
    $self = $_POST["self"];

    $con = mysqli_connect("localhost", "root", "123456", "samlpe");
    $sql = "update members set upw='$upw', umail='$umail', uname='$uname', self='$self'";
    $sql .= " where uid='$uid'";
    mysqli_query($con, $sql);

    mysqli_close($con);

    echo "
	      <script>
	          location.href = 'index.php';
	      </script>
	  ";
?>
