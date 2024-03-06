<!DOCTYPE html>
<html lang="en">
<?php
require 'admin.php'; // Include the Farmer class

$admin = new Admin(); ?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="profile/style.css">
</head>


<body>
    <div class="card">
        <div class="img">
            <?php
            $image = $admin->getAdminImage();
            ?>
            <img src="profile/<?php echo $image; ?>">
        </div>

        <div class="infos">
            <div>
                <h1 color="grey">MY PROFILE</h1>
            </div>
            <div class="name">

                <?php
                $admin->displayProfile();
                ?>
            </div>

            <div class="links">
                <button class="follow" onclick=" window.location.href = 'admin_home.php'">HOME</button>
            </div>
        </div>
    </div>
</body>

</html>