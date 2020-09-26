<?php
  session_start();
  session_destroy();
  header("Location: index.php");

  /* 
  未使用內建 session 機制時，將 token 刪除的寫法
  require_once('conn.php');
  $token = $_COOKIE['token'];
  $sql = sprintf(
    "DELETE FROM tokens WHERE token='%s'",
    $token
  );
  $conn->query($sql);
  setcookie("token", "", time() - 3600);
  header("Location: index.php");
  */
?>