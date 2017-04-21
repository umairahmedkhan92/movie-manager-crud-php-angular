<?php
class Movie_model extends CI_Model{

	static $table = "movie";

	/**
     * For getting all the movies from database
     * @return array of all the movies
	 */
	function getMovies(){
		$movies = $this->db->get(self::$table);
		return $movies->result();
	}

	/**
     * For inserting movie data into database
     * @param array of data
     * @return array of inserted row
	 */
	function add($data){
		$this->db->insert(self::$table, $data); 
		$id = $this->db->insert_id();
		$data['id'] = $id;
		return $data;
	}

	/**
     * For updating movie data into database
     * @param array of data and id
     * @return boolean
	 */
	function edit($data, $id){
		$this->db->where('id', $id);
		$this->db->update(self::$table, $data); 
		return true;
	}

	/**
     * For updating movie data into database
     * @param id of movie
     * @return boolean
	 */
	function delete($id){
		$this->db->delete(self::$table, array('id' => $id)); 
		return true;
	}
}
?>