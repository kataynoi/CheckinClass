<ul class="breadcrumb">
    <li><a href="<?php echo site_url('teacher')?>">Teacher </a></li>
    <li class="active"> รายงานการเข้าเรียน</li>
    <li class="">
        <div class="pull-right">
            <button type="button" class="btn btn-info " data-name="print">
                <i class="glyphicon glyphicon-print"></i> พิมพ์รายงาน
            </button>
        </div>
    </li>
</ul>
<div class="panel panel-default">
        <div class="panel-heading"><i class="glyphicon glyphicon-refresh"></i>สถานะการเข้าเรียน</div>
        <div class="panel-body">
            <table class="table table-responsive">
                <thead>

                </thead>
                <tbody>
                <tr>
                    <td>ชื่อวิชา</td>
                    <td><?php echo $class->Course;?></td>
                </tr>
                <tr>
                    <td>อาจารย์ผู้สอน</td>
                    <td><?php echo $class->Name_Teacher;?></td>
                </tr>
                <tr>
                    <td>กลุ่มเรียน</td>
                    <td><?php echo $class->Name_Class;?></td>
                </tr>
                <tr>
                    <td>ภาคเรียน </td>
                    <td><?php echo $class->Term ." / ". $class->Year;?></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
<div class="panel-body text-center">
    <table class="table table-responsive">
        <thead>
        <tr>
            <th> NO.</th>
            <th> รหัสนักศึกษา </th>
            <th> ชื่อนักศึกษา </th>
            <th> มาเรียน</th>
            <th> มาสาย</th>
            <th> ขาด</th>
            <th> ลา</th>
            <th> เข้าเรียนร้อยละ</th>
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
            echo "<td><span class='badge badge-success'>$std->Status2</span></td>";
            echo "<td><span class='badge badge-warning'>$std->Status3</span></td>";
            echo "<td><span class='badge badge-error'>$std->Status1</span></td>";
            echo "<td><span class='badge '>$std->Status4</span></td>";
            echo "<td><span class='badge badge-success'>".Round($std->Status2*100/($std->Status1+$std->Status2+$std->Status3+$std->Status4),2)."</span></td>";
            echo "</tr>";
            $n++;
        }
        ?>
        </tbody>
    </table>


</div>
<script src="<?php echo base_url()?>assets/apps/js/teacher.js" charset="utf-8"></script>