@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('header__nav')
<nav class="header__nav">
    @if (Auth::check())
    <form class="form" action="{{ route('logout') }}" method="post">
    @csrf
        <button class="header-nav__button">logout</button>
    </form>
    @endif
</nav>
@endsection

@section('content')
<div class="admin__content">
    <div class="admin__heading">
        <h2>Admin</h2>
    </div>
    <div class="search">
            <form action="{{ route('admin') }}" method="GET" class="search-form" id="searchForm">
            @csrf
            <div class="search__item">
                <input type="text" class="search__item-input" name="keyword"
                placeholder="名前やメールアドレスを入力してください" value="{{ old('keyword') }}">
                <select name="gender" class="search__select-gender">
                    <option value=""> 性別</option>
                    <option value="1">男性</option>
                    <option value="2">女性</option>
                    <option value="3">その他</option>
                </select>
                <select name="category_id" class="search__select-category">
                    <option value="">お問い合わせの種類</option>
                    <option value="1">商品のお届けについて</option>
                    <option value="2">商品の交換について</option>
                    <option value="3">商品トラブル</option>
                    <option value="4">ショップへのお問い合わせ</option>
                    <option value="5">その他</option>
                </select>
                <div class="custom-date-input">
                    <input class="search__select-date" type="date" name="created_at" placeholder="年/月/日">
                    <div class="triangle"></div>
                </div>
                <button class="search-form__button-submit" type="submit">検索</button>
                <input class="reset-form__button" type="reset" value="リセット">
            </div>
        </form>
    </div>
    <div class="option">
        <a href="{{ route('admin.export') }}" class="export">エクスポート</a>
        <div class="pagination">{{ $contacts->links('pagination::default') }}</div>
    </div>
    <div class="contact-table">
        <table class="contact-table__inner">
            <tr class="contact-table__row">
                <th class="contact-table__header">お名前</th>
                <th class="contact-table__header">性別</th>
                <th class="contact-table__header">メールアドレス</th>
                <th class="contact-table__header">お問い合わせの種類</th>
            </tr>
            <tr class="contact-table__row">
                <td class="contact-table__item" name="name">
                @foreach ($contacts as $contact)
                    <li>{{ $contact->last_name }}{{ $contact->first_name }}</li>
                    @endforeach
                </td>
                <td class="contact-table__item" name="gender">
                    @foreach ($contacts as $contact)
                    <li><?php
                        if ($contact['gender'] == '1') {
                            echo '男性';
                            } else if ($contact['gender'] == '2') {
                            echo '女性';
                            }else if ($contact['gender'] == '3'){
                            echo 'その他';
                            }
                        ?></li>
                    @endforeach
                </td>
                <td class="contact-table__item" name="email">
                    @foreach ($contacts as $contact)
                    <li>{{ $contact->email }}</li>
                    @endforeach
                </td>
                <td class="contact-table__item">
                    @foreach ($contacts as $contact)
                    <li><?php
                        if ($contact['category_id'] == '1') {
                            echo '商品のお届けについて';
                            } else if ($contact['category_id'] == '2') {
                            echo '商品の交換について';
                            }else if ($contact['category_id'] == '3'){
                            echo '商品トラブル';
                            }else if ($contact['category_id'] == '4') {
                            echo 'ショップへのお問い合わせ';
                            }else if ($contact['category_id'] == '5') {
                            echo 'その他';
                            }
                        ?></li>
                    @endforeach
                </td>
                <td class="contact-table__item">
                    @foreach ($contacts as $contact)
                    <div class="modal-open">
                            <a href="#modal{{ $contact->id }}">詳細</a>
                    </div>
                    <div class="modal" id="modal{{ $contact->id }}">
                        <a href="#!" class="overlay"></a>
                        <div class="modal-wrapper">
                            <div class="modal-contents">
                                <a href="#!" class="modal-close">✕</a>
                                <div class="modal-content">
                                    <div class="detail-table">
                                        <table class="detail-table__inner">
                                            <tr class="detail-table__row">
                                                <th class="detail-table__header">お名前</th>
                                                <td class="detail-table__text">
                                                    {{ $contact->last_name }}{{ $contact->first_name }}
                                                </td>
                                            </tr>
                                            <tr class="detail-table__row">
                                                <th class="detail-table__header">性別</th>
                                                <td class="detail-table__text">
                                                    <?php
                                                    if ($contact['gender'] == '1') {
                                                        echo '男性';
                                                        } else if ($contact['gender'] == '2') {
                                                        echo '女性';
                                                        }else if ($contact['gender'] == '3'){
                                                        echo 'その他';
                                                        }
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr class="detail-table__row">
                                                <th class="detail-table__header">メールアドレス</th>
                                                <td class="detail-table__text">
                                                    {{ $contact->email }}
                                                </td>
                                            </tr>
                                            <tr class="detail-table__row">
                                                <th class="detail-table__header">電話番号</th>
                                                <td class="detail-table__text">
                                                    {{ $contact->tel }}
                                                </td>
                                            </tr>
                                            <tr class="detail-table__row">
                                                <th class="detail-table__header">住所</th>
                                                <td class="detail-table__text">
                                                    {{ $contact->address }}
                                                </td>
                                            </tr>
                                            <tr class="detail-table__row">
                                                <th class="detail-table__header">建物名</th>
                                                <td class="detail-table__text">
                                                    {{ $contact->building }}
                                                </td>
                                            </tr>
                                            <tr class="detail-table__row">
                                                <th class="detail-table__header">お問い合わせの種類</th>
                                                <td class="detail-table__text">
                                                    <?php
                                                    if ($contact['category_id'] == '1') {echo '商品のお届けについて';
                                                        } else if ($contact['category_id'] == '2') {
                                                        echo '商品の交換について';
                                                        }else if ($contact['category_id'] == '3'){
                                                        echo '商品トラブル';
                                                        }else if ($contact['category_id'] == '4') {
                                                        echo 'ショップへのお問い合わせ';
                                                        }else if ($contact['category_id'] == '5') {
                                                        echo 'その他';
                                                        }
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr class="detail-table__row">
                                                <th class="detail-table__header">お問い合わせ内容</th>
                                                <td class="detail-table__text">
                                                    {{ $contact->detail }}
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <form action="/admin" class="delete-form" method="post">
                                    @method('DELETE')
                                    @csrf
                                        <div class="delete-form__button">
                                            <input type="hidden" name="id" value="{{ $contact['id'] }}">
                                            <button class="form__button-submit" type="submit">削除</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </td>
            </tr>
        </table>
    </div>
</div>
@endsection