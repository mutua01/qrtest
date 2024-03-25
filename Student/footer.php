<!-- Your page content here -->
</main>
        </div>
    </div>

     <!-- Bootstrap Bundle with Popper -->
     <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
document.getElementById("showCurrentPassword").addEventListener("click", function() {
  var passwordField = document.getElementById("currentPassword");
  if (passwordField.type === "password") {
    passwordField.type = "text";
  } else {
    passwordField.type = "password";
  }
});

document.getElementById("showNewPassword").addEventListener("click", function() {
  var passwordField = document.getElementById("newPassword");
  if (passwordField.type === "password") {
    passwordField.type = "text";
  } else {
    passwordField.type = "password";
  }
});

document.getElementById("showConfirmPassword").addEventListener("click", function() {
  var passwordField = document.getElementById("confirmPassword");
  if (passwordField.type === "password") {
    passwordField.type = "text";
  } else {
    passwordField.type = "password";
  }
});
</script>



    </body>
</html>