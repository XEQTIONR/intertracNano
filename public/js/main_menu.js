/** main_menu.js
@author Ishtehar Hussain
@desc The animation for the drop-down menus
**/

$(document).ready(function(){

//  $(".subMenu").hide();         //slideToggle changes this to show

  $("#reportLabel").hover(function(){
    $("#theMenu2").hide();
    $("#theMenu3").hide();
    $("#theMenu").slideDown(500);}, function(){

      if ($("#theMenu").is(':hover')) {}
      else{
        $("#theMenu").slideUp(500);
      }});

  $("#infoLabel").hover(function(){
    $("#theMenu").hide();
    $("#theMenu3").hide();
    $("#theMenu2").slideDown(500);}, function(){
      if ($("#thisMenu2").is(':hover')) {}
      else{
        $("#theMenu2").slideUp(500);
      }});

    $("#actionLabel").hover(function(){
      $("#theMenu").hide();
      $("#theMenu2").hide();
      $("#theMenu3").slideDown(500);}, function(){
        if ($("#thisMenu2").is(':hover')) {}
        else{
          $("#theMenu2").slideUp(500);
        }});

    $("#navMain").hover(function(){$(".subMenu").slideUp();});

    $("#theMenu").hover(function(){ $("#theMenu").show();},
                        function(){ $("#theMenu").slideUp();});

    $("#theMenu2").hover(function(){ $("#theMenu2").show();},
                        function(){ $("#theMenu2").slideUp();});

    $("#theMenu3").hover(function(){ $("#theMenu3").show();},
                        function(){ $("#theMenu3").slideUp();});
});
