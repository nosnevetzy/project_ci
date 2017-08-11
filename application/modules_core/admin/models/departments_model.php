<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Departments_Model extends MY_Model {

    function __construct() {
        parent:: __construct();
    }

    function getFields($id) {
        self::_select();
        self::_from();
        self::_join();
        self::_fix_arg();
        parent::where(array('d.id_department' => $id));
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row();
        }

        return false;
    }

    function getValue($id, $select, $return = '') {
        $this->db->select($select);
        self::_from();
        self::_join();
        self::_fix_arg();
        parent::where(array('d.id_department' => $id));
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $row = $query->row();
            if ($return) {
                return (!empty($row->{$return})) ? $row->{$return} : false;
            }
            return (!empty($row->{$select})) ? $row->{$select} : false;
        }
        return false;
    }

    function getSearch($where = array(), $group_by = array(), $order_by = array(), $result = FALSE, $count = FALSE, $row = FALSE) {
        self::_select();
        self::_from();
        self::_join();
        self::_fix_arg();
        parent::where($where);

        //parent::group_by($group_by);
        parent::orderby($order_by);
        $query = $this->db->get();

        if ($result) {
            return $query->result();
        }

        if ($count) {
            return $query->num_rows();
        }

        if ($row) {
            if ($query->num_rows() > 0)
                return $query->row();
            return false;
        }

        return $query;
    }

    function getList($where, $where_string, $order_by) {
        self::_select();
        self::_from();
        self::_join();
        self::_fix_arg();
        parent::where($where);
        parent::where_string($where_string);
        // parent::group_by("ut.id_user_type");
        parent::orderby($order_by);
        return $query = $this->db->get();
    }

    function getList1($where, $where_string, $order_by) {
        $this->db->select("
			r.*,
                       ");
        self::_from();
        self::_fix_arg();
        parent::where($where);
        parent::where_string($where_string);
        // parent::group_by("ut.id_user_type");
        parent::orderby($order_by);
        return $query = $this->db->get();
    }

    function getListLimit($where, $where_string, $order_by, $page, $number) {
        self::_select();
        self::_from();
        self::_join();
        self::_fix_arg();
        parent::where($where);
        parent::where_string($where_string);
        // parent::group_by("ut.id_user_type");
        parent::orderby($order_by);
        parent::pagelimit($page, $number);
        return $query = $this->db->get();
    }

    function getListLimit2($where, $where_string, $order_by, $page, $number) {
        self::_select();
        self::_from();
        self::_fix_arg();
        parent::where($where);
        parent::where_string($where_string);
        // parent::group_by("ut.id_user_type");
        parent::orderby($order_by);
        parent::pagelimit($page, $number);
        return $query = $this->db->get();
    }

   

    /*
     * From
     * @return void
     */

    private function _from() {
        $this->db->from("default_departments d");
    }

    /*
     * SELECT
     * @return void
     */

    private function _select() {
        $this->db->select("
			d.*,
		");
    }

    /*
     * JOIN
     * @return void
     */

    private function _join() {
    }

    /*
     * Fix Argument
     * @return void
     */

    private function _fix_arg() {
        $this->db->where(array('d.enabled' => 1));
    }

    /*
     * Insert Query
     * @return id
     */

    function insert_table($data) {
        $this->db->insert("default_departments", $data);
        return $this->db->insert_id();
    }

    /*
     * Batch Insert Query
     * @return void
     */

    function insert_batch_table($data) {
        $this->db->insert_batch("default_departments", $data);
    }

  
    /*
     * Update Where Query
     * @return void
     */

    function update_table($data, $where) {
        self::where($where);
        $this->db->update("default_departments", $data);
    }

    /*
     * Batch Update Query
     * @return void
     */

    function update_batch_table($data, $table_col) {
        $this->db->update_batch("default_departments", $data, $table_col);
    }

    /*
     * Delete Query
     * @return void
     */

    function delete_table($table_col, $key) {
        $this->db->delete("default_departments", array($table_col => $key));
    }

}
