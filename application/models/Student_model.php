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
    public function get_course($ID_Std){
        $rs = $this->db
            ->where('ID_Std',$ID_Std)
            ->join('class b','a.ID_Class = b.ID_Class')
            ->join('course c','b.ID_Course = c.ID_Course')
            ->join('teacher d','b.ID_Teacher = d.ID_Teacher')
            ->get('student_in_class a')
            ->result();
        return $rs;
    }
    public function get_class_id($ID_Class){
        $rs = $this->db
            ->where('b.ID_Class',$ID_Class)
            ->join('course c','b.ID_Course = c.ID_Course')
            ->join('teacher d','b.ID_Teacher = d.ID_Teacher')
            ->get('class b')
            ->row();
        return $rs;
    }
    public  function get_checkin_by_class ($ID_Class,$ID_Std){
        $rs = $this->db
            ->where('ID_Class',$ID_Class)
            ->order_by('Date_create','DESC')
            ->get('create_class a')
            ->result();
        return $rs;
    }
    public function get_status_checkin($ID_create_class,$ID_Std){
        $rs = $this->db
            ->where('ID_create_class',$ID_create_class)
            ->where('ID_Std',$ID_Std)
            ->count_all_results('check_in_student');
        return $rs > 0 ? TRUE : FALSE;
    }
}