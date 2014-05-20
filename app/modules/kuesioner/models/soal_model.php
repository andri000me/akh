<?php

/* * *************************************************************************************
 *                       		soal_model.php
 * **************************************************************************************
 *      Author:     	Topidesta as Shabiki <m.desta.fadilah@hotmail.com>
 *      Website:    	http://www.twitter.com/emang_dasar
 *
 *      File:          	soal_model
 *      Created:   	13:54:07 27 Jan 14
 *      Copyright:  	(c) 2014 - JohnDoe
 *                  	DON'T BE A DICK PUBLIC LICENSE
 * 			Version 1, December 2009
 * 			Copyright (C) 2009 Philip Sturgeon
 *
 * ************************************************************************************** */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Soal_model extends MY_Model {

    public $_table = "banksoal";




    /*
    function addSoal() {
        $data = array(
            'soal' => $soal,
        );

        $this->db->set('brands_name', $data['brands_name']);
        $this->db->insert('brands', $data);
    }

    function deleteSoal($banksoal_id) {
        $this->db->where($banksoal_id);
        $this->db->delete('banksoal');
        if ($this->db->affected_rows() == '1') {
            return TRUE;
        }
        return FALSE;
    }

    function findSoalAll() {
        // $query = $this->db->query("select * from banksoal LIMIT $limit,$offset");
        $query = $this->db
                ->select('*')
                ->from('banksoal')
                //->limit($limit, $offset)
                ->get();

        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $data) {
                $soals[] = $data;
            }
            return $soals;
        }
    }

    function findSoalById($banksoal_id = '') {
        $banksoal = $this->db
                ->select('*')
                ->from('banksoal')
                ->where('banksoal', $banksoal_id)
                ->get()
                ->result();

        return $banksoal;
    }

    function findSoalDetail($banksoal_id) {
        return $banksoal;
    }
*/
}

/* End of File: soal_model.php */