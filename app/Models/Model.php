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

  protected $sql, $data = [], $params = null;

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

  public function query($sql, $data = [], $params = null)
  {
    if ($data) {

      if ($params == null) {
        $params = str_repeat('s', count($data));
      }

      $stmt = $this->conn->prepare($sql);
      $stmt->bind_param($params, ...$data);
      $stmt->execute();
      $this->query = $stmt->get_result();
    } else {
      $this->query = $this->conn->query($sql);
    }
    return $this;
  }

  public function first()
  {
    if (empty($this->query)) {
      $this->query($this->sql, $this->data, $this->params);
    }
    return $this->query->fetch_assoc();
  }

  public function get()
  {
    if (empty($this->query)) {
      $this->query($this->sql, $this->data, $this->params);
    }
    return $this->query->fetch_all(MYSQLI_ASSOC);
  }

  public function paginate($cant = 15)
  {
    $page = $_GET['page'] ?? 1;

    if ($this->sql) {
      $sql = $this->sql . " LIMIT " . ($page - 1) * $cant . ", {$cant}";
      $data = $this->query($sql, $this->data, $this->params)->get();
    } else {
      $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM {$this->table} LIMIT " . ($page - 1) * $cant . ", {$cant}";
      $data = $this->query($sql)->get();
    }



    $total = $this->query('SELECT FOUND_ROWS() as total')->first()['total'];

    $uri = $_SERVER['REQUEST_URI'];
    $uri = trim($uri, '/');

    if (strpos($uri, '?') !== false) {
      $uri = substr($uri, 0, strpos($uri, '?'));
    }
    $last_page = ceil($total / $cant);

    return [
      'total' => $total,
      'from' => ($page - 1) * $cant + 1,
      'to' => ($page - 1) * $cant + count($data),
      'current_page' => $page,
      'last_page' => $last_page,
      'next_page_url' => $page < $last_page ? $uri . '?page=' . $page + 1 : null,
      'prev_page_url' => $page > 1 ? '/' . $uri . '?page=' . $page - 1 : null,
      'data' => $data
    ];
  }

  // Consultas

  public function all()
  {
    $sql = "SELECT * FROM {$this->table}";
    return $this->query($sql)->get();
  }

  public function find($id)
  {
    $sql = "SELECT * FROM {$this->table} WHERE id = ?";
    return $this->query($sql, [$id], 'i')->first();
  }

  public function where($column, $operador, $value = null)
  {
    if ($value == null) {
      $value = $operador;
      $operador = '=';
    }

    if (empty($this->sql)) {
      $this->sql = "SELECT SQL_CALC_FOUND_ROWS * FROM {$this->table} WHERE {$column} {$operador} ?";
      $this->data[] = $value;
    } else {
      $this->sql .= " AND {$column} {$operador} ?";
      $this->data[] = $value;
    }

    return $this;
  }

  public function create($data)
  {
    $columns = array_keys($data);
    $columns = implode(', ', $columns);

    $values = array_values($data);
    $sql = "INSERT INTO {$this->table} ({$columns}) VALUES (" . str_repeat('?, ', count($values) - 1) . "?)";

    $this->query($sql, $values);
    $insert_id = $this->conn->insert_id;

    return $this->find($insert_id);
  }

  public function update($id, $data)
  {
    $fields = [];
    foreach ($data as $key => $value) {
      $fields[] = "{$key} = ?";
    }
    $fields = implode(', ', $fields);
    $sql = "UPDATE {$this->table} SET {$fields} WHERE id = ?";
    $values = array_values($data);
    $values[] = $id;
    $this->query($sql, $values);

    return $this->find($id);
  }

  public function delete($id)
  {
    $sql = "DELETE FROM {$this->table} WHERE id = ?";
    $this->query($sql, [$id], 'i');
  }
}