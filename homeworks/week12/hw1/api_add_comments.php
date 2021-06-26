<?php 
  require_once('conn.php');
  /* 要加上這個 header 讓瀏覽器知道，回覆的 response 是 json 格式的資料 */
  header('Content-type:application/json;charset=utf-8');
  header('Access-Control-Allow-Origin: *');  // 實務上通常會限定網域
  
  if (
    empty($_POST['content']) ||
    empty($_POST['nickname']) ||
    empty($_POST['site_key'])
  ) {
    $json = array(
      "ok" => false,
      "message" => "Please input missing fields"
    );

    $response = json_encode($json);
    echo $response;
    die();
  }

  /* 把資料拿進來 */
  $nickname = $_POST['nickname'];
  $site_key = $_POST['site_key'];
  $content = $_POST['content'];

  /* 把資料寫入資料庫 */
  $sql = "INSERT INTO linda_w12_board_discussions(site_key, nickname, content) VALUES (?, ?, ?)";
  $stmt = $conn->prepare($sql);  // 準備使用這個 sql
  $stmt->bind_param('sss', $site_key, $nickname, $content);  // 將參數帶入
  $result = $stmt->execute();

  if (!$result) {
    $json = array (
      "ok" => false,
      "message" => $conn->error  // 一般來說不會這樣寫，怕暴露一些敏感資訊
    );
    $response = json_encode($json);
    echo $response;
    die();
  }

  /* 產生出一個物件，然後用 json_encode 這個 function 把物件變成 json 格式輸出出去 */
  $json = array (
    "ok" => true,
    "message" => "success"
  );

  $response = json_encode($json);
  echo $response;
?>