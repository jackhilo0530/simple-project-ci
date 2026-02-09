<?php
    class Students extends CI_Model {

        public function __construct()
        {
            $this->load->database();
        }

        public function get_students($slug = FALSE)
        {
            if ($slug === FALSE)
            {
                $query = $this->db->get('student');
                return $query->result_array();
            }
            
            $query = $this->db->get_where('student', array('id' => $slug));
            return $query->result_array();
        }
    }
?>