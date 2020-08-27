## 什麼是 Ajax？
Ajax（Asynchronous JavaScript And XML），非同步 JavaScript 和 XML，雖然 X 在 Ajax 中代表 XML，但現在資料大多都用 JSON 格式。而 Ajax 其實並不能被稱作一種技術，它是在 2005 年由 Jesse James Garrett 所發明的術語，它是由一堆現有的技術所組成，包括 HTML 或 XHTML、層疊樣式表、JavaScript、文件物件模型、XML、XSLT 以及最重要的 XMLHttpRequest 物件。

一般來說，程式是按照順序一行行執行的，我們寫 JavaScript 發出 request 後，若是同步的話，在等待 Server 端的 response 時，Client 端就無法進行任何操作；反之，使用非同步的方式與伺服器進行溝通的話，能夠利用 callback function 接收 response，Client 端仍可以繼續進行其他工作，如此一來可以更快速且即時地更新頁面。

例如：登入錯誤帳號密碼時，即時偵測是否有誤，不用等到資料送出到 Server 後才去檢查，檢查後若有誤再把頁面跳轉回來重新輸入，這會耗費太多不必要的時間或效能。

參考資料：
> * [Ajax - Web 開發者指引 | MDN](https://developer.mozilla.org/zh-TW/docs/Web/Guide/AJAX)
> * [JavaScript 基礎知識 - Ajax(上) - iT 邦幫忙](https://ithelp.ithome.com.tw/articles/10231088)
> * [Day1 甚麼是Ajax? (part1) - iT 邦幫忙](https://ithelp.ithome.com.tw/articles/10200409)
> * [6. AJAX | 宅學習](https://sls.weco.net/node/10728)

## 用 Ajax 與我們用表單送出資料的差別在哪？
表單：Client 端透過表單發送 request 給 Server 端後，瀏覽器依照 response 直接 render 出頁面結果，也就是會跳轉至 `action` 所夾帶的 url。
Ajax：和用表單交換資料的主要差別在於不需跳轉頁面，因為瀏覽器會把接收到的 response 傳給 JavaScript 處理，就不用重新 render 整個頁面。

## JSONP 是什麼？
由於瀏覽器的安全限制問題，受到同源政策（Same origin policy）的管理，會禁止跨網域的資料請求，而 JSONP（JSON with Padding）便是解決跨網域限制的方法之一。

它利用一些標籤可以跨網域的特性，如 `<script>`，將 `src` 指向目標 API 網址，並透過指定好的 function 接收資料。通常 Server 端會提供一個 callback 參數讓 Client 端帶過去，然後 Server 端返回資料時，便會把 JavaScript 物件整個傳到 Function 裡面，就可以在 Function 裡面拿到資料。
```js
<script src="https://api.twitch.tv/kraken/games/top?client_id=xxx&callback=receiveData&limit=1"></script>
<script>
  function receiveData (response) {
    console.log(response);
  }
</script>
```
但 JSONP 的缺點就是那些參數永遠只能用附加在網址上的方式（GET）帶過去，沒辦法用 POST。

參考資料：
> * [輕鬆理解 Ajax 與跨來源請求](https://blog.techbridge.cc/2017/05/20/api-ajax-cors-and-jsonp/)
> * [JSONP - JSON 教學 Tutorial](https://www.fooish.com/json/jsonp.html)

## 要如何存取跨網域的 API？
除了使用 JSONP 之外，還可以透過跨來源資源共享 CORS（Cross-Origin Resource Sharing）的規範。

首先，瀏覽器發送跨來源請求時，會帶一個 Origin header，表示這個請求的來源。當 Server 端收到這個跨來源請求時，它可以依據請求的來源，決定是否要允許這個跨來源請求。若 response 的 header 有包含 `Access-Control-Allow-Origin` 或是允許任何跨來源請求的 `Access-Control-Allow-Origin: *`，則瀏覽器就會允許通過，讓程式順利接收到 response。

其他還有 `Access-Control-Allow-Headers` 跟`Access-Control-Allow-Methods`，可以定義接受哪些 Request Header 以及接受哪些 Method。

參考資料：
> * [輕鬆理解 Ajax 與跨來源請求](https://blog.techbridge.cc/2017/05/20/api-ajax-cors-and-jsonp/)
> * [[教學] CORS 是什麼? 如何設定 CORS?](https://shubo.io/what-is-cors/)

## 為什麼我們在第四週時沒碰到跨網域的問題，這週卻碰到了？
第四週是使用 Node.js 程式透過作業系統呼叫 API，可以直接接收 Server 端回傳的 response，沒有受到任何東西的限制。

但這週是經由瀏覽器發出 request，基於安全性問題，會有一些規範，像是上述提到的同源政策及跨來源資源共享。瀏覽器除了會阻止這些事情，可能還會加上一些東西，如瀏覽器的版本、額外的資訊等，所以並不像用 Node.js 與伺服器交換資料來得直接。
