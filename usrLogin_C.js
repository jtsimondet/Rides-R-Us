function fnLogin() {
 var oUname = document.getElementById("mName")
 var oUpass = document.getElementById("mPass")
 var oError = document.getElementById("error_box")
 var isError = true;
 if (oUname.value.length > 20 || oUname.value.length < 6) {
  oError.innerHTML = "User name should be 6 - 20 characters";
  isError = false;
  return;
 }else if((oUname.value.charCodeAt(0)>=48) && (oUname.value.charCodeAt(0)<=57)){
  oError.innerHTML = "User name should start with alphabet";
  return;
 }else for(var i=0;i<oUname.value.charCodeAt(i);i++){
  if((oUname.value.charCodeAt(i)<48)||(oUname.value.charCodeAt(i)>57) && (oUname.value.charCodeAt(i)<97)||(oUname.value.charCodeAt(i)>122)){
   oError.innerHTML = "Password is made up with alphabets and numbers";
   return;
  }
 }
 
 if (oUpass.value.length > 20 || oUpass.value.length < 6) {
  oError.innerHTML = "Password should be 6 - 20 characters"
  isError = false;
  return;
 }
 window.alert("Login Successful!")
 window.location.href = "customerpage.html"
}