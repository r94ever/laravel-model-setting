<?php

namespace r94ever\LaravelModelSetting\Tests\Model;

use Illuminate\Database\Eloquent\Model;
use r94ever\LaravelModelSetting\Interfaces\HasSettingContract;
use r94ever\LaravelModelSetting\Traits\HasSettingTrait;

class User extends Model implements HasSettingContract
{
    use HasSettingTrait;

    protected $table = 'users';

    protected $fillable = ['id', 'name'];
}
