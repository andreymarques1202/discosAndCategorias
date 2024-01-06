<?php

$databasePath = __DIR__ . "/banco.sqlite";
$connect = new PDO("sqlite:$databasePath");

$createTableSql = "CREATE TABLE IF NOT EXISTS categorias (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nome TEXT NOT NULL,
    observacao TEXT);
    
    CREATE TABLE IF NOT EXISTS discos (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nome TEXT NOT NULL,
    ano INTEGER,
    categoria_id INTEGER,
    FOREIGN KEY (categoria_id) REFERENCES categorias(id)
    )";

    $connect->exec($createTableSql);