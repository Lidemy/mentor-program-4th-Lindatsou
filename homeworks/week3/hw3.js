const readline = require('readline');

const rl = readline.createInterface({
  input: process.stdin,
});

const lines = [];

rl.on('line', (line) => {
  lines.push(line);
});

/* eslint linebreak-style: ["error", "windows"] */
// 判斷是否為質數
function isPrime(number) {
  if (number === 1) return false;
  let result = 0;
  for (let i = 2; i <= number; i += 1) {
    if (number % i === 0) result += 1;
  }
  return result === 1;
}

// 主程式碼
function solve(input) {
  const n = Number(input[0]);
  for (let i = 1; i <= n; i += 1) {
    const p = Number(input[i]);
    if (isPrime(p)) {
      console.log('Prime');
    } else {
      console.log('Composite');
    }
  }
}

rl.on('close', () => {
  solve(lines);
});
