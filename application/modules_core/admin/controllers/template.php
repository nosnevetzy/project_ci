<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Template extends System_Core {

    function __construct() {
        $this->classname = strtolower(get_class());
        $this->pagename = $this->uri->rsegment(2);
        $this->methodname = $this->uri->rsegment(3);
        parent:: __construct();
    }

    /* ------------------------------------------------------------------------------------------------------------------------------------------- */
    /* ------------------------------- Page Function --------------------------------------------------------------------------------------------- */
    /* ------------------------------------------------------------------------------------------------------------------------------------------- */

    function confirmation() {
        $id = @$_POST['id']? : "NULL";
        $item = @$_POST['item']? : "NULL";
        $data = array(
            'item' => $item,
            'id' => $id,
            'message' => $_POST['message'],
            'action' => $_POST['action'],
            'redirect' => $_POST['redirect']
        );

        $this->load->view(admin_dir('template/confirmation'), $data);
    }

}
