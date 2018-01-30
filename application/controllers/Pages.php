<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->layout->setLayout('login_layout');
        if (!$this->session->userdata("name"))
            redirect(site_url('users/login'));

    }

    public function index()
    {

        $data="";
        $this->layout->view('users/login_view', $data);
    }
    public  function  get_success_by_amp (){
        $note=$this->input->post('note');
        $rs = $this->reports->get_success_by_amp ($note);
        $rows = json_encode($rs);

        $json = '{"success": true, "rows": '.$rows.'}';
        render_json($json);
    }

}

/* End of file pages.php */
/* Location: ./application/controllers/pages.php */
