<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('documents:purge')->daily();
