<?php 
  session_start();
  require_once('conn.php');
  require_once('utils.php');

  if (
    empty($_POST['nickname'])
  ) {
    header('Location: index.php?errCode=1');
    die('欄位請勿空白');
  }
  /* 依照 session 拿到 username */
  $username = $_SESSION['username'];

  /* 拿到 POST 傳來的 nickname */
  $nickname = $_POST['nickname'];

  $sql = "UPDATE linda_w11_board_users SET nickname=? WHERE username=?";

  /* 用 prepare 回傳一個 stmt */
  $stmt = $conn->prepare($sql);
  /* ss 代表要傳兩個字串參數進去 (若是 i 則代表整數) */
  $stmt->bind_param('ss', $nickname, $username);
  $result = $stmt->execute();
  if (!result) {
    die($conn->error);
  } 

  header("Location: index.php");
?>