<ul class="breadcrumb">
    <li><a href="<?php echo site_url('teacher')?>">Teacher </a></li>
    <li class="active"> เพื่มรายวิชา : Add Course </li>
</ul>
<div class="panel panel-default">
    <div class="panel-heading"><i class="glyphicon glyphicon-refresh"></i>  เพื่มรายวิชา : Add Course </div>
    <div class="panel-body text-center">
        <form  class="form-horizontal"  method="post">
            <div class="row">
                <label class="col col-lg-2 control-label">รหัสรายวิชา </label>
                <div class="col col-lg-8">
                    <input type="text" id="ID_Course" class="form-control" value="" placeholder="รหัสรายวิชา">
                </div>
            </div>
            <br>
            <div class="row">

                <label class="col col-lg-2 control-label">ชื่อวิชา</label>
                <div class="col col-lg-8">
                    <input type="text" id="Course" class="form-control" value="" placeholder="ชื่อวิชา">
                </div>
            </div>
            <br>
            <div class="row">
                <label class="col col-lg-2 control-label">หน่วยกิต</label>
                <div class="col col-lg-8">
                    <input type="txt" id="Credit" class="form-control" value="" placeholder="หน่วยกิต">
                </div>
            </div>

    </form>
</div>
<div class="panel-footer text-center">

    <button type="button" class="btn btn-primary" id="btn_save_course">
        <i class="glyphicon glyphicon-floppy-saved"></i> บันทึก
    </button>
    <button type="button" class=" btn btn-warning"><i class="glyphicon glyphicon-remove"></i> ยกเลิก</button>
</div>
</div>
<script src="<?php echo base_url()?>assets/apps/js/teacher.js" charset="utf-8"></script>