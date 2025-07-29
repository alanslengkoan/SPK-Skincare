<?php
/*
* Sistem ini menggunakan koneksi database PHP PDO yang dapat menggunakan berbagai jenis Driver SQL
*/

class Koneksi
{

  public $host = 'localhost';
  public $user = 'my_root';
  public $pass = 'my_pass';
  public $dbnm = 'skripsi_spk_kecantikan';
  public $kon;

  // fungsi untuk koneksi ke database menggunakan pdo
  public function kondb()
  {
    try {

      $this->kon = new PDO("mysql:host=$this->host;dbname=$this->dbnm", $this->user, $this->pass);
      $this->kon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $this->kon->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
      $this->kon->setAttribute(PDO::MYSQL_ATTR_DIRECT_QUERY, false);
      // echo "Koneksi Berhasil";

    } catch (PDOException $e) {
      die("Gagal Koneksi " . $e->getMessage());
    }

    return $this->kon;
    $this->kon->close();
  }
}
