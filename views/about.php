<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php Component::renderComponent("links.php"); ?>
    <title>About | Coffee Express</title>
    <link rel="stylesheet" href="../public/styles/styles.css">
</head>
<body>
<header>
    <?php Component::renderComponent("nav.php"); ?>
</header>

<main>
    <section id="about">
        <h2>About Us</h2>
        <p>
            We are more than just a coffee provider – we are a community of coffee enthusiasts dedicated to delivering
            exceptional coffee experiences. Our mission is to bring the world’s finest coffee beans straight to your
            cup, ensuring every sip is a journey of rich flavors and aromas.
        </p>
    </section>

    <section id="we-offer">
        <h2>What We Offer</h2>
        <div class="services">
            <div class="service">
                <h4>Artisanal Coffee</h4>
                <p>Handpicked beans roasted to perfection.</p>
            </div>
            <div class="service">
                <h4>Sustainable Sourcing</h4>
                <p>Supporting farmers and eco-friendly practices.</p>
            </div>
            <div class="service">
                <h4>Personalized Experience</h4>
                <p>Blends tailored to suit every palate.</p>
            </div>
            <div class="service">
                <h4>Community-Driven Values</h4>
                <p>Bringing coffee lovers together through shared passion.</p>
            </div>

        </div>
    </section>
</main>

<?php Component::renderComponent("footer.php"); ?>
<?php Component::renderComponent("modal.php"); ?>
</body>
</html>