<header id="header" class="header_2">
    <div class="container tt_cont topbar">
        <div class="tt_boxed">

            <!-- ============================================================
                 DESKTOP HEADER — letterhead style (like headerlog-2.jpeg)
                 Layout: logo | tagline(top-right) + green title + run-by +
                 address + email + EMIS(left)/EIIN(right) badges | menu icon
                 ============================================================ -->
            <div class="main_header d-none d-md-block" style="background-image: url('<?= base_url($front_setting->header_image ?? 'backend/assets/image/header-image.png'); ?>');">
                <div class="row align-items-center gy-2">

                    <!-- School logo -->
                    <div class="col-md-2 text-start">
                        <a href="<?= base_url() ?>">
                            <img class="logo"
                                 src="<?= base_url(ltrim($front_setting->logo ?? '', './')) ?>"
                                 alt="<?= $school_setting->name ?? '' ?>">
                        </a>
                    </div>

                    <!-- Center letterhead block -->
                    <div class="col-md-8">
                        <div class="header_information header_letterhead text-center">

                            <?php // Tagline: DB value wins, otherwise letterhead default ?>
                            <div class="header_tagline"><?= ($school_setting->tagline ?? '') !== '' ? $school_setting->tagline : 'Shaping Future Leaders' ?></div>

                            <div class="title_conteiner">
                                <h1 id="marqueeText" class="header_title">
                                    <a href="<?= base_url() ?>"><?= $school_setting->name ?? '' ?></a>
                                </h1>
                            </div>

                            <?php
                            // Optional DB fields with letterhead defaults, so the
                            // header stays complete even if the columns are empty.
                            $run_by = $school_setting->run_by ?? $school_setting->runby ?? $school_setting->management ?? '';
                            if ($run_by === '') { $run_by = 'Alokito Sarbik Gram Unnayan Samabay Samity.'; }
                            $hdr_email = $school_setting->email ?? $school_setting->school_email ?? '';
                            if ($hdr_email === '') { $hdr_email = 'greenlandpsc.office@gmail.com'; }
                            ?>

                            <div class="header_runby">Run by: <?= $run_by ?></div>

                            <?php if (!empty($school_setting->address)): ?>
                                <div class="header_sub">
                                    <h2><?= $school_setting->address ?? '' ?></h2>
                                </div>
                            <?php endif; ?>

                            <div class="header_email">
                                <i class="bi bi-envelope-fill"></i>
                                <span><?= $hdr_email ?></span>
                            </div>

                            <?php
                            // EIIN & EMIS combined into one centered pill (like the previous header)
                            $badge_parts = [];
                            if (!empty($school_setting->eiin)) { $badge_parts[] = 'EIIN: ' . $school_setting->eiin; }
                            if (!empty($school_setting->emis)) { $badge_parts[] = 'EMIS: ' . $school_setting->emis; }
                            ?>
                            <?php if ($badge_parts): ?>
                                <div class="header_badge_row">
                                    <span class="code_badge"><?= implode(' &amp; ', $badge_parts) ?></span>
                                </div>
                            <?php endif; ?>

                        </div>
                    </div>

                    <!-- Menu toggle -->
                    <div class="col-md-2 text-end">
                        <img class="navbar-open" src="<?= base_url('backend/assets/image/icon/icons8-menu-48.png'); ?>" alt="<?= $school_setting->name ?? '' ?>">
                    </div>
                </div>
            </div>

            <!-- ============================================================
                 MOBILE HEADER — same letterhead style, stacked & compact
                 ============================================================ -->
            <div class="main_header d-block d-md-none" style="background-image: url('<?= base_url($front_setting->header_image ?? 'backend/assets/image/header-image.png'); ?>');">

                <div class="row align-items-center">
                    <div class="col-2 text-start">
                        <a href="<?= base_url() ?>">
                            <img class="logo"
                                 src="<?= base_url(ltrim($front_setting->logo ?? '', './')) ?>"
                                 alt="<?= $school_setting->name ?? '' ?>">
                        </a>
                    </div>
                    <div class="col-10 text-end">
                        <img class="navbar-open" src="<?= base_url('backend/assets/image/icon/icons8-menu-48.png'); ?>"
                             alt="<?= $school_setting->name ?? '' ?>">
                    </div>
                </div>

                <div class="header_information header_letterhead mobile_header_info text-center">

                    <?php // Tagline: DB value wins, otherwise letterhead default ?>
                    <div class="header_tagline"><?= ($school_setting->tagline ?? '') !== '' ? $school_setting->tagline : 'Shaping Future Leaders' ?></div>

                    <div class="title_conteiner">
                        <h1 id="marqueeText" class="header_title">
                            <a href="<?= base_url() ?>"><?= $school_setting->name ?? '' ?></a>
                        </h1>
                    </div>

                    <?php
                    $run_by = $school_setting->run_by ?? $school_setting->runby ?? $school_setting->management ?? '';
                    if ($run_by === '') { $run_by = 'Alokito Sarbik Gram Unnayan Samabay Samity.'; }
                    $hdr_email = $school_setting->email ?? $school_setting->school_email ?? '';
                    if ($hdr_email === '') { $hdr_email = 'greenlandpsc.office@gmail.com'; }
                    ?>

                    <div class="header_runby">Run by: <?= $run_by ?></div>

                    <?php if (!empty($school_setting->address)): ?>
                        <div class="header_sub">
                            <h2><?= $school_setting->address ?? '' ?></h2>
                        </div>
                    <?php endif; ?>

                    <div class="header_email">
                        <i class="bi bi-envelope-fill"></i>
                        <span><?= $hdr_email ?></span>
                    </div>

                    <?php
                    // EIIN & EMIS combined into one centered pill (like the previous header)
                    $badge_parts = [];
                    if (!empty($school_setting->eiin)) { $badge_parts[] = 'EIIN: ' . $school_setting->eiin; }
                    if (!empty($school_setting->emis)) { $badge_parts[] = 'EMIS: ' . $school_setting->emis; }
                    ?>
                    <?php if ($badge_parts): ?>
                        <div class="header_badge_row">
                            <span class="code_badge"><?= implode(' &amp; ', $badge_parts) ?></span>
                        </div>
                    <?php endif; ?>

                </div>
            </div>

            <div class="menubar">
                <div class="d-flex align-items-center">
                    <nav id="navbar" class="navbar">
                        <ul>
                            <?php foreach ($main_menus ?? [] as $menu): ?>
                                <?php
                                $link = get_menu_link($menu);
                                $is_active = ($link == current_url()) ? 'active' : '';
                                ?>

                                <?php if (!empty($menu['submenus'])): ?>
                                    <li class="dropdown <?= $is_active ?>">
                                        <a class="nav-link" href="<?= $link ?>"><span><?= $menu['menu'] ?? '' ?></span> <i class="bi bi-chevron-down"></i></a>
                                        <ul>
                                            <?php foreach ($menu['submenus'] as $submenu): ?>
                                                <?php
                                                $sub_link = get_menu_link($submenu);
                                                $sub_active = ($sub_link == current_url()) ? 'active' : '';
                                                ?>
                                                <li class="<?= $sub_active ?>">
                                                    <a href="<?= $sub_link ?>"><?= $submenu['menu'] ?? '' ?></a>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </li>
                                <?php else: ?>
                                    <li class="<?= $is_active ?>">
                                        <a class="nav-link" href="<?= $link ?>"><?= $menu['menu'] ?? '' ?></a>
                                    </li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>
                        <i class="d-none bi mobile-nav-toggle bi-x"></i>
                    </nav>
                </div>
            </div>

        </div>
    </div>
</header>