<ul class="breadcrumb">
    <li><a href="<?php echo site_url('teacher')?>">Teacher </a></li>
    <li class="active"> เพื่มห้องเรียน : Add Class </li>
</ul>
<div class="panel panel-default">
    <div class="panel-heading"><i class="glyphicon glyphicon-refresh"></i> เพื่มห้องเรียน : Add Class </div>
    <div class="panel-body text-center">
        <form  class="form-horizontal"  method="post">
            <div class="row">
                <label class="col col-lg-2 control-label">ชื่อห้องเรียน </label>
                <div class="col col-lg-8">
                    <input type="text" id="Name_Class" class="form-control" value="" placeholder="ชื่อห้องเรียน">
                </div>
            </div>
            <br>
            <div class="row">
                <label class="col col-lg-2 control-label">ชื่อวิชา</label>
                <div class="col col-lg-8">
                    <select  class="form-control" id="ID_Course">
                        <option value="">ทั้งหมด</option>
                        <?php
                        foreach($course as $r) {
                            echo '<option value="'.$r->ID_Course.'">['.$r->ID_Course .'] '. $r->Course . '</option>';
                        } ?>
                    </select>
                </div>
            </div>

            <br>
            <div class="row">
                <label class="col col-lg-2 control-label">ชื่อ อาจารย์ผู้สอน</label>
                <div class="col col-lg-8">
                    <input type="text" disabled="disabled" class="form-control" value="<?php echo  $this->session->userdata('name');?>" placeholder="ชื่ออาารย์ผู้สอน">
                    <input type="hidden" id="ID_Teacher" value="<?php echo  $this->session->userdata('id');?>">
                </div>
            </div>
            <br>
            <div class="row">
                <label class="col col-lg-2 control-label">เทรอม</label>
                <div class="col col-lg-3">
                    <input type="txt" id="Term" class="form-control" value="" placeholder="เทรอม" data-type="number">
                </div>
                <label class="col col-lg-2 control-label">ปีการศึกษา</label>
                <div class="col col-lg-3">
                    <input type="txt" id="Year" class="form-control" value="" placeholder="ปีการศึกษา" data-type="number">
                </div>
            </div>

    </form>
</div>
<div class="panel-footer text-center">

    <button type="button" class="btn btn-primary" id="btn_save_class">
        <i class="glyphicon glyphicon-floppy-saved"></i> บันทึก
    </button>
    <button type="button" class=" btn btn-warning"><i class="glyphicon glyphicon-remove"></i> ยกเลิก</button>
</div>
</div>
<script src="<?php echo base_url()?>assets/apps/js/teacher.js" charset="utf-8"></script>