const readline = require('readline');

const rl = readline.createInterface({
  input: process.stdin,
});

const lines = [];

rl.on('line', (line) => {
  lines.push(line);
});

/* eslint linebreak-style: ["error", "windows"] */
// 判斷有幾位數字
function digitCount(num) {
  let orignalNumber = num;
  let result = 1;
  if ((orignalNumber / 10) < 1) return 1;
  while (orignalNumber > 9) {
    orignalNumber = Math.floor(orignalNumber / 10);
    result += 1;
  }
  return result;
}

// 判斷是否為水仙花數
function isNarcissistic(num) {
  let orignalNumber = num;
  let result = 0;
  const digit = digitCount(num);
  while (orignalNumber !== 0) {
    result += (orignalNumber % 10) ** digit;
    orignalNumber = Math.floor(orignalNumber / 10);
  }
  return result === num;
}

// 主程式碼
function solve(input) {
  const temp = input[0].split(' ');
  const n = Number(temp[0]);
  const m = Number(temp[1]);
  for (let i = n; i <= m; i += 1) {
    if (isNarcissistic(i)) console.log(i);
  }
}

rl.on('close', () => {
  solve(lines);
});
