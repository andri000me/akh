<?php

/* * *************************************************************************************
 *                       		wilayah.php
 * **************************************************************************************
 *      Author:     	Topidesta as Shabiki <m.desta.fadilah@hotmail.com>
 *      Website:    	http://www.twitter.com/emang_dasar
 *
 *      File:          	wilayah
 *      Created:   	11:46:13 26 Mei 14
 *      Copyright:  	(c) 2014 - JohnDoe
 *                  	DON'T BE A DICK PUBLIC LICENSE
 * 			Version 1, December 2009
 * 			Copyright (C) 2009 Philip Sturgeon
 *
 * ************************************************************************************** */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Wilayah extends Front_Controller{
    //put your code here
    
    function __construct() {
        parent::__construct();
        $this->load->library("excel_reader2");
    }
    
    function index()
    {
        echo "Halaman unduh wilayah";
    }
    
    function drop_wilayah()
    {
        $file = explode('.', $_FILES['database']['name']);
        $length = count($file);
        
        // pastikan yang diupload eksel 2003/2007
        if($file[$length - 1] == 'xlsx' || $file[$length - 1] == 'xls')
        {
            $tmp = $_FILES['database']['tmp_name'];
            $read = PHPExcel_IOFactory::createReaderForFile($tmp);
            $read->setReadDataOnly(true);
            
            $excel = $read->load($tmp);
            $sheets = $read->listWorksheetNames($tmp);
            
            foreach($sheets as $sheet)
            {
                if ($this->db->table_exists($sheet))
                {
                    $_sheet = $excel->setActiveSheetIndexByName($sheet);
                    $maxRow = $_sheet->getHighestRow();
                    $maxCol = $_sheet->getHighestColumn();
                    $field = array();
                    $sql = array();
                    $maxCol = rand('A', $maxCol);
                    foreach ($maxCol as $key => $column)
                    {
                        $field[$key] = $_sheet->getCell($column, '1')->getCalculatedValue();
                    }
                    
                    for ($i = 2; $i <= $maxRow; $i++)
                    {
                        foreach ($maxCol as $k => $column)
                        {
                            $sql[$field[$k]] = $_sheet->getCell($column.$i)->getCalculatedValue();
                        }
                        
                        $this->db->insert($sheet, $sql);
                    }
                }
            }
        }
    }
    
    function drop_wilayah_prov()
    {
        
    }
    
    function drop_wilayah_kokab()
    {
        
    }
    
    function drop_wilayah_kecam()
    {
        
    }
    
    
    function unduh_wilayah()
    {
        //$query = $this->db->order_by("nama", "asc")->get('images');
        
        $this->excel_generator->set_query($query);
        $this->excel_generator->set_header(array('nama', 'type', 'enkrip'));
        $this->excel_generator->set_column(array('nama', 'type', 'enkrip'));
        $this->excel_generator->set_width(array(25, 15, 30));
        $this->excel_generator->exportTo2003('Laporan Nama Produk');
    }
}

/* End of File: wilayah.php */