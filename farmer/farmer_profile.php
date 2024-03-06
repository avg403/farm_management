<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farmer Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="profile/style.css">
</head>

<body>
    <div class="card">
        <div class="img">
            <img src="profile/profile.png">
        </div>

        <div class="infos">
            <div>
                <h1 color="grey">MY PROFILE</h1>
            </div>
            <div class="name">

                <?php
                require 'farmer.php';

                $farmer = new Farmer();
                $farmer->displayProfile();
                ?>
            </div>

            <div class="links">
                <button class="follow" onclick=" window.location.href = 'farmer_home.php'">HOME</button>
                <!--<button class="view">SIMPLE</button>-->
            </div>
        </div>
    </div>
</body>

</html>