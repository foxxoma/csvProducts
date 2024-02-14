<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'level_1',
        'level_2',
        'level_3',
        'price',
        'price_jp',
        'count',
        'properties',
        'joint_purchases',
        'img',
        'display_main',
        'description',
    ];

    public static $csvTitles = [
        'Код' => 'code',
        'Наименование' => 'name',
        'Уровень1' => 'level_1',
        'Уровень2' => 'level_2',
        'Уровень3' => 'level_3',
        'Цена' => 'price',
        'ЦенаСП' => 'price_jp',
        'Количество' => 'count',
        'Поля свойств' => 'properties',
        'Совместные покупки' => 'joint_purchases',
        'Единица измерения' => 'unit_measurement',
        'Картинка' => 'img',
        'Выводить на главной' => 'display_main',
        'Описание' => 'description',
    ];
}
