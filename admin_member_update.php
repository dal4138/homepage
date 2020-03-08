<?php
    session_start();
    if (isset($_SESSION["userlevel"])) {
        $userlevel = $_SESSION["userlevel"];
    } else {
        $userlevel = "";
    }

    if ($userlevel != 1) {
        echo("
            <script>
            alert('관리자가 아닙니다! 회원정보 수정은 관리자만 가능합니다!');
            history.go(-1)
            </script>
        ");
        exit;
    }

    $uid   = $_GET["uid"];

    //id 잘 넘어왔나 한번 찍어봄
    echo "<script>alert('{$uid}');</script>"; //수정 선택한 아이디는 잘 넘어옴
    echo "<script>alert('userlevel: {$userlevel}, userpoint: {$userpoint}');</script>";

    $userlevel = $_POST["userlevel"];
    $userpoint = $_POST["userpoint"];

    $con = mysqli_connect("localhost", "root", "123456", "samlpe");
    $sql = "update members set userlevel=$userlevel, userpoint=$userpoint where uid='$uid'";
    mysqli_query($con, $sql);

    mysqli_close($con);

    //header('Location: admin.php');
    //exit;

    echo "
         <script>
             location.href = 'admin.php';
         </script>
       ";

       ?>
