<!-- Make sure Font Awesome is loaded on pages including this footer! -->

<style>
  footer {
    background-color: #004080;
    color: white;
    padding: 40px 20px;
    font-family: 'Poppins', sans-serif;
  }

  .footer-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    gap: 30px;
    max-width: 1200px;
    margin: auto;
  }

  .footer-section {
    flex: 1 1 250px;
    min-width: 220px;
  }

  .footer-section h3 {
    margin-bottom: 15px;
    font-size: 20px;
  }

  .footer-section p,
  .footer-section a {
    font-size: 16px;
    line-height: 1.6;
    color: white;
    text-decoration: none;
  }

  .footer-section a:hover {
    text-decoration: underline;
  }

  .footer-links ul {
    list-style: none;
    padding: 0;
  }

  .footer-links li {
    margin-bottom: 8px;
  }

  .social-icons {
    display: flex;
    gap: 15px;
  }

  .social-icons a {
    color: white;
    font-size: 22px;
    transition: color 0.3s ease;
  }

  .social-icons a:hover {
    color: #cce4ff;
  }

  .footer-bottom {
    text-align: center;
    font-size: 15px;
  }

  /* Responsive Adjustments */
  @media (max-width: 768px) {
    .footer-container {
      flex-direction: column;
      align-items: flex-start;
    }

    .footer-section {
      width: 100%;
    }

    .footer-section h3 {
      font-size: 18px;
    }

    .footer-section p,
    .footer-section a {
      font-size: 15px;
    }

    .social-icons {
      justify-content: flex-start;
    }
  }

  /* Large screens: upscale content */
  @media (min-width: 1600px) {
    .footer-section h3 {
      font-size: 24px;
    }

    .footer-section p,
    .footer-section a {
      font-size: 18px;
    }

    .social-icons a {
      font-size: 26px;
    }

    .footer-bottom {
      font-size: 17px;
    }
  }

  @media (min-width: 1920px) {
    footer {
      padding: 60px 40px;
    }

    .footer-container {
      max-width: 1600px;
    }

    .footer-section h3 {
      font-size: 26px;
    }

    .footer-section p,
    .footer-section a {
      font-size: 20px;
    }

    .social-icons a {
      font-size: 28px;
    }

    .footer-bottom {
      font-size: 18px;
    }
  }
</style>

<footer>
  <div class="footer-container">

    <!-- About Section -->
    <div class="footer-section">
      <h3>About Job Nest</h3>
      <p>
        Job Nest is a platform that connects talented individuals with top employers across Pakistan. Find your dream job or the perfect candidate with ease.
      </p>
    </div>

    <!-- Quick Links -->
    <div class="footer-section footer-links">
      <h3>Quick Links</h3>
      <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="jobs.php">Browse Jobs</a></li>
        <li><a href="login.php">Login</a></li>
        <li><a href="register.php">Register</a></li>
      </ul>
    </div>

    <!-- Contact Info -->
    <div class="footer-section">
      <h3>Contact Us</h3>
      <p><i class="fas fa-map-marker-alt" style="margin-right: 8px;"></i> Karachi, Pakistan</p>
      <p><i class="fas fa-envelope" style="margin-right: 8px;"></i> support@jobnest.com</p>
      <p><i class="fas fa-phone" style="margin-right: 8px;"></i> +92 123 4567890</p>
    </div>

    <!-- Social Media -->
    <div class="footer-section">
      <h3>Follow Us</h3>
      <div class="social-icons">
        <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
        <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
        <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
        <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
      </div>
    </div>

  </div>

  <div class="footer-bottom">
    <p>© 2025 Job Nest. All rights reserved.</p>
  </div>
</footer>