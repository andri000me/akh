<?php

/* * *************************************************************************************
 *                       		admin.php
 * **************************************************************************************
 *      Author:     	Topidesta as Shabiki <m.desta.fadilah@hotmail.com>
 *      Website:    	http://www.twitter.com/emang_dasar
 *
 *      File:          	admin
 *      Created:   	26 Jan 14 0:20:13 WIB
 *      Copyright:  	(c) 2012 - desta
 *                  	DON'T BE A DICK PUBLIC LICENSE
 * 			Version 1, December 2009
 * 			Copyright (C) 2009 Philip Sturgeon
 *
 * ************************************************************************************** */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class admin extends Admin_Controller {

    //put your code here
    function __construct()
    {
        parent::__construct();
    }
    
    function index()
    {
        
        $data['message'] = $this->session->flashdata('message');

        $data['user'] = "admin"; // Controller
        $data['view'] = "dashboard"; // View
        $data['module'] = "user"; // Controller

        echo Modules::run('template/admin', $data);
    }

}

/* End of File: admin.php */