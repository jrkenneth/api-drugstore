<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DrugPrice extends Model
{
    //use HasFactory;
    protected $fillable = [
        'drug_id', 'user_id', 'price', 'location'
    ];
}
