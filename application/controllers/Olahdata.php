<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Olahdata extends CI_Controller {

  public function __construct(){
    parent::__construct();
    $this->load->helper('file');
  }
  
  public function index(){  
    
  }

  public function load_data(){
    $json = read_file('./data_map/data_map.json');
    $obj  = json_decode($json);
    // echo '<pre>' , print_r($obj) , '</pre>';
    return $obj;
  }

  private function d_from_start($pos, $start){
    $dx = $pos['x'] - $start['x'];
    $dy = $pos['y'] - $start['y'];

    return floor(sqrt(($dx**2) + ($dy**2)) * 100);
  }

  private function d_from_finish($pos, $finish){
    $dx = $pos['x'] - $finish['x'];
    $dy = $pos['y'] - $finish['y'];

    return floor(sqrt(($dx**2) + ($dy**2)) * 100);
  }

  private function d_total($pos, $start, $finish){
    return $this->d_from_start($pos, $start) + $this->d_from_finish($pos, $finish);
  }

  private function find_neighbor($pos, $baris, $kolom){
    $data = array();

    $x_awal = $pos['x']-1;
    $x_akhir = $pos['x']+1;
    if($x_awal < 0){$x_awal = 0;}
    if($x_akhir >= $baris){$x_akhir = $baris-1;}

    $y_awal = $pos['y']-1;
    $y_akhir = $pos['y']+1;

    if($y_awal < 0){$y_awal = 0;}
    if($y_akhir >= $kolom){$y_akhir = $kolom-1;}


    for($i = $x_awal; $i <= $x_akhir; $i++){
      for($j = $y_awal; $j <= $y_akhir; $j++){
        $d = array('x' => $i,'y' => $j);
        array_push($data, $d);
      }
    }

    return $data;
  }

  public function do_a_star(){
    $pos = $this->load_data();
    $baris = count($pos);
    $kolom = count($pos[0]);
    // for($i=0; $i < $baris; $i++){
    //   for($j=0; $j < $kolom; $j++){
    //     print_r($pos[$i][$j]->is_path);
    //   }
    //   echo '<br>';
    // }

    $awal = array('x' => 19,'y' => 3);
    $akhir = array('x' => 0,'y' => 1);
    $pos_now = $awal;

    $tetangga = array();

    while($pos_now['x'] != $akhir['x'] || $pos_now['y'] != $akhir['y']){
      $pos[$pos_now['x']][$pos_now['y']]->is_selected = 1;
      $neighbors = $this->find_neighbor($pos_now, $baris, $kolom);
      foreach($neighbors as $n){
        $temp = $pos[$n['x']][$n['y']];
        
        if($temp->is_selected == 0 && ($temp->is_path == 1 || $temp->is_point == 1)){
          $n['d_total'] = $this->d_total($n, $awal, $akhir);
          $n['d_akhir'] = $this->d_from_finish($n, $akhir);

          $pos[$n['x']][$n['y']]->point_before->x =  $pos_now['x'];
          $pos[$n['x']][$n['y']]->point_before->y =  $pos_now['y'];
          array_push($tetangga, $n);
          $temp->is_selected = 1;

          // echo '<pre>' , print_r($pos[$n['x']][$n['y']]) , '</pre>';
        }
      }

      $tetangga_indeks = array_keys($tetangga);

      $d_total = array_column($tetangga, 'd_total');
      $d_min = min($d_total);
      $indeks = array_keys($d_total, $d_min);
      if(count($indeks) > 1){
        $temp_tetangga = array();
        foreach($indeks as $ind){
          array_push($temp_tetangga, $tetangga[$ind]);
        }
        $d_finish = array_column($tetangga, 'd_akhir');
        $d_min = min($d_finish);
        $indeks = array_keys($d_finish, $d_min);

        $sel_indeks = $indeks[0];
      }else{
        $sel_indeks = $indeks[0];
      }
      $temp_indeks = $tetangga_indeks[$sel_indeks];
      $pos_now = $tetangga[$temp_indeks];
      unset($tetangga[$temp_indeks]);
      // echo '<pre>' , print_r($pos_now) , '</pre>';
    }
    
    $direction = array();
    while($pos_now['x'] != $awal['x'] || $pos_now['y'] != $awal['y']){
      $pos[$pos_now['x']][$pos_now['y']]->color = 'black';

      array_push($direction, $pos_now);
      $temp_x = $pos[$pos_now['x']][$pos_now['y']]->point_before->x;
      $temp_y = $pos[$pos_now['x']][$pos_now['y']]->point_before->y;

      $pos_now['x'] = $temp_x;
      $pos_now['y'] = $temp_y;
    }
    $pos[$pos_now['x']][$pos_now['y']]->color = 'black';
    array_push($direction, $pos_now);
    
    $direction = array_reverse($direction);
    echo '<pre>' , print_r($direction) , '</pre>';
  }

  public function save_data(){
    $data = $this->input->post('data');
    
    if ( ! write_file('./data_map/data_map2.json', $data))
    {
      echo 'Unable to write the file';
    }
    else
    {
      echo 'File written!';
    }
  }
}