<?php
if (isset($banner_images) && !empty($banner_images)) :
    ?>
    <div class="col-md-12 mt-3 m-md-0">
        <div class="tt_carousel">
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">

                <!-- Indicators -->
                <div class="carousel-indicators">
                    <?php foreach ($banner_images as $index => $image): ?>
                        <button type="button"
                                data-bs-target="#carouselExampleIndicators"
                                data-bs-slide-to="<?= $index ?>"
                                class="<?= $index === 0 ? 'active' : '' ?>"
                                aria-current="<?= $index === 0 ? 'true' : 'false' ?>"
                                aria-label="Slide <?= $index + 1 ?>"></button>
                    <?php endforeach; ?>
                </div>

                <!-- Slides -->
                <div class="carousel-inner">
                    <?php foreach ($banner_images as $index => $image): ?>
                        <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                            <img src="<?php echo base_url($image->dir_path . $image->img_name); ?>"
                                 class="d-block w-100"
                                 alt="No Image">
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Controls -->
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>

            </div>
        </div>
    </div>
<?php endif; ?>

