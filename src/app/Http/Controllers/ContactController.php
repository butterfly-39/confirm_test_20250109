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
        // 電話番号を結合
        $tel = $request->tel1 . $request->tel2 . $request->tel3;

        $contact = $request->only(['last_name', 'first_name', 'gender', 'email', 'address', 'building', 'category_id', 'detail']);
        $contact['tel'] = $tel;

        $category = Category::find($request->category_id);
        return view('confirm', compact('contact', 'category'));
    }

    public function store(Request $request)
    {
        if ($request->has('back')) {
            return redirect("/")->withInput();
        }

        // 基本データの取得
        $contact = $request->only(['last_name', 'first_name', 'gender', 'email','tel', 'address', 'building', 'category_id', 'detail']);

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

    public function admin(Request $request)
    {
        $query = Contact::query()
            ->with('category');

        // 名前やメールアドレスでの絞り込み
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('first_name', 'LIKE', "%{$search}%")
                    ->orWhere('last_name', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%");
            });
        }

        // 性別での絞り込み
        if ($request->filled('gender') && $request->input('gender') !== '0') {
            $query->where('gender', $request->input('gender'));
        }

        // カテゴリーでの絞り込み
        if ($request->filled('category')) {
            $query->where('category_id', $request->input('category'));
        }

        // 日付での絞り込み
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->input('date'));
        }

        $contacts = $query->orderBy('created_at', 'desc')->paginate(7);
        $categories = Category::all();

        return view('admin', compact('contacts', 'categories'));
    }
}
