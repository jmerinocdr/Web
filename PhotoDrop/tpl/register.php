<div id="particles-js"></div>
    <div class="background">
		<div id="title"> 
			<h1>Photo Drop    <img src="../img/logo.png"></h1>
		</div>
		<div class="content">
			<div class="formularior">
				<form action="../lib/register.lib.php" method="post">
					<input type="hidden" name="action" value="register">
					<p>Name <input type="text" name="name" required=""></p>
					<p>Surname <input type="text" name="surname" required=""></p>
					<p>Sex</p>
					<ul>
						<li> <p>Man <input type="radio" name="sex" value="M" required></p></li>
						<li> <p>Woman <input type="radio" name="sex" value="W" required></p></li>
					</ul>
					<p>Firstday <input type="date" name="bday" required=""></p>
					<p>User photo <input type="file" name="uphoto" id="uphoto" required=""></p>
					<p>Username <input type="text" name="username" value=""></p>
					<p>Password <input type="password" name="passwd" required=""></p>
					<p>Rewrite Password <input type="password" name="ppasswd" required=""></p>
					<input  class="boton"  type="submit" name="Let's go">
				</form>
			</div>
		</div>
	</div>
</div>



<!-- scripts -->
<script src="../js/particles/particles.js"></script>
<script src="../js/particles/app.js"></script>