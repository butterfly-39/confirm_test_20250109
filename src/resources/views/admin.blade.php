@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
<style>
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.0);
        visibility: hidden;
        opacity: 0;
        right: 0;
        bottom: 0;
        transition: 0.3s ease-in-out;
    }

    /* URLのハッシュと一致する要素を表示 */
    .modal:target {
        display: block;
        visibility: visible;
        opacity: 1;
    }

    .modal-content {
        color: #8e7963;
        background-color: #fff;
        width: 80%;
        max-width: 700px;
        height: 90vh;
        margin: 50px auto;
        padding: 70px;
        position: relative;
        overflow-y: auto;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        border: 1px solid #8c7760;
    }

    /* モーダル内のテーブルスタイル調整 */
    .modal-table {
        width: 100%;
        margin-top: 40px;
        border-collapse: collapse;
    }

    .modal-close {
    position: absolute;
    top: 10px;
    right: 10px;
    text-decoration: none;
    font-size: 24px;
    color: #333;
    }

    .modal-table th {
        width: 30%;
        text-align: left;
        padding: 12px;
        border: none;
    }

    .modal-table td {
        padding: 10px;
        border: none;
    }

    /* 削除ボタンのスタイルを追加 */
    .delete-btn {
        background: #c53030;
        color: white;
        margin: 90px auto 0;
        padding: 8px 16px;
        border: none;
        cursor: pointer;
        display: block;
    }
</style>
@endsection

@section('button')
<form class="header__button" action="/login" method="post">
    @csrf
    logout
</form>
@endsection

@section('content')
<h2>Admin</h2>
    <div class="search-bar">
        <form action="/admin" method="get" id="searchForm">
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
                @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                    {{ $category->content }}
                </option>
                @endforeach
            </select>
            <input type="date" name="date" class="date-picker" value="{{ request('date') }}">
            <button type="submit" class="search-btn">検索</button>
            <a href="/admin" class="reset-btn">リセット</a>
        </form>
    </div>

    <div class="table-footer">
        <form action="/admin/export" method="get" style="display: inline;">
            @csrf
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
                        <li class="disabled"><span>&laquo;</span></li>
                    @else
                        <li><a href="{{ $contacts->previousPageUrl() }}" rel="prev">&laquo;</a></li>
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
                        <li><a href="{{ $contacts->nextPageUrl() }}" rel="next">&raquo;</a></li>
                    @else
                        <li class="disabled"><span>&raquo;</span></li>
                    @endif
                </ul>
            </div>
        @endif
    </div>

    <table>
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
            @foreach($contacts as $contact)
            <tr>
                <td>{{ $contact->last_name }} {{ $contact->first_name }}</td>
                <td>
                    @if($contact->gender == 1)
                        男性
                    @elseif($contact->gender == 2)
                        女性
                    @elseif($contact->gender == 3)
                        その他
                    @endif
                </td>
                <td>{{ $contact->email }}</td>
                <td>{{ $contact->category->content }}</td>
                <td>
                    <a href="#modal{{ $contact->id }}" class="detail-btn">詳細</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- モーダルウィンドウをテーブルの外に配置 -->
    @foreach($contacts as $contact)
    <div class="modal" id="modal{{ $contact->id }}">
        <div class="modal-content">
            <div class="modal-header">
                <a href="#" class="modal-close">&times;</a>
            </div>
            <div class="modal-body">
                <table class="modal-table">
                    <tr>
                        <th>お名前</th>
                        <td>{{ $contact->last_name }} {{ $contact->first_name }}</td>
                    </tr>
                    <tr>
                        <th>性別</th>
                        <td>
                            @if($contact->gender == 1)
                                男性
                            @elseif($contact->gender == 2)
                                女性
                            @elseif($contact->gender == 3)
                                その他
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>メールアドレス</th>
                        <td>{{ $contact->email }}</td>
                    </tr>
                    <tr>
                        <th>電話番号</th>
                        <td>{{ $contact->tel }}</td>
                    </tr>
                    <tr>
                        <th>住所</th>
                        <td>{{ $contact->address }}</td>
                    </tr>
                    <tr>
                        <th>建物名</th>
                        <td>{{ $contact->building }}</td>
                    </tr>
                    <tr>
                        <th>お問い合わせの種類</th>
                        <td>{{ $contact->category->content }}</td>
                    </tr>
                    <tr>
                        <th>お問い合わせ内容</th>
                        <td>{{ $contact->detail }}</td>
                    </tr>
                </table>
                <form class="delete-form" action="/contact/delete" method="POST">
                    @method('DELETE')
                    @csrf
                    <div class="delete-form__button">
                        <input type="hidden" name="id" value="{{ $contact->id }}">
                        <button type="submit" class="delete-btn">削除</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach
@endsection
