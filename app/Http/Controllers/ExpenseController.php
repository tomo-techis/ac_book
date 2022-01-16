<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Expense;
use Illuminate\Support\Facades\Auth;  //追加した Authを使うため

class ExpenseController extends Controller
{
    //
 /**
      *  支出一覧表示
    */
    
    public function index(Request $request)
    {
        $expenses = Expense::where('user_id',Auth::id())->get(); //ユーザーIDを指定

        $expense_sum = Expense::where('user_id',Auth::id())  //ログインユーザーにおけるカテゴリー別支出合計
                        ->select('category', Expense::raw('SUM(expense) as expense_sum'))
                        ->groupBy('category')
                        ->get();

        $ex_sum_food = Expense::where('user_id',Auth::id())  //ログインユーザーにおけるカテゴリー事：食／支出合計
                        ->select('category', Expense::raw('SUM(expense) as expense_sum'))
                        ->groupBy('category')
                        ->where('category','食')
                        ->value('expense_sum');

        $ex_sum_house = Expense::where('user_id',Auth::id())  //ログインユーザーにおけるカテゴリー事：住／支出合計
                        ->select('category', Expense::raw('SUM(expense) as expense_sum'))
                        ->groupBy('category')
                        ->where('category','住')
                        ->value('expense_sum');
                        
        $ex_sum_cloth = Expense::where('user_id',Auth::id())  //ログインユーザーにおけるカテゴリー事：衣／支出合計
                        ->select('category', Expense::raw('SUM(expense) as expense_sum'))
                        ->groupBy('category')
                        ->where('category','衣')
                        ->value('expense_sum');
                                        
         return view('layout',[
            'expenses'=> $expenses,
            'ex_sum'=>$expense_sum,
            'food'=>$ex_sum_food,
            'house'=>$ex_sum_house,
            'cloth'=>$ex_sum_cloth

             ]);
    }
    
    // 支出登録
    
    public function regist(Request $request)
    {
        Expense::insert(
            [   
                'user_id'=>Auth::id(),
                'date'=>$request->date,
                'expense'=>$request->expense,
                'category'=>$request->category,
            ]
        );
        return redirect('/expense');
    }
    
    //支出個別データ表示
    public function find($id)
    {
        $expense = Expense::find($id);
        return view('expenses.edit',[
            'expense'=> $expense
            ]);
    }
    
    //支出個別データ表示
    public function edit(Request $request)
    {
        Expense::where('id',$request->id)->update(
            [   
                'user_id'=>Auth::id(),
                'date'=>$request->date,
                'expense'=>$request->expense,
                'category'=>$request->category,
            ]
        );
        return redirect('/expense');
    }
    
    //支出個別データ削除
    public function delete(Request $request)
    {
        Expense::destroy($request->id);
        return redirect('/expense');
    }

}
