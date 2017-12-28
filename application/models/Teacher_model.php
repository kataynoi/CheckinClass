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
    public function get_course(){
        $rs = $this->db
            ->get('Course')
            ->result();
        return $rs;
    }
    public function del_course($id){
        $rs = $this->db
            ->where('ID_Course',$id)
            ->delete('course');
        return $rs;
    }

}