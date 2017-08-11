<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Configs_Model extends MY_Model {

    function __construct() {
        parent:: __construct();
    }

    function getFields($id) {
        self::_select();
        self::_from();
        parent::where(array('co.id_config' => $id));
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        }

        return false;
    }

    function getValue($id, $select, $return = '') {
        $this->db->select($select);
        self::_from();
        parent::where(array('co.id_config' => $id));
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

    function getList() {
        
    }

    /*
     * From
     * @return void
     */

    private function _from() {
        $this->db->from("default_configs co");
    }

    /*
     * SELECT
     * @return void
     */

    private function _select() {
        $this->db->select("
			co.*
		");
    }

    /*
     * Insert Query
     * @return id
     */

    function insert_table($data) {
        $this->db->insert("default_configs", $data);
        return $this->db->insert_id();
    }

    /*
     * Batch Insert Query
     * @return void
     */

    function insert_batch_table($data) {
        $this->db->insert_batch("default_configs", $data);
    }

    /*
     * Update Query
     * @return void
     */

    function update_table($data, $where) {
        $this->db->where($where);
        $this->db->update("default_configs", $data);
    }

    /*
     * Batch Update Query
     * @return void
     */

    function update_batch_table($data, $table_col) {
        $this->db->update_batch("default_configs", $data, $table_col);
    }

    /*
     * Delete Query
     * @return void
     */

    function delete_table($table_col, $key) {
        $this->db->delete("default_configs", array($table_col => $key));
    }

    /*
     * Custom
     */

    function getconfig_value($config_name) {
        self::_select();
        self::_from();
        parent::where(array('co.config_name' => $config_name));
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->config_value;
        }

        return false;
    }

}
