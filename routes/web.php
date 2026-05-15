<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Models\Contact;

Route::post('/contact', [ContactController::class, 'store']);
Route::get('/contact', function () {
    return view('contact');
});

Route::get('/admin/contacts', function () {
    $contacts = Contact::latest()->get();
    return view('admin.contacts', compact('contacts'));
});
Route::get('/home', function () {
    return view('home');
});