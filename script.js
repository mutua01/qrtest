function showHidePassword(passwordId) {
   var passwordInput = document.getElementById(passwordId);
   var showHideBtn = document.querySelector('.show-hide-btn[onclick="showHidePassword(\'' + passwordId + '\')"] i');
   if (passwordInput.type === "password") {
      passwordInput.type = "text";
      showHideBtn.classList.remove("fa-eye-slash");
      showHideBtn.classList.add("fa-eye");
   } else {
      passwordInput.type = "password";
      showHideBtn.classList.remove("fa-eye");
      showHideBtn.classList.add("fa-eye-slash");
   }
 }