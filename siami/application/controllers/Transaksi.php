
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {

	public function __construct(){
		parent::__construct();

		$datalog = $this->session->get_userdata();
		if(!$datalog['status_login']){
			$this->session->set_flashdata("error","Anda tidak diizinkan mengakses halaman ini. Harap login terlebih dahulu");
			redirect(site_url()."login");
		}

		$this->load->model("model_mahasiswa");
		$this->load->model("model_transaksi");
	}

	public function index(){
		$data['data'] = $this->load->view('view_transaksi',null,true);
		$data['active'] = 'transaksi';

		$this->load->view('view_home',$data);
	}

	public function layanan(){

		$cari = $this->input->get("cari");

		$x = null;
		if(!empty($cari)){
			$x['src'] = $cari;
			$x['datamahasiswa'] = $this->model_mahasiswa->caridatamahasiswa($cari)->result();
			$x['jml'] = $this->model_mahasiswa->caridatamahasiswa($cari)->num_rows();
		}
		$data['data'] = $this->load->view('view_layanan',$x,true);
		$data['active'] = 'layanan';

		$this->load->view('view_home',$data);
	}

	public function laporan(){
		$x['jenis_bayar'] = $this->model_transaksi->get_query("SELECT * FROM jenis_bayar")->result();
		$x['data_kurikulum'] = $this->model_transaksi->get_query("SELECT * FROM tb_kurikulum m1 GROUP BY m1.ta")->result();
		$data['data'] = $this->load->view('view_laporan',$x,true);
		$data['active'] = 'laporan';
		$this->load->view('view_home',$data);
	}

	public function laporan_buat(){
		$this->load->library('fpdf_gen');
		$angkatan = $this->input->post('angkatan');
		$jurusan = $this->input->post('jurusan');
		$tahun = $this->input->post('thn');
		$jb = $this->input->post('jb');
		if ($jurusan == '1') {
			$data_laporan = $this->model_transaksi->get_query("SELECT * FROM view_pembayaran WHERE angkatan='".$angkatan."' AND nama_jns_bayar='".$jb."'")->result();
		}
		else {
			$data_laporan = $this->model_transaksi->get_query("SELECT * FROM view_pembayaran WHERE nim LIKE '%".$jurusan."%' AND (angkatan='".$angkatan."' AND (nama_jns_bayar='".$jb."'))")->result();
		}

		$data['data_laporan'] = $data_laporan;
		//echo json_encode($data_laporan);
		$data['angkatan'] = $angkatan;
		if ($jurusan=='55201') {
			$data['jurusan'] = "TI";
		}
		else if ($jurusan=='57201') {
				$data['jurusan'] = "SI";
		}
		else{
				$data['jurusan'] = "SI/TI";
		}
		$data['tahun'] = $tahun;
		$data['jenis_bayar'] = $jb;
		$this->load->view("cetak_laporan",$data);

		$html = $this->output->get_output();
		$this->dompdf->set_paper("legal", 'potrait');
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("".$angkatan."-".date('D-M-Y').".pdf",array('Attachment'=>0));
	}

	public function laporan_smt()
	{
		$this->load->library('fpdf_gen');
		$kode_prodi = $this->input->post('jurusan');
		$ta = $this->input->post('ta');
		$tahun = substr($ta, 0,4);

		if ($jurusan == '1') {
			$data_laporan = $this->model_transaksi->get_query("SELECT * FROM v_laporan_smt WHERE ta=".$ta)->result();
		}
		else {
			$data_laporan = $this->model_transaksi->get_query("SELECT * FROM v_laporan_smt WHERE kd_prodi=".$kode_prodi." AND ta=".$ta)->result();
		}


		if ($kode_prodi=='55201') {
			$data['jurusan'] = "Teknik Informatika";
		}
		else if ($kode_prodi=='57201') {
			$data['jurusan'] = "Sistem Informasi";
		}
		else{
			$data['jurusan'] = "Semua Jurusan";
		}
		$data['data_laporan'] = $data_laporan;
		$data['ta'] = $ta;
		$data['jenis_bayar'] = "Semester";
		$data['tahun'] = $tahun;
		$data['kode_prodi'] = $kode_prodi;
		$this->load->view("cetak_laporan_smt",$data);

		$html = $this->output->get_output();
		$this->dompdf->set_paper("legal", 'potrait');
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("semester".$angkatan."-".date('D-M-Y').".pdf",array('Attachment'=>0));
	}

	public function p($id){
		$id = base64_decode($id);
		$tgl= date("d-m-Y");
		$x['kurikulum'] = $this->model_transaksi->getKurikulum()->result();
		$x['datam'] = $this->model_mahasiswa->getdatamahasiswa($id)->result();
		$x['datajb'] = $this->model_transaksi->getdatajenisbayar($x['datam'][0]->angkatan,$tgl)->result();
		$data['data'] = $this->load->view("view_prosestransaksi", $x, true);
		$this->load->view("view_home", $data);
	}

	public function simpantransaksi(){

		$kodebayar = md5(date("dmYHis").$this->input->post("nim"));
		$kur = $this->input->post("id_smt");
		$no = 1;
		$token = "";

		while($no<=3){
			$token	.= substr(str_shuffle("1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 5);
			if($no<3){
				$token	.= "-";
			}
			$no++;
		}

		$dt_mhs = $this->model_transaksi->get_query("SELECT * FROM view_mahasiswa WHERE nim='".$this->input->post("nim")."'")->row();
		$tgl = explode("-",$this->input->post("tglbayar"));
		$tgl = $tgl[2]."-".$tgl[1]."-".$tgl[0];

		$jb = $this->model_transaksi->get_query("SELECT * FROM biaya WHERE kode_biaya='".$this->input->post("jb")."'")->row();
		$jn_by = $this->model_transaksi->get_query("SELECT * FROM jenis_bayar WHERE kode_jns_bayar='".$jb->kode_jns_bayar."'")->row();

		$data =  array(
			"kode_bayar" => $kodebayar,
			"kode_biaya" => $this->input->post("kkb"),
			"nim" => $this->input->post("nim"),
			"nik" => "140201025",
			"jumlah_bayar" => $this->input->post("jby"),
			"tgl_byr" => $tgl,
			"keterangan" => $ket = $this->input->post("ket"),
			"no_referensi" => $this->input->post("norefbank")
		);



		$db_siakad = $this->load->database('siakad',TRUE);


		$cek1 = $this->model_transaksi->simpanbayar($data);
		if (!$cek1) {
			echo "Gagal Di simpan";
		}
		else {
			if ($kur!='') {
				$cek2 = $db_siakad->insert("tb_mhs_krs",$data_siakad);
				if (!$cek2) {
				  echo "Gagal Di Sinkron";
				}
				else {
					$this->session->set_flashdata('message', 'Pembayaran Semester Berhasil Disimpan Dan Disnkron');

					// $a = $this->sendEmail($dt_mhs->email,$kur,$this->input->post("nim"),$kodebayar,$token);
					$a = $this->sendEmail("meongbego@gmail.com",$kur,$this->input->post("nim"),$kodebayar,$token);
					if ($a) {
						$this->session->set_flashdata('message', 'Sinkronisasi Siakad Dan Email Berhasil Dan Pembayaran Disimpan');
						redirect("mahasiswa/d/".base64_encode($this->input->post("nim")));
					}
					else {
						$this->session->set_flashdata('message', 'Error Pada Saat Mengirim Email : Suruh Mahasiswa Untuk Melakukan Validasi Manual');
						redirect("mahasiswa/d/".base64_encode($this->input->post("nim")));
					}
				}
			}
			else {

				if ($jn_by->kode_jns_bayar=='JB005' || $jn_by->kode_jns_bayar=='JB006' ) { // proposal skripsi
					$data_bayar = array(
						"id_mhs" => $this->input->post("nim"),
						"kode_bayar" => $kodebayar,
						"kode_jns_bayar" => $jn_by->kode_jns_bayar,
						"nm_jns_bayar" => $jn_by->nama_jns_bayar,
						"status_bayar" => "Y",
						"token" => $token
					);
					$cek3 = $db_siakad->insert("tb_mhs_bayar",$data_bayar);
					if (!$cek3) {
						$this->session->set_flashdata('message', 'Pembayaran Propopsal/Skripsi Gagal Disimpan');
						redirect("mahasiswa/d/".base64_encode($this->input->post("nim")));
					} else {
						$this->session->set_flashdata('message', 'Pembayaran Propopsal/Skripsi Gagal Disimpan');
						redirect("mahasiswa/d/".base64_encode($this->input->post("nim")));
					}

				}
				else {
					$this->session->set_flashdata('message', 'Pembayaran Lainnya Berhasil Disimpan');
					redirect("mahasiswa/d/".base64_encode($this->input->post("nim")));
				}
			}
		}
	}

	public function sendEmail($email,$periode='',$nim='',$kode_bayar='',$token)
	{
		$this->load->library('email');
		$subject = 'Verifikasi Akun Pembayaran';
		$enc_periode = $periode;
		$enc_nim = $nim;
		$isi = "<p>Terimakasih Atas Pembayaran anda</p>";
		$isi .= "<p>
					NIM : ".$nim." <br>
					ID Periode : ".$periode." <br>
					Kode Bayar : ".$kode_bayar."

		</p>";
		$isi .= "<p>Silahkan klik mengaktifkan akun anda dengan masuk pada link berikut ini : <a href='http://siakad.stmikadhiguna.ac.id/siakad/simala/auth/konfirmasiEmail/".$kode_bayar."/".$enc_nim."/".$enc_periode."/".$token."'>Verifikasi Akun Anda</a></p>";
		$isi .= "<p>Terima kasih atas perhatiannya<br>- Best Regard,<br>Herlinawati Ridwan, S.Kom</p>";

		//lib email 1
		$result = $this->email
        ->from("siakad.sagp@gmail.com")
        ->to($email)
        ->subject($subject)
        ->message($isi)
        ->send();
				echo var_dump($result);
		if ($result) {
			return TRUE;
		}
		else {
			return FALSE;
		}
	}

	public function getbiaya(){
		$kjb = $this->input->post("kb");
		$ta = $this->input->post("tglbayar");
		$data = $this->model_transaksi->getbiaya($kjb,$ta)->result();

		echo $data[0]->kode_biaya." : ".$data[0]->jml_biaya;
	}

	public function getjenisbiaya(){
		$angkatan = $this->input->post("angk");
		$tgl = $this->input->post("tglbayar");
		$data = $this->model_transaksi->getdatajenisbayar($angkatan,$tgl)->result();
		echo "<option value=''>--Pilih Jenis Biaya--</option>";
		foreach($data as $j){
			echo "<option value='".$j->kode_biaya."'>".$j->nama_jns_bayar."</option>";
		}
	}

	public function hapus($id,$nim){
		$id = $id;
		$this->model_transaksi->hapustransaksi($id);
		redirect("mahasiswa/d/".base64_encode($nim));
	}

	public function bayarangsuran($kode){
		if(!empty($kode)){
			$datax['kurikulum'] = $this->model_transaksi->getKurikulum()->result();
			$datax['dt'] = $this->model_transaksi->gettr($kode)->result();
			$data['data'] = $this->load->view("view_bayarangsuran",$datax,true);
		}
		$this->load->view("view_home",$data);
	}

	public function simpanangsuran(){
		$db_siakad = $this->load->database('siakad',TRUE);
		$id_smt = $this->input->post('id_smt');
		$bayarbaru = $this->input->post("jmlbyr")+$this->input->post("jmlangsuran");
		$data = array(
			"jumlah_bayar" => $bayarbaru
		);

		$where = "kode_bayar = '".$this->input->post("kdbyr")."'";
		$a = $this->model_transaksi->simpanangsuran($data, $where);
		$kode_bayar = $this->input->post('kdbyr');
		$hasil = $this->model_transaksi->getvalidtransaksi($kode_bayar);
		if ($hasil->num_rows() == 1) {
			if ($id_smt=='') {
				$this->session->set_flashdata('message', 'Pembayaran Lainnya Berhasil Disimpan');
				redirect("mahasiswa/d/".base64_encode($this->input->post("nim")));
			}
			else {
				$data_siakad = array(
					"kode_pembayaran" => $kode_bayar,
					"id_mhs" => $this->input->post("nim"),
					"id_kurikulum" => $id_smt,
					"status_ambil" => "T",
					"status_cek" => "Y",
				);
				$cek2 = $db_siakad->insert("tb_mhs_krs",$data_siakad);
				if (!$cek2) {
					echo "Data Berhasil Disimpan Tetapi Gagal Disinkron";
				}
				else {
					$this->session->set_flashdata('message', 'Pembayaran Semester Berhasil Disimpan Dan Disnkron');
					redirect("mahasiswa/d/".base64_encode($this->input->post("nim")));
				}
			}
		}
		else{
			echo "Data Berhasil Disimpan Tetapi tidak Di Sinkron";
		}
	}

	public function cetak_transaksi($kode_bayar='')
	{
		$this->load->library('fpdf_gen');
		$data_pembayaran = $this->model_transaksi->get_view_by_id('view_pembayaran','kode_bayar',$kode_bayar);
		$data_identitas = $this->model_transaksi->get_view_by_id('view_mahasiswa','nim',$data_pembayaran->nim);
		$data['kode_bayar']=$data_pembayaran->kode_bayar;
		$data['nama']=$data_identitas->nama;
		$data['nim']=$data_pembayaran->nim;
		$data['jurusan']='.................';
		$data['konfirmasi']='Y';
		$data['status']=$data_pembayaran->statusbayar;
		$data['periode']=$data_pembayaran->keterangan;
		$this->load->view("cetak_transaksi",$data);
		$html = $this->output->get_output();
		$this->dompdf->set_paper(array(0,0,684.00,297.00), 'potrait');
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("".$data_pembayaran->nim."-".date('D-M-Y').".pdf",array('Attachment'=>0));
	}
}

?>
