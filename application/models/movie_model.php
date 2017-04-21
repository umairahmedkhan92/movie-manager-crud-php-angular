<?php
class Movie_model extends CI_Model{

	static $table = "movie";

    function __construct() {
        parent::__construct();
    }

	function getMovies(){
		$movies = $this->db->get(self::$table);
		return $movies->result();
	}

	function add($data){
		$this->db->insert(self::$table, $data); 
		$id = $this->db->insert_id();
		$data['id'] = $id;
		return $data;
	}

	function edit($data, $id){
		$this->db->where('id', $id);
		$this->db->update(self::$table, $data); 
		return true;
	}

	function delete($id){
		$this->db->delete(self::$table, array('id' => $id)); 
		return true;
	}
}
?>