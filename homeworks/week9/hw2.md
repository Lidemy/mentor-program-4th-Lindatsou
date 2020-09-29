## 資料庫欄位型態 VARCHAR 跟 TEXT 的差別是什麼

##### VARCHAR(n)：
* 可以有預設值
* 長度為 n 個字節的可變長度且非 Unicode 的字符數據
* n 最大 65535，其中有 1-2 字節要用來存占用長度，255 字節以下用 1 字節存儲長度，255 字節以上用 2 字節存儲長度
* 理論上可以添加全部索引，但是數據長度太大時索引也會截取數據前面的一部分
##### TEXT：
* 不能有預設值
* 上限 65535 字節，約 64 KB，也按字符長度占用空間，但是記錄在數據之外，不占用數據的空間
* 另外還有 mediumtext 上限 2^24-3 字節大概 16MB，longtext 上限 2^32-4 字節大概 4GB
* 索引只能是前綴索引

###### 總結
* 查詢速度： varchar > text
* 經常變化的字段用 varchar
* 能用 varchar 的地方就不用 text

> 參考資料：
>* [SQL中char、varchar、nvarchar、text 的區別 - IT閱讀](https://www.itread01.com/content/1536260294.html)
>* [MySQL中char、varchar和text三者的區別 -  开发者知识库](https://www.itdaan.com/tw/cd46564281d7b8b5c986e4fe2d152510)
>* [字符與字節的區別 - IT閱讀](https://www.itread01.com/content/1533967371.html)
>* [淺談電腦編碼與 Unicode (一) 基礎概念篇 - Chun Norris Facts](https://blog.chunnorris.cc/2015/04/unicode.html)


## Cookie 是什麼？在 HTTP 這一層要怎麼設定 Cookie，瀏覽器又是怎麼把 Cookie 帶去 Server 的？
Cookie 是 Server 儲存在瀏覽器裡的一些資訊，由於 HTTP 的無狀態的特性，使得每一次瀏覽器發送的 Request 都是獨立無關聯的。
而 Server 可以透過 Set-Cookie 這個語法，將要儲存的資料放在 Response 的 Header 裡回傳，當瀏覽器再次發送 Request 時，Cookie Header便會帶著已儲存的資訊一起傳給 Server，如此一來 Server 即可透過 Cookie 讓 Request 產生關聯。



## 我們本週實作的會員系統，你能夠想到什麼潛在的問題嗎？
1. 資料庫中的使用者密碼為明文，一旦資料庫被入侵或管理者居心不良，可能產生資安風險。
2. 對於使用者可輸入的內容沒有做 escape，可能會被寫入 HTML 標籤或 JS 造成網站損壞。
3. 由於 User ID 的 Cookie 存放在 Client 端，攻擊者只要竄改 Cookie 內容就能夠偽造身分。
4. 沒有對 Session 做一些防護措施，如：辨別來源 IP 位址、瀏覽器 User-Agent，或限定使用 HTTPS 傳輸，也可能會有被竊取 Session ID 的風險。

> 參考資料：
>* [白話 Session 與 Cookie：從經營雜貨店開始](https://medium.com/@hulitw/session-and-cookie-15e47ed838bc)
>* [淺談 Session 與 Cookie：一起來讀 RFC
](https://github.com/aszx87410/blog/issues/45)
>* [HTTP Session 攻擊與防護](https://devco.re/blog/2014/06/03/http-session-protection/)