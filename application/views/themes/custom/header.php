<header id="header" class="header_2">
    <div class="container tt_cont topbar">
        <div class="tt_boxed">
            <div class=" main_header"

                 style="background-image:  url('<?= base_url($front_setting->header_image ?? 'backend/assets/image/header-Image.jpg'); ?>');">
<!--                 style="background-image:  url('--><?php //= base_url($front_setting->header_image ?? 'backend/assets/image/header-Image.jpg'); ?><!--');">-->
                <div class="row align-items-center">
                    <div class="col-2 text-start text-md-end ">
                        <a href="<?php echo base_url() ?>">
                            <img class="logo"
                                 src="<?= base_url(ltrim($front_setting->logo ?? '', './')) ?>"
                                 alt="<?= $school_setting->name ?? '' ?>">
                        </a>
                    </div>
                    <div class="col-8">
                        <div class="header_information text-center">
                            <div class="title_conteiner">
                                <h1 id="marqueeText" class="header_title"><a href="<?php echo base_url() ?>"><?= $school_setting->name ?? '' ?></a></h1>
                            </div>
                            <div class="d-none d-md-block">
                                <h2></h2>
                                <h2> <?php echo $school_setting->address ?? '' ?> </h2>
                                <h4><?php echo $school_setting->dise_code ?? '' ?></h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-2 text-end">
                        <img class="navbar-open" src="<?= base_url('backend/assets/image/icon/icons8-menu-48.png'); ?>"
                             alt="<?php echo $school_setting->name ?? '' ?>">
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
                                        <a class="nav-link" href="<?= $link ?>"><span><?= $menu['menu'] ?></span> <i class="bi bi-chevron-down"></i></a>
                                        <ul>
                                            <?php foreach ($menu['submenus'] as $submenu): ?>
                                                <?php
                                                $sub_link = get_menu_link($submenu);
                                                $sub_active = ($sub_link == current_url()) ? 'active' : '';
                                                ?>
                                                <li class="<?= $sub_active ?>">
                                                    <a href="<?= $sub_link ?>"><?= $submenu['menu'] ?></a>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </li>
                                <?php else: ?>
                                    <li class="<?= $is_active ?>">
                                        <a class="nav-link" href="<?= $link ?>"><?= $menu['menu'] ?></a>
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