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
    //protected $appends = ['increasing', 'decreasing'];

    /**
     * @var
     */
    //protected $historyCount = 0;


    /**
     * @return HasMany
     */
    public function history(): HasMany
    {
        return $this->hasMany(IndexValue::class);
    }

    /**
     * @return bool|mixed
     */
    public function getIncreasingAttribute()
    {
        $increasing = 0;

        if(!$this->historyCount) {
            $this->historyCount = $this->history->count();
        }

        if ($this->historyCount >= 2) {
            $increasing = ( $this->history[$this->historyCount - 1]->value > $this->history[$this->historyCount - 2]->value );
        }

        return $increasing;
    }

    /**
     * @return bool|mixed
     */
    public function getDecreasingAttribute()
    {
        $decreasing = 0;

        if(!$this->historyCount) {
            $this->historyCount = $this->history->count();
        }

        if ($this->historyCount >= 2) {
            $decreasing = ( $this->history[$this->historyCount - 1]->value < $this->history[$this->historyCount - 2]->value );
        }

        return $decreasing;
    }
}
