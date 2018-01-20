<ul class="breadcrumb">
    <li><a href="<?php echo site_url('users/login')?>">Login </a></li>
    <li class="active">  ข้อมูลรายวิชา : Course view</li>
</ul>
<div class="panel panel-default">
    <div class="panel-heading"><i class="glyphicon glyphicon-refresh"></i> ข้อมูลรายวิชา : Course view <span class=" pull-right"></div>
    <div class="panel-body text-center">
      <table class="table table-responsive">
          <thead>
            <tr>
                <th> รหัสวิชา </th>
                <th> ชื่อวิชา </th>
                <th> อาจารย์ผู้สอน </th>
                <th> กลุ่มเรียน </th>
                <th> จำนวนครั้งที่เข้าเรียน </th>
                <th> ร้อยละ </th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach($course as $std) {
                echo "<tr>";
                echo "<td>$std->ID_Course</td>";
                echo "<td class='text-left'>$std->Course <span class='label label-info'>[ภาคเรียนที่ $std->Term / $std->Year]</span></td>";
                echo "<td class='text-left'>$std->Name_Teacher</td>";
                echo "<td class='text-left'>$std->Name_Class</td>";
                echo "<td><a href='".base_url('student/report_checkin_by_course')."/".$std->ID_Class."' class='btn btn-success btn-sm'>ตรวจสอบการเข้าเรียน</a></td>";
                echo "<td></td>";
                echo "</tr>";
            }

            ?>
          </tbody>
      </table>

    </div>
 </div>
<script src="<?php echo base_url()?>assets/apps/js/teacher.js" charset="utf-8"></script>