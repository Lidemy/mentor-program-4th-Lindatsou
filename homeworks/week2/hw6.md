``` js
function isValid(arr) {
  for(var i=0; i<arr.length; i++) {
    if (arr[i] <= 0) return 'invalid'
  }
  for(var i=2; i<arr.length; i++) {
    if (arr[i] !== arr[i-1] + arr[i-2]) return 'invalid'
  }
  return 'valid'
}

isValid([3, 5, 8, 13, 22, 35])
```

## 執行流程
0. 第 2 行先宣告函式 isValid 並設定參數 arr，等待被呼叫
1. 執行第 12 行，呼叫函式 isValid 並代入引數為陣列 [3, 5, 8, 13, 22, 35]
2. 執行第 2 行，執行函式 isValid
3. 執行第 3 行，設定變數 i 為 0，判斷 i 是否小於陣列長度 (6)，是，繼續執行，進入第一個 for 迴圈
4. 執行第 4 行，判斷 arr[0] (此時為 3 ) 是否 <= 0，否
5. 第一圈迴圈結束，跑回第 3 行，i++，i 變成 1，判斷 i 是否小於陣列長度(6)，是，繼續執行
6. 執行第 4 行，判斷 arr[1] (此時為 5 ) 是否 <= 0，否
7. 第二圈迴圈結束，跑回第 3 行，i++，i 變成 2，判斷 i 是否小於陣列長度(6)，是，繼續執行
8. 執行第 4 行，判斷 arr[2] (此時為 8 ) 是否 <= 0，否
9. 第三圈迴圈結束，跑回第 3 行，i++，i 變成 3，判斷 i 是否小於陣列長度(6)，是，繼續執行
10. 執行第 4 行，判斷 arr[3] (此時為 13 ) 是否 <= 0，否
11. 第四圈迴圈結束，跑回第 3 行，i++，i 變成 4，判斷 i 是否小於陣列長度(6)，是，繼續執行
12. 執行第 4 行，判斷 arr[4] (此時為 22 ) 是否 <= 0，否
13. 第五圈迴圈結束，跑回第 3 行，i++，i 變成 5，判斷 i 是否小於陣列長度(6)，是，繼續執行
14. 執行第 4 行，判斷 arr[5] (此時為 35 ) 是否 <= 0，否
15. 第六圈迴圈結束，跑回第 3 行，i++，i 變成 6，判斷 i 是否小於陣列長度(6)，否
16. 第一個 for 迴圈執行完畢
17. 執行第 6 行，設定變數 i 為 2，判斷 i 是否小於陣列長度(6)，是，繼續執行，進入第二個 for 迴圈
18. 執行第 7 行，判斷 arr[2] (此時為 8 ) 是否不等於 arr[2-1] + arr[2-2] (5 + 3 = 8)，否
19. 第一圈迴圈結束，跑回第 6 行，i++，i 變成 3，判斷 i 是否小於陣列長度(6)，是，繼續執行
20. 執行第 7 行，判斷 arr[3] (此時為 13 ) 是否不等於 arr[3-1] + arr[3-2] (8 + 5 = 13)，否
21. 第二圈迴圈結束，跑回第 6 行，i++，i 變成 4，判斷 i 是否小於陣列長度(6)，是，繼續執行
22. 執行第 7 行，判斷 arr[4] (此時為 22 ) 是否不等於 arr[4-1] + arr[4-2] (13 + 8 = 21)，是
23. 繼續執行第 7 行，回傳 'invalid'
24. 執行完畢

Ans：這個函式是在檢查是不是費氏數列