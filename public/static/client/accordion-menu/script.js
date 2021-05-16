const list_cate = document.querySelectorAll('.list1');

function accordion(e) {
  e.stopPropagation();
  if (this.classList.contains('active')) {
    this.classList.remove('active');
  } else
  if (this.parentElement.parentElement.classList.contains('active')) {
    this.classList.add('active');
  } else
  {
    for (i = 0; i < list_cate.length; i++) {
      list[i].classList.remove('active');
    }
    this.classList.add('active');
  }
}
for (i = 0; i < list_cate.length; i++) {
  list_cate[i].addEventListener('click', accordion);
}