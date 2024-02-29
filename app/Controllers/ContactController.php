<?php

namespace App\Controllers;

use App\Models\Contact;

class ContactController extends Controller
{
  public function index()
  {
    $search = $_GET['search'] ?? '';
    $model = new Contact;

    return $model
      ->select("id", "name", "email")
      ->where('id', '>', 4)
      ->get();

    $contacts = !empty($search) ?
      $model->where('name', 'LIKE', "%" . "{$search}" . "%")->paginate(1) :
      $model->paginate(3);
    return $this->view('contacts.index', compact('contacts', 'search'));
  }

  public function create()
  {
    return $this->view('contacts.create');
  }

  public function store()
  {
    $data = $_POST;
    $model = new Contact;
    $model->create($data);
    $this->redirect('/contacts');
  }

  public function show($id)
  {
    $model = new Contact;
    $contact = $model->find($id);

    return $this->view('contacts.show', compact('contact'));
  }

  public function edit($id)
  {
    $model = new Contact;
    $contact = $model->find($id);

    return $this->view('contacts.edit', compact('contact'));
  }

  public function update($id)
  {
    $data = $_POST;
    $model = new Contact;
    $model->update($id, $data);

    $this->redirect("/contacts/$id");
  }

  public function destroy($id)
  {
    $model = new Contact;
    $model->delete($id);

    $this->redirect('/contacts');
  }
}