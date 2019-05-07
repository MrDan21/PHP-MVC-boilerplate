<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include(LAYOUT.'head.php'); ?>
    </head>
    <body>
        <?php include(LAYOUT.'header.php'); ?>
        <main role="main">
            <section class="jumbotron">
                <div class="container">
                    <div class="row justify-content-center">
                        <form action="<?= BASE_URL.'user/login/'; ?>" method="POST">
                            <h1 class="h3 mb-3 font-weight-normal">Login to your account</h1>
                            <?php include(LAYOUT.'alert.php'); ?>
                            <div class="form-group">
                                <label class="sr-only">Email address</label>
                                <input type="email" name="email" class="form-control" placeholder="Email address" value="<?= $_POST['email'] ?? ''; ?>">
                            </div>

                            <div class="form-group">
                                <label class="sr-only">Password</label>
                                <input type="password" class="form-control" name="password" placeholder="Password">
                            </div>
                            <div class="checkbox mb-3">
                                <label>
                                    <input type="checkbox" name="remember_me" value="remember-me"> Remember me
                                </label>
                            </div>
                            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
                        </form>
                    </div>        
                </div>
            </section>
        </main>        
    </body>
</html>