# CI-BACKUPDB-FTP
Codeigniter library backup database to ftp server

## Instalasi
Letakkan file sesuai folder project CI

## Penggunaan
1. Konfigurasi hostname, username, dan password FTP pada controller Backup
   ```php
    public function db(){
    	$config = [
    		'hostname' => '127.0.0.1',
    		'username' => 'zulfizz',
    		'password' => 'pa55w0rd'
    	];

    	$this->backupdb->backup($config);
    }
   ```
2. Jalankan fungsi setiap jam 00.00 melalui cron job
    ```
        crontab -e
    ```
    lalu isi dengan  `0 0 * * * php project-directory/index.php backup db`


* Hasil backup akan tersimpan di `project-directory/backup`  dan server FTP