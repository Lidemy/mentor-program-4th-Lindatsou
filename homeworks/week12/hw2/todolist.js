/* eslint-disable no-undef, no-useless-return */
// jQuery
let id = 1;
const template = `<div class="list__content {todoClass}">
    <input class="content__checkbox" id="todo-{id}"></input>
    <label class="content__item" for="todo-{id}">{content}</label>
    <div class="content__btn-delete"></div>
  </div>`;

/* 防止瀏覽器將下列符號解析成 HTML 標籤 */
function escapeHtml(unsafe) {
  return unsafe
    .replace(/&/g, '&amp;')
    .replace(/</g, '&lt;')
    .replace(/>/g, '&gt;')
    .replace(/"/g, '&quot;')
    .replace(/'/g, '&#039;');
}

function restoreTodos(todos) {
  if (todos.length === 0) return;
  id = Number(todos[todos.length - 1].id) + 1;
  for (let i = 0; i < todos.length; i += 1) {
    const todo = todos[i];
    $('.todolist').append(
      template
        .replace('{content}', escapeHtml(todo.content))
        .replace(/{id}/g, String(todo.id))
        .replace('{todoClass}', todo.isDone ? 'checked' : ''),
    );
  }
}

function addTodo() {
  const value = $('.list__input-block').val();
  if (!value) return;
  $('.todolist').append(
    template
      .replace('{content}', escapeHtml(value))
      .replace(/{id}/g, id),
  );
  id += 1;
  $('.list__input-block').val('');
}

// 抓 url 的 id
const url = 'http://mentor-program.co/mtr04group6/linda/week12/todolist/';
const searchParams = new URLSearchParams(window.location.search);
const todoId = searchParams.get('id');

if (todoId) {
  $.getJSON(
    `${url}get_todo.php?id=${todoId}`, (data) => {
      const todos = JSON.parse(data.data.todo);
      restoreTodos(todos);
    },
  );
}

// 新增 todo
$('.btn-add').click(() => {
  addTodo();
});

$('.list__input-block').keydown((e) => {
  if (e.key === 'Enter') {
    addTodo();
  }
});

// 標註完成
$('.todolist').click((e) => {
  const { target } = e;
  if ($(target).hasClass('content__checkbox')) {
    $(target).parent().toggleClass('checked');
  }
});

// 刪除個別 todo
$('.todolist').on('click', '.content__btn-delete', (e) => {
  $(e.target).parent().remove();
});

// 刪除所有已完成事項
$('.btn-clear-all').click(() => {
  $('.list__content.checked').remove();
});

// 事項狀態篩選
$('.btn-group').on('click', 'label', (e) => {
  const target = $(e.target);
  const filter = target.attr('data-filter');
  $('.btn-group label.active').removeClass('active');
  target.addClass('active');
  if (filter === 'all') {
    $('.list__content').show();
  } else if (filter === 'uncomplete') {
    $('.list__content').show();
    $('.list__content.checked').hide();
  } else { // done
    $('.list__content').hide();
    $('.list__content.checked').show();
  }
});

// 儲存所有 todo
$('.btn-save').click(() => {
  const todos = [];
  $('.list__content').each((i, element) => {
    const input = $(element).find('.content__checkbox');
    const label = $(element).find('.content__item');
    todos.push({
      id: input.attr('id').replace('todo-', ''),
      content: label.text(),
      isDone: $(element).hasClass('checked'),
    });
  });
  const data = JSON.stringify(todos);
  $.ajax({
    type: 'POST',
    url: `${url}add_todo.php`,
    data: {
      todo: $(data),
    },
    success: (resp) => {
      const respId = resp.id;
      window.location = `index.html?id=${respId}`;
    },
    error: () => {
      $.alert('Error >_<');
    },
  });
});
