$(document).ready(function (){ 

// $("#home").click(function(event){
  // $.get("accueil.php", function(data) {
    // $("#content").html(data);
  // });
  // });
  
  

  

$("#check_acc").click(function(event){
  $.get("check_account.php", function(data) {
    $("#content").html(data);
  });
  });
  
  

  

$("#check_imei").click(function(event){
  $.get("check_imei.php", function(data) {
    $("#content").html(data);
  });
  });
  
  

$("#unlock").click(function(event){
  $.get("unlock.php", function(data) {
    $("#content").html(data);
  });
  });
  
  }); 
