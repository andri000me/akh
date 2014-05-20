<?php

/* * *************************************************************************************
 *                       		bos.php
 * **************************************************************************************
 *      Author:     	Topidesta as Shabiki <m.desta.fadilah@hotmail.com>
 *      Website:    	http://www.twitter.com/emang_dasar
 *
 *      File:          	bos
 *      Created:   	27 Mar 14 21:08:07 WIB
 *      Copyright:  	(c) 2012 - desta
 *                  	DON'T BE A DICK PUBLIC LICENSE
 * 			Version 1, December 2009
 * 			Copyright (C) 2009 Philip Sturgeon
 *
 * ************************************************************************************** */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Bos extends Front_Controller {
    //put your code here
    function __construct()
    {
        parent::__construct();
    }
    
    function index()
    {
        
        
        $data['user'] = "bos"; // Controller
        $data['view'] = "index_bos"; // View
        $data['module'] = "user"; // Controller

        echo Modules::run('template/owner', $data);
    }
}

/* End of File: bos.php */