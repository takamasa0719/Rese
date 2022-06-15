# Rese(飲食店予約サービス)
![site-animation](/src/public/images/readme/Animation.gif)

## 目次
| 番号 | 項目 |
|:-:|:--|
| 1 | [URL](https://github.com/takamasa0719/Rese#1url) |
| 2 | [概要](https://github.com/takamasa0719/Rese#2%E6%A6%82%E8%A6%81) |
| 3 | [制作背景](https://github.com/takamasa0719/Rese#3%E5%88%B6%E4%BD%9C%E8%83%8C%E6%99%AF) |
| 4 | [目的](https://github.com/takamasa0719/Rese#4%E7%9B%AE%E7%9A%84) |
| 5 | [使用画面のイメージ](https://github.com/takamasa0719/Rese#5%E4%BD%BF%E7%94%A8%E7%94%BB%E9%9D%A2%E3%81%AE%E3%82%A4%E3%83%A1%E3%83%BC%E3%82%B8) |
| 6 | [使用技術、バージョン](https://github.com/takamasa0719/Rese#6%E4%BD%BF%E7%94%A8%E6%8A%80%E8%A1%93%E3%83%90%E3%83%BC%E3%82%B8%E3%83%A7%E3%83%B3) |
| 7 | [環境構築手順](https://github.com/takamasa0719/Rese#7%E7%92%B0%E5%A2%83%E6%A7%8B%E7%AF%89%E6%89%8B%E9%A0%86) |
| 8 | [機能一覧](https://github.com/takamasa0719/Rese#8%E6%A9%9F%E8%83%BD%E4%B8%80%E8%A6%A7) |
| 9 | [工夫点](https://github.com/takamasa0719/Rese#9%E5%B7%A5%E5%A4%AB%E7%82%B9) |
| 10 | [苦労した点](https://github.com/takamasa0719/Rese#10%E8%8B%A6%E5%8A%B4%E3%81%97%E3%81%9F%E7%82%B9) |
| 11 | [DB設計](https://github.com/takamasa0719/Rese#11db%E8%A8%AD%E8%A8%88) |
| 12 | [インフラ構成図](https://github.com/takamasa0719/Rese#12%E3%82%A4%E3%83%B3%E3%83%95%E3%83%A9%E6%A7%8B%E6%88%90%E5%9B%B3) |

## 1.URL

未定

## 2.概要
ある企業のグループ会社の飲食店予約サービス

## 3.制作背景
外部の飲食店予約サービスは手数料を取られるので自社で予約サービスを持ちたい。

## 4.目的
初年度でのユーザー数10,000人達成

## 5.使用画面のイメージ


## 6.使用技術、バージョン
- フロントエンド
    - HTML / CSS
    - javascript
- バックエンド
    - PHP 8.1.2
    - Laravel 8.83.13
- インフラ、その他
    - MySQL 15.1
    - Visual Studio Code
    - draw.io

## 7.環境構築手順


## 8.機能一覧
- ユーザー関連
    - ユーザー登録機能
    - ログイン機能
- 飲食店関連
    - 店舗一覧閲覧
    - 店舗詳細閲覧
    - 店舗検索
    - お気に入り
    - 店舗予約

## 9.工夫点


## 10.苦労した点


## 11.DB設計
### ER図
![erd-image](/diagram/cts-remake_erd.PNG)
### テーブル設計
#### usersテーブル
ユーザーを管理する。
| カラム名           | 属性              | 役割                                                      |
|:------------------|:------------------|:---------------------------------------------------------|
| id                | 整数               | ユーザーを識別するID                                      |
| name              | 文字列             | ユーザー名                                                |
| email             | 文字列/ユニーク制約 | メールアドレス                                            |
| email_verified_at | 日付と時刻         | -                                                        |
| password          | 文字列             | パスワード                                                |
| rememberToken     | 文字列             |-                                                           |
| created_at        | 日付と時刻         | 作成日時                                                  |
| created_at        | 日付と時刻         | 更新日時                                                  |
#### shopsテーブル
店舗を管理する。
| カラム名    | 属性           | 役割                      |
|:-----------|:---------------|:-------------------------|
| id         | 整数            | 店舗を識別するID          |
| area_id    | 整数            | 店舗のエリアID               |
| category_id| 整数            | 店舗のカテゴリーID          |
| name       | 文字列          | 店舗の名前                |
| overview   | 文字列          | 店舗の詳細                |
| image_path | 文字列          | 店舗の画像URL             |
| created_at | 日付と時刻      | 作成日時                  |
| updated_at | 日付と時刻      | 更新日時                  |
#### areasテーブル
エリアを管理する。
| カラム名   | 属性       | 役割                          |
|:-----------|:----------|:-----------------------------|
| id         | 整数       | エリアを識別するID            |
| name       | 文字列     | エリア名                      |
| created_at | 日付と時刻 | 作成日時                      |
| updated_at | 日付と時刻 | 更新日時                      |
#### categoriesテーブル
カテゴリーを管理する。
| カラム名    | 属性              | 役割             |
|:-----------|:------------------|:----------------|
| id         | 整数               | カテゴリーを識別するID |
| name       | 文字列             | カテゴリー名          |
| created_at | 日付と時刻         | 作成日時         |
| updated_at | 日付と時刻         | 更新日時         |
#### favoritesテーブル
お気に入りを管理する。usersテーブルとshopsテーブルを紐付ける中間テーブル。
| カラム名    | 属性       | 役割                   |
|:-----------|:-----------|:-----------------------|
| id         | 整数       | お気に入りを識別するID |
| user_id    | 整数       | お気に入りしたユーザーのid |
| shops_id   | 整数       | お気に入りした店舗のid |
| created_at | 日付と時刻 | 作成日時                |
| updated_at | 日付と時刻 | 更新日時                |
#### reservationsテーブル
予約を管理する。usersテーブルとshopsテーブルを紐付ける中間テーブル。
| カラム名    | 属性       | 役割                   |
|:-----------|:-----------|:-----------------------|
| id         | 整数       | 予約を識別するID        |
| user_id    | 整数       | 予約したユーザーのid    |
| shops_id   | 整数       | 予約した店舗のid        |
| date       | 日付       | 予約の日付              |
| time       | 時刻       | 予約の時刻              |
| number     | 整数       | 予約の人数              |
| created_at | 日付と時刻 | 作成日時                |
| updated_at | 日付と時刻 | 更新日時                |

## 12.インフラ構成図


##### [↑ページトップへ](https://github.com/takamasa0719/Rese)