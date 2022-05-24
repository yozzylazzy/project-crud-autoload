<?php

namespace App\Models;

class Book
{
    private $id, $judul, $halaman, $kategori, $rating;
    public function __construct($id, $judul = '', $halaman = '', $kategori = '', $rating = '')
    {
        $this->id = $id;
        $this->judul = $judul;
        $this->halaman = $halaman;
        $this->kategori = $kategori;
        $this->rating = $rating;
    }
    public function getId()
    {
        return $this->id;
    }
    public function getJudul()
    {
        return $this->judul;
    }
    public function getHalaman()
    {
        return $this->halaman;
    }
    public function getKategori()
    {
        return $this->kategori;
    }
    public function getRating()
    {
        return $this->rating;
    }
    public function setId($newId)
    {
        $this->id = $newId;
    }
    public function setJudul($newJudul)
    {
        $this->judul = $newJudul;
    }
    public function setHalaman($newHalaman)
    {
        $this->halaman = $newHalaman;
    }
    public function setKategori($newKategori)
    {
        $this->kategori = $newKategori;
    }
    public function setRating($newRating)
    {
        $this->rating = $newRating;
    }
}
