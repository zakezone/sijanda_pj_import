<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Import extends CI_Controller
{
	public function index()
	{
		$this->load->view('menu');
	}

	public function import1()
	{
		$this->load->model('Import_model');
		$data['tab'] = $this->Import_model->getdata_periode1_2022();

		$this->load->view('import_1', $data);
	}

	public function importperiode1()
	{
		if (isset($_POST['importnow'])) {
			$file_excel = $_FILES['importexcel']['name'];
			$ext = pathinfo($file_excel, PATHINFO_EXTENSION);
			if ($ext == 'xls') {
				$render = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
			} else {
				$render = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
			}

			$spreadsheet = $render->load($_FILES['importexcel']['tmp_name']);
			$data = $spreadsheet->getActiveSheet()->toArray();
			// echo '<pre>';
			// print_r($data);
			foreach ($data as $x => $row) {
				if ($x == 0) {
					continue;
				}
				$dataimport = [
					'periode' => $row[0],
					'bulan' => $row[1],
					'tahun' => $row[2],
					'kd_kab' => $row[3],
					'kab_kota' => $row[4],
					'wajib_ktp_el' => $row[5]
				];
				$this->load->model('Import_model');
				$this->Import_model->import_periode1($dataimport);
			}
			$this->session->set_flashdata('message', 'Data <b>berhasil</b> diimport ke database');
			redirect('import/import1');
		}
	}

	public function import2()
	{
		$this->load->model('Import_model');
		$data['tab'] = $this->Import_model->getdata_periode2_2022();

		$this->load->view('import_2', $data);
	}

	public function importperiode2()
	{
		if (isset($_POST['importnow'])) {
			$file_excel = $_FILES['importexcel']['name'];
			$ext = pathinfo($file_excel, PATHINFO_EXTENSION);
			if ($ext == 'xls') {
				$render = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
			} else {
				$render = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
			}

			$spreadsheet = $render->load($_FILES['importexcel']['tmp_name']);
			$data = $spreadsheet->getActiveSheet()->toArray();
			// echo '<pre>';
			// print_r($data);
			foreach ($data as $x => $row) {
				if ($x == 0) {
					continue;
				}
				$dataimport = [
					'periode' => $row[0],
					'bulan' => $row[1],
					'tahun' => $row[2],
					'kd_kab' => $row[3],
					'kab_kota' => $row[4],
					'wajib_ktp_el' => $row[5]
				];
				$this->load->model('Import_model');
				$this->Import_model->import_periode2($dataimport);
			}
			$this->session->set_flashdata('message', 'Data <b>berhasil</b> diimport ke database');
			redirect('import/import2');
		}
	}
}
