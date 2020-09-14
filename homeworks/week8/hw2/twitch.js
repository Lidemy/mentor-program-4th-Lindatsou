/* eslint-disable no-restricted-syntax */
/* eslint-disable consistent-return */
const APIUrl = 'https://api.twitch.tv/kraken';
const clientID = '3z619i2ylz6fypyer2yeqfy1pxfrkf';
const accept = 'application/vnd.twitchtv.v5+json';
const errMsg = '系統不穩定，請重試一次。';
const request = new XMLHttpRequest();

/* 抓取前五個熱門遊戲 */
request.open('GET', `${APIUrl}/games/top?limit=5`, true);
request.setRequestHeader('Client-ID', clientID);
request.setRequestHeader('Accept', accept);
request.onload = () => {
  if (request.status >= 200 && request.status < 400) {
    let json;
    try {
      json = JSON.parse(request.response);
    } catch (err) {
      return console.log(err);
    }
    const games = json.top;
    for (const game of games) {
      const element = document.createElement('li');
      element.innerText = game.game.name;
      document.querySelector('.navbar__list').appendChild(element);
    }

    /* 顯示第一個遊戲名稱 */
    document.querySelector('h1').innerText = games[0].game.name;

    /* 顯示第一個遊戲的前 20 個實況頻道 */
    const request2 = new XMLHttpRequest();
    request2.open('GET', `${APIUrl}/streams/?game=${encodeURIComponent(games[0].game.name)}&limit=20`, true);
    request2.setRequestHeader('Client-ID', clientID);
    request2.setRequestHeader('Accept', accept);
    request2.onload = () => {
      if (request2.status >= 200 && request2.status < 400) {
        let data;
        try {
          data = JSON.parse(request2.response);
        } catch (err) {
          return console.log(err);
        }

        const channels = data.streams;
        for (const channel of channels) {
          const element = document.createElement('div');
          document.querySelector('.streams').appendChild(element);
          element.innerHTML = `<div class='stream__card-group'>
            <img src='${channel.preview.large}'>
            <div class='stream__card-content'>
              <div class='stream__card-avatar'>
                <img src='${channel.channel.logo}'>
              </div>
              <div class='stream__card-desc'>
                <div class='stream__card-title'>
                ${channel.channel.status}
                </div>
                <div class='stream__card-host'>
                ${channel.channel.name}
                </div>
              </div>
            </div>
          </div>`;
        }
      } else {
        return console.log('err', errMsg);
      }
    };
    request2.send();
  } else {
    return console.log('err', errMsg);
  }
};
request.send();

/* 監聽 navbar 點擊事件 */
document.querySelector('.navbar__list').addEventListener('click', (e) => {
  if (e.target.tagName.toLowerCase() === 'li') {
    const gameName = e.target.innerText;
    document.querySelector('h1').innerText = gameName;
    /* 清空原有實況頻道 */
    document.querySelector('.streams').innerHTML = '';
    /* 依照點擊的遊戲重新載入實況頻道 */
    const request2 = new XMLHttpRequest();
    request2.open('GET', `${APIUrl}/streams/?game=${encodeURIComponent(gameName)}&limit=20`, true);
    request2.setRequestHeader('Client-ID', clientID);
    request2.setRequestHeader('Accept', accept);
    request2.onload = () => {
      if (request2.status >= 200 && request2.status < 400) {
        let json;
        try {
          json = JSON.parse(request2.response);
        } catch (err) {
          return console.log(err);
        }

        const channels = json.streams;
        for (const channel of channels) {
          const element = document.createElement('div');
          document.querySelector('.streams').appendChild(element);
          element.innerHTML = `<div class='stream__card-group'>
            <img src='${channel.preview.large}'>
            <div class='stream__card-content'>
              <div class='stream__card-avatar'>
                <img src='${channel.channel.logo}'>
              </div>
              <div class='stream__card-desc'>
                <div class='stream__card-title'>
                ${channel.channel.status}
                </div>
                <div class='stream__card-host'>
                ${channel.channel.name}
                </div>
              </div>
            </div>
          </div>`;
        }
      }
    };
    request2.send();
  } else {
    return console.log('err', errMsg);
  }
});
