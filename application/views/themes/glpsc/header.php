<?php /* ============================================================
       LETTERHEAD HEADER — fully self-contained.
       All header styles are embedded in the <style> block below,
       so there is NO separate CSS file to add and your existing
       stylesheet does not need any change.
       ============================================================ */ ?>
<style>
    /* ===== Letterhead header styles (inline) ===== */
    :root {
        /* Palette matched to www.glpsc.edu.bd (live site) */
        --lh-green: #2e6438;        /* primary site green - menubar & school name */
        --lh-green-bright: #198754; /* theme accent green - icons, highlights */
        --lh-green-dark: #0f5132;   /* deep green - hover / emphasis */
        --lh-ink: #444444;          /* site body text color */
        --lh-badge-bg: #2e6438;     /* badges use the menubar green */
        --lh-title-font: Georgia, 'Times New Roman', 'Noto Serif Bengali', serif;
    }

    /* ---------- letterhead text block ---------- */
    .header_letterhead {
        padding: 6px 0 10px;
    }

    .header_letterhead .header_tagline
    {
        font-weight: 700;
        margin-right: 30px;
        color: #E91E63;
        text-align: right;
    }

    .header_letterhead .title_conteiner {
        line-height: 1.15;
    }

    .header_letterhead .header_title {
        margin: 0;
    }

    .header_letterhead .header_title a {
        font-family: var(--lh-title-font);
        font-size: clamp(26px, 2.8vw, 38px);
        font-weight: 800;
        color: var(--lh-green);
        letter-spacing: .5px;
        text-decoration: none;
        transition: color .2s ease;
    }

    .header_letterhead .header_title a:hover {
        color: var(--lh-green-dark);
    }

    .header_letterhead .header_runby {
        font-family: var(--lh-title-font);
        font-size: 16px;
        font-weight: 700;
        color: var(--lh-ink);
        margin-top: 3px;
    }

    .header_letterhead .header_sub {
        margin-top: 2px;
    }

    .header_letterhead .header_sub h2 {
        font-family: var(--lh-title-font);
        font-size: 15.5px;
        font-weight: 700;
        color: var(--lh-ink);
        margin: 0;
    }

    .header_letterhead .header_email {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 13.5px;
        font-weight: 600;
        color: var(--lh-ink);
        margin-top: 3px;
    }

    .header_letterhead .header_email .bi {
        font-size: 13px;
        color: var(--lh-green-bright);
    }

    /* ---------- EMIS left / EIIN right badges ---------- */
    .header_letterhead .header_badge_row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        margin-top: 8px;
    }

    .header_letterhead .code_badge {
        display: inline-block;
        background: var(--lh-badge-bg);
        color: #fff;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 13px;
        font-weight: 700;
        letter-spacing: .5px;
        padding: 5px 22px;
        border-radius: 999px;
        white-space: nowrap;
    }

    .code_badge.left_code
    {
        margin-left: 20px;
    }
    .code_badge.right_code
    {
        margin-right: 20px;
    }

    /* ============================================================
       MOBILE - compact stacked version
       ============================================================ */
    @media (max-width: 767.98px) {

        .main_header .logo {
            max-height: 54px;
        }

        .header_letterhead {
            padding: 4px 0 8px;
        }

        .mobile_header_info .header_tagline {
            text-align: center;
            font-size: 11px;
            margin-bottom: 1px;
        }

        .mobile_header_info .header_title a {
            font-size: clamp(19px, 5.4vw, 24px);
            letter-spacing: .3px;
        }

        .mobile_header_info .header_runby {
            font-size: 12.5px;
            line-height: 1.35;
        }

        .mobile_header_info .header_sub h2 {
            font-size: 12.5px;
        }

        .mobile_header_info .header_email {
            font-size: 11.5px;
            gap: 4px;
        }

        .mobile_header_info .header_email .bi {
            font-size: 11px;
        }

        .mobile_header_info .header_badge_row {
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 6px;
        }

        .mobile_header_info .code_badge {
            font-size: 11px;
            padding: 4px 16px;
            border-radius: 999px;
        }
    }

    /* Slightly tighter on very small phones */
    @media (max-width: 374.98px) {
        .mobile_header_info .header_title a {
            font-size: 18px;
        }
    }
</style>
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

                            <?php
                            // EMIS left / EIIN right — DB values win, letterhead values as defaults
                            $emis_val = !empty($school_setting->emis) ? $school_setting->emis : '487644';
                            $eiin_val = !empty($school_setting->eiin) ? $school_setting->eiin : '140691';
                            ?>
                            <div class="header_badge_row">
                                <span class="code_badge left_code">EMIS: <?= $emis_val ?></span>
                                <div class="header_email">
                                    <i class="bi bi-envelope-fill"></i>
                                    <span><?= $hdr_email ?></span>
                                </div>
                                <span class="code_badge right_code">EIIN: <?= $eiin_val ?></span>
                            </div>

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
                    // EMIS left / EIIN right — DB values win, letterhead values as defaults
                    $emis_val = !empty($school_setting->emis) ? $school_setting->emis : '487644';
                    $eiin_val = !empty($school_setting->eiin) ? $school_setting->eiin : '140691';
                    ?>
                    <div class="header_badge_row">
                        <span class="code_badge left_code">EMIS: <?= $emis_val ?></span>
                        <span class="code_badge right_code">EIIN: <?= $eiin_val ?></span>
                    </div>

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
