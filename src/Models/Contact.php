<?php

namespace PortedCheese\ContactPage\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use PortedCheese\ContactPage\Http\Requests\ContactStoreRequest;

class Contact extends Model
{
    const DAYS = ["Пн", "Вт", "Ср", "Чт", "Пт", "Сб", "Вс"];

    protected $fillable = [
        'title',
        'latitude',
        'longitude',
        'description',
        'ico',
        'weight',
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
     * @return mixed
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
     * @return mixed
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
        return Str::limit($this->title, 40);
    }

    /**
     * Валидация создания контакта.
     *
     * @param ContactStoreRequest $validator
     * @param bool $attr
     * @return array
     */
    public static function requestContactStore(ContactStoreRequest $validator, $attr = false)
    {
        if ($attr) {
            return [
                "title" => "Заголовок",
            ];
        }
        else {
            return [
                'title' => 'required',
            ];
        }
    }

    /**
     * Данные для вывода на страницу.
     *
     * @return object
     */
    public function toRender()
    {
        $links = [];
        foreach ($this->links_data as $linkName => $linkData) {
            if (empty($linkData)) {
                continue;
            }
            if ($linkName == 'webs') {
                foreach ($linkData as &$web) {
                    $exploded = explode("//", $web['value']);
                    if (count($exploded) == 2) {
                        $web['humanValue'] = $exploded[1];
                    }
                    else {
                        $web['humanValue'] = $web['value'];
                    }
                }
            }
            $links[$linkName] = $linkData;
        }
        return (object) [
            'model' => $this,
            'days' => empty($this->work_time) ? [] : $this->work_times,
            'socials' => !empty($links['socials']) ? $links['socials'] : false,
            'webs' => !empty($links['webs']) ? $links['webs'] : false,
            'emails' => !empty($links['emails']) ? $links['emails'] : false,
            'phones' => !empty($links['phones']) ? $links['phones'] : false,
        ];
    }
}
