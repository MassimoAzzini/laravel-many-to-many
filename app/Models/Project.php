<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    public function type(){
        return $this->belongsTo(Type::class);
    }

    public function technologies(){
        return $this->belongsToMany(Technology::class);
    }



    protected $fillable = [
        'name',
        'slug',
        'type_id',
        'short_description',
        'description',
        'start_project',
        'end_project',
        'url',
        'image',
        'image_original_name'
    ];

}
