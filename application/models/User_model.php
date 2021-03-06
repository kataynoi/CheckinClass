<?php
class User_model extends CI_Model
{
    public function do_auth_teacher($username, $password)
    {
        $rs = $this->db
            ->where('ID_Teacher', $username)
            ->where('Password', $password)
            ->get('Teacher')
            ->row();
        //echo $this->db->last_query();
        return $rs;
    }
    public function do_auth_Student($username, $password)
    {
        $rs = $this->db
            ->where('ID_Std', $username)
            ->where('Password', $password)
            ->get('Student')
            ->row();
        //echo $this->db->last_query();
        return $rs;
    }
    public function save_edit_teacher($data)
    {
        $rs = $this->db
            ->set('Password',$data['Password'])
            ->set('Name_Teacher', $data['Name_Teacher'])
            ->set('Email', $data['Email'])
            ->set('Tel', $data['Tel'])
            ->set('Subject', $data['Subject'])
            ->set('Faculty', $data['Faculty'])
            ->set('Sex', 'Sex')
            ->where('ID_Teacher',$data['ID_Teacher'])
            ->update('Teacher');

        return $rs;
    }

    public function save_edit_student($data)
    {
        $rs = $this->db
            ->set('Password',$data['Password'])
            ->set('Name_Std', $data['Name_Std'])
            ->set('Email', $data['Email'])
            ->set('Tel', $data['Tel'])
            ->set('Branch', $data['Branch'])
            ->set('Faculty', $data['Faculty'])
            ->set('Sex', 'Sex')
            ->where('ID_Std',$data['ID_Std'])
            ->update('Student');

        return $rs;
    }
    public function save_teacher_register($data)
    {
        $rs = $this->db

            ->set('ID_Teacher',$data['ID_Teacher'])
            ->set('Password',$data['Password'])
            ->set('Name_Teacher', $data['Name_Teacher'])
            ->set('Email', $data['Email'])
            ->set('Tel', $data['Tel'])
            ->set('Subject', $data['Subject'])
            ->set('Faculty', $data['Faculty'])
            ->set('Sex', 'Sex')
            ->insert('Teacher');

        return $rs;
    }

    public function save_student_register($data)
    {
        $rs = $this->db

            ->set('ID_Std',$data['ID_Std'])
            ->set('Password',$data['Password'])
            ->set('Name_Std', $data['Name_Std'])
            ->set('Email', $data['Email'])
            ->set('Tel', $data['Tel'])
            ->set('Branch', $data['Branch'])
            ->set('Faculty', $data['Faculty'])
            ->set('Sex', 'Sex')
            ->insert('Student');

        return $rs;
    }

    //################################################################################
    public function get_user($id){
        $rs = $this->db
            ->where('id',$id)
            ->get('mas_users')
            ->row();
        return $rs;
    }
    public function get_users(){
        $sys_id=$this->session->userdata('sys_id');
        $rs = $this->db
            ->select('b.name,b.id')
            ->where(array('system' => $sys_id,
                'a.active' =>'1'))
            ->order_by('id')
            ->join('mas_users b','a.user_id=b.id')
            ->get('mas_system_use a')
            ->result();
        return $rs;
        //echo $this->db->last_query();
    }

    public function get_username($id)
    {
        $rs = $this->db
            ->select('name')
            ->where('id',$id)
            ->get('mas_users')
            ->row();
        return count($rs) > 0 ? $rs->name : '-';
    }
    public function get_position(){
        $rs = $this->db
            ->get('co_position')
            ->result();
        return $rs;
    }



//######## Start All Users
    public function get_all_users($sys_id,$start,$limit){
        $rs = $this->db
            ->where(array('system' => $sys_id,
                'active' =>'1'))
            ->order_by('login_time','DESC')
            ->limit($limit, $start)
            ->get('mas_system_use')
            ->result();
        return $rs;
    }
    public function get_all_users_by_amp($sys_id,$amp,$start,$limit){
        $rs = $this->db
            ->where(array('a.system' => $sys_id,
                'a.active' =>'1',
                'c.amphur'=>$amp
            ))
            ->order_by('c.off_id')
            ->limit($limit, $start)
            ->join('mas_users b ','a.user_id=b.id')
            ->join('co_office c ','c.off_id=b.office')
            ->get('mas_system_use a')
            ->result();
        return $rs;
    }
    public function get_all_users_by_hospcode($sys_id,$hospcode,$start,$limit){
        $rs = $this->db
            ->where(array('a.system' => $sys_id,
                'a.active' =>'1',
                'b.office'=>$hospcode
            ))
            ->order_by('b.id')
            ->limit($limit, $start)
            ->join('mas_users b ','a.user_id=b.id')
            ->get('mas_system_use a')
            ->result();
        return $rs;
    }

    public function get_all_users_total()
    {
        $sys_id=$this->session->userdata('sys_id');
        $rs = $this->db
            ->where(array(
                'active' => '1',
                'system' => $sys_id
            ))
            ->count_all_results('mas_system_use');

        return $rs ? $rs : 0;
    }
    public function get_all_users_total_by_amp($amp)
    {
        $sys_id=$this->session->userdata('sys_id');
        $rs = $this->db
            ->where(array(
                'a.active' => '1',
                'a.system' => $sys_id,
                'c.amphur'=>$amp
            ))
            ->join('mas_users b ','a.user_id=b.id')
            ->join('co_office c ','c.off_id=b.office')
            ->count_all_results('mas_system_use a');

        return $rs ? $rs : 0;
    }
    public function get_all_users_total_by_hospcode($hospcode)
    {
        $sys_id=$this->session->userdata('sys_id');
        $rs = $this->db
            ->where(array(
                'a.active' => '1',
                'a.system' => $sys_id,
                'b.office'=>$hospcode
            ))
            ->join('mas_users b ','a.user_id=b.id')
            ->count_all_results('mas_system_use a');

        return $rs ? $rs : 0;
    }

//###### End All Users


//######## Inbox Message
    public function get_message($sys_id,$start,$limit){
        $user_id=$this->session->userdata('user_id');
        $rs = $this->db
           ->where(array('sys_id' => $sys_id,
                'active' =>'1',
                'reciver'=>$user_id,
            ))
            ->order_by('datesend','DESC')
            ->limit($limit, $start)
            ->get('tb_message')
            ->result();
        return $rs;
    }
    public function get_message_out($sys_id,$start,$limit){
        $user_id=$this->session->userdata('user_id');
        $rs = $this->db
           ->where(array('sys_id' => $sys_id,
                'active' =>'1',
                'sender'=>$user_id,
            ))
            ->order_by('datesend','DESC')
            ->limit($limit, $start)
            ->get('tb_message')
            ->result();
        return $rs;
    }

    public function get_message_total()
    {
        $sys_id=$this->session->userdata('sys_id');
        $user_id=$this->session->userdata('user_id');
        $rs = $this->db
            ->where(array(
                'active' => '1',
                'sys_id' => $sys_id,
                'reciver' =>$user_id,
            ))
            ->count_all_results('tb_message');

        return $rs ? $rs : 0;
    }
    public function get_message_out_total()
    {
        $sys_id=$this->session->userdata('sys_id');
        $user_id=$this->session->userdata('user_id');
        $rs = $this->db
            ->where(array(
                'active' => '1',
                'sys_id' => $sys_id,
                'sender' =>$user_id,
            ))
            ->count_all_results('tb_message');

        return $rs ? $rs : 0;
    }
    public  function set_read_message($id){

        $rs=$this->db
            ->set('read','1')
            ->set('daterecive',date('Y-m-d H:i:s'))
            ->where(array('id' =>$id,
                'read'=>'0'
            ))
            ->update('tb_message');
        return $rs;
    }
    public  function del_message($id){
        $rs=$this->db
            ->set('active','0')
            ->where(array('id' =>$id ))
            ->update('tb_message');
        return $rs;
    }

//###### End Message
    public function get_hserv($id){
        $rs = $this->db
            ->select('hserv')
            ->where('hospcode',$id)
            ->get('ref_hserv')
            ->row();
        return $rs;
    }
 public function get_off_name($user_id){
        $rs = $this->db
            ->select('a.off_name')
            ->where('b.id',$user_id)
            ->join('mas_users as b','b.office=a.off_id')
            ->get('co_office as a')
            ->row();

        return $rs->off_name;
    }

    public function get_amp_code($id){
        $rs = $this->db
            ->select('amphur')
            ->where('off_id',$id)
            ->get('co_office')
            ->row();
        return $rs;
    }
 public function get_cup_code($id){
        $rs = $this->db
            ->select('cup_code')
            ->where('off_id',$id)
            ->get('co_office')
            ->row();
        return $rs;
    }public function get_prov_code($id){
        $rs = $this->db
            ->select('changwat')
            ->where('off_id',$id)
            ->get('co_office')
            ->row();
        return $rs;
    }
    public function get_new_msg_total($id){
        $rs = $this->db
            ->where(array(
                'reciver' => $id,
                'read' => '0',
                'active' => '1'
            ))
            ->count_all_results('tb_message');
         return $rs > 0 ? $rs : 0;
    }
    public function save_pass($id,$password){
        $rs=$this->db
            ->set('password','PASSWORD("'.$password.'")',false)
            ->where('id',$id)
            ->update('mas_users');
        return $rs;
    }
    public  function get_office (){
        $rs=$this->db
            ->where('changwat','44')
            ->get('co_office')
            ->result();
        return $rs;
    }


    function getLastInserted() {
        return $this->db->insert_id();
    }
    function save_system_user($id,$sys_id){
        $rs=$this->db
            ->set('user_id',$id)
            ->set('system',$sys_id)
            ->set('active','3')
            ->set('user_level','3')
            ->insert('mas_system_use');
        return $rs;
    }
    function save_message($data)
    {
        $rs = $this->db
            ->set('sender',$data['sender'])
            ->set('reciver', $data['reciver'])
            ->set('message', $data['message'])
            ->set('title', $data['title'])
            ->set('sys_id', $data['sys_id'])
            ->set('datesend', date('Y-m-d H:i:s'))
            ->insert('tb_message');

        return $rs;
    }
public function get_duplicate_user($id,$username){
    $rs = $this->db
        ->where('id !=',$id)
        ->where('username',$username)
        ->count_all_results('mas_users');

    return $rs > 0 ? $rs : 0;
}
    public function get_duplicate_email($id,$email){
    $rs = $this->db
        ->where('id !=',$id)
        ->where('email',$email)
        ->count_all_results('mas_users');

    return $rs > 0 ? $rs : 0;
}
    public function get_waiting_users_total($sys_id){
    $rs = $this->db
        ->where('system',$sys_id)
        ->where('active','3')
        ->count_all_results('mas_system_use');

    return $rs > 0 ? $rs : 0;
}
    public function get_waiting_users($sys_id){
    $rs = $this->db
    ->select('b.*')
        ->where('a.system',$sys_id)
        ->where('a.active','3')
        ->join('mas_users b','a.user_id=b.id')
        ->get('mas_system_use a')
        ->result();

    return $rs;
}
    public function set_approve_user($sys_id,$id){
        $rs=$this->db
            ->set('active','1')
            ->where('system',$sys_id)
            ->where('user_id',$id)
            ->update('mas_system_use');
        return $rs;
    }
    public function del_user_system($sys_id,$id){
        $rs=$this->db
            ->where('system',$sys_id)
            ->where('user_id',$id)
            ->delete('mas_system_use');
        return $rs;
    }
    public  function  set_str_forget_pass($email,$str){
        $rs=$this->db
            ->set('code_re_pass',$str)
            ->set('date_repass',"DATE_FORMAT(NOW(),'%Y-%m-%d %H:%i')",false)
            ->where('email',$email)
            ->update('mas_users');
        $afftectedRows=$this->db->affected_rows();
        return $afftectedRows;
    }
    public  function check_code_for_repass($code){
        $rs=$this->db
            ->select('id,date_repass,username')
            ->where('code_re_pass',$code)

            ->get('mas_users')
            ->row();
        return $rs;
    }
    public function get_sys_name($sys_id){
        $rs=$this->db
            ->select('name')
            ->where('id',$sys_id)
            ->get('co_system')
            ->row();
        return $rs?$rs->name:'';
    }
    public function get_user_id ($username,$password){
        $rs=$this->db
            ->where('username',$username)
            ->where('password','PASSWORD("'.$password.'")',false)
            ->get('mas_users')
            ->row();
        return $rs?$rs->id:'';
    }
    public  function set_login_time ($sys_id,$user_id){
        $rs=$this->db
            ->set('login_time','(login_time+1)',false)
            ->where('user_id',$user_id)
            ->where('system',$sys_id)
            ->update('mas_system_use');
        return $rs;
    }
    public function get_amp($prov_code){
        $rs = $this->db
            ->where('provid', $prov_code)
            ->get('co_district')
            ->result();
        return $rs;
    }
}