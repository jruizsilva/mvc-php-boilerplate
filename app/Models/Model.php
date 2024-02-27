<?php

namespace App\Models;

use mysqli;

class Model
{
  protected $db_host = DB_HOST;
  protected $db_user = DB_USER;
  protected $db_pass = DB_PASS;
  protected $db_name = DB_NAME;
  protected $conn;
  protected $query;

  protected $table;

  public function __construct()
  {
    $this->connection();
  }

  public function connection()
  {
    $this->conn = new mysqli($this->db_host, $this->db_user, $this->db_pass, $this->db_name);

    if ($this->conn->connect_error) {
      die('Connection Failed' . $this->conn->connect_error);
    }
  }

  public function query($sql)
  {
    $this->query = $this->conn->query($sql);
    return $this;
  }

  public function first()
  {
    return $this->query->fetch_assoc();
  }

  public function get()
  {
    return $this->query->fetch_all(MYSQLI_ASSOC);
  }

  // Consultas

  public function all()
  {
    $sql = "SELECT * FROM {$this->table}";
    return $this->query($sql)->get();
  }

  public function find($id)
  {
    $sql = "SELECT * FROM {$this->table} WHERE id = $id";
    return $this->query($sql)->first();
  }

  public function where($column, $operador, $value = null)
  {
    if ($value == null) {
      $value = $operador;
      $operador = '=';
    }

    $sql = "SELECT * FROM {$this->table} WHERE {$column} {$operador} {$value}";
    $this->query($sql);
    return $this;
  }
}