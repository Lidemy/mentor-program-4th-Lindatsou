## 請簡單解釋什麼是 Single Page Application
    
單一頁面應用程式﹝SPA﹞，意思是僅有一個頁面的應用程式，網頁不需跳轉頁面就可以達到基本的建立、讀取、修改、刪除資料功能。
只有在瀏覽器向伺服器發出第一個請求時，伺服器會返回一個 html 檔案，
之後的請求主要是 Javascript 使用 AJAX 技術來拿到純資料內容（以 JSON 格式為主），
使網頁進行局部更新，不需重新載入整個頁面。如：Gmail。


## SPA 的優缺點為何

#### pros
* 降低伺服器的運算效能消耗及載入資料量。
* 不必一直重新整理頁面，增進使用者的使用體驗。
* 前後端分離的設計模式，後端負責產生計算資料，前端負責頁面的呈現。透過 Client 及 Server 端的區分，讓前後端有更加的職責區分。


#### cons
* 由於首次載入頁面時，前端需要下載大量 JavaScript 檔案，而後才計算、渲染畫面，需要較長的反應時間。

* 大多內容都是透過動態顯示，除了最初的 HTML 外，其他標籤資訊通常不足，不利於 SEO。
（註1：在 [Google 官方的公告](https://webmasters.googleblog.com/2015/10/deprecating-our-ajax-crawling-scheme.html)中，他們的搜尋引擎如今已經能夠爬取 AJAX 的各種呼叫了。）
（註2：亦可使用 SSR 框架）

* 因為所有資料都放在同一頁面中，URL 網址都不會改變，所以必須自定狀態來判斷資料的傳輸結果。
（註：HTML5 引入了 pushState 跟 replaceState，可以解決這個問題）

* 沒有在瀏覽器中啟用 JavaScript 的使用者存取不了頁面


## 這週這種後端負責提供只輸出資料的 API，前端一律都用 Ajax 串接的寫法，跟之前透過 PHP 直接輸出內容的留言板有什麼不同？

透過 PHP 由後端輸出 HTML 的內容到前端，再由瀏覽器 render 產生，
所以每次更新內容都必須重新載入頁面，稱作 Server-side render（SSR）。

若是用 API 加上前端 JavaScript 使用 AJAX 來串接的話，內容是動態產生之後才放到網頁上，
所以當瀏覽器拿到 server 的 response 的時候，可以發現開啟網頁原始碼後，HTML 內的資料是空的。



* [單一頁面應用程式](https://medium.com/@mybaseball52/%E5%96%AE%E4%B8%80%E9%A0%81%E9%9D%A2%E6%87%89%E7%94%A8%E7%A8%8B%E5%BC%8F-c98c8a17081)
* [前端小字典三十天【每日一字】– SPA](https://ithelp.ithome.com.tw/articles/10160709)
* [前後端分離與 SPA](https://blog.techbridge.cc/2017/09/16/frontend-backend-mvc/)
* [為什麼網站要做成 SPA？SSR 的優點是什麼？](https://medium.com/schaoss-blog/%E5%89%8D%E7%AB%AF%E4%B8%89%E5%8D%81-18-fe-%E7%82%BA%E4%BB%80%E9%BA%BC%E7%B6%B2%E7%AB%99%E8%A6%81%E5%81%9A%E6%88%90-spa-ssr-%E7%9A%84%E5%84%AA%E9%BB%9E%E6%98%AF%E4%BB%80%E9%BA%BC-c926145078a4)