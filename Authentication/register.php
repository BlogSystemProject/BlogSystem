<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Sets the character encoding and viewport for responsive design -->
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- Title of the webpage -->
  <title>Blog Platform</title>
  <!-- Link to the external CSS file for styling -->
  <link rel="stylesheet" href="../style.css" />
</head>

<body>
  <!-- Header section containing the main title -->
  <header>
    <h1>Blog Platform</h1>
  </header>

  <!-- Main content area -->
  <main>
    <!-- Section dedicated to the registration form -->
    <section id="register-section">
      <h2>Register</h2>
      <!-- Registration form with fields for user input -->
      <form id="registration-form" method="post" action="process.php">
        <!-- Input field for the first name -->
        <input type="text" name="fName" placeholder="FirstName" required />
        <!-- Input field for the last name -->
        <input type="text" name="lName" placeholder="LastName" required />
        <!-- Input field for the email address -->
        <input type="email" name="email" placeholder="Email" required />
        <!-- Input field for the password -->
        <input type="password" name="password" placeholder="Password" required />
        <!-- Input field to confirm the password -->
        <input type="password" name="confirm_password" placeholder="Confirm Password" required />

        <!-- Submit button to register the user -->
        <button type="submit" name="register">Register</button>
        <!-- Link to redirect users who already have an account -->
        <a href="../index.php">I already have an account</a>
      </form>
    </section>
  </main>

  <!-- Link to an external JavaScript file for additional functionality -->
  <script src="script.js"></script>
</body>

</html>