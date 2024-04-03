<?php

/**
 * Created by PhpStorm.
 * User: sankester
 * Date: 11/05/2017
 * Time: 15:53
 */
class MWelcome extends CI_Model{


    public function __construct(){
        parent::__construct();
    }

   
public function getAll()
    {
       
        $this->db->select('subkriteria.kdKriteria, kriteria.kdKriteria');
        $this->db->from('subkriteria');
        $this->db->join('kriteria', 'subkriteria.kdKriteria = kriteria.kdKriteria', 'inner');
        $query = $this->db->get();
        

        if($query->num_rows() > 0){
            foreach ( $query->result() as $row) {
                $subkriterias[] = $row;
            }
            return $subkriterias;
        }
    }


    
}