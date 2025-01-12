@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('button')
<form class="form" action="/logout" method="post">
    @csrf
    <button class="header__btn">Logout</button>
</form>
@endsection

@section('content')
<h2>Contact</h2>
<form class="form" action="/confirm" method="post">
    @csrf
    <div class="form__group">
        <div class="form__group-title">
            <span class="form__label--item">お名前</span>
            <span class="form__label--required">※</span>
        </div>
        <div class="form__group-content">
            <div class="form__input--text">
                <input type="text" name="first_name" value="{{ old('first_name') }}" placeholder="例: 山田">
                <input type="text" name="last_name" value="{{ old('last_name') }}" placeholder="例: 太郎">
            </div>
            <div class="form__error">
                @error('first_name')
                {{ $message }}
                @enderror
                @error('last_name')
                {{ $message }}
                @enderror
            </div>
        </div>
    </div>
    <div class="form__group">
        <div class="form__group-title">
            <span class="form__label--item">性別</span>
            <span class="form__label--required">※</span>
        </div>
        <div class="form__group-content">
            <div class="form__input--radio">
                <input type="radio" name="gender" value="male" {{ old('gender', 'male') == 'male' ? 'checked' : '' }}>
                <label for="male">男性</label>
                <input type="radio" name="gender" value="female" {{ old('gender') == 'female' ? 'checked' : '' }}>
                <label for="female">女性</label>
                <input type="radio" name="gender" value="other" {{ old('gender') == 'other' ? 'checked' : '' }}>
                <label for="other">その他</label>
            </div>
            <div class="form__error">
                @error('gender')
                {{ $message }}
                @enderror
            </div>
        </div>
    </div>
    <div class="form__group">
        <div class="form__group-title">
            <span class="form__label--item">メールアドレス</span>
            <span class="form__label--required">※</span>
        </div>
        <div class="form__group-content">
            <div class="form__input--text">
                <input type="email" name="email" value="{{ old('email') }}" placeholder="例: test@example.com" />
            </div>
            <div class="form__error">
                @error('email')
                {{ $message }}
                @enderror
            </div>
        </div>
    </div>
    <div class="form__group">
        <div class="form__group-title">
            <span class="form__label--item">電話番号</span>
            <span class="form__label--required">※</span>
        </div>
        <div class="form__group-content">
            <div class="form__input--text">
                <input type="tel" name="tel1" value="{{ old('tel1') }}" placeholder="080" maxlength="3">
                -
                <input type="tel" name="tel2" value="{{ old('tel2') }}" placeholder="1234" maxlength="4">
                -
                <input type="tel" name="tel3" value="{{ old('tel3') }}" placeholder="5678" maxlength="4">
            </div>
            <div class="form__error">
                @error('tel1')
                {{ $message }}
                @enderror
                @error('tel2')
                {{ $message }}
                @enderror
                @error('tel3')
                {{ $message }}
                @enderror
            </div>
        </div>
    </div>
    <div class="form__group">
        <div class="form__group-title">
            <span class="form__label--item">住所</span>
            <span class="form__label--required">※</span>
        </div>
        <div class="form__group-content">
            <div class="form__input--text">
                <input type="text" name="address" value="{{ old('address') }}" placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3">
            </div>
            <div class="form__error">
                @error('address')
                {{ $message }}
                @enderror
            </div>
        </div>
    </div>
    <div class="form__group">
        <div class="form__group-title">
            <span class="form__label--item">建物名</span>
        </div>
        <div class="form__group-content">
            <div class="form__input--text">
                <input type="text" name="building" value="{{ old('building') }}" placeholder="例: 千駄ヶ谷マンション101">
            </div>
            <div class="form__error">
                @error('building')
                {{ $message }}
                @enderror
            </div>
        </div>
    </div>
    <div class="form__group">
        <div class="form__group-title">
            <span class="form__label--item">お問い合わせの種類</span>
            <span class="form__label--required">※</span>
        </div>
        <div class="form__group-content">
            <div class="form__input--select">
            </div>
            <div class="form__error">
                @error('category_id')
                {{ $message }}
                @enderror
            </div>
        </div>
    </div>
    <div class="form__group">
        <div class="form__group-title">
            <span class="form__label--item">お問い合わせ内容</span>
            <span class="form__label--required">※</span>
        </div>
        <div class="form__group-content">
            <div class="form__input--textarea">
                <textarea name="content" placeholder="例: お問い合わせ内容をご記載ください"></textarea>
            </div>
            <div class="form__error">
                @error('content')
                {{ $message }}
                @enderror
            </div>
        </div>
    </div>
        <button class="form__button-submit" type="submit">送信</button>
</form>
@endsection