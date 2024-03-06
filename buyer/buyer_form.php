
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="style.css">
  <title>login and signup page</title>
</head>

<body>
  <div class="container" id="container">
    <div class="form-container sign-up-container">
      <form method="POST" action="insert_buyer.php">
        <h1>Create Account</h1>
        <input type="text" placeholder="name" name="b_name" />
        <input type="email" placeholder="email" name="b_mail"/>
        <input type="password" placeholder="Password" name="b_pass" />
        <input type="text" placeholder="Address" name="b_adress" />
        <input type="text" placeholder="Phone" name="b_phone" />
        <input type="text" placeholder="PIN" name="b_pin" />
        
        <button type="submit" >Sign Up</button>
      </form>
    </div>
</body>
</html>
