<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {

	
	 public function __construct()
    {
        parent::__construct();
        $this->page->setTitle('Kriteria');
        $this->load->model('MKriteria');
        $this->load->model('MSubKriteria');
        $this->load->model('MWelcome');
    }

	public function index()
	{		
		$data['kriteria'] = $this->MKriteria->getAll();
		$data['subkriteria'] = $this->MSubKriteria->getAll();

		
		$this->load->view('template/headerView.php');  
		$this->load->view('layouts/index.php',$data);
		$this->load->view('template/footerView.php');
	}

	public function serch()
	{
		$data = $this->input->post();


		$kdKriteria = $data['kdKriteria'];
		$nilai = $data['nilai'];

		$filteredData = [];
		for ($i = 0; $i < count($kdKriteria); $i++) {
			$this->db->select('*');
			$this->db->from('nilai');
			$this->db->where('kdKriteria', $kdKriteria[$i]);
			$this->db->where('nilai', $nilai[$i]);
			$query = $this->db->get();
			$result = $query->result_array();

			if (!empty($result)) {
				$filteredData = array_merge($filteredData, $result);
			}
		}

		$res = ['success' => true, 'data' => $filteredData];


		$kdWisataArray = array_column($filteredData, 'kdWisata');

// Menghapus duplikat
		$kdWisataArray = array_unique($kdWisataArray);

// Mengkonversi menjadi array numerik
		$kdWisataArray = array_values($kdWisataArray);

		$dataAll = [];
		if ($kdWisataArray) {
			$this->db->select('*');
			$this->db->from('wisata');
			$this->db->where_in('kdWisata', $kdWisataArray);
			$queryKdWisata = $this->db->get();
			$dataAll = $queryKdWisata->result_array();
		}
			
		$data = array_column($dataAll, 'wisata');
	
		$dataWisata = '';
		if ($data) {
			$this->db->select('*');
			$this->db->from('saw');
			$this->db->where_in('wisata', $data);
			$queryWisata = $this->db->get();
			$dataWisata = $queryWisata->result();
			// $dataWisata = $queryWisata->result_array();
		}
		
		
		$res = array('success' => true, 'data' => $dataWisata);
		
		header('Content-Type: application/json');
		echo json_encode($res);
       

	
	}

	public function detailWisata($id)
	{		
			$decodedWisata = urldecode($id);
		
	
			$this->db->select('*');
			$this->db->from('wisata');
			$this->db->where('wisata', $decodedWisata);
			$queryWisata = $this->db->get();
			$data['wisata'] = $queryWisata->result();	
			

			
		
		
			$this->load->view('template/headerView.php');  
			$this->load->view('layouts/detail.php',$data);
			$this->load->view('template/footerView.php');
		
	}

}
