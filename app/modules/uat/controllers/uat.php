<?php

/* * *************************************************************************************
 *                       		uat.php
 * **************************************************************************************
 *      Author:     	Topidesta as Shabiki <m.desta.fadilah@hotmail.com>
 *      Website:    	http://www.twitter.com/emang_dasar
 *
 *      File:          	uat
 *      Created:   	13:36:12 04 Feb 14
 *      Copyright:  	(c) 2014 - JohnDoe
 *                  	DON'T BE A DICK PUBLIC LICENSE
 * 			Version 1, December 2009
 * 			Copyright (C) 2009 Philip Sturgeon
 *
 * ************************************************************************************** */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Uat extends Front_Controller 
{
    //put your code here
    function __construct() {
        parent::__construct();
    }
    
    function index()
    {
        $this->_manage();
    }
    
    function _manage()
    {
        $data['uat'] = "uat"; // Controller
        $data['view'] = "index_uat"; // View
        $data['module'] = "uat"; // Controller

        echo Modules::run('template/admin', $data);
    }
    
    function add()
    {
        
    }
    
    function edit()
    {
        
    }
    
    function delete()
    {
        
    }
}

/* End of File: uat.php */