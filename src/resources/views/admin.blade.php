@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
<style>
    .modal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.4);
}

.modal:target {
    display: block;
}

.modal-content {
    background-color: #fefefe;
    margin: 5% auto;
    padding: 30px;
    border: 1px solid #888;
    width: 80%;
    max-width: 600px;
    border-radius: 8px;
    max-height: 90vh;
    overflow-y: auto;
    position: relative;
}

.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.close {
    color: #aaa;
    font-size: 28px;
    font-weight: bold;
    text-decoration: none;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
}

.modal-item {
    margin-bottom: 20px;
}

.modal-item label {
    font-weight: bold;
    display: block;
    margin-bottom: 5px;
}

.modal-item p {
    margin: 0;
    line-height: 1.5;
}

.modal-delete-form {
    text-align: center;
    margin-top: 20px;
}

.delete-btn {
    background-color: #ff4444;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 14px;
}

.delete-btn:hover {
    background-color: #cc0000;
}
</style>
@endsection

@section('button')
<a class="header__btn" href="/logout">logout</a>
@endsection

@section('content')
<h2>Admin</h2>
<div class="admin-search__content">
    <form class="admin-search__form" action="/admin" method="get">
        <input type="text" name="search" placeholder="名前やメールアドレスを入力してください" value="{{ request('search') }}">
        <select name="gender">
            <option value="" selected>性別</option>
            <option value="0" {{ request('gender') == '0' ? 'selected' : '' }}>全て</option>
            <option value="1" {{ request('gender') == '1' ? 'selected' : '' }}>男性</option>
            <option value="2" {{ request('gender') == '2' ? 'selected' : '' }}>女性</option>
            <option value="3" {{ request('gender') == '3' ? 'selected' : '' }}>その他</option>
        </select>
        <select name="category">
            <option value="" selected>お問い合わせの種類</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>{{ $category->content }}</option>
            @endforeach
        </select>
        <input type="date" name="date" class="date-picker" value="{{ request('date') }}">
        <button type="submit" class="search-btn">検索</button>
        <a href="/admin" class="reset-btn">リセット</a>
    </form>
</div>

<div class="admin-table__footer">
    <form action="/admin/export" method="get" class="export-form">
        <input type="hidden" name="search" value="{{ request('search') }}">
        <input type="hidden" name="gender" value="{{ request('gender') }}">
        <input type="hidden" name="category" value="{{ request('category') }}">
        <input type="hidden" name="date" value="{{ request('date') }}">
        <button type="submit" class="export-btn">エクスポート</button>
    </form>
    @if ($contacts->hasPages())
        <div class="pagination-container">
            <ul class="pagination">
                {{-- 前へ --}}
                @if ($contacts->onFirstPage())
                    <li class="disabled"><span>&lt;</span></li>
                @else
                    <li><a href="{{ $contacts->previousPageUrl() }}" rel="prev">&lt;</a></li>
                @endif

                {{-- ページ番号 --}}
                @foreach ($contacts->getUrlRange(1, $contacts->lastPage()) as $page => $url)
                    @if ($page == $contacts->currentPage())
                        <li class="active"><span>{{ $page }}</span></li>
                    @else
                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach

                {{-- 次へ --}}
                @if ($contacts->hasMorePages())
                    <li><a href="{{ $contacts->nextPageUrl() }}" rel="next">&gt;</a></li>
                @else
                    <li class="disabled"><span>&gt;</span></li>
                @endif
            </ul>
        </div>
    @endif
</div>

<table class="admin-table">
    <thead>
        <tr>
            <th>お名前</th>
            <th>性別</th>
            <th>メールアドレス</th>
            <th>お問い合わせの種類</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($contacts as $contact)
            <tr>
                <td>{{ $contact->last_name }} {{ $contact->first_name }}</td>
                <td>
                    @if ($contact->gender == 1)
                        男性
                    @elseif ($contact->gender == 2)
                        女性
                    @elseif ($contact->gender == 3)
                        その他
                    @endif
                </td>
                <td>{{ $contact->email }}</td>
                <td>{{ $contact->category->content }}</td>
                <td>
                    <a href="#modal-{{ $contact->id }}" class="admin-table__btn">詳細</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

{{-- モーダルウィンドウの追加 --}}
@foreach ($contacts as $contact)
    <div class="modal" id="modal-{{ $contact->id }}">
        <div class="modal-content">
            <div class="modal-header">
                <a href="#" class="close">&times;</a>
            </div>
            <div class="modal-body">
                <div class="modal-item">
                    <label>お名前</label>
                    <p>{{ $contact->last_name }} {{ $contact->first_name }}</p>
                </div>
                <div class="modal-item">
                    <label>性別</label>
                    <p>
                        @if ($contact->gender == 1)
                            男性
                        @elseif ($contact->gender == 2)
                            女性
                        @else
                            その他
                        @endif
                    </p>
                </div>
                <div class="modal-item">
                    <label>メールアドレス</label>
                    <p>{{ $contact->email }}</p>
                </div>
                <div class="modal-item">
                    <label>電話番号</label>
                    <p>{{ $contact->tel }}</p>
                </div>
                <div class="modal-item">
                    <label>住所</label>
                    <p>{{ $contact->address }}</p>
                </div>
                <div class="modal-item">
                    <label>建物名</label>
                    <p>{{ $contact->building ?? '---' }}</p>
                </div>
                <div class="modal-item">
                    <label>お問い合わせの種類</label>
                    <p>{{ $contact->category->content }}</p>
                </div>
                <div class="modal-item">
                    <label>お問い合わせ内容</label>
                    <p>{{ $contact->detail }}</p>
                </div>
                <form action="/admin/{{ $contact->id }}" method="POST" class="modal-delete-form">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete-btn">削除</button>
                </form>
            </div>
        </div>
    </div>
@endforeach

@endsection
