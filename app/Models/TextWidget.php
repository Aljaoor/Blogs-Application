<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

/**
 * @property integer $id
 * @property string $key
 * @property string $image
 * @property string $title
 * @property string $content
 * @property boolean $active
 * @property string $created_at
 * @property string $updated_at
 */
class TextWidget extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['key', 'image', 'title', 'content', 'active', 'created_at', 'updated_at'];


    public static function getTitle(string $key): string
    {
        $widget = TextWidget::query()->where('key', $key)->first();

        if (!$widget) {
            return '';
        }

        return $widget->title;
    }

    public static function getContent(string $key): string
    {
        $widget = Cache::get('text-widget-' . $key, function () use ($key) {
            return TextWidget::query()->where('key', $key)->first();
        });

        if (!$widget) {
            return '';
        }

        return $widget->content;
    }

    public function getImage(): string
    {
        if (str_starts_with($this->attributes['image'], 'http')) {
            return $this->attributes['image'];
        }
        return asset('storage/' . $this->attributes['image']);
    }

}
