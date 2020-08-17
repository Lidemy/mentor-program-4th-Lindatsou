document
  .querySelector('.section')
  .addEventListener('click', (e) => {
    const faqBlock = e.target.closest('.section__question').classList;
    faqBlock.toggle('hide');
    faqBlock.toggle('question__btn');
  });
