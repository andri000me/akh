<?php

/* * *************************************************************************************
 *                       		aplikasi_model.php
 * **************************************************************************************
 *      Author:     	Topidesta as Shabiki <m.desta.fadilah@hotmail.com>
 *      Website:    	http://www.twitter.com/emang_dasar
 *
 *      File:          	aplikasi_model
 *      Created:   	13:30:38 18 Feb 14
 *      Copyright:  	(c) 2014 - JohnDoe
 *                  	DON'T BE A DICK PUBLIC LICENSE
 * 			Version 1, December 2009
 * 			Copyright (C) 2009 Philip Sturgeon
 *
 * ************************************************************************************** */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Aplikasi_model extends CI_Model {

    private $table = "aplikasi";

    /*
      public $_table = 'aplikasi';

      public $belongs_to = array (
      'user' => array( 'model' => 'user_model', 'primary_key' => 'id'),
      'warna' => array( 'model' => 'warna_model', 'primary_key' => 'id'));

      public $has_many = array (
      'galeri' => array( 'model' => 'galeri_model', 'primary_key' => 'id' ));
     */
    
    function count_all()
    {
        return $this->db->count_all($this->table);
    }

    /*
     * Get an object or array
     * 
     * @param array
     * @acces $id
     */
    function getOne($id)
    {
        return $this->db->where("id", $id)->get($this->table)->row_array();
    }

    function getAll($limit, $offset=0)
    {
        /*
         *  INNER JOIN warna ON aplikasi.warna = warna.id
            INNER JOIN users ON aplikasi.user_id = users.id
            INNER JOIN galeri ON aplikasi.galeri = galeri.id
            INNER JOIN modul ON galeri.modul_id = modul.id
         */
        $this->db->select('*,aplikasi.id AS id_aplikasi');
        $this->db->from($this->table);
        $this->db->join('warna','aplikasi.warna = warna.id');
        $this->db->join('users','aplikasi.user_id = users.id');
        $this->db->join('galeri','aplikasi.galeri = galeri.id');
        $this->db->join('modul','galeri.modul_id = modul.id');
        
        return $this->db->limit($limit,$offset)->get();
        
    }

    /*
     * Insert or Update function
     * 
     * @access array
     * @params $id
     */

    function save($id = FALSE)
    {
        // Kita pecah setiap variable menjadi data
        foreach ($_POST as $key => $val) {
            $data[$key] = $this->input->post($key);
        }

        // Insert
        if ($id == false)
        {
            $this->db->insert($this->table, $data);
            return $this->db->insert_id();
        }
        else
        {
            // Update
            $this->db->where("id", $id);
            $this->db->update($this->table, $data);
            return $this->db->affected_rows();
        }
    }

    function delete($id)
    {
        // Do your jobs
        $this->db->where("id", $id)->delete($this->table);

        // Give some rollback table
        if ($this->db->affected_rows())
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

}

/* End of File: aplikasi_model.php */