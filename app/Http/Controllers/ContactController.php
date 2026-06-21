<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string',
            'company'   => 'required|string',
            'email'     => 'required|email',
            'phone'     => 'required|string',
            'participants' => 'nullable|integer|min:1',
        ]);

        Contact::create($validated);
        return redirect('/academy')->with('success', 'Успешно зачувано!');
    }
}
