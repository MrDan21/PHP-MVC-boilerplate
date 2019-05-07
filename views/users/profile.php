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
                        <form action="<?= BASE_URL.'user/profile/'; ?>" method="POST">
                            <h1 class="h3 mb-3 font-weight-normal">Edit my profile: <?= $user['name']; ?></h1>
                            <?php include(LAYOUT.'alert.php'); ?>
                            <div class="form-group">
                                <label class="sr-only">Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Name" value="<?= isset($_POST['name']) ? $_POST['name'] : $user['name']; ?>">
                            </div>
                            <div class="form-group">
                                <a href="<?= BASE_URL.'user/delete/'; ?>" class="text-danger">Delete my account</a>
                            </div>    
                            <button class="btn btn-lg btn-primary btn-block" type="submit">Save</button>
                        </form>
                    </div>        
                </div>
            </section>
        </main>        
    </body>
    <?php include(LAYOUT.'footer.php'); ?>
</html>