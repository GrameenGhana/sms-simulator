<?php

/*
|--------------------------------------------------------------------------
| Application Events
|--------------------------------------------------------------------------
|
| Here is where you can register all of the events for an application.
*/
Event::listen('eloquent.saved: Subscription', function($subscription)
{
	$subscription->setSchedules();
});
