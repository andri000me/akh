<?php

/* * *************************************************************************************
 *                       		imageupload_model.php
 * **************************************************************************************
 *      Author:     	Topidesta as Shabiki <m.desta.fadilah@hotmail.com>
 *      Website:    	http://www.twitter.com/emang_dasar
 *
 *      File:          	imageupload_model
 *      Created:   	11 Mei 14 19:46:44 WIB
 *      Copyright:  	(c) 2012 - desta
 *                  	DON'T BE A DICK PUBLIC LICENSE
 * 			Version 1, December 2009
 * 			Copyright (C) 2009 Philip Sturgeon
 *
 * ************************************************************************************** */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Imageupload_model extends CI_Model
{
    var $table =  'images';
    //put your code here
    function insert($data, $table)
    {
        $this->db->insert($table, $data);
    }
}

/* End of File: imageupload_model.php */