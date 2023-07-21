$(function () {
  $(".bar").click(function () {
    $(".item").slideToggle("");
    $(this).toggleClass('open');
  });
});
