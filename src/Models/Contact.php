<?php

namespace PortedCheese\ContactPage\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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
        'address',
    ];

    protected $casts = [
        'work_time' => 'array',
        'links' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function (\App\Contact $contact) {
            $max = \App\Contact::query()
                ->select("weight")
                ->max("weight");
            $contact->weight = $max + 1;
        });
    }

    /**
     * Получить список контактов.
     *
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function getForPage()
    {
        $contacts = [];

        $id = request("point", false);
        try {
            $contact = \App\Contact::query()->findOrFail($id);
            $contacts[] = $contact;
        }
        catch (\Exception $exception) {
            $id = false;
        }

        $collection = self::query();
        if ($id) {
            $collection->whereNotIn("id", [$id]);
        }
        $items = $collection->orderBy("weight")->get();
        foreach ($items as $item) {
            $contacts[] = $item;
        }
        return $contacts;
    }

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
            return (float) siteconf()->get("contact-page", "latitude");
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
            return (float) siteconf()->get("contact-page", "longitude");
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
     * Сгруппированные рабочие дни.
     *
     * @return array
     */
    public function getDaysGroupsAttribute()
    {
        $groups = [];
        if (! empty($this->work_time)) {
            $start = false;
            $time = false;
            $prev = false;
            foreach ($this->work_time as $day) {
                if (! $start) {
                    $start = $day['name'];
                    $time = $day['workTime'];
                }
                if ($day['workTime'] == $time) {
                    $prev = $day['name'];
                    continue;
                }
                $groups[] = [
                    'start' => $start,
                    'end' => $prev,
                    'time' => $time,
                ];
                $time = $day['workTime'];
                $prev = $start = $day['name'];
            }
            $groups[] = [
                'start' => $start,
                'end' => $prev,
                'time' => $time,
            ];
        }
        return $groups;
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
            'daysGrouped' => $this->days_groups,
            'socials' => !empty($links['socials']) ? $links['socials'] : false,
            'webs' => !empty($links['webs']) ? $links['webs'] : false,
            'emails' => !empty($links['emails']) ? $links['emails'] : false,
            'phones' => !empty($links['phones']) ? $links['phones'] : false,
        ];
    }
}
