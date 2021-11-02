<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;


class Course extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, HasTranslations;
    
    public $translatable = ['title','desc'];


    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [

    'title',
    'desc',
    'image_url'

    ];
    public function user(){

        return $this->BelongsTo('App/Models/User');
       }
}
