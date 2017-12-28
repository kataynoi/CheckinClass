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
    public function add_course()
    {
        //$data['course']=$this->teacher->get_course();
        $this->layout->view('teacher/add_course_view');
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

    //################# End Labor


}
