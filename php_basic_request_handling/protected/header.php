<header>
	<nav>
		<a href="#"><h1>Nem lopott</h1></a>
		<div class="container-nav">
			<?php if (isset($_SESSION['username'])): ?>
				<ul>
					<li class="nav-item"><a href="index.php?state=list">List workers</a></li>
					<li class="nav-item"><a href="index.php?state=add">Add worker</a></li>
				</ul>
			<?php endif ?>
			
			<?php if (isset($_SESSION['username'])): ?>
				<form action="protected/logout.inc.php" mehtod="GET">
					<button class="nav-item" type="submit" name="logout-submit">Logout</button>
				</form>
			<?php else: ?>
				<form action="protected/login.inc.php" method="POST">
					<input class="login-field" type="text" name="uname" placeholder="Username">
					<input class="login-field" type="password" name="pwd" placeholder="Password">
					<button class="nav-item" type="submit" name="login-submit">Login</button>
				</form>
			<?php endif; ?>
		</div>
	</nav>
</header>