<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'date',
        'expense',
        'category',
    ];

    // update_at などを更新しないように設定
    public $timestamps = false;

    public function user(){
        return $this->belongsTo('App\Users');
    }

}
