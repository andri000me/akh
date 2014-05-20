<?php

/* * *************************************************************************************
 *                       		soal.php
 * **************************************************************************************
 *      Author:     	Topidesta as Shabiki <m.desta.fadilah@hotmail.com>
 *      Website:    	http://www.twitter.com/emang_dasar
 *
 *      File:          	soal
 *      Created:   	13:21:53 27 Jan 14
 *      Copyright:  	(c) 2014 - JohnDoe
 *                  	DON'T BE A DICK PUBLIC LICENSE
 * 			Version 1, December 2009
 * 			Copyright (C) 2009 Philip Sturgeon
 *
 * ************************************************************************************** */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Soal extends Front_Controller {

    //put your code here
    function __construct() {
        parent::__construct();
        $this->load->model("kuesioner/soal_model","soal");
    }

    function index() {
        $this->_manage();
    }

    function _manage() {


        if ($this->ion_auth->is_admin()) {
            //$data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
            $data['message'] = (validation_errors() ? '<div class="alert alert-error"><a class="close" data-dismiss="alert">X</a>' . validation_errors() . '</div>' : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

            // paging
            $this->load->library('pagination');

            $uri_segment = 4;
            $data['offset'] = $this->uri->segment($uri_segment);

            $config['base_url'] = base_url() . 'soal/index/';
            $config['total_rows'] = $this->soal->count_all();
            $config['per_page'] = 18;
            $config['next_link'] = '<li>Selanjutnya</li>';
            $config['prev_link'] = '<li>Sebelumnya</li>';
            $config['cur_tag_open'] = '<li class="active"><a href="#">..</a> - Halaman ke ';
            $config['cur_tag_close'] = ' </li>';

            $data['soals'] = $this->soal->as_array()->get_all();

            $this->pagination->initialize($config);
            $data['paging'] = $this->pagination->create_links();

            $data['kuesioner'] = "soal"; // Controller
            $data['view'] = "index_soal"; // View
            $data['module'] = "kuesioner"; // Controller

            echo Modules::run('template/admin', $data);
        }
    }

        function add() {
            $this->load->view('form_soal');
        }

        function proses() {
            
        }

        function edit() {
            
        }

        function delete() {
            $data = $_REQUEST;
            $this->soal_model->deleteSoal($data);

            $output['success'] = 1;
            $output['msg'] = "delete successfully records";

            echo json_encode($output);
        }

    }

    /* End of File: soal.php */