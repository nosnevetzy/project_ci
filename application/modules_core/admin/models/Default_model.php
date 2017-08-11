<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  |--------------------------------------------------------------------------
  | Default Model Class
  |--------------------------------------------------------------------------
  |
  | Handles the Default records
  |
  | @category		Model
  | @author		default
 */

class Default_model extends MY_Model {

    // ------------------------------------------------------------------------

    /*
     * Constructor
     *
     * Called automatically
     * Inherits method from the parent class
     */
    function __construct($id = '', $table = '', $parameters = array()) {
        parent::__construct($id, $table, 'id_' . singular($table));
        $this->parameter = $parameters;
    }

    // ------------------------------------------------------------------------

    /*
     * Get values from object
     *
     * @access 		public
     * @return		array
     */
    public function getObjectFields() {

        if (isset($this->id)) {
            if ($this->db->table_exists($this->table)) {
                $fields = $this->db->list_fields($this->table);
                $fields[$this->identifier] = (int) $this->misc->decode_id($this->id);
                foreach ($fields as $field) {
                    $fields[$field] = (int) $this->$field;
                }
            }
            return $fields;
        }
    }

    function getFields($id) {
        self::_select();
        self::_from();
        self::_join();
        self::_fix_arg();
        parent::where(array("t.$this->identifier" => $id));
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
        parent::where(array("t.$this->identifier" => $id));
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

    function getList($where = array(), $order_by = array(), $where_string = array()) {
        self::_select();
        self::_from();
        self::_join();
        self::_fix_arg();
        parent::where($where);
        parent::where_string($where_string);
        parent::orderby($order_by);
        return $query = $this->db->get();
    }

    function getListLimit($page, $number, $where = array(), $order_by = array(), $where_string = array()) {
        self::_select();
        self::_from();
        self::_join();
        self::_fix_arg();
        parent::where($where);
        parent::where_string($where_string);
        parent::orderby($order_by);
        parent::pagelimit($page, $number);
        return $query = $this->db->get();
    }

    /*
     * From
     * @return void
     */

    private function _from() {
        $this->db->from("$this->table t");
    }

    /*
     * SELECT
     * @return void
     */

    private function _select() {
        if (isset($this->parameter['select'])) {
            $this->db->select($this->parameter['select']);
        }
    }

    /*
     * JOIN
     * @return void
     */

    private function _join() {
        if (isset($this->parameter['join'])) {
            foreach ($this->parameter['join'] as $table_data) {
                $this->db->join($table_data[0], $table_data[0] . '.' . $table_data[1] . ' = ' . 't.' . $table_data[2], 'left');
            }
        }
        if (isset($this->parameter['special_join'])) {
            self::_special_join($this->parameter['special_join']);
        }
    }

    /*
     * JOIN
     * @return void
     */

    private function _special_join($param = array()) {
        foreach ($param as $val) {
            $this->db->join($val[0], $val[1], $val[2]);
        }
    }

    /*
     * Fix Argument
     * @return void
     */

    private function _fix_arg() {
        $this->db->where(array("t.enabled" => 1));
    }

    /*
     * Insert Query
     * @return id
     */

    function insert_table($data) {
        $this->db->insert("$this->table", $data);
        return $this->db->insert_id();
    }

    /*
     * Batch Insert Query
     * @return void
     */

    function insert_batch_table($data) {
        $this->db->insert_batch("$this->table", $data);
    }

    /*
     * Update Query
     * @return id
     */

    function update_table($data, $where) {
        $this->db->where($where);
        $this->db->update("$this->table", $data);
        return 1;
    }

    /*
     * Batch Update Query
     * @return void
     */

    function update_batch_table($data, $table_col) {
        $this->db->update_batch("$this->table", $data, $table_col);
    }

    /*
     * Delete Query
     * @return void
     */

    function delete_table($table_col, $key) {
        $this->db->delete("$this->table", array($table_col => $key));
    }

}
