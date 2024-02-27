<?php

namespace App\Controllers;

use App\Models\Contact;

class HomeController extends Controller
{
  public function index()
  {
    $contactModel = new Contact();
    return $contactModel->where('id', '2')->get();
    print_r($contacts);

    return $this->view('home', [
      'title' => 'Home',
      'description' => 'This is the home page',
    ]);
  }
}