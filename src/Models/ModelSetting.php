<?php

namespace r94ever\LaravelModelSetting\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ModelSetting
 * @package r94ever\LaravelModelSetting\Models
 *
 * @property \Illuminate\Support\Collection settings
 */
class ModelSetting extends Model
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->table = config('model-setting.table_name');
    }

    protected $fillable = [
        'model_type',
        'model_id',
        'settings'
    ];

    protected $casts = [
        'settings' => 'array'
    ];
}
