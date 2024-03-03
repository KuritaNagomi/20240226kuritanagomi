@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endsection

@section('content')
<div class="confirm__content">
    <div class="confirm__heading">
        <h2>Confirm</h2>
    </div>
    <form class="form" action="/thanks" method="post">
        @csrf
        <div class="confirm-table">
            <table class="confirm-table__inner">
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">お名前</th>
                    <td class="confirm-table__text">
                        <input class="confirm-table__name" type="text" name="last_name" value="{{ $contact['last_name'] }}" readonly />
                        <input class="confirm-table__name" type="text" name="first_name" value="{{ $contact['first_name'] }}" readonly />
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">性別</th>
                    <td class="confirm-table__text">
                        <input type="hidden" name="gender" value="{{ $contact['gender'] }}" readonly />
                        <?php
                            if ($contact['gender'] == '1') {
                            echo '男性';
                            } else if ($contact['gender'] == '2') {
                                echo '女性';
                            } else if ($contact['gender'] == '3'){
                                echo 'その他';
                            }
                        ?>
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
                        <input class="confirm-table__tel" type="tel" name="tel1" value="{{ $contact['tel']['tel1'] }}" readonly />
                        <span class="hyphen">-</span>
                        <input class="confirm-table__tel" type="tel" name="tel2" value="{{ $contact['tel']['tel2'] }}" readonly />
                        <span class="hyphen">-</span>
                        <input class="confirm-table__tel" type="tel" name="tel3" value="{{ $contact['tel']['tel3'] }}" readonly />
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">住所</th>
                    <td class="confirm-table__text">
                        <input class="confirm-table_address" type="text" name="address" value="{{ $contact['address'] }}" readonly />
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">建物名</th>
                    <td class="confirm-table__text">
                        <input class="confirm-table_address" type="text" name="building" value="{{ $contact['building'] }}" readonly />
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">お問い合わせの種類</th>
                    <td class="confirm-table__text">
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
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">お問い合わせ内容</th>
                    <td class="confirm-table__text">
                        <input type="text" name="detail" value="{{ $contact['detail'] }}" readonly />
                    </td>
                </tr>
            </table>
        </div>
        <div class="form__button">
            <button class="form__button-submit" type="submit">送信</button>
            <form action='/' method="post">
                @csrf
                <button class="form__button-modify" type="submit" >修正</button>
            </form>
        </div>
    </form>
</div>
@endsection
