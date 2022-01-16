<html><!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

  <title>Document</title>
</head>
<body>

{{-- header --}}
<div class="header"></div>

{{-- main --}}
<div class="main container-fluid mr-5">
  <div class="row vh-100">
    <div class="sidebar col-md-3 bg-light h3">
      <ul class="nav flex-column ">
        {{-- <li class="nav-item"><a class="nav-link" href="#">ロゴ</a></li> --}}
        <li class="nav-item"><a class="nav-link" href="/expense">ホーム</a></li>
        <li class="nav-item"><a class="nav-link" href="#">ログアウト</a></li>
      </ul>
    </div>
    {{-- メインコンテンツ --}}
    <div class="main-contents col-md-9">
      <div class="head-message mt-3 h2 border-bottom">ようこそ!   {{Auth::user()->name;}}さん</div>
      {{-- <div class="border-top"></div> --}}
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-8 ">
        {{-- 支出データ編集 --}}
        <p class="h4">支出編集 データID: {{$expense->id}}</p>        
      <form action="{{url('/expense/edit')}}" method="post">
        @csrf
        <div class="form-group mt-5 h4">
          <input class="form-control" type="hidden" name="id" value="{{$expense->id}}" id="id" required>
          <label for="" class="mt-2">支出日時</label>
          <input class="form-control" type="date" name="date" value="{{$expense->date}}" id="date" required>
          <label for="" class="mt-2">支出金額</label>
          <input class="form-control" type="number" name="expense" value="{{$expense->expense}}" id="expense" required min="1">
          <label for="" class="mt-2">カテゴリー</label>
          <select class="form-control" name="category" value="{{$expense->category}}" id="category">
            <option>衣</option>
            <option>食</option>
            <option>住</option>
          </select>
        </div> 
        <div class="text-center mt-3">
          <button type="submit button" class="btn btn-primary">編集登録完了</button>
        </div>
       
              
      </form>

       {{-- 支出データ削除 --}}
       <form action="{{url('/expense/delete')}}" method="post">
        @csrf
        <div class="form-group text-center mt-3">
          <input class="form-control" type="hidden" name="id" value="{{$expense->id}}" id="id" required>
          <button type="submit button" class="btn btn-danger">削除</button>
        </div>       
      </form>

      </div>
    </div>
  </div>
         
        

    </div>
  </div>
</div>
</body>