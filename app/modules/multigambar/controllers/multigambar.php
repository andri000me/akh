<?php

/* * *************************************************************************************
 *                       		multigambar.php
 * **************************************************************************************
 *      Author:     	Topidesta as Shabiki <m.desta.fadilah@hotmail.com>
 *      Website:    	http://www.twitter.com/emang_dasar
 *
 *      File:          	multigambar
 *      Created:   	9:04:58 16 Apr 14
 *      Copyright:  	(c) 2014 - JohnDoe
 *                  	DON'T BE A DICK PUBLIC LICENSE
 * 			Version 1, December 2009
 * 			Copyright (C) 2009 Philip Sturgeon
 *      SOURCE:         didanurwanda.blogspot.com
 *      SOURCE:         
 * ************************************************************************************** */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Multigambar extends Front_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->helper(array('html','url')); 
        $this->load->library('image_lib');
    }
    
    function index()
    {
        $data['multigambar'] = "multigambar"; // Controller
        $data['view'] = "index_multigambar"; // View
        $data['module'] = "multigambar"; // Controller
        $data['error'] = ' ';

        echo Modules::run('template/staff', $data);
    }
    
    function upload()
    {
        // Cek type datanya
        if (isset($_FILES['image']))
        {
            
            // Tangkap variabel gambar
            $data = $_FILES['image'];
            $total = count($data['name']);
            $gambar = array();
            
            // Kita hitung total gambarnya
            for ($i=0; $i<$total; $i++)
            {
                $gambar[] = array(
                    'name' => $data['name'][$i],
                    'type' => $data['type'][$i],
                    'tmp_name' => $data['tmp_name'][$i],
                    'error' => $data['error'][$i],
                    'size' => $data['size'][$i],
                );
            }
            
            $no = 0;
            foreach ($gambar as $row)
            {
                // Simpan data Aseli di marih..
                $config['upload_path'] = realpath('assets/doc/img/real/');
                $config['allowed_types'] = 'gif|jpg|png|JPEG|JPG';
                $config['encrypt_name'] = TRUE;
                $config['remove_spaces'] = TRUE;
                               
                $this->load->library('upload', $config);
                                                
                $image_data = $this->upload->do_multi($gambar[$no]);
                
                /*
                $ori = $image_data['file_name'];
                $mr = $image_data['file_path'] . $ori;
                
                $this->watermarking($mr);
                */
                
                dump($image_data);
                                
                $no++;
            }
            
            
            
            
        }
    }
    
    function watermarking($mr) 
    {
        
        //$config['source_image'] = $gb;
        $config['image_library'] = 'gd2';
        $config['wm_text'] = 'belionderdil.com'; // tanda yang akan tercetak di gambar
        $config['wm_type'] = 'text';
        $config['source_image'] = $mr;
        $config['wm_font_path'] = 'assets/fonts/texb.ttf'; //pastikan fontnya ada
        $config['wm_font_size'] = 40;
        $config['wm_font_color'] = '#B5622A';
        $config['wm_vrt_alignment'] = 'middle';
        $config['wm_hor_alignment'] = 'center';
        $config['wm_padding'] = 5;
        $config['thumb_marker'] = '_water';
        $config['wm_opacity'] = 5;
        $config['wm_shadow_color'] = 333333;
        
        $this->image_lib->initialize($config);
        $this->image_lib->watermark();
    }


    //put your code here
}

/* End of File: multigambar.php */