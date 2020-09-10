const apiUrl = 'https://dvwhnbka7d.execute-api.us-east-1.amazonaws.com/default/lottery';
const errorMsg = '系統不穩定，請再試一次。';

// 呼叫抽獎 API
function getPrize(callback) {
  const request = new XMLHttpRequest();
  request.open('GET', apiUrl, true);
  request.onload = () => {
    if (request.status >= 200 && request.status < 400) {
      let data;
      // 確認 data 是否為正確格式
      try {
        data = JSON.parse(request.response);
      } catch (err) {
        callback(errorMsg);
        return;
      }

      if (!data.prize) {
        callback(errorMsg);
        return;
      }

      // 沒有錯誤則將 data 回傳
      callback(null, data);
    } else {
      callback(errorMsg);
    }
  };

  request.onerror = () => {
    callback(errorMsg);
  };

  request.send();
}

// 監聽抽獎 button 點擊事件
document
  .querySelector('.lottery__btn')
  .addEventListener('click', () => {
    getPrize((err, data) => {
      if (err) {
        alert(err);
        return;
      }

      let className;
      let prizeDesc;

      // 依據拿到的 data 決定內容
      switch (data.prize) {
        case 'FIRST':
          className = 'first__prize';
          prizeDesc = '恭喜你中頭獎了！日本東京來回雙人遊！';
          break;

        case 'SECOND':
          className = 'second__prize';
          prizeDesc = '二獎！90 吋電視一台！';
          break;

        case 'THIRD':
          className = 'third__prize';
          prizeDesc = '恭喜你抽中三獎：知名 YouTuber 簽名握手會入場券一張，bang！';
          break;

        case 'NONE':
          className = 'none__prize';
          prizeDesc = '銘謝惠顧';
          break;

        default:
          alert(errorMsg);
      }

      // 顯示抽獎結果及更換背景
      document.querySelector('.lottery').classList.add(className);
      document.querySelector('.lottery__prize h2').innerHTML = prizeDesc;
      document.querySelector('.lottery__block').classList.toggle('hide');
      document.querySelector('.lottery__prize').classList.toggle('hide');
    });
  });
