<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$data['title'] = 'ini';
		$this->load->library('Template');
		$this->template->layout('peta/peta',$data);

		// $this->load->view('peta/peta');
	}

	public function rute(){
		$this->load->helper('file');
		$map_data = read_file('./data_map/data_map.json');
		// $map_data  = json_decode($json);

		$data = array(
			'image_data' => 'contoh.png',
			'image_width' => 500,
			'image_height' => 1000,
			'grid_x' => 20,
			'grid_y' => 10,
			'map_data' => $map_data
		);
		$data2['js'] = $this->load->view('rute/rute.js', $data, TRUE);
		$this->load->view('rute/rute', $data2);
	}

	public function make_rute2(){
		$data['title'] = 'ini';
		$this->load->library('Template');
		$this->template->layout('rute2/peta',$data);
	}
	public function save_map(){
		$data = $this->input->post();
		$file_name = 'ini_nama';

		$config['upload_path'] = './assets/maps/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = 1024 * 8;
		$config['file_name'] = $file_name;
		$config['overwrite'] = TRUE;

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('bg_file')){
			$res = array('status' => 'error');
		}
		else{			
			$res = array('status' => 'success');

			$json_data = array(
				'point' => $data['point'],
				'path' => $data['path'],
			);

			if ( ! write_file('./assets/data_maps/'.$file_name.'.json', json_encode($json_data))){
				$res['json_file'] = 'error';
			}else{
				$res['json_file'] = 'success';
			}
			
		}
		echo json_encode($res);
	}
	
	public function map_view(){
		$json = read_file('./assets/data_maps/ini_nama.json');
		$data  = json_decode($json);
		// echo '<pre>' . print_r($data) . '</pre>';

		$this->template->layout('rute2/view_map');
	}
	public function load_map(){
		$json = read_file('./assets/data_maps/ini_nama.json');
		$data  = json_decode($json);

		echo $json;
	}

	function dist($point1, $point2){
		
		$x = ($point1['x'] - $point2['x']);
		$y = ($point1['y'] - $point2['y']);

		$distance = sqrt(pow($x,2) + pow($y,2));

		return $distance;
	}

	public function find_route(){
		// $lokasi = $this->input->post('lokasi');
		// $tujuan = $this->input->post('tujuan');
		// $map_name = $this->input->post('map_name');

		$map_name = 'ini_nama';

		$lokasi['x'] = 698;
		$lokasi['y'] = 271;

		$tujuan['x'] = 405.6875;
		$tujuan['y'] = 455;

		$json = read_file('./assets/data_maps/'.$map_name.'.json');
		$data_map = json_decode($json);

		$temp_key = 0;
		$temp_dist = '';
		$points = json_decode($data_map->point);

		for ($i=0; $i < count($points); $i++) { 
			$current_dist = $this->dist($lokasi, (array)$points[$i]);
			if ($current_dist < $temp_dist || $temp_dist == '') {
				$temp_dist = $current_dist;
				$temp_key = $i;
			}
		}
		
		
	}
}
