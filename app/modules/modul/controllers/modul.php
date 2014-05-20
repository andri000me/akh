<?php

/* * *************************************************************************************
 *                       		modul.php
 * **************************************************************************************
 *      Author:     	Topidesta as Shabiki <m.desta.fadilah@hotmail.com>
 *      Website:    	http://www.twitter.com/emang_dasar
 *
 *      File:          	modul
 *      Created:   	28 Mar 14 19:33:39 WIB
 *      Copyright:  	(c) 2012 - desta
 *                  	DON'T BE A DICK PUBLIC LICENSE
 * 			Version 1, December 2009
 * 			Copyright (C) 2009 Philip Sturgeon
 *
 * ************************************************************************************** */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Modul extends Front_Controller {

    //put your code here
    function __construct()
    {
        parent::__construct();
        $this->load->model("modul/modul_model", "MM");
    }

    function dump()
    {
        $data = $this->MM->count_all();
        dump($data);
        exit;
    }

    function index()
    {
        $this->__manage();
    }

    function __manage()
    {


        if ($this->ion_auth->is_admin())
        {
            //$data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
            $data['message'] = (validation_errors() ? '<div class="alert alert-error"><a class="close" data-dismiss="alert">X</a>' . validation_errors() . '</div>' : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

            // paging
            $this->load->library('pagination');

            $uri_segment = 3;
            $data['offset'] = $this->uri->segment($uri_segment);

            $config['base_url'] = base_url() . 'modul/index/';
            $config['total_rows'] = $this->MM->count_all();
            $config['per_page'] = 18;
            $config['next_link'] = '<li>Selanjutnya</li>';
            $config['prev_link'] = '<li>Sebelumnya</li>';
            $config['cur_tag_open'] = '<li class="active"><a href="#">..</a> - Halaman ke ';
            $config['cur_tag_close'] = ' </li>';

            $data['moduls'] = $this->MM->get_all();

            $this->pagination->initialize($config);
            $data['paging'] = $this->pagination->create_links();


            // Additional template
            $data['modul'] = 'modul'; // controller module
            $data['view'] = 'index_modul'; // view modul
            $data['module'] = 'modul'; // nama module nya

            echo Modules::run('template/admin', $data);
        }
    }
}
    /* End of File: modul.php */