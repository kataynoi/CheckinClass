<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: spiderman
 * Date: 13/11/2556
 * Time: 11:20 น.
 * To change this template use File | Settings | File Templates.
 */


class Report extends CI_Controller {
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
        $this->load->model('student_model', 'student');
        $this->load->model('Basic_model', 'basic');
        $this->db = $this->load->database('default', true);
        $this->id_teacher = $this->session->userdata('id');


    }

    public function index()
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
        $this->layout->view('report/index_view',$data);
    }

    public function report_by_class($id)
    {   $data['ID_Class']=$id
    ;
        $data['numall_student']=$this->teacher->get_numall_student_inclass($id);
        //$data['class']=$this->teacher->get_class_id($id);
        $data['class']=$this->student->get_class_id($id);
        $data['course']=$this->teacher->get_course();
        $rs=$this->teacher->get_student_inclass($id);
        $data['student'] =array();
        if($rs) {
            $arr_result = array();
            foreach ($rs as $r) {
                $obj = new stdClass();
                $obj->ID_Std = $r->ID_Std;
                $obj->Name_Std = $r->Name_Std;
                $obj->Branch = $r->Branch;
                $obj->Faculty = $r->Faculty;
                $obj->Status1 = $this->teacher->count_checkin($id,'1',$r->ID_Std);
                $obj->Status2 = $this->teacher->count_checkin($id,'2',$r->ID_Std);
                $obj->Status3 = $this->teacher->count_checkin($id,'3',$r->ID_Std);
                $obj->Status4 = $this->teacher->count_checkin($id,'4',$r->ID_Std);
                // $obj->Create_class_id = $Create_class_id;
                $arr_result[] = $obj;
            }

            //$rows = json_encode($arr_result);
            $data['student'] = $arr_result;
        }

        $this->layout->view('report/report_by_class_view',$data);
    }

}
