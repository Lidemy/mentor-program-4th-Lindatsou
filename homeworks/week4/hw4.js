/* eslint linebreak-style: ["error", "windows"] */
/* eslint-disable consistent-return */
const request = require('request');

const baseUrl = 'https://api.twitch.tv/kraken/games/top';
const clientID = '3z619i2ylz6fypyer2yeqfy1pxfrkf';

const options = {
  method: 'GET',
  url: `${baseUrl}?limit=10`,
  headers: {
    'Client-ID': clientID,
    Accept: 'application/vnd.twitchtv.v5+json',
  },
};

function getTopGames(error, response, body) {
  if (error) return console.log('error', error);

  let info;
  try {
    info = JSON.parse(body);
  } catch (e) {
    return console.log(e);
  }

  for (let i = 0; i < info.top.length; i += 1) {
    const gameViewers = info.top[i].viewers;
    const gameName = info.top[i].game.name;
    console.log(`${gameViewers} ${gameName}`);
  }
}

request(options, getTopGames);
