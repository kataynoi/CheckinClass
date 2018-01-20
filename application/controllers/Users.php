<?php
// if (!defined('BASEPATH')) exit('No direct script access allowed');


class Users extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->layout->setLayout('login_layout');
        $this->load->model('User_model', 'users');
    }

    //index action
    public function index()
    {
        $this->login();
    }
    public function login(){

        if($this->session->userdata("name"))
        {
            redirect(site_url(), 'refresh');
        }
        else
        {
            $this->layout->view('users/login_view');
        }
    }
    public function do_login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $level = $this->input->post('level');
        //echo "Level".$level;
    if($level==1){
        $users = $this->users->do_auth_teacher($username, $password);

        if($users)
        {
            $data = array(
                "name" => $users->Name_Teacher,
                'id'       => $users->ID_Teacher,
            );
            //$this->set_login_time($users->id);
            $this->session->set_userdata($data);
            redirect(base_url('teacher'));
        }
        else
        {
            $data = array('error' => 1);
            $this->layout->view('users/login_view', $data);
        }
    } else{
        $users = $this->users->do_auth_student($username, $password);
        if($users)
        {
            $data = array(
                "name" => $users->Name_Std,
                'id'       => $users->ID_Std,
            );
            $this->session->set_userdata($data);
            redirect(base_url('student'));
        }
        else
        {
            $data = array('error' => 1);
            $this->layout->view('users/login_view', $data);
        }
    }


    }
    public function save_edit_teacher(){

        $data=$this->input->post('items');
        $rs=$this->users->save_edit_teacher($data);
        if($rs){
            $json = '{"success": true}';
        }else{
            $json = '{"success": false}';
        }

        render_json($json);
    }
   public function save_edit_student(){

        $data=$this->input->post('items');
        $rs=$this->users->save_edit_student($data);
        if($rs){
            $json = '{"success": true}';
        }else{
            $json = '{"success": false}';
        }

        render_json($json);
    }
    public function save_teacher_register(){
        //$id=$this->session->userdata('user_id');
        $data=$this->input->post('items');

        $rs=$this->users->save_teacher_register($data);
        if($rs){
            $json = '{"success": true,"msg":"ระบบจะแจ้งผลการลงทะเบรยนทาง Email ที่ท่านได้ลงทะเบียนไว้"}';
            //$json = '{"success": true,"msg":"ท่านสามารถเข้าสู่ระบบได้ทันที"}';


        }else{
            $json = '{"success": false,"msg":"ไม่สามารถบันทึกข้อมูลได้ อาจมีการส่งซ้ำซ้อน ..."}';
        }

        render_json($json);
    }

    public function save_student_register(){
        //$id=$this->session->userdata('user_id');
        $data=$this->input->post('items');

        $rs=$this->users->save_student_register($data);
        if($rs){
            $json = '{"success": true,"msg":"ระบบจะแจ้งผลการลงทะเบรยนทาง Email ที่ท่านได้ลงทะเบียนไว้"}';
            //$json = '{"success": true,"msg":"ท่านสามารถเข้าสู่ระบบได้ทันที"}';


        }else{
            $json = '{"success": false,"msg":"ไม่สามารถบันทึกข้อมูลได้ อาจมีการส่งซ้ำซ้อน ..."}';
        }

        render_json($json);
    }


    public function teacher_register()
    {   //$data['province']=$this->users->get_province();
        $this->layout->setLayout('login_layout');
        $this->layout->view('users/teacher_register_view');
    }

    public function student_register()
    {   //$data['province']=$this->users->get_province();
        $this->layout->setLayout('login_layout');
        $this->layout->view('users/student_register_view');
    }
    public function logout()
    {
        $this->session->sess_destroy();
        redirect(site_url(),'refresh');
    }

}