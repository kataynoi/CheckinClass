<ul class="breadcrumb">
    <li><a href="<?php echo site_url('teacher')?>">Teacher </a></li>
    <li class="active"> เพิ่มนักศึกษาเข้าห้องเรียน</li>
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
            <a href="<?php echo site_url('teacher/search_student_inclass/')."/".$class->ID_Class?>"   class="btn btn-primary"><i class="glyphicon glyphicon-save"></i> ค้นหานักศึกษาเข้าห้องเรียน</a>
    </div>
</div>
</div>
<div class="panel-body text-center">
    <table class="table table-responsive">
        <thead>
        <tr>
            <th> NO.</th>
            <th> รหัสนักศึกษา </th>
            <th> ชื่อนักศึกษา </th>
            <th> สาขาวิชา </th>
            <th> คณะ </th>
            <th> การจัดการ</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $n=1;
        foreach($student as $std) {
            echo "<tr>";
            echo "<td>$n</td>";
            echo "<td>$std->ID_Std</td>";
            echo "<td class='text-left'>$std->Name_Std</td>";
            echo "<td>$std->Branch</td>";
            echo "<td>$std->Faculty</td>";
            echo "<td><a class='btn btn-sm btn-warning' data-name='del_student_inclass' data-id=".$std->ID_Std." data-classid=".$ID_Class."><i class='glyphicon glyphicon-remove'></i> ลบ</a></td>";
           echo "</tr>";
            $n++;
        }
        ?>
        </tbody>
    </table>

</div>
<script src="<?php echo base_url()?>assets/apps/js/teacher.js" charset="utf-8"></script>