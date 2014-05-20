<?php

/* * *************************************************************************************
 *                       		bahasa.php
 * **************************************************************************************
 *      Author:     	Topidesta as Shabiki <m.desta.fadilah@hotmail.com>
 *      Website:    	http://www.twitter.com/emang_dasar
 *
 *      File:          	bahasa
 *      Created:   	06 Feb 14 19:51:33 WIB
 *      Copyright:  	(c) 2012 - desta
 *                  	DON'T BE A DICK PUBLIC LICENSE
 * 			Version 1, December 2009
 * 			Copyright (C) 2009 Philip Sturgeon
 *
 * ************************************************************************************** */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Bahasa extends Front_Controller
{
    //put your code here
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('bahasa_model');
    }
    
    function debuk()
    {
        
    }
            
    function index()
    {
        
    }
}

/* End of File: bahasa.php */