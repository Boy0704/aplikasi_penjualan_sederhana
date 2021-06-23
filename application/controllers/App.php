<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

	public function index()
	{
        if ($this->session->userdata('level') == '') {
            redirect('login');
        }
        
		$data = array(
			'konten' => 'home_admin',
            'judul_page' => 'Dashboard',
		);
		$this->load->view('v_index', $data);
    }

    public function laporan()
    {
        if ($this->session->userdata('level') == '') {
            redirect('login');
        }
        
        $data = array(
            'konten' => 'laporan',
            'judul_page' => 'Laporan',
        );
        $this->load->view('v_index', $data);
    }

    public function cetak_laporan()
    {
        if ($this->session->userdata('level') == '') {
            redirect('login');
        }
            
        if ($_POST) {
            $tgl1 = $this->input->post('tgl1');
            $tgl2 = $this->input->post('tgl2');
            $kategori = $this->input->post('kategori');

            $data = array(
                'tgl1' => $tgl1,
                'tgl2' => $tgl2,
                'kategori' => $kategori,
            );

            $this->load->view('cetak_laporan', $data);


        }

        
    }

    public function cetak_all()
    {
        if ($this->session->userdata('level') == '') {
            redirect('login');
        }
            
        
        $this->load->view('cetak_all');

        
    }

    

}
