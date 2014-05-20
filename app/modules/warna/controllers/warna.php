<?php

/* * *************************************************************************************
 *                       		warna.php
 * **************************************************************************************
 *      Author:     	Topidesta as Shabiki <m.desta.fadilah@hotmail.com>
 *      Website:    	http://www.twitter.com/emang_dasar
 *
 *      File:          	warna
 *      Created:   	04 Mar 14 20:54:39 WIB
 *      Copyright:  	(c) 2012 - desta
 *                  	DON'T BE A DICK PUBLIC LICENSE
 * 			Version 1, December 2009
 * 			Copyright (C) 2009 Philip Sturgeon
 *
 * ************************************************************************************** */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Warna extends Front_Controller
{
    //put your code here
    function __construct()
    {
        parent::__construct();
        $this->load->model("warna/warna_model","wm");
    }
    
    function debuk()
    {
        $options = array(
                  'small'  => 'Small Shirt',
                  'med'    => 'Medium Shirt',
                  'large'   => 'Large Shirt',
                  'xlarge' => 'Extra Large Shirt',
                );
        
                dump($options);
    }
    
    function index()
    {
        $this->__manage();
    }
    
    function __manage()
    {
        $data['message'] = "pesan";
        
        // pagina
        $this->load->library('pagination');
        
        $uri_segment = 3;
        $data['offset'] = $this->uri->segment($uri_segment);
                
        $config['base_url'] = base_url() . 'warna/index';
        $config['total_rows'] = $this->wm->count_all();
        $config['per_page'] = 10;
        $config['next_link'] = '<li>Selanjutnya</li>';
        $config['prev_link'] = '<li>Sebelumnya</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">..</a> - Halaman ke ';
        $config['cur_tag_close'] = ' </li>';
        
        // Grab all data
        $data['warnas'] = $this->wm->get_all();

        $data['warna'] = 'warna'; // controller
        $data['view'] = 'index_warna'; // view controller
        $data['module'] = 'warna'; // nama modules
        echo Modules::run('template/admin',$data);
    }
            
    function newWarna()
    {
        
    }
    
    function editWarna()
    {
        
    }
    
    function deleteWarna()
    {
        
    }
}

/* End of File: warna.php */