<?php

/* * *************************************************************************************
 *                       		jawaban.php
 * **************************************************************************************
 *      Author:     	Topidesta as Shabiki <m.desta.fadilah@hotmail.com>
 *      Website:    	http://www.twitter.com/emang_dasar
 *
 *      File:          	jawaban
 *      Created:   	28 Mar 14 21:33:09 WIB
 *      Copyright:  	(c) 2012 - desta
 *                  	DON'T BE A DICK PUBLIC LICENSE
 * 			Version 1, December 2009
 * 			Copyright (C) 2009 Philip Sturgeon
 *
 * ************************************************************************************** */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Jawaban extends Front_Controller
{
    //put your code here
    function __construct()
    {
        parent::__construct();
    }
    
    function index()
    {
        $data['jawaban'] = 'jawaban'; // controller
        $data['view'] = 'index_jawaban'; // view controller
        $data['module'] = 'jawaban'; // nama modules
        echo Modules::run('template/admin',$data);
    }
    
    function _manage()
    {
        
    }
    
    function user()
    {
        
    }
}

/* End of File: jawaban.php */