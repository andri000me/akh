<?php

/* * *************************************************************************************
 *                       		dokumen_model.php
 * **************************************************************************************
 *      Author:     	Topidesta as Shabiki <m.desta.fadilah@hotmail.com>
 *      Website:    	http://www.twitter.com/emang_dasar
 *
 *      File:          	dokumen_model
 *      Created:   	28 Mar 14 19:36:35 WIB
 *      Copyright:  	(c) 2012 - desta
 *                  	DON'T BE A DICK PUBLIC LICENSE
 * 			Version 1, December 2009
 * 			Copyright (C) 2009 Philip Sturgeon
 *
 * ************************************************************************************** */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dokumen_model extends CI_Model
{
    private $table = "dokumen";
    //put your code here
    //public $_table = 'dokumen';
    
    public function countAll()
    {
        return $this->db->count_all($this->table);
    }
    public function getAll()
    {
        // 
        return $this->db->order_by('created','desc')->get($this->table);
    }
       
    public function getOne($doc_name = false)
    {
        return $this->db->where('tmp_name', $doc_name)->get($this->table)->row();
    }
    
    public function save($id = false)
    {
        foreach ($_POST as $key => $val)
        {
            $data[$key] = $this->input->post($key);
        }
        
        if ($id == false)
        {
            // Insert
            $this->db->insert($this->table, $data);
            return $this->db->insert_id();
        }
        else
        {
            // Update
            $this->db->where('id', $id);
            $this->db->update($this->table, $data);
            return $this->db->affected_rows();
        }
    }
}

/* End of File: dokumen_model.php */