<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php Component::renderComponent("links.php"); ?>
    <script src="../public/scripts/validators.js" defer></script>
    <script src="../public/scripts/login.js" defer></script>
    <title>Login</title>
    <link rel="stylesheet" href="../public/styles/styles.css">
</head>
<body>
<header>
    <?php Component::renderComponent("nav.php"); ?>
</header>

<main>
    <section id="login">
        <h1>Login</h1>
        <form method="post" action="#" novalidate>
            <div>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                <div id="email_error" class="error"></div>
            </div>
            <div>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                <div id="password_error" class="error"></div>
            </div>
            <button type="submit">Login</button>
        </form>
    </section>
</main>

<footer>
    <p>&copy; 2024 Coffee Express. All rights reserved.</p>
</footer>
</body>
</html>