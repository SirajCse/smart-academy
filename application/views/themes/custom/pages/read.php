<div class="container my-5">

    <!-- Event Title Section -->
    <div class="text-center mb-5">
        <h4 class="fw-bold text-primary mb-3">
            <?= htmlspecialchars($page['title'] ?? '') ?>
        </h4>

        <?php if (!empty($page['event_venue']) || !empty($page['event_start'])): ?>
            <p class="text-muted fs-5 mb-0">
                <?php if (!empty($page['event_venue'])): ?>
                    <i class="fa fa-map-marker-alt me-2 text-danger"></i>
                    <strong><?= $this->lang->line('venue'); ?>:</strong>
                    <?= htmlspecialchars($page['event_venue']) ?><br>
                <?php endif; ?>

                <?php if (!empty($page['event_start'])): ?>
                    <i class="fa fa-calendar-alt me-2 text-success"></i>
                    <strong><?= $this->lang->line('date'); ?>:</strong>
                    <?= date(
                        $this->customlib->getSchoolDateFormat(),
                        $this->customlib->dateyyyymmddTodateformat($page['event_start'])
                    ); ?>

                    <?php if (!empty($page['event_end'])): ?>
                        - <?= date(
                            $this->customlib->getSchoolDateFormat(),
                            $this->customlib->dateyyyymmddTodateformat($page['event_end'])
                        ); ?>
                    <?php endif; ?>
                <?php endif; ?>
            </p>
        <?php endif; ?>
    </div>

    <!-- Event Description -->
    <?php if (!empty($page['description'])): ?>
        <div class="card shadow-lg border-0 mb-5">
            <div class="card-body p-4">
                <p class="fs-5 text-secondary mb-0">
                    <?= $page['description'] ?>
                </p>
            </div>
        </div>
    <?php endif; ?>

    <!-- Media Gallery -->
    <?php if (!empty($page['page_contents'])): ?>
        <div class="row g-4">
            <?php foreach ($page['page_contents'] as $content): ?>
                <?php
                $url = base_url($content->dir_path . $content->img_name);
                $isVideo = $content->file_type === "video" && !empty($content->vid_url);
                if ($isVideo) {
                    $url = $content->vid_url;
                }
                ?>
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="card shadow-sm border-0 overflow-hidden gallery-card">
                        <a href="<?= $url ?>"
                           data-bs-toggle="lightbox"
                           data-gallery="mixedgallery"
                           class="d-block position-relative">

                            <img src="<?= $isVideo ? base_url('assets/images/video-placeholder.jpg') : $url ?>"
                                 alt="Media"
                                 class="img-fluid w-100 gallery-img">

                            <!-- Overlay with hover effect -->
                            <div class="gallery-overlay d-flex align-items-center justify-content-center">
                                <i class="fa <?= $isVideo ? 'fa-play-circle' : 'fa-search-plus' ?> fa-3x text-white"></i>
                            </div>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
