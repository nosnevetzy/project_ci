<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User_Accesses_Model extends MY_Model {

    function __construct() {
        parent:: __construct();
    }

    function getFields($id) {
        self::_select();
        self::_from();
        self::_join();
        self::_fix_arg();
        parent::_where(array('id_user_access' => $id));
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
        parent::where(array('usa.id_user_access' => $id));
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

    function getList() {
        
    }

    /*
     * From
     * @return void
     */

    private function _from() {
        $this->db->from("default_user_accesses usa");
    }

    /*
     * SELECT
     * @return void
     */

    private function _select() {
        $this->db->select("
			usa.*,
			cf.id_class_function, cf.class_function_name, cf.class_function_title, cf.class_function_type,
			ut.id_user_type, ut.user_type,
			au.user_fname as add_user_fname, au.user_mname as add_user_mname, au.user_lname as add_user_lname, au.user_code as add_user_code,au.user_email as add_user_email, au.user_picture as add_user_picture,
			uu.user_fname as update_user_fname, uu.user_mname as update_user_mname, uu.user_lname as update_user_lname, uu.user_code as update_user_code,uu.user_email as update_user_email, uu.user_picture as update_user_picture
		");
    }

    /*
     * JOIN
     * @return void
     */

    private function _join() {
        $this->db->join('default_class_functions cf', 'cf.id_class_function = usa.class_function_id', 'left');
        $this->db->join('default_user_types ut', 'ut.id_user_type = usa.user_type_id', 'left');
        $this->db->join('default_users au', 'au.id_user = usa.added_by', 'left');
        $this->db->join('default_users uu', 'uu.id_user = usa.updated_by', 'left');
    }

    /*
     * Fix Argument
     * @return void
     */

    private function _fix_arg() {
        $this->db->where(array('usa.enabled' => 1));
    }

    /*
     * Insert Query
     * @return id
     */

    function insert_table($data) {
        $this->db->insert("default_user_accesses", $data);
        return $this->db->insert_id();
    }

    /*
     * Batch Insert Query
     * @return void
     */

    function insert_batch_table($data) {
        $this->db->insert_batch("default_user_accesses", $data);
    }

   
    /*
     * Update Where Query
     * @return void
     */

    function update_table($data, $where) {
        self::where($where);
        $this->db->update("default_user_accesses", $data);
    }

    /*
     * Batch Update Query
     * @return void
     */

    function update_batch_table($data, $table_col) {
        $this->db->update_batch("default_user_accesses", $data, $table_col);
    }

    /*
     * Delete Query
     * @return void
     */

    function delete_table($table_col, $key) {
        $this->db->delete("default_user_accesses", array($table_col => $key));
    }

    /*
     * Custom
     */

    /*
     * Get User by Method
     */

    function get_user_bymethod($class, $type, $function) {
        $type_id = 1;
        if ($type == 'method')
            $type_id = 2;
        $this->db->distinct(" u.*");
        self::_from();

        $this->db->join('default_class_functions cf', 'cf.id_class_function = usa.class_function_id', 'left');
        $this->db->join('default_user_types ut', 'ut.id_user_type = usa.user_type_id', 'left');
        $this->db->join('default_users u', 'ut.id_user_type = u.user_type_id', 'left');
        $this->db->join('default_classes c', 'c.id_class = cf.class_id', 'left');

        $where = array(
            'class_name' => $class,
            'class_function_type' => $type_id,
            'class_function_name' => $function,
            'user_access_status' => 1,
            'u.id_user !=' => 0,
            'u.id_user !=' => '',
            'u.enabled' => 1
        );

        parent::where($where);
        // parent::group_by("u.id_user");
        parent::orderby(array('u.user_lname' => 'ASC', 'u.user_fname' => 'ASC'));

        $query = $this->db->get();

        return $query;
    }

}
