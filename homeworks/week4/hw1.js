/* eslint linebreak-style: ["error", "windows"] */
/* eslint-disable consistent-return */
const request = require('request');

const baseUrl = 'https://lidemy-book-store.herokuapp.com';

request(
  `${baseUrl}/books?_limit=10`, (error, response, body) => {
    if (error) return console.log('error', error);

    let json;
    try {
      json = JSON.parse(body); // 使用 try ... catch 處理，避免格式錯誤
    } catch (e) {
      return console.log(e);
    }

    for (let i = 0; i < json.length; i += 1) {
      console.log(`${json[i].id} ${json[i].name}`);
    }
  },
);
