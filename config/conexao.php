<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = new mysqli("localhost", "root", "", "connectti");

if ($conn->connect_error) {
    die("Erro de conexão com o banco de dados");
}