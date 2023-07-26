$(function () {
  $(".bar").click(function () {
    $(".item").slideToggle("");
    $(this).toggleClass('open');
  });
});

let modalMenu = false;

//HTMLからの引数から投稿IDを取得
let editModal = function (id) {

  //post_IDと一致するものを定数に格納
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

// // 枠外クリックで閉じる
// let modal = document.getElementById('js-editModal');
// modal.addEventListener('click', (event) => {
//   if (event.target.closest('#js-uchigawa') === null) {
//     //alert('外側をクリックされました');
//     modal.style.display = "none";
//     modalMenu = false;
//   }
// });

// 枠外クリックで閉じる
let modals = document.querySelectorAll("[id='js-editModal']");
modals.forEach((modal) => {
  modal.addEventListener('click', (event) => {
    if (event.target.closest('#js-uchigawa') === null) {
      //alert('外側をクリックされました');
      modal.style.display = "none";
      modalMenu = false;
    }
  })
});


let deleteModal = function (id) {

  //post_IDと一致するものを定数とする
  let checkForm = document.querySelector('.deleteModal-' + id);
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

// $(document).on('click', function (e) {
//   if (!$(e.target).closest('.modal-inner').length) {
//     container.removeClass('active');
//   }
// });
