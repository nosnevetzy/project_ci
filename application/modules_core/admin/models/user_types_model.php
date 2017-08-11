<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User_Types_Model extends MY_Model {

    function __construct() {
        parent:: __construct();
    }

    function getFields($id) {
        self::_select();
        self::_from();
        self::_join();
        self::_fix_arg();
        parent::where(array('ut.id_user_type' => $id));
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
        parent::where(array('ut.id_user_type' => $id));
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
        parent::group_by($group_by);
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

    function getList($where = array(), $where_string = '', $order_by = array()) {
        self::_select();
        self::_from();
        self::_join();
        self::_fix_arg();
        parent::where($where);
        parent::where($where_string);
        parent::orderby($order_by);
        return $query = $this->db->get();
    }

    function getListLimit($where = array(), $where_string = '', $order_by = array(), $page = 0, $number = 0) {
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

    /*
     * From
     * @return void
     */

    private function _from() {
        $this->db->from("default_user_types ut");
    }

    /*
     * SELECT
     * @return void
     */

    private function _select() {
        $this->db->select("
			ut.*,
                       
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
        $this->db->where(array('ut.enabled' => 1));
    }

    /*
     * Insert Query
     * @return id
     */

    function insert_table($data) {
        $this->db->insert("default_user_types", $data);
        return $this->db->insert_id();
    }

    /*
     * Batch Insert Query
     * @return void
     */

    function insert_batch_table($data) {
        $this->db->insert_batch("default_user_types", $data);
    }

    /*
     * Update Where Query
     * @return void
     */

    function update_table($data, $where) {
        self::where($where);
        $this->db->update("default_user_types", $data);
    }

    /*
     * Batch Update Query
     * @return void
     */

    function update_batch_table($data, $table_col) {
        $this->db->update_batch("default_user_types", $data, $table_col);
    }

    /*
     * Delete Query
     * @return void
     */

    function delete_table($table_col, $key) {
        $this->db->delete("default_user_types", array($table_col => $key));
    }

    /*
     * Custom
     */

    function getFields_arr($where, $select, $return = '', $return_value = '') {
        $this->db->select($select);
        self::_from();
        self::_join();
        self::_fix_arg();
        parent::where($where);
        $query = $this->db->get();
        $layer = '';
        foreach ($query->result() as $q) {
            if ($return) {
                if ($return_value) {
                    $layer[$q->{$return}] = $q->{$return_value};
                } else {
                    $layer[$q->{$return}] = $q->{$return};
                }
            } else {
                $layer[$q->{$select}] = $q->{$select};
            }
        }

        return $layer;
    }

}
