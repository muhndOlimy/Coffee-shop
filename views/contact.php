<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php Component::renderComponent("links.php"); ?>
    <script src="../public/scripts/validators.js" defer></script>
    <script src="../public/scripts/contact.js" defer></script>
    <title>Contact Us</title>
    <link rel="stylesheet" href="../public/styles/styles.css">
</head>
<body>
<header>
    <?php Component::renderComponent("nav.php"); ?>
</header>

<main>
    <section id="contact">
        <h1>Contact Us</h1>
        <form method="post" action="#" novalidate>
            <div>
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
                <div id="name_error" class="error"></div>
            </div>
            <div>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                <div id="email_error" class="error"></div>
            </div>
            <div>
                <label for="message">Message:</label>
                <textarea id="message" name="message" rows="5" required></textarea>
                <div id="message_error" class="error"></div>
            </div>
            <button type="submit">Send Message</button>
        </form>
    </section>
</main>

<footer>
    <p>&copy; 2024 Coffee Express. All rights reserved.</p>
</footer>
</body>
</html>