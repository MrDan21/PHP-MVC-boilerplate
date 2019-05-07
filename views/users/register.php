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
                        <form class="form-signin" action="<?= BASE_URL.'user/register/'; ?>" method="POST">
                            <h1 class="h3 mb-3 font-weight-normal">Create new account</h1>
                            <?php include(LAYOUT.'alert.php'); ?>
                            <!-- Name -->
                            <div class="form-group">
                                <label class="sr-only">Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Name" value="<?= isset($_POST['name']) ? $_POST['name'] : ''; ?>">
                            </div>    

                            <!-- Email -->
                            <div class="form-group">
                                <label class="sr-only">Email address</label>
                                <input type="email" name="email" class="form-control" placeholder="Email address" value="<?= isset($_POST['email']) ? $_POST['email'] : ''; ?>">
                            </div>    

                            <!-- Password -->
                            <div class="form-group">
                                <label class="sr-only">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Password">
                            </div>    

                            <!-- Confirm password -->
                            <div class="form-group">
                                <label class="sr-only">Confirm password</label>
                                <input type="password" class="form-control" name="confirm_password" placeholder="Confirm password">
                            </div>
                                
                            <div class="checkbox mb-3">
                                <label>
                                    <input type="checkbox" name="is_agree"> Agree the terms and policy
                                </label>
                            </div>
                            <button class="btn btn-lg btn-primary btn-block" type="submit">Create new account</button>
                        </form>
                    </div>
                </div>
            </section>
        </main>                        
    </body>
</html>