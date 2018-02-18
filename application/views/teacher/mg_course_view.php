<ul class="breadcrumb">
    <li><a href="<?php echo site_url('users/login')?>">Login </a></li>
    <li class="active">  ข้อมูลรายวิชา : Course view</li>

</ul>
<div class="panel panel-default">
    <div class="panel-heading"><i class="glyphicon glyphicon-refresh"></i> ข้อมูลรายวิชา : Course view <span class=" pull-right">
        <a href="add_course" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> เพิ่มรายวิชา </a></span></div>
    <div class="panel-body text-center">
      <table class="table table-responsive">
          <thead>
            <tr>
                <th> รหัสวิชา </th>
                <th> ชื่อวิชา </th>
                <th> หน่วยกิต </th>
                <th> การจัดการ </th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach($course as $std) {
                echo "<tr>";
                echo "<td>$std->ID_Course</td>";
                echo "<td class='text-left'>$std->Course</td>";
                echo "<td>$std->Credit</td>";
                echo "<td><a href='".site_url('teacher/edit_course/')."/".$std->ID_Course."' alt='แก้ไข'><i class='glyphicon glyphicon-edit'></i></a> ";
                echo "<a  alt='ลบ' data-name='del_course' data-id=".$std->ID_Course."><i class='glyphicon glyphicon-remove' ></i></td>";
                echo "</tr>";
            }

            ?>
          </tbody>
      </table>

    </div>
 </div>
<script src="<?php echo base_url()?>assets/apps/js/teacher.js" charset="utf-8"></script>