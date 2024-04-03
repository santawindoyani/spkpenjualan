<?php
/**
 * Created by PhpStorm.
 * User: sankester
 * Date: 11/05/2017
 * Time: 15:51
 */
#[\AllowDynamicProperties]
class MBrand extends CI_Model{

    public $kdbrand;
    public $size;
    public $brand;
    public $model;
    public $produk;
    public $harga;
   

    public function __construct(){
        parent::__construct();
    }

    private function getTable(){
        return "brand";
    }

    private function getData(){
    
        $data = array(
            "size" => $this->size,
            "brand" => $this->brand,
            "model" => $this->model,
            "produk" => $this->produk,
            "harga" => $this->harga
        );

        return $data;
    }

    public function getAll()
    {
        $brand = array();
        $query = $this->db->get($this->getTable());
        if($query->num_rows() > 0){
            foreach ($query->result() as $row) {
                $brand[] = $row;
            }
        }
        return $brand;
    }


    public function insert()
    {
        $this->db->insert($this->getTable(), $this->getData());
        return $this->db->insert_id();
    }

    public function update($where)
    {
        $status = $this->db->update($this->getTable(), $this->getData(), $where);
        return $status;

    }

    public function delete($id)
    {
        $this->db->where('kdbrand', $id);
        return $this->db->delete($this->getTable());
    }

    public function getLastID(){
        $this->db->select("kdbrand");
        $this->db->order_by("kdbrand", "DESC");
        $this->db->limit(1);
        $query = $this->db->get($this->getTable());
        return $query->row();
    }


}