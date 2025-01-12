<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\ContactRequest;
class ContactController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('index', compact('categories'));
    }

    public function confirm(ContactRequest $request)
    {
        $contact = $request->all();
        return view('confirm', compact('contact'));
    }

    public function thanks()
    {
        return view('thanks');
    }
}
