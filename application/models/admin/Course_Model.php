<?php
    
    class Course_Model extends CI_Model
    {
        public function __construct()
        {
            $this->load->database();
        }
        public function getCourses()
        {
            $this->db->select('*');
            $result = $this->db->get('`coursedetails`');
            return $result->result_array();
        }
        public function getCourse($id)
        {
            $this->db->select('*');
            $this->db->where('`ID`', $id);
            $query = $this->db->get('`coursedetails`');

            return $query->result_array();
        }

        public function addCourse($data)
        {
            $this->db->insert('course', $data);
            return  $this->db->affected_rows() > 0;
        }

        public function editCourse($data,$ID)
        {
            $this->db->where('ID', $ID);
            $this->db->update('course', $data);
            return  $this->db->affected_rows() > 0;
        }

        public function deleteCourse($id)
        {
            $this->db->where('id', $id);
            $this->db->delete('course');
            return  $this->db->affected_rows() > 0;
        }
        public function checkDuplicate($data)
        {
            $this->db->where($data);
            $this->db->from('course');
            $count = $this->db->count_all_results();
            return ($count == 0) ? false:true;
        }
    }

?>