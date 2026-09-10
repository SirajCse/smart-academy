<link rel="stylesheet" href="<?php echo base_url(); ?>backend/datepicker/css/bootstrap-datetimepicker.css">
<script src="<?php echo base_url(); ?>backend/datepicker/js/bootstrap-datetimepicker.js"></script>

<div class="row justify-content-center align-items-center flex-wrap py-4">
    <div class="col-md-6 col-lg-5 col-sm-5">
        <h3 class="entered m-0 pb-3"><?php echo $this->lang->line('annual_calendar'); ?></h3>
    </div>
    <div class="col-md-6 col-lg-7 col-sm-7 text-lg-end text-md-end">
        <div class="pb-3">
            <button id="list" class="btn btn-outline-secondary btn-sm me-2">
                <i class="fas fa-list me-1"></i> <?php echo $this->lang->line('list'); ?>
            </button>
            <button id="table" class="btn btn-outline-secondary btn-sm">
                <i class="fas fa-table me-1"></i> <?php echo $this->lang->line('table'); ?>
            </button>
        </div>
    </div>
</div>

<div id="products">
    <div class="row g-3">
        <?php if (!empty($holiday_arr)): ?>
            <?php foreach ($holiday_arr as $key => $value): ?>
                <?php if (!empty($value)): ?>
                    <div class="col-12">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h4 class="card-title">
                                    <?php echo ($value[0]['is_default'] != 1) ? $key : $this->lang->line(strtolower($key)); ?>
                                </h4>

                                <div class="list-group list-group-flush">
                                    <?php foreach ($value as $val): ?>
                                        <div class="list-group-item border-0 px-0 py-2">
                                            <p class="mb-0">
                                                <strong>
                                                    <?php echo date($this->customlib->getSchoolDateFormat(), strtotime($val['from_date'])) . " " . $this->lang->line('to') . " " . date($this->customlib->getSchoolDateFormat(), strtotime($val['to_date'])); ?>
                                                </strong>
                                                &nbsp; - &nbsp; <?php echo $val['description']; ?>
                                            </p>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<div id="products_list" class="d-none">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                            <tr>
                                <th width="20%"><?php echo $this->lang->line('date'); ?></th>
                                <th width="20%"><?php echo $this->lang->line('holiday_type'); ?></th>
                                <th width="60%"><?php echo $this->lang->line('description'); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (!empty($all_holidays)): ?>
                                <?php foreach ($all_holidays as $val): ?>
                                    <tr>
                                        <td><?php echo date($this->customlib->getSchoolDateFormat(), strtotime($val['from_date'])) . " " . $this->lang->line('to') . " " . date($this->customlib->getSchoolDateFormat(), strtotime($val['to_date'])); ?></td>
                                        <td>
                                            <?php echo ($val['is_default'] == 1) ? $this->lang->line(strtolower($val['type'])) : $val['type']; ?>
                                        </td>
                                        <td><?php echo $val['description']; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('#list').click(function (event) {
            event.preventDefault();
            $('#products').removeClass('d-none');
            $('#products_list').addClass('d-none');
        });

        $('#table').click(function (event) {
            event.preventDefault();
            $('#products').addClass('d-none');
            $('#products_list').removeClass('d-none');
        });
    });
</script>