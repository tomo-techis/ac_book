<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

{{-- CDN　chart.js --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.min.js" integrity="sha512-GMGzUEevhWh8Tc/njS0bDpwgxdCJLQBWG3Z2Ct+JGOpVnEmjvNx6ts4v6A2XJf1HOrtOsfhv3hBKpK9kE5z8AQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

   
    <title>Account_book</title>
</head>

<body>

{{-- header --}}
<div class="header"></div>

{{-- main --}}
<div class="main container-fluid mr-5">
  <div class="row">
    <div class="sidebar col-md-3 bg-light h3 vh-100 sticky-top">
      <ul class="nav flex-column">
        {{-- <li class="nav-item"><a class="nav-link" href="#">ロゴ</a></li> --}}
        <li class="nav-item"><a class="nav-link" href="/expense">ホーム</a></li>
        <li class="nav-item align-bottom">
          <a class="nav-link" href="{{route('logout')}}" 
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">ログアウト</a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
        </li>
      </ul>
    </div>
    {{-- メインコンテンツ --}}
    <div class="main-contents col-md-9">
      <div class="head-message mt-3 h2 border-bottom">ようこそ!  {{Auth::user()->name;}}さん</div>
      {{-- <div class="border-top"></div> --}}
      <div class="ex-regist">
        <p class="h3">支出登録</p>        
      <form action="{{url('/expense/regist')}}" method="post">
        @csrf
        <div class="form-group">
          <label for="">支出日時</label>
          <input class="form-control" type="date" name="date" id="date" required>
          <label for="">支出金額</label>
          <input class="form-control" type="number" name="expense" id="expense" required min="1">
          <label for="">カテゴリー</label>
          <select class="form-control" name="category" id="category">
            <option>衣</option>
            <option>食</option>
            <option>住</option>
          </select>
        <button type="submit button" class="btn btn-primary btn-lg mt-3">登録</button>
        </div>
       
      </form>
      </div>
      <div class="ex-graph border-top border-4"> 
       <p class="h3">支出グラフ</p>

        <div class="graph" style="height:40vh; width:80vw">
          <canvas id="myPieChart">
          </canvas>
        </div>      
        
      </div>
      <div class="ex-detail border-top border-4">
        <p class="h4">支出詳細</p>
        @foreach ($ex_sum as $ex_sum)
            <p>{{$ex_sum->category}}：{{$ex_sum->expense_sum}}</p>
        @endforeach
        {{-- <p> {{$food}},{{$house}},{{$cloth}} </p>   衣食住表示テスト--}}


         <div class="row"> 
           <div class="col-11">   
        <table class="table table-bordered h6 m-3">
            <tr>
              <th>日付</th><th>金額</th><th>カテゴリー</th><th>&nbsp;</th>
            </tr>
            @foreach ($expenses as $expense)
            <tr>
              <th>{{$expense->date}}</th>
              <th>{{$expense->expense}}</th>
              <th>{{$expense->category}}</th>
              <th class="text-center">
                <a href="{{url('expense/edit/'.$expense->id)}}"><u class="text-dark">>>編集</u></a>
              </th>
            </tr>
            @endforeach
          </table>
         </div>
        </div> 
      </div>
     </div>
  </div>
</div>

{{-- footer --}}
<div class="footer">
  <div class="text-center h5 text-info">©T.Ishioka, 2021</div>
</div>
</body>
</html>

{{-- グラフ設定 --}}
<script>
  var ctx = document.getElementById("myPieChart");
  var myPieChart = new Chart(ctx, {
    type: 'pie',
    data: {
      labels: ["衣", "食", "住"], //データ項目のラベル
      datasets: [{
          backgroundColor: [
              "#c97586",
              "#bbbcde",
              "#93b881"
              
          ],
          data: [{{$cloth}}, {{$food}}, {{$house}}] //グラフのデータ
      }]
    },

    options: {
      maintainAspectRatio: false,
      title: {
        display: true,
        //グラフタイトル
        text: '支出グラフ'
      }
    }
  });
</script>
