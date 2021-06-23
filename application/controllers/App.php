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
        
        $this->load->view('cetak_laporan');
    }

    

}
