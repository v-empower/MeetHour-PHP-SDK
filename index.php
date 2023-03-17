<?php
require_once __DIR__ . '/vendor/autoload.php';
require ('./autoload.php');
use App\Services\ApiService;
use App\Types\LoginType;
date_default_timezone_set('UTC');
$body = array(
    'meeting_name' => 'Quick Meeting',
    'agenda' => '',
    'passcode' => '123456',
    'meeting_date' => date('d-m-Y'),
    'meeting_time' => date('h:i'),
    'meeting_meridiem' => 'PM',
    'timezone' => date_default_timezone_get(),
    'instructions' => 'Team call, join as soon as possible',
    'is_show_portal' => 0,
    'options' => array('ALLOW_GUEST', 'JOIN_ANYTIME'),
    'hostusers' => array('first_name' => "Zeeshan", 'last_name' => "Ali", 'email' => "xeeshanali786@gmail.com")
);
    var_dump(strtoupper(date('h:i A')));
    $meetHourApiService = new ApiService();
    $login = new LoginType();

    $body = $login->toArray();
    $response = $meetHourApiService->login($body);
    // $scheduleBody = new ScheduleMeetingType();
    // $scheduleBody->agenda = "";

?>

