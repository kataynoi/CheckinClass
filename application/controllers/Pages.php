<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata("name"))
            redirect(site_url('users/login'));
        $this->load->model('Base_data_model', 'base_data');
        $this->load->model('Reports_model', 'reports');
    }

    public function index()
    {

        $data="";
        $this->layout->view('pages/index_view', $data);
        //$this->load->view('download/index_view');
        /*
        $data['offline_msq'] = 'ปิดปรับปรุงระบบ ถึง 22 พ.ค. 60 11.00 น.';
        $this->load->view('pages/offline_view',$data);*/
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