@extends('layouts.default')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endpush

@section('content')
    <div class="confirm__content">
      <div class="confirm__heading">
        <h2>お問い合わせ内容確認</h2>
      </div>

      <form action="{{ route('thanks') }}" class="form" method="post">
        @csrf
        <div class="confirm-table">
          <table class="confirm-table__inner">
            <tr class="confirm-table__row">
              <th class="confirm-table__header">お名前</th>
              <td class="confirm-table__text">
                <input type="text" name="name" value="{{ $contact['name'] }}" readonly>
              </td>
            </tr>
            <tr class="confirm-table__row">
              <th class="confirm-table__header">メールアドレス</th>
              <td class="confirm-table__text">
                <input type="email" name="email"
                value="{{ $contact['email'] }}" readonly>
              </td>
            </tr>
            <tr class="confirm-table__row">
              <th class="confirm-table__header">電話番号</th>
              <td class="confirm-table__text">
                <input type="tel" name="tel" value="{{ $contact['tel'] }}" readonly>
              </td>
            </tr>
            <tr class="confirm-table__row">
              <th class="confirm-table__header">お問い合わせ内容</th>
              <td class="confirm-table__text">
                <input type="text" name="content"
                value="{{ $contact['content'] }}" readonly>
              </td>
            </tr>
          </table>
        </div>
        <div class="form__button">
          <button type="submit" class="form__button-submit">送信</button>
        </div>
      </form>
    </div>
@endsection