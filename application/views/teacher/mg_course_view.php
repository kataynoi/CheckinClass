<ul class="breadcrumb">
    <li><a href="<?php echo site_url('users/login')?>">Login </a></li>
    <li class="active">  ข้อมูลรายวิชา : Course view</li>
</ul>
<div class="panel panel-default">
    <div class="panel-heading"><i class="glyphicon glyphicon-refresh"></i> ข้อมูลรายวิชา : Course view <span class=" pull-right">
        <button class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> เพิ่มรายวิชา </button></span></div>
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
                echo "<td><a href='".base_url('users/mg_student')."' alt='แก้ไข'><i class='glyphicon glyphicon-edit'></i></a> ";
                echo "<a href='".base_url('users/mg_student')."' alt='ลบ'><i class='glyphicon glyphicon-remove' ></i></td>";
                echo "</tr>";
            }

            ?>
          </tbody>
      </table>

    </div>
 </div>