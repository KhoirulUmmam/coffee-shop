<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $table = 'companys';
    protected $fillable = [
        'initial',
        'description',
        'name',
        'address',
        'province',
        'city',
        'postal_code',
        'web',
        'email',
        'telephone',
        'fax',
    ];
}
