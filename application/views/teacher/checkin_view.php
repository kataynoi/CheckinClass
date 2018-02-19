<ul class="breadcrumb">
    <li><a href="<?php echo site_url('teacher')?>">Teacher </a></li>
    <li><a href="<?php echo site_url('teacher/mg_checkin_class')?>">จัดการการเข้าเรียน </a></li>
    <li><a href="<?php echo site_url('teacher/create_checkin_class/'.$class->ID_Class)?>">สร้างคาบเรียน </a></li>
    <li class="active"> เช็คชื่อเข้าเรียน คาบเรียนที่ <?php echo $n. " วันที่ ". to_thai_date_time($period->Date_create);?></li>
</ul>
<div class="panel panel-default">
    <div class="panel-heading"><i class="glyphicon glyphicon-refresh"></i>เช็คชื่อเข้าเรียน</div>
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
                <label class="col col-lg-2 control-label">เทอม</label>
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

        foreach($student as $std) {
            $n=1; $disabled='';$leave='';
         switch($std->Status_checkin){
                case 1 :
                    $color='btn-danger';$txt='เช็คชื่อ'; $leave='<button class="btn" data-name="btn_leave" '.$disabled.' data-id='.$std->ID_Std.' data-leave="1" data-createclassid='.$std->Create_class_id.'> ลา</button>';
                    break;
                case 2 :
                    $color='btn-success';$txt='เข้าเรียน'; $disabled="disabled='disabled'";
                    break;
                case 3 :
                    $color='btn-warning';$txt='มาเรียนสาย';$disabled="disabled='disabled'";
                    break;
                case 4 :
                    $color='btn-warning';$txt='ลา';
                    break;
            }

        echo "<tr>";
            echo "<td>$n</td>";
            echo "<td>$std->ID_Std</td>";
            echo "<td class='text-left'>$std->Name_Std</td>";
            echo "<td>$std->Branch</td>";
            echo "<td>$std->Faculty</td>";
            echo "<td><a class =' btn btn-sm ".$color."' data-name='btn_checkin' ".$disabled." data-id=".$std->ID_Std." data-createclassid=".$std->Create_class_id.">".$txt."</a> ".$leave."</td>";
           echo "</tr>";
            $n++;
        }
        ?>
        </tbody>
    </table>

</div>
<script src="<?php echo base_url()?>assets/apps/js/teacher.js" charset="utf-8"></script>