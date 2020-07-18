/* eslint linebreak-style: ["error", "windows"] */
/* eslint-disable consistent-return */
/* eslint-disable no-unused-vars */
const request = require('request');

const baseUrl = 'https://lidemy-book-store.herokuapp.com';

const action = process.argv[2];
const params = process.argv[3];

// 印出前二十本書的 id 與書名
function listBooks() {
  request(
    `${baseUrl}/books?_limit=20`, (error, _response, body) => {
      if (error) return console.log('發生錯誤', error);

      let json;
      try {
        json = JSON.parse(body);
      } catch (e) {
        return console.log(e);
      }

      for (let i = 0; i < json.length; i += 1) {
        console.log(`${json[i].id} ${json[i].name}`);
      }
    },
  );
}

// 輸入 id 獲取書籍資訊
function readBooks(id) {
  request(
    `${baseUrl}/books/${id}`, (error, _response, body) => {
      if (error) return console.log('發生錯誤', error);

      let json;
      try {
        json = JSON.parse(body);
      } catch (e) {
        return console.log(e);
      }
      console.log(json);
    },
  );
}

// 輸入 id 刪除書籍資訊
function deleteBooks(id) {
  request.delete(
    `${baseUrl}/books/${id}`, (error, _response, _body) => {
      if (error) return console.log('刪除失敗', error);
      console.log('刪除成功');
    },
  );
}

// 輸入書籍名稱新增書籍
function createBooks(name) {
  request.post(
    {
      url: `${baseUrl}/books`,
      form: {
        name,
      },
    }, (error, _response) => {
      if (error) return console.log('新增失敗', error);
      console.log('新增成功');
    },
  );
}

// 輸入 id 及書名更新書籍資訊
function updateBooks(id, name) {
  request.patch(
    {
      url: `${baseUrl}/books/${id}`,
      form: {
        name,
      },
    }, (error, _response) => {
      if (error) return console.log('更新失敗', error);
      console.log('更新成功');
    },
  );
}

switch (action) {
  case 'list': listBooks(); break;
  case 'read': readBooks(params); break;
  case 'delete': deleteBooks(params); break;
  case 'create': createBooks(params); break;
  case 'update': updateBooks(params, process.argv[4]); break;
  default:
    console.log('請輸入正確指令: list, read, delete, create, update 或檢查 id 是否正確');
}
