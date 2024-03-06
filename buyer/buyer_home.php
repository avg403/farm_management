<!DOCTYPE html>
<html>

<head>
    <title>HOME</title>
    <style>
        .product-card {
            border: 1px solid #ccc;
            margin: 10px;
            padding: 10px;
            text-align: center;
            width: 250px;
            display: inline-block;
        }
    </style>
</head>

<body>
    <?php include 'navbar.php' ?>
    <div class="container">
        <section id="home">

            <img src=green.jpg width=100% height=100%>

        </section>

        <section id="about">

            <?php include 'about_us.php' ?>
        </section>

        <section id=products>

            <?php include "display_products.php" ?>



        </section>
        <section id="footer">

            <?php include 'footer.php' ?>
        </section>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>s
</body>

</html>