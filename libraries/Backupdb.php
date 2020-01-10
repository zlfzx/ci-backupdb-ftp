<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backupdb
{
    var $CI;
    
    public function __construct(){
        $this->CI =& get_instance();
        $this->CI->load->database();
        $this->CI->load->helper('file');
        $this->CI->load->helper('download');
        $this->CI->load->library('zip');
        $this->CI->load->library('ftp');
        $this->CI->load->dbutil();
    }

    public function backup($ftp){
        $db_format = ['format' => 'zip', 'filename' => 'database.sql'];
        $backup = $this->CI->dbutil->backup($db_format);

        if (!is_dir('backup')) {
            mkdir('backup');
        }

        $dbname = 'backup_'.date('d-M-Y').'_db.zip';
        $save = FCPATH.'backup/'.$dbname;
        $res = write_file($save, $backup);

        if ($res) {
            // FTP configuration
            $ftp_config['hostname'] = $ftp['hostname'];
            $ftp_config['username'] = $ftp['username'];
            $ftp_config['password'] = $ftp['password'];
            $ftp_config['debug']    = TRUE;
            
            // Connect to FTP server
            $this->CI->ftp->connect($ftp_config);
            
            // upload file to FTP server
            $this->CI->ftp->upload($save, '/'.$dbname);

            // Close FTP server
            $this->CI->ftp->close();
            echo json_encode(['status' => TRUE])."\n";
        } else {
            echo json_encode(['status' => FALSE])."\n";
        }

    }
}
