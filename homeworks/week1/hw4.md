## 跟你朋友介紹 Git

### Git 是什麼？
　　從專業的角度而言，它是一套「**分散式的版本控制系統**」。  
如就初學者的角度，可以先以**資料夾及其目錄底下的檔案**來比喻。

![](https://ppt.cc/fHhu7x@.png)  
*(圖片來源 / Huli @Lidemy)*  

　　如圖，在期末報告的資料夾裡，你可能因為修改報告、新增、刪除等等，為了先備份而儲存了各個不同的**版本**。雖然只要在編輯之前先複製一份就好，但當數量一多，其實很難一眼分辨哪個檔案是最新的，亦無法看出具體更改了哪些內容。  
　　「**Git**」 這套**版本控制系統**即是為了解決以上問題而產生，它會幫助你：
- 記錄所有版本，並能夠切換至過去某個版本的狀態
  *就像是：需要一個新版本，就開一個新資料夾，並以看似亂數的字母數字命名，避免衝突*
- 若你的報告是與其他人協作，它也可以幫助你記錄作出異動的使用者
- Git 是**分散式**的版控系統，沒有網路或伺服器時，也可以在自己電腦操作，待有網路及伺服器時再同步即可

### Git 簡介 & 基本指令
![](https://static.coderbridge.com/img/techbridge/images/kdchang/cs101/git-workflow.png)  
*(圖片來源 / kdchang @techbridge)*  

Git 用來保存資料的數據庫 (Repository，以下簡稱 repo) 分為：
1. 本地 (Local)：即自己的使用裝置
2. 遠端 (Remote)：本文使用 GitHub 作為遠端  

Git 檔案的處理狀態：
1. Untracked：未加入版本控制，尚在最初開發的工作資料夾 (working directory)
2. Staged：提交 (commit) 新版本前，檔案會先放在暫存區 (staging area)
3. Modified：已更動但尚未提交 (commit) 的檔案狀態
   * `$ git status` 可查詢檔案狀態

#### 第一次建立版本之流程
1. 設定 Git 的使用者  
`$ git config --global user.name "your name"`  
`$ git config --global user.email "your email"`  

2. 建立一個 repo，使所在資料夾讓 Git 控制  
`$ git init`  

3. 建立 .gitignore 將要忽略的檔案名稱輸入進 vim 編輯器  
`$ vim .gitignore` （按 ESC 輸入`:wq` 即可存檔退出）  

4. 把所有檔案加入版本控制 （含 `.gitignore`，要讓協作者也知道哪些檔案是被忽略的）  
`$ git add .`  

5. 建立第一個 commit （建立一個新版本）  
`$ git commit -am "init"`

#### 專案建立後
6.  
* 如有新檔案，記得也要加進版本控制；  
`$ git add .` or `$ git add "file name"`  

* 如只有更改舊檔案，可確認 commit 前的更動內容，  
`$ git diff`  
然後直接加入版本控制  
`$ git commit -am "secend commit"`  
*（-am 只會加入修改過的檔案，無法把新的檔案加入）*

7. 
* 查看詳細歷史記錄（含完整 commit 版號、信息、作者、時間）；  
`$ git log`  
* 查看簡易歷史記錄（含 commit 版號前七碼、信息、作者、時間）  
`$ git log --oneline`

#### 其他指令
1. `$ rm -rf .git` 刪除 Git 以及裡面檔案
2. `$ git rm --cached` 將檔案從 Git 移除（變成 untracked 狀態）
3. `$ git commit --amend` commit 後進入 Vim 編輯器修改 msg  
*（若已 push，建議不要在 local 端更改，容易造成其他人困擾！最好都是 push 前再次**檢查**）*
4. commit 後又反悔的指令：  
`$ git reset HEAD^` （預設參數為 --mixed）  
移除 staged 標記，變成 Modified 或 Untracked，內容是新版的  
`$ git reset --soft` 僅移除 commit，內容仍是新版  
`$ git reset --hard` 移除修改內容，完全回到上一版
5. `git checkout + commit 版號前七碼` 切換版本

### Branch 概念
![](https://ppt.cc/fWrz0x@.png)  
*(圖片來源 / Huli @Lidemy)*

　　通常為了保持 Master (如圖中的 main) 穩定性，要修改 bug 或開發新功能時，會複製當前的版本，建立一個 Branch (如圖中 new-feature) 出去。最後修改完成時，會再合併 (merge) 回 Master。

### Branch 基本指令
1. `$ git branch branch-name` 建立新 branch
2. `$ git branch -v` 查詢現在有哪些 branch
3. `$ git branch -d branch-name` 刪除 branch
4. `$ git checkout branch-name` 切換 branch
5. `$ git merge new-feature` 把 new-feature 合併進來

### 合併時遇到衝突 (conflit)
![](https://ppt.cc/fndbZx@.png)
*(圖片來源 / Huli @Lidemy)*  

舉例來說，在把 new-feature 合併進 master 時產生衝突。此時必須手動解決：

1. `$ git status`  
如上圖所示，確認 code.js 是在兩個地方都被修改

2. 進入 code.js 檔案裡

![](https://ppt.cc/fb50mx@.png)*(圖片來源 / Huli @Lidemy)*
  
`=======` 作為分隔兩個檔案的內容  
`<<<<<<< HEAD` 以下為目前所在的 branch 內容  
`>>>>>>> new-feature` 以上為 new-feature 裡的檔案內容

3. 手動更改為確定的內容，並把以上標記刪除後存檔

4. `$ git commit -am "resolve conflicts"` 再次 commit

5. `$ git log` 確認有 commit 後的版本 resolve conflicts

### GitHub 是什麼？
最一開始提到 **Git** 是一個版本控制的程式，那 **GitHub** 主要就是拿來存放 Git repo，也就是當作**遠端**資料庫 (Remote) 的地方。

### 如何把 Code 上傳至 GitHub？
1. 進入自己的 GitHub 主頁後，點選右上角的「+」，裡面再點選「New Repository」
2. 設定完數據庫名稱和敘述後，點選下方「Create repository」
3.
  * 如果什麼都沒有，要直接建立一個新的 repo
```
echo "剛設立的 repo 名稱" >> README.md
git init
git add README.md
git commit m "first commit"
git remote add origin https://github.com/帳號/repo-
name.git
git push -u origin master
```
  * 本地已經有一個 repo 了
```
git remote add origin https://github.com/帳號/repo-name.git"
git push -u origin master
```

### Git & GitHub 整合實作
遠端和本地不會自動同步，但只要知道三個指令就可以輕鬆達成：
  1. `$ git push`
  2. `$ git pull`
  3. `$ git clone`
***
#### 一般實作流程： 
  *（若 repo 不是在自己的 Github，要先在要使用的 repo 頁面點「fork」傳到自己的帳號內）*
  1. `$ git clone https://github.com/帳號/repo-name.git` 從遠端複製專案至本地
  2. `$ git branch branch-name` 開一條分支
  3. `$ git checkout branch-name` 切換至分支
  4. 做任何更動或編輯檔案
  5. `$ git add .` 若有新增檔案記得加入
  6. `$ git commit -am "msg"` 提交這次的版本並輸入訊息
  7. `$ git push origin branch-name` 上傳至 GitHub
  8. 到你的 GitHub 上點 「Compare & pull request」後，輸入完訊息，點選「Create pull request」
  9. 確認要將此 branch 合併回遠端的 master，點選「Merge pull request」，最後「Confirm merge」*(註)*
  10. 點選「Delete branch」刪除 branch
  11. `$ git checkout master` 切換回本地的 master
  12. `$ git pull origin master` 把合併後的版本同步回本地
  13. `$ git branch -d branch-name` 刪除本地的 branch

**註：為什麼不在本地 merge？因為無法看見檔案的變化。*

**懶人包：  
(第一次需 `clone` 回本地) → 本地開 `branch` 完成新版本 → `push` 上傳 GitHub → `merge` 回遠端 master → `pull` 下來合併後的版本 → 刪除兩地 `branch`*


>參考資料
>* [Git 教學(1) : Git 的基本使用](http://gogojimmy.net/2012/01/17/how-to-use-git-1-git-basic/)
>* [為你自己學 Git](https://gitbook.tw/)
>* [Git reset 的三種模式( soft mixed hard )比較](https://ithelp.ithome.com.tw/articles/10187303)
>* [連猴子都能懂的Git入門指南](https://backlog.com/git-tutorial/tw/)
>* [Git 與 Github 版本控制基本指令與操作入門教學](https://blog.techbridge.cc/2018/01/17/learning-programming-and-coding-with-python-git-and-github-tutorial/)
>* [Git達人教你搞懂GitHub基礎觀念](https://ithome.com.tw/news/95283)
>* [Git教學](https://kingofamani.gitbooks.io/git-teach/content/)