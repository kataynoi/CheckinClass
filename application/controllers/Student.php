<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: spiderman
 * Date: 13/11/2556
 * Time: 11:20 น.
 * To change this template use File | Settings | File Templates.
 */


class Student extends CI_Controller {
    public $id_student;

    public function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata("name")){
            redirect(site_url('users/login'));
        }
        //load model
        $this->layout->setLayout('student_layout');
        $this->load->model('student_model', 'student');
        $this->load->model('Basic_model', 'basic');
        $this->db = $this->load->database('default', true);
        $this->id_student = $this->session->userdata('id');


    }

    public function index()
    {
        //$data['audit']=$this->audit->get_hospaudit($this->amp_code);
        $this->layout->view('student/index_view');
    }
    public function mg_student()
    {
        $data['student']=$this->student->get_student($this->id_student);
        $this->layout->view('student/mg_student_view',$data);
    }
    public function report_student_checkin()
    {
        $ID_Std = $this->session->userdata('id');
        $rs=$this->student->get_course($ID_Std);
        $data['course']=array();
        if($rs) {
            $arr_result = array();
            foreach ($rs as $r) {
                $obj = new stdClass();
                $obj->ID_Std = $r->ID_Std;
                $obj->ID_Class = $r->ID_Class;
                $obj->ID_Course = $r->ID_Course;
                $obj->Name_Class = $r->Name_Class;
                $obj->Course = $r->Course;
                $obj->Term = $r->Term;
                $obj->Year = $r->Year;
                $obj->Name_Teacher = $r->Name_Teacher;
                //$obj->count_student = $this->teacher->count_student_inclass($r->ID_Class);
                //$obj->Num_create_class  = $this->teacher->get_num_create_class($r->ID_Class);
                $arr_result[] = $obj;
            }

            //$rows = json_encode($arr_result);
            $data['course'] = $arr_result;
        }
        $this->layout->view('student/report_student_checkin_view',$data);
    }

    public function report_checkin_by_course($ID_class)
    {   $data['ID_Class']=$ID_class;
        $ID_Std = $this->session->userdata('id');
        $data['class']=$this->student->get_class_id($ID_class);
        $rs=$this->student->get_checkin_by_class($ID_class,$ID_Std);
        $data['checkin'] = array();
        if($rs) {
            $arr_result = array();
            foreach ($rs as $r) {
                $obj = new stdClass();
                $obj->Date_create = to_thai_date_time($r->Date_create);
                $obj->ID_Class = $r->ID_Class;
                $obj->Status_checkin = $this->student->get_status_checkin($r->ID_create_class,$ID_Std);
                $arr_result[] = $obj;
            }
            $data['checkin'] = $arr_result;
        }

        $this->layout->view('student/report_checkin_by_course_view',$data);
    }
}
