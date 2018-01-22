<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: spiderman
 * Date: 13/11/2556
 * Time: 11:20 น.
 * To change this template use File | Settings | File Templates.
 */


class Teacher extends CI_Controller {
    public $id_teacher;

    public function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata("name")){
            redirect(site_url('users/login'));
        }
        //load model
        $this->layout->setLayout('teacher_layout');
        $this->load->model('teacher_model', 'teacher');
        $this->load->model('Basic_model', 'basic');
        $this->db = $this->load->database('default', true);
        $this->id_teacher = $this->session->userdata('id');


    }

    public function index()
    {
        //$data['audit']=$this->audit->get_hospaudit($this->amp_code);
        $this->layout->view('teacher/index_view');
    }
    public function mg_teacher()
    {
        $data['teacher']=$this->teacher->get_teacher($this->id_teacher);
        $this->layout->view('teacher/mg_teacher_view',$data);
    }
    public function mg_student()
    {
        $data['student']=$this->teacher->get_student();
        $this->layout->view('teacher/mg_student_view',$data);
    }

    public function mg_course()
    {
        $data['course']=$this->teacher->get_course();
        $this->layout->view('teacher/mg_course_view',$data);
    }

    public function mg_class()
    {
        $rs=$this->teacher->get_all_class($this->session->userdata('id'));
        $data['class'] = array();
        if($rs) {
            $arr_result = array();
            foreach ($rs as $r) {
                $obj = new stdClass();
                $obj->ID_Class = $r->ID_Class;
                $obj->Name_Class = $r->Name_Class;
                $obj->Course = $r->Course;
                $obj->Name_Teacher = $r->Name_Teacher;
                $obj->count_student = $this->teacher->count_student_inclass($r->ID_Class);

                //$obj->off_name  = $this->users->get_off_name($r->id);
                $arr_result[] = $obj;
            }

            //$rows = json_encode($arr_result);
            $data['class'] = $arr_result;
        }
        $this->layout->view('teacher/mg_class_view',$data);
    }
    public function mg_checkin_class()
    {
        $rs=$this->teacher->get_all_class($this->session->userdata('id'));
        $data['class'] = array();
        if($rs) {
            $arr_result = array();
            foreach ($rs as $r) {
                $obj = new stdClass();
                $obj->ID_Class = $r->ID_Class;
                $obj->Name_Class = $r->Name_Class;
                $obj->Course = $r->Course;
                $obj->Name_Teacher = $r->Name_Teacher;
                $obj->count_student = $this->teacher->count_student_inclass($r->ID_Class);
                $obj->Num_create_class  = $this->teacher->get_num_create_class($r->ID_Class);
                $arr_result[] = $obj;
            }
        }

        $data['class'] = $arr_result;
        $this->layout->view('teacher/mg_checkin_class_view',$data);
    }
    public  function  checkin($id,$Create_class_id,$n){

        $data['ID_Class']=$id;
        $data['n']=$n;
        $data['period'] = $this->teacher->get_period_id($Create_class_id);
        $rs=$this->teacher->get_student_inclass($id);
        $data['class']=$this->teacher->get_class_id($id);
        $data['course']=$this->teacher->get_course();
        $data['student'] =array();
        if($rs) {
            $arr_result = array();
            foreach ($rs as $r) {
                $obj = new stdClass();
                $obj->ID_Std = $r->ID_Std;
                $obj->Name_Std = $r->Name_Std;
                $obj->Branch = $r->Branch;
                $obj->Faculty = $r->Faculty;
                $obj->Checkin = $this->teacher->get_checkin($Create_class_id,$r->ID_Std);
                $obj->Create_class_id = $Create_class_id;
                $arr_result[] = $obj;
            }

            //$rows = json_encode($arr_result);
            $data['student'] = $arr_result;
        }

        $this->layout->view('teacher/checkin_view',$data);
    }
    public function add_course()
    {
        //$data['course']=$this->teacher->get_course();
        $this->layout->view('teacher/add_course_view');
    }
    public function add_class()
    {
        $data['course']=$this->teacher->get_course();
        $this->layout->view('teacher/add_class_view',$data);
    }
    public function edit_course($id)
    {
        $data['course']=$this->teacher->get_course_id($id);
        $this->layout->view('teacher/edit_course_view',$data);
    }
    public function edit_class($id)
    {
        $data['class']=$this->teacher->get_class_id($id);
        $data['course']=$this->teacher->get_course();
        $this->layout->view('teacher/edit_class_view',$data);
    }

    public function add_student_inclass($id)
    {   $data['ID_Class']=$id;
        $data['student']=$this->teacher->get_student_inclass($id);
        $data['class']=$this->teacher->get_class_id($id);
        $data['course']=$this->teacher->get_course();
        $this->layout->view('teacher/add_student_inclass_view',$data);
    }
    public function create_checkin_class($id)
    {   $data['ID_Class']=$id;
        $data['numall_student']=$this->teacher->get_numall_student_inclass($id);
        $data['class']=$this->teacher->get_class_id($id);
        $data['course']=$this->teacher->get_course();
        $data['checkin']=array();
        $rs=$this->teacher->get_preriod_checkin_by_class($id);
        if($rs) {
            $arr_result = array();
            foreach ($rs as $r) {
                $obj = new stdClass();
                $obj->ID_create_class = $r->ID_create_class;
                $obj->ID_Class = $r->ID_Class;
                $obj->Date_create =to_thai_date_time($r->Date_create) ;
                $obj->Student_checkin = $this->teacher->get_total_student_checkin($r->ID_create_class);
                //$obj->count_student = $this->teacher->count_student_inclass($r->ID_Class);

                //$obj->off_name  = $this->users->get_off_name($r->id);
                $arr_result[] = $obj;
            }
            $data['checkin'] = $arr_result;
        }
        $this->layout->view('teacher/create_checkin_class_view',$data);
    }
    public function search_student_inclass($ID_Class)
    {
        $id_std=$this->input->post('ID_Std');
        $data['ID_Class']=$ID_Class;
        if(!empty($id_std)|| $id_std !=''){
            $data['student']=$this->teacher->search_student_id($id_std,$ID_Class);
        }else{
            $data['student']=array();
        }
        $this->layout->view('teacher/search_student_inclass_view',$data);
    }
    public function del_student()
    {
        $id=$this->input->post('id');
        $rs=$this->teacher->del_student($id);
        //$this->layout->view('teacher/add_course_view');
        if($rs){
            $json = '{"success": true}';
        }else{
            $json = '{"success": false}';
        }
        render_json($json);
    }
    public function del_course()
    {
        $id=$this->input->post('id');
        $rs=$this->teacher->del_course($id);
        //$this->layout->view('teacher/add_course_view');
        if($rs){
            $json = '{"success": true}';
        }else{
            $json = '{"success": false}';
        }
        render_json($json);
    }
    public function del_class()
    {
        $id=$this->input->post('id');
        $rs=$this->teacher->del_class($id);
        //$this->layout->view('teacher/add_course_view');
        if($rs){
            $json = '{"success": true}';
        }else{
            $json = '{"success": false}';
        }
        render_json($json);
    }
    public function create_period_class()
    {
        $id=$this->input->post('id');
        $rs=$this->teacher->create_period_class($id);


        if($rs){
            $json = '{"success": true}';
        }else{
            $json = '{"success": false}';
        }
        render_json($json);
    }
    public function save_student_inclass()
    {
        $id=$this->input->post('id');
        $classid=$this->input->post('classid');
        $rs=$this->teacher->save_student_inclass($id,$classid);
        //$this->layout->view('teacher/add_course_view');
        if($rs){
            $json = '{"success": true}';
        }else{
            $json = '{"success": false}';
        }
        render_json($json);

    }public function del_student_inclass()
    {
        $id=$this->input->post('id');
        $classid=$this->input->post('classid');
        $rs=$this->teacher->del_student_inclass($id,$classid);
        //$this->layout->view('teacher/add_course_view');
        if($rs){
            $json = '{"success": true}';
        }else{
            $json = '{"success": false}';
        }
        render_json($json);
    }
    public function save_course()
    {
        $items=$this->input->post('items');
        $rs=$this->teacher->save_course($items);
        if($rs){
            $json = '{"success": true}';
        }else{
            $json = '{"success": false}';
        }
        render_json($json);
    }
    public function save_class()
    {
        $items=$this->input->post('items');
        $rs=$this->teacher->save_class($items);
        if($rs){
            $json = '{"success": true}';
        }else{
            $json = '{"success": false}';
        }
        render_json($json);
    }

    public function save_edit_course()
    {
        $items=$this->input->post('items');
        $rs=$this->teacher->save_edit_course($items);
        if($rs){
            $json = '{"success": true}';
        }else{
            $json = '{"success": false}';
        }
        render_json($json);
    }
    public function save_edit_class()
    {
        $items=$this->input->post('items');
        $rs=$this->teacher->save_edit_class($items);
        if($rs){
            $json = '{"success": true}';
        }else{
            $json = '{"success": false}';
        }
        render_json($json);
    }
    public function checkin_student()
    {
        $id_std=$this->input->post('id_std');
        $createclassid=$this->input->post('createclassid');
        $rs=$this->teacher->save_checkin_student($id_std,$createclassid);
        if($rs){
            $json = '{"success": true}';
        }else{
            $json = '{"success": false}';
        }
        render_json($json);
    }

    //################# End Labor


}
