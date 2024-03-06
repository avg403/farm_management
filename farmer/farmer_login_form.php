<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="style.css">
  <title>login and signup page</title>
</head>

<body>
  <div class="container" id="container">
    <div class="form-container sign-up-container">
      <form method="POST" action="insert_farmer.php">
        <h1>Create Account</h1>
        <input type="text" placeholder="name" name="f_name" required>
        <input type="email" placeholder="email" name="f_mail" id="f_mail" required>
        <span id="email-error" class="error-message"></span>
        <input type="password" placeholder="Password" name="f_pass" required>
        <input type="text" placeholder="Address" name="f_address" required>
        <input type="text" placeholder="Phone" name="f_phone" id="f_phone" required>
        <span id="phone-error" class="error-message"></span>
        <input type="text" placeholder="PIN" name="f_pin" id="f_pin" required>
        <span id="pin-error" class="error-message"></span>


        <button type="submit">Sign Up</button>
      </form>
    </div>
    <div class="form-container sign-in-container">
      <form action="farmer_login.php" method="POST">
        <h1>Sign in</h1>
        <div class="social-container">
          <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
          <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
          <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
        </div>
        <span>or use your account</span>
        <input type="text" placeholder="Name" name="f_name" />
        <input type="password" placeholder="Password" name="f_pass" />

        <button type="submit">Sign In</button>
      </form>
    </div>
    <div class="overlay-container">
      <div class="overlay">
        <div class="overlay-panel overlay-left">
          <h1>Welcome Back!</h1>
          <p>To keep connected with us please login with your personal info</p>
          <button class="ghost" id="signIn">Sign In</button>
        </div>
        <div class="overlay-panel overlay-right">
          <h1>Hello, Farmer!</h1>
          <p>Enter your personal details and start journey with us</p>
          <button class="ghost" id="signUp">Sign Up</button>
        </div>
      </div>
    </div>
  </div>

  <script src="app.js"></script>
  <script>
    document.getElementById("f_mail").addEventListener("input", function() {
      const emailInput = this.value;
      const emailError = document.getElementById("email-error");
      const emailPattern = /^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/;

      if (emailPattern.test(emailInput)) {
        emailError.textContent = "";
      } else {
        emailError.textContent = "Invalid email format";
      }
    });

    document.getElementById("f_phone").addEventListener("input", function() {
      const phoneInput = this.value;
      const phoneError = document.getElementById("phone-error");
      const phonePattern = /^[6-9]\d{9}$/;

      if (phonePattern.test(phoneInput)) {
        phoneError.textContent = "";
      } else {
        phoneError.textContent = "Invalid phone number";
      }
    });

    document.getElementById("f_pin").addEventListener("input", function() {
      const pinInput = this.value;
      const pinError = document.getElementById("pin-error");
      const pinPattern = /^\d{6}$/;
      if (pinPattern.test(pinInput)) {
        pinError.textContent = "";
      } else {
        pinError.textContent = "Invalid PIN code";
      }
    });
  </script>
</body>

</html>
</body>

</html>