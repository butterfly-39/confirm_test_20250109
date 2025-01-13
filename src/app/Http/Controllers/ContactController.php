<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Models\Category;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $contacts = Contact::with('category')->get();
        $categories = Category::all();

        return view('index', compact('contacts', 'categories'));
    }

    public function confirm(ContactRequest $request)
    {
        $contact = $request->only(['last_name', 'first_name', 'gender', 'email', 'address', 'building', 'category_id', 'detail']);

        // 電話番号を結合
        $contact['tel'] = $request->tel1 . $request->tel2 . $request->tel3;

        $category = Category::find($request->category_id);
        return view('confirm', compact('contact', 'category'));
    }

    public function store(Request $request)
    {
        if ($request->has('back')) {
            return redirect("/")->withInput();
        }

        // 基本データの取得
        $contact = $request->only(['last_name', 'first_name', 'gender', 'email', 'address', 'building', 'category_id', 'detail']);

        // 電話番号の結合
        $contact['tel'] = $request->tel1 . $request->tel2 . $request->tel3;

        // 性別の数値変換を修正
        $genderMap = [
            '男性' => 1,
            '女性' => 2,
            'その他' => 3
        ];
        $contact['gender'] = $genderMap[$request->input('gender')];

        Contact::create($contact);
        return view('thanks');
    }
}
