$(document).ready(function(){

  $(".subMenu").hide();         //slideToggle changes this to show
  $(".icons8-Bar-Chart, #reportLabel").click(function(){

      $("#theMenu").slideToggle();
      $("#theMenu2").slideUp();
      $("#theMenu3").slideUp();
  });
  $(".icons8-Visible, #infoLabel").click(function(){
    $("#theMenu2").slideToggle();
    $("#theMenu").slideUp();
    $("#theMenu3").slideUp();
  });
  $(".icons8-Add, #actionLabel").click(function(){
    $("#theMenu3").slideToggle();
    $("#theMenu2").slideUp();
    $("#theMenu").slideUp();
  });
});
