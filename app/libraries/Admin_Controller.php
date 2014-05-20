<?php

/***************************************************************************************
 *                       		Admin_Controller.php
 ***************************************************************************************
 *      Author:     	Topidesta as Shabiki <m.desta.fadilah@hotmail.com>
 *      Website:    	http://www.twitter.com/emang_dasar
 *
 *      File:          	Admin_Controller
 *      Created:   	25 Jan 14 13:11:42 WIB
 *      Copyright:  	(c) 2012 - desta
 *                  	DON'T BE A DICK PUBLIC LICENSE
 * 			Version 1, December 2009
 *			Copyright (C) 2009 Philip Sturgeon
 *
 ****************************************************************************************/
class Admin_Controller extends MY_Controller
{
    /*
     * File ini digunakan untuk memanfaatkan tugas tugas admin saja.
     */
    function __construct()
    {
        parent::__construct();
        
        // Load some libraries default
        $this->load->library('pagination');
        
        // Load some model
        $this->load->library('ion_auth');
        $this->load->model(array('user/user_model','group/group_model'));
        
        
        
    }
}

/* End of File: Admin_Controller.php */
