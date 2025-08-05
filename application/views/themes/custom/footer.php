<?php $cookie_consent = $this->customlib->cookie_consent();
if (!empty($cookie_consent)) {?>
<div id="cookieConsent" class="cookieConsent">
    <?php echo $cookie_consent; ?> <a href="<?php echo base_url() . "page/cookie-policy" ?>" target="_blank" ></a> <a onclick="setsitecookies()" class="cookieConsentOK"><?php echo $this->lang->line('accept') ?></a>
</div>
<?php }?>


<footer>
    <div class="footer-top">
        <div class="container  tt_cont ">
            <div class="tt_boxed">
                <div id="footer">
                    <div class="row">
                        <div class="mb-2 col-md-4 align-items-center">
                            <div class="footor_textarea text-center">
                                <h4><?= $school_setting->name ?? '' ?></h4>
                                <?= !empty($front_setting->footer_text) ? '<p class="m-0">' . $front_setting->footer_text . '</p>' : '' ?>

                                <div class="social-icon d-flex justify-content-center gap-2 mt-3">

                                    <?php if (!empty($front_setting->whatsapp_url)): ?>
                                        <a href="<?= $front_setting->whatsapp_url ?>" target="_blank">
                                            <img src="<?= base_url('backend/assets/image/icon/icons8-whatsapp-48.png') ?>" alt="WhatsApp">
                                        </a>
                                    <?php endif; ?>

                                    <?php if (!empty($front_setting->fb_url)): ?>
                                        <a href="<?= $front_setting->fb_url ?>" target="_blank">
                                            <img src="<?= base_url('backend/assets/image/icon/icons8-facebook-48.png') ?>" alt="Facebook">
                                        </a>
                                    <?php endif; ?>

                                    <?php if (!empty($front_setting->twitter_url)): ?>
                                        <a href="<?= $front_setting->twitter_url ?>" target="_blank">
                                            <img src="<?= base_url('backend/assets/image/icon/icons8-twitter-48.png') ?>" alt="Twitter">
                                        </a>
                                    <?php endif; ?>

                                    <?php if (!empty($front_setting->google_plus)): ?>
                                        <a href="<?= $front_setting->google_plus ?>" target="_blank">
                                            <img src="<?= base_url('backend/assets/image/icon/icons8-gmail-48.png') ?>" alt="Google Plus">
                                        </a>
                                    <?php endif; ?>

                                    <?php if (!empty($front_setting->youtube_url)): ?>
                                        <a href="<?= $front_setting->youtube_url ?>" target="_blank">
                                            <img src="<?= base_url('backend/assets/image/icon/icons8-youtube-48.png') ?>" alt="YouTube">
                                        </a>
                                    <?php endif; ?>

                                    <?php if (!empty($front_setting->linkedin_url)): ?>
                                        <a href="<?= $front_setting->linkedin_url ?>" target="_blank">
                                            <img src="<?= base_url('backend/assets/image/icon/icons8-linkedin-48.png') ?>" alt="LinkedIn">
                                        </a>
                                    <?php endif; ?>

                                    <?php if (!empty($front_setting->instagram_url)): ?>
                                        <a href="<?= $front_setting->instagram_url ?>" target="_blank">
                                            <img src="<?= base_url('backend/assets/image/icon/icons8-instagram-48.png') ?>" alt="Instagram">
                                        </a>
                                    <?php endif; ?>

                                    <?php if (!empty($front_setting->pinterest_url)): ?>
                                        <a href="<?= $front_setting->pinterest_url ?>" target="_blank">
                                            <img src="<?= base_url('backend/assets/image/icon/icons8-pinterest-48.png') ?>" alt="Pinterest">
                                        </a>
                                    <?php endif; ?>

                                </div>
                            </div>

                        </div>
                        <div class="col-md-4">
                            <div class="text-center border border-top-0 border-bottom-0 middle-footer-infoo">
                                <p class="m-0"><strong> যোগাযোগ : </strong></p>
                                <p class="m-0"> <?php echo $school_setting->address ?? '' ?> </p>
                                <p class="m-0"> মোবাইল : <?php echo $school_setting->phone ?? '' ?> </p>
                                <p class="m-0"> ইমেইল : <?php echo $school_setting->email ?? '' ?></p>
                            </div>
                        </div>
                        <div class="mt-3 col-md-4">
                            <div class="footer_third">
                                <h4 class='sub-title-tt'>পরিকল্পনা ও বাস্তবায়নে</h4>
                                <p class="m-0 sub-text">মাধ্যমিক ও উচ্চশিক্ষা অধিদপ্তর</p>
                                <p class="m-0 tt_cradit">প্রযুক্তি সহযোগিতায় <a target="_blank"
                                                                                href="https://bitdreamit.com/">Bit Dream
                                        IT</a></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 p-1 bg-dark text-white text-center">
                    <p class="mb-0 d-flex justify-content-center align-items-center">
                        &copy; <?= date('Y'); ?> <?= $school_setting->name ?? 'Your School Name' ?> |
                        All Rights Reserved.
                    </p>
                </div>
            </div>

        </div>
    </div>
</footer>

<!-- Scroll to Top Button -->
<a href="#" class="btn btn-primary rounded-circle shadow position-fixed bottom-0 end-0 m-4" id="scrollToTop">
    <i class="fa fa-angle-up"></i>
</a>


<script>
    function setsitecookies() {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>welcome/setsitecookies",
            data: {},
            success: function (data) {
                $('.cookieConsent').hide();
            }
        });
    }

    function check_cookie_name(name)
    {
        var match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
        if (match) {
            console.log(match[2]);
            $('.cookieConsent').hide();
        }
        else{
           $('.cookieConsent').show();
        }
    }
    check_cookie_name('sitecookies');
</script>