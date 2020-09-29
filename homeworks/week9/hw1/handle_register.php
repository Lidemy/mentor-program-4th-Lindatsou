<?php 
  require_once('conn.php');

  if (
    empty($_POST['nickname']) ||
    empty($_POST['username']) ||
    empty($_POST['password'])
  ) {
    header('Location: register.php?errCode=1');
    die('欄位請勿空白');
  }

  $nickname = $_POST['nickname'];
  $username = $_POST['username'];
  $password = $_POST['password'];

  $sql = sprintf(
    "INSERT INTO linda_board_users(nickname, username, password) VALUES('%s', '%s', '%s')",
    $nickname,
    $username,
    $password 
  );

  $result = $conn->query($sql);
  if (!$result) {
    /* 顯示 php 錯誤碼 */
    $code = $conn->errno;
    /* 1062: ER_DUP_ENTRY 資料有重複 */
    if ($code === 1062) {
      header("Location: register.php?errCode=2");
    }
    die($conn->error);
  } 

  header("Location: index.php");
?>