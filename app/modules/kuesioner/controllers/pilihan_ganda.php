<?php

/* * *************************************************************************************
 *                       		pilihan_ganda.php
 * **************************************************************************************
 *      Author:     	Topidesta as Shabiki <m.desta.fadilah@hotmail.com>
 *      Website:    	http://www.twitter.com/emang_dasar
 *
 *      File:          	pilihan_ganda
 *      Created:   	13:18:39 27 Jan 14
 *      Copyright:  	(c) 2014 - JohnDoe
 *                  	DON'T BE A DICK PUBLIC LICENSE
 * 			Version 1, December 2009
 * 			Copyright (C) 2009 Philip Sturgeon
 *
 * ************************************************************************************** */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pilihan_ganda extends Front_Controller{
    //put your code here
    
    function __construct() {
        parent::__construct();
    }
    
    function index()
    {
        echo "OK Ganda";
    }
}

/* End of File: pilihan_ganda.php */