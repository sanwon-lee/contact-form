# 確認テスト(お問い合わせフォーム)

## 環境構築

### Dockerビルド

- `git clone git@github.com:sanwon-lee/contact-form.git`
- `cp .env.example .env`, .env編集 (OS環境変数を適宜変更)
- `docker compose up -d --build`

### Laravel環境構築

- `docker compose exec php bash`
- `cp src/.env.example src/.env`, src/.envを.envに合わせて変更
- `composer install`
- `php artisan key:generate`
- `php artisan migrate --seed`

## URL

- お問い合わせ入力画面：http://localhost/
- お問い合わせ確認画面：http://localhost/confirm/
- お問い合わせ完了画面：http://localhost/thanks/
- 会員登録画面：http://localhost/register/
- ログイン画面：http://localhost/login/
- 管理画面：http://localhost/admin/
- 検索：http://localhost/search/
- 検索リセット：http://localhost/reset/
- お問い合わせ削除：http://localhost/delete/
- お問い合わせ内容エクスポート：http://localhost/export/
- ログアウト：http://localhost/logout/

## 使用技術(実行環境)

- PHP 8.5.3
- Laravel 12.52.0
- Vite 7.3.1
- nginx 1.28.2
- mysql 8.4.8
- phpmyadmin 5.2.3

## ER図

<img width="490" height="631" alt="ER drawio" src="https://github.com/user-attachments/assets/991e49f3-4b34-4afb-8bac-c0c565899ee2" />

