<ul class="breadcrumb">
    <li><a href="<?php echo site_url('users/login')?>">Login </a></li>
    <li class="active">รายงานการข้าเรียน</li>
</ul>
<div class="panel panel-default">
    <div class="panel-heading">
        <i class="glyphicon glyphicon-refresh"></i> ข้อมูลห้องเรียน : Class view
    </div>
            <div class="panel-body">
      <table class="table table-responsive">
          <thead>
            <tr>
                <th> รหัสห้องเรียน </th>
                <th> ชื่อห้องเรียน</th>
                <th> ชื่อวิชา </th>
                <th> อาจาร์ผู้สอน </th>
                <th> จำนวนนักศึกษา</th>
                <th> จำนวนคาบเรียนที่เปิดแล้ว</th>
                <th> การเข้าเรียน </th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach($class as $rs) {
                echo "<tr>";
                echo "<td>$rs->ID_Class</td>";
                echo "<td class='text-left'>$rs->Name_Class</td>";
                echo "<td>$rs->Course</td>";
                echo "<td>$rs->Name_Teacher</td>";
                echo "<td>$rs->count_student</td>";
                echo "<td>$rs->Num_create_class</td>";
                echo "<td><a href='".site_url('report/report_by_class/')."/".$rs->ID_Class."' alt='การเข้าเรียน' class='btn btn-success btn-sm'>
                <i class='glyphicon glyphicon-edit'></i>รายงานการเข้าเรียน</a> </td>";
                echo "</tr>";
            }

            ?>
          </tbody>
      </table>

    </div>
 </div>
<script src="<?php echo base_url()?>assets/apps/js/teacher.js" charset="utf-8"></script>