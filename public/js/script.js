$(function () {
  $(".bar").click(function () {
    $(".item").slideToggle("");
    $(this).toggleClass('open');
  });
});

let modalMenu = false;

//HTMLからの引数から投稿IDを取得
let editModal = function (id) {

  //.editModal-投稿IDと一致するものを定数に格納
  let checkForm = document.querySelector('.editModal-' + id);
  scrollTo(0, 0);
  if (modalMenu === false) {
    checkForm.style.display = "flex";
    modalMenu = true;
  }
  else if (modalMenu === true) {
    checkForm.style.display = "none";
    modalMenu = false;
  }
}

let deleteModal = function (id) {

  //.editModal-投稿IDと一致するものを定数に格納
  let checkForm = document.querySelector('.editModal-' + id);
  scrollTo(0, 0);
  if (modalMenu === false) {
    checkForm.style.display = "flex";
    modalMenu = true;
  }
  else if (modalMenu === true) {
    checkForm.style.display = "none";
    modalMenu = false;
  }
}
