<?php if (!empty($page_content_type)): ?>
    <?php if ($page_content_type == "events"): ?>
        <div class="row g-3">
            <?php
            $numOfCols = 3;
            $bootstrapColWidth = 12 / $numOfCols;

            foreach ($category_content as $key => $value):
                $feature_image = $value['feature_image'] ?: base_url('uploads/gallery/gallery_default.png');
                $event_date = '';

                if ($value['event_start']) {
                    $event_date = date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($value['event_start']));
                    if ($value['event_end']) {
                        $event_date .= ' - ' . date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($value['event_end']));
                    }
                }
                ?>
                <div class="col-md-<?= $bootstrapColWidth ?> col-sm-<?= $bootstrapColWidth ?>">
                    <div class="card h-100 shadow-sm">
                        <a href="<?= site_url($value['url']) ?>" class="text-decoration-none">
                            <img src="<?= $feature_image ?>" class="card-img-top" alt="<?= htmlspecialchars($value['title']) ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?= $value['title'] ?></h5>
                                <?php if ($value['event_venue']): ?>
                                    <p class="card-text mb-1">
                                        <i class="fas fa-map-marker-alt me-2"></i>
                                        <?= $this->lang->line('venue') . ': ' . $value['event_venue'] ?>
                                    </p>
                                <?php endif; ?>
                                <?php if ($event_date): ?>
                                    <p class="card-text mb-2">
                                        <i class="far fa-calendar-alt me-2"></i>
                                        <?= $this->lang->line('date') . ': ' . $event_date ?>
                                    </p>
                                <?php endif; ?>
                                <p class="card-text"><?= substr($value['description'], 0, 85) . ".." ?></p>
                            </div>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    <?php elseif ($page_content_type == "gallery"): ?>
        <div class="row g-3">
            <?php
            $numOfCols = 3;
            $bootstrapColWidth = 12 / $numOfCols;

            foreach ($category_content as $key => $value):
                $feature_image = $value['feature_image'] ?: base_url('uploads/gallery/gallery_default.png');
                ?>
                <div class="col-md-<?= $bootstrapColWidth ?> col-sm-<?= $bootstrapColWidth ?>">
                    <div class="card h-100 shadow-sm">
                        <a href="<?= site_url($value['url']) ?>" class="text-decoration-none">
                            <img src="<?= $feature_image ?>" class="card-img-top" alt="<?= htmlspecialchars($value['title']) ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?= $value['title'] ?></h5>
                                <p class="card-text"><?= substr(htmlspecialchars($value['description']), 0, 85) . ".." ?></p>
                            </div>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    <?php elseif ($page_content_type == "notice"): ?>
        <div class="list-group">
            <?php foreach ($category_content as $key => $value): ?>
                <a href="<?= site_url($value['url']) ?>" class="list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1"><?= $value['title'] ?></h5>
                    </div>
                    <p class="mb-1"><?= substr($value['description'], 0, 85) . ".." ?></p>
                </a>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?= $this->ajax_pagination->create_links() ?>
<?php endif; ?>