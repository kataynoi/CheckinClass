<?php
// if (!defined('BASEPATH')) exit('No direct script access allowed');


class Service extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model', 'users');
        $this->load->model('Teacher_model', 'teacher');
    }

    //index action
    public function index()
    {
        $json = '{"success": true}';
        render_json($json);
    }

    public function do_login()
    {
        $json = file_get_contents('php://input');
        $obj = json_decode($json);
        $users = $this->users->do_auth_teacher($obj->username, $obj->password);
        if($users)
        {
            $data = array(
                "name" => $users->Name_Teacher,
                'id'=> $users->ID_Teacher,
                'email'=>$users->Email,
                'subject'=>$users->Subject,
                'faculty'=>$users->Faculty,
                'tel'=>$users->Tel
            );
            $rows = json_encode($data);
            $json = '{"success": true, "rows": '.$rows.'}';
        }else{
            $json = '{"success": false,}';
        }

        render_json($json);
    }

    public function delPeriod()
    {
        $json = file_get_contents('php://input');
        $obj = json_decode($json);
        $rs=$this->teacher->del_period_class($obj->ID_create_class);
        //$this->layout->view('teacher/add_course_view');
        if($rs){
            $json = '{"success": true}';
        }else{
            $json = '{"success": false}';
        }
        render_json($json);
    }
    public function setLeave()
    {
        $json = file_get_contents('php://input');
        $obj = json_decode($json);
        $rs=$this->teacher->save_checkin_student($obj->ID_Std,$obj->ID_create_class,$obj->status);
        if($rs){
            $json = '{"success": true}';
        }else{
            $json = '{"success": false}';
        }
        render_json($json);
    }
    public function getClassroom()
    {
        $json = file_get_contents('php://input');
        $obj = json_decode($json);
        $rs=$this->teacher->get_all_class($obj->id);
        if($rs) {
            $arr_result = array();
            foreach ($rs as $r) {
                $obj = new stdClass();
                $obj->ID_Class = $r->ID_Class;
                $obj->Name_Class = $r->Name_Class;
                $obj->Course = $r->Course;
                $obj->ID_Course = $r->ID_Course;
                $obj->Term = $r->Term.'/'.$r->Year;
                $obj->Name_Teacher = $r->Name_Teacher;
                $obj->count_student = $this->teacher->count_student_inclass($r->ID_Class);
                $arr_result[] = $obj;
            }

            $rows = json_encode($arr_result);
            $json = '{"success": true, "rows": '.$rows.'}';
        }else{
            $json = '{"success": false,}';
        }
        render_json($json);
    }
    public function createPeriod()
    {
        $json = file_get_contents('php://input');
        $obj = json_decode($json);
        $rs=$this->teacher->create_period_class($obj->ID_Class);
        $ID_Create_class=$rs->ID_create_class;
        $Date_create= $rs->Date_create;
        $std = $this->teacher->get_student_inclass($obj->ID_Class);
        foreach($std as $r)
        {
            $rs=$this->teacher->insert_checkin_student($obj->ID_Class,$ID_Create_class,$Date_create,$r->ID_Std);

        }

        if($rs) {
            $json = '{"success": true,}';
        }else{
            $json = '{"success": false,}';
        }
        render_json($json);
    }

    public function getCreateClass()
    {
        $json = file_get_contents('php://input');
        $obj = json_decode($json);
        $rs=$this->teacher->get_preriod_checkin_by_class($obj->ID_Class);
        $n =1;
        if($rs) {
            $arr_result = array();
            foreach ($rs as $r) {
                $obj = new stdClass();

                $obj->ID_create_class = $r->ID_create_class;
                $obj->ID_Class = $r->ID_Class;
                $obj->Date_create =to_thai_date_time($r->Date_create) ;
                $obj->Student_checkin = $this->teacher->get_total_student_checkin($r->ID_create_class);
                $obj->n = $n++;
                $arr_result[] = $obj;

            }

            $rows = json_encode($arr_result);
            $json = '{"success": true, "rows": '.$rows.'}';
        }else{
            $json = '{"success": false,}';
        }
        render_json($json);
    }
    public function getStudentCheckin()
    {
        $json = file_get_contents('php://input');
        $obj = json_decode($json);
        $rs=$this->teacher->get_student_inclass($obj->ID_Class);
        $ID_create_class= $obj->ID_create_class;
        $data['student'] =array();
        if($rs) {
            $arr_result = array();
            foreach ($rs as $r) {

                $obj = new stdClass();
                $obj->ID_Std = $r->ID_Std;
                $obj->Name_Std = $r->Name_Std;
                $obj->Branch = $r->Branch;
                $obj->Faculty = $r->Faculty;
                //$obj->Checkin = get_checkin_status($this->teacher->get_checkin($ID_create_class,$r->ID_Std));
                $obj->Checkin = $this->teacher->get_checkin($ID_create_class,$r->ID_Std);
                $arr_result[] = $obj;

            }

            $rows = json_encode($arr_result);
            $json = '{"success": true, "rows": '.$rows.'}';
        }else{
            $json = '{"success": false,}';
        }
        render_json($json);
    }
    public function checkinStudent()
    {
        $json = file_get_contents('php://input');
        $obj = json_decode($json);
        $date_create = $this->teacher->get_date_create_class($obj->ID_create_class);
        $second = DateTimeDiff( $date_create, date("Y-m-d H:i:s"));
        if($second > 1800){
            $status_checkin =3;
        }else{
            $status_checkin =2;
        }

        $rs=$this->teacher->save_checkin_student($obj->ID_Std,$obj->ID_create_class,$status_checkin);
        if($rs) {
            $json = '{"success": true,}';
        }else{
            $json = '{"success": false,}';
        }
        render_json($json);
    }
}