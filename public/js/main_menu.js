$(document).ready(function(){

  $(".subMenu").hide();         //slideToggle changes this to show
  $("#reportLabel").click(function(){
      $("#theMenu").slideToggle();
      $("#theMenu2").hide();
      $("#theMenu3").hide();

      $("#reportMenuItem").addClass("active");
      $("#infoMenuItem").removeClass("active");
      $("#actionMenuItem").removeClass("active");


  });
  $("#infoLabel").click(function(){
    $("#theMenu2").slideToggle();
    $("#theMenu").hide();
    $("#theMenu3").hide();

    $("#infoMenuItem").addClass("active");
    $("#reportMenuItem").removeClass("active");
    $("#actionMenuItem").removeClass("active");

  });
  $("#actionLabel").click(function(){
    $("#theMenu3").slideToggle();
    $("#theMenu2").hide();
    $("#theMenu").hide();

    $("#actionMenuItem").addClass("active");
    $("#reportMenuItem").removeClass("active");
    $("#infoMenuItem").removeClass("active");
  });
});
