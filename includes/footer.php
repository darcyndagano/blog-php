
<!-- // footer --> 
<body>
<div class="footer">
<div class="footer-content">
  
  <div class="footer-section about">
	<h1 class="logo-text"><span>DUKORE </span> Tech</h1>
	
	<div class="contact">
	  <span><i class="fas fa-phone"></i> &nbsp; (+257) 57 99 00 99</span>
	  <span><i class="fas fa-envelope"></i> &nbsp; dada@exemple.com</span>
	</div>
	<div class="socials">
	  <a href="#"><i class="fab fa-facebook"></i></a>
	  <a href="#"><i class="fab fa-instagram"></i></a>
	  <a href="#"><i class="fab fa-twitter"></i></a>
	  <a href="#"><i class="fab fa-youtube"></i></a>
	</div>
  </div>

 
  <div class="footer-section contact-form">
	<h2>Contacter nous</h2>
	<br>
	<form action="submit_contact.php" method="post">
	  <input type="email" name="email" class="text-input contact-input" placeholder="Votre addresse e-mail..." required>
	  <textarea rows="4" name="message" class="text-input contact-input" placeholder="Votre message..." required></textarea>
	  <button type="submit" class="btn btn-big contact-btn">
		<i class="fas fa-envelope"></i>
	   Envoyer
	  </button>
	</form>
  </div>

</div>

<div class="footer-bottom">
  &copy; dukoretech.com | Designed by ND
</div>
</div>
			<p>MyViewers &copy; <?php echo date('Y'); ?></p>
		</div>
		<!-- // footer -->

	</div>
	<!-- // container -->
</body>
</html>