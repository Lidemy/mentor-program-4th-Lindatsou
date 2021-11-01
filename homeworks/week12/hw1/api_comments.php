<?php 
  require_once('conn.php');
  /* 要加上這個 header 讓瀏覽器知道，回覆的 response 是 json 格式的資料 */
  header('Content-type:application/json;charset=utf-8');
  header('Access-Control-Allow-Origin: *');  // 實務上通常會限定網域
  
  if (
    empty($_GET['site_key'])
  ) {
    $json = array(
      "ok" => false,
      "message" => "Please add site_key in url"
    );

    $response = json_encode($json);
    echo $response;
    die();
  }

  $site_key = $_GET['site_key'];

  $sql = 
    "SELECT id, nickname, content, created_at FROM linda_w12_board_discussions WHERE site_key = ? " . 
    (empty($_GET['before']) ? "" : "AND id < ?") . 
    " ORDER BY id DESC LIMIT 5 ";
  $stmt = $conn->prepare($sql);  // 準備使用這個 sql
  if (empty($_GET['before'])) {
    $stmt->bind_param('s', $site_key);  // 將參數帶入
  } else {
    $stmt->bind_param('si', $site_key, $_GET['before']);
  }

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

  /* 把資料拿回來 */
  $result = $stmt->get_result();
  $discussions = array();
  while ($row = $result->fetch_assoc()) {
    array_push($discussions, array(
      "id" => $row["id"],
      "nickname" => $row["nickname"],
      "content" => $row["content"],
      "created_at" => $row["created_at"]
    ));
  }

  /* 產生出一個物件，然後用 json_encode 這個 function 把物件變成 json 格式輸出出去 */
  $json = array (
    "ok" => true,
    "discussions" => $discussions
  );

  $response = json_encode($json);
  echo $response;
?>