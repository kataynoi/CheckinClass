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

}
