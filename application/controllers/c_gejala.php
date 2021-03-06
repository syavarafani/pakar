<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_gejala extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->library('m_gejala');
	}

	public function daftar(){
		if ($this->session->userdata('level')==1) 
		{
			$tabel = $this->m_gejala->getTabel();
			$data['title']="Daftar Gejala";
			$this->load->view('headeradmin');
			$this->load->view('v_gejala', array('data' => $tabel));
			$this->load->view('footer');
		}
		else
		{
			redirect('c_validasi');
		}
		
	}

	public function cekPK()	{
		  $id_gejala 	= $this->input->post('id_gejala');    
		  $query 		= $this->m_gejala->getPK($id_gejala);  
	    
	    $status ="true";  
	    if($query)
	    {
		   $status = "false";
		  }                
	  	echo $status;
	}

	public function tambah()
	{
		if ($this->session->userdata('level')==1) 
		{
			$data['pesan']='';
			$head['title']='Input Data Gejala';
			$this->load->view('headeradmin', $head);
			$this->load->view('v_tambahgejala', $data);
			$this->load->view('footer');
		}
		else
		{
			redirect('c_validasi');
		}
		
	}

	public function menambahGejala(){
		if ($this->session->userdata('level')==1) 
		{
			$data['pesan']='';
			$id_gejala = $_POST['id_gejala'];
			$nama_gejala = $_POST['nama_gejala'];
					
			$data_masukan = array(
					'id_gejala' => $id_gejala,
					'nama_gejala' => $nama_gejala,
				);

			$mhs = $this->m_gejala->querymenambahgejala('gejala',$data_masukan);
			if($mhs >= 1){
				if($mhs){
				$data['pesan']='TRUE';
				}
				else{
					$data['pesan']='FALSE';
				}
				
				$head['title']='';
				$this->load->view('headeradmin', $head);
				$this->load->view('v_tambahgejala', $data);
				$this->load->view('footer');

			}
			else{
				echo "<h1>Insert data gagal </h1>";
			}
		}
		else
		{
			redirect('c_validasi');
		}
		
	}

	public function menghapusGejala($id_gejala)
	{
		if ($this->session->userdata('level')==1) 
		{
			$where = array('id_gejala' => $id_gejala);

			$mhs = $this->m_gejala->querymenghapusgejala('gejala', $where);

			if($mhs >= 1){
				
			$head['title']='Daftar Gejala';
			$mhs = $this->m_gejala->getTabel('gejala');
			$this->load->view('headeradmin',$head);
			$this->load->view('v_gejala' , array('data' => $mhs));
			$this->load->view('footer');

			}else{
				echo "<h1>hapus data gagal </h1>";
			}
		}
		else
		{
			redirect('c_validasi');
		}
		
	}

	public function mengubahGejala($id_gejala){
		if ($this->session->userdata('level')==1) 
		{
			$data = $this->m_gejala->Getdat(" where id_gejala = '$id_gejala'");
			$dat = array(
				'id_gejala' => $data[0]['id_gejala'],
				'nama_gejala' => $data[0]['nama_gejala'],
				);

			$data['title']='Ubah Data Penyakit';
			$this->load->view('headeradmin');
			$this->load->view('v_ubahgejala', $dat);
			$this->load->view('footer');
		}
		else
		{
			redirect('c_validasi');
		}
		
	}

	public function ubahGejala(){
		if ($this->session->userdata('level')==1) 
		{
			$id_gejala = $_POST['id_gejala'];
			$nama_gejala = $_POST['nama_gejala'];
					
			$data_masukan = array(
					'id_gejala' => $id_gejala,
					'nama_gejala' => $nama_gejala,
				);
			$where = array('id_gejala' => $id_gejala );
			$mhs = $this->m_gejala->querymengubahgejala('gejala',$data_masukan, $where);
			if($mhs >= 1){
				if($mhs){
				$data['pesan']='TRUE';
				}
				else{
					$data['pesan']='FALSE';
				}
				
				$head['title']='';
				$this->load->view('headeradmin', $head);
				$this->load->view('v_tambahgejala', $data);
				$this->load->view('footer');

			}
			else{
				echo "<h1>Insert data gagal </h1>";
			}
		}
		else
		{
			redirect('c_validasi');
		}
		
	}
}