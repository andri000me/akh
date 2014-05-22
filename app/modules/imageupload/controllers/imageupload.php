<?php

/* * *************************************************************************************
 *                       		imageupload.php
 * **************************************************************************************
 *      Author:     	Topidesta as Shabiki <m.desta.fadilah@hotmail.com>
 *      Website:    	http://www.twitter.com/emang_dasar
 *
 *      File:          	imageupload
 *      Created:   	11 Mei 14 13:31:20 WIB
 *      Copyright:  	(c) 2012 - desta
 *                  	DON'T BE A DICK PUBLIC LICENSE
 * 			Version 1, December 2009
 * 			Copyright (C) 2009 Philip Sturgeon
 *
 * ************************************************************************************** */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Imageupload extends Front_Controller {
    
    var $real_path;
    var $full_path;
    var $medium_path;
    var $small_path;
    var $thumb_path;

    //put your code here
    function __construct()
    {
        parent::__construct();
        //$this->load->library('upload');
        
        $this->load->library('image_lib');
        $this->load->library('image_moo');
        $this->load->model("imageupload/imageupload_model","imagecrud");
        
        $this->real_path = realpath('assets/doc/img/real/');
        $this->full_path = realpath('assets/doc/img/full/');
        $this->medium_path = realpath('assets/doc/img/medium/');
        $this->small_path = realpath('assets/doc/img/small/');
        $this->thumb_path = realpath('assets/doc/img/thumbnails/');
    }

    function index()
    {

        $data['imageupload'] = "imageupload"; // Controller
        $data['view'] = "form_imageupload"; // View
        $data['module'] = "imageupload"; // Controller

        echo Modules::run('template/staff', $data);
    }

    function do_upload()
    {       
        $upload_conf = array(
            "upload_path" => $this->real_path,
            "allowed_types" => "jpg|JPG|png",
            "encrypt_name" => true
        );
        $this->load->library('upload', $upload_conf);
        
        if ($this->upload->do_multi_upload("myimage"))
        {
            // Simpan data array
            $upload_data2 = $this->upload->get_multi_upload_data();
            
            // Hitung file myimage dalam array
            for($i=0; $i<count($upload_data2); $i++)
            {
                // insert
                $info = array(
                'nama' => $upload_data2[$i]["orig_name"],
                'type' => $upload_data2[$i]["file_ext"],
                'enkrip' => $upload_data2[$i]["file_name"]
                
            );
            $this->imagecrud->insert($info, 'images');
            
             // try if we use image_moo
            $source = $this->real_path."/".$upload_data2[$i]["file_name"];
            
            $full_des = "./assets/doc/img/full/";          
            $medi_des = "./assets/doc/img/medium/";
            $smal_des = "./assets/doc/img/small/";
            $thum_des = "./assets/doc/img/thumbnails/";
            
            //$source_full = $this->full_path."/".$upload_data2[$i]["file_name"];
            
            $medi_h = 342;
            $medi_w = 342;
            //$full_h = 2000;
            //$full_w = 2000;
            
            $smal_h = 152;
            $smal_w = 152;
            $thum_h = 62;
            $thum_w = 62;
            
            $font = './assets/fonts/texb.ttf';
           //$font_img = './assets/img/BELI_ONDERDIL_2.png'B5622A;
          
            $this->image_moo
            // Full
                    ->load($source)
                    ->make_watermark_text("BeliOnderdil.com", $font, 18, "#CC6100")
                    ->resize(2000,2000)
                   
                    ->watermark(5,8)
                    ->round(10)
                    ->save($full_des.$upload_data2[$i]['file_name'],true)
            // Thumbnails        
                    ->make_watermark_text("BeliOnderdil.com", $font, 15, "#CC6100")
                    ->stretch($thum_w,$thum_h)
                   
                    ->watermark(5,8)
                    ->round(10)
                    ->save($thum_des.$upload_data2[$i]['file_name'],true)
            // Small
                    ->make_watermark_text("BeliOnderdil.com", $font, 18, "#CC6100")
                    ->stretch($smal_w,$smal_h)
                   
                    ->watermark(5,8)
                    ->round(10)
                    ->save($smal_des.$upload_data2[$i]['file_name'],true)
            // Medium
                    ->make_watermark_text("BeliOnderdil.com", $font, 18, "#CC6100")
                    ->stretch($medi_w,$medi_h)
                   
                    ->watermark(5,8)
                    ->round(10)
                    ->save($medi_des.$upload_data2[$i]['file_name'],true)
                    
          
                                         
                   /*
                    ->set_background_colour("#49F")
                    ->resize($medi_w,$medi_h,TRUE)
                    ->save($medi_des . 'colour_'.$upload_data2[$i]['file_name'])
                    * 
                    ->resize_crop(150,150)
                    ->border(5, "#ffffff")
                    ->border(1, "#000000")
                    ->save($medi_des . 'border_'.$upload_data2[$i]['file_name'])
                    * 
                    ->resize_crop($medi_w,$medi_h)
                    ->round(10)
                    ->save($medi_des . 'corner_'.$upload_data2[$i]['file_name'])
                    * 
                    ->resize_crop($medi_w,$medi_h)
                    ->border_3d(5)
                    ->save($medi_des . '3d_'.$upload_data2[$i]['file_name'])
                    */
                    // ->clear()
                    ;
            
            $this->load->view("done_imageupload");
            
            if ($this->image_moo->errors) print $this->image_moo->display_errors();
            else 
            {
                $this->load->view("done_imageupload");
            }
            
              // langsung ubah pake library ci
              // $this->resize($upload_data2[$i]["file_name"]);
              // echo "DONE";
            }
        }
        else
        {    
            $this->index();
                        
            /*
            echo '<pre>';
            print_r($this->upload->get_multi_upload_data());
            echo '</pre>';
            */
        }
    }
    
    function resize($source)
    {                
        // For Thumbnail
        $config_thumb = array(
            "image_library"=>"gd2",
            "source_image"=>$this->real_path.'/'.$source,
            "new_image"=>'assets/doc/img/thumbnails/'.'/'.$source,
            "maintain_ratio"=>TRUE,
            "width"=>"62",
            "height"=>"62"
        );

        $this->image_lib->initialize($config_thumb);
        $this->image_lib->resize();
        $this->image_lib->clear();
        
        // For Small
        $config_small = array(
            "image_library"=>"gd2",
            "source_image"=>$this->real_path.'/'.$source,
            "new_image"=>'assets/doc/img/small/'.'/'.$source,
            "maintain_ratio"=>TRUE,
            "width"=>"152",
            "height"=>"152"
        );

        $this->image_lib->initialize($config_small);
        $this->image_lib->resize();
        $this->image_lib->clear();
        
        // For Medium
        $config_medium = array(
            "image_library"=>"gd2",
            "source_image"=>$this->real_path.'/'.$source,
            "new_image"=>'assets/doc/img/medium/'.'/'.$source,
            "maintain_ratio"=>TRUE,
            "width"=>"342",
            "height"=>"342"
        );

        $this->image_lib->initialize($config_medium);
        $this->image_lib->resize();
        $this->image_lib->clear();
        
        // For Full
        $config_full = array(
            "image_library"=>"gd2",
            "source_image"=>$this->real_path.'/'.$source,
            "new_image"=>'assets/doc/img/full/'.'/'.$source,
            "maintain_ratio"=>TRUE,
            "width"=>0,
            "height"=>0
        );

        $this->image_lib->initialize($config_full);
        $this->image_lib->resize();
        $this->image_lib->clear();
        
    }

    function watermarking($mr)
    {
        //$config['source_image'] = $gb;
        $upload_conf['image_library'] = 'gd2';
        $upload_conf['wm_text'] = 'belionderdil.com'; // tanda yang akan tercetak di gambar
        $upload_conf['wm_type'] = 'text';
        $upload_conf['source_image'] = $mr;
        $upload_conf['wm_font_path'] = 'assets/fonts/fontawesome-webfont.ttf'; //pastikan fontnya ada
        $upload_conf['wm_font_size'] = 40;
        $upload_conf['wm_font_color'] = '#B5622A';
        $upload_conf['wm_vrt_alignment'] = 'middle';
        $upload_conf['wm_hor_alignment'] = 'center';
        $upload_conf['wm_padding'] = 5;
        $upload_conf['thumb_marker'] = '_water';
        $upload_conf['wm_opacity'] = 5;
        $upload_conf['wm_shadow_color'] = 333333;

        $this->image_lib->initialize($upload_conf);
        $this->image_lib->watermark();
    }

}

/* End of File: imageupload.php */