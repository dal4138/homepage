<?php
    $uid   = $_POST["uid"];
    $upw = $_POST["upw"];

   $con = mysqli_connect("localhost", "root", "123456", "samlpe");
   $sql = "select * from members where uid='$uid'";
   $result = mysqli_query($con, $sql);

   $num_match = mysqli_num_rows($result);

   if(!$num_match)
   {
     echo("
           <script>
             window.alert('등록되지 않은 아이디입니다!')
             history.go(-1)
           </script>
         ");
    }
    else
    {
        $row = mysqli_fetch_array($result);
        $db_pass = $row["upw"];

        mysqli_close($con);

        if($upw != $db_pass)
        {
           echo("
              <script>
                window.alert('비밀번호가 틀립니다!')
                history.go(-1)
              </script>
           ");
           exit;
        }
        else
        {
            session_start();
            $_SESSION["uid"] = $row["uid"];
            $_SESSION["uname"] = $row["uname"];
            $_SESSION["userlevel"] = $row["userlevel"];
            $_SESSION["userpoint"] = $row["userpoint"];

            echo("
              <script>
                location.href = 'index.php';
              </script>
            ");
        }
     }
?>
