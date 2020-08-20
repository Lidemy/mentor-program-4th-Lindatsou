// 防止瀏覽器將下列符號解析成 HTML 標籤
function escapeHtml(unsafe) {
  return unsafe
    .replace(/&/g, '&amp;')
    .replace(/</g, '&lt;')
    .replace(/>/g, '&gt;')
    .replace(/"/g, '&quot;')
    .replace(/'/g, '&#039;');
}

document
  .querySelector('.list__input-block')
  .addEventListener('keyup', (e) => {
    const input = document.querySelector('input[type=input]').value;
    if (!input) {
      // eslint-disable-next-line no-alert
      alert('請重新輸入');
      return;
    }
    // 按下 Enter 新增待辦事項
    if (e.keyCode === 13 || e.keyCode === 108) {
      const listContent = document.createElement('div');
      listContent.classList.add('list__content');
      listContent.innerHTML = `
        <div class="content__checkbox"></div>
        <div class="content__item">${escapeHtml(input)}</div>
        <div class="content__delete-btn"></div>
      `;
      document.querySelector('.todolist').appendChild(listContent);
      document.querySelector('input[type=input]').value = '';
    }
  });

// 參考老師範例，target 用解構的方式，且直接透過 parent 控制底下的元素
document
  .querySelector('.todolist')
  .addEventListener('click', (e) => {
    const { target } = e;
    // 刪除事項
    if (target.classList.contains('content__delete-btn')) {
      target.parentNode.remove();
      return;
    }
    // 標註完成
    if (target.classList.contains('content__checkbox')) {
      target.parentNode.classList.toggle('checked');
    }
  });


/* 原本沒有想到能寫在一起，分了很多 class 寫得很長很雜亂，然後也沒有處理到動態新增的元素
document
  .querySelector('.todolist')
  .addEventListener('click', (e) => {
    if (e.target.classList.contains('content__delete-btn')) {
      document.querySelector('.todolist').removeChild(e.target.closest('.list__content'));
    }
  });
document
  .querySelector('.todolist')
  .addEventListener('click', (e) => {
    if (e.target.classList.contains('content__checkbox')) {
      document.querySelector('.content__item').classList.toggle('finished');
      document.querySelector('.content__checkbox').classList.toggle('checked');
    }
  });
*/
