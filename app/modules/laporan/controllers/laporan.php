<?php

/* * *************************************************************************************
 *                       		laporan.php
 * **************************************************************************************
 *      Author:     	Topidesta as Shabiki <m.desta.fadilah@hotmail.com>
 *      Website:    	http://www.twitter.com/emang_dasar
 *
 *      File:          	laporan
 *      Created:   	10:26:00 05 Feb 14
 *      Copyright:  	(c) 2014 - JohnDoe
 *                  	DON'T BE A DICK PUBLIC LICENSE
 * 			Version 1, December 2009
 * 			Copyright (C) 2009 Philip Sturgeon
 *
 * ************************************************************************************** */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Laporan extends Front_Controller 
{
    function __construct()
    {
        parent::__construct();
        /* Load some model */
        
    }
    
    function eksel()
    {
        $query = $this->db->get('users');
        
        $this->excel_generator->set_query($query);
        $this->excel_generator->set_header(array('username', 'email', 'company', 'first_name'));
        $this->excel_generator->set_column(array('username', 'email', 'company', 'first_name'));
        $this->excel_generator->set_width(array(25, 15, 30, 15));
        $this->excel_generator->exportTo2003('Laporan Users');
    }
    
    function produk()
    {
         $query = $this->db->get('images');
        
        $this->excel_generator->set_query($query);
        $this->excel_generator->set_header(array('nama', 'type', 'enkrip'));
        $this->excel_generator->set_column(array('nama', 'type', 'enkrip'));
        $this->excel_generator->set_width(array(25, 15, 30));
        $this->excel_generator->exportTo2003('Laporan Nama Produk');
    }
    
    function pedef()
    {
        
    }
    
    function pengguna_xls()
    {
        $query = $this->db->get('users');
        
        $this->excel_generator->set_query($query);
        $this->excel_generator->set_header(array('username', 'email', 'company', 'first_name'));
        $this->excel_generator->set_column(array('username', 'email', 'company', 'first_name'));
        $this->excel_generator->set_width(array(25, 15, 30, 15));
        $this->excel_generator->exportTo2003('Laporan Users');
    }
    
    function pengguna_pdf()
    {
        
    }
    
    function level_xls()
    {
        
    }
}

/* End of File: laporan.php */