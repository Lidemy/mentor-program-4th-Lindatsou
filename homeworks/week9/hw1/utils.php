<?php
  require_once('conn.php');

  /* 透過 username 從資料庫內將 user 資訊抓出來 */
  function getUserFromUsername($username) {
    global $conn;
    $sql = sprintf(
      "SELECT * FROM linda_board_users WHERE username = '%s'",
      $username
    );
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    /* username, id, nickname */
    return $row;
  } 
?>