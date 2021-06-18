<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Penjualan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Penjualan_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'penjualan/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'penjualan/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'penjualan/index.html';
            $config['first_url'] = base_url() . 'penjualan/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Penjualan_model->total_rows($q);
        $penjualan = $this->Penjualan_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'penjualan_data' => $penjualan,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'judul_page' => 'Penjualan',
            'konten' => 'penjualan/penjualan_list',
        );
        $this->load->view('v_index', $data);
    }

    public function read($id) 
    {
        $row = $this->Penjualan_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_penjualan' => $row->id_penjualan,
		'no_trx' => $row->no_trx,
		'tanggal' => $row->tanggal,
		'id_produk' => $row->id_produk,
		'qty' => $row->qty,
		'harga' => $row->harga,
		'subtotal' => $row->subtotal,
	    );
            $this->load->view('penjualan/penjualan_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('penjualan'));
        }
    }

    public function create() 
    {
        $data = array(
            'judul_page' => 'Tambah Penjualan',
            'konten' => 'penjualan/add',
            'button' => 'Create',
            'action' => site_url('penjualan/create_action'),
	    'id_penjualan' => set_value('id_penjualan'),
	    'no_trx' => set_value('no_trx'),
	    'tanggal' => set_value('tanggal'),
	    'id_produk' => set_value('id_produk'),
	    'qty' => set_value('qty'),
	    'harga' => set_value('harga'),
	    'subtotal' => set_value('subtotal'),
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
		'no_trx' => $this->input->post('no_trx',TRUE),
		'tanggal' => $this->input->post('tanggal',TRUE),
		'id_produk' => $this->input->post('id_produk',TRUE),
		'qty' => $this->input->post('qty',TRUE),
		'harga' => $this->input->post('harga',TRUE),
		'subtotal' => $this->input->post('subtotal',TRUE),
	    );

            $this->Penjualan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('penjualan'));
        }
    }

    public function simpan_cart($no_trx)
    {
        $this->cart->destroy();
        $data = array();
        $id_produk = $this->input->post('id_produk');
        $qty = $this->input->post('qty');
        foreach ($id_produk as $key => $value) {
            array_push($data, array(
                'id'      => $value,
                'qty'     => $qty[$key],
                'price'   => get_data('produk','id_produk',$value,'harga_jual'),
                'name'    => get_data('produk','id_produk',$value,'nama_produk'),
                // 'options' => array('Size' => 'L', 'Color' => 'Red')
            ));
        }
        $this->cart->insert($data);
        redirect("penjualan/create");

    }

    public function hapus_cart($rowid)
    {
        $this->cart->remove($rowid);
        redirect("penjualan/create");
    }

    public function cetak_struk($no_trx)
    {
        $this->load->view('penjualan/cetak_struk');
    }

    public function save_penjualan($no_trx)
    {
        $data = array();
        foreach ($this->cart->contents() as $items) {
            array_push($data, array(
                'no_trx' => $no_trx,
                'tanggal' => date('Y-m-d'),
                'id_produk' => $items['id'],
                'qty' => $items['qty'],
                'harga' => get_data('produk','id_produk',$items['id'],'harga_jual'),
                'subtotal' => $items['subtotal'],
            ));
        }
        $this->db->insert_batch('penjualan', $data);
        $this->cart->destroy();
        redirect("penjualan");
    }
    
    public function update($id) 
    {
        $row = $this->Penjualan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'judul_page' => 'Update Penjualan',
                'konten' => 'penjualan/penjualan_form',
                'button' => 'Update',
                'action' => site_url('penjualan/update_action'),
		'id_penjualan' => set_value('id_penjualan', $row->id_penjualan),
		'no_trx' => set_value('no_trx', $row->no_trx),
		'tanggal' => set_value('tanggal', $row->tanggal),
		'id_produk' => set_value('id_produk', $row->id_produk),
		'qty' => set_value('qty', $row->qty),
		'harga' => set_value('harga', $row->harga),
		'subtotal' => set_value('subtotal', $row->subtotal),
	    );
            $this->load->view('v_index', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('penjualan'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_penjualan', TRUE));
        } else {
            $data = array(
		'no_trx' => $this->input->post('no_trx',TRUE),
		'tanggal' => $this->input->post('tanggal',TRUE),
		'id_produk' => $this->input->post('id_produk',TRUE),
		'qty' => $this->input->post('qty',TRUE),
		'harga' => $this->input->post('harga',TRUE),
		'subtotal' => $this->input->post('subtotal',TRUE),
	    );

            $this->Penjualan_model->update($this->input->post('id_penjualan', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('penjualan'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Penjualan_model->get_by_id($id);

        if ($row) {
            $this->Penjualan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('penjualan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('penjualan'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('no_trx', 'no trx', 'trim|required');
	$this->form_validation->set_rules('tanggal', 'tanggal', 'trim|required');
	$this->form_validation->set_rules('id_produk', 'id produk', 'trim|required');
	$this->form_validation->set_rules('qty', 'qty', 'trim|required');
	$this->form_validation->set_rules('harga', 'harga', 'trim|required');
	$this->form_validation->set_rules('subtotal', 'subtotal', 'trim|required');

	$this->form_validation->set_rules('id_penjualan', 'id_penjualan', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Penjualan.php */
/* Location: ./application/controllers/Penjualan.php */
/* Please DO NOT modify this information : */
/* Generated by Boy Kurniawan 2021-06-18 03:20:02 */
/* https://jualkoding.com */