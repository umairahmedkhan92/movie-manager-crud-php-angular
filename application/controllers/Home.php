<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	/**
	 * Constructor funtion
	 */
	public function __construct()
    {
        parent::__construct();
    }

	/**
     * For shwoing default view
     * @return void
	 */
	public function index()
	{
		$this->load->view('home');
	}
}
