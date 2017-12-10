<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Index extends Model
{
    /**
     * @var array
     */
    protected $appends = ['different'];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        self::updated(function ($model) {
            $index_value = new IndexValue();
            $index_value->index_id = $model->id;
            $index_value->value = $model->current_value;
            $index_value->created_at = $model->updated_at;
            $index_value->save();
        });
    }

    /**
     * @return HasMany
     */
    public function history(): HasMany
    {
        return $this->hasMany(IndexValue::class);
    }

    /**
     * @return array
     */
    public function getDifferentAttribute()
    {
        $last = $this->history()->latest()->first();
        $preLast = $this->history()->latest()->skip(1)->first();

        $index = round($last->value - $preLast->value, 2);
        $percent = round($last->value / $preLast->value, 2);

        return compact('index', 'percent');
    }
}
