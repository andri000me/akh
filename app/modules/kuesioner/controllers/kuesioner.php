<?php
/* * *************************************************************************************
 *                       		kuesioner.php
 * **************************************************************************************
 *      Author:     	Topidesta as Shabiki <m.desta.fadilah@hotmail.com>
 *      Website:    	http://www.twitter.com/emang_dasar
 *
 *      File:          	kuesioner
 *      Created:   	26 Jan 14 10:22:41 WIB
 *      Copyright:  	(c) 2014 - JohnDoe
 *                  	DON'T BE A DICK PUBLIC LICENSE
 * 			Version 1, December 2009
 * 			Copyright (C) 2009 Philip Sturgeon
 *
 * ************************************************************************************** */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kuesioner extends Front_Controller{
    //put your code here
    
    function __construct() {
        parent::__construct();
        $this->load->model("kuesioner/kuesioner_model","kuesioner");
    }
    
    function index()
    {
        $this->_manage();
    }
    
    function _manage()
    {
         if ($this->ion_auth->is_admin()) {
            //$data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
            $data['message'] = (validation_errors() ? '<div class="alert alert-error"><a class="close" data-dismiss="alert">X</a>' . validation_errors() . '</div>' : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

            // paging
            $this->load->library('pagination');

            $uri_segment = 3;
            $data['offset'] = $this->uri->segment($uri_segment);

            $config['base_url'] = base_url() . 'kuesioner/index/';
            $config['total_rows'] = $this->kuesioner->count_all();
            $config['per_page'] = 18;
            $config['next_link'] = '<li>Selanjutnya</li>';
            $config['prev_link'] = '<li>Sebelumnya</li>';
            $config['cur_tag_open'] = '<li class="active"><a href="#">..</a> - Halaman ke ';
            $config['cur_tag_close'] = ' </li>';

            $data['kuesioners'] = $this->kuesioner->get_all();            
            
            $this->pagination->initialize($config);
            $data['paging'] = $this->pagination->create_links();

            // Render
            $data['kuesioner'] = "kuesioner"; // Controller
            $data['view'] = "index_kuesioner"; // View
            $data['module'] = "kuesioner"; // Controller

            echo Modules::run('template/admin', $data);
            }
        }
    }

/* End of File: kuesioner.php */