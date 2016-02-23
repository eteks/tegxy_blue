function trim(str) {
return str.replace(/^\s*|\s*$/g,"");
}


function ChangePasswordValidation()
{
if(trim(document.getElementById('TxtUser').value)==""){
//alert("Please enter the User Name");
document.getElementById('msg_content').innerHTML='Please enter the User Name !';
document.getElementById('TxtUser').focus();
return false;


}else if(trim(document.getElementById('TxtOld').value)==""){
//alert("Please enter the Old Password");
document.getElementById('msg_content').innerHTML='Please enter the Old Password !';
document.getElementById('TxtOld').focus();
return false;

}else if(trim(document.getElementById('TxtNew').value)==""){
// alert("Please enter the New Password.");
document.getElementById('msg_content').innerHTML='Please enter the New Password !';
document.getElementById('TxtNew').focus();
return false;
} else if(trim(document.getElementById('TxtConfirm').value)==""){
// alert("Please enter the Confirm Password.");
document.getElementById('msg_content').innerHTML='Please enter the Confirm Password !';
document.getElementById('TxtConfirm').focus();
return false;
} 
else if(trim(document.getElementById('TxtConfirm').value)!=trim(document.getElementById('TxtNew').value)){
// alert("Your password does not match with new password.");
document.getElementById('msg_content').innerHTML='Your password does not match with new password !';
document.getElementById('TxtConfirm').focus();
return false;
}		   
return true;

}


function ForgetPass_Open()
{
window.location.href='ForgetPassword.php';	
}
function ChangePass_Open(){
window.location.href='ChangePassword.php';		
}



