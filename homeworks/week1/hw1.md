## 交作業流程

1. 新開一個 branch - `git branch week1`
2. 切換到 branch - `git checkout week1`  
(以上兩點可結合成 `git checkout -b week1`)

3. 寫完後確認 - `git status`
4. 把新增的檔案加入版本控制 - `git add .`
5. 確認後提交 - `git commit -am "week1"`
6. 作業完成後推至 GitHub - `git push origin week1`
7. 到 GitHub 上進入 **Pull request**，在 week1 訊息欄點選 Compare & pull request
8. 確認內容無誤後，即可點選 **Create pull request**
9. 再來複製 PR 連結，上傳到學習系統的作業列表

(待助教批改完成後，顯示 Merged)

10. 切換至 master - `git checkout master`  

11. 將遠端的 repo 同步回 local - `git pull origin master`  

12. 將 local 的 branch 刪除 - `git branch -d week1`  

13. 確認已刪除 branch 只剩 master - `git branch -v`