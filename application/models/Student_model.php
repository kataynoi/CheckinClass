<?php
class Student_model extends CI_Model
{

    public function get_student($id){
        $rs = $this->db
            ->where('ID_Std',$id)
            ->get('student')
            ->row();
        return $rs;
    }

    public function del_student($id){
        $rs = $this->db
            ->where('ID_Std',$id)
            ->delete('student');
        return $rs;
    }

}