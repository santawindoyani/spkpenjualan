<?php

/**
 * Created by PhpStorm.
 * User: sankester
 * Date: 11/05/2017
 * Time: 15:42
 */

if (!defined('BASEPATH')) exit('No direct script access allowed');

#[\AllowDynamicProperties]
class brand extends MY_Controller
{
    public $username = "root";
    public $password = "";
    public $port = 3306;
    public $database;
    public $server;

     public function __construct()
    {
        
        parent::__construct();
        $this->page->setTitle('brand');
        $this->load->model('MKriteria');
        $this->load->model('MSubKriteria');
        $this->load->model('MBrand');
        $this->load->model('MNilai');      
        $this->page->setLoadJs('assets/js/brand');
    }

    
    public function index()
    {
        $is_logged_in = $this->session->userdata('isLogin');
        if ($is_logged_in) {
            $data['brand'] = $this->MBrand->getAll();
            $data['isLogin'] = $is_logged_in;

            $this->load->view('template/headerView.php', $data);
            $this->load->view('brand/index.php', $data);
            $this->load->view('template/footerView.php', $data);
        } else {
            redirect(base_url('login'));
        }
    }


    public function tambah($id = null)
    {
        if ($id == null) {
            if (count($_POST)) {
                $this->form_validation->set_rules("brand", '', 'trim|required');
                if ($this->form_validation->run() == false) {
                    $errors = $this->form_validation->error_array();
                    $this->session->set_flashdata('errors', $errors);
                    redirect(current_url());
                } else {
                    $size = $this->input->post("size");
                    $brand = $this->input->post("brand");
                    $produk = $this->input->post('produk');
                    $model = $this->input->post('model');
                    $harga = $this->input->post('harga');
                    $nilai = $this->input->post('nilai');


                    $this->MBrand->size = $size;
                    $this->MBrand->brand = $brand;
                    $this->MBrand->produk = $produk;
                    $this->MBrand->model = $model;
                    $this->MBrand->harga = $harga;
                    if ($this->MBrand->insert() == true) {
                        $success = false;
                        $kdbrand = $this->MBrand->getLastID()->kdbrand;
                        foreach ($nilai as $item => $value) {
                            $this->MNilai->kdbrand = $kdbrand;
                            $this->MNilai->kdKriteria = $item;
                            $this->MNilai->nilai = $value;
                            if ($this->MNilai->insert()) {
                            $success = true;
                            }
                        }
                        if ($success == true) {
                            $this->session->set_flashdata('message', 'Berhasil menambah data :)');
                            redirect('brand');
                        } else {
                            echo 'gagal';
                        }
                    }
                }
                //-----
            }else{
                $data['dataView'] = $this->getDataInsert();
                $this->load->view('template/headerView.php');  
                $this->load->view('brand/tambah.php', $data);
                $this->load->view('template/footerView.php');

            }
        }else{
            if(count($_POST)){
                $kdbrand = $this->uri->segment(3, 0);
                dump($kdbrand);
                if($kdbrand > 0){
                    $brand = $this->input->post('brand');
                    $nilai = $this->input->post('nilai');
                    $where = array("kdbrand" => $kdbrand);
                    $this->Mbrand->brand = $brand;
                    dump($brand);
                    if($this->Mbrand->update($where) == true){
                        $success = false;
                        foreach ($nilai as $item => $value) {
                            $this->MNilai->kdbrand = $kdbrand;
                            $this->MNilai->kdlriteria = $item;
                            $this->MNilai->nilai = $value;
                            if ($this->MBrand->update()) {
                                $success = true;
                            }
                        }
                        if ($success == true) {
                            $this->session->set_flashdata('message', 'Berhasil mengubah data :)');
                            redirect('brand');
                        } else {
                            echo 'gagal';
                        }
                    }
                }
            }
            $data['dataView'] = $this->getDataInsert();
            $data['nilaibrand'] = $this->MNilai->getNilaiByBrand($id);

            $this->load->view('template/headerView.php');  
            $this->load->view('brand/tambah', $data);
            $this->load->view('template/footerView.php');

        }

    }

    private function getDataInsert()
    {
        $dataView = array();
        $kriteria = $this->MKriteria->getAll();
        foreach ($kriteria as $item) {
            $this->MSubKriteria->kdKriteria = $item->kdKriteria;
            $dataView[$item->kdKriteria] = array(
                'nama' => $item->kriteria,
                'data' => $this->MSubKriteria->getById()
            );
        }

        return $dataView;
    }

    public function delete($id)
    {
        if($this->MNilai->delete($id) == true){
            if($this->MBrand->delete($id) == true){
                $this->session->set_flashdata('message','Berhasil menghapus data :)');
                echo json_encode(array("status" => 'true'));
            }
        }
        else{
            $this->session->set_flashdata('message','gala');
        }
    }
}
