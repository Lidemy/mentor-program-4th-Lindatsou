/* eslint linebreak-style: ["error", "windows"] */
const request = require('request');

const baseUrl = 'https://restcountries.eu/rest/v2';
const name = process.argv[2];

request(
  `${baseUrl}/name/${name}`, (error, response, body) => {
    if (error) {
      console.log('error', error);
      return;
    }
    if (!name) {
      console.log('請重新輸入國家英文名稱');
      return;
    }

    let json;
    try {
      json = JSON.parse(body);
    } catch (e) {
      console.log(e);
      return;
    }

    if (json.status === 404) {
      console.log('找不到國家資訊');
    } else if (json.stasus >= 400) {
      console.log('Error');
      return;
    }

    for (let i = 0; i < json.length; i += 1) {
      console.log('============');
      console.log(`國家：${json[i].name}`);
      console.log(`貨幣：${json[i].currencies[0].code}`);
      console.log(`首都：${json[i].capital}`);
      console.log(`國碼：${json[i].callingCodes[0]}`);
    }
  },
);
