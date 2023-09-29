<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carteira extends Model
{
    use HasFactory;

    protected $primaryKey = "user_id";

    protected $fillable = [
        'entrada',
        'saida',
        'saida_descricao',
        'entrada_descricao',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
