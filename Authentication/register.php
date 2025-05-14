<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Sets the character encoding and viewport for responsive design -->
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- Title of the webpage -->
  <title>Register | CST8285 Blog</title>
  <!-- Link to the external CSS file for styling -->
  <link rel="stylesheet" href="../style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
  <header>
    <div class="header-bg"></div>
    <div class="container header-content">
      <div class="site-branding">
        <i class="fas fa-laptop-code site-logo"></i>
        <h1 class="site-title">CST8285 Blog</h1>
      </div>
    </div>
  </header>

  <main>
    <div class="container">
      <section class="card animate-fade-in">
        <div class="form-container">
          <h2 class="section-title">Create Account</h2>
          <p class="section-subtitle">Join our community and start sharing your ideas</p>
          
          <form id="registration-form" method="post" action="process.php">
            <div class="form-group">
              <label for="firstName"><i class="fas fa-user"></i> First Name</label>
              <input type="text" id="firstName" name="fName" class="form-control" placeholder="Enter your first name" required />
            </div>
            
            <div class="form-group">
              <label for="lastName"><i class="fas fa-user"></i> Last Name</label>
              <input type="text" id="lastName" name="lName" class="form-control" placeholder="Enter your last name" required />
            </div>
            
            <div class="form-group">
              <label for="email"><i class="fas fa-envelope"></i> Email Address</label>
              <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email address" required />
            </div>
            
            <div class="form-group">
              <label for="password"><i class="fas fa-lock"></i> Password</label>
              <input type="password" id="password" name="password" class="form-control" placeholder="Create a strong password" required />
            </div>
            
            <div class="form-group">
              <label for="confirm_password"><i class="fas fa-lock"></i> Confirm Password</label>
              <input type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="Confirm your password" required />
            </div>

            <button type="submit" name="register" class="btn btn-primary btn-block">
              <i class="fas fa-user-plus"></i> Create Account
            </button>
            
            <div class="text-center mt-3">
              <a href="../index.php" class="btn-link">
                <i class="fas fa-sign-in-alt"></i> Already have an account? Sign in
              </a>
            </div>
          </form>
        </div>
      </section>
    </div>
  </main>
  
  <footer>
    <div class="container footer-content">
      <div class="footer-logo">
        <i class="fas fa-laptop-code"></i> CST8285 Blog
      </div>
      <p class="footer-copyright">&copy; 2024 CST8285 Blog Platform. All rights reserved.</p>
    </div>
  </footer>
</body>

</html>