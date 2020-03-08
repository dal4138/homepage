<?php
  session_start();
  unset($_SESSION["uid"]);
  unset($_SESSION["uname"]);
  unset($_SESSION["userlevel"]);
  unset($_SESSION["userpoint"]);

  echo("
       <script>
          location.href = 'index.php';
         </script>
       ");
?>
