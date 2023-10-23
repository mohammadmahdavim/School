<?php


namespace App\Services;


use App\Setting;
use Baghayi\Skyroom\Exception\AccessDenied;
use Baghayi\Skyroom\Exception\AlreadyExists;
use Baghayi\Skyroom\Exception\DuplicateRoom;
use Baghayi\Skyroom\Exception\InvalidRoomName;
use Baghayi\Skyroom\Exception\NotFound;
use Baghayi\Skyroom\Exception\UnavailableUsername;
use GuzzleHttp\Client;

class SkyRoom
{
    const ERROR_CODES = [
        15 => NotFound::class,
    ];

    private $correspondingErrorExceptions = [
        'The record already exists.' => AlreadyExists::class,
        'User has no access to the room' => AccessDenied::class,
        'Access to the resource is denied.' => AccessDenied::class,
        'اتاقی با همین نام وجود دارد. از نام دیگری استفاده نمایید.' => DuplicateRoom::class,
        'نام کاربری تکراری است' => UnavailableUsername::class,
        'نام اتاق معتبر نیست.' => InvalidRoomName::class,
    ];
    private $http;

    public function __construct(Client $http)
    {
        $this->http = $http;
    }

    public function actions($action, $params)
    {
        $setting = Setting::all()->first();
        $api = $setting->sky;
        $response = $this->http->request('POST', "https://www.skyroom.online/skyroom/api/" . $api, [
            'json' => [
                'action' => $action,
                'params' => $params
            ],
        ]);

        $result = json_decode($response->getBody(), true);
        if ($result['ok'] === true) {
            return ['ok,', $result['result']];
        }
        return ['error', $result['error_message']];

    }


}
