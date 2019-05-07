<header>
    <?php if(Core\Session::exists('user')) { ?>
    <div class="collapse bg-dark" id="navbarHeader">
        <div class="container">
            <div class="row">
                <div class="col-sm-4 offset-md-8 py-4">
                    <h4 class="text-white"><?= Core\Session::get('user')['name']; ?></h4>
                        <ul class="list-unstyled">
                            <li><a href="<?= BASE_URL.'user/profile/'; ?>" class="text-white">Profile</a></li>
                            <li><a href="<?= BASE_URL.'user/logout/'; ?>" class="text-white">Logout</a></li>
                        </ul>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
    <div class="navbar navbar-dark bg-dark shadow-sm">
        <div class="container d-flex justify-content-between">
            <a href="<?= BASE_URL; ?>" class="navbar-brand d-flex align-items-center">
                <strong><?= TITLE ?></strong>
            </a>
            <?php if(Core\Session::exists('user')) { ?>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <?php } ?>
        </div>
    </div>
</header>