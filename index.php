<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Blog Platform</title>
  <link rel="stylesheet" href="./style.css">
</head>

<body>
  <header>
    <h1>Blog Platform</h1>
  </header>
  <main>
    <section id="login-section">
      <h2>Login</h2>
      <form id="login-form" method="post" action="./Authentication/process.php">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="login">Login</button>
        <a href="./Authentication/register.php">I don't have an account</a>
      </form>
  </main>
  <script src="script.js"></script>
</body>

</html>