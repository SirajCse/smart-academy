<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>
        <?= ($page['title'] ?? '') . ' | ' . ($school_setting->name ?? '') ?>
    </title>

    <meta name="title" content="<?= htmlspecialchars($page['meta_title'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
    <meta name="keywords" content="<?= htmlspecialchars($page['meta_keyword'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
    <meta name="description" content="<?= htmlspecialchars($page['meta_description'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Permissions-Policy" content="unload=(self)">
    <!-- Favicons -->
    <link rel="shortcut icon" href="<?= base_url(ltrim($front_setting->fav_icon ?? '', './')) ?>" type="image/x-icon">


    <!-- Bootstrap CSS (with integrity for security) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
          crossorigin="anonymous">

    <!-- Font Awesome (async for performance) -->
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
          as="style"
          onload="this.onload=null;this.rel='stylesheet'">

    <!-- Bootstrap Icons -->
    <link href="<?= base_url('backend/assets/vendor/bootstrap-icons/bootstrap-icons.css'); ?>" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?= base_url('backend/assets/css/style.css'); ?>" rel="stylesheet">
    <link href="<?= base_url('backend/assets/image/header-Image.jpg'); ?>" rel="stylesheet">


    <meta property="og:url" content="<?php echo base_url() ?>"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="<?= $this->customlib->getAppName(); ?>"/>
    <meta property="og:image" content="<?= base_url(ltrim($front_setting->logo ?? '', './')) ?>"/>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>

    <?php echo $front_setting->google_analytics; ?>
    <?php $currency_symbol = $this->customlib->getSchoolCurrencyFormat(); ?>

    <!-- Vendor JS Files -->


</head>
<body>

<!-- ======= Header ======= -->
<?php echo $header ?? ''; ?>

<section class="container">
    <div class="tt_boxed p-md-2 p-0">
        <div class="row">

            <?php echo $slider ?? ''; ?>

            <div class="<?= isset($page_side_bar) && ($page_side_bar) ? 'col-md-8 mt-3' : 'col-md-12 mt-3' ?>">
                <div class="top_scroll2">
                    <div class="scroll5-left">
                        <div id="scroll5-left">
                            <span> জরুরী ঘোষণা : </span>
                        </div>
                    </div>
                    <div class="scroll5-right">
                        <marquee direction="left" scrollamount="5" onmouseover="this.stop()" onmouseout="this.start()">
                            <?php if (!empty($active_notices)) { ?>
                                <?php foreach ($active_notices as $notice) { ?>
                                    <a href="<?php echo site_url($notice['url']); ?>" class="me-4 text-decoration-none">
                                        <?php if (!empty($notice['date'])) { ?>
                                            <span class="badge bg-success">
                        <?php echo bn_date($notice['date'], 'd M Y'); ?>
                    </span>
                                        <?php } ?>
                                        <?php echo htmlspecialchars($notice['title'], ENT_QUOTES, 'UTF-8'); ?>
                                    </a>
                                <?php } ?>
                            <?php } ?>
                        </marquee>
                    </div>
                </div>

                <?php echo $content ?? ''; ?>


            </div>

            <?php if (isset($page_side_bar) && ($page_side_bar)) : ?>
                <div class="col-md-4 mt-3">

                    <div class="tt-card mt-3">
                        <!--নোটিশ বোর্ড -->
                        <h3 class="bg-warning"><?php echo $this->lang->line('notice_board'); ?></h3>
                        <div class="tt-card-body notice_body">
                            <ul class="list-group list-group-flush">
                                <?php if (!empty($banner_notices)) { ?>
                                    <?php foreach ($banner_notices as $notice) { ?>
                                        <li class="list-group-item p-2">
                                            <div class="d-flex align-items-center">
                                                <?php if (!empty($notice['date'])) { ?>
                                                    <div class="text-center me-3" style="width:80px; flex-shrink:0;">
                                                        <div class="bg-success text-white fw-bold rounded-top py-1">
                                                            <?php echo bn_date($notice['date'], 'd M'); ?>
                                                        </div>
                                                        <div class="bg-light border rounded-bottom py-1 small">
                                                            <?php echo bn_date($notice['date'], 'Y'); ?>
                                                        </div>
                                                    </div>
                                                <?php } ?>

                                                <div class="flex-grow-1">
                                                    <a href="<?php echo site_url($notice['url']); ?>"
                                                       class="text-decoration-none d-block">
                                                        <?php echo htmlspecialchars($notice['title'], ENT_QUOTES, 'UTF-8'); ?>
                                                    </a>
                                                </div>
                                            </div>
                                        </li>
                                    <?php } ?>

                                <?php } else { ?>
                                    <li class="list-group-item text-center text-muted">
                                        কোনো নোটিশ পাওয়া যায়নি।
                                    </li>
                                <?php } ?>
                            </ul>
                            <div class="text-center all_notice py-2">
                                <a href="<?php echo site_url('page/news'); ?>">সকল নোটিশ</a>
                            </div>
                        </div>
                    </div>


                    <div>
                        <a class="photo_link d-block" href="<?php echo site_url('online_admission'); ?>">
                            <img class="d-block w-100 mt-2"
                                 src="<?= base_url('backend/assets/image/options/student-information.jpg'); ?>"
                                 alt="ভর্তির আবেদন ">
                        </a>
                        <a class="photo_link d-block" href="<?php echo site_url('page/teachers'); ?>">
                            <img class="d-block w-100 mt-2"
                                 src="<?= base_url('backend/assets/image/options/Teacher-info.jpg'); ?>" alt="শিক্ষক ">
                        </a>
                        <a class="photo_link d-block" href="<?php echo site_url('page/stuff-information'); ?>">
                            <img class="d-block w-100 mt-2"
                                 src="<?= base_url('backend/assets/image/options/stuff-info.jpg'); ?>" alt=" কর্মচারী ">
                        </a>
                        <a class="photo_link d-block" href="<?php echo site_url('page/managing-committee'); ?>">
                            <img class="d-block w-100 mt-2"
                                 src="<?= base_url('backend/assets/image/options/comitee.jpg'); ?>"
                                 alt=" পরিচালনা পরিষদ ">
                        </a>
                    </div>

                    <?php if (isset($front_setting->fb_url) && ($front_setting->fb_url)) : ?>
                        <div class="tt-card mt-3">
                            <h3>আমাদের ফেসবুক পেইজ</h3>
                            <div class="tt-card-body text-center">

                                <!-- Facebook SDK -->
                                    <!--https://www.facebook.com/HTN.centre-->
                                <div id="fb-root"></div>
                                <script async defer crossorigin="anonymous"
                                        src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v18.0"></script>
                                <!-- Facebook Page Plugin -->
                                <div class="fb-page" data-href="<?php echo $front_setting->fb_url; ?>"
                                     data-tabs="timeline" data-width="500" data-height="500" data-small-header="true"
                                     data-adapt-container-width="true" data-hide-cover="true" data-show-facepile="true">
                                    <blockquote cite="<?php echo $front_setting->fb_url; ?>"
                                                class="fb-xfbml-parse-ignore"><a
                                                href="<?php echo $front_setting->fb_url; ?>">Hypertension and Research
                                            Centre, Rangpur</a></blockquote>
                                </div>

                            </div>
                        </div>

                        <style>
                            /* Make the Page Plugin responsive */
                            .fb-page,
                            .fb-page span,
                            .fb-page iframe {
                                width: 100% !important;
                            }
                        </style>

                    <?php endif; ?>

                    <div class="tt-card py-3 rounded-3">
                        <h3 class="text-center mb-3">
                            <i class="fas fa-phone-alt me-2 text-muted"></i>জরুরি হটলাইন
                        </h3>

                        <div class="d-flex flex-wrap justify-content-center align-items-center tt-card-body"
                             style="gap: 15px;">
                            <!-- 333 -->
                            <div class="hotline-logo-container">
                                <a href="https://333.gov.bd/" class="hotline-logo" target="_blank"
                                   title="333 Emergency">
                                    <img src="<?= base_url('backend/assets/hot-line/333.png'); ?>"
                                         alt="333"
                                         class="img-fluid d-block mx-auto" style="height: 65px; width: auto;">
                                </a>
                            </div>

                            <!-- 999 -->
                            <div class="hotline-logo-container">
                                <a href="https://www.999.gov.bd/" class="hotline-logo" target="_blank"
                                   title="999 Emergency">
                                    <img src="<?= base_url('backend/assets/hot-line/999.png'); ?>" alt="999"
                                         class="img-fluid d-block mx-auto" style="height: 65px; width: auto;">
                                </a>
                            </div>

                            <!-- Fire Service -->
                            <div class="hotline-logo-container">
                                <a href="https://fireservice.gov.bd/" class="hotline-logo" target="_blank"
                                   title="Fire Service">
                                    <img src="<?= base_url('backend/assets/hot-line/102.png'); ?>" alt="Fire Service"
                                         class="img-fluid d-block mx-auto" style="height: 65px; width: auto;">
                                </a>
                            </div>

                            <!-- Women & Children Affairs -->
                            <div class="hotline-logo-container">
                                <a href="https://mowca.gov.bd/" class="hotline-logo" target="_blank"
                                   title="Women & Children Affairs">
                                    <img src="<?= base_url('backend/assets/hot-line/109.png'); ?>"
                                         alt="Women & Children Affairs"
                                         class="img-fluid d-block mx-auto" style="height: 65px; width: auto;">
                                </a>
                            </div>

                            <!-- Anti-Corruption -->
                            <div class="hotline-logo-container">
                                <a href="https://www.acc.org.bd/" class="hotline-logo" target="_blank"
                                   title="Anti-Corruption Commission">
                                    <img src="<?= base_url('backend/assets/hot-line/106.png'); ?>"
                                         alt="Anti-Corruption Commission"
                                         class="img-fluid d-block mx-auto" style="height: 65px; width: auto;">
                                </a>
                            </div>

                            <!-- Disaster Management -->
                            <div class="hotline-logo-container">
                                <a href="http://www.ddm.gov.bd" class="hotline-logo" target="_blank"
                                   title="Disaster Management">
                                    <img src="<?= base_url('backend/assets/hot-line/1090.png'); ?>"
                                         alt="Disaster Management"
                                         class="img-fluid d-block mx-auto" style="height: 65px; width: auto;">
                                </a>
                            </div>

                            <!-- Land -->
                            <div class="hotline-logo-container">
                                <a href="https://land.gov.bd/" class="hotline-logo" target="_blank"
                                   title="Land Ministry">
                                    <img src="<?= base_url('backend/assets/hot-line/16122.png'); ?>"
                                         alt="Land Ministry"
                                         class="img-fluid d-block mx-auto" style="height: 65px; width: auto;">
                                </a>
                            </div>

                            <!-- Social Welfare -->
                            <div class="hotline-logo-container">
                                <a href="https://msw.portal.gov.bd" class="hotline-logo" target="_blank"
                                   title="Social Welfare">
                                    <img src="<?= base_url('backend/assets/hot-line/1098.png'); ?>"
                                         alt="Social Welfare"
                                         class="img-fluid d-block mx-auto" style="height: 65px; width: auto;">
                                </a>
                            </div>

                            <!-- BKKB -->
                            <div class="hotline-logo-container">
                                <a href="https://bkkb.gov.bd/" class="hotline-logo" target="_blank" title="BKKB">
                                    <img src="<?= base_url('backend/assets/hot-line/16109.png'); ?>"
                                         alt="BKKB"
                                         class="img-fluid d-block mx-auto" style="height: 65px; width: auto;">
                                </a>
                            </div>

                            <!-- Narcotics Control -->
                            <div class="hotline-logo-container">
                                <a href="https://www.dnc.gov.bd/" class="hotline-logo" target="_blank"
                                   title="Narcotics Control">
                                    <img src="<?= base_url('backend/assets/hot-line/madok.png'); ?>"
                                         alt="Narcotics Control"
                                         class="img-fluid d-block mx-auto" style="height: 65px; width: auto;">
                                </a>
                            </div>

                            <!-- BIWTA -->
                            <div class="hotline-logo-container">
                                <a href="https://biwta.gov.bd/" class="hotline-logo" target="_blank" title="BIWTA">
                                    <img src="<?= base_url('backend/assets/hot-line/16113.png'); ?>"
                                         alt="BIWTA"
                                         class="img-fluid d-block mx-auto" style="height: 65px; width: auto;">
                                </a>
                            </div>

                            <!-- Power Division -->
                            <div class="hotline-logo-container">
                                <a href="http://www.powerdivision.gov.bd/" class="hotline-logo" target="_blank"
                                   title="Power Division">
                                    <img src="<?= base_url('backend/assets/hot-line/16999.png'); ?>"
                                         alt="Power Division"
                                         class="img-fluid d-block mx-auto" style="height: 65px; width: auto;">
                                </a>
                            </div>

                            <!-- Legal Aid -->
                            <div class="hotline-logo-container">
                                <a href="https://nlaso.gov.bd" class="hotline-logo" target="_blank" title="Legal Aid">
                                    <img src="<?= base_url('backend/assets/hot-line/16430.png'); ?>" alt="Legal Aid"
                                         class="img-fluid d-block mx-auto" style="height: 65px; width: auto;">
                                </a>
                            </div>

                            <!-- InfoCom -->
                            <div class="hotline-logo-container">
                                <a href="https://infocom.gov.bd" class="hotline-logo" target="_blank" title="InfoCom">
                                    <img src="<?= base_url('backend/assets/hot-line/16135.png'); ?>" alt="InfoCom"
                                         class="img-fluid d-block mx-auto" style="height: 65px; width: auto;">
                                </a>
                            </div>

                            <!-- NPA -->
                            <div class="hotline-logo-container">
                                <a href="https://npa.gov.bd/" class="hotline-logo" target="_blank" title="NPA">
                                    <img src="<?= base_url('backend/assets/hot-line/16131.png'); ?>" alt="NPA"
                                         class="img-fluid d-block mx-auto" style="height: 65px; width: auto;">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <div class="col-md-12 mt-4"></div>
        </div>
    </div>
</section>

<?php echo $footer ?? ''; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
<script src="<?= base_url('backend/assets/js/main.js'); ?>"></script>

</body>

</html>