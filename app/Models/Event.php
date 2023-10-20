<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id', 'title', 'start_date', 'end_date', 'banner_image', 'body'];

    public function getBodyExcerptAttribute()
    {
        // $text = preg_replace('/<img[^>]+src="data:image[^>]+>/', '', $this->body);

        // return  Str::limit($text, 50);

        // $excerpt = substr($this->body, 0, 50);
        // return strlen($this->body) > 50 ? $excerpt . '...' : $excerpt;

        return Str::limit(strip_tags($this->body), 130);
    }
}
