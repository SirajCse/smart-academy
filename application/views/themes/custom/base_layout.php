<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>
        <?= ($page['title'] ?? '') . ' | ' . $this->customlib->getAppName(); ?>
    </title>

    <meta name="title" content="<?= htmlspecialchars($page['meta_title'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
    <meta name="keywords" content="<?= htmlspecialchars($page['meta_keyword'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
    <meta name="description" content="<?= htmlspecialchars($page['meta_description'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicons -->
    <link rel="shortcut icon" href="<?= base_url(ltrim($front_setting->fav_icon ?? '', './')) ?>" type="image/x-icon">
    <script type="text/javascript">
        var base_url = "<?php echo base_url() ?>";
    </script>

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
                                            <span class="badge bg-primary">
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

                    <div class="tt_notice4">
                        <!--নোটিশ বোর্ড -->
                        <h3><?php echo $this->lang->line('latest_news'); ?></h3>
                        <div class="notice_body">
                            <ul class="list-group list-group-flush">
                                <?php if (!empty($banner_notices)) { ?>
                                    <?php foreach ($banner_notices as $notice) { ?>
                                        <li class="list-group-item p-2">
                                            <div class="d-flex align-items-center">
                                                <?php if (!empty($notice['date'])) { ?>
                                                    <div class="text-center me-3" style="width:80px; flex-shrink:0;">
                                                        <div class="bg-primary text-white fw-bold rounded-top py-1">
                                                            <?php echo bn_date($notice['date'], 'd M'); ?>
                                                        </div>
                                                        <div class="bg-light border rounded-bottom py-1 small">
                                                            <?php echo bn_date($notice['date'], 'Y'); ?>
                                                        </div>
                                                    </div>
                                                <?php } ?>

                                                <div class="flex-grow-1">
                                                    <a href="<?php echo site_url($notice['url']); ?>" class="text-decoration-none d-block">
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
                        <a class="photo_link d-block" href="<?php echo site_url('page/students'); ?>">
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
                            <div class="tt-card-body">
                                <div class="quice_links text-center">

                                    <!-- Facebook SDK load once -->
                                    <script async defer crossorigin="anonymous"
                                            src="https://connect.facebook.net/bn_IN/sdk.js#xfbml=1&version=v18.0">
                                    </script>

                                    <!-- Facebook Page Plugin -->
                                    <div class="fb-page"
                                         data-href="<?php echo $front_setting->fb_url; ?>"
                                         data-tabs="timeline"
                                         data-width="100%"
                                         data-height="500"
                                         data-small-header="false"
                                         data-adapt-container-width="true"
                                         data-hide-cover="false"
                                         data-show-facepile="true">
                                        <blockquote cite="<?php echo $front_setting->fb_url; ?>"
                                                    class="fb-xfbml-parse-ignore">
                                            <a href="<?php echo $front_setting->fb_url; ?>">Facebook Page</a>
                                        </blockquote>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <style>
                            /* Make it responsive */
                            .fb-page,
                            .fb-page span,
                            .fb-page iframe {
                                width: 100% !important;
                            }
                        </style>


                    <?php endif; ?>

                </div>
            <?php endif; ?>

            <div class="col-md-12 mt-4"></div>
        </div>
    </div>
</section>

<?php echo $footer; ?>

<!-- Vendor JS Files -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
<script src="<?= base_url('backend/assets/js/main.js'); ?>"></script>

</body>

</html>