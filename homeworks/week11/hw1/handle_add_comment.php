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
  /* 從 session 裡拿出 username 辨識使用者 */
  $username = $_SESSION['username'];
  $user = getUserFromUsername($username);

  if (!hasPermission($user, 'create', NULL)) {
    header("Location: index.php");
    exit;
  }

  $content = $_POST['content'];
  $sql = "INSERT INTO linda_w11_board_comments(username, content) VALUES(?, ?)";
  /* 用 prepare 回傳一個 stmt */
  $stmt = $conn->prepare($sql);
  /* ss 代表要傳兩個字串參數進去 (若是 i 則代表整數) */
  $stmt->bind_param('ss', $username, $content);
  $result = $stmt->execute();
  if (!result) {
    die($conn->error);
  } 

  header("Location: index.php");
?>