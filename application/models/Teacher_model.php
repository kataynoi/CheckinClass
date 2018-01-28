<?php
class Teacher_model extends CI_Model
{

    public function get_teacher($id){
        $rs = $this->db
            ->where('ID_Teacher',$id)
            ->get('Teacher')
            ->row();
        return $rs;
    }

    public function get_student(){
        $rs = $this->db
            ->get('Student')
            ->result();
        return $rs;
    }
    public function del_student($id){
        $rs = $this->db
            ->where('ID_Std',$id)
            ->delete('student');
        return $rs;
    }
    public function get_student_id($id){
        $rs = $this->db
            ->where('ID_Std',$id)
            ->get('student')
            ->result();
        return $rs;
    }
    public function search_student_id($id,$ID_Class){
        $rs = $this->db
            ->where('ID_Std NOT IN (SELECT ID_Std FROM student_in_class WHERE ID_Class= '.$ID_Class.') ' )
            ->like('ID_Std',$id)
            ->get('student')
            ->result();
        return $rs;
    }
    public function get_course(){
        $rs = $this->db
            ->get('Course')
            ->result();
        return $rs;
    }
    public function get_course_id($id){
        $rs = $this->db
            ->where('ID_Course',$id)
            ->get('Course')
            ->row();
        return $rs;
    }
    public function get_all_class($id){
        $rs = $this->db
            ->select('a.*,b.Name_Teacher, c.Course')
            ->join('teacher b','a.ID_Teacher = b.ID_Teacher')
            ->join('course c','c.ID_Course = a.ID_Course')
            ->where('a.ID_Teacher',$id)
            ->get('class a')
            ->result();
        return $rs;
    }
    public function get_class_id($id){
        $rs = $this->db
            ->where('ID_class',$id)
            ->get('class')
            ->row();
        return $rs;
    }
    public function count_student_inclass($id){
        $rs = $this->db
            ->select('Count(*) as total',false)
            ->where('ID_class',$id)
            ->get('student_in_class')
            ->row();
        return $rs->total;
    }
    public function del_course($id){
        $rs = $this->db
            ->where('ID_Course',$id)
            ->delete('course');
        return $rs;
    }
    public function del_class($id){
        $rs = $this->db
            ->where('ID_Class',$id)
            ->delete('class');
        return $rs;
    }

    public function save_course($data)
    {
        $rs = $this->db
            ->set('Course', $data['Course'])
            ->set('Credit', $data['Credit'])
            ->set('ID_Course',$data['ID_Course'])
            ->insert('course');
        return $rs;
    }
    public function save_class($data)
    {
        $rs = $this->db
            ->set('Name_Class', $data['Name_Class'])
            ->set('ID_Course', $data['ID_Course'])
            ->set('ID_Teacher', $data['ID_Teacher'])
            ->set('Term',$data['Term'])
            ->set('Year',$data['Year'])
            ->insert('class');
        return $rs;
    }
    public function save_student_inclass($id,$Classid)
    {
        $rs = $this->db
            ->set('ID_Std', $id)
            ->set('ID_Class', $Classid)
            ->insert('student_in_class');
        return $rs;
    }
    public function del_student_inclass($id,$Classid)
    {
        $rs = $this->db
            ->where('ID_Std', $id)
            ->where('ID_Class', $Classid)
            ->delete('student_in_class');
        return $rs;
    }

    public function save_edit_class($data)
    {
        $rs = $this->db
            ->set('Name_Class', $data['Name_Class'])
            ->set('ID_Course', $data['ID_Course'])
            ->set('ID_Teacher', $data['ID_Teacher'])
            ->set('Term',$data['Term'])
            ->set('Year',$data['Year'])
            ->where('ID_Class',$data['ID_Class'])
            ->update('class');
        return $rs;
    }
    public function save_edit_course($data)
    {
        $rs = $this->db
            ->set('Course', $data['Course'])
            ->set('Credit', $data['Credit'])
            ->where('ID_Course',$data['ID_Course'])
            ->update('course');
        return $rs;
    }
    public function get_student_inclass($id){
        $rs = $this->db
            ->select('a.*')
            ->where('b.ID_Class',$id)
            ->join('student_in_class b' ,'a.ID_Std=b.ID_Std')
            // ->join('checkin_student c',)
            ->order_by('ID_Std')
            ->get('Student a')
            ->result();
        return $rs;
    }
    public function get_checkin($ID_create_class,$ID_Std){
        $rs = $this->db
            ->where('ID_create_class',$ID_create_class)
            ->where('ID_Std',$ID_Std)
            ->count_all_results('check_in_student');
        return $rs > 0 ? TRUE : FALSE;
    }

    public function get_preriod_checkin_by_class ($id){
        $rs=$this->db
            ->where('ID_Class',$id)
            ->order_by('Date_create','ASC')
            ->get('create_class')
            ->result();
        return $rs;
    }
    public function get_period_id ($id){
        $rs=$this->db
            ->where('ID_create_class',$id)
            ->get('create_class')
            ->row();
        return $rs;
    }

    public function create_period_class ($id){
        $rs=$this->db
            ->set('ID_Class',$id)
            ->set('Date_create',"STR_TO_DATE(now(),'%Y-%m-%d %H:%i:%s')",false)
            ->insert('create_class');
        return $rs;
    }
    public function save_checkin_student ($id_std,$createclassid){
        $rs=$this->db
            ->set('ID_create_class',$createclassid)
            ->set('ID_Std',$id_std)
            ->set('DateTime_checkin',"STR_TO_DATE(now(),'%Y-%m-%d %H:%i:%s')",false)
            ->insert('check_in_student');
        return $rs;
    }
    public function get_total_student_checkin($ID_create_class){
        $rs = $this->db
            ->where('ID_create_class',$ID_create_class)
            ->count_all_results('check_in_student');
        return $rs;
    }
    public function get_numall_student_inclass($Class_id){
        $rs = $this->db
            ->where('ID_Class',$Class_id)
            ->count_all_results('student_in_class');
        return $rs;
    } public function get_num_create_class($Class_id){
        $rs = $this->db
            ->where('ID_Class',$Class_id)
            ->count_all_results('create_class');
        return $rs;
    }
}