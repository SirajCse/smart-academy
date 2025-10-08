<?php $currency_symbol = $this->customlib->getSchoolCurrencyFormat(); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <section class="content-header">
        <h1>
            <i class="fa fa-mortar-board"></i> <?php echo $this->lang->line('academics'); ?>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <?php if ($this->rbac->hasPrivilege('class', 'can_add') || $this->rbac->hasPrivilege('class', 'can_edit')): ?>
                <div class="col-md-4">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title"><?php echo $this->lang->line('edit_class'); ?></h3>
                        </div>
                        <form id="form1" action="<?php echo site_url('classes/edit/' . $vehroute->id) ?>" method="post" accept-charset="utf-8">
                            <div class="box-body">

                                <?php
                                if ($this->session->flashdata('msg')) {
                                    echo $this->session->flashdata('msg');
                                    $this->session->unset_userdata('msg');
                                }
                                if (isset($error_message)) {
                                    echo "<div class='alert alert-danger'>" . $error_message . "</div>";
                                }
                                echo $this->customlib->getCSRF();
                                ?>

                                <input type="hidden" name="id" value="<?php echo set_value('id', $vehroute->id); ?>" >
                                <input type="hidden" name="pre_class_id" value="<?php echo $vehroute->id; ?>" >

                                <?php foreach ($vehroute->vehicles as $v_value): ?>
                                    <input type="hidden" name="prev_sections[]" value="<?php echo $v_value->id; ?>">
                                <?php endforeach; ?>

                                <div class="form-group">
                                    <label><?php echo $this->lang->line('class'); ?></label><small class="req"> *</small>
                                    <input id="class" name="class" type="text" class="form-control" value="<?php echo set_value('class', $vehroute->class); ?>" />
                                    <span class="text-danger"><?php echo form_error('class'); ?></span>
                                </div>

                                <div class="form-group">
                                    <label><?php echo $this->lang->line('code'); ?></label>
                                    <input id="code" name="code" type="text" class="form-control" value="<?php echo set_value('code', $vehroute->code); ?>" />
                                    <span class="text-danger"><?php echo form_error('code'); ?></span>
                                </div>

                                <div class="form-group">
                                    <label><?php echo $this->lang->line('sections'); ?></label><small class="req"> *</small>
                                    <?php foreach ($vehiclelist as $vehicle): ?>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="sections[]" value="<?php echo $vehicle['id'] ?>"
                                                    <?php echo set_checkbox('sections[]', $vehicle['id'], check_in_array($vehicle['id'], $vehroute->vehicles)); ?> >
                                                <?php echo $vehicle['section']; ?>
                                            </label>
                                        </div>
                                    <?php endforeach; ?>
                                    <span class="text-danger"><?php echo form_error('sections[]'); ?></span>
                                </div>

                            </div><!-- /.box-body -->

                            <div class="box-footer">
                                <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
                            </div>
                        </form>
                    </div>
                </div><!-- /.col (right) -->
            <?php endif; ?>

            <div class="col-md-<?php echo ($this->rbac->hasPrivilege('class', 'can_add') || $this->rbac->hasPrivilege('class', 'can_edit')) ? "8" : "12"; ?>">
                <div class="box box-primary">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix"><?php echo $this->lang->line('class_list'); ?></h3>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive mailbox-messages overflow-visible">
                            <div class="download_label"><?php echo $this->lang->line('class_list'); ?></div>
                            <table class="table table-striped table-bordered table-hover example">
                                <thead>
                                <tr>
                                    <th><?php echo $this->lang->line('class'); ?></th>
                                    <th><?php echo $this->lang->line('code'); ?></th>
                                    <th><?php echo $this->lang->line('sections'); ?></th>
                                    <th class="text-right noExport"><?php echo $this->lang->line('action'); ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($vehroutelist as $vehroute): ?>
                                    <tr>
                                        <td><?php echo $vehroute->class; ?></td>
                                        <td><?php echo $vehroute->code; ?></td>
                                        <td>
                                            <?php foreach ($vehroute->vehicles as $value) {
                                                echo "<div>" . $value->section . "</div>";
                                            } ?>
                                        </td>
                                        <td class="text-right">
                                            <?php if ($this->rbac->hasPrivilege('class', 'can_edit')): ?>
                                                <a href="<?php echo base_url(); ?>classes/edit/<?php echo $vehroute->id; ?>" class="btn btn-default btn-xs" title="<?php echo $this->lang->line('edit'); ?>">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                            <?php endif; ?>
                                            <?php if ($this->rbac->hasPrivilege('class', 'can_delete')): ?>
                                                <a href="<?php echo base_url(); ?>classes/delete/<?php echo $vehroute->id; ?>" class="btn btn-default btn-xs" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('<?php echo $this->lang->line('deleting_class'); ?>');">
                                                    <i class="fa fa-remove"></i>
                                                </a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div><!-- /.mail-box-messages -->
                    </div><!-- /.box-body -->
                </div>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<?php
// Helper to check if a section is already selected
function check_in_array($find, $array) {
    foreach ($array as $element) {
        if ($find == $element->id) {
            return TRUE;
        }
    }
    return FALSE;
}
?>
