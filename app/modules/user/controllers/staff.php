<?php

/* * *************************************************************************************
 *                       		staff.php
 * **************************************************************************************
 *      Author:     	Topidesta as Shabiki <m.desta.fadilah@hotmail.com>
 *      Website:    	http://www.twitter.com/emang_dasar
 *
 *      File:          	staff
 *      Created:   	13:38:03 19 Feb 14
 *      Copyright:  	(c) 2014 - JohnDoe
 *                  	DON'T BE A DICK PUBLIC LICENSE
 * 			Version 1, December 2009
 * 			Copyright (C) 2009 Philip Sturgeon
 *
 * ************************************************************************************** */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Staff extends Front_Controller {

    //put your code here
    function __construct() {
        parent::__construct();
    }

    function index() {
        
        
        
        $data['user'] = "staff"; // Controller
        $data['view'] = "index_staff"; // View
        $data['module'] = "user"; // Controller

        echo Modules::run('template/staff', $data);
    }

}

/* End of File: staff.php */