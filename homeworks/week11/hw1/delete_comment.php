<?php 
  session_start();
  require_once('conn.php');
  require_once('utils.php');

  if (
    empty($_GET['id'])
  ) {
    header('Location: index.php?errCode=1');
    die('資料不齊全');
  }

  $id = $_GET['id'];
  $username = $_SESSION['username'];
  $user = getUserFromUsername($username);

  $sql = "UPDATE linda_w11_board_comments SET is_deleted = 1 WHERE id = ? AND username = ?";
  if (isAdmin($user)) {
    $sql = "UPDATE linda_w11_board_comments SET is_deleted = 1 WHERE id = ?";
  }
  /* 用 prepare 回傳一個 stmt */
  $stmt = $conn->prepare($sql);

  if (isAdmin($user)) {
    /* ss 代表要傳兩個字串參數進去 (若是 i 則代表整數) */
    $stmt->bind_param('i', $id);
  } else {
    $stmt->bind_param('is', $id, $username);
  }

  $result = $stmt->execute();
  if (!result) {
    die($conn->error);
  } 

  header("Location: index.php");
?>