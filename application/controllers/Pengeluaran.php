<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pengeluaran extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Pengeluaran_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'pengeluaran/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'pengeluaran/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'pengeluaran/index.html';
            $config['first_url'] = base_url() . 'pengeluaran/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Pengeluaran_model->total_rows($q);
        $pengeluaran = $this->Pengeluaran_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'pengeluaran_data' => $pengeluaran,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'judul_page' => 'Data Pengeluaran',
            'konten' => 'pengeluaran/pengeluaran_list',
        );
        $this->load->view('v_index', $data);
    }

    public function read($id) 
    {
        $row = $this->Pengeluaran_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_pengeluaran' => $row->id_pengeluaran,
		'tanggal' => $row->tanggal,
		'keterangan' => $row->keterangan,
		'biaya' => $row->biaya,
	    );
            $this->load->view('pengeluaran/pengeluaran_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pengeluaran'));
        }
    }

    public function create() 
    {
        $data = array(
            'judul_page' => 'Tambah Pengeluaran',
            'konten' => 'pengeluaran/pengeluaran_form',
            'button' => 'Create',
            'action' => site_url('pengeluaran/create_action'),
	    'id_pengeluaran' => set_value('id_pengeluaran'),
	    'tanggal' => set_value('tanggal'),
	    'keterangan' => set_value('keterangan'),
	    'biaya' => set_value('biaya'),
	);
        $this->load->view('v_index', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'tanggal' => $this->input->post('tanggal',TRUE),
		'keterangan' => $this->input->post('keterangan',TRUE),
		'biaya' => $this->input->post('biaya',TRUE),
	    );

            $this->Pengeluaran_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('pengeluaran'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Pengeluaran_model->get_by_id($id);

        if ($row) {
            $data = array(
                'judul_page' => 'Update Pengeluaran',
                'konten' => 'pengeluaran/pengeluaran_form',
                'button' => 'Update',
                'action' => site_url('pengeluaran/update_action'),
		'id_pengeluaran' => set_value('id_pengeluaran', $row->id_pengeluaran),
		'tanggal' => set_value('tanggal', $row->tanggal),
		'keterangan' => set_value('keterangan', $row->keterangan),
		'biaya' => set_value('biaya', $row->biaya),
	    );
            $this->load->view('v_index', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pengeluaran'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_pengeluaran', TRUE));
        } else {
            $data = array(
		'tanggal' => $this->input->post('tanggal',TRUE),
		'keterangan' => $this->input->post('keterangan',TRUE),
		'biaya' => $this->input->post('biaya',TRUE),
	    );

            $this->Pengeluaran_model->update($this->input->post('id_pengeluaran', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('pengeluaran'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Pengeluaran_model->get_by_id($id);

        if ($row) {
            $this->Pengeluaran_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('pengeluaran'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pengeluaran'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('tanggal', 'tanggal', 'trim|required');
	$this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required');
	$this->form_validation->set_rules('biaya', 'biaya', 'trim|required');

	$this->form_validation->set_rules('id_pengeluaran', 'id_pengeluaran', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Pengeluaran.php */
/* Location: ./application/controllers/Pengeluaran.php */
/* Please DO NOT modify this information : */
/* Generated by Boy Kurniawan 2021-06-17 17:02:28 */
/* https://jualkoding.com */