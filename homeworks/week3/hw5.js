const readline = require('readline');

const rl = readline.createInterface({
  input: process.stdin,
});

const lines = [];

rl.on('line', (line) => {
  lines.push(line);
});

/* eslint linebreak-style: ["error", "windows"] */
/* eslint-disable consistent-return */
// 比大
function whoIsBig(a, b) {
  const lengthA = a.length;
  const lengthB = b.length;
  if (lengthA !== lengthB) return lengthA > lengthB ? 'A' : 'B';
  if (lengthA === lengthB) return a > b ? 'A' : 'B';
}

// 比小
function whoIsSmall(a, b) {
  const lengthA = a.length;
  const lengthB = b.length;
  if (lengthA !== lengthB) return lengthA < lengthB ? 'A' : 'B';
  if (lengthA === lengthB) return a < b ? 'A' : 'B';
}

// 主程式碼
function solve(input) {
  const n = Number(input[0]);
  for (let i = 1; i <= n; i += 1) {
    const [a, b, bigOrSmall] = input[i].split(' ');
    if (a === b) console.log('DRAW');
    if (a !== b && bigOrSmall === '1') {
      console.log(whoIsBig(a, b));
    }
    if (a !== b && bigOrSmall === '-1') {
      console.log(whoIsSmall(a, b));
    }
  }
}

rl.on('close', () => {
  solve(lines);
});
