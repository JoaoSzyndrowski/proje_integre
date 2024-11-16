<?php
$servername = "localhost";
$database = "misturasoft";
$username = "root";
$password = "";

// criando conexão
$conn = new mysqli($servername, $username, $password, $database);

// verificando conexão
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
