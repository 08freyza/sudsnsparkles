<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceCategory extends Model
{
    use HasFactory;

    protected $primaryKey = 'service_cat_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['service_cat_id', 'name', 'last_number', 'additional_info', 'created_at', 'updated_at'];
}
