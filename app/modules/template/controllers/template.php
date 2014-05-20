<?php

/* * *************************************************************************************
 *                       			template.php
 * **************************************************************************************
 *      Author:     	Topidesta as Shabiki <m.desta.fadilah@hotmail.com>
 *      Website:    	http://www.twitter.com/emang_dasar
 *
 *      File:          	template.php
 *      Created:   		2012 - 17.24.46 WIB
 *      Copyright:  	(c) 2012 - desta
 *                  	DON'T BE A DICK PUBLIC LICENSE
 * 						Version 1, December 2009
 * 						Copyright (C) 2009 Philip Sturgeon
 * 		
 * 		source: 		www.davidconnelly.com/hmvcstuff
 * 						www.dcradionnetwork.com
 *
 * ************************************************************************************** */

class Template extends MX_Controller 
{

    function login($data)
    {
        $this->load->view('login', $data);
    }

    function admin($data)
    {
        // Additional information
        /*
        $data['agen'] = $this->general->showAgent();
        $data['version'] = $this->config->item('sytem_version');
        $data['lisensi'] = $this->config->item('lisensi_app');
        $data['perusahaan'] = $this->config->item('nama_perusahaan');
        $data['programmer'] = $this->config->item('programmer');
        */

        $this->load->view('admin', $data);
        //$this->load->view('side_admin');
    }
    
    function owner($data)
    {
        // Additional information
        /*
        $data['agen'] = $this->general->showAgent();
        $data['version'] = $this->config->item('sytem_version');
        $data['lisensi'] = $this->config->item('lisensi_app');
        $data['perusahaan'] = $this->config->item('nama_perusahaan');
        $data['programmer'] = $this->config->item('programmer');
        */

        $this->load->view('owner', $data);
        //$this->load->view('side_admin');
    }
    
     function staff($data)
    {
        // Additional information
        /*
        $data['agen'] = $this->general->showAgent();
        $data['version'] = $this->config->item('sytem_version');
        $data['lisensi'] = $this->config->item('lisensi_app');
        $data['perusahaan'] = $this->config->item('nama_perusahaan');
        $data['programmer'] = $this->config->item('programmer');
        */

        $this->load->view('staff', $data);
        //$this->load->view('side_admin');
    }
    
    function general($data)
    {
        // Additional information
        /*
        $data['agen'] = $this->general->showAgent();
        $data['version'] = $this->config->item('sytem_version');
        $data['lisensi'] = $this->config->item('lisensi_app');
        $data['perusahaan'] = $this->config->item('nama_perusahaan');
        $data['programmer'] = $this->config->item('programmer');
        */

        $this->load->view('general', $data);
        //$this->load->view('side_admin');
    }
    
    function unactive($data)
    {
        // Additional information
        /*
        $data['agen'] = $this->general->showAgent();
        $data['version'] = $this->config->item('sytem_version');
        $data['lisensi'] = $this->config->item('lisensi_app');
        $data['perusahaan'] = $this->config->item('nama_perusahaan');
        $data['programmer'] = $this->config->item('programmer');
        */

        $this->load->view('unactive', $data);
        //$this->load->view('side_admin');
    }
    
}

/* End of File: template.php */
/* Location: ../www/modules/template.php */ 