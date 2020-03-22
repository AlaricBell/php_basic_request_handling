<?php 
	session_start();
	require 'protected/functions.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="public/css/style.css">
	<title>Webprog2</title>
</head>
<body>
	<?php require_once "protected/header.php" ?>

	<main>
		<div class="container">
			<!-- *********************** SIGN UP *************************** -->
			<?php if (!isset($_SESSION['username'])): ?>
			<section class="signup-section centered">
				<h1>Sign up</h1>
				<?php if (isset($_GET['error']) && $_GET['error'] == 'emptyfields'): ?>
					<p class="warning">You must fill the empty fields!</p>
				<?php elseif (isset($_GET['error']) && $_GET['error'] == 'invalidfield'): ?>
					<p class="warning">You've entered invalid data!</p>
				<?php elseif (isset($_GET['error']) && $_GET['error'] == 'pwdconf'): ?>
					<p class="warning">Password doesn't match!</p>
				<?php endif ?>
				<form action="protected/signup.inc.php" method="POST">
					<input type="text" name="uname" placeholder="Username">
					<input type="email" name="email" placeholder="Email">
					<input type="password" name="pwd" placeholder="Password">
					<input type="password" name="pwd-conf" placeholder="Confirm password">
					<button class="btn" type="submit" name="signup-submit">Signup</button>
				</form>
			</section>
			<?php endif ?>
			<!-- *********************** WORKER LIST *************************** -->
			<?php if (isset($_SESSION['username']) && isset($_GET['state']) && $_GET['state'] == 'list'): ?>
				<section class="centered">
					<h1>Worker list</h1>
					<div class="container-card">
					<?php foreach (get_workers() as $worker): ?>
						<div class="card">
							<img class="avatar" src="public/img/placeholder.png" alt="placeholder">
							<div class="description">
								<p><?php echo $worker['name'] ?></p>
								<p><?php echo $worker['taj'] ?></p>
								<p><?php echo $worker['nation'] ?></p>
							</div>
							<div class="container-btn">
								<a class="btn" href="index.php?state=preview&taj=<?php echo $worker['taj'] ?>">Preview</a>
								<a class="btn" href="index.php?state=edit&taj=<?php echo $worker['taj'] ?>">Edit</a>
								<form action="protected/delete.inc.php" method="POST">
									<input type="hidden" name="taj" value="<?php echo $worker['taj'] ?>">
									<button class="btn" type="submit" name="delete-submit">Delete</button>
								</form>
							</div>
						</div>
					<?php endforeach ?>
					</div>
				</section>
			<?php endif ?>
			<!-- *********************** ADD WORKER *************************** -->
			<?php if (isset($_SESSION['username']) && isset($_GET['state']) && $_GET['state'] == 'add'): ?>
			<section class="upload-section centered">
				<h1>Add worker</h1>
				<?php if (isset($_GET['error']) && $_GET['error'] == 'emptyfields'): ?>
					<p class="warning">You must fill the empty fields!</p>
				<?php elseif (isset($_GET['error']) && $_GET['error'] == 'tajlngth'): ?>
					<p class="warning">Taj number is not 9 character!</p>
				<?php elseif (isset($_GET['error']) && $_GET['error'] == 'workerexists'): ?>
					<p class="warning">Worker already exists!</p>
				<?php endif ?>
				<form action="protected/add.inc.php" method="POST">
					<input type="text" name="wname" placeholder="Name">
					<input type="text" name="taj" placeholder="Taj number">
					<input type="text" name="nation" placeholder="Nation">
					<button class="btn" type="submit" name="add-submit">Add</button>
				</form>
			</section>
			<?php endif ?>
			<!-- *********************** EDIT WORKER *************************** -->
			<?php if (isset($_SESSION['username']) && isset($_GET['state']) && $_GET['state'] == 'edit'): ?>
				<section class="update-section centered">
				<h1>Edit worker: <?php echo get_worker_by_taj($_GET['taj'])['name'] ?></h1>
				<?php if (isset($_GET['error']) && $_GET['error'] == 'emptyfields'): ?>
					<p class="warning">You must fill the empty fields!</p>
				<?php elseif (isset($_GET['error']) && $_GET['error'] == 'tajlngth'): ?>
					<p class="warning">Taj number is not 9 character!</p>
				<?php endif ?>
				<form action="protected/update.inc.php" method="POST">
					<input type="text" name="wname" value="<?php echo get_worker_by_taj($_GET['taj'])['name']?>">
					<input type="text" name="taj" value="<?php echo get_worker_by_taj($_GET['taj'])['taj']?>">
					<input type="text" name="nation" value="<?php echo get_worker_by_taj($_GET['taj'])['nation']?>">
					<input type="hidden" name="id" value="<?php echo get_worker_by_taj($_GET['taj'])['id']?>">
					<input type="hidden" name="origin" value="<?php echo get_worker_by_taj($_GET['taj'])['taj']?>">
					<button class="btn" type="submit" name="update-submit">Update</button>
				</form>
			</section>
			<?php endif ?>
			<!-- *********************** PREVIEW WORKER *************************** -->
			<?php if (isset($_SESSION['username']) && isset($_GET['state']) && $_GET['state'] == 'preview'): ?>
			<section class="priview centered">
				<h1>Preview worker</h1>
				<img class="avatar" src="public/img/placeholder.png" alt="placeholder">
				<h2><?php echo get_worker_by_taj($_GET['taj'])['name'] ?></h2>
				<p><?php echo get_worker_by_taj($_GET['taj'])['taj'] ?></p>
				<p><?php echo get_worker_by_taj($_GET['taj'])['nation'] ?></p>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
				cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
				proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
				<a class="btn" href="index.php?state=list">Back</a>
			</section>
			<?php endif ?>
		</div>
	</main>

	<?php require_once "protected/footer.php" ?>
</body>
</html>