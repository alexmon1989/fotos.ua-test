<?php
    require 'vendor/autoload.php';

    $a = array (
        array (
            'Name' => 'Trixie',
            'Color' => 'Green',
            'Element' => 'Earth',
            'Likes' => 'Flowers',
        ),
        array (
            'Name' => 'Tinkerbell',
            'Element' => 'Air',
            'Likes' => 'Singning',
            'Color' => 'Blue',
        ),
        array (
            'Name' => 'Blum',
            'Element' => 'Water',
            'Likes' => 'Dancing',
            'Name' => 'Blum',
            'Color' => 'Pink',
        ),
    );

    try 
    {
        $ascii = new App\Ascii\Writer($a);
        echo $ascii->toAscii($a);
    } 
    catch (Exception $e) 
    {
        echo 'Exeption: ',  $e->getMessage(), "\n";
    }