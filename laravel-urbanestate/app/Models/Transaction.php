<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $table = 'transactions';
    protected $fillable = ['nama', 'nomorhp', 'alamat', 'category_id', 'harga', 'status'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id_categories');
    }

}
