<?php

/* * *************************************************************************************
 *                       		dokumen.php
 * **************************************************************************************
 *      Author:     	Topidesta as Shabiki <m.desta.fadilah@hotmail.com>
 *      Website:    	http://www.twitter.com/emang_dasar
 *
 *      File:          	dokumen
 *      Created:   	28 Mar 14 19:36:02 WIB
 *      Copyright:  	(c) 2012 - desta
 *                  	DON'T BE A DICK PUBLIC LICENSE
 * 			Version 1, December 2009
 * 			Copyright (C) 2009 Philip Sturgeon
 *
 * ************************************************************************************** */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dokumen extends Front_Controller {

    private $limit = 3;
    //put your code here
    function __construct()
    {
        parent::__construct();
        $this->load->library('upload');
        $this->load->model("dokumen/dokumen_model", "dokumen");
    }

    function debuk()
    {
        $var = $this->dokumen->getAll();

        dump($var);
    }

    function index()
    {
        /*
        if (!$this->ion_auth->logged_in())
        {
            redirect("auth/login", "refresh");
        }
        */
        $this->_manage();
    }

    function _manage($offset = 0)
    {
        $data['message'] = (validation_errors() ? '<div class="alert alert-error"><a class="close" data-dismiss="alert">X</a>' . validation_errors() . '</div>' : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

        $this->load->library('pagination');
        
        $uri_segment = 3;
        $data['offset'] = $this->uri->segment($uri_segment);
        
        $config['base_url'] = base_url().'dokumen/index';
        $config['total_rows'] = $this->dokumen->countAll();
        $config['per_page'] = 10;
        $config['next_link'] = '<li>Selanjutnya</li>';
        $config['prev_link'] = '<li>Sebelumnya</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">..</a> - Halaman ke ';
        $config['cur_tag_close'] = ' </li>';
        
        $this->pagination->initialize($config);
        $data['paging'] = $this->pagination->create_links();
        
        $data['dokumens'] = $this->dokumen->getAll($this->limit, $offset);
        
        $data['dokumen'] = 'dokumen'; // controller
        $data['view'] = 'index_dokumen'; // view controller
        $data['module'] = 'dokumen'; // nama modules
        echo Modules::run('template/admin', $data);
    }

    function add()
    {
        $data['title'] = "Tambah Dokumen Office";
        
        if (!$this->ion_auth->is_admin())
        {
            redirect('auth/login', 'refresh');
        }

        $id_user = $this->session->userdata('user_id');
        
        $settings = array(
            'upload_path'   => DOC_PATH,
            'allowed_types' => 'pdf|xls|xlsx',
            'max_size'      => '5024',
            'enctrypt_name' => TRUE,
        );
        
        $this->load->library('upload', $settings);
        
        if ($this->upload->do_upload('pdf,xls,xlsx'))
        {
            $doc = $this->upload->data();
            $post = $this->input->post();
            
            if ($this->dokumen->save())
            {
                
            }
        }
       
            $data['message'] = $this->upload->display_errors();
            
            $data['dokumens'] = $id;

            $data['file_name'] = array(
                'name' => 'file_name',
                'id' => 'file_name',
                'type' => 'text',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('file_name'),
            );
            
            $data['dokumen'] = 'dokumen'; // controller
            $data['view'] = 'form_dokumen'; // view controller
            $data['module'] = 'dokumen'; // nama modules
            echo Modules::run('template/admin', $data);
        
    }

    function edit()
    {
        
    }

    function delete()
    {
        
    }

}

/* End of File: dokumen.php */