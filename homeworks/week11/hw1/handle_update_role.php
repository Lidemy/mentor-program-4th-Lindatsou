<?php 
  session_start();
  require_once('conn.php');
  require_once('utils.php');

  if (
    empty($_GET['id']) || empty($_GET['role'])
  ) {
    die('資料不齊全');
  }

  /* 依照 session 拿到 username */
  $username = $_SESSION['username'];
  $user = getUserFromUsername($username);
  $id = $_GET['id'];
  $role = $_GET['role'];

  if (!$user || $user['role'] !== 'ADMIN') {
    header('Location: admin.php');
  }

  $sql = "UPDATE linda_w11_board_users SET role = ? WHERE id = ? ";

  /* 用 prepare 回傳一個 stmt */
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('si', $role, $id);
  
  $result = $stmt->execute();
  if (!$result) {
    die($conn->error);
  } 

  header("Location: admin.php");
?>