<?php 
  /* 使用 php 內建 session 機制必須加這一行 */
  session_start();
  require_once('conn.php');
  require_once('utils.php');

  if (
    empty($_POST['username']) ||
    empty($_POST['password'])
  ) {
    header('Location: login.php?errCode=1');
    die('欄位請勿空白');
  }

  $username = $_POST['username'];
  $password = $_POST['password'];

  $sql = "SELECT * FROM linda_w11_board_users WHERE username=?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('s', $username);

  /* 判斷是否執行成功 */
  $result = $stmt->execute();
  if (!$result) {
    die($conn->error);
  } 

  /* 執行完後，把結果拿回來 */
  $result = $stmt->get_result();

  /* 判斷抓不到東西，即查無使用者或帳密輸入失敗 */
  if ($result->num_rows === 0) {
    header("Location: login.php?errCode=2");
    exit();
  }

  /* 有查到使用者 */
  $row = $result->fetch_assoc();
  if (password_verify($password, $row['password'])) {
    /* 登入成功或失敗 */
    if ($result->num_rows) {
     /* 
       1. 產生 session id (token)
       2. 把 username 寫入檔案
       3. set-cookie: session-id
     */
      $_SESSION['username'] = $username;
      header("Location: index.php");
    } else {
      header("Location: login.php?errCode=2");
    }
  }
?>