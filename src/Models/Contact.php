<?php

namespace PortedCheese\ContactPage\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class Contact extends Model
{
    const DAYS = ["Пн", "Вт", "Ср", "Чт", "Пт", "Сб", "Вс"];

    protected $fillable = [
        'title',
        'latitude',
        'longitude',
        'description',
    ];

    protected $casts = [
        'work_time' => 'array',
        'links' => 'array',
    ];

    /**
     * Время работы со значением по умолчанию.
     *
     * @return array|mixed
     */
    public function getWorkTimesAttribute()
    {
        $times = $this->work_time;
        if (empty($times)) {
            $times = [];
            for ($i = 0; $i < 7; $i++) {
                $times[$i] = [
                    'workTime' => "",
                    'dinerTime' => "",
                    'name' => self::DAYS[$i],
                    'number' => $i,
                    'holliday' => $i > 4,
                ];
            }
        }
        return $times;
    }

    /**
     * Ссылки со значением по умолчанию.
     *
     * @return array|mixed
     */
    public function getLinksDataAttribute()
    {
        $links = $this->links;
        if (empty($links)) {
            $links = [
                'phones' => [],
                'emails' => [],
                'webs' => [],
                'socials' => [],
            ];
        }
        return $links;
    }

    /**
     * Default value for latitude.
     *
     * @param $value
     */
    public function getLatitudeAttribute($value)
    {
        if (empty($value)) {
            return env('CONTACT_LATITUDE', 39.89);
        }
        else {
            return $value;
        }
    }

    /**
     * Default value for longitude.
     *
     * @param $value
     */
    public function getLongitudeAttribute($value)
    {
        if (empty($value)) {
            return env('CONTACT_LONGITUDE', 59.22);
        }
        else {
            return $value;
        }
    }

    /**
     * Обрезать заголовок.
     *
     * @return string
     */
    public function getLimitTitleAttribute()
    {
        return Str::limit($this->title, 10);
    }
}
