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
                'faculty'=>$users->Faculty
            );
            $rows = json_encode($data);
            $json = '{"success": true, "rows": '.$rows.'}';
        }else{
            $json = '{"success": false,}';
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
}