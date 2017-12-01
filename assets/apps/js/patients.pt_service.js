$(document).ready(function(){

    var audit = {};
    audit.ajax = {
        check_person_audit: function (cid,hospcode, cb) {
            var url = '/audit/check_person_audit',
                params = {
                    cid: cid,
                    hospcode : hospcode
                }

            app.ajax(url, params, function (err, data) {
                err ? cb(err) : cb(null, data);
            });
        },
        get_person: function (cid, cb) {
        var url = '/basic/get_person',
            params = {
                cid: cid
            }

        app.ajax(url, params, function (err, data) {
            err ? cb(err) : cb(null, data);
            });
        },
        get_service: function (items, cb) {
        var url = '/patients/get_service',
            params = {
                items: items
            }

        app.ajax(url, params, function (err, data) {
            err ? cb(err) : cb(null, data);
            });
        },
        get_visit_list: function (items, cb) {
        var url = '/audit/get_visit_list',
            params = {
                items: items
            }

        app.ajax(url, params, function (err, data) {
            err ? cb(err) : cb(null, data);
            });
        }
};
    audit.check_person_audit = function(cid,hospcode,items){
        audit.ajax.check_person_audit(cid,hospcode, function (err, data) {
            if(data.check){
                audit.get_person(items.cid);
                audit.get_service(items);
            }else{
                app.alert('ท่านไม่สามารถค้นหาผู้ป่วยที่ท่านไม่ได้รับผิดชอบได้');
            }

        });

    }
audit.get_service = function(items){
        $('#service_list >').empty();
        audit.ajax.get_service(items, function (err, data) {
                audit.set_service(data);

        });

    }

 audit.get_person = function(cid){
        $('#tbl_person_list > tbody').empty();
        audit.ajax.get_person(cid, function (err, data) {
                audit.set_person(data);

        });

    }
    audit.set_person=function(data){
        $('#tbl_person_list > tbody').empty();
        var no=1;
        if (_.size(data.rows) > 0) {
            _.each(data.rows, function (v) {

                $('#tbl_person_list > tbody').append(
                    '<tr>' +
                        '<td>' + no + '</td>' +
                        '<td>' + v.off_name + '</td>' +
                        '<td>' + v.name + '</td>' +
                        '<td>' + v.cid + '</td>' +
                        '<td>' + v.address + '</td>' +
                        '<td>' + v.birth + '</td>' +
                        '<td>' + v.age + '</td>' +
                        '<td>' + v.typearea+ '</td>' +
                        '</tr>'
                );
                no=no+1;

            });
        }
        else {
            $('#tbl_person_list > tbody').append('<tr><td colspan="8">ไม่พบรายการ</td></tr>');
        }

    }
audit.get_visit_list = function(items){
        $('#visit_list').empty();
        audit.ajax.get_visit_list(items, function (err, data) {
                audit.set_visit_list(data);
        });

    }
    audit.set_visit_list=function(data){
        $('#visit_list').empty();
        var no= 1,drug_no=1;
        if (_.size(data.rows) > 0) {
            _.each(data.rows, function (v) {
                $('#visit_list').append(
                    '<br><div class="panel panel-primary">' +
                        '<div class="panel-body">' +
                        '<dl class="dl-horizontal col-lg-6">'+
                        '<dt>หน่วยที่บันทึกข้อมูล</dt><dd>'+ v.off_name+'</dd>' +
                        '<dt>อายุ ณ. วันรับบริการ</dt><dd>'+ v.age+'</dd>' +
                        '<dt>BP</dt><dd>'+ v.bp1+'</dd>' +
                        '<dt>Temp</dt><dd>'+ v.temp+'</dd>' +


                        '</dl>'+
                        '<dl class="dl-horizontal col-lg-6">'+
                        '<dt> SEQ </dt><dd>'+ v.seq+'</dd>' +
                        '<dt> RR </dt><dd>'+ v.rr+'</dd>' +
                        '<dt> PR </dt><dd>'+ v.pr+'</dd>' +
                        '</dl>' +
                        '<dl class="dl-horizontal col-lg-12" id="diag_list"><dt></dt><dd></dd></dl>' +
                        '<dl class="dl-horizontal col-lg-12" id="proced_list"><dt></dt><dd></dd></dl>' +
                        '<table id="drug_list" class="table"><thead><th>ลำดับที่</th><th>ชื่อยา</th><th>จำนวนที่จ่าย</th><th>Cost</th><th>Price</th><th>Cost รวม</th><th>Price รวม</th></thead>' +
                        '<tbody></tbody></table>' +
                        '</div></div>'

                );
                _.each(v.diag, function (d) {
                    $('#diag_list').append(
                            '<dt> DiagType : '+ d.DIAGTYPE +' </dt><dd>'+ d.DIAGCODE+':'+d.diseasename+':'+ d.diseasenamethai+'</dd>'
                    );

                });
                _.each(v.proced, function (p) {
                    $('#proced_list').append(
                            '<dt> Procedure : '+ p.PROCED +' </dt><dd>'+ p.diseasefullname+'</dd>'
                    );

                });
                _.each(v.drug, function (drug) {
                    $('#drug_list >tbody').append(
                            '<tr><td>'+drug_no+'</td><td>'+drug.DNAME+'</td><td>'+drug.AMOUNT+'</td><td>'+drug.DRUGCOST+'</td><td>'+drug.DRUGPRICE+'</td><td>'+app.add_commars_with_out_decimal((drug.AMOUNT*1)*(drug.DRUGCOST*1))+'</td><td>'+app.add_commars_with_out_decimal((drug.AMOUNT*1)*(drug.DRUGPRICE*1))+'</td></tr>'
                    );
                drug_no=drug_no+1;
                });
            });
        }
        else {
            $('#tbl_person_list > tbody').append('<tr><td colspan="8">ไม่พบรายการ</td></tr>');
        }

    }

    audit.set_service=function(data){
        $('#service_list').empty();
        var no=1;
        if (_.size(data.rows) > 0) {
            _.each(data.rows, function (v) {
                $('#service_list').append(
                    '<li class="list-group-item text-center"><span class="badge success pull-left">'+no+'</span> <strong><a href="#" class="btn-link" data-name="btn_service_date" data-visit_date="'+ v.date_serv+'">'+ v.date_serv+'</strong></a>' +
                    '<h6>['+app.strip(v.hospname,30)+']</h6></li>'
                );
                no=no+1;

            });
        }
        else {
            $('#tbl_person_list > tbody').append('<tr><td colspan="8">ไม่พบรายการ</td></tr>');
        }

    }

    $('#btn_search').on('click',function(e){
        e.preventDefault();
        var items={};
        items.date_start=$('#date_start').val();
        items.date_end=$('#date_end').val();
        items.cid = $('#cid').val();
        if($('#op').prop('checked')) {items.op='1';}else{items.op='0';}
       if(!items.date_start){
            app.alert('กรุณาระบุวันเริ่มต้น');
            $('#date_start').focus();
        }else if(!items.date_end){
            app.alert('กรุณาระบุวันสิ้นสุด');
            $('#date_end').focus()
        }else if(!items.cid){
            app.alert('กรุณาระบุเลขบัตรประชาชน');
            $('#cid').focus()
        }else{
            $('#service_list').empty();
            $('#visit_list').empty();
            /*audit.check_person_audit(items.cid,items.hospcode,items);*/
           audit.get_person(items.cid);
           audit.get_service(items);
        }
    })

    $(document).on('click', 'a[data-name="btn_service_date"]', function(e) {
        e.preventDefault();
        var items={};
        items.cid = $('#cid').val();
        items.visit_date=$(this).data('visit_date');
        var visit_date = $(this).data('date');
        if(!items.cid){
            app.alert('กรุณาระบุเลขบัตรประชาชน');
            $('#cid').focus()
        }else{
            $('#tbl_visit_list').empty();
            audit.get_visit_list(items);
           // alert(visit_date);
        }
    });
});