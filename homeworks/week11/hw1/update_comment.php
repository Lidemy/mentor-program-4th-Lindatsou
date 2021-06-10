<?php 
  /* 使用 php 內建 session 機制必須加這一行 */
  session_start();
  require_once('conn.php');
  require_once('utils.php');

  $id = $_GET['id'];

  $username = NULL;
  $user = NULL;
  if (!empty($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $user = getUserFromUsername($username);
  }
  
  $stmt = $conn->prepare(
    'SELECT * FROM linda_w11_board_comments WHERE id = ?'
  );
  $stmt->bind_param("i", $id);
  $result = $stmt->execute();
  if (!$result) {
    die('Error:' . $conn->error);
  }
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();
?>

<!DOCTYPE html>

<html>
  <head>
    <meta charset="utf-8">

    <title>│ 留言板 │首頁</title>
  <!--    讓網頁不會自動因手機螢幕變小而扭曲，使得RWD網頁能正常執行-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./normalize.css">
    <link rel="stylesheet" href="./style.css">
  </head>

  <body>  
    <header class="warning">
      <strong>注意！本站為練習用網站，因教學用途刻意忽略資安的實作，註冊時請勿使用任何真實的帳號或密碼。</strong>
    </header>

    <main class="board">
      <h1 class="board__title">Edit Comment</h1>
      <?php 
        if (!empty($_GET['errCode'])) {
          $code = $_GET['errCode'];
          $errMsg = 'Error';
          if ($code === '1') {
            $errMsg = '欄位不得為空白';
          }
          echo '<h3 class="errMsg">Error：' . $errMsg . '</h3>';
        }      
      ?>

      <form class="board__new-content" method="POST" action="handle_update_comment.php">
        <textarea name="content" rows="5"><?php echo $row['content'] ?>
        </textarea>
        <input class="board__submit-btn" type="submit" />
        <!-- 將表單按下去後，handle_update_comment.php 這個頁面也需要知道 update 哪個 id -->
        <!-- 所以需要以某個形式將 id 帶到下個頁面 -->
        <input type="hidden" name="id" value="<?php echo $row['id'] ?>" />
      </form>

      <hr></hr>

    </main>
  </body>
</html>