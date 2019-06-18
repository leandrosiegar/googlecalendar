<?php
session_start();

// print_r($_SESSION);exit;

require_once('google-calendar-api.php');
require_once('settings.php');

$capi = new GoogleCalendarApi();

// echo CLIENT_ID.":".CLIENT_REDIRECT_URL.":".CLIENT_SECRET.":".$_GET['code'];

		
// Get the access token 
// $data = $capi->GetAccessToken(APPLICATION_ID, APPLICATION_REDIRECT_URL, APPLICATION_SECRET, $_GET['code']);
$data = $capi->GetAccessToken(CLIENT_ID, CLIENT_REDIRECT_URL, CLIENT_SECRET, $_GET['code']);
$access_token = $data['access_token'];
echo "<hr>access_token:".$access_token;

// Get user calendar timezone
$user_timezone = $capi->GetUserCalendarTimezone($access_token);

$calendar_id = 'primary';
$event_title = 'Cita con el médico '.$_SESSION["nom_medico"]." en la calle ".$_SESSION["nom_clinica"];

// Event starting & finishing at a specific time
$full_day_event = 0; 
// $event_time = [ 'start_time' => '2019-06-21T15:00:00', 'end_time' => '2019-06-21T16:00:00' ];
$event_time = [ 'start_time' => $_SESSION["fecha_calendario"]."T".$_SESSION["horaInit"].':00', 'end_time' => $_SESSION["fecha_calendario"]."T".$_SESSION["horaFin"].':00' ];

echo "<hr>event_time:";
print_r($event_time);


// Full day event
// $full_day_event = 1; 
// $event_time = [ 'event_date' => '2016-12-31' ];

// Create event on primary calendar
$event_id = $capi->CreateCalendarEvent($calendar_id, $event_title, $full_day_event, $event_time, $user_timezone, $access_token);

echo "EVENTO CREADO:".$event_id;
