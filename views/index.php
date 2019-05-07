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
                    <h1 class="jumbotron-heading">Priscy framework</h1>
                    <?php include('layout/alert.php'); ?>
                    <p class="lead text-muted">Small and simple framework for small projects.</p>
                    <p>
                        <?php if(Core\Session::exists('user')) { ?>
                        <a href="<?= BASE_URL.'user/home/'; ?>" class="btn btn-primary my-2">Home</a>
                        <?php } else { ?>    
                        <a href="<?= BASE_URL.'user/register/'; ?>" class="btn btn-primary my-2">Register</a>
                        <a href="<?= BASE_URL.'user/login/'; ?>" class="btn btn-secondary my-2">Login</a>
                        <?php } ?>
                    </p>
                </div>
            </section>
        </main>
    </body>
    <?php include('layout/footer.php'); ?>
</html>