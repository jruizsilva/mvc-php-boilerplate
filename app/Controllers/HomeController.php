<?php

namespace App\Controllers;

use App\Models\Contact;

class HomeController extends Controller
{
  public function index()
  {
    $contactModel = new Contact();
    $contactModel->delete(2);

    return "eliminado";

    // return $this->view('home', [
    //   'title' => 'Home',
    //   'description' => 'This is the home page',
    // ]);
  }
}