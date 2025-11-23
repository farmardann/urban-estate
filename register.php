<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>
      UrbanEstate Registration | Join SEA's Leading Real Estate Platform
    </title>

  <link rel="stylesheet" href="assets/css/register.css" />
  </head>
  <body>
    <main class="main-container">
      <section class="hero-section">
        <div class="hero-content">
          <div class="hero-text-group">
            <h1 class="hero-title">UrbanEstate</h1>
            <p class="hero-subtitle">
              The most popular peer to peer real estate at SEA
            </p>
          </div>
          <a
            href="index.php"
            class="read-more-btn"
            style="text-decoration: none"
            >Read More</a
          >
        </div>
      </section>

      <section class="registration-section">
        <div class="registration-container">
          <div class="welcome-section">
            <h2 class="welcome-title">Hello!</h2>
            <p class="welcome-subtitle">Sign Up to Get Started</p>
          </div>

          <form class="form-container" action="register-proses.php" method="post">
            <div class="input-group">
              <div class="input-group">
                <img
                  src="assets/images/img_bxbxsuser.svg"
                  alt="User icon"
                  class="input-icon"
                />
                <input
                  type="text"
                  class="form-input"
                  placeholder="Username"
                  name="username"
                  required
                />
              </div>

              <div class="input-group">
                <img
                  src="assets/images/img_codiconmail.svg"
                  alt="Email icon"
                  class="input-icon"
                />
                <input
                  type="email"
                  class="form-input"
                  placeholder="Email Address"
                  name="email"
                  required
                />
              </div>

              <div class="input-group">
                <img
                  src="assets/images/img_bxbxslockalt.svg"
                  alt="Lock icon"
                  class="input-icon"
                />
                <input
                  type="password"
                  class="form-input"
                  placeholder="Password"
                  name="password"
                  required
                />
              </div>
            </div>
            <button type="submit" class="register-button" name="register" id="register" >Register</button>
          </form>
        </div>
      </section>
    </main>
  </body>
</html>
