$(document).ready(function(){

    var setting = {};
    setting.ajax = {
        save_edit_hserv: function (items, cb) {
            var url = '/settings/save_edit_hserv',
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
    $(document).on('click', 'a[data-name="del_student"]', function(e) {
        e.preventDefault();
        var std_id = $(this).data('id');
        if(confirm('ต้องการลบนักศึกษา')){
            //app.alert(villid);
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
});