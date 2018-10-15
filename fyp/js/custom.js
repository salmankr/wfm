$(document).ready(function(){
$('#btn_login').click(function(e){

var email = $('#email').val();
var pass = $('#pass').val();
var sel = $('#sel').val();
if(email == "" && pass == "" && sel == "---"){

$('#email').addClass('red');
$('#pass').addClass('red');
$('#sel').addClass('red');
e.preventDefault();
}

else{

$('#login_form').submit();
}
});

$('#email').focus(function(){

$('#email').removeClass('red');
});
$('#pass').focus(function(){

$('#pass').removeClass('red');
});
$('#sel').focus(function(){

$('#sel').removeClass('red');
});




});