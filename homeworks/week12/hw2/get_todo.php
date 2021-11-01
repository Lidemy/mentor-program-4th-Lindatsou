<?php 
  require_once('conn.php');
  /* 要加上這個 header 讓瀏覽器知道，回覆的 response 是 json 格式的資料 */
  header('Content-type:application/json;charset=utf-8');
  header('Access-Control-Allow-Origin: *');  // 實務上通常會限定網域
  
  if (
    empty($_GET['id'])
  ) {
    $json = array(
      "ok" => false,
      "message" => "Please add id in url"
    );

    $response = json_encode($json);
    echo $response;
    die();
  };

  $id = intval($_GET['id']);

  $sql = 
    "SELECT id, todo FROM linda_w12_todos WHERE id = ? ";
  $stmt = $conn->prepare($sql);  // 準備使用這個 sql
  $stmt->bind_param('i', $id);  // 將參數帶入


  $result = $stmt->execute();

  if (!$result) {
    $json = array (
      "ok" => false,
      "message" => $conn->error  // 一般來說不會這樣寫，怕暴露一些敏感資訊
    );
    $response = json_encode($json);
    echo $response;
    die();
  };

  /* 把資料拿回來 */
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();
  
  /* 產生出一個陣列，然後用 json_encode 這個 function 把物件變成 json 格式輸出出去 */
  $json = array (  // 目前只會有一筆資料用物件就行，假設未來需要支援多筆 todo 才需要陣列
    "ok" => true,
    "data" => array(
      "id" => $row["id"],
      "todo" => $row["todo"]
    )
  );

  $response = json_encode($json);
  echo $response;
?>