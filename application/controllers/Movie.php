<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Movie extends CI_Controller {

	/**
	*/
	public function __construct()
    {
        parent::__construct();
        $this->load->model("movie_model");
    }

	/**
	 */
	public function index()
	{
		$this->load->view('movie');
	}

	/**
	 */
	public function view()
	{
		$result = $this->movie_model->getMovies();
		if($result){
            $data['records'] = $result;
            $data['status'] = 'OK';
        }else{
            $data['status'] = 'ERROR';
        }
        echo json_encode($data);
	}

	/**
	 */
	public function add()
	{
		if(!empty($_POST['data']['title']) && !empty($_POST['data']['format']) && !empty($_POST['data']['length']) && !empty($_POST['data']['release_year'])){

			$release_year = $_POST['data']['release_year'];
			$length = $_POST['data']['length'];
			if($release_year <= 1800 || $release_year >= 2100){
				$data['status'] = 'ERROR';
                $data['msg'] = 'Invalid Year Provided.';
			}
			else if($length <= 0 || $length >= 500){
				$data['status'] = 'ERROR';
                $data['msg'] = 'Invalid Length Provided.';
			}
			else{
				$movieData = array(
	                'title' => $_POST['data']['title'],
	                'format' => $_POST['data']['format'],
	                'length' => $length,
	                'release_year' => $release_year,
	                'rating' => $_POST['data']['rating']
	            );
	            $insert = $this->movie_model->add($movieData);
	            if($insert){
	                $data['data'] = $insert;
	                $data['status'] = 'OK';
	                $data['msg'] = 'Movie has been added successfully!';
	            }else{
	                $data['status'] = 'ERROR';
	                $data['msg'] = 'Oops.. Something went wrong, please try again.';
	            }
			}
        }else{
            $data['status'] = 'ERROR';
            $data['msg'] = 'Please fill out the required fields.';
        }
        echo json_encode($data);
	}

	/**
	 */
	public function edit()
	{
		if(!empty($_POST['data']['title']) && !empty($_POST['data']['format']) && !empty($_POST['data']['length']) && !empty($_POST['data']['release_year']) && !empty($_POST['data']['id'])){

			$release_year = $_POST['data']['release_year'];
			$length = $_POST['data']['length'];
			if($release_year <= 1800 || $release_year >= 2100){
				$data['status'] = 'ERROR';
                $data['msg'] = 'Invalid Year Provided.';
			}
			else if($length <= 0 || $length >= 500){
				$data['status'] = 'ERROR';
                $data['msg'] = 'Invalid Length Provided.';
			}
			else{
				$movieData = array(
	                'title' => $_POST['data']['title'],
	                'format' => $_POST['data']['format'],
	                'length' => $length,
	                'release_year' => $release_year,
	                'rating' => $_POST['data']['rating']
	            );
	            $id = $_POST['data']['id'];
	            $update = $this->movie_model->edit($movieData, $id);
	            if($update){
	                $data['status'] = 'OK';
	                $data['msg'] = 'Movie data has been updated successfully!';
	            }else{
	                $data['status'] = 'ERROR';
	                $data['msg'] = 'Oops.. Something went wrong, please try again.';
	            }
			}
        }else{
            $data['status'] = 'ERROR';
            $data['msg'] = 'Please fill out the required fields.';
        }
        echo json_encode($data);
	}

	/**
	 */
	public function delete()
	{
		$id = $this->input->post("id");
		if(!empty($id)){
            $delete = $this->movie_model->delete($id);
            if($delete){
                $data['status'] = 'OK';
                $data['msg'] = 'Movie deleted successfully!';
            }else{
                $data['status'] = 'ERROR';
                $data['msg'] = 'Oops.. Something went wrong, please try again.';
            }
        }else{
            $data['status'] = 'ERROR';
            $data['msg'] = 'Oops.. Something went wrong, please try again.';
        }
        echo json_encode($data);
	}
}
