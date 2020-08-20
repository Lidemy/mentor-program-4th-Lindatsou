/* eslint-disable no-alert */
/* eslint-disable no-restricted-syntax */

document
  .querySelector('form')
  .addEventListener('submit', (e) => {
    e.preventDefault();

    // 檢查 input 欄位
    const inputs = document.querySelectorAll('.required input:not([type=radio])');
    for (const input of inputs) {
      if (!input.value) {
        input.parentNode.parentNode.classList.remove('hide');
      } else {
        input.parentNode.parentNode.classList.add('hide');
      }
    }

    // 檢查 radio 欄位
    const radios = document.querySelectorAll('.required input[type=radio]');
    let checkedRadio = '';
    for (const radio of radios) {
      // eslint-disable-next-line no-shadow
      if (![...radios].some(radio => radio.checked)) {
        radio.parentNode.parentNode.parentNode.classList.remove('hide');
      } else {
        radio.parentNode.parentNode.parentNode.classList.add('hide');
      }
    }

    // 取 radio 內容
    for (let i = 0; i < radios.length; i += 1) {
      if (radios[i].checked) {
        checkedRadio += radios[i].value;
      }
    }

    const nickname = document.querySelector('input[name=nickname]').value;
    const email = document.querySelector('input[name=email]').value;
    const mobile = document.querySelector('input[name=mobile]').value;
    const referral = document.querySelector('input[name=referral]').value;

    // 確認必填問題皆有填寫
    const requiredNum = document.querySelectorAll('.required').length;
    const hideNum = document.querySelectorAll('.hide').length;
    if (hideNum === requiredNum) {
      alert(`
          請確認資料：
          您的暱稱：${nickname}
          電子郵件：${email}
          手機號碼：${mobile}
          報名類型：${checkedRadio}
          怎麼知道這個活動的：${referral}
        `);
    }

    /* 原本想用文件是否有出現 hide 來驗證是否可送出，但發現邏輯好像不通XD
    const form = document.querySelector('form');
    if (form.outerHTML.indexOf('hide') === -1) {
      // console.log(form.outerHTML);
      // console.log(form.outerHTML.indexOf('hide'));
      e.preventDefault();
    } else {
      // console.log(form.outerHTML);
      // console.log(form.outerHTML.indexOf('hide'));
      alert(`
          請確認資料是否正確：
          您的暱稱：${nickname}
          電子郵件：${email}
          手機號碼：${mobile}
          報名類型：${checkedRadio}
          怎麼知道這個活動的：${referral}
        `);
    }
    */
  });
