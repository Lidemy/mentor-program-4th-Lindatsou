## 什麼是 DOM？
文件物件模型 (Document Object Model)，透過 DOM 把文件（如 .html 檔） 轉換成物件的樣子，使 JavaScript 和瀏覽器之間有個橋樑，可利用 JavaScript 去操控瀏覽器的行為或網頁的內容。
且 DOM 是以一個樹狀結構來表示文件的模型（如下圖）。
在根部的地方就是文件（Document），而再往下可以延伸出各個 HTML 的標籤，其每個元素、屬性、文本都是一個節點，藉由 DOM API 就能去存取及操作 HTML。

![img](http://lh4.ggpht.com/-hxWbqMFGAig/TtWc9TglyXI/AAAAAAAAHt8/rVmPQeZDrAM/ct_htmltree_thumb3.gif?imgmax=800)

參考資料：
> * [文件物件模型 (DOM) - Web APIs | MDN](https://developer.mozilla.org/zh-TW/docs/Web/API/Document_Object_Model)
> * [HTML DOM 简介](https://www.w3school.com.cn/htmldom/dom_intro.asp)
> * [html網頁基本組成結構（DOM節點、元素、屬性和文本）
](https://kknews.cc/zh-tw/tech/gvpnbzy.html)
> * [JavaScript入門系列：BOM和DOM筆記 | 快樂學程式](https://www.happycoding.today/posts/43)
> * [HTML DOM - iT 邦幫忙](https://ithelp.ithome.com.tw/articles/10108783)
> * [[Javascript][HTML] DOM 概念 - iT 邦幫忙](https://ithelp.ithome.com.tw/articles/10094965)


## 事件傳遞機制的順序是什麼；什麼是冒泡，什麼又是捕獲？
![img](https://miro.medium.com/max/700/1*5c_TL-nnhqjeu7CS90xAaw.png)
如圖所示，事件傳遞機制的順序為「先捕獲，再冒泡」，且分為三階段：
1. 捕獲階段 (Capture Phase)：
    假設我們在網頁上對 `<td>` 這個標籤做一些動作，DOM 的事件會從文件的根節點 `Window` 開始一層層往下尋找觸發事件的目標 `<td>`，此過程為捕獲階段。
2. 目標階段 (Target Phase)：
    當 DOM 事件找到被觸發的目標 `<td>` 的節點時，即為目標階段。
3. 冒泡階段 (Bubbleing Phase)：
    DOM 事件在目標 `<td>` 觸發後，循著原路回溯到根節點的過程為冒泡階段。

參考資料：
> * [[JavaScript] Javascript 中的 DOM 事件傳遞：捕獲與冒泡機制](https://medium.com/itsems-frontend/javascript-event-bubbling-capturing-794cd2d01e61)
> * [事件冒泡和事件捕获 - 简书](https://www.jianshu.com/p/8311f782f70d)

## 什麼是 event delegation，為什麼我們需要它？
事件代理 (Event delegation)，利用事件傳遞機制，將要響應在數個節點的事件，統一委託父元素做事件監聽。
就像是一個大家庭出去玩訂了很多飯店的房間，在櫃檯時不可能一個一個人辦理登記拿房卡，通常會請一個負責人代理登記資料，並再把家人各自的房間房卡分發下去。
而有事件代理的優點有二：
1. 不必為每個事件加上監聽，節省性能損耗，如：耗費多個櫃台人力去幫每個人辦理登記入住。
2. 若有動態新增或刪除元素時，因事件指綁定在父元素，不須重新對增減的元素綁定，如：三個阿姨臨時有事不來，和登記的資料多寡無關，因為只需登記負責人的資料。

參考資料：
> * [07.  [JS] 瀏覽器 DOM 元素的事件代理是指什麼？ - iT 邦幫忙](https://ithelp.ithome.com.tw/articles/10219793)
> * [事件監聽 &amp; 事件代理 - iT 邦幫忙](https://ithelp.ithome.com.tw/articles/10211932)
> * [JavaScript事件代理（事件委托）-CSDN博客_事件委托](https://blog.csdn.net/qq_38128179/article/details/86293394?utm_medium=distribute.pc_relevant_t0.none-task-blog-BlogCommendFromMachineLearnPai2-1.add_param_isCf&depth_1-utm_source=distribute.pc_relevant_t0.none-task-blog-BlogCommendFromMachineLearnPai2-1.add_param_isCf)
> * [JavaScript事件模型及事件代理 - 博客园](https://www.cnblogs.com/diver-blogs/p/5649270.html)
## event.preventDefault() 跟 event.stopPropagation() 差在哪裡，可以舉個範例嗎？
* event.preventDefault()：
取消事件的預設行為，但不會影響事件的傳遞，事件仍會繼續傳遞，例：`<a>` 標籤的預設行為是超連結，使用此方法則會阻止連結跳轉。
```html
// 範例，僅擷取部分程式碼
<body>
    <a href='https://www.google.com'>Google</a>
    <script>
        const link = ducument.querySelector('a')
        link.addEventListener('click', function(e) {
            e.preventDefault()   
        })
     </script>
</body>
```
* event.stopPropagation()：
停止事件傳遞，即不會繼續往下個節點捕獲或冒泡，但仍會執行預設的行為，例：

```html
// 範例，僅擷取部分程式碼
<body>
    <div class="outer">
        <div class="inner">
            <button class="btn">click me</button>
        </div>
    </div>
    <script>
    const outer = document.querySelector("outer");
    const inner = document.querySelector("inner");
    const btn = document.querySelector("btn");

    outer.addEventListener("click", function (e) {
        console.log("outer clicked");
    });
    inner.addEventListener("click", function (e) {
        console.log("inner clicked");
        e.stopPropagation();
    });
    btn.addEventListener("click", function (e) {
        console.log("btn clicked");
    });
<body>
```
依照上方範例程式碼，將 `event.stopPropagation()` 放在 `inner` 的節點，點擊 `btn` 會印出：
```
btn clicked
inner clicked
```
如無設定 `event.stopPropagation()` 方法的情況下，去點擊 `btn` 則會印出：
```
btn clicked
inner clicked
outer clicked
```

參考資料：
> * [[JavaScript] Javascript 中的 DOM 事件傳遞機制：捕獲與冒泡 (capturing and bubbling) | Medium](https://medium.com/itsems-frontend/javascript-event-bubbling-capturing-794cd2d01e61)
> * [js中的preventDefault与stopPropagation详解_javascript技巧_脚本之家](https://www.jb51.net/article/46379.htm)
> * [event.stopPropagation()与event.preventDefault() - 简书](https://www.jianshu.com/p/21bed2abcb5e)

