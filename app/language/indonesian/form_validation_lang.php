<?php

/* * *************************************************************************************
 *                       		form_validation_lang.php
 * **************************************************************************************
 *      Author:     	Topidesta as Shabiki <m.desta.fadilah@hotmail.com>
 *      Website:    	http://www.twitter.com/emang_dasar
 *
 *      File:          	form_validation_lang
 *      Created:   	15 Feb 14 16:35:08 WIB
 *      Copyright:  	(c) 2012 - desta
 *                  	DON'T BE A DICK PUBLIC LICENSE
 * 			Version 1, December 2009
 * 			Copyright (C) 2009 Philip Sturgeon
 *      source:         https://github.com/tvalentius/MarsColony/blob/master/MarsColony/application/language/indonesia/form_validation_lang.php
 * 
 * ************************************************************************************** */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

$lang['required']			= "Kolom %s harus diisi.";
$lang['isset']				= "Kolom %s harus memiliki nilai.";
$lang['valid_email']                    = "Kolom %s harus merupakan alamat email yang valid.";
$lang['valid_emails']                   = "Kolom %s harus merupakan sebuah alamat email yang valid.";
$lang['valid_url']			= "Kolom %s harus merupakan URL yang valid.";
$lang['valid_ip']			= "Kolom %s harus merupakan IP yang valid.";
$lang['min_length']			= "Kolom %s harus sedikitnya memiliki karakter sebanyak %s.";
$lang['max_length']			= "Kolom %s tidak boleh lebih dari %s karakter.";
$lang['exact_length']                   = "Kolom %s harus memiliki jumlah karakter %s.";
$lang['alpha']				= "Kolom %s hanya boleh berisi karakter huruf.";
$lang['alpha_numeric']                  = "Kolom %s hanya boleh berisi karakter huruf dan angka .";
$lang['alpha_dash']			= "Kolom %s hanya boleh berisi karakter huruf, angka, 'underscores' dan 'dashes'.";
$lang['numeric']			= "Kolom %s hanya boleh berisi angka.";
$lang['is_numeric']			= "Kolom %s harus berisi hanya karakter angka.";
$lang['integer']			= "Kolom %s harus merupakan 'integer'.";
$lang['regex_match']                    = "Kolom %s tidak memiliki format yang cocok.";
$lang['matches']			= "Kolom %s tidak cocok dengan kolom %s.";
$lang['is_natural']			= "Kolom %s hanya boleh berisi nomor positif.";
$lang['is_natural_no_zero']             = "Kolom %s harus merupakan angka lebih dari 0.";
$lang['decimal']			= "Kolom %s harus merupakan angka desimal.";
$lang['less_than']			= "Kolom %s harus lebih kecil dari %s.";
$lang['greater_than']                   = "Kolom %s harus lebih besar dari %s.";

/* End of File: form_validation_lang.php */