<?php

function refresh_session(){
  $_CI = get_instance();
  $var2 = array('n' => 'spJabatan'); 
  $inVar2 = array(
    'stat' => 'D',
    'cari' => '',
    'l'=>'',
    's'=>'',
    'id' =>$_CI->session->userdata('jabatan'),
    'nama' => '',
    'akses_login' => '',
    'akses_master' => '',
    'akses_calon' => '',
    'akses_anggota' => '',
    'akses_iuran' => '',
    'akses_simpanan' => '',
    'akses_deposito' => '',
    'akses_pinjaman' => '',
    'akses_akunting' => '',
    
  );
  $var2['v']=$inVar2;
  $jabatan = $_CI->Modelnomor->sp($var2)->row_array();

  $_CI->session->set_userdata( $jabatan ); 
}

function cek_akses($a,$b){
  $_CI = get_instance();
  if ($_CI->session->userdata($a) == $b) {
    return true;
  }else{
    return false;
  }
}

function datakoperasi(){	
	$_CI = get_instance();
	$_CI->load->model('Modelnomor');

	$var = array('n' => 'spDataKoperasi');
    $inVar = array(
      'stat' => 'D',
      'cari' => '',
      'l'=>'',
      's'=>'',
      'nama' => '',
      'alamat' => '',
      'telpon' => '',
      'fax' => '',
      'email' => '',
      'web' => '',
      'nobadanusaha' => '',
      'tglbadanusaha' => '',
      'motto' => ''
    );
    $var['v']=$inVar;
    $res = $_CI->Modelnomor->sp($var)->row();

    return $res;

}

function getBungaSimpanan(){
  $_CI = get_instance();
  $_CI->load->model('Modelnomor');

  $var = array('n' => 'spBungaSimpanan');
    $inVar = array(
      'stat' => 'D',
      'cari' => '',
      'l'=>'',
      's'=>'',
      'bunga' => '',
      'keterangan' => '',
      'bunga_tamara' => '',
    );
    $var['v']=$inVar;
    $res = $_CI->Modelnomor->sp($var)->row();

    return $res;
}

function getSaldoSimpanan($id_simpanan, $id = ''){
  $_CI = get_instance();
  $_CI->load->model('Modelnomor');

  $var = array('n' => 'spSaldo');
    $inVar = array(
      'stat' => 'A',
      'tgl1' => '',
      'tgl2' => '',
      'id_simpanan' => $id_simpanan,
      'jenis_simpanan' => '',
      'id_operator' => '',
      'status_aktif' => '',
      'id' => $id,
    );
    $var['v']=$inVar;
    $res = $_CI->Modelnomor->sp($var)->row();

    return $res->saldo;
}

function getSaldoAt($id_simpanan, $tgl){
  $_CI = get_instance();
  $_CI->load->model('Modelnomor');

  $var = array('n' => 'spSaldo');
    $inVar = array(
      'stat' => 'A2',
      'tgl1' => '',
      'tgl2' => $tgl,
      'id_simpanan' => $id_simpanan,
      'jenis_simpanan' => '',
      'id_operator' => '',
      'status_aktif' => '',
      'id' => '',
    );
    $var['v']=$inVar;
    $res = $_CI->Modelnomor->sp($var)->row();

    if ($res=='') {
      $ret = 0;
    }else{
      $ret = $res->saldo;
    }

    return $ret;
}

function getCountCalonAnggota(){
  $_CI = get_instance();
  $_CI->load->model('Modelnomor');

  $varA = array('n' => 'spAnggota');
    $inVarA = array(
      'stat' => 'AC',
      'cari' => '',
      'l'=>'',
      's'=>'',
      'tgl1'=>'',
      'tgl2'=>'',
      'id' =>'',
      'no_anggota' => '',
      'tanggal_daftar' => '',
      'nama' => '',
      'tempat_lahir' => '',
      'tgl_lahir' => '',
      'jenis_kelamin' => '',
      'status' => '',
      'alamat' => '',
      'telp' => '',
      'pekerjaan' => '',
      'no_identitas' => '',
      'jenis_keanggotaan' => '',
      'status_aktif' => '',
      'operator' => '',
      'username' => '',
      'kunci' => '',
      'status_keanggotaan' => '',
      'tanggal_anggota' => '',
      'tanggal_mundur' => '',
      'alasan_mundur' => '',
      'no_kk' => '',
    );

    $varA['v']=$inVarA;
    $res = $_CI->Modelnomor->recordfilter_sp($varA);

    return $res;
}

function getCountAnggota(){
  $_CI = get_instance();
  $_CI->load->model('Modelnomor');

  $varA = array('n' => 'spAnggota');
    $inVarA = array(
      'stat' => 'A',
      'cari' => '',
      'l'=>'',
      's'=>'',
      'tgl1'=>'',
      'tgl2'=>'',
      'id' =>'',
      'no_anggota' => '',
      'tanggal_daftar' => '',
      'nama' => '',
      'tempat_lahir' => '',
      'tgl_lahir' => '',
      'jenis_kelamin' => '',
      'status' => '',
      'alamat' => '',
      'telp' => '',
      'pekerjaan' => '',
      'no_identitas' => '',
      'jenis_keanggotaan' => '',
      'status_aktif' => '',
      'operator' => '',
      'username' => '',
      'kunci' => '',
      'status_keanggotaan' => '',
      'tanggal_anggota' => '',
      'tanggal_mundur' => '',
      'alasan_mundur' => '',
      'no_kk' => '',
    );

    $varA['v']=$inVarA;
    $res = $_CI->Modelnomor->recordfilter_sp($varA);

    return $res;
}

function getCalonAnggotaLastId(){
  $_CI = get_instance();
  $_CI->load->model('Modelnomor');

  $varA = array('n' => 'spAnggota');
    $inVarA = array(
      'stat' => 'ID',
      'cari' => '',
      'l'=>'',
      's'=>'',
      'tgl1'=>'',
      'tgl2'=>'',
      'id' =>'',
      'no_anggota' => '',
      'tanggal_daftar' => '',
      'nama' => '',
      'tempat_lahir' => '',
      'tgl_lahir' => '',
      'jenis_kelamin' => '',
      'status' => '',
      'alamat' => '',
      'telp' => '',
      'pekerjaan' => '',
      'no_identitas' => '',
      'jenis_keanggotaan' => 'CALON',
      'status_aktif' => '',
      'operator' => '',
      'username' => '',
      'kunci' => '',
      'status_keanggotaan' => '',
      'tanggal_anggota' => '',
      'tanggal_mundur' => '',
      'alasan_mundur' => '',
      'no_kk' => '',
    );

    $varA['v']=$inVarA;
    $res = $_CI->Modelnomor->sp($varA)->row();

    if ($res == '') {
      $ret = 0;
    }else{
      $ret = $res->id;
    }

    return $ret;
}

function getAnggotaLastId(){
  $_CI = get_instance();
  $_CI->load->model('Modelnomor');

  $varA = array('n' => 'spAnggota');
    $inVarA = array(
      'stat' => 'ID',
      'cari' => '',
      'l'=>'',
      's'=>'',
      'tgl1'=>'',
      'tgl2'=>'',
      'id' =>'',
      'no_anggota' => '',
      'tanggal_daftar' => '',
      'nama' => '',
      'tempat_lahir' => '',
      'tgl_lahir' => '',
      'jenis_kelamin' => '',
      'status' => '',
      'alamat' => '',
      'telp' => '',
      'pekerjaan' => '',
      'no_identitas' => '',
      'jenis_keanggotaan' => 'ANGGOTA',
      'status_aktif' => '',
      'operator' => '',
      'username' => '',
      'kunci' => '',
      'status_keanggotaan' => '',
      'tanggal_anggota' => '',
      'tanggal_mundur' => '',
      'alasan_mundur' => '',
      'no_kk' => '',
    );

    $varA['v']=$inVarA;
    $res = $_CI->Modelnomor->sp($varA)->row();

    if ($res == '') {
      $ret = 0;
    }else{
      $ret = $res->id;
    }

    return $ret;
}

function getLastIdTS(){
  $_CI = get_instance();
  $_CI->load->model('Modelnomor');

  $varA = array('n' => 'spTransaksiSimpanan');
    $inVarA = array(
      'stat' => 'ID',
      'cari' => '',
      'l'=>'',
      's'=>'',
      'tgl1'=>'',
      'tgl2'=>'',
      'id' =>'',
      'id_simpanan'=>'',
      'tanggal'=>'',
      'kode_transaksi'=>'',
      'jumlah'=>'',
      'id_operator'=>'',
      'pembungaan'=>'',
      'no_transaksi'=>'',
      'pinalty'=>'',
      'adm'=>'',
    );

    $varA['v']=$inVarA;
    $res = $_CI->Modelnomor->sp($varA)->row();

    if ($res == '') {
      $ret = 1;
    }else{
      $ret = $res->hasil;
    }

    return $ret;
}

function getLastIdTD(){
  $_CI = get_instance();
  $_CI->load->model('Modelnomor');

  $varA = array('n' => 'spTransaksiDeposito');
  $inVarA = array(
    'stat' => 'Z',
    'cari' => '',
    'l'=>'',
    's'=>'',
    'tgl1'=>'',
    'tgl2'=>'',
    'id' =>'',
    'id_deposito'=>'',
    'tanggal'=>'',
    'kode_transaksi'=>'',
    'jumlah'=>'',
    'id_operator'=>'',
    'pembungaan'=>'',
    'no_transaksi'=>'',
    'is_ambil'=>'',
    'tgl_ambil'=>'',
    'pinalty' => '',
  );

  $varA['v']=$inVarA;
  $res = $_CI->Modelnomor->sp($varA)->row();

  if ($res == '') {
    $ret = 1;
  }else{
    $ret = $res->hasil;
  }

  return $ret;
}

function getIuranLastId(){
  $_CI = get_instance();
  $_CI->load->model('Modelnomor');

  $var = array('n' => 'spIuran');
    $inVar = array(
      'stat' => 'ID',
      'cari' => '',
      'l'=>'',
      's'=>'',
      'tgl1'=>'',
      'tgl2'=>'',
      'id' =>'',
      'kode_transaksi' => '',
      'tgl_bayar' => '',
      'id_anggota' => '',
      'jenis_iuran' => '',
      'jml_bulan_bayar' => '',
      'mulai_bulan' => '',
      'pokok' => '',
      'wajib' => '',
      'khusus' => '',
      'keterangan' => '',
      'id_operator' => '',
      'terakhir_bayar' => '',
      'bayar' => '',
      'kembalian' => '',
    );
    $var['v']=$inVar;
    $res = $_CI->Modelnomor->sp($var)->row();

    if ($res == '') {
      $ret = 0;
    }else{
      $ret = $res;
    }

    return $ret;
}


function getJumlahIuran(){
  $_CI = get_instance();
  $_CI->load->model('Modelnomor');

  $var = array('n' => 'spJumlahIuran');
    $inVar = array(
      'stat' => 'D',
      'cari' => '',
      'l'=>'',
      's'=>'',
      'pokok' => '',
      'wajib' => '',
      'khusus' => '',
    );
    $var['v']=$inVar;
    $res = $_CI->Modelnomor->sp($var)->row();

    return $res;
}


function getJurnalLastId($kode = ''){
  $_CI = get_instance();
  $_CI->load->model('Modelnomor');

  $var = array('n' => 'spJurnal');
  $inVar = array(
    'stat' => 'ID',
    'cari' => '',
    'l'=>'',
    's'=>'',
    'tgl1'=>'',
    'tgl2'=>'',
    'id' =>'',
    'no_jurnal'=>$kode,
    'tanggal'=>'',
    'jenis'=>'',
    'bagian'=>'',
    'catatan'=>'',
    'id_operator'=>'',
  );
  $var['v']=$inVar;
  $res = $_CI->Modelnomor->sp($var)->row();

  return $res;
}


function bungaDepositoOtomatis(){
  $_CI = get_instance();
  $_CI->load->model('Modelnomor');

  $var = array('n' => 'spDeposito');
  $inVar = array(
    'stat' => 'Z',
    'cari' => '',
    'l'=>'',
    's'=>'',
    'id' =>'',
    'no_deposito' => '',
    'tanggal' => date('Y-m-d'),
    'status' => '',
    'id_operator' => '',
    'id_nasabah' => '',
    'jenis_deposito' => '',
    'tgl_mulai' => '',
    'jangka_waktu' => '',
    'jatuh_tempo' => '',
    'bunga' => '',
    'jumlah' => '',
    'tipe_deposito' => '',
    'perpanjangan' => '',
    'id_simpanan' => '',
    'tgl_tutup' => '',
    'pinalty' => '',
  );

  $var['v']=$inVar;
  $res = $_CI->Modelnomor->sp($var)->result();


  $_CI->db->trans_start();
  foreach ($res as $a) {
    $bunga = $a->jumlah*($a->bunga/12/100);

    $no_trx = 'D'.str_pad(getLastIdTD(), 5, '0', STR_PAD_LEFT).date('ymd');

    if ($a->tipe_deposito == 'TABUNGAN') {
      $ambil = 1;
    }else{
      $ambil = 0;
    }

    $var = array('n' => 'spTransaksiDeposito');
    $inVar = array(
      'stat' => 'T',
      'cari' => '',
      'l'=>'',
      's'=>'',
      'tgl1'=>'',
      'tgl2'=>'',
      'id' =>'',
      'id_deposito'=>$a->id,
      'tanggal'=>date('Y-m-d'),
      'kode_transaksi'=>'205',
      'jumlah'=>$bunga,
      'id_operator'=>'',
      'pembungaan'=>'',
      'no_transaksi'=>$no_trx,
      'is_ambil'=>$ambil,
      'tgl_ambil'=>date("Y-m-d"),
      'pinalty' => '',
    );
    $var['v']=$inVar;
    $data = $_CI->Modelnomor->sp($var)->result();

    if ($a->tipe_deposito == 'TABUNGAN') {
      $no_transaksi = 'S'.str_pad(getLastIdTS(), 5, '0', STR_PAD_LEFT).date('ymd'); 

      $var3 = array('n' => 'spTransaksiSimpanan');
      $inVar3 = array(
        'stat' => 'T',
        'cari' => '',
        'l'=>'',
        's'=>'',
        'tgl1'=>'',
        'tgl2'=>'',
        'id' =>'',
        'id_simpanan'=>$a->id_simpanan,
        'tanggal'=>date("Y-m-d"),
        'kode_transaksi'=>'100',
        'jumlah'=>$bunga,
        'id_operator'=>'',
        'pembungaan'=>'',
        'no_transaksi'=>$no_transaksi,
        'pinalty'=>'',
        'adm'=>'',
      );
      $var3['v']=$inVar3;
      $data3 = $_CI->Modelnomor->sp($var3)->result();
    }
  }
  $_CI->db->trans_complete();

  if ($_CI->db->trans_status() === FALSE)
  {
    $hasil = 0;
  }else{
    $hasil = 1;
  }

  // $hasil['res'] = $res;

  return $hasil;
}


//////////////////////////////////////////////////////////////////////
//PARA: Date Should In YYYY-MM-DD Format
//RESULT FORMAT:
// '%y Year %m Month %d Day %h Hours %i Minute %s Seconds'        =>  1 Year 3 Month 14 Day 11 Hours 49 Minute 36 Seconds
// '%y Year %m Month %d Day'                                    =>  1 Year 3 Month 14 Days
// '%m Month %d Day'                                            =>  3 Month 14 Day
// '%d Day %h Hours'                                            =>  14 Day 11 Hours
// '%d Day'                                                        =>  14 Days
// '%h Hours %i Minute %s Seconds'                                =>  11 Hours 49 Minute 36 Seconds
// '%i Minute %s Seconds'                                        =>  49 Minute 36 Seconds
// '%h Hours                                                    =>  11 Hours
// '%a Days                                                        =>  468 Days
//////////////////////////////////////////////////////////////////////
function dateDifference($date_1 , $date_2 , $differenceFormat = '%a' )
{
    $datetime1 = date_create($date_1);
    $datetime2 = date_create($date_2);
   
    $interval = date_diff($datetime1, $datetime2);
   
    return $interval->format($differenceFormat);
   
}

function addMonth($date,$add){
  $tgl = explode("-", $date);

  $tgl[1] = $tgl[1] + $add;

  $bagi = floor($tgl[1] / 12);
  $tgl[1] = $tgl[1]%12;
  if ($bagi > 0) {
    $tgl[0] += $bagi;
  }

  $tgl_akhir = new DateTime( $tgl[0].'-'.$tgl[1].'-01' ); 
  $tgl_akhir = $tgl_akhir->format( 'Y-m-t' );

  $tgl_akhir = explode("-", $tgl_akhir);

  if ($tgl[2]>$tgl_akhir[2]) {
    $tgl[2] = $tgl_akhir[2];
  }

  $result = new DateTime($tgl[0].'-'.$tgl[1].'-'.$tgl[2]);

  return $result->format( 'Y-m-d' );
}

?>


