<?php


function otomatis($tanggal, $jenis, $bagian, $catatan, $detail){	
	$_CI = get_instance();
	$_CI->load->model('Modelnomor');

  $kd = 'KM';
  $id_lama = getJurnalLastId($kd);
  if (isset($id_lama)) {
    $id = $id_lama->no_jurnal;
    $id_baru = substr($id, 2) + 1;
  }else{
    $id_baru = 1;
  }
  
  $kode = $kd.str_pad($id_baru, 10, '0', STR_PAD_LEFT);

	$var = array('n' => 'spJurnal');
  $inVar = array(
    'stat' =>'T',
    'cari' => '',
    'l'=>'',
    's'=>'',
    'tgl1'=>'',
    'tgl2'=>'',
    'id' =>'',
    'no_jurnal'=>$kode,
    'tanggal'=>$tanggal,
    'jenis'=>$jenis,
    'bagian'=>$bagian,
    'catatan'=>$catatan,
    'id_operator'=>'0',
  );
  $var['v']=$inVar;
  $insert = $_CI->Modelnomor->sp($var)->row();


  $res = 0;
  foreach ($detail as $data) {
    $makedetail = make_detail($insert->hasil, $data['id_rek'], $data['debet'], $data['kredit']);

    if ($makedetail != 0) {
      $res = $makedetail;
    }
  }

  return $res;

}

function make_detail($jurnal, $id_rek, $debet, $kredit){
  $_CI = get_instance();
  $_CI->load->model('Modelnomor');

  $var2 = array('n' => 'spJurnalDetail');
  $inVar2 = array(
    'stat' => 'T',
    'cari' => '',
    'l'=>'',
    's'=>'',
    'id' =>'',
    'id_jurnal'=>$jurnal,
    'id_rek'=>$id_rek,
    'debet'=>$debet,
    'kredit'=>$kredit,
  );
  $var2['v']=$inVar2;
  $data = $_CI->Modelnomor->sp($var2)->row();

  return $data->hasil;
}
?>


