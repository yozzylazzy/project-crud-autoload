<?php

namespace App\Controllers;

use App\Models\Book;
use App\Helpers\Connection;

use PDO, PDOException;

class BookController
{
    public static function getAllBooks()
    {
        $sql = "SELECT * FROM buku";
        try {
            $conn = Connection::createConnection();
            $result = $conn->query($sql, PDO::FETCH_ASSOC);
            $books = [];
            while ($book = $result->fetch()) {
                $books[] =  new Book($book['id'], $book['judul'], $book['halaman'], $book['kategori'], $book['rating']);
            }
            return $books;
        } catch (PDOException $e) {
            die('Error reading data: ' . $e->getMessage());
        }
    }
    public static function getOneBook($id)
    {
        try {
            $conn = Connection::createConnection();
            $sql = "SELECT * FROM buku WHERE id = $id";
            $result = $conn->query($sql, PDO::FETCH_ASSOC);
            $book = $result->fetch();
            return $book;
        } catch (PDOException $e) {
            die('Error reading data: ' . $e->getMessage());
        }
    }

    public static function addBook($data)
    {
        try {
            $conn = Connection::createConnection();
            $sql = 'INSERT INTO buku (judul, kategori, halaman, rating) VALUES (?, ?, ?,?)';
            $statement = $conn->prepare($sql);
            $statement->execute([
                $data['judul'], $data['kategori'], $data['halaman'], $data['rating']
            ]);
        } catch (PDOException $e) {
            die('Error creating data: ' . $e->getMessage());
        }
    }

    public static function updateBook($buku)
    {
        try {
            $conn = Connection::createConnection();
            $sql = 'UPDATE buku SET judul=?, kategori=?, halaman=?, rating=? WHERE id=?';
            $statement = $conn->prepare($sql);
            $statement->execute([
                $buku['judul'], $buku['kategori'], $buku['halaman'], $buku['rating'], $buku['id']
            ]);
        } catch (PDOException $e) {
            die('Error creating data: ' . $e->getMessage());
        }
    }

    public static function deleteBook($id)
    {
        try {
            $conn = Connection::createConnection();
            $sql = "DELETE FROM buku WHERE id = $id";
            $conn->query($sql);
        } catch (PDOException $e) {
            die('Error deleting data: ' . $e->getMessage());
        }
    }

    public static function sortAscLihat($param)
    {
        $sql  = "SELECT * FROM buku ORDER BY $param";
        try {
            $conn = Connection::createConnection();
            $result = $conn->query($sql, PDO::FETCH_ASSOC);
            $books = [];
            while ($book = $result->fetch()) {
                $books[] =  new Book($book['id'], $book['judul'], $book['halaman'], $book['kategori'], $book['rating']);
            }
            return $books;
        } catch (PDOException $e) {
            die('Error reading data: ' . $e->getMessage());
        }
    }

    public static function averageRate()
    {
        try {
            $conn = Connection::createConnection();
            $sql = "SELECT AVG(rating) FROM buku";
            $temp = $conn->query($sql);
            $avg = $temp->fetch();
            return $avg[0];
        } catch (PDOException $e) {
            die('Error reading data: ' . $e->getMessage());
        }
    }
    public static function jumlahBuku()
    {
        try {
            $conn = Connection::createConnection();
            $sql = "SELECT COUNT(*) FROM buku";
            $temp = $conn->query($sql);
            $avg = $temp->fetch();
            return $avg[0];
        } catch (PDOException $e) {
            die('Error reading data: ' . $e->getMessage());
        }
    }
    public static function maksHalaman()
    {
        try {
            $conn = Connection::createConnection();
            $sql = "SELECT MAX(halaman) FROM buku";
            $temp = $conn->query($sql);
            $avg = $temp->fetch();
            return $avg[0];
        } catch (PDOException $e) {
            die('Error reading data: ' . $e->getMessage());
        }
    }
}
