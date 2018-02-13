$(document).ready(function(){

    var setting = {};
    setting.ajax = {
        save_class: function (items, cb) {
            var url = '/teacher/save_class',
                params = {
                    items: items
                }

            app.ajax(url, params, function (err, data) {
                err ? cb(err) : cb(null, data);
            });
        },save_edit_class: function (items, cb) {
            var url = '/teacher/save_edit_class',
                params = {
                    items: items
                }

            app.ajax(url, params, function (err, data) {
                err ? cb(err) : cb(null, data);
            });
        },save_student_inclass: function (id,classid, cb) {
            var url = '/teacher/save_student_inclass',
                params = {
                    id: id,
                    classid: classid
                }

            app.ajax(url, params, function (err, data) {
                err ? cb(err) : cb(null, data);
            });
        },del_student_inclass: function (id,classid, cb) {
            var url = '/teacher/del_student_inclass',
                params = {
                    id: id,
                    classid: classid
                }

            app.ajax(url, params, function (err, data) {
                err ? cb(err) : cb(null, data);
            });
        },create_period_class: function (id, cb) {
            var url = '/teacher/create_period_class',
                params = {
                    id: id,
                }

            app.ajax(url, params, function (err, data) {
                err ? cb(err) : cb(null, data);
            });
        },
        save_course: function (items, cb) {
            var url = '/teacher/save_course',
                params = {
                    items: items
                }

            app.ajax(url, params, function (err, data) {
                err ? cb(err) : cb(null, data);
            });
        },
        save_edit_course: function (items, cb) {
            var url = '/teacher/save_edit_course',
                params = {
                    items: items
                }

            app.ajax(url, params, function (err, data) {
                err ? cb(err) : cb(null, data);
            });
        },
        del_student: function (id, cb) {
        var url = '/teacher/del_student',
            params = {
                id: id
            }

        app.ajax(url, params, function (err, data) {
            err ? cb(err) : cb(null, data);
        });
    },
        del_course: function (id, cb) {
        var url = '/teacher/del_course',
            params = {
                id: id
            }

        app.ajax(url, params, function (err, data) {
            err ? cb(err) : cb(null, data);
        });
    },
        del_class: function (id, cb) {
        var url = '/teacher/del_class',
            params = {
                id: id
            }

        app.ajax(url, params, function (err, data) {
            err ? cb(err) : cb(null, data);
        });
    },
        checkin_student: function (id_std,createclassid, cb) {
        var url = '/teacher/checkin_student',
            params = {
                id_std: id_std,
                createclassid: createclassid
            }

        app.ajax(url, params, function (err, data) {
            err ? cb(err) : cb(null, data);
        });
    }
    };
    setting.del_student = function(id){
        //app.alert('Save Pass : '+user_id+' : '+password);
        setting.ajax.del_student(id, function (err, data) {
            if (err) {
                app.alert(err);
            }
            else {
                alert('ลบเรียบร้อย ');
                window.location.reload();
            }
        });
    }
    setting.del_course = function(id){
        setting.ajax.del_course(id, function (err, data) {
            if (err) {
                app.alert(err);
            }
            else {
                alert('ลบเรียบร้อย ');
                window.location.reload();
            }
        });
    }
    setting.del_class = function(id){
        setting.ajax.del_class(id, function (err, data) {
            if (err) {
                app.alert(err);
            }
            else {
                alert('ลบเรียบร้อย ');
                window.location.reload();
            }
        });
    }
    setting.save_class = function(items){
        setting.ajax.save_class(items, function (err, data) {
            if (err) {
                app.alert(err);
            }
            else {
                alert('เพิ่มเรียบร้อย ');
                window.location=site_url+'/teacher/mg_class';
            }
        });
    }
    setting.save_edit_class = function(items){
        setting.ajax.save_edit_class(items, function (err, data) {
            if (err) {
                app.alert(err);
            }
            else {
                alert('แก้ไขเรียบร้อย ');
                window.location=site_url+'/teacher/mg_class';
            }
        });
    }
    setting.save_course = function(items){
        setting.ajax.save_course(items, function (err, data) {
            if (err) {
                app.alert(err);
            }
            else {
                alert('เพิ่มเรียบร้อย ');
                window.location=site_url+'/teacher/mg_course';
            }
        });
    }
    setting.add_student_inclass = function(id,classid){
        setting.ajax.save_student_inclass(id,classid, function (err, data) {
            if (err) {
                app.alert(err);
            }
        });
    }
    setting.checkin_student = function(id_std,createclassid){
        setting.ajax.checkin_student(id_std,createclassid, function (err, data) {
            if (err) {
                app.alert(err);
            }
            else {
                //alert('เพิ่มเรียบร้อย ');
                window.location.reload();
            }
        });
    }
    setting.del_student_inclass = function(id,classid){
        setting.ajax.del_student_inclass(id,classid, function (err, data) {
            if (err) {
                app.alert(err);
            }
            else {
                alert('ลบเรียบร้อย ');
                window.location.reload();
            }
        });
    }
    setting.create_period_class = function(id){
        setting.ajax.create_period_class(id, function (err, data) {
            if (err) {
                app.alert(err);
            }
            else {
                alert('สร้างคาบเรียบร้อย ');
                window.location.reload();
            }
        });
    }
    setting.save_edit_course = function(items){
        setting.ajax.save_edit_course(items, function (err, data) {
            if (err) {
                app.alert(err);
            }
            else {
                alert('แก้ไขเรียบร้อย ');
                window.location=site_url+'/teacher/mg_course';
            }
        });
    }
    $(document).on('click', 'a[data-name="del_student"]', function(e) {
        e.preventDefault();
        var std_id = $(this).data('id');
        if(confirm('ต้องการลบนักศึกษา')){
            setting.del_student(std_id);
        }

    });
    $(document).on('click', 'a[data-name="del_course"]', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        if(confirm('ต้องการลบวิชาเรียน')){
            setting.del_course(id);
        }

    });

    $(document).on('click', 'a[data-name="del_class"]', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        if(confirm('ต้องการลบห้องเรียน')){
            setting.del_class(id);
        }

    });
    $(document).on('click', 'a[data-name="add_student_inclass"]', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        var classid = $(this).data('classid');
        if(confirm('ต้องการเพิ่มนักศึกษาเข้าห้องเรียน')){

            setting.add_student_inclass(id,classid);
            $(this).parent().parent().hide();
        }

    });
    $(document).on('click', 'a[data-name="del_student_inclass"]', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        var classid = $(this).data('classid');
        if(confirm('ต้องการลบนักศึกษาออกจากห้องเรียน')){
            setting.del_student_inclass(id,classid);
        }

    });
    $(document).on('click', 'a[data-name="create_period_class"]', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        if(confirm('ต้องการสร้างคาบเรียน')){
            setting.create_period_class(id);
        }

    });
    $(document).on('click', 'a[data-name="btn_checkin"]', function(e) {
        //e.preventDefault();
        var id_std = $(this).data('id');
        var createclassid = $(this).data('createclassid');
            setting.checkin_student(id_std, createclassid);

    });

    $('#btn_save_course').on('click',function(){
        var items={};
        items.ID_Course=$('#ID_Course').val();
        items.Course= $('#Course').val();
        items.Credit= $('#Credit').val();
        if (!items.ID_Course) {
            app.alert('กรุณาระบุ รหัสวิชา');
            $('#ID_Course').focus();
        }else if (!items.Course) {
            app.alert('กรุณาระบุ ชื่อวิชา');
            $('#Course').focus();
        }else if(!items.Credit){
            app.alert('กรุณาระบุ หน่วยกิต');
            $('#Credit').focus();
        }
        else{
            setting.save_course(items);
        }
    });

    $('#btn_save_edit_course').on('click',function(){
        var items={};
        items.ID_Course=$('#ID_Course').val();
        items.Course= $('#Course').val();
        items.Credit= $('#Credit').val();
        if (!items.ID_Course) {
            app.alert('กรุณาระบุ รหัสวิชา');
            $('#ID_Course').focus();
        }else if (!items.Course) {
            app.alert('กรุณาระบุ ชื่อวิชา');
            $('#Course').focus();
        }else if(!items.Credit){
            app.alert('กรุณาระบุ หน่วยกิต');
            $('#Credit').focus();
        }
        else{
            setting.save_edit_course(items);
        }
    });

    $('#btn_save_class').on('click',function(){
        var items={};
        items.Name_Class= $('#Name_Class').val();
        items.ID_Course= $('#ID_Course option:selected').val();
        items.ID_Teacher= $('#ID_Teacher').val();
        items.Term= $('#Term').val();
        items.Year= $('#Year').val();
        if (!items.Name_Class) {
            app.alert('กรุณาระบุ ชื่อกลุ่มเรียน');
            $('#Name_Class').focus();
        }else if (!items.ID_Course) {
            app.alert('กรุณาเลือกวิชาเรียน');
            $('#ID_Course').focus();
        }else if(!items.Term){
            app.alert('กรุณาระบุ เทรอม');
            $('#Term').focus();
        }else if(!items.Year){
            app.alert('กรุณาระบุ ปีการศึกษา');
            $('#Year').focus();
        }
        else{
            setting.save_class(items);
        }
    });

    $('#btn_save_edit_class').on('click',function(){
        var items={};
        items.ID_Class= $('#ID_Class').val();
        items.Name_Class= $('#Name_Class').val();
        items.ID_Course= $('#ID_Course option:selected').val();
        items.ID_Teacher= $('#ID_Teacher').val();
        items.Term= $('#Term').val();
        items.Year= $('#Year').val();
        if (!items.Name_Class) {
            app.alert('กรุณาระบุ ชื่อกลุ่มเรียน');
            $('#Name_Class').focus();
        }else if (!items.ID_Course) {
            app.alert('กรุณาเลือกวิชาเรียน');
            $('#ID_Course').focus();
        }else if(!items.Term){
            app.alert('กรุณาระบุ เทรอม');
            $('#Term').focus();
        }else if(!items.Year){
            app.alert('กรุณาระบุ ปีการศึกษา');
            $('#Year').focus();
        }
        else{
            setting.save_edit_class(items);
        }
    });
});