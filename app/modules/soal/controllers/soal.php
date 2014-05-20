<?php

/* * *************************************************************************************
 *                       		soal.php
 * **************************************************************************************
 *      Author:     	Topidesta as Shabiki <m.desta.fadilah@hotmail.com>
 *      Website:    	http://www.twitter.com/emang_dasar
 *
 *      File:          	soal
 *      Created:   	28 Mar 14 21:28:13 WIB
 *      Copyright:  	(c) 2012 - desta
 *                  	DON'T BE A DICK PUBLIC LICENSE
 * 			Version 1, December 2009
 * 			Copyright (C) 2009 Philip Sturgeon
 *
 * ************************************************************************************** */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Soal extends Front_Controller
{
    //put your code here
    function __construct()
    {
        parent::__construct();
    }
    
    function index()
    {
        $this->_manage();
    }
    
    function _manage()
    {
        $data['soal'] = 'soal'; // controller
        $data['view'] = 'index_soal'; // view controller
        $data['module'] = 'soal'; // nama modules
        echo Modules::run('template/admin',$data);
    }
    
    function add()
    {
        $data['soal'] = 'soal'; // controller
        $data['view'] = 'form_soal'; // view controller
        $data['module'] = 'soal'; // nama modules
        echo Modules::run('template/admin',$data);
    }
    
    function edit()
    {
        $data['soal'] = 'soal'; // controller
        $data['view'] = 'form_soal'; // view controller
        $data['module'] = 'soal'; // nama modules
        echo Modules::run('template/admin',$data);
    }
    
    function delete()
    {
        
    }
}

/* End of File: soal.php */