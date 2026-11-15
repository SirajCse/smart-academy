<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Category_model extends MY_Model
{

	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * This funtion takes id as a parameter and will fetch the record.
	 * If id is not provided, then it will fetch all the records form the table.
	 * @param int $id
	 * @return mixed
	 */
	public function get($id = null)
	{
		$this->db->select()->from('categories');
		if ($id != null) {
			$this->db->where('id', $id);
		} else {
			$this->db->order_by('id');
		}
		$query = $this->db->get();
		if ($id != null) {
			return $query->row_array();
		} else {
			return $query->result_array();
		}
	}

	/**
	 * This function will delete the record based on the id
	 * @param $id
	 */
	public function remove($id)
	{
		$this->db->trans_start(); # Starting Transaction
		$this->db->trans_strict(false); # See Note 01. If you wish can remove as well
		//=======================Code Start===========================
		$this->db->where('id', $id);
		$this->db->delete('categories');
		$message   = DELETE_RECORD_CONSTANT . " On categories id " . $id;
		$action    = "Delete";
		$record_id = $id;
		$this->log($message, $record_id, $action);
		//======================Code End==============================
		$this->db->trans_complete(); # Completing transaction
		/* Optional */
		if ($this->db->trans_status() === false) {
			# Something went wrong.
			$this->db->trans_rollback();
			return false;
		} else {
			//return $return_value;
		}
	}

	/**
	 * This function will take the post data passed from the controller
	 * If id is present, then it will do an update
	 * else an insert. One function doing both add and edit.
	 * @param $data
	 */
	public function add($data)
	{
		$this->db->trans_start(); # Starting Transaction
		$this->db->trans_strict(false); # See Note 01. If you wish can remove as well
		//=======================Code Start===========================
		if (isset($data['id'])) {
			$this->db->where('id', $data['id']);
			$this->db->update('categories', $data);
			$message   = UPDATE_RECORD_CONSTANT . " On  categories id " . $data['id'];
			$action    = "Update";
			$record_id = $data['id'];
			$this->log($message, $record_id, $action);
			//======================Code End==============================

			$this->db->trans_complete(); # Completing transaction
			/* Optional */

			if ($this->db->trans_status() === false) {
				# Something went wrong.
				$this->db->trans_rollback();
				return false;
			} else {
				//return $return_value;
			}
		} else {
			$this->db->insert('categories', $data);
			$id        = $this->db->insert_id();
			$message   = INSERT_RECORD_CONSTANT . " On  categories id " . $id;
			$action    = "Insert";
			$record_id = $id;
			$this->log($message, $record_id, $action);
			//======================Code End==============================

			$this->db->trans_complete(); # Completing transaction
			/* Optional */

			if ($this->db->trans_status() === false) {
				# Something went wrong.
				$this->db->trans_rollback();
				return false;
			} else {
				//return $return_value;
			}
			return $id;
		}
	}

	/**
	 * NEW: Fetch a category by its label (name).
	 * Used by Student::import() to resolve a text label from CSV
	 * to its numeric category_id.
	 *
	 * @param string $label
	 * @return array|null
	 */
	public function getCategoryByLabel($label)
	{
		$label = trim($label);

		if ($label === '' || $label === null) {
			return null;
		}

		$this->db->select('id, category');
		$this->db->from('categories');
		$this->db->where('LOWER(category)', strtolower($label));
		$this->db->limit(1);
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			return $query->row_array();
		}

		// Fallback: also try exact match in case of case-sensitive collation
		$this->db->select('id, category');
		$this->db->from('categories');
		$this->db->where('category', $label);
		$this->db->limit(1);
		$query = $this->db->get();

		return $query->num_rows() > 0 ? $query->row_array() : null;
	}
}