<?php

require '../vendor/autoload.php';

use App\Controllers\BookController;

if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST') {
    if (isset($_POST['_method'])) {
        if ($_POST['_method'] == 'PUT') {
            BookController::updateBook($_POST);
        }
        if ($_POST['_method'] == 'DELETE') {
            BookController::deleteBook($_POST['id']);
        }
    } else {
        BookController::addBook($_POST);
    }
    header("Location: index.php");
}
