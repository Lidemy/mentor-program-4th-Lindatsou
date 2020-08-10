## 請找出三個課程裡面沒提到的 HTML 標籤並一一說明作用。
1. `<figure>`：是 HTML5 新增的標籤，可以放入和主內容相關的文字、圖片、圖表、代碼等。但此標籤區塊的排版可以被隨意移動位置或刪除，而不會影響上下文內容的意思。另外，裡面也可以加上 `<figcaption>` 標籤當作註解，例：
```HTML
＜figure＞

　＜img src=”檔案位置”＞

　＜figcaption＞圖片解說＜/figcaption＞

＜/figure＞
```

2. `<canvas>`：是 HTML5 新增的標籤，可以定義一個空白的畫布，不能單獨使用，需搭配 JavaScript 才能在上面繪製圖形或動畫，例：
```HTML
<!--- 畫一個紅色矩形 --->
<canvas id="myCanvas"></canvas>

<script type="text/javascript">

var canvas=document.getElementById('myCanvas');
var ctx=canvas.getContext('2d');
ctx.fillStyle='#FF0000';
ctx.fillRect(0,0,80,100);

</script>
```

3. `<select>`：可建立一個下拉式選單，裡面用 `<option>` 標籤來建立個別選項，例：
```HTML
<select>
    <option>請選擇</option>
    <option>選項 1</option>
    <option>選項 2</option>
    <option>選項 3</option>
</select>
```

若加上 `<optgroup>` 可以將同性質的選項分區顯示，並用 label 屬性表示分區的名稱，例：
```HTML
<select name="請選擇">
  <optgroup label="Cats">
    <option>黑貓</option>
    <option>白貓</option>
    <option>橘貓</option>
  </optgroup>
  <optgroup label="Dogs">
    <option>小黑</option>
    <option>小白</option>
    <option>小黃</option>
  </optgroup>
</select>
```


參考資料：
> * [HTML: Hypertext Markup Language | MDN](https://developer.mozilla.org/en-US/docs/Web/HTML/Element)
> * [自己動手寫HTML5網頁](https://www.ithome.com.tw/tech/90791)
> * [HTML 語法教學 Tutorial](https://www.fooish.com/html)
> * [w3school 在线教程](https://www.w3school.com.cn/tags/index.asp)

## 請問什麼是盒模型（box modal）
![box modal](https://blog.ziyiu.com/images/css/border_box_1.png) 
*(圖片來源 @https://blog.ziyiu.com/)*
這是從 google 瀏覽器的任意一個網頁，往某個元素點右鍵，再點選檢查後，會開啟的開發人員工具，右下角存在這一個**盒模型**。以下將由此盒模型最中央依序向外說明：
1. 內容 (content)：
  標示為藍色區塊，容納元素本身，如文字、圖片等等。
2. 內邊距 (padding)：
  標示為綠色區塊，從元素延伸的內容區域，填充內容與邊框的間距。
3. 邊框 (border)：
  標示為橙色區塊，向外延伸的框線。
4. 外邊距 (margin)：
  標示為粉色區塊，以空白的區塊分隔元素與元素之間的距離。

再來，盒模型又分為兩種：
1. W3C 標準盒模型 (content-box)：
  屬性 width 和 height 中，只包含 content，不包含 border 和 padding。
2. IE 盒模型 (border-box)：
  屬性 width 和 height 中，包含 content + padding + border。

通常瀏覽器的預設值為`content-box`，若要準確控制元素大小，必須再計算邊框和邊距的尺寸。所以為求直觀且方便設定寬高，常常會套用此 CSS 屬性更改盒模型：
``` css
* {
  box-sizing: border-box;
}
```

參考資料：
> * [讓控制版面更容易－CSS的box-sizing - 一化網頁設計
](https://www.webdesigns.com.tw/CSS_box-sizing.asp)
> * [CSS盒模型詳解 | 程式前沿](https://codertw.com/%E7%A8%8B%E5%BC%8F%E8%AA%9E%E8%A8%80/706252/)
> * [CSS 基础框盒模型介绍 | MDN](https://developer.mozilla.org/zh-CN/docs/Web/CSS/CSS_Box_Model/Introduction_to_the_CSS_box_model)
> * [【DAY12】盒模型 box model - iT 邦幫忙](https://ithelp.ithome.com.tw/articles/10194997)

## 請問 display: inline, block 跟 inline-block 的差別是什麼？
* `inline`：行內元素，設定此屬性的元素都在同一行，不會換行。且寬高會取決於內容，而雖然能設定 padding 和 margin，但不會影響排版位置，其他元素不會被推開。
* `block`：區塊元素，此屬性的元素預設寬度會撐到最大，佔滿一整行，所以下個元素就會換到下一行。雖然設定寬高、padding 和 margin 後，旁邊看起來還有位置，但其實是自己會佔滿一整行。
* `inline-block`：行內區塊，對外像 inline 可併排，對內像 block 可調各種屬性，而在無設定 width 與 height 時，寬高由內容決定。

參考資料：
> * [CSS教學-關於display:inline、block、inline-block的差別
](https://medium.com/@wendy199288/css%E6%95%99%E5%AD%B8-%E9%97%9C%E6%96%BCdisplay-inline-inline-block-block%E7%9A%84%E5%B7%AE%E5%88%A5-1034f38eda82)
> * [CSS 屬性 display 的值 inline block inline-block none](https://blog.xuite.net/vexed/tech/29221717-CSS+%E5%B1%AC%E6%80%A7+display+%E7%9A%84%E5%80%BC+inline+block+inline-block+none)
> * [混血兒 inline-block](https://ithelp.ithome.com.tw/articles/10219161)

## 請問 position: static, relative, absolute 跟 fixed 的差別是什麼？
* `static (靜態定位)`：預設值，不會特別定位在某個位置，照著預設自動正常排版。
* `relative (相對定位)`：會根據 top、right、bottom、left 屬性進行定位，且都不會影響到原本其他元素所在的位置，如無特別設定屬性，則與 `static` 一樣會在預設的位置。
* `absolute (絕對定位)`：會往上層找到第一個非 `static` 的元素去做定位，當上層沒有可以定位的元素時，才會根據 `body` 去定位。且會脫離原本的排版流程，後面如果其他元素會照預設排版遞補上來。
* `fixed (固定定位)`：元素均相對於 viewport (如瀏覽器) 做定位，即使捲動屏幕，仍然會在同樣的位置，而位置也是經由 top、right、bottom、left 屬性規定。

參考資料：
> * [CSS - 關於 position 屬性](http://zh-tw.learnlayout.com/position.html)
> * [前端開發教程CSS（三） - 定位模型- position定位詳解（absolute、fixed、relative、](https://www.bilibili.com/read/cv6967337/)
> * [position的四个属性值： relative ，absolute ，fixed，static - chinaifne - 博客园](https://www.cnblogs.com/chinafine/articles/1765967.html)
> * [Position属性四个值：static、fixed、absolute和relative的区别和用法 - Newbie_小白 - 博客园](https://www.cnblogs.com/theWayToAce/p/5264436.html)