<ul class="breadcrumb">
    <li><a href="<?php echo site_url('teacher')?>">Teacher </a></li>
    <li><a href="<?php echo site_url('teacher/mg_checkin_class')?>">จัดการการเข้าเรียน </a></li>
    <li class="active"> สร้างคาบเรียน </li>
    <li>
    </li>
</ul>
<div class="panel panel-default">
    <div class="panel-heading"><i class="glyphicon glyphicon-refresh"></i>เพิ่มนักศึกษาเข้าห้องเรียน</div>
    <div class="panel-body text-center">
        <form  class="form-horizontal"  method="post">
            <div class="row">
                <label class="col col-lg-2 control-label">ชื่อห้องเรียน </label>
                <div class="col col-lg-8">
                    <input disabled="disabled" type="text" id="Name_Class" class="form-control" value="<?php echo $class->Name_Class;?>" placeholder="ชื่อห้องเรียน">
                    <input disabled="disabled" type="hidden" id="ID_Class" class="form-control" value="<?php echo $class->ID_Class;?>" placeholder="ชื่อห้องเรียน">
                </div>
            </div>
            <br>
            <div class="row">
                <label class="col col-lg-2 control-label">ชื่อวิชา</label>
                <div class="col col-lg-8">
                    <select  class="form-control" id="ID_Course" disabled="disabled" >
                        <option value="">ทั้งหมด</option>
                        <?php
                        foreach($course as $r) {
                           if($r->ID_Course == $class->ID_Course){ $select = " selected ";}else{$select='';}
                            echo '<option '.$select.'  value="'.$r->ID_Course.'"  >['.$r->ID_Course .'] '. $r->Course . '</option>';
                        } ?>
                    </select>
                </div>
            </div>

            <br>
            <div class="row">
                <label class="col col-lg-2 control-label">ชื่อ อาจารย์ผู้สอน</label>
                <div class="col col-lg-8">
                    <input type="text" disabled="disabled" class="form-control" value="<?php echo  $this->session->userdata('name');?>" placeholder="ชื่ออาารย์ผู้สอน">
                    <input type="hidden" id="ID_Teacher" value="<?php echo  $class->ID_Teacher;?>">
                </div>
            </div>
            <br>
            <div class="row">
                <label class="col col-lg-2 control-label">เทรอม</label>
                <div class="col col-lg-3">
                    <input disabled="disabled" type="txt" id="Term" class="form-control" value="<?php echo $class->Term;?>" placeholder="เทรอม" data-type="number">
                </div>
                <label class="col col-lg-2 control-label">ปีการศึกษา</label>
                <div class="col col-lg-3">
                    <input disabled="disabled" type="txt" id="Year" class="form-control" value="<?php echo $class->Year;?>" placeholder="ปีการศึกษา" data-type="number">
                </div>
            </div>

    </form>
</div>
<div class="panel-footer text-center">
    <div class="row">
            <a data-name="create_period_class" data-id="<?php echo $class->ID_Class?>"   class="btn btn-primary"><i class="glyphicon glyphicon-save"></i> สร้างคาบเรียน</a>
    </div>
</div>
</div>
<div class="panel-body text-center">
    <table class="table table-responsive">
        <thead>
        <tr>
            <th> ครั้งที่.</th>
            <th> วันเวลาที่เรียน </th>
            <th> จำนวนนักศึกษาที่เข้าเรียน </th>
            <th> จำนวนนักศึกษาที่ขาดเรียน </th>
            <th> เช็คชื่อเข้าเรียน </th>
        </tr>
        </thead>
        <tbody>
        <?php
        $n=1;
        foreach($checkin as $r) {
            echo "<tr>";
            echo "<td>$n</td>";
            echo "<td>$r->Date_create</td>";
            echo "<td >$r->Student_checkin</td>";
            echo "<td>".($numall_student-$r->Student_checkin)."</td>";
            echo "<td><div class='btn-group' role='group'><a href='".site_url('teacher/checkin/')."/".$r->ID_Class."/".$r->ID_create_class."/".$n."' class='btn btn-success btn-secondary'><i class='glyphicon glyphicon-check'></i>เช็คชื่อเข้าเรียน</a>";
            echo "<a class='btn btn-warning btn-secondary' data-name='del_period_class' data-id=".$r->ID_create_class."><i class='glyphicon glyphicon-remove'></i> ลบ</a></div></td>";
           echo "</tr>";
            $n++;
        }
        ?>
        </tbody>
    </table>

</div>
<script src="<?php echo base_url()?>assets/apps/js/teacher.js" charset="utf-8"></script>