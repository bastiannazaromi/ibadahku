    <div class="modal fade" id="idle-modal" tabindex="-1" role="dialog" aria-labelledby="idle-modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="block block-rounded block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">Session Expiration Warning</h3>
                    </div>
                    <div class="block-content font-size-sm">
                        <p>You've been inactive for a while. For your security, we'll log you out automatically. Click "Stay Online" to continue your session. </p>
                        <p>Your session will expire in <span class="bold" id="sessionSecondsRemaining">10</span> seconds.</p>
                    </div>
                    <div class="block-content block-content-full text-right border-top">
                        <a href="<?= base_url('logout') ?>" id="logoutSession" type="button" class="btn btn-danger" data-dismiss="modal">Logout</a>
                        <a href="javascript:void(0);" id="extendSession" type="button" class="btn btn-success" data-dismiss="modal">Stay Online</a>
                    </div>
                </div>
            </div>
        </div>
    </div>    
    </main>
    <?php if(isset($one->inc_footer) && $one->inc_footer) { include($one->inc_footer); } ?>
</div>