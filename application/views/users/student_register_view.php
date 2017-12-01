<ul class="breadcrumb">
    <li><a href="<?php echo site_url('users/login')?>">Login </a></li>
    <li class="active"> ลงทะเบียนนักศึกษา : Student Register </li>
</ul>
<div class="panel panel-default">
    <div class="panel-heading"><i class="glyphicon glyphicon-refresh"></i>  ลงทะเบียนนักศึกษา : Student Register </div>
    <div class="panel-body text-center">
        <form  class="form-horizontal"  method="post">
            <div class="row">
                <label class="col col-lg-2 control-label">รหัสนักศึกษา </label>
                <div class="col col-lg-3">
                    <input type="text" id="ID_Std" class="form-control" value="" data-type="number" placeholder="รหัสนักศึกษา">
                </div>

                <label class="col col-lg-2 control-label">ชื่อ-สกุล </label>
                <div class="col col-lg-3">
                    <input type="text" id="Name_Std" class="form-control" value="" placeholder="ชื่อ-สกุล">

                </div>
            </div>
            <br>
            <div class="row">
                <label class="col col-lg-2 control-label">รหัสผ่าน </label>
                <div class="col col-lg-3">
                    <input type="password" id="Password" class="form-control" value="" placeholder="Password">
                </div>
                <label class="col col-lg-2 control-label">เพศ </label>
                <div class="col col-lg-3">
                    <select id="Sex" class="form-control">
                        <option value="ชาย">ชาย</option>
                        <option value="หญิง">หญิง</option>

                    </select>
                </div>
            </div>
            <br>
            <div class="row">
                <label class="col col-lg-2 control-label">สาขา </label>
                <div class="col col-lg-3">
                    <input type="text" id="Branch" class="form-control" value="" placeholder="สาขา"><i id='check_email'></i>
                </div>
                <label class="col col-lg-2 control-label">คณะ </label>
                <div class="col col-lg-3">
                    <input type="text" id="Faculty" class="form-control" value="" placeholder="คณะ">
                </div>
            </div>
            <br>
            <div class="row">
                <label class="col col-lg-2 control-label">เบอร์โทร</label>
                <div class="col col-lg-3">
                    <input data-type="number" type="text" id="Tel" class="form-control" value="" placeholder="Tel"><i id='check_user' class=''></i>
                </div>
                <label class="col col-lg-2 control-label">E-mail </label>
                <div class="col col-lg-3">
                    <input type="text" id="E-mail" class="form-control" value="" placeholder="E-mail">
                </div>
            </div>
            <br>

    </div>
    </form>
</div>
<div class="panel-footer text-center">

    <button type="button" class="btn btn-primary" id="btn_save_student_register">
        <i class="glyphicon glyphicon-floppy-saved"></i> บันทึก
    </button>
    <button type="button" class=" btn btn-warning"><i class="glyphicon glyphicon-remove"></i> ยกเลิก</button>
</div>
</div>
<script src="<?php echo base_url()?>assets/apps/js/users.js" charset="utf-8"></script>