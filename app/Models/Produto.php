<?php

namespace App\Models;

use Illuminate\Cache\HasCacheLock;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasCacheLock;

    protected $fillable = [
        "descricao","qtd", "precoVenda"
    ];
}
