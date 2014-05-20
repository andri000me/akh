<?php

/* * *************************************************************************************
 *                       		Front_Controller.php
 * **************************************************************************************
 *      Author:     	Topidesta as Shabiki <m.desta.fadilah@hotmail.com>
 *      Website:    	http://www.twitter.com/emang_dasar
 *
 *      File:          	Front_Controller
 *      Created:   	25 Jan 14 13:16:54 WIB
 *      Copyright:  	(c) 2012 - desta
 *                  	DON'T BE A DICK PUBLIC LICENSE
 * 			Version 1, December 2009
 * 			Copyright (C) 2009 Philip Sturgeon
 *
 * ************************************************************************************** */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Front_Controller extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        $data[] = array();
        // Excel Export
        $this->load->library('Excel_generator');
        // Vagina
        $this->load->library('pagination');
        // Authentikasi (IONauth)
        $this->load->library('ion_auth');
        // Language (i18n)
        $this->load->model('bahasa/bahasa_model');


        $current_lang = $this->lang->lang();
        $data['records'] = $this->bahasa_model->get_all_data($current_lang);
        $this->lang->load('akh');

        //$CI = & get_instance();
        //$this->load->helper('translate');
        //$CI->lang->load('cakra');
        /*
          if($this->input->cookie('bahasa') != ""){
          $language = $this->input->cookie('bahasa');

          }else{

          if(isset($this->view_data['bahasa'])){
          $language = $this->view_data['bahasa'];

          }else{
          $language = "english";

          }

          }

          $this->lang->load('cakra', $language);
         */
    }

}

/* End of File: Front_Controller.php */
