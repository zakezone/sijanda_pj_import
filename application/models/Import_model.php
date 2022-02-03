<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Import_model extends CI_Model
{
    public function getdata_periode1_2022()
    {
        $this->db->select('*');
        $this->db->from('rekap_pj_jateng');
        $this->db->where('periode', 1);
        $this->db->where('bulan', strtolower(date('F')));
        $this->db->where('tahun', date('Y'));
        $query = $this->db->get();
        return $query->result();
    }

    public function import_periode1($dataimport)
    {
        $data = count($dataimport);
        if ($data > 0) {
            $this->db->replace('rekap_pj_jateng', $dataimport);
        } else {
            $this->db->insert('rekap_pj_jateng', $dataimport);
        }
    }

    public function getdata_periode2_2022()
    {
        $this->db->select('*');
        $this->db->from('rekap_pj_jateng');
        $this->db->where('periode', 2);
        $this->db->where('bulan', strtolower(date('F')));
        $this->db->where('tahun', date('Y'));
        $query = $this->db->get();
        return $query->result();
    }

    public function import_periode2($dataimport)
    {
        $data = count($dataimport);
        if ($data > 0) {
            $this->db->replace('rekap_pj_jateng', $dataimport);
        } else {
            $this->db->insert('rekap_pj_jateng', $dataimport);
        }
    }
}
