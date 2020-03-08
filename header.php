<?php
    @session_start();
    if (isset($_SESSION["uid"])) {
        $uid = $_SESSION["uid"];
    } else {
        $uid = "";
    }
    if (isset($_SESSION["uname"])) {
        $username = $_SESSION["uname"];
    } else {
        $username = "";
    }
    if (isset($_SESSION["userlevel"])) {//관리자 구별
        $userlevel = $_SESSION["userlevel"];
    } else {
        $userlevel = "";
    }
    if (isset($_SESSION["userpoint"])) {
        $userpoint = $_SESSION["userpoint"];
    } else {
        $userpoint = "";
    }
?>
        <div id="top">
            <h3>
                <a href="index.php"><img src="./img/tema.jpg" width=128 height=128 alt=""> C A F E </a>
            </h3>
            <ul id="top_menu">
<?php
    if (!$uid) { //세션값이  없으면
?>
                <li id="signin"><a href="member_form.php">SIGN IN</a> </li>
                <li> | </li>
                <li><a href="login_form.php">LOGIN</a></li>
<?php
    } else {
        $logged = $username."(".$uid.")님[Level:".$userlevel.", Point:".$userpoint."]"; ?>
                <li><?=$logged?> </li>
                <li> | </li>
                <li><a href="logout.php">LOGOUT</a> </li>
                <li> | </li>
                <li><a href="member_modify_form.php">EDIT MY INFO</a></li>
<?php
    }
?>
<?php
    if ($userlevel==1) {//userlevel이 1이면 관리자
        ?>
                <li> | </li>
                <li><a href="admin.php">Administer Mode</a></li>
<?php
    }
?>
            </ul>
        </div>
        <div id="menu_bar">
            <ul>
                <li><a href="index.php">H O M E</a></li>
                <li><a href="message_form.php">M E S S A G E</a></li>
                <li><a href="board_form.php">B O A R D</a></li>
                <li><a href="qna.php">Q n A</a></li>
            </ul>
        </div>
