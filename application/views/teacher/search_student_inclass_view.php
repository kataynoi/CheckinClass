<ul class="breadcrumb">
    <li><a href="<?php echo site_url('teacher')?>">Teacher </a></li>
    <li class="active"> เพิ่มนักศึกษาเข้าห้องเรียน</li>
</ul>
<div class="panel-body text-center">
    <div class="row">
        <form method="post" accept-charset="utf-8" action="<?php echo site_url('teacher/search_student_inclass')."/".$ID_Class?>">


            <label class="col col-lg-2 control-label">รหัสนักศึกษา</label>
            <div class="col col-lg-5">
                <input type="text" name="ID_Std" class="form-control col col-lg-5">
                <input type="hidden" name="csrf_token" value="<?php echo $this->security->get_csrf_hash() ?>">
            </div>
            <div class="col col-lg-3">
                <button type="submit"  class="btn btn-primary"><i class="glyphicon glyphicon-save"></i> ค้นหานักศึกษาเข้าห้องเรียน</button>
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
        $n=1;
        foreach($student as $std) {
            echo "<tr>";
            echo "<td>$n</td>";
            echo "<td>$std->ID_Std</td>";
            echo "<td class='text-left'>$std->Name_Std</td>";
            echo "<td>$std->Branch</td>";
            echo "<td>$std->Faculty</td>";
            echo "<td><a class='btn btn-sm btn-info' data-name='add_student_inclass' data-id=".$std->ID_Std." data-Classid=".$ID_Class."><i class='glyphicon glyphicon-save'></i> เพิ่มเข้าห้องเรียน</a></td>";
           echo "</tr>";
            $n++;
        }
        ?>
        </tbody>
    </table>

</div>
<script src="<?php echo base_url()?>assets/apps/js/teacher.js" charset="utf-8"></script>