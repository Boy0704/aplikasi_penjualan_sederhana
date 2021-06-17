<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Supplier extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Supplier_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'supplier/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'supplier/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'supplier/index.html';
            $config['first_url'] = base_url() . 'supplier/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Supplier_model->total_rows($q);
        $supplier = $this->Supplier_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'supplier_data' => $supplier,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'judul_page' => 'Data Supplier',
            'konten' => 'supplier/supplier_list',
        );
        $this->load->view('v_index', $data);
    }

    public function read($id) 
    {
        $row = $this->Supplier_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_supplier' => $row->id_supplier,
		'nama' => $row->nama,
		'no_telp' => $row->no_telp,
		'alamat' => $row->alamat,
	    );
            $this->load->view('supplier/supplier_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('supplier'));
        }
    }

    public function create() 
    {
        $data = array(
            'judul_page' => 'Tambah supplier',
            'konten' => 'supplier/supplier_form',
            'button' => 'Create',
            'action' => site_url('supplier/create_action'),
	    'id_supplier' => set_value('id_supplier'),
	    'nama' => set_value('nama'),
	    'no_telp' => set_value('no_telp'),
	    'alamat' => set_value('alamat'),
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
		'nama' => $this->input->post('nama',TRUE),
		'no_telp' => $this->input->post('no_telp',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
	    );

            $this->Supplier_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('supplier'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Supplier_model->get_by_id($id);

        if ($row) {
            $data = array(
                'judul_page' => 'supplier/supplier_form',
                'konten' => 'supplier/supplier_form',
                'button' => 'Update',
                'action' => site_url('supplier/update_action'),
		'id_supplier' => set_value('id_supplier', $row->id_supplier),
		'nama' => set_value('nama', $row->nama),
		'no_telp' => set_value('no_telp', $row->no_telp),
		'alamat' => set_value('alamat', $row->alamat),
	    );
            $this->load->view('v_index', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('supplier'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_supplier', TRUE));
        } else {
            $data = array(
		'nama' => $this->input->post('nama',TRUE),
		'no_telp' => $this->input->post('no_telp',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
	    );

            $this->Supplier_model->update($this->input->post('id_supplier', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('supplier'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Supplier_model->get_by_id($id);

        if ($row) {
            $this->Supplier_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('supplier'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('supplier'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama', 'nama', 'trim|required');
	$this->form_validation->set_rules('no_telp', 'no telp', 'trim|required');
	$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');

	$this->form_validation->set_rules('id_supplier', 'id_supplier', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Supplier.php */
/* Location: ./application/controllers/Supplier.php */
/* Please DO NOT modify this information : */
/* Generated by Boy Kurniawan 2021-06-17 13:14:32 */
/* https://jualkoding.com */