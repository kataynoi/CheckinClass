$(document).ready(function(){
    $("#btn_login").removeAttr("disabled");
    //User namespace
    var users = {};
    users.ajax = {
        save_password: function (user_id, password, cb) {
            var url = '/users/save_pass',
                params = {
                    user_id: user_id,
                    password: password
                }

            app.ajax(url, params, function (err, data) {
                err ? cb(err) : cb(null, data);
            });
        },
        save_edit_teacher: function (items, cb) {
            var url = '/users/save_edit_teacher',
                params = {
                    items: items
                }

            app.ajax(url, params, function (err, data) {
                err ? cb(err) : cb(null, data);
            });
        },
        save_edit_student: function (items, cb) {
            var url = '/users/save_edit_student',
                params = {
                    items: items
                }

            app.ajax(url, params, function (err, data) {
                err ? cb(err) : cb(null, data);
            });
        },

        save_teacher_register: function (items, cb) {
            var url = '/users/save_teacher_register',
                params = {
                    items: items
                }

            app.ajax(url, params, function (err, data) {
                err ? cb(err) : cb(null, data);
            });
        },
        save_student_register: function (items, cb) {
            var url = '/users/save_student_register',
                params = {
                    items: items
                }

            app.ajax(url, params, function (err, data) {
                err ? cb(err) : cb(null, data);
            });
        },
        get_message: function (status, cb) {
            var url = '/users/get_message',
                params = {
                    items: status
                }

            app.ajax(url, params, function (err, data) {
                err ? cb(err) : cb(null, data);
            });
        },get_duplicate_user: function (id,username, cb) {
            var url = '/users/get_duplicate_user',
                params = {
                    id:id,
                    username: username
                }

            app.ajax(url, params, function (err, data) {
                err ? cb(err) : cb(null, data);
            });
        },get_duplicate_email: function (id,email, cb) {
            var url = '/users/get_duplicate_email',
                params = {
                    id:id,
                    email: email
                }

            app.ajax(url, params, function (err, data) {
                err ? cb(err) : cb(null, data);
            });
        },send_mail_forget_pass: function (email, cb) {
            var url = '/mail/mail_to_re_password',
                params = {
                    email: email
                }

            app.ajax(url, params, function (err, data) {
                err ? cb(err) : cb(null, data);
            });
        },request_use_system: function (username,password,sys_id, cb) {
            var url = '/users/request_use_system',
                params = {
                    username:username,
                    password: password,
                    sys_id:sys_id
                }

            app.ajax(url, params, function (err, data) {
                err ? cb(err) : cb(null, data);
            });
        }

    };

    users.check_login = function(){

        $("#btn_login").prop('disabled', true);

        var items = {};
        items.username = $('#txt_username').val();
        items.password = $('#txt_password').val();

        if(!items.username) {

            //alert('กรุณาระบุชื่อผู้ใช้งาน');
            app.alert('กรุณาระบุชื่อผู้ใช้งาน');
            $("#btn_login").removeProp("disabled");
            return false;

        }else if(!items.password) {

            app.alert('กรุณาระบุรหัสผ่าน');
            //app.alert('กรุณาระบุรหัสผ่าน');
            $("#btn_login").removeProp("disabled");
            return false;

        }else{
            return true;
        }
    }

    users.save_password = function(user_id,password){
        //app.alert('Save Pass : '+user_id+' : '+password);
        users.ajax.save_password(user_id,password, function (err, data) {
            if (err) {
                app.alert(err);
            }
            else {
                alert('เปลี่ยนรหัสผ่านเรียบร้อยแล้ว กรุณาเข้าสู่ระบบ อีคกรั้ง');
                window.location = 'logout';
            }
        });
    }
    // Save Edit User

    //#################### checkin
    users.save_teacher_register = function(items){
        //app.alert('Save Pass : '+user_id+' : '+password);
        users.ajax.save_teacher_register(items, function (err, data) {
            if (err) {
                app.alert(err);
            }
            else {
                alert('ลงทะเบียนเรียบร้อย ');
                window.location = 'login';
            }
        });
    }

    users.save_student_register = function(items){
        //app.alert('Save Pass : '+user_id+' : '+password);
        users.ajax.save_student_register(items, function (err, data) {
            if (err) {
                app.alert(err);
            }
            else {
                alert('ลงทะเบียนเรียบร้อย ');
                window.location = 'login';
            }
        });
    }

    users.save_edit_teacher = function(items){
        //app.alert('Save Pass : '+user_id+' : '+password);
        users.ajax.save_edit_teacher(items, function (err, data) {
            if (err) {
                app.alert(err);
            }
            else {
                alert('แก้ไขเรียบร้อย ');
                //window.location = 'login';
            }
        });
    }

    users.save_edit_student = function(items){
        //app.alert('Save Pass : '+user_id+' : '+password);
        users.ajax.save_edit_student(items, function (err, data) {
            if (err) {
                app.alert(err);
            }
            else {
                alert('แก้ไขเรียบร้อย ');
                //window.location = 'login';
            }
        });
    }
    // #################  Checkin

    $('#frm_login').on('submit', function(e) {
        return users.check_login();
    });

    $('#btn_save_pass').on('click',function(){
        var items={};
        items.user_id=$('#user_id').val();
        items.password = $('#newPass').val();
        items.repassword=$('#rePass').val();
        if (!items.password) {
            app.alert('กรุณาระบุ หรัสผ่าน');
            $('#newPass').focus();
        } else if (items.password.length<4) {
            app.alert('กรุณาระบุการรหัสผ่าน มากกว่า 4 ตัวอักษร');
            $('#newPass').focus();
        } else if (!items.repassword) {
            app.alert('กรุณาระบุการยืนยันรหัสผ่าน');
            $('#rePass').focus();
        } else if (items.repassword.length<4) {
            app.alert('กรุณาระบุการรหัสผ่าน มากกว่า 4 ตัวอักษร');
            $('#rePass').focus();
        }else if(items.password != items.repassword){
            app.alert('การยืนยันรหัสผ่านไม่ตรงกัน');
            $('#rePass').focus();
        }
        else{
            users.save_password(items.user_id,items.password);
        }
    });

// checkin
    $('#btn_save_edit_teacher').on('click',function(){
        var items={};
        items.ID_Teacher=$('#ID_Teacher').val();
        items.Name_Teacher= $('#Name_Teacher').val();
        items.Password= $('#Password').val();
        items.Email=$('#E-mail').val();
        items.Tel=$('#Tel').val();
        items.Subject=$('#Subject').val();
        items.Faculty=$('#Faculty').val();
        items.Sex=$('#Sex').val();
        if (!items.ID_Teacher) {
            app.alert('กรุณาระบุ รหัสอาจารย์');
            $('#ID_Teacher').focus();
        }else if (!items.Name_Teacher) {
            app.alert('กรุณาระบุ ชื่ออาจารย์');
            $('#Name_Teacher').focus();
        }else if(!items.Email){
            app.alert('กรุณาระบุ E-mail');
            $('#E-mail').focus();
        }else if(!items.Password){
            app.alert('กรุณาระบุ Password');
            $('#Password').focus();
        }
        else{
            users.save_edit_teacher(items);
        }
    });
    $('#btn_save_edit_student').on('click',function(){
        var items={};
        items.ID_Std=$('#ID_Std').val();
        items.Name_Std= $('#Name_Std').val();
        items.Password= $('#Password').val();
        items.Email=$('#E-mail').val();
        items.Tel=$('#Tel').val();
        items.Branch=$('#Branch').val();
        items.Faculty=$('#Faculty').val();
        items.Sex=$('#Sex').val();
        if (!items.ID_Std) {
            app.alert('กรุณาระบุ รหัสนักศึกษา');
            $('#ID_Std').focus();
        }else if (!items.Name_Std) {
            app.alert('กรุณาระบุ ชื่อนักศึกษา');
            $('#Name_Std').focus();
        }else if(!items.Email){
            app.alert('กรุณาระบุ E-mail');
            $('#E-mail').focus();
        }else if(!items.Password){
            app.alert('กรุณาระบุ Password');
            $('#Password').focus();
        }
        else{
            users.save_edit_student(items);
        }
    });
//Checkin
    $('#btn_save_teacher_register').on('click',function(){
        var items={};
        items.ID_Teacher=$('#ID_Teacher').val();
        items.Name_Teacher= $('#Name_Teacher').val();
        items.Password= $('#Password').val();
        items.Email=$('#E-mail').val();
        items.Tel=$('#Tel').val();
        items.Subject=$('#Subject').val();
        items.Faculty=$('#Faculty').val();
        items.Sex=$('#Sex').val();
        if (!items.ID_Teacher) {
            app.alert('กรุณาระบุ รหัสอาจารย์');
            $('#ID_Teacher').focus();
        }else if (!items.Name_Teacher) {
            app.alert('กรุณาระบุ ชื่ออาจารย์');
            $('#Name_Teacher').focus();
        }else if(!items.Email){
            app.alert('กรุณาระบุ E-mail');
            $('#E-mail').focus();
        }else if(!items.Password){
            app.alert('กรุณาระบุ Password');
            $('#Password').focus();
        }
        else{
            users.save_teacher_register(items);
        }
    });

    $('#btn_save_student_register').on('click',function(){
        var items={};
        items.ID_Std=$('#ID_Std').val();
        items.Name_Std= $('#Name_Std').val();
        items.Password= $('#Password').val();
        items.Email=$('#E-mail').val();
        items.Tel=$('#Tel').val();
        items.Branch=$('#Branch').val();
        items.Faculty=$('#Faculty').val();
        items.Sex=$('#Sex').val();
        if (!items.ID_Std) {
            app.alert('กรุณาระบุ รหัสนักศึกษา');
            $('#ID_Std').focus();
        }else if (!items.Name_Std) {
            app.alert('กรุณาระบุ ชื่อนักศึกษา');
            $('#Name_Std').focus();
        }else if(!items.Email){
            app.alert('กรุณาระบุ E-mail');
            $('#E-mail').focus();
        }else if(!items.Password){
            app.alert('กรุณาระบุ Password');
            $('#Password').focus();
        }
        else{
            users.save_student_register(items);
        }
    });
 $('#btn_request').on('click',function(){
    // app.alert('Request');
     var items = {};
     items.username = $('#txt_username').val();
     items.password = $('#txt_password').val();

     if(!items.username) {

         alert('กรุณาระบุชื่อผู้ใช้งาน');
         //app.alert('กรุณาระบุชื่อผู้ใช้งาน');
         $("#btn_login").removeProp("disabled");
         return false;

     }else if(!items.password) {

         alert('กรุณาระบุรหัสผ่าน');
         //app.alert('กรุณาระบุรหัสผ่าน');
         $("#btn_login").removeProp("disabled");
         return false;

     }else{
         users.ajax.request_use_system(items.password,items.username,sys_id, function (err, data) {
             //console.log(data);
             if (err) {
                 app.alert('การร้องขอใช้งาน ไม่สำเร็จ อาจเนื่องมาจาก    Username Password ไม่ถูกต้อง หรือ ท่านมีชื่ออยู่ในระบบนี้แล้ว ');
                 //app.alert(err);
             }
             else {
                     app.alert('ทำการร้องขอใช้ ระบบ เรียบร้อยแล้ว จะส่งผลการอนุมัติการใช้ระบบไปทาง Email ');
             }
         });
     }
 });
});