<?php 
  session_start();
  require_once('conn.php');
  require_once('utils.php');

  if (
    empty($_POST['content'])
  ) {
    header('Location: update_comment.php?errCode=1&id='.$_POST['id']);
    die('資料不齊全');
  }

  /* 依照 session 拿到 username */
  $username = $_SESSION['username'];
  $user = getUserFromUsername($username);

  /* 拿到 POST 傳來的 nickname */
  $id = $_POST['id'];
  $content = $_POST['content'];

  $sql = "UPDATE linda_w11_board_comments SET content = ? WHERE id = ? AND username = ?";
  if (isAdmin($user)) {
    $sql = "UPDATE linda_w11_board_comments SET content = ? WHERE id = ?";
  }
  /* 用 prepare 回傳一個 stmt */
  $stmt = $conn->prepare($sql);
  if (isAdmin($user)) {
    /* ss 代表要傳兩個字串參數進去 (若是 i 則代表整數) */
    $stmt->bind_param('si', $content, $id);
  } else {
    $stmt->bind_param('sis', $content, $id, $username);
  }
  
  $result = $stmt->execute();
  if (!$result) {
    die($conn->error);
  } 

  header("Location: index.php");
?>