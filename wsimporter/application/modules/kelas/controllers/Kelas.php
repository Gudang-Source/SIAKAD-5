<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelas extends CI_Controller {

	//private $data;
	private $limit;
	private $filter;
	private $order;
	private $offset;
	private $table1;
	private $table2;
	private $table3;
	private $template;
	private $dir_ws;
	private $host_ws;
	private $port_ws;

	public function __construct()
	{
		parent::__construct();
		// if (!$this->session->userdata('login')) {
		// 	redirect('ws');
		// }
		// else {
			$this->limit = $this->config->item('limit');
			$this->filter = $this->config->item('filter');
			$this->order = $this->config->item('order');
			$this->offset = $this->config->item('offset');
			$this->table1 = 'kelas_kuliah';
			$this->table2 = 'nilai';
			$this->table3 = 'ajar_dosen';
			$this->load->model('m_feeder','feeder');
			$this->load->model('App_model');
			$this->load->helper('csv');
			$this->load->library('excel');
			$this->template = './template/kelas_template.xlsx';

			$config['upload_path'] = $this->config->item('upload_path');
			$config['allowed_types'] = $this->config->item('upload_tipe');
			$config['max_size'] = $this->config->item('upload_max_size');
			$config['encrypt_name'] = TRUE;

			$this->load->library('upload',$config);

			$temp_setting = read_file('setting.ini');
			$pecah = explode('#', $temp_setting);
			$this->dir_ws = $pecah[1];
			$this->host_ws = parse_url($this->dir_ws, PHP_URL_HOST);
			$this->port_ws = parse_url($this->dir_ws, PHP_URL_PORT);
			$ping = ping($this->host_ws,$this->port_ws);
		// 	if (!$ping) {
		// 		show_error('Error, Tidak bisa menghubungi server Feeder. Jika Server Feeder berada di LAN/Internet, silahkan check koneksi LAN atau koneksi Internet Anda');
		// 	}
		// }
	}

	public function index(){
		$this->kelas();
	}

	public function sync_all_nilai($nim,$ta)
	{
		$temp_data = array();
		$temp_data2 = array();
		$id_reg_pd = array();
		$sukses_count = 0;
		$sukses_msg = '';
		$error_count = 0;
		$error_msg = array();
		$error_nim = array();
		$array = array();
		$data_nilai = $this->App_model->get_query("SELECT * FROM v_sync_nilai m1 WHERE m1.nim=".$nim." AND m1.ta=".$ta)->result();
		foreach ($data_nilai as $key) {
			$nim = $key->nim;
			$kode_mk = $key->kode_mk;
			$smt = $key->ta;
			$kls = $key->nm_kelas;
			$kode_prodi = $key->id_prodi;

			$filter_sms = "p.id_sp='".$this->session->userdata('id_sp')."' AND p.kode_prodi='".$kode_prodi."'";
			$temp_sms = $this->feeder->getrecord($this->session->userdata('token'),'sms',$filter_sms);
			if ($temp_sms['result']) {
				$id_sms = $temp_sms['result']['id_sms'];
			}
			// echo json_encode($temp_sms);
			$filter_mk = "p.kode_mk='".$kode_mk."' AND p.id_sms='".$id_sms."'";
			$temp_mk = $this->feeder->getrecord($this->session->userdata('token'),'mata_kuliah',$filter_mk);
			if ($temp_mk['result']) {
				$id_mk = $temp_mk['result']['id_mk'];
			}

			$filter_mhs = "nipd like '%".$nim."%'";
			$temp_mhs = $this->feeder->getrecord($this->session->userdata('token'),'mahasiswa_pt',$filter_mhs);
			if ($temp_mhs['result']) {
				$id_reg_pd = $temp_mhs['result']['id_reg_pd'];
			}

			//Filter id_kls
			$filter_kls = "p.id_mk='".$id_mk."' AND p.id_smt='".$smt."' AND nm_kls='".$kls."'";
			$temp_kls = $this->feeder->getrecord($this->session->userdata('token'),'kelas_kuliah',$filter_kls);
			if ($temp_kls['result']) {
				$id_kls = $temp_kls['result']['id_kls'];
			}

			//inisial data
			$temp_key = array('id_kls' => $id_kls,
									'id_reg_pd' => $id_reg_pd
							);
			$temp_data = array('nilai_angka' => $key->nilai_angka,
								'nilai_huruf' => $key->nilai_huruf,
								'nilai_indeks' => $key->nilai_index
							);
			$array[] = array('key'=>$temp_key,'data'=>$temp_data);
		}

		$result_db = true;//$this->model_user->insertRecord('tb_nilai',$input_nilai_db);
		if ($result_db == true){
			$temp_result = $this->feeder->updaterset($this->session->userdata('token'),$this->table2,$array);
			$this->benchmark->mark('selesai');
			$time_eks = $this->benchmark->elapsed_time('mulai', 'selesai');
			$i=0;
			if ($temp_result['result']) {
				foreach ($temp_result['result'] as $key) {
					++$i;
					if ($key['error_desc']==NULL) {
						++$sukses_count;
					} else {
						++$error_count;
						$error_msg[] = "<h4>Error baris ".$i."</h4>".$key['error_desc'];
					}
				}
			} else {
				echo "<div class=\"bs-callout bs-callout-danger\"><h4>Error ".$temp_result['error_code']."</h4>".$temp_result['error_desc']."</div></div>";
			}

			if ((!$sukses_count==0) || (!$error_count==0)) {
				echo "<div class=\"alert alert-warning\" role=\"alert\">
						Waktu eksekusi ".$time_eks." detik<br />
						Results (total ".$i." baris data):<br /><font color=\"#3c763d\">".$sukses_count." data nilai berhasil diupdate</font><br />
						<font color=\"#ce4844\" >".$error_count." data error (tidak bisa diupdate) </font>";
						if (!$error_count==0) {
							echo "<a data-toggle=\"collapse\" href=\"#collapseExample\" aria-expanded=\"false\" aria-controls=\"collapseExample\">Detail error</a>";
						}
						//echo "<br />Total: ".$i." baris data";
						echo "<div class=\"collapse\" id=\"collapseExample\">";
								foreach ($error_msg as $pesan) {
										echo "<div class=\"bs-callout bs-callout-danger\">".$pesan."</div><br />";
									}
						echo "</div>
					</div>";
			}
		}
		else {
			$error_msg[] = "Data Tidak Tersimpan";
		}
	}

	public function sync_one_nilai($id)
	{

		$temp_data = array();
		$temp_data2 = array();
		$id_reg_pd = array();
		$sukses_count = 0;
		$sukses_msg = '';
		$error_count = 0;
		$error_msg = array();
		$error_nim = array();
		$array = array();
		$data_nilai = $this->App_model->get_query("SELECT * FROM v_sync_nilai m1 WHERE m1.id_nilai=".$id)->row();
		$nim = $data_nilai->nim;
		$kode_mk = $data_nilai->kode_mk;
		$smt = $data_nilai->ta;
		$kls = $data_nilai->nm_kelas;
		$kode_prodi = $data_nilai->id_prodi;

		$filter_sms = "p.id_sp='".$this->session->userdata('id_sp')."' AND p.kode_prodi='".$kode_prodi."'";
		$temp_sms = $this->feeder->getrecord($this->session->userdata('token'),'sms',$filter_sms);
		if ($temp_sms['result']) {
			$id_sms = $temp_sms['result']['id_sms'];
		}
		// echo json_encode($temp_sms);
		$filter_mk = "p.kode_mk='".$kode_mk."' AND p.id_sms='".$id_sms."'";
		$temp_mk = $this->feeder->getrecord($this->session->userdata('token'),'mata_kuliah',$filter_mk);
		if ($temp_mk['result']) {
			$id_mk = $temp_mk['result']['id_mk'];
		}

		$filter_mhs = "nipd like '%".$nim."%'";
		$temp_mhs = $this->feeder->getrecord($this->session->userdata('token'),'mahasiswa_pt',$filter_mhs);
		if ($temp_mhs['result']) {
			$id_reg_pd = $temp_mhs['result']['id_reg_pd'];
		}

		//Filter id_kls
		$filter_kls = "p.id_mk='".$id_mk."' AND p.id_smt='".$smt."' AND nm_kls='".$kls."'";
		$temp_kls = $this->feeder->getrecord($this->session->userdata('token'),'kelas_kuliah',$filter_kls);
		if ($temp_kls['result']) {
			$id_kls = $temp_kls['result']['id_kls'];
		}

		//inisial data
		$temp_key = array('id_kls' => $id_kls,
								'id_reg_pd' => $id_reg_pd
						);
		$temp_data = array('nilai_angka' => $data_nilai->nilai_angka,
							'nilai_huruf' => $data_nilai->nilai_huruf,
							'nilai_indeks' => $data_nilai->nilai_index
						);
		$array[] = array('key'=>$temp_key,'data'=>$temp_data);
		$result_db = true;//$this->model_user->insertRecord('tb_nilai',$input_nilai_db);
		if ($result_db == true){
			$temp_result = $this->feeder->updaterset($this->session->userdata('token'),$this->table2,$array);
			$this->benchmark->mark('selesai');
			$time_eks = $this->benchmark->elapsed_time('mulai', 'selesai');
			$i=0;
			if ($temp_result['result']) {
				foreach ($temp_result['result'] as $key) {
					++$i;
					if ($key['error_desc']==NULL) {
						++$sukses_count;
					} else {
						++$error_count;
						$error_msg[] = "<h4>Error baris ".$i."</h4>".$key['error_desc'];
					}
				}
			} else {
				echo "<div class=\"bs-callout bs-callout-danger\"><h4>Error ".$temp_result['error_code']."</h4>".$temp_result['error_desc']."</div></div>";
			}

			if ((!$sukses_count==0) || (!$error_count==0)) {
				echo "<div class=\"alert alert-warning\" role=\"alert\">
						Waktu eksekusi ".$time_eks." detik<br />
						Results (total ".$i." baris data):<br /><font color=\"#3c763d\">".$sukses_count." data nilai berhasil diupdate</font><br />
						<font color=\"#ce4844\" >".$error_count." data error (tidak bisa diupdate) </font>";
						if (!$error_count==0) {
							echo "<a data-toggle=\"collapse\" href=\"#collapseExample\" aria-expanded=\"false\" aria-controls=\"collapseExample\">Detail error</a>";
						}
						//echo "<br />Total: ".$i." baris data";
						echo "<div class=\"collapse\" id=\"collapseExample\">";
								foreach ($error_msg as $pesan) {
										echo "<div class=\"bs-callout bs-callout-danger\">".$pesan."</div><br />";
									}
						echo "</div>
					</div>";
			}
		}
		else {
			$error_msg[] = "Data Tidak Tersimpan";
		}
	}

	public function data_nilai_akademik($nim,$ta)
	{
		$data_mhs_nilai = $this->App_model->get_query("SELECT * FROM v_sync_nilai m1 WHERE m1.nim='".$nim."' AND m1.ta=".$ta)->result();
		$data_mhs_nilai_count = $this->App_model->get_query("SELECT COUNT(*) AS jumlah_data FROM v_sync_nilai m1 WHERE m1.nim='".$nim."' AND m1.ta=".$ta)->row();
		$data_mhs = $this->App_model->get_query("SELECT * FROM tb_mhs m1 WHERE m1.nim='".$nim."'")->row();
		$berhasil=0;
		$gagal=0;
		foreach ($data_mhs_nilai as $key) {
			if ($key->status_upload == 'N') {
				$gagal++;
			}
			else {
				$berhasil++;
			}
		}
		$data['jumlah_data'] = $data_mhs_nilai_count->jumlah_data;
		$data['gagal']=$gagal;
		$data['berhasil']=$berhasil;
		$data['nim']=$nim;
		$data['ta']=$ta;
		$data['data_mhs_nilai']= $data_mhs_nilai;
		$data['data_mhs']= $data_mhs;
		$data['site_title'] = 'KRS';
		$data['title_page'] = 'Nilai Studi Mahasiswa';
		$data['ket_page'] = 'Melihat Seluruh Nilai Studi Mahasiswa Periode '.$ta;
		$data['assign_js'] = 'js/kelas_dt.js';
		$data['assign_modal'] = '';
		tampil('view_nilai',$data);
	}

	public function view_data($ta){
		$data_mhs_ti = $this->App_model->get_query("SELECT * FROM v_sync_data_krs m1 WHERE m1.status_upload='N' AND (m1.ta=20161 AND m1.id_prodi=55201) GROUP BY m1.nim")->result();
		$data_mhs_si = $this->App_model->get_query("SELECT * FROM v_sync_data_krs m1 WHERE m1.status_upload='N' AND (m1.ta=20161 AND m1.id_prodi=57201) GROUP BY m1.nim")->result();
		$data['data_mhs_ti']= $data_mhs_ti;
		$data['data_mhs_si']= $data_mhs_si;
		$data['site_title'] = 'mahasiswa';
		$data['title_page'] = 'Data Mahasiswa Aktif Periode '.$ta;
		$data['ket_page'] = 'Mencari Data Mahasiswa Berdasarkan Periode Kurikulum Berjalan '.$ta;
		$data['assign_js'] = 'js/kelas_dt.js';
		$data['assign_modal'] = '';
		tampil('view_data_akademik',$data);
	}

	public function view_data_krs($nim,$ta)
	{
		$data_mhs_krs = $this->App_model->get_query("SELECT * FROM v_sync_data_krs m1 WHERE m1.nim='".$nim."' AND m1.ta=".$ta)->result();
		$data_mhs_krs_count = $this->App_model->get_query("SELECT COUNT(*) AS jumlah_data FROM v_sync_data_krs m1 WHERE m1.nim='".$nim."' AND m1.ta=".$ta)->row();
		$data_mhs = $this->App_model->get_query("SELECT * FROM tb_mhs m1 WHERE m1.nim='".$nim."'")->row();
		$berhasil=0;
		$gagal=0;
		foreach ($data_mhs_krs as $key) {
			if ($key->status_upload == 'N') {
				$gagal++;
			}
			else {
				$berhasil++;
			}
		}
		$data['jumlah_data'] = $data_mhs_krs_count->jumlah_data;
		$data['gagal']=$gagal;
		$data['berhasil']=$berhasil;
		$data['nim']=$nim;
		$data['ta']=$ta;
		$data['data_mhs_krs']= $data_mhs_krs;
		$data['data_mhs']= $data_mhs;
		$data['site_title'] = 'KRS';
		$data['title_page'] = 'Kartu Rencana Studi Mahasiswa';
		$data['ket_page'] = 'Melihat Seluruh Kartu Rencana Studi Mahasiswa Periode '.$ta;
		$data['assign_js'] = 'js/kelas_dt.js';
		$data['assign_modal'] = '';
		tampil('view_krs',$data);
	}

	public function sync_krs_all($nim)
	{
		$sukses_count = 0;
		$error_count = 0;
		$error_msg = array();
		$sukses_msg = array();
		$temp_data = array();
		$data_krs = $this->App_model->get_query("SELECT * FROM v_sync_data_krs m1 WHERE m1.nim=".$nim." AND m1.status_upload='N'")->result();
		foreach ($data_krs as $key) {
			$filter_kls = "nm_kls='".$key->nm_kelas."'";
			$temp_kls = $this->feeder->getrset($this->session->userdata('token'),$this->table1,$filter_kls,strpost($this->session->userdata('id_sp'),$key->id_prodi,$key->id_matkul,$key->nm_kelas,$key->ta,$key->nim),'','');
			if ($temp_kls['result']) {
				foreach ($temp_kls['result'] as $row) {
					$temp_data['id_kls'] = $row['id_kls'];
					$temp_data['id_reg_pd'] = $row['id_reg_pd'];
					$temp_data['asal_data'] = 9;
				}
			}
			$temp_result = $this->feeder->insertrecord($this->session->userdata['token'], $this->table2, $temp_data);
			// echo json_encode($temp_result)."<br>";
			if ($temp_result['result']) {
				if ($temp_result['result']['error_desc']==NULL) {
					++$sukses_count;
					$sukses_msg = "<h4>Sukses</h4>KRS Mahasiswa <strong>".$key->nm_mhs."</strong> / <strong>".$key->nim."</strong> mata kuliah <strong>".$key->id_matkul."</strong> - <strong>".$key->nm_mk."</strong> berhasil ditambahkan";
					$data_edit = array('status_upload' => 'Y');
					$this->App_model->update('tb_mhs_data_krs','id_data_krs',$id,$data_edit);
					echo $sukses_msg;
				} else {
					++$error_count;
					$error_msg = "<h4>Error ".$temp_result['result']['error_code']." (".$key->nm_mhs." / ".$key->nm_mk.")</h4>".$temp_result['result']['error_desc'];
					echo $error_msg;
				}
			}
			else {
				echo "<div class='bs-callout bs-callout-danger'><h4>Error ".$temp_result['error_code']."</h4>".$temp_result['error_desc']."</div></div>";
				break;
			}
		}
	}

	public function sync_data_krs($id)
	{
		$temp_data = array();
		$sukses_count = 0;
		$error_count = 0;
		$error_msg = array();
		$sukses_msg = array();

		$data_krs = $this->App_model->get_query("SELECT * FROM v_sync_data_krs m1 WHERE m1.id_data_krs=".$id)->row();
		$filter_kls = "nm_kls='".$data_krs->nm_kelas."'";
		$temp_kls = $this->feeder->getrset($this->session->userdata('token'),$this->table1,$filter_kls,strpost($this->session->userdata('id_sp'),$data_krs->id_prodi,$data_krs->id_matkul,$data_krs->nm_kelas,$data_krs->ta,$data_krs->nim),'','');
		if ($temp_kls['result']) {
			foreach ($temp_kls['result'] as $row) {
				$id_kls = $row['id_kls'];
				$id_reg_pd = $row['id_reg_pd'];
			}
		}

		$temp_data['id_kls'] = $id_kls;
		$temp_data['id_reg_pd'] = $id_reg_pd;
		$temp_data['asal_data'] = 9;
		$temp_result = $this->feeder->insertrecord($this->session->userdata['token'], $this->table2, $temp_data);
		//var_dump($temp_result);
		if ($temp_result['result']) {
			if ($temp_result['result']['error_desc']==NULL) {
				++$sukses_count;
				$sukses_msg = "<h4>Sukses</h4>KRS Mahasiswa <strong>".$data_krs->nm_mhs."</strong> / <strong>".$data_krs->nim."</strong> mata kuliah <strong>".$data_krs->id_matkul."</strong> - <strong>".$data_krs->nm_mk."</strong> berhasil ditambahkan";
				$data_edit = array('status_upload' => 'Y');
				$this->App_model->update('tb_mhs_data_krs','id_data_krs',$id,$data_edit);
				echo $sukses_msg;
			} else {
				++$error_count;
				$error_msg = "<h4>Error ".$temp_result['result']['error_code']." (".$data_krs->nm_mhs." / ".$data_krs->nm_mk.")</h4>".$temp_result['result']['error_desc'];
				echo json_encode($error_msg);
			}
		} else {
			//echo "<div class=\"alert alert-danger\" role=\"alert\"><h4>Error ".$temp_result['error_code']."</h4>".$temp_result['error_desc']."</div>";
			echo "<div class='bs-callout bs-callout-danger'><h4>Error ".$temp_result['error_code']."</h4>".$temp_result['error_desc']."</div></div>";
			break;
		}
	}

	public function kelas(){
		$temp_rec = $this->feeder->getrecord($this->session->userdata('token'), $this->table1, $this->filter);
		$temp_sp = $this->session->userdata('id_sp');
		if (($temp_rec['error_desc']=='') && ($temp_sp=='') ){
			$this->session->set_flashdata('error','Kode PT Anda tidak ditemukan, silahkan masukkan kode PT anda dengan benar');
			redirect('welcome/setting');
		}

		$data['error_code'] = $temp_rec['error_code'];
		$data['error_desc'] = $temp_rec['error_desc'];
		$data['site_title'] = 'Kelas/Nilai Perkuliahan';
		$data['title_page'] = 'Kelas/Nilai Perkuliahan';
		$data['ket_page'] = 'Menyimpan jadwal/nilai perkuliahan yang di buka, dosen pengajar, serta peserta kelas / KRS mahasiswa setiap periode';
		$data['assign_js'] = 'js/kelas_dt.js';
		$data['assign_modal'] = '';
		tampil('kelas_view',$data);
	}

	public function nilai($id_kls='')	{
		if ($id_kls!='') {
			echo($id_kls);
		} else {
			redirect('kelas');
		}
	}

	public function createexcel()	{
		$this->benchmark->mark('mulai');
		if (!file_exists($this->template)) {
			echo "<div class=\"bs-callout bs-callout-danger\"><h4>Error</h4>File template tidak tersedia.</div>";
		} else {
			$data1 = array(array('kode_mk' => 'WS123',
						'mata_kuliah' => 'Mata Kuliah 1',
						'semester' => '20142',
						'kelas' => '01',
						'kode_prodi' => 55201,
						'nama_prodi' => 'Teknik Informatika'
					),
				  array('kode_mk' => 'WS456',
						'mata_kuliah' => 'Mata Kuliah 2',
						'semester' => '20142',
						'kelas' => '02',
						'kode_prodi' => 55201,
						'nama_prodi' => 'Teknik Informatika'
					),
				  array('kode_mk' => 'WS789',
						'mata_kuliah' => 'Mata Kuliah 3',
						'semester' => '20142',
						'kelas' => '01',
						'kode_prodi' => 57201,
						'nama_prodi' => 'Sistem Informasi'
					)
				);
			$data2 = array(array('nim' => '12345',
						'nama' => 'Mahasiswa 1',
						'kode_mk' => 'WS123',
						'mata_kuliah' => 'Mata Kuliah 1',
						'kelas' => '02',
						'semester' => '20142',
						'kode_prodi' => 57201,
						'nama_prodi' => 'Sistem Informasi'
					),
				  array('nim' => '45678',
						'nama' => 'Mahasiswa 2',
						'kode_mk' => 'WS456',
						'mata_kuliah' => 'Mata Kuliah 2',
						'kelas' => '02',
						'semester' => '20142',
						'kode_prodi' => 57201,
						'nama_prodi' => 'Sistem Informasi'
					),
				  array('nim' => '6789',
						'nama' => 'Mahasiswa 3',
						'kode_mk' => 'WS789',
						'mata_kuliah' => 'Mata Kuliah 3',
						'kelas' => '01',
						'semester' => '20142',
						'kode_prodi' => 57201,
						'nama_prodi' => 'Sistem Informasi'
					)
				);
			$data3 = array(array('nidn' => '12345',
						'dosen' => 'Dosen 1',
						'kode_mk' => 'WS123',
						'mata_kuliah' => 'Mata Kuliah 1',
						'kelas' => '01',
						'rencana_tm' => '16',
						'real_tm' => '16',
						'semester' => '20142',
						'kode_prodi' => 55201,
						'nama_prodi' => 'Teknik Informatika'
					),
				  array('nidn' => '34567',
						'dosen' => 'Dosen 2',
						'kode_mk' => 'WS456',
						'mata_kuliah' => 'Mata Kuliah 2',
						'kelas' => '02',
						'rencana_tm' => '16',
						'real_tm' => '16',
						'semester' => '20142',
						'kode_prodi' => 57201,
						'nama_prodi' => 'Sistem Informasi'
					),
				  array('nidn' => '56789',
						'dosen' => 'Dosen 3',
						'kode_mk' => 'WS789',
						'mata_kuliah' => 'Mata Kuliah 3',
						'kelas' => '01',
						'rencana_tm' => '16',
						'real_tm' => '16',
						'semester' => '20142',
						'kode_prodi' => 55201,
						'nama_prodi' => 'Teknik Informatika'
					)
				);
			$data4 = array(array('nim' => '12345',
						'nama' => 'Mahasiswa 1',
						'kode_mk' => 'WS123',
						'mata_kuliah' => 'Mata Kuliah 1',
						'semester' => '20142',
						'kelas' => '01',
						'nilai_angka' => 80,
						'nilai_huruf' => 'A',
						'nilai_indeks' => 4,
						'kode_prodi' => 57201,
						'nama_prodi' => 'Teknik Informatika'
					),
				  array('nim' => '23456',
						'nama' => 'Mahasiswa 2',
						'kode_mk' => 'WS456',
						'mata_kuliah' => 'Mata Kuliah 2',
						'semester' => '20142',
						'kelas' => '01',
						'nilai_angka' => 60,
						'nilai_huruf' => 'C',
						'nilai_indeks' => 2,
						'kode_prodi' => 57201,
						'nama_prodi' => 'Teknik Informatika'
					),
				  array('nim' => '34567',
						'nama' => 'Mahasiswa 3',
						'kode_mk' => 'WS789',
						'mata_kuliah' => 'Mata Kuliah 3',
						'semester' => '20142',
						'kelas' => '01',
						'nilai_angka' => 75,
						'nilai_huruf' => 'B',
						'nilai_indeks' => 3,
						'kode_prodi' => 57201,
						'nama_prodi' => 'Teknik Informatika'
					)
				);
			$objPHPExcel = PHPExcel_IOFactory::load($this->template);

			//SET SHEET Kelas
			$objPHPExcel->setActiveSheetIndex(0);
			$baseRow = 3;
			foreach($data1 as $r => $dataRow) {
				$row = $baseRow + $r;
				$objPHPExcel->getActiveSheet()->insertNewRowBefore($row,1);
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$row, $r+1)
									->setCellValue('B'.$row, $dataRow['kode_mk'])
									->setCellValue('C'.$row, $dataRow['mata_kuliah'])
									->setCellValue('D'.$row, $dataRow['semester'])
									->setCellValue('E'.$row, $dataRow['kelas'])
									->setCellValue('F'.$row, $dataRow['kode_prodi'])
									->setCellValue('G'.$row, $dataRow['nama_prodi']);
			}
			$objPHPExcel->getActiveSheet()->removeRow($baseRow-1,1);

			//SET SHEET krs
			$objPHPExcel->setActiveSheetIndex(1);
			$baseRow2 = 3;
			foreach($data2 as $r2 => $dataRow2) {
				$row2 = $baseRow2 + $r2;
				$objPHPExcel->getActiveSheet()->insertNewRowBefore($row2,1);
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$row2, $r2+1)
									->setCellValue('B'.$row2, $dataRow2['nim'])
									->setCellValue('C'.$row2, $dataRow2['nama'])
									->setCellValue('D'.$row2, $dataRow2['kode_mk'])
									->setCellValue('E'.$row2, $dataRow2['mata_kuliah'])
									->setCellValue('F'.$row2, $dataRow2['kelas'])
									->setCellValue('G'.$row2, $dataRow2['semester'])
									->setCellValue('H'.$row2, $dataRow2['kode_prodi'])
									->setCellValue('I'.$row2, $dataRow2['nama_prodi']);
			}
			$objPHPExcel->getActiveSheet()->removeRow($baseRow2-1,1);

			//SET SHEET dosen
			$objPHPExcel->setActiveSheetIndex(2);
			$baseRow3 = 3;
			foreach($data3 as $r3 => $dataRow3) {
				$row3 = $baseRow3 + $r3;
				$objPHPExcel->getActiveSheet()->insertNewRowBefore($row3,1);
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$row3, $r3+1)
									->setCellValue('B'.$row3, $dataRow3['nidn'])
									->setCellValue('C'.$row3, $dataRow3['dosen'])
									->setCellValue('D'.$row3, $dataRow3['kode_mk'])
									->setCellValue('E'.$row3, $dataRow3['mata_kuliah'])
									->setCellValue('F'.$row3, $dataRow3['kelas'])
									->setCellValue('G'.$row3, $dataRow3['rencana_tm'])
									->setCellValue('H'.$row3, $dataRow3['real_tm'])
									->setCellValue('I'.$row3, $dataRow3['semester'])
									->setCellValue('J'.$row3, $dataRow3['kode_prodi'])
									->setCellValue('K'.$row3, $dataRow3['nama_prodi']);
			}
			$objPHPExcel->getActiveSheet()->removeRow($baseRow3-1,1);

			//SET SHEET Nilai
			$objPHPExcel->setActiveSheetIndex(3);
			$baseRow4 = 3;
			foreach($data4 as $r4 => $dataRow4) {
				$row4 = $baseRow4 + $r4;
				$objPHPExcel->getActiveSheet()->insertNewRowBefore($row4,1);
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$row4, $r4+1)
									->setCellValue('B'.$row4, $dataRow4['nim'])
									->setCellValue('C'.$row4, $dataRow4['nama'])
									->setCellValue('D'.$row4, $dataRow4['kode_mk'])
									->setCellValue('E'.$row4, $dataRow4['mata_kuliah'])
									->setCellValue('F'.$row4, $dataRow4['semester'])
									->setCellValue('G'.$row4, $dataRow4['kelas'])
									->setCellValue('H'.$row4, $dataRow4['nilai_angka'])
									->setCellValue('I'.$row4, $dataRow4['nilai_huruf'])
									->setCellValue('J'.$row4, $dataRow4['nilai_indeks'])
									->setCellValue('K'.$row4, $dataRow4['kode_prodi'])
									->setCellValue('L'.$row4, $dataRow4['nama_prodi']);
			}
			$objPHPExcel->getActiveSheet()->removeRow($baseRow-1,1);

			$filename = time().'-template-kelas.xlsx';

			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
			//$objWriter->save('php://output');
			$temp_tulis = $objWriter->save('temps/'.$filename);
			$this->benchmark->mark('selesai');
			$time_eks = $this->benchmark->elapsed_time('mulai', 'selesai');
			if ($temp_tulis==NULL) {
				echo "<div class=\"bs-callout bs-callout-success\">
						File berhasil digenerate dalam waktu <strong>".$time_eks." detik</strong>. <br />Klik <a href=\"".base_url()."index.php/file/download/".$filename."\">disini</a> untuk download file
					</div>";
			} else {
				echo "<div class=\"bs-callout bs-callout-danger\">
						<h4>Error</h4>File tidak bisa digenerate. Folder 'temps' tidak ada atau tidak bisa ditulisi.
					</div>";
			}
		}
	}

	public function uploadexcel(){
		$this->benchmark->mark('mulai');
		if (!$this->upload->do_upload()) {
			echo "<div class=\"bs-callout bs-callout-danger\">".$this->upload->display_errors()."</div>";
		} else {
			$mode = $this->input->post('mode');
			$file_data = $this->upload->data();
			//var_dump($file_data);
			$file_path = $this->config->item('upload_path').$file_data['file_name'];
			//var_dump($file_path);
			$objPHPExcel = PHPExcel_IOFactory::load($file_path);
			switch ($mode) {
				case 0: //Kelas kuliah
					$objPHPExcel->setActiveSheetIndex(0);
					$cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
					$jml_row = $objPHPExcel->getActiveSheet()->getHighestRow()-1;
					//var_dump($cell_collection);
					foreach ($cell_collection as $cell) {
						$column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
						$row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
						$data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();

						if ($row == 1) {
							$header[$row][$column] = $data_value;
						} else {
							$arr_data[$row][$column] = $data_value;
						}
					}
					//var_dump($arr_data);
					if ($arr_data) {
						$id_sms = '';
						$id_mk = '';
						$sks_mk = '';
						$sks_tm = '';
						$sks_prak = '';
						$sks_prak_lap = '';
						$sks_sim = '';
						$temp_data = array();
						$sukses_count = 0;
						$error_count = 0;
						$error_msg = array();
						$sukses_msg = array();
						foreach ($arr_data as $key => $value) {
							$kode_mk = $value['B'];
							$nm_mk = $value['C'];
							$semester = trim($value['D']);
							$kelas = $value['E'];
							$kode_prodi = trim($value['F']);

							$filter_sms = "id_sp='".$this->session->userdata('id_sp')."' AND kode_prodi='".$kode_prodi."'";
							$temp_sms = $this->feeder->getrecord($this->session->userdata('token'),'sms',$filter_sms);
							if ($temp_sms['result']) {
								$id_sms = $temp_sms['result']['id_sms'];
							}

							$filter_mk = "p.kode_mk='".$kode_mk."' AND p.id_sms='".$id_sms."'";
							$temp_mk = $this->feeder->getrecord($this->session->userdata('token'),'mata_kuliah',$filter_mk);
							if ($temp_mk['result']) {
								$id_mk = $temp_mk['result']['id_mk'];
								$sks_mk = $temp_mk['result']['sks_mk'];
								$sks_tm = $temp_mk['result']['sks_tm']==''?'0':$temp_mk['result']['sks_tm'];
								$sks_prak = $temp_mk['result']['sks_prak']==''?'0':$temp_mk['result']['sks_prak'];
								$sks_prak_lap = $temp_mk['result']['sks_prak_lap']==''?'0':$temp_mk['result']['sks_prak_lap'];
								$sks_sim = $temp_mk['result']['sks_sim']==''?'0':$temp_mk['result']['sks_sim'];
							}
							$temp_data['id_sms'] = $id_sms;
							$temp_data['id_smt'] = $semester;
							$temp_data['id_mk'] = $id_mk;
							$temp_data['nm_kls'] = $kelas;
							$temp_data['sks_mk'] = $sks_mk;
							$temp_data['sks_tm'] = $sks_tm;
							$temp_data['sks_prak'] = $sks_prak;
							$temp_data['sks_prak_lap'] = $sks_prak_lap;
							$temp_data['sks_sim'] = $sks_sim;

							$temp_result = $this->feeder->insertrecord($this->session->userdata['token'], $this->table1, $temp_data);
							//var_dump($temp_result);
							if ($temp_result['result']) {
								if ($temp_result['result']['error_desc']==NULL) {
									++$sukses_count;
									$sukses_msg[] = "<h4>Sukses</h4>Kelas perkuliahan <strong>".$kode_mk."</strong> - <strong>".$nm_mk."</strong> (Kelas ".$kelas.") berhasil ditambahkan";
								} else {
									++$error_count;
									$error_msg[] = "<h4>Error ".$temp_result['result']['error_code']." (".$kode_mk." - ".$nm_mk.")</h4>".$temp_result['result']['error_desc'];
									echo $error_msg;
								}
							} else {
								//echo "<div class=\"alert alert-danger\" role=\"alert\"><h4>Error ".$temp_result['error_code']."</h4>".$temp_result['error_desc']."</div>";
								echo "<div class=\"bs-callout bs-callout-danger\"><h4>Error ".$temp_result['error_code']."</h4>".$temp_result['error_desc']."</div></div>";
								break;
							}
						}
						$this->benchmark->mark('selesai');
						$time_eks = $this->benchmark->elapsed_time('mulai', 'selesai');
						if ((!$sukses_count==0) || (!$error_count==0)) {
							echo "Waktu eksekusi ".$time_eks." detik<br />
									Results (total ".$jml_row." baris data):<br />
									<font color=\"#3c763d\">".$sukses_count." data Kelas Kuliah baru berhasil ditambah</font>";
									if ($sukses_count!=0) {
										echo "<a data-toggle=\"collapse\" href=\"#cols_sukses\" aria-expanded=\"false\" aria-controls=\"cols_sukses\"> Detail</a><br />";
									} else { echo "<br />"; }
									echo "<div class=\"collapse\" id=\"cols_sukses\">";
											foreach ($sukses_msg as $pesan_sukses) {
												echo "<div class=\"bs-callout bs-callout-success\">".$pesan_sukses."</div><br />";
											}
									echo "</div>";

							echo "<font color=\"#ce4844\" >".$error_count." data tidak bisa ditambahkan </font>";
									if ($error_count!=0) {
										echo "<a data-toggle=\"collapse\" href=\"#cols_error\" aria-expanded=\"false\" aria-controls=\"cols_error\">Detail error</a>";
									}
									echo "<div class=\"collapse\" id=\"cols_error\">";
													foreach ($error_msg as $pesan) {
															echo "<div class=\"bs-callout bs-callout-danger\">".$pesan."</div><br />";
														}
											echo "</div>";
						}
					} else {
						echo "<div class=\"bs-callout bs-callout-danger\"><h4>Error</h4>Tidak dapat mengekstrak file.. Silahkan dicoba kembali</div>";
					}
					break;
				case 1: //KRS
					$objPHPExcel->setActiveSheetIndex(1);
					$cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
					$jml_row = $objPHPExcel->getActiveSheet()->getHighestRow()-1;
					//var_dump($cell_collection);
					foreach ($cell_collection as $cell) {
						$column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
						$row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
						$data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();

						if ($row == 1) {
							$header[$row][$column] = $data_value;
						} else {
							$arr_data[$row][$column] = $data_value;
						}
					}
					//var_dump($arr_data);
					if ($arr_data) {
						$id_mk = '';
						$id_kls = '';
						$id_reg_pd = '';
						$id_sms = '';
						$temp_data = array();
						$sukses_count = 0;
						$error_count = 0;
						$error_msg = array();
						$sukses_msg = array();
						$error_nim = array();
						foreach ($arr_data as $key => $value) {
							$nim = $value['B'];
							$nm_mhs = $value['C'];
							$kode_mk = $value['D'];
							$nm_mk = $value['E'];
							$kelas = $value['F'];
							$semester = $value['G'];
							$kode_prodi = $value['H'];

							$filter_kls = "nm_kls='".$kelas."'";
							$temp_kls = $this->feeder->getrset($this->session->userdata('token'),$this->table1,$filter_kls,strpost($this->session->userdata('id_sp'),$kode_prodi,$kode_mk,$kelas,$semester,$nim),'','');
							if ($temp_kls['result']) {
								foreach ($temp_kls['result'] as $row) {
									$id_kls = $row['id_kls'];
									$id_reg_pd = $row['id_reg_pd'];
								}
							}
							$temp_data['id_kls'] = $id_kls;
							$temp_data['id_reg_pd'] = $id_reg_pd;
							$temp_data['asal_data'] = 9;
							$temp_result = $this->feeder->insertrecord($this->session->userdata['token'], $this->table2, $temp_data);
							//var_dump($temp_result);
							if ($temp_result['result']) {
								if ($temp_result['result']['error_desc']==NULL) {
									++$sukses_count;
									$sukses_msg[] = "<h4>Sukses</h4>KRS Mahasiswa <strong>".$nm_mhs."</strong> / <strong>".$nim."</strong> mata kuliah <strong>".$kode_mk."</strong> - <strong>".$nm_mk."</strong> berhasil ditambahkan";
								} else {
									++$error_count;
									$error_msg[] = "<h4>Error ".$temp_result['result']['error_code']." (".$nm_mhs." / ".$nm_mk.")</h4>".$temp_result['result']['error_desc'];
								}
							} else {
								//echo "<div class=\"alert alert-danger\" role=\"alert\"><h4>Error ".$temp_result['error_code']."</h4>".$temp_result['error_desc']."</div>";
								echo "<div class=\"bs-callout bs-callout-danger\"><h4>Error ".$temp_result['error_code']."</h4>".$temp_result['error_desc']."</div></div>";
								break;
							}
						}
						$this->benchmark->mark('selesai');
						$time_eks = $this->benchmark->elapsed_time('mulai', 'selesai');
						if ((!$sukses_count==0) || (!$error_count==0)) {
							echo "Waktu eksekusi ".$time_eks." detik<br />
									Results (total ".$jml_row." baris data):<br />
									<font color=\"#3c763d\">".$sukses_count." data KRS baru berhasil ditambah</font>";
									if ($sukses_count!=0) {
										echo "<a data-toggle=\"collapse\" href=\"#cols_sukses\" aria-expanded=\"false\" aria-controls=\"cols_sukses\"> Detail</a><br />";
									} else { echo "<br />"; }
									echo "<div class=\"collapse\" id=\"cols_sukses\">";
											foreach ($sukses_msg as $pesan_sukses) {
												echo "<div class=\"bs-callout bs-callout-success\">".$pesan_sukses."</div><br />";
											}
									echo "</div>";

							echo "<font color=\"#ce4844\" >".$error_count." data tidak bisa ditambahkan </font>";
									if ($error_count!=0) {
										echo "<a data-toggle=\"collapse\" href=\"#cols_error\" aria-expanded=\"false\" aria-controls=\"cols_error\">Detail error</a>";
									}
									echo "<div class=\"collapse\" id=\"cols_error\">";
													foreach ($error_msg as $pesan) {
															echo "<div class=\"bs-callout bs-callout-danger\">".$pesan."</div><br />";
														}
											echo "</div>";
						}
					} else {
						echo "<div class=\"bs-callout bs-callout-danger\"><h4>Error</h4>Tidak dapat mengekstrak file.. Silahkan dicoba kembali</div>";
					}
					break;
				case 2: //Dosen
					$objPHPExcel->setActiveSheetIndex(2);
					$cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
					$jml_row = $objPHPExcel->getActiveSheet()->getHighestRow()-1;
					//var_dump($cell_collection);
					foreach ($cell_collection as $cell) {
						$column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
						$row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
						$data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();

						if ($row == 1) {
							$header[$row][$column] = $data_value;
						} else {
							$arr_data[$row][$column] = $data_value;
						}
					}
					//var_dump($arr_data);
					if ($arr_data) {
						$temp_nidn = '';
						$id_reg_ptk = '';
						$id_mk = '';
						$id_kls = '';
						$id_sms = '';
						$filter_ptk = '';
						$temp_data = array();
						$sukses_count = 0;
						$error_count = 0;
						$error_msg = array();
						$sukses_msg = array();
						$error_nim = array();
						foreach ($arr_data as $key => $value) {
							$nidn = $value['B'];
							$nm_dosen = $value['C'];
							$kode_mk = $value['D'];
							$nm_mk = $value['E'];
							$kelas = $value['F'];
							$ren_tm = $value['G'];
							$rel_tm = $value['H'];
							$semester = $value['I'];
							$kode_prodi = $value['J'];

							$filter_nidn = "nidn='".$nidn."'";
							$filter_sdm='';
							$temp_nidn = $this->feeder->getrecord($this->session->userdata('token'),'dosen',$filter_nidn);
							if ($temp_nidn['result']) {
								//$id_ptk = $temp_nidn['result']['id_ptk'];
								$filter_sdm = "p.id_sdm='".$temp_nidn['result']['id_sdm']."' AND p.id_sp='".$this->session->userdata('id_sp')."'";
							}
							//$tot_nidn = count($temp_nidn['result']);
							//$filter_ptk = "p.id_ptk='".$temp_nidn['result']['id_ptk']."' AND p.id_sp='".$this->session->userdata('id_sp')."'";
							$temp_ptk = $this->feeder->getrecord($this->session->userdata('token'),'dosen_pt',$filter_sdm);
							if ($temp_ptk['result']) {
								$id_reg_ptk = $temp_ptk['result']['id_reg_ptk'];
							}

							//Filter prodi
							$filter_sms = "id_sp='".$this->session->userdata('id_sp')."' AND kode_prodi='".$kode_prodi."'";
							$temp_sms = $this->feeder->getrecord($this->session->userdata('token'),'sms',$filter_sms);
							//echo json_encode($temp_sms)."<br><br>";
							if ($temp_sms['result']) {
								$id_sms = $temp_sms['result']['id_sms'];
							}

							$filter_mk = "kode_mk='".$kode_mk."'";
							$temp_mk = $this->feeder->getrecord($this->session->userdata('token'),'mata_kuliah',$filter_mk);
							// echo json_encode($temp_mk)."<br><br>";
							if ($temp_mk['result']) {
								$id_mk = $temp_mk['result']['id_mk'];
							}

							$filter_smt = "p.id_smt='".$semester."'";
							$temp_smt = $this->feeder->getrecord($this->session->userdata('token'),'semester',$filter_smt);
							if ($temp_smt['result']) {
								$id_smt = $temp_smt['result']['id_smt'];
							}


							//Filter kelas kuliah
							$filter_kls = "p.id_smt='".$id_smt."' AND p.id_sms='".$id_sms."'";
							$temp_kls = $this->feeder->getrset($this->session->userdata('token'),$this->table1,$filter_kls,"","","");
							//echo json_encode($temp_kls)."<br><br>";
							// if ($temp_kls['result']) {
							// 	$id_kls = $temp_kls['result']['id_kls'];
							// }
							// echo $kode_mk." ".$nm_mk." ".$kelas."<br>";
							foreach ($temp_kls['result'] as $key => $value) {
								//echo $value['id_kls']." | ".$value['nm_kls']." | ".$value['kode_mk']." | ".$value['fk__id_mk']."<br>";
								if ($kode_mk==$value['kode_mk'] && $kelas == $value['nm_kls']) {
									$id_kls = $value['id_kls'];
								}
							}

							$temp_data['id_reg_ptk'] = $id_reg_ptk;
							$temp_data['id_kls'] = $id_kls;
							$temp_data['sks_subst_tot'] = 0;
							$temp_data['sks_tm_subst'] = 0;
							$temp_data['sks_prak_subst'] = 0;
							$temp_data['sks_prak_lap_subst'] = 0;
							$temp_data['sks_sim_subst'] = 0;
							$temp_data['jml_tm_renc'] = $ren_tm;
							$temp_data['jml_tm_real'] = $rel_tm;
							$temp_data['id_jns_eval'] = 1;
							// echo json_encode($temp_data);
							$temp_result = $this->feeder->insertrecord($this->session->userdata['token'], $this->table3, $temp_data);
							if ($temp_result['result']) {
								if ($temp_result['result']['error_desc']==NULL) {
									++$sukses_count;
									$sukses_msg[] = "<h4>Sukses</h4>Dosen pengampuh <strong>".$nm_dosen."</strong> untuk mata kuliah <strong>".$kode_mk."</strong> - <strong>".$nm_mk."</strong> berhasil ditambahkan";
								} else {
									++$error_count;
									$error_msg[] = "<h4>Error ".$temp_result['result']['error_code']." (".$nm_dosen." / ".$nm_mk.")</h4>".$temp_result['result']['error_desc'];
								}
							} else {
								//echo "<div class=\"bs-callout bs-callout-danger\"><h4>Error ".$temp_result['error_code']."</h4>".$temp_result['error_desc']."</div></div>";
								echo "<div class=\"bs-callout bs-callout-danger\"><h4>Error ".$temp_result['error_code']."</h4>".$temp_result['error_desc']."</div></div>";
								break;
							}
						}
						$this->benchmark->mark('selesai');
						$time_eks = $this->benchmark->elapsed_time('mulai', 'selesai');
						if ((!$sukses_count==0) || (!$error_count==0)) {
							echo "Waktu eksekusi ".$time_eks." detik<br />
									Results (total ".$jml_row." baris data):<br />
									<font color=\"#3c763d\">".$sukses_count." data Mahasiswa baru berhasil ditambah</font>";
									if ($sukses_count!=0) {
										echo "<a data-toggle=\"collapse\" href=\"#cols_sukses\" aria-expanded=\"false\" aria-controls=\"cols_sukses\"> Detail</a><br />";
									} else { echo "<br />"; }
									echo "<div class=\"collapse\" id=\"cols_sukses\">";
											foreach ($sukses_msg as $pesan_sukses) {
												echo "<div class=\"bs-callout bs-callout-success\">".$pesan_sukses."</div><br />";
											}
									echo "</div>";

							echo "<font color=\"#ce4844\" >".$error_count." data tidak bisa ditambahkan </font>";
									if ($error_count!=0) {
										echo "<a data-toggle=\"collapse\" href=\"#cols_error\" aria-expanded=\"false\" aria-controls=\"cols_error\">Detail error</a>";
									}
									echo "<div class=\"collapse\" id=\"cols_error\">";
													foreach ($error_msg as $pesan) {
															echo "<div class=\"bs-callout bs-callout-danger\">".$pesan."</div><br />";
														}
											echo "</div>";
						}
					} else {
						echo "<div class=\"bs-callout bs-callout-danger\"><h4>Error</h4>Tidak dapat mengekstrak file.. Silahkan dicoba kembali</div>";
					}
					break;
				case 3: //Nilai
					$objPHPExcel->setActiveSheetIndex(3);
					$cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
					//var_dump($cell_collection);
					foreach ($cell_collection as $cell) {
						$column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
						$row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
						$data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();

						if ($row == 1) {
							$header[$row][$column] = $data_value;
						} else {
							$arr_data[$row][$column] = $data_value;
						}
					}
					//var_dump($arr_data);
					if ($arr_data) {
						$id_mk = '';
						$id_sms = '';
						$id_reg_pd = '';
						$id_kls = '';
						$temp_data = array();
						$temp_data2 = array();
						$id_reg_pd = array();
						$sukses_count = 0;
						$sukses_msg = '';
						$error_count = 0;
						$error_msg = array();
						$error_nim = array();
						$array = array();
						foreach ($arr_data as $key => $value) {
							$nim = $value['B'];
							$kode_mk = $value['D'];
							$smt = $value['F'];
							$kls = $value['G'];
							$kode_prodi = $value['K'];

							$filter_sms = "p.id_sp='".$this->session->userdata('id_sp')."' AND p.kode_prodi='".$kode_prodi."'";
							$temp_sms = $this->feeder->getrecord($this->session->userdata('token'),'sms',$filter_sms);
							if ($temp_sms['result']) {
								$id_sms = $temp_sms['result']['id_sms'];
							}

							$filter_mk = "p.kode_mk='".$kode_mk."' AND p.id_sms='".$id_sms."'";
							$temp_mk = $this->feeder->getrecord($this->session->userdata('token'),'mata_kuliah',$filter_mk);
							if ($temp_mk['result']) {
								$id_mk = $temp_mk['result']['id_mk'];
							}

							$filter_mhs = "nipd like '%".$nim."%'";
							$temp_mhs = $this->feeder->getrecord($this->session->userdata('token'),'mahasiswa_pt',$filter_mhs);
							if ($temp_mhs['result']) {
								$id_reg_pd = $temp_mhs['result']['id_reg_pd'];
							}

							//Filter id_kls
							$filter_kls = "p.id_mk='".$id_mk."' AND p.id_smt='".$smt."' AND nm_kls='".$kls."'";
							$temp_kls = $this->feeder->getrecord($this->session->userdata('token'),'kelas_kuliah',$filter_kls);
							if ($temp_kls['result']) {
								$id_kls = $temp_kls['result']['id_kls'];
							}

							//inisial data
							$temp_key = array('id_kls' => $id_kls,
													'id_reg_pd' => $id_reg_pd
											);
							$temp_data = array('nilai_angka' => $value['H'],
												'nilai_huruf' => $value['I'],
												'nilai_indeks' => $value['J']
											);
							$array[] = array('key'=>$temp_key,'data'=>$temp_data);
						}
						//iank tambahkan
						$input_nilai_db = array(
																			'id_nilai' =>NULL,
																			'kd_matkul' =>$kode_mk,
																			'id_mahasiswa' =>$nim,
																			'nilai_angka' => $value['H'],
																			'nilai_index' =>$value['I'],
																			'nilai_huruf' =>$value['J']
																	 );
						$result_db = true;//$this->model_user->insertRecord('tb_nilai',$input_nilai_db);

						if ($result_db == true){
							$temp_result = $this->feeder->updaterset($this->session->userdata('token'),$this->table2,$array);
							$this->benchmark->mark('selesai');
							$time_eks = $this->benchmark->elapsed_time('mulai', 'selesai');
							$i=0;
							if ($temp_result['result']) {
								foreach ($temp_result['result'] as $key) {
									++$i;
									if ($key['error_desc']==NULL) {
										++$sukses_count;
									} else {
										++$error_count;
										$error_msg[] = "<h4>Error baris ".$i."</h4>".$key['error_desc'];
									}
								}
							} else {
								echo "<div class=\"bs-callout bs-callout-danger\"><h4>Error ".$temp_result['error_code']."</h4>".$temp_result['error_desc']."</div></div>";
							}


							if ((!$sukses_count==0) || (!$error_count==0)) {
								echo "<div class=\"alert alert-warning\" role=\"alert\">
										Waktu eksekusi ".$time_eks." detik<br />
										Results (total ".$i." baris data):<br /><font color=\"#3c763d\">".$sukses_count." data nilai berhasil diupdate</font><br />
										<font color=\"#ce4844\" >".$error_count." data error (tidak bisa diupdate) </font>";
										if (!$error_count==0) {
											echo "<a data-toggle=\"collapse\" href=\"#collapseExample\" aria-expanded=\"false\" aria-controls=\"collapseExample\">Detail error</a>";
										}
										//echo "<br />Total: ".$i." baris data";
										echo "<div class=\"collapse\" id=\"collapseExample\">";
												foreach ($error_msg as $pesan) {
														echo "<div class=\"bs-callout bs-callout-danger\">".$pesan."</div><br />";
													}
										echo "</div>
									</div>";
							}
						}
						else {
							$error_msg[] = "Data Tidak Tersimpan";
						}
					}
					else {
						echo "<div class=\"bs-callout bs-callout-danger\"><h4>Error</h4>Tidak dapat mengekstrak file.. Silahkan dicoba kembali</div>";
					}
					//echo "Nilai";
					break;
			}
		}
	}

	public function jsonKLS()
	{
		$search = $this->input->post('search');
		$sSearch = trim($search['value']);

		//$Data = $this->input->get('columns');
		$orders = $this->input->post('order');
		//$temp_order =

		$iStart = $this->input->post('start');
		$iLength = $this->input->post('length');

		$temp_limit = $iLength;
		$temp_offset = $iStart?$iStart : 0;
		$temp_total = $this->feeder->count_all($this->session->userdata('token'),$this->table1,$this->filter);
		$totalData = $temp_total['result'];
		$totalFiltered = $totalData;
		if (!empty($sSearch)) {
			$temp_filter = "nm_mk like '%".$sSearch."%' OR nm_smt like '%".$sSearch."%'";
			$temp_rec = $this->feeder->getrset($this->session->userdata('token'),
												$this->table1, $temp_filter,
												'id_smt DESC', $temp_limit,$temp_offset
								);
			//var_dump($temp_rec);
			$__total = $this->feeder->count_all($this->session->userdata('token'),$this->table1,$temp_filter);
			$totalFiltered = $__total['result'];
		} else {
			$temp_rec = $this->feeder->getrset($this->session->userdata('token'),
												$this->table1, $this->filter,
												'id_smt DESC', $temp_limit,$temp_offset
								);
			//var_dump($temp_rec['result']);
		}
		//var_dump($temp_rec);
		$temp_error_code = $temp_rec['error_code'];
		$temp_error_desc = $temp_rec['error_desc'];

		if (($temp_error_code==0) && ($temp_error_desc=='')) {
			$temp_data = array();
			$i=0;
			foreach ($temp_rec['result'] as $key) {
				$temps = array();
				$filter_sms = "id_sms = '".$key['id_sms']."'";
				$temp_sms = $this->feeder->getrecord($this->session->userdata('token'),'sms',$filter_sms);
				$filter_jenjang = "id_jenj_didik = ".$temp_sms['result']['id_jenj_didik'];
				$temp_jenjang = $this->feeder->getrecord($this->session->userdata('token'),'jenjang_pendidikan',$filter_jenjang);
				//var_dump($temp_jenjang);

				$filter_kodemk = "id_mk = '".$key['id_mk']."' AND id_sms='".$key['id_sms']."'";
				$temp_kodemk = $this->feeder->getrecord($this->session->userdata('token'),'mata_kuliah',$filter_kodemk);
				//var_dump($temp_kodemk['result']);

				$filter_kls = "p.id_kls = '".$key['id_kls']."'";
				$count_klsmhs = $this->feeder->count_all($this->session->userdata('token'),$this->table2,$filter_kls);

				$filter_dosen = "id_kls = '".$key['id_kls']."'";
				$count_klsdosen = $this->feeder->count_all($this->session->userdata('token'),'ajar_dosen',$filter_dosen);

				$temps[] = ++$i+$temp_offset;
				$temps[] = $temp_jenjang['result']['nm_jenj_didik'].' '.$temp_sms['result']['nm_lemb'];
				$temps[] = $key['fk__id_smt'];
				$temps[] = $temp_kodemk['result']['kode_mk'];
				$temps[] = $key['fk__id_mk'];
				$temps[] = $key['nm_kls'];
				$temps[] = $key['sks_mk'];
				$temps[] = $count_klsmhs['result'];
				$temps[] = $count_klsdosen['result'];
				$temps[] = '<a href="'.base_url().'kelas/nilai/'.$key['id_kls'].'" target="_blank"><i class="fa fa-search-plus"></i></a>';
				$temp_data[] = $temps;
			}
			$temp_output = array(
									'draw' => intval($this->input->get('draw')),
									'recordsTotal' => intval( $totalData ),
									'recordsFiltered' => intval( $totalFiltered ),
									'data' => $temp_data
				);
			echo json_encode($temp_output);
		}
	}
}
