<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;


    protected $table = 'locations'; // モデルが対応するテーブル名

    protected $fillable = ['name']; // ユーザーが代入可能なフィールド

    public function users()
    {
        return $this->hasMany(User::class);
    }













}




