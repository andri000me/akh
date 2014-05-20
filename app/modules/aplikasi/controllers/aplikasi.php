<?php

/* * *************************************************************************************
 *                       		aplikasi.php
 * **************************************************************************************
 *      Author:     	Topidesta as Shabiki <m.desta.fadilah@hotmail.com>
 *      Website:    	http://www.twitter.com/emang_dasar
 *
 *      File:          	aplikasi
 *      Created:   	13:40:05 18 Feb 14
 *      Copyright:  	(c) 2014 - JohnDoe
 *                  	DON'T BE A DICK PUBLIC LICENSE
 * 			Version 1, December 2009
 * 			Copyright (C) 2009 Philip Sturgeon
 *
 * ************************************************************************************** */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Aplikasi extends Front_Controller {

    private $limit = 3;

    //put your code here
    function __construct()
    {
        parent::__construct();

        $this->load->model("aplikasi/aplikasi_model", "aplikasi");
        $this->load->model("user/user_model");
        $this->load->model("warna/warna_model");
        $this->load->model("galeri/galeri_model");
    }

    function debuk()
    {

        $var = $this->aplikasi->getAll()->result_array();

        //$var = $this->galeri_model->get_all();

        dump($var);
    }

    function index()
    {
        /*
          if (!$this->ion_auth->logged_in())
          {
          redirect('auth/login');
          }
         */

        $this->_manage();
    }

    function add()
    {


        // Render
        $data['aplikasi'] = "aplikasi"; // Controller
        $data['view'] = "form_aplikasi"; // View
        $data['module'] = "aplikasi"; // Controller

        echo Modules::run('template/admin', $data);
    }

    function edit()
    {


        // Render
        $data['aplikasi'] = "aplikasi"; // Controller
        $data['view'] = "form_aplikasi"; // View
        $data['module'] = "aplikasi"; // Controller

        echo Modules::run('template/admin', $data);
    }

    function delete($id)
    {
        $cek_status = $this->aplikasi->delete($id);

        if ($cek_status == TRUE)
        {
            $this->session->set_flashdata("message", "Data berhasil dihapus");
        }
        else
        {
            $this->session->set_flashdata("message", "Maaf, Data gagal dihapus");
        }

        redirect('aplikasi', 'refresh');

        // Render
        $data['aplikasi'] = "aplikasi"; // Controller
        $data['view'] = "index_aplikasi"; // View
        $data['module'] = "aplikasi"; // Controller

        echo Modules::run('template/admin', $data);
    }

    function _manage($offset = 0)
    {

        //$data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
        $data['message'] = (validation_errors() ? '<div class="alert alert-error"><a class="close" data-dismiss="alert">X</a>' . validation_errors() . '</div>' : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

        // paging
        $this->load->library('pagination');

        $uri_segment = 3;
        $data['offset'] = $this->uri->segment($uri_segment);

        $config['base_url'] = base_url() . 'aplikasi/index/';
        $config['total_rows'] = $this->aplikasi->count_all();
        $config['per_page'] = 18;
        $config['next_link'] = '<li>Selanjutnya</li>';
        $config['prev_link'] = '<li>Sebelumnya</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">..</a> - Halaman ke ';
        $config['cur_tag_close'] = ' </li>';

        $data['aplikasis'] = $this->aplikasi->getAll($this->limit, $offset);


        $this->pagination->initialize($config);
        $data['paging'] = $this->pagination->create_links();

        // Render
        $data['aplikasi'] = "aplikasi"; // Controller
        $data['view'] = "index_aplikasi"; // View
        $data['module'] = "aplikasi"; // Controller

        echo Modules::run('template/admin', $data);
    }

    /*
     * Fungsi untuk menambahkan data aplikasi
     * ------
     * @access
     * @param 
     * 
     */

    function tambah()
    {
        /*
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->in_group('staff'))
        {
            redirect('auth', 'refresh');
        }
        */

        // Setting Validasi
        $this->form_validation->set_rules('created');
        $this->form_validation->set_rules('modified');
        $this->form_validation->set_rules('tasks');
        $this->form_validation->set_rules('result');
        $this->form_validation->set_rules('option');
        $this->form_validation->set_rules('modul');
        $this->form_validation->set_rules('gambar_id');

        if ($this->form_validation->run())
        {
            $cek_status = $this->aplikasi->save();
            
            if ($cek_status == TRUE)
            {
                $this->session->set_flashdata('message', 'Data berhasil Ditambah');
                redirect("aplikasi", 'refresh');
            }
            else
            {
                // Populate data

                $data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));

                $data['created'] = array(
                    'name' => 'created',
                    'id' => 'created',
                    'type' => 'text',
                    'value' => $this->form_validation->set_value('created'),
                );
                $data['modified'] = array(
                    'name' => 'modified',
                    'id' => 'modified',
                    'type' => 'text',
                    'value' => $this->form_validation->set_value('modified'),
                );
                $data['tasks'] = array(
                    'name' => 'tasks',
                    'id' => 'tasks',
                    'type' => 'text',
                    'value' => $this->form_validation->set_value('tasks'),
                );
                $data['result'] = array(
                    'name' => 'result',
                    'id' => 'result',
                    'type' => 'text',
                    'value' => $this->form_validation->set_value('result'),
                );
                $data['option'] = array(
                    'name' => 'option',
                    'id' => 'option',
                    'type' => 'text',
                    'value' => $this->form_validation->set_value('option'),
                );
                
            }
        }


        // Render
        $data['aplikasi'] = "aplikasi"; // Controller
        $data['view'] = "form_aplikasi"; // View
        $data['module'] = "aplikasi"; // Controller

        echo Modules::run('template/staff', $data);
    }

    /*
     * Fungsi untuk memastikan bahwa ini untuk modul admin
     * ------
     * @param
     * @array
     * 
     */

    function _admin()
    {
        $this->aplikasi;
    }

    /*
     * Fungsi untuk memastikan bahwa ini untuk modul seller
     * ------
     * @param
     * @array
     * 
     */

    function _seller()
    {
        
    }

    /*
     * Fungsi untuk memastikan bahwa ini untuk modul buyer
     * ------
     * @param
     * @array
     * 
     */

    function _buyer()
    {
        
    }

    /*
     * Fungsi untuk memastikan bahwa ini untuk modul vendor
     * ------
     * @array
     * @param
     * 
     */

    function _vendor()
    {
        
    }

}

/* End of File: aplikasi.php */