<?php

namespace App\Models;

use App\Traits\Timestamp;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BasicModel extends Model
{
    use HasFactory, Timestamp;
    protected $guarded = [];
}
