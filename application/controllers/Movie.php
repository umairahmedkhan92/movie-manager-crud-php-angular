<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Movie extends CI_Controller {

	/**
	 * Constructor funtion used for loading model class
	 */
	public function __construct()
    {
        parent::__construct();
        $this->load->model("movie_model");
    }

	/**
     * For shwoing default view
     * @return void
	 */
	public function index()
	{
		$this->load->view('movie');
	}

	/**
     * For getting the list of all the movies and passing it back to view
     * @return stirng
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
     * For validating the input data and inserting it into database and updating the view
     * @return stirng
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
     * For validating the updated data and updating it into database and push back changes to the view
     * @return stirng
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
     * For deleting the movie data from database and passing confirmation to the view
     * @return stirng
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
