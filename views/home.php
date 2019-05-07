<!DOCTYPE html>
<html lang="en">
  	<head>
	    <?php include('layout/head.php'); ?>
  	</head>
  	<body>
    	<?php include('layout/header.php'); ?>
        <main role="main">
            <section class="jumbotron text-center">
                <div class="container">
                    <?php include('layout/alert.php'); ?>
                    <p class="lead text-muted"><?= "Welcome ". Core\Session::get('user')['name']."!."; ?></p>
                </div>
            </section>
        </main>
    </body>
    <?php include('layout/footer.php'); ?>
</html>