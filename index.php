<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login | CST8285 Blog Platform</title>
  <link rel="stylesheet" href="./style.css">
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
          <h2 class="section-title">Welcome Back</h2>
          <p class="section-subtitle">Sign in to continue to your account</p>
          
          <form id="login-form" method="post" action="./Authentication/process.php">
            <div class="form-group">
              <label for="email"><i class="fas fa-envelope"></i> Email Address</label>
              <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email" required>
            </div>
            
            <div class="form-group">
              <label for="password"><i class="fas fa-lock"></i> Password</label>
              <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password" required>
            </div>
            
            <button type="submit" name="login" class="btn btn-primary btn-block">
              <i class="fas fa-sign-in-alt"></i> Sign In
            </button>
            
            <div class="text-center mt-3">
              <a href="./Authentication/register.php" class="btn-link">
                <i class="fas fa-user-plus"></i> Don't have an account? Register now
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