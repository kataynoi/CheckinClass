<ul class="breadcrumb">
    <li><a href="<?php echo site_url('teacher')?>">Teacher </a></li>
    <li class="active">สถานะการข้าเรียน </li>
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
            <th> ครั้งที่.</th>
            <th> วันเวลาที่เรียน </th>
            <th> สถานะการเข้าเรียน </th>

        </tr>
        </thead>
        <tbody>
        <?php
        $n=1;$inclass=0;
        foreach($checkin as $r) {

            if($r->Status_checkin)
            {$color='label-success';$txt='เข้าเรียน'; $inclass++;}
            else{$color='label-warning'; $txt='ขาดเรียน';}
            echo "<tr>";
            echo "<td>$n</td>";
            echo "<td>$r->Date_create</td>";
            echo "<td ><span class='label ".$color."'>".$txt."</span></td>";
            echo "</tr>";
            $n++;
        }
        ?>
        <tr>
            <td colspan="3"><div class="alert alert-success"> จำนวนคาบเรียนที่เปิดสอน <?PHP $n=$n-1; echo ($n)." เข้าเรียน ".$inclass." ครั้ง ขาดเรียน ".($n-$inclass)." สรปุปผลเข้าเรียนร้อยละ ".@round($inclass*100/$n,2);?></div></td>
        </tr>
        </tbody>
    </table>

</div>
<script src="<?php echo base_url()?>assets/apps/js/teacher.js" charset="utf-8"></script>