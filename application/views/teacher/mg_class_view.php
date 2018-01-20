<ul class="breadcrumb">
    <li><a href="<?php echo site_url('users/login')?>">Login </a></li>
    <li class="active">  ข้อมูลห้องเรียน : Class view</li>
</ul>
<div class="panel panel-default">
    <div class="panel-heading"><i class="glyphicon glyphicon-refresh"></i> ข้อมูลห้องเรียน : Class view <span class=" pull-right">
        <a href="add_class" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> เพิ่มห้องเรียน </a></span></div>
    <div class="panel-body">
      <table class="table table-responsive">
          <thead>
            <tr>
                <th> รหัสห้องเรียน </th>
                <th> ชื่อห้องเรียน</th>
                <th> ชื่อวิชา </th>
                <th> อาจาร์ผู้สอน </th>
                <th> จำนวนนักศึกษา</th>
                <th> การจัดการ </th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach($class as $rs) {
                echo "<tr>";
                echo "<td>$rs->ID_Class</td>";
                echo "<td class='text-left'>$rs->Name_Class</td>";
                echo "<td>$rs->Course<a href='add_student_inclass"."/".$rs->ID_Class."' class='btn btn-success btn-sm'>เพิ่มนักศึกษา</a></td>";
                echo "<td>$rs->Name_Teacher</td>";
                echo "<td>$rs->count_student</td>";
                echo "<td><a href='".site_url('teacher/edit_class/')."/".$rs->ID_Class."' alt='แก้ไข'><i class='glyphicon glyphicon-edit'></i></a> ";
                echo "<a  alt='ลบ' data-name='del_class' data-id=".$rs->ID_Class."><i class='glyphicon glyphicon-remove' ></i></td>";
                echo "</tr>";
            }

            ?>
          </tbody>
      </table>

    </div>
 </div>
<script src="<?php echo base_url()?>assets/apps/js/teacher.js" charset="utf-8"></script>