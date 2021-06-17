<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Produk extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Produk_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'produk/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'produk/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'produk/index.html';
            $config['first_url'] = base_url() . 'produk/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Produk_model->total_rows($q);
        $produk = $this->Produk_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'produk_data' => $produk,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'judul_page' => 'Data Produk',
            'konten' => 'produk/produk_list',
        );
        $this->load->view('v_index', $data);
    }

    public function read($id) 
    {
        $row = $this->Produk_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_produk' => $row->id_produk,
		'nama_produk' => $row->nama_produk,
		'kategori' => $row->kategori,
		'harga_beli' => $row->harga_beli,
		'harga_jual' => $row->harga_jual,
		'id_supplier' => $row->id_supplier,
		'foto' => $row->foto,
	    );
            $this->load->view('produk/produk_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('produk').'?'.param_get());
        }
    }

    public function create() 
    {
        $data = array(
            'judul_page' => 'Tambah Produk',
            'konten' => 'produk/produk_form',
            'button' => 'Create',
            'action' => site_url('produk/create_action'),
	    'id_produk' => set_value('id_produk'),
	    'nama_produk' => set_value('nama_produk'),
	    'kategori' => set_value('kategori'),
	    'harga_beli' => set_value('harga_beli'),
	    'harga_jual' => set_value('harga_jual'),
	    'id_supplier' => set_value('id_supplier'),
	    'foto' => set_value('foto'),
	);
        $this->load->view('v_index', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $img = upload_gambar_biasa('user', 'image/produk/', 'jpg|png|jpeg', 10000, 'foto');
            $data = array(
		'nama_produk' => $this->input->post('nama_produk',TRUE),
		'kategori' => $this->input->post('kategori',TRUE),
		'harga_beli' => $this->input->post('harga_beli',TRUE),
		'harga_jual' => $this->input->post('harga_jual',TRUE),
		'id_supplier' => $this->input->post('id_supplier',TRUE),
		'foto' => $img,
	    );

            $this->Produk_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('produk').'?'.param_get());
        }
    }
    
    public function update($id) 
    {
        $row = $this->Produk_model->get_by_id($id);

        if ($row) {
            $data = array(
                'judul_page' => 'Update Produk',
                'konten' => 'produk/produk_form',
                'button' => 'Update',
                'action' => site_url('produk/update_action'),
		'id_produk' => set_value('id_produk', $row->id_produk),
		'nama_produk' => set_value('nama_produk', $row->nama_produk),
		'kategori' => set_value('kategori', $row->kategori),
		'harga_beli' => set_value('harga_beli', $row->harga_beli),
		'harga_jual' => set_value('harga_jual', $row->harga_jual),
		'id_supplier' => set_value('id_supplier', $row->id_supplier),
		'foto' => set_value('foto', $row->foto),
	    );
            $this->load->view('v_index', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('produk').'?'.param_get());
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_produk', TRUE));
        } else {
            $data = array(
		'nama_produk' => $this->input->post('nama_produk',TRUE),
		'kategori' => $this->input->post('kategori',TRUE),
		'harga_beli' => $this->input->post('harga_beli',TRUE),
		'harga_jual' => $this->input->post('harga_jual',TRUE),
		'id_supplier' => $this->input->post('id_supplier',TRUE),
		'foto' => $retVal = ($_FILES['foto']['name'] == '') ? $_POST['foto_old'] : upload_gambar_biasa('user', 'image/produk/', 'jpeg|png|jpg|gif', 10000, 'foto'),
	    );

            $this->Produk_model->update($this->input->post('id_produk', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('produk').'?'.param_get());
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Produk_model->get_by_id($id);

        if ($row) {
            $this->Produk_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('produk').'?'.param_get());
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('produk').'?'.param_get());
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_produk', 'nama produk', 'trim|required');
	$this->form_validation->set_rules('kategori', 'kategori', 'trim|required');
	$this->form_validation->set_rules('harga_beli', 'harga beli', 'trim|required');
	$this->form_validation->set_rules('harga_jual', 'harga jual', 'trim|required');
	$this->form_validation->set_rules('id_supplier', 'supplier', 'trim|required');

	$this->form_validation->set_rules('id_produk', 'id_produk', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Produk.php */
/* Location: ./application/controllers/Produk.php */
/* Please DO NOT modify this information : */
/* Generated by Boy Kurniawan 2021-06-17 16:12:25 */
/* https://jualkoding.com */