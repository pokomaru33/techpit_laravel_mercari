@extends('layouts.pdf')

@section('title')
購入リスト
@endsection

@section('content')
    <div class="header-box">
        <p class="header-box__nowDate">{{$date->format('Y年m月d日')}}</p>
        <p class="header-box__reciptNumber">納品番号: 0000000000000</p>
    </div>
    <h1 class="title">購入リスト</h1>
    <div class="d-flex mt-3 position-relative">
        <div>
            <h2>{{$user->name}} 様</h2>
            <p>件名: 購入頂いた商品</p>
            <p class="header-box__nowDate">{{$date->format('Y年m月d日')}}</p>
            <p class="mt-10 mb-10">下記にお客様の購入データを記載いたします。</p>
            <p class="total_price">合計金額<span>: \{{$total_price}}-</span></p>
        </div>
        <div>
            <p>ほりもと株式会社</p>
            <p>&#12306; 111-1111<br>大阪府大阪市ああ区<br>えええ町1-22-22</p>
            <p class="mt-10">tel: 000-0000-0000</p>
            <p>e-mail: asdf@aa.com</p>
        </div>
        <div>
            {{-- 印鑑画像 --}}
            <div style="background: #aaa; width:50px; height:50px; color:red">印鑑</div>
        </div>
    </div>
    <div class="table">
        <table>
            <thead>
                <tr>
                    <th>品番・品名</th>
                    <th>数量</th>
                    <th>単価</th>
                    <th>金額</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                <tr>
                    <td>{{$item->name}}</td>
                    <td>1</td>
                    <td>{{$item->price}}</td>
                    <td>{{$item->price}}</td>
                </tr>
                @endforeach
                <tr>
                    <td></td>
                    <td colspan="2">合計金額</td>
                    <td>{{$total_price}}</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection