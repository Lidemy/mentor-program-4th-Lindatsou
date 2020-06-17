## 教你朋友 CLI

首先，先了解 CLI 的基本概念後，就能輕鬆達成你想要的功能哦！

### CLI 是什麼？
和電腦溝通的方法有兩種：

　　1. 圖形化介面 (GUI，Graphical User Interface)
　即平常習慣的視窗、圖示、按鈕等圖形，通常透過滑鼠去點擊而達成不同的目的或產生動作。

　　2. 文字 (CLI，Command Line Interface)
　透過文字輸入指令，讓電腦去執行我們想要讓它執行的動作。且有些程式沒有圖形化介面，就必須透過 CLI 去執行。

### 如何打開 CLI？
* Mac：應用程式 → 工具程式 → 終端機 (Terminal.app)

* Windows：開始 → 應用程式程式 → 命令提示字元 (cmd.exe)

* Linux：應用程式 → 附屬應用程式 → 終端機

### CLI 基本指令
| Windows | Mac / Linux | 功能 | 範例 |
| ------- | ----------- | ---- | --- |
| pwd     | pwd         | 顯示現在位置 | pwd |
| ls / dir| ls          | 列出所有檔案 | ls  |
| cd      | cd          | 切換資料夾   | cd + 資料夾名稱 |
| mkdir   | mkdir       | 新增資料夾   | mkdir + 資料夾名稱 |
| rmdir   | rmdir       | 刪除資料夾   | rmdir + 資料夾名稱 |
| touch   | touch       | （此檔案已存在）更新時間戳記 / （此檔案不存在）新增檔案| touch + 檔名 |
| rm      | rm          | 刪除檔案     | rm + 檔名 |
| cp      | cp          | 複製檔案     | cp + 檔名 + 新檔名 |
| mv      | mv          | 移動檔案 / 更名 | mv + 檔名 + 路徑 / mv + 檔名 + 新檔名 |

### 實作流程
>使用 command line 建立一個叫做 wifi 的資料夾，並且在裡面建立一個叫 afu.js 的檔案

1. `$ cd` 切換至要建立資料夾的目錄底下
2. `$ pwd` 確認所在位置
3. `$ mkdir wifi` 建立名稱為 wifi 的資料夾
4. `$ cd wifi` 進入 wifi 資料夾裡
5. `$ touch afu.js` 建立 afu.js 檔案
6. `$ ls` 可確認資料夾是否已成功建立
7. 完成 

*"$" 符號表示此行是輸入在終端機的指令，實際並不需輸入此符號*
