<div class="bg-white">
    <div class="content py-3">
        <div class="d-lg-none">
            <button type="button" class="btn btn-block btn-alt-secondary d-flex justify-content-between align-items-center" data-toggle="class-toggle" data-target="#main-navigation" data-class="d-none">
                Menu
                <i class="fa fa-bars"></i>
            </button>
        </div>
        <div id="main-navigation" class="d-none d-lg-block mt-2 mt-lg-0">
            <ul class="nav-main nav-main-horizontal nav-main-hover">
                <?php $one->build_nav(false, true); ?>
            </ul>
        </div>
    </div>
</div>