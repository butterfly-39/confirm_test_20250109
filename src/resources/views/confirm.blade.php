@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endsection

@section('content')
<h2>Confirm</h2>
<div class="confirm-form__content">
    <form class="form" action="/thanks" method="post">
    @csrf
    <div class="confirm-table">
        <table class="confirm-table__inner">
            <tr class="confirm-table__row">
                <th class="confirm-table__header">お名前</th>
                <td class="confirm-table__text">
                    <span><input type="text" name="last_name" value="{{ $contact['last_name'] }}" readonly /></span> <span><input type="text" name="first_name" value="{{ $contact['first_name'] }}" readonly /></span>
                </td>
            </tr>
            <tr class="confirm-table__row">
                <th class="confirm-table__header">性別</th>
                <td class="confirm-table__text">
                    <input type="text" name="gender" value="{{ $contact['gender'] }}" readonly />
                </td>
            </tr>
            <tr class="confirm-table__row">
                <th class="confirm-table__header">メールアドレス</th>
                <td class="confirm-table__text">
                    <input type="email" name="email" value="{{ $contact['email'] }}" readonly />
                </td>
            </tr>
            <tr class="confirm-table__row">
                <th class="confirm-table__header">電話番号</th>
                <td class="confirm-table__text">
                    <input type="tel" name="tel" value="{{ $contact['tel'] }}" readonly />
                </td>
            </tr>
            <tr class="confirm-table__row">
                <th class="confirm-table__header">住所</th>
                <td class="confirm-table__text">
                    <input type="text" name="address" value="{{ $contact['address'] }}" readonly />
                </td>
            </tr>
            <tr class="confirm-table__row">
                <th class="confirm-table__header">建物名</th>
                <td class="confirm-table__text">
                    <input type="text" name="building" value="{{ $contact['building'] }}" readonly />
                </td>
            </tr>
            <tr class="confirm-table__row">
                <th class="confirm-table__header">お問い合わせの種類</th>
                <td class="confirm-table__text">
                    <input type="hidden" name="category_id" value="{{ $contact['category_id'] }}" readonly />
                    <input type="text" name="category_content" value="{{ $category->content }}"/>
                </td>
            </tr>
            <tr class="confirm-table__row">
                <th class="confirm-table__header">お問い合わせ内容</th>
                <td class="confirm-table__text">
                    <input type="text" name="detail" value="{{ $contact['detail'] }}" readonly />
                </td>
            </tr>
        </table>
    </div>
    <div class="button-group">
        <input class="send-button" type="submit" value="送信" name="send">
        <input class="back-button" type="submit" value="修正" name="back">
    </div>
    </form>
</div>
@endsection