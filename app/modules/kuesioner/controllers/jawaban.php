<?php

/* * *************************************************************************************
 *                       		jawaban.php
 * **************************************************************************************
 *      Author:     	Topidesta as Shabiki <m.desta.fadilah@hotmail.com>
 *      Website:    	http://www.twitter.com/emang_dasar
 *
 *      File:          	jawaban
 *      Created:   	13:19:24 27 Jan 14
 *      Copyright:  	(c) 2014 - JohnDoe
 *                  	DON'T BE A DICK PUBLIC LICENSE
 * 			Version 1, December 2009
 * 			Copyright (C) 2009 Philip Sturgeon
 *
 * ************************************************************************************** */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Jawaban extends Front_Controller{
    //put your code here
    function __construct() {
        parent::__construct();
    }
    
    function index()
    {
        echo "OK";
    }
}

/* End of File: jawaban.php */