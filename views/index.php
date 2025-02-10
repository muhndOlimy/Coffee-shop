<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php Component::renderComponent("links.php"); ?>
    <title>Home | Coffee Express</title>
    <link rel="stylesheet" href="../public/styles/styles.css">
</head>
<body>
<header>
    <?php Component::renderComponent("nav.php"); ?>
</header>

<main class="home">
    <section class="hero" id="hero">
        <h1>Welcome to Coffee Express</h1>
        <p>Order your favorite coffee online and get it delivered fresh!</p>
        <a href="../public/menu.php" class="btn">View Menu</a>
    </section>
</main>

<footer>
    <p>&copy; 2024 Coffee Express. All rights reserved.</p>
</footer>
</body>
</html>