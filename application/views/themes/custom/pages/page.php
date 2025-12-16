<?php
if ($page_form) {
    if (!empty($form)) {
        //build start form
        if (validation_errors() != false) {
            ?>
            <div class="col-md-12 alert alert-danger">
                <?php echo validation_errors(); ?>
            </div>
            <?php
        }
        if ($this->session->flashdata('msg')) {
            ?>
            <div class='alert alert-success'>
                <?php
                echo $this->session->flashdata('msg');
                $this->session->unset_userdata('msg');
                ?>
            </div>
            <?php
        }
        $form_content = $this->form_builder->open_form(array('action' => '', 'id' => 'open'));
        $defaults_object_or_array_from_db = null;
        $form_content .= "<input type='hidden' value='$form_name' name='form_name'/>";
        $form_content .= $this->form_builder->build_form_horizontal($form, $defaults_object_or_array_from_db);
        $form_content .= $this->form_builder->close_form();
        //build end form
        $replace_frm = '[form-builder:' . $form_name . ']';
        $replace_to = $form_content;
        echo $description = str_replace($replace_frm, $replace_to, $page['description']);
    }
} else {
    echo $page['description'];
}
?>

<input type="hidden" name="page_content_type" id="page_content_type" value="<?php echo $page_content_type; ?>">

<div class="post-list spaceb50" id="postList">
    <?php
    if (!empty($page['category_content'])) {
        foreach ($page['category_content'] as $page_content_key => $page_content_value) {
            if ($page_content_key == "events") {
                $numOfCols = 3;
                $rowCount = 0;
                $bootstrapColWidth = 12 / $numOfCols;
                ?>
                <div class="row">
                    <?php
                    if (!empty($page['category_content'][$page_content_key])) {
                        foreach ($page['category_content'][$page_content_key] as $key => $value) {
                            ?>
                            <div class="col-md-<?php echo $bootstrapColWidth; ?> col-sm-<?php echo $bootstrapColWidth; ?>">
                                <div class="cuadro_intro_hover">
                                    <a href="<?php echo site_url($value['url']); ?>">
                                        <?php
                                        $feature_image = ($value['feature_image'] == "")
                                            ? base_url('uploads/gallery/gallery_default.png')
                                            : $value['feature_image'];
                                        ?>
                                        <div align="center"><img src="<?php echo $feature_image; ?>" alt="" title=""></div>
                                        <div class="eventcaption">
                                            <div class="blur"></div>
                                            <div class="event20">
                                                <h3><?php echo $value['title']; ?></h3>
                                                <p>
                                                    <?php if($value['event_venue']) {
                                                        echo $this->lang->line('venue') .': '. $value['event_venue'];
                                                    } ?>
                                                </p>
                                                <p>
                                                    <?php
                                                    if($value['event_start']) {
                                                        echo $this->lang->line('date') .': '. date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($value['event_start']));
                                                    }
                                                    if($value['event_end']) {
                                                        echo ' - '. date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($value['event_end']));
                                                    }
                                                    ?>
                                                </p>
                                                <p><?php echo (strlen($value['description']) > 85) ? substr(html_entity_decode($value['description']), 0, 85) . '....' : $value['description']; ?></p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <?php
                            $rowCount++;
                            if ($rowCount % $numOfCols == 0) {
                                echo '</div><div class="row">';
                            }
                        }
                    }
                    ?>
                </div>
                <?php
            } elseif ($page_content_key == "notice") {
                foreach ($page['category_content'][$page_content_key] as $key => $value) {
                    ?>
                    <li class="list-group-item p-2">
                        <div class="d-flex align-items-center">
                            <?php if ($value['date']) { ?>
                                <div class="text-center me-3" style="width:80px; flex-shrink:0;">
                                    <div class="bg-success text-white fw-bold rounded-top py-1">
                                        <?php echo bn_date($value['date'], 'd M'); ?>
                                    </div>
                                    <div class="bg-light border rounded-bottom py-1 small">
                                        <?php echo bn_date($value['date'], 'Y'); ?>
                                    </div>
                                </div>
                            <?php } ?>

                            <div class="flex-grow-1">
                                <a href="<?php echo site_url($value['url']); ?>" class="text-decoration-none d-block fw-bold">
                                    <?php echo htmlspecialchars($value['title'], ENT_QUOTES, 'UTF-8'); ?>
                                </a>
                                <div class="text-muted small mt-1">
                                    <?php
                                    $desc = strip_tags(html_entity_decode($value['description'] ?? 'No Info'));
                                    $desc = trim($desc);
                                    echo (mb_strlen($desc) > 160) ? mb_substr($desc, 0, 160) . '....' : $desc;
                                    ?>
                                </div>
                            </div>
                        </div>
                    </li>
                    <?php
                }
            } elseif ($page_content_key == "gallery") {
                $numOfCols = 3;
                $rowCount = 0;
                $bootstrapColWidth = 12 / $numOfCols;
                ?>
                <div class="row g-4">
                    <?php foreach ($page['category_content'][$page_content_key] as $key => $value) { ?>
                        <?php
                        $feature_image = !empty($value['feature_image'])
                            ? $value['feature_image']
                            : base_url('uploads/gallery/gallery_default.png');
                        ?>
                        <div class="col-md-<?php echo $bootstrapColWidth; ?> col-sm-6">
                            <div class="card border-0 shadow-sm overflow-hidden gallery-item h-100">
                                <a href="<?php echo site_url($value['url']); ?>" class="text-decoration-none">
                                    <div class="position-relative">
                                        <img src="<?php echo $feature_image; ?>" class="card-img-top img-fluid" alt="<?php echo htmlspecialchars($value['title']); ?>">
                                        <div class="overlay d-flex align-items-center justify-content-center">
                                            <h5 class="text-white fw-bold text-center m-0">
                                                <?php echo htmlspecialchars($value['title']); ?>
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="card-body text-center">
                                        <p class="card-text text-muted small m-0">
                                            <?php echo substr(strip_tags(html_entity_decode($value['description'])), 0, 50); ?>
                                        </p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <?php
            }
        }
        echo $this->ajax_pagination->create_links(); //pagination link
    }
    ?>
</div>

<script>
    function searchFilter(page_num) {
        page_num = page_num ? page_num : 0;
        var page_content_type = $('#page_content_type').val();

        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>welcome/ajaxPaginationData/' + page_num,
            data: 'page=' + page_num + '&page_content_type=' + page_content_type,
            beforeSend: function () {
                $('.loading').show();
            },
            success: function (html) {
                $('#postList').html(html);
                $('.loading').fadeOut("slow");
            }
        });
    }

    function refreshCaptcha() {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('site/refreshCaptcha'); ?>",
            data: {},
            success: function(captcha) {
                $("#captcha_image").html(captcha);
            }
        });
    }
</script>