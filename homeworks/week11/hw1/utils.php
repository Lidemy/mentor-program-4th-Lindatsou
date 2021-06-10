<?php
  require_once('conn.php');

  /* 透過 username 從資料庫內將 user 資訊抓出來 */
  function getUserFromUsername($username) {
    global $conn;
    $sql = sprintf(
      "SELECT * FROM linda_w11_board_users WHERE username = '%s'",
      $username
    );
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    /* username, id, nickname, role */
    return $row;
  }

  function escape($str) {
    return htmlspecialchars($str, ENT_QUOTES);
  }

  /* action: update, delete, create */
  function hasPermission($user, $action, $comment) {
    if($user["role"] === "ADMIN") {
      return true;
    }

    if ($user["role"] === "NORMAL") {
      if ($action === "create") return true;
      return $comment["username"] === $user["username"];
    }

    if ($user["role"] === "BANNED") {
      return $action !== "create";
    }
  }

  function isAdmin($user) {
    return $user["role"] === "ADMIN";
  }
?>