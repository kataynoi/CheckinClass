<ul class="breadcrumb">
    <li><a href="<?php echo site_url('users/login')?>">Login </a></li>
    <li class="active">  ข้อมูลนักศึกษา : Student view</li>
</ul>
<div class="panel panel-default">
    <div class="panel-heading"><i class="glyphicon glyphicon-refresh"></i> ข้อมูลนักศึกษา : Student view</div>
    <div class="panel-body text-center">
      <table class="table table-responsive">
          <thead>
            <tr>
                <th> รหัสนักศึกษา </th>
                <th> ชื่อนักศึกษา </th>
                <th> สาขาวิชา </th>
                <th> คณะ </th>
                <th> เบอร์โทร </th>
                <th> การจัดการ </th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach($student as $std) {
                echo "<tr>";
                echo "<td>$std->ID_Std</td>";
                echo "<td class='text-left'>$std->Name_Std</td>";
                echo "<td>$std->Branch</td>";
                echo "<td>$std->Faculty</td>";
                echo "<td>$std->Tel</td>";
                echo "<td><a href='".base_url('users/mg_student')."' alt='แก้ไข'><i class='glyphicon glyphicon-edit'></i></a> ";
                echo "<a href='".base_url('users/mg_student')."' alt='ลบ'><i class='glyphicon glyphicon-remove' ></i></td>";
                echo "</tr>";
            }

            ?>
          </tbody>
      </table>

    </div>
 </div>