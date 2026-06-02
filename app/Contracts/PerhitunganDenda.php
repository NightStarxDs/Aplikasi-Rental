<?php

namespace App\Contracts;

// Interface sebagai kontrak metode kosong untuk Polimorfisme
interface PerhitunganDenda
{
    public function hitungDenda_Keterlambatan(): float;
    public function hitungDenda_Kerusakan(): float;
}