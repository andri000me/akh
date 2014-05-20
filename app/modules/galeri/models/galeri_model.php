<?php

/* * *************************************************************************************
 *                       		galeri_model.php
 * **************************************************************************************
 *      Author:     	Topidesta as Shabiki <m.desta.fadilah@hotmail.com>
 *      Website:    	http://www.twitter.com/emang_dasar
 *
 *      File:          	galeri_model
 *      Created:   	31 Mar 14 20:00:12 WIB
 *      Copyright:  	(c) 2012 - desta
 *                  	DON'T BE A DICK PUBLIC LICENSE
 * 			Version 1, December 2009
 * 			Copyright (C) 2009 Philip Sturgeon
 *
 * ************************************************************************************** */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Galeri_model extends MY_Model
{
    //put your code here
    public $_table = 'galeri';
    
    // public $has_many = array ( 'modul' => array( 'model' => 'modul_model') );
    // public $has_many = array( 'modul' => array( 'model' => 'modul_model',
                                                  //'primary_key' => 'id' ));
    
    public $belongs_to = array( 'modul' => array( 'model' => 'modul_model',
                                                  'primary_key' => 'id' ));
     
}

/* End of File: galeri_model.php */