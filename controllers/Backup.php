<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backup extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->library('backupdb');
    }

    public function db(){
    	$config = [
    		'hostname' => '127.0.0.1',
    		'username' => 'zulfizz',
    		'password' => 'pa55w0rd'
    	];

    	$this->backupdb->backup($config);
    }

}
