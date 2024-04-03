<?php

/**
 * Created by PhpStorm.
 * User: sankester
 * Date: 11/05/2017
 * Time: 15:53
 */
class MNilai extends CI_Model{

    public $kdBrand;
    public $kdKriteria;
    public $nilai;

    public function __construct(){
        parent::__construct();
    }

    private function getTable()
    {
        return 'nilai';
    }

    private function getData()
    {
        $data = array(
            'kdbrand' => $this->kdbrand,
            'kdKriteria' => $this->kdKriteria,
            'nilai' => $this->nilai
        );

        return $data;
    }

    public function insert()
    {
        $status = $this->db->insert($this->getTable(), $this->getData());
        return $status;
    }

    public function getNilaiBybrand($id)
    {
        $query = $this->db->query(
            'select u.kdbrand, u.brand, k.kdKriteria, n.nilai from brand u, nilai n, kriteria k, subkriteria sk where u.kdbrand = n.kdbrand AND k.kdKriteria = n.kdKriteria and k.kdKriteria = sk.kdKriteria and u.kdbrand = '.$id.' GROUP by n.nilai '
        );
        if($query->num_rows() > 0){
            foreach ($query->result() as $row) {
                $nilai[] = $row;
            }

            return $nilai;
        }
    }

    public function getNilaibrand()
    {
        $query = $this->db->query(
            'select u.kdbrand, u.brand, k.kdKriteria, k.kriteria ,n.nilai from brand u, nilai n, kriteria k where u.kdbrand = n.kdbrand AND k.kdKriteria = n.kdKriteria '
        );
        if($query->num_rows() > 0){
            foreach ($query->result() as $row) {
                $nilai[] = $row;
            }
        
            return $nilai;
        }
    }

    public function update()
    {
        $data = array('nilai' => $this->nilai);
        $this->db->where('kdbrand', $this->kdbrand);
        $this->db->where('kdKriteria', $this->kdKriteria);
        $this->db->update($this->getTable(), $data);
        return $this->db->affected_rows();
    }

    public function delete($id)
    {
        $this->db->where('kdbrand', $id);
        return $this->db->delete($this->getTable());
    }
}