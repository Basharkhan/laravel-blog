<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class TextWidget extends Model
{
    use HasFactory;

    protected $fillable = ['key', 'image', 'title', 'content', 'active'];

    public static function getTitle($key): string {
        $widget = Cache::get('text-widget-' . $key, function() use($key) {
            return TextWidget::query()->where('key', '=', $key)->where('active', '=', true)->first();
        });        

        if($widget && $widget->title) {
            return $widget->title;
        }

        return '';
    }

    public static function getContent($key): string {
        $widget = Cache::get('text-widget-' . $key, function() use($key) {
            return TextWidget::query()->where('key', '=', $key)->where('active', '=', true)->first();
        });        

        if($widget && $widget->content) {
            return $widget->content;
        }

        return '';
    }
}
