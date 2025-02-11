<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php Component::renderComponent("links.php"); ?>
    <script src="../public/scripts/menu.js" defer></script>
    <title>Menu | Coffee Express</title>
    <link rel="stylesheet" href="../public/styles/styles.css">
</head>
<body>
<template id="drink_template">
    <div class="menu-item">
        <div class="thumbnail">
            <img src="../public/assets/imgs/Espresso.avif" alt="Espresso">
        </div>
        <div class="desc">
            <h3>Espresso</h3>
            <form method="post" action="#" novalidate>
                <input type="hidden" name="drink-id">
                <input type="hidden" name="size">
                <div class="prices"></div>
            </form>
        </div>
    </div>
</template>

<header>
    <?php Component::renderComponent("nav.php"); ?>
</header>

<main class="menu">
    <section id="menu">
        <h1>Our Coffee Menu</h1>
        <div id="menu_list" class="menu">

        </div>
    </section>
</main>

<?php Component::renderComponent("footer.php"); ?>
<?php Component::renderComponent("modal.php"); ?>
</body>
</html>