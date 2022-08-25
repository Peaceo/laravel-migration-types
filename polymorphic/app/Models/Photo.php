<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Photo extends Model
{
    use HasFactory, softDeletes;
    protected $date = ['deleted_at'];
    protected $fillable = ['path'];

    public function imageable(){
        return $this->morphTo();
    }
}
