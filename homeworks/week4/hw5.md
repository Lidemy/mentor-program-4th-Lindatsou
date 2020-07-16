## 請以自己的話解釋 API 是什麼
API 像是一個媒介，透過它可以輕易拿到我們想要的資料或功能。

比如說，只會喝酒不會調酒的我身在酒吧，而我想要一杯環遊世界，就必須透過和 Bartender 點餐才能喝到。

簡而言之：
 1. 我需要一杯酒 （需要某項資料或功能）
 2. 跟 Bartender 點餐 （透過 API 送出我的需求）
 3. 得到一杯酒 （獲得資料、功能）

我們不需要知道他背後加了什麼材料，也不用知道是怎麼調配的，只要透過 Bartender，就可以簡單地拿到了。
但要注意的是，不是所有想要的東西都可以得到，例如店內的的獨家特調。
可能是還沒推出，抑或是要加錢，或是要跟店家有什麼特殊交情才有。
就像是會有一些開放的 API 讓大家使用，當然也有一些是不開放的，可能會需要加入會員之類的才能使用。

## 請找出三個課程沒教的 HTTP status code 並簡單介紹
1. 403 Forbidden：伺服器拒絕請求，用戶端沒有權限訪問，像是訪問一些內部網站可能會出現此錯誤。  

2. 418 I’m a teapot：指當一個控制茶壺的伺服器收到要求煮咖啡的 Request 時候，要回應 418。這個錯誤是源自於 1998 與 2014 的愚人節玩笑「超文字咖啡壺控制協定」（Hyper Text Coffee Pot Control Protocol）。這個HTTP狀態碼在某些網站（包括Google.com）中用作彩蛋。 

3. 509 Bandwidth Limit Exceeded：網站訪問量（流量）較大，超過帶寬限制。它並不是官方的狀態碼，一般可能會出現在新開又很夯的網站，或者是發生什麼大型網路事件，造成民眾大量湧入該網站，此時就會需要網站管理員加買更多流量。

參考資料：
 * [HTTP 狀態碼 - HTTP | MDN](https://developer.mozilla.org/zh-TW/docs/Web/HTTP/Status)
 * [HTTP狀態碼 - 維基百科，自由的百科全書](https://zh.wikipedia.org/zh-tw/HTTP%E7%8A%B6%E6%80%81%E7%A0%81)
 * [就知道404錯誤？殊不知其他代碼比它還要好玩！ - 每日頭條](https://kknews.cc/tech/bq5xbej.html)
 * [HTTP status codes with Meooowwwwww – Using Cat Photos [Ultimate List]](https://rightyaleft.com/funhumor/http-status-codes-with-meooowwwwww-using-cat-photos/)
 * [常見與不常見的 HTTP Status Code - Noob's Space
](https://noob.tw/http-status-code/)


## 假設你現在是個餐廳平台，需要提供 API 給別人串接並提供基本的 CRUD 功能，包括：回傳所有餐廳資料、回傳單一餐廳資料、刪除餐廳、新增餐廳、更改餐廳，你的 API 會長什麼樣子？請提供一份 API 文件。

Base URL: https://www.foodlinda-good.com.tw

| 說明 | Method | path |  參數  | 範例 |
|------|--------|------|--------|-----|
| 獲取所有餐廳資料 | GET | /restaurants | _limit:限制回傳資料數量 | /restaurants?_limit=5 |
| 獲取單一餐廳資料 | GET | /restaurants/:id | 無 | /restaurants/10 |
| 新增餐廳 | POST | /restaurants | name: 餐廳名 | 無 |
| 刪除餐廳 | DELETE | /restaurants/:id | 無 | 無 |
| 更改餐廳資訊 | PATCH | /restaurants/:id | name: 餐廳名 | 無 |