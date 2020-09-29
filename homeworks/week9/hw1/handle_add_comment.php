<?php 
  session_start();
  require_once('conn.php');
  require_once('utils.php');

  if (
    empty($_POST['content'])
  ) {
    header('Location: index.php?errCode=1');
    die('欄位請勿空白');
  }
  /* 依照登入的 username 從資料庫抓出 nickname */
  $user = getUserFromUsername($_SESSION['username']);
  $nickname = $user['nickname'];

  $content = $_POST['content'];
  $sql = sprintf(
    "INSERT INTO linda_board_comments(nickname, content) VALUES('%s','%s')",
    $nickname,
    $content 
  );

  $result = $conn->query($sql);
  if (!result) {
    die($conn->error);
  } 

  header("Location: index.php");
?>