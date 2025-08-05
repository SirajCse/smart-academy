<link rel="stylesheet" href="<?php echo base_url('backend/datepicker/css/bootstrap-datetimepicker.css'); ?>">
<script src="<?php echo base_url('backend/datepicker/js/bootstrap-datetimepicker.js'); ?>"></script>
<script src="<?php echo base_url('backend/dist/js/moment.min.js'); ?>"></script>

<?php if (!$is_exam_result): ?>
    <div class="alert alert-danger">
        <?php echo $this->lang->line('exam_result_disable_please_contact_to_administrator'); ?>
    </div>
    <?php return; ?>
<?php endif; ?>

<div class="row justify-content-center align-items-center flex-wrap py-4">
    <div class="col-12">
        <h3 class="entered m-0"><?php echo $this->lang->line('exam_result'); ?></h3>
    </div>
</div>

<form id="form1" class="mb-3 pt-4 onlineform" action="<?php echo current_url() ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
    <div class="row g-3">
        <div class="col-md-3">
            <div class="form-group">
                <label class="form-label"><?php echo $this->lang->line('admission_no'); ?></label>
                <small class="text-danger">*</small>
                <input type="text" class="form-control" value="<?php echo set_value('admission_no'); ?>" id="admission_no" name="admission_no">
                <span class="text-danger"><?php echo form_error('admission_no'); ?></span>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="form-label"><?php echo $this->lang->line('exam'); ?></label>
                <small class="text-danger">*</small>
                <select id="exam_id" name="exam_id" class="form-select">
                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                </select>
                <span class="text-danger"><?php echo form_error('exam_id'); ?></span>
            </div>
        </div>
        <div class="col-md-3 d-flex align-items-end">
            <button type="submit" class="btn btn-primary" name="search" id="search_btn">
                <?php echo $this->lang->line('search'); ?>
            </button>
        </div>
    </div>
</form>

<?php if ($this->session->flashdata('msg')): ?>
    <?php echo $this->session->flashdata('msg'); ?>
<?php endif; ?>

<?php if (isset($_POST['search']) && !empty($exam_result)): ?>
    <div class="printcontent col-lg-12" id="divtoprint">
        <div class="row justify-content-center align-items-center mb-4">
            <div class="col-md-10">
                <style type="text/css" media="print">
                    @media print {
                        .reflist li {
                            background: #f9f9f9 !important;
                        }
                        .text-success {
                            color: #3c763d !important;
                        }
                        .badge-success {
                            color: #fff !important;
                            border: 0 !important;
                            background-color: #5cb85c !important;
                        }
                    }
                </style>

                <ul class="list-group list-group-flush reflist">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <?php echo $this->lang->line('student_name'); ?>
                        <span class="text-success">
                            <?php echo $this->customlib->getFullName($student_details[0]['firstname'], $student_details[0]['middlename'], $student_details[0]['lastname'], $this->sch_setting_detail->middlename, $this->sch_setting_detail->lastname); ?>
                        </span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <?php echo $this->lang->line('admission_no'); ?>
                        <span class="text-success"><?php echo $student_details[0]['admission_no']; ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <?php echo $this->lang->line('roll_number'); ?>
                        <span class="text-success"><?php echo $student_details[0]['roll_no']; ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <?php echo $this->lang->line('class'); ?>
                        <span class="text-success"><?php echo $student_details[0]['class_name']; ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <?php echo $this->lang->line('section'); ?>
                        <span class="text-success"><?php echo $student_details[0]['section_name']; ?></span>
                    </li>
                </ul>
            </div>
            <div class="col-md-2 text-end">
                <button type="button" id="printbtn" class="btn btn-dark btn-sm" data-bs-toggle="tooltip" title="<?php echo $this->lang->line('print'); ?>" onclick="printDiv('divtoprint')">
                    <i class="fas fa-print"></i>
                </button>
            </div>
        </div>

        <div id="exam">
            <?php foreach ($exam_result as $exam_key => $exam_value): ?>
                <div class="card shadow-sm mb-4">
                    <div class="card-header">
                        <h4 class="card-title m-0"><?php echo $exam_value->exam; ?></h4>
                    </div>

                    <?php if (!empty($exam_value->exam_result)): ?>
                        <?php if ($exam_value->exam_result['exam_connection'] == 0): ?>
                            <?php if (!empty($exam_value->exam_result['result'])): ?>
                                <?php
                                $exam_quality_points = 0;
                                $exam_total_points = 0;
                                $exam_credit_hour = 0;
                                $exam_grand_total = 0;
                                $exam_get_total = 0;
                                $exam_pass_status = 1;
                                $exam_absent_status = 0;
                                $total_exams = 0;
                                ?>

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover">
                                            <thead class="table-light">
                                            <tr>
                                                <th><?php echo $this->lang->line('subject'); ?></th>
                                                <?php if ($exam_value->exam_type == "gpa"): ?>
                                                    <th><?php echo $this->lang->line('grade_point'); ?></th>
                                                    <th><?php echo $this->lang->line('credit_hours'); ?></th>
                                                    <th><?php echo $this->lang->line('quality_points'); ?></th>
                                                <?php else: ?>
                                                    <th><?php echo $this->lang->line('max_marks'); ?></th>
                                                    <th><?php echo $this->lang->line('min_marks'); ?></th>
                                                    <th><?php echo $this->lang->line('marks_obtained'); ?></th>
                                                <?php endif; ?>

                                                <?php if ($exam_value->exam_type == "coll_grade_system" || $exam_value->exam_type == "school_grade_system"): ?>
                                                    <th><?php echo $this->lang->line('grade'); ?></th>
                                                <?php elseif ($exam_value->exam_type == "basic_system"): ?>
                                                    <th><?php echo $this->lang->line('result'); ?></th>
                                                <?php endif; ?>
                                                <th><?php echo $this->lang->line('note'); ?></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach ($exam_value->exam_result['result'] as $exam_result_key => $exam_result_value): ?>
                                                <?php
                                                $exam_grand_total += $exam_result_value->max_marks;
                                                $exam_get_total += $exam_result_value->get_marks;
                                                $percentage_grade = ($exam_result_value->get_marks * 100) / $exam_result_value->max_marks;
                                                if ($exam_result_value->get_marks < $exam_result_value->min_marks) {
                                                    $exam_pass_status = 0;
                                                }
                                                $total_exams = 1;
                                                ?>
                                                <tr>
                                                    <td><?php echo $exam_result_value->name . ' (' . $exam_result_value->code . ')'; ?></td>

                                                    <?php if ($exam_value->exam_type != "gpa"): ?>
                                                        <td><?php echo $exam_result_value->max_marks; ?></td>
                                                        <td><?php echo $exam_result_value->min_marks; ?></td>
                                                        <td>
                                                            <?php
                                                            echo $exam_result_value->get_marks;
                                                            if ($exam_result_value->attendence == "absent") {
                                                                $exam_absent_status = 1;
                                                                echo "&nbsp;" . $this->lang->line('abs');
                                                            }
                                                            ?>
                                                        </td>
                                                    <?php else: ?>
                                                        <?php
                                                        $point = findGradePoints($exam_grade, $exam_value->exam_type, $percentage_grade);
                                                        $exam_total_points += $point;
                                                        $exam_credit_hour += $exam_result_value->credit_hours;
                                                        $exam_quality_points += ($exam_result_value->credit_hours * $point);
                                                        ?>
                                                        <td><?php echo number_format($point, 2, '.', ''); ?></td>
                                                        <td><?php echo $exam_result_value->credit_hours; ?></td>
                                                        <td><?php echo number_format($exam_result_value->credit_hours * $point, 2, '.', ''); ?></td>
                                                    <?php endif; ?>

                                                    <?php if ($exam_value->exam_type == "coll_grade_system" || $exam_value->exam_type == "school_grade_system"): ?>
                                                        <td><?php echo findExamGrade($exam_grade, $exam_value->exam_type, $percentage_grade); ?></td>
                                                    <?php elseif ($exam_value->exam_type == "basic_system"): ?>
                                                        <td>
                                                            <?php if ($exam_result_value->get_marks < $exam_result_value->min_marks): ?>
                                                                <span class="badge bg-danger"><?php echo $this->lang->line('fail'); ?></span>
                                                            <?php else: ?>
                                                                <span class="badge bg-success"><?php echo $this->lang->line('pass'); ?></span>
                                                            <?php endif; ?>
                                                        </td>
                                                    <?php endif; ?>
                                                    <td><?php echo $exam_result_value->note; ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-12">
                                            <div class="bg-light p-3 rounded">
                                                <div class="row">
                                                    <?php if ($exam_value->exam_type != "gpa"): ?>
                                                        <?php
                                                        $exam_percentage = ($exam_get_total * 100) / $exam_grand_total;
                                                        ?>
                                                        <div class="col-md-3">
                                                            <div class="mb-2">
                                                                <strong><?php echo $this->lang->line('percentage'); ?>:</strong>
                                                                <span><?php echo number_format($exam_percentage, 2, '.', ''); ?>%</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="mb-2">
                                                                <strong><?php echo $this->lang->line('rank'); ?>:</strong>
                                                                <span><?php echo $exam_value->rank; ?></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="mb-2">
                                                                <strong><?php echo $this->lang->line('result'); ?>:</strong>
                                                                <span>
                                                                    <?php if ($exam_absent_status): ?>
                                                                        <span class="badge bg-danger"><?php echo $this->lang->line('fail'); ?></span>
                                                                    <?php else: ?>
                                                                        <?php if ($exam_pass_status): ?>
                                                                            <span class="badge bg-success"><?php echo $this->lang->line('pass'); ?></span>
                                                                        <?php else: ?>
                                                                            <span class="badge bg-danger"><?php echo $this->lang->line('fail'); ?></span>
                                                                        <?php endif; ?>
                                                                    <?php endif; ?>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="mb-2">
                                                                <strong><?php echo $this->lang->line('grand_total'); ?>:</strong>
                                                                <span><?php echo $exam_grand_total; ?></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="mb-2">
                                                                <strong><?php echo $this->lang->line('total_obtain_marks'); ?>:</strong>
                                                                <span><?php echo $exam_get_total; ?></span>
                                                            </div>
                                                        </div>
                                                        <?php if ($exam_pass_status): ?>
                                                            <div class="col-md-3">
                                                                <div class="mb-2">
                                                                    <strong><?php echo $this->lang->line('division'); ?>:</strong>
                                                                    <span><?php echo findExamDivision($marks_division, $exam_percentage); ?></span>
                                                                </div>
                                                            </div>
                                                        <?php endif; ?>
                                                    <?php else: ?>
                                                        <div class="col-md-4">
                                                            <div class="mb-2">
                                                                <strong><?php echo $this->lang->line('credit_hours'); ?>:</strong>
                                                                <span><?php echo $exam_credit_hour; ?></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="mb-2">
                                                                <strong><?php echo $this->lang->line('rank'); ?>:</strong>
                                                                <span><?php echo $exam_value->rank; ?></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="mb-2">
                                                                <strong><?php echo $this->lang->line('quality_points'); ?>:</strong>
                                                                <span>
                                                                    <?php
                                                                    if ($exam_credit_hour <= 0) {
                                                                        echo "--";
                                                                    } else {
                                                                        $exam_grade_percentage = ($exam_get_total * 100) / $exam_grand_total;
                                                                        echo $exam_quality_points . "/" . $exam_credit_hour . '=' . number_format($exam_quality_points / $exam_credit_hour, 2, '.', '') . " [" . findExamGrade($exam_grade, $exam_value->exam_type, $exam_grade_percentage) . "]";
                                                                    }
                                                                    ?>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php elseif ($exam_value->exam_result['exam_connection'] == 1): ?>
                            <!-- Similar optimized structure for connected exams -->
                            <!-- Content would follow the same pattern as above -->
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>

<script type="text/javascript">
    $(function() {
        <?php if(isset($_POST['search'])): ?>
        var e = $.Event('keyup');
        e.which = 32;
        $('#admission_no').trigger(e);
        <?php endif; ?>
    });

    $(document).on('keyup', '#admission_no', function(e) {
        var admission_no = $(this).val();
        $.ajax({
            url: '<?php echo base_url(); ?>welcome/getstudentexam',
            type: "POST",
            dataType: 'JSON',
            data: {admission_no: admission_no},
            success: function(res) {
                var div_data = "";
                var exam_id = "<?php echo $exam_id; ?>";

                $.each(res, function(i, obj) {
                    var sel = (exam_id != '' && exam_id == obj.id) ? "selected" : "";
                    div_data += "<option value=" + obj.id + " " + sel + ">" + obj.exam + "</option>";
                });

                $("#exam_id").html("<option value=''>Select</option>").append(div_data);
            }
        });
    });

    function printDiv() {
        $("#printbtn").hide();
        var printContents = document.getElementById('divtoprint').innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
        location.reload(true);
    }
</script>

<?php
function findExamDivision($marks_division, $percentage) {
    foreach ($marks_division as $division_key => $division_value) {
        if ($division_value->percentage_from >= $percentage && $division_value->percentage_to <= $percentage) {
            return $division_value->name;
        }
    }
    return "";
}

function findGradePoints($exam_grade, $exam_type, $percentage) {
    foreach ($exam_grade as $exam_grade_key => $exam_grade_value) {
        if ($exam_grade_value['exam_key'] == $exam_type && !empty($exam_grade_value['exam_grade_values'])) {
            foreach ($exam_grade_value['exam_grade_values'] as $grade_key => $grade_value) {
                if ($grade_value->mark_from >= $percentage && $grade_value->mark_upto <= $percentage) {
                    return $grade_value->point;
                }
            }
        }
    }
    return 0;
}

function findExamGrade($exam_grade, $exam_type, $percentage) {
    foreach ($exam_grade as $exam_grade_key => $exam_grade_value) {
        if ($exam_grade_value['exam_key'] == $exam_type && !empty($exam_grade_value['exam_grade_values'])) {
            foreach ($exam_grade_value['exam_grade_values'] as $grade_key => $grade_value) {
                if ($grade_value->mark_from >= $percentage && $grade_value->mark_upto <= $percentage) {
                    return $grade_value->name;
                }
            }
        }
    }
    return "";
}

function getConsolidateRatio($exam_connection_list, $examid, $get_marks, $exam_get_percentage) {
    foreach ($exam_connection_list as $exam_connection_key => $exam_connection_value) {
        if ($exam_connection_value->exam_group_class_batch_exams_id == $examid) {
            return [
                'exam_weightage' => $exam_connection_value->exam_weightage,
                'exam_consolidate_marks' => ($get_marks * $exam_connection_value->exam_weightage) / 100,
                'exam_consolidate_percentage' => ($exam_get_percentage * $exam_connection_value->exam_weightage) / 100
            ];
        }
    }
    return 0;
}

function getCalculatedExamGradePoints($array, $exam_id, $exam_grade, $exam_type) {
    $object = new stdClass();
    $return_total_points = $return_total_exams = $return_max_marks = $return_quality_point = $return_get_marks = $return_credit_hours = 0;

    if (!empty($array) && !empty($array['exam_result_' . $exam_id])) {
        foreach ($array['exam_result_' . $exam_id] as $exam_key => $exam_value) {
            $return_total_exams++;
            $percentage_grade = ($exam_value->get_marks * 100) / $exam_value->max_marks;
            $point = findGradePoints($exam_grade, $exam_type, $percentage_grade);
            $return_total_points += $point;
            $return_quality_point += ($point * $exam_value->credit_hours);
            $return_credit_hours += $exam_value->credit_hours;
            $return_max_marks += $exam_value->max_marks;
            $return_get_marks += $exam_value->get_marks;
        }
    }

    $object->total_max_marks = $return_max_marks;
    $object->total_get_marks = $return_get_marks;
    $object->total_points = $return_total_points;
    $object->total_exams = $return_total_exams;
    $object->return_quality_point = $return_quality_point;
    $object->return_credit_hours = $return_credit_hours;

    return $object;
}

function getCalculatedExam($array, $exam_id) {
    $object = new stdClass();
    $return_max_marks = $return_get_marks = $return_credit_hours = 0;
    $return_exam_status = 'pass';

    if (!empty($array) && !empty($array['exam_result_' . $exam_id])) {
        foreach ($array['exam_result_' . $exam_id] as $exam_key => $exam_value) {
            if ($exam_value->get_marks < $exam_value->min_marks || $exam_value->attendence != "present") {
                $return_exam_status = "fail";
            }
            $return_max_marks += $exam_value->max_marks;
            $return_get_marks += $exam_value->get_marks;
            $return_credit_hours += $exam_value->credit_hours;
        }
    }

    $object->credit_hours = $return_credit_hours;
    $object->get_marks = $return_get_marks;
    $object->max_marks = $return_max_marks;
    $object->exam_status = $return_exam_status;
    return $object;
}
?>