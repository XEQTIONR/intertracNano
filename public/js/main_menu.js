$(document).ready(function(){

  $(".subMenu").hide();         //slideToggle changes this to show
  $(".icons8-Bar-Chart, #reportLabel").click(function(){

      $("#theMenu").slideToggle();
      $("#theMenu2").hide();
      $("#theMenu3").hide();
  });
  $(".icons8-Visible, #infoLabel").click(function(){
    $("#theMenu2").slideToggle();
    $("#theMenu").hide();
    $("#theMenu3").hide();
  });
  $(".icons8-Add, #actionLabel").click(function(){
    $("#theMenu3").slideToggle();
    $("#theMenu2").hide();
    $("#theMenu").hide();
  });
});
