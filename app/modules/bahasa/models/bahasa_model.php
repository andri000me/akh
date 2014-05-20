<?php

/* * *************************************************************************************
 *                       		bahasa_model.php
 * **************************************************************************************
 *      Author:     	Topidesta as Shabiki <m.desta.fadilah@hotmail.com>
 *      Website:    	http://www.twitter.com/emang_dasar
 *
 *      File:          	bahasa_model
 *      Created:   	06 Feb 14 19:50:32 WIB
 *      Copyright:  	(c) 2012 - desta
 *                  	DON'T BE A DICK PUBLIC LICENSE
 * 			Version 1, December 2009
 * 			Copyright (C) 2009 Philip Sturgeon
 *
 * ************************************************************************************** */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Bahasa_model extends CI_Model
{
    //put your code here
    function get_all_data($lang) 
    {
        return $this->db->get_where('language', array('lang' => $lang))->result();
    }
}

/* End of File: bahasa_model.php */