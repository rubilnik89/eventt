<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //поля которые можно редактировать
    protected $fillable = ['title', 'content'];
}
/**
 * Created by PhpStorm.
 * User: Роман
 * Date: 27.05.2016
 * Time: 11:02
 */