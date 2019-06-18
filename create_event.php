<?php
session_start();

require_once('google-calendar-api.php');
require_once('settings.php');

$capi = new GoogleCalendarApi();
		
// Get the access token 
$data = $capi->GetAccessToken(APPLICATION_ID, APPLICATION_REDIRECT_URL, APPLICATION_SECRET, $_GET['code']);
$access_token = $data['access_token'];

// Get user calendar timezone
$user_timezone = $capi->GetUserCalendarTimezone($access_token);

$calendar_id = 'primary';
$event_title = 'Evento Leandro';

// Event starting & finishing at a specific time
$full_day_event = 0; 
$event_time = [ 'start_time' => '2019-06-21T15:00:00', 'end_time' => '2019-06-21T16:00:00' ];

// Full day event
// $full_day_event = 1; 
// $event_time = [ 'event_date' => '2016-12-31' ];

// Create event on primary calendar
$event_id = $capi->CreateCalendarEvent($calendar_id, $event_title, $full_day_event, $event_time, $user_timezone, $access_token);
?>