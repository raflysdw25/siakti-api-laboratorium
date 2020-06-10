<?php

defined('BASEPATH') OR exit('No direct script access allowed');


require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Barang extends REST_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_barang', 'mb');
	}


	public function index_get()
	{
		$kode_brg = $this->get('kode_brg');

		if($kode_brg){
			$data = $this->mb->getBarang($kode_brg);
			$responseDesc = "Success get a barang";
			$responseData = $data;	
		}else{
			$data = $this->mb->getBarang();
			$responseDesc = "Success get all barang";
			$responseData = $data;
		}


		$responseCode = "200";

		$response = resultJson( $responseCode, $responseDesc, $responseData);

		$this->response($response, 200);
	}


	public function index_post()
	{
		$insertData = array(
			'kode_brg' => $this->post('kode_brg'),
			'nama_brg' => $this->post('nama_brg'),
			'jenis' => $this->post('jenis'),
			'spesifikasi' => $this->post('spesifikasi'),
			'jml' => $this->post('jml'),
			'satuan' => $this->post('satuan'),
			'thn_pengadaan' => $this->post('thn_pengadaan'),
			'asal_pengadaan' => $this->post('asal_pengadaan'),
			'supplier_nama_supp' => $this->post('supplier_nama_supp')
		);

		$query = $this->mb->insertBarang($insertData);

		if ($query) {
			$responseCode = "00";
			$responseDesc = "Success to create barang";
			$responseData = $insertData;
			$response = resultJson( $responseCode, $responseDesc, $responseData);
		}
		else{	
			$responseCode = "01";
			$responseDesc = "Failed to create barang";
			$responseData = $insertData;
			$response = resultJson( $responseCode, $responseDesc, $responseData);
		}	
		

		$this->response($response, 200);
	}

	public function index_put()
	{
		$kode_brg = $this->put('kode_brg');	
		
		$updateData = array(
			'nama_brg' => $this->put('nama_brg'),
			'jenis' => $this->put('jenis'),
			'spesifikasi' => $this->put('spesifikasi'),
			'jml' => $this->put('jml'),
			'satuan' => $this->put('satuan'),
			'thn_pengadaan' => $this->put('thn_pengadaan'),
			'asal_pengadaan' => $this->put('asal_pengadaan'),
			'supplier_nama_supp' => $this->put('supplier_nama_supp')
		);

		$query = $this->mb->updateBarang($kode_brg, $updateData);

		if ($query) {
			$responseCode = "00";
			$responseDesc = "Success to update barang";
			$responseData = $this->put();
		}
		else{
			$responseCode = "01";
			$responseDesc = "Failed to update barang";
		}
		

		$response = resultJson( $responseCode, $responseDesc, $responseData);

		$this->response($response, 200);
	}

	public function index_delete()
	{
		$kode_brg = $this->delete('kode_brg');
		$query = $this->mb->deleteBarang($kode_brg);

		if ($query) {
			$responseCode = "00";
			$responseDesc = "Success to delete barang";
			$responseData = null;
		}

		else{
			$responseCode = "01";
			$responseDesc = "Failed to delete barang";
			$responseData = null;
		}
		

		$response = resultJson( $responseCode, $responseDesc, $responseData);

		$this->response($response, 200);

	}

}