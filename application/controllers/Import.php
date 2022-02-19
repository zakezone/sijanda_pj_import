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
			$total = 0;
			foreach ($data as $x => $row) {
				$totaldata = $total + $x;
				if ($x == 0) {
					continue;
				}
				$dataimport = [
					'kd_kab' => $row[0],
					'kab_kota' => $row[1],
					'wajib_ktp_el' => $row[2],
					'created' => time()
				];
				$this->load->model('Import_model');
				$this->Import_model->import_periode1($dataimport);
			}
			$periode = 1;
			$bulan = $this->input->post('bulan', true);
			$tahun = date("Y");
			$jumlah = $totaldata;
			for ($x = 1; $x <= $jumlah; $x++) {
				$datainsert = [
					'periode' => $periode,
					'bulan' => $bulan,
					'tahun' => $tahun
				];
				$this->load->model('Import_model');
				$this->Import_model->import_periode1atr($datainsert, time());
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
			$total = 0;
			foreach ($data as $x => $row) {
				$totaldata = $total + $x;
				if ($x == 0) {
					continue;
				}
				$dataimport = [
					'kd_kab' => $row[0],
					'kab_kota' => $row[1],
					'wajib_ktp_el' => $row[2],
					'created' => time()
				];
				$this->load->model('Import_model');
				$this->Import_model->import_periode2($dataimport);
			}
			$periode = 2;
			$bulan = $this->input->post('bulan', true);
			$tahun = date("Y");
			$jumlah = $totaldata;
			for ($x = 1; $x <= $jumlah; $x++) {
				$datainsert = [
					'periode' => $periode,
					'bulan' => $bulan,
					'tahun' => $tahun
				];
				$this->load->model('Import_model');
				$this->Import_model->import_periode2atr($datainsert, time());
			}
			$this->session->set_flashdata('message', 'Data <b>berhasil</b> diimport ke database');
			redirect('import/import2');
		}
	}
}
