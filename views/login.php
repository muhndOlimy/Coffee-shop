<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
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
      <form novalidate>
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