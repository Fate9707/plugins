<?php

return [
    'title' => 'Ship\'s Runnin\' Routines',
    'new' => 'Plot New Routine',
    'edit' => 'Tweak the Routine',
    'save' => 'Save the Routine',
    'delete' => 'Scuttle the Routine',
    'import' => 'Smuggle a Routine In',
    'export' => 'Send a Routine Out',
    'name' => 'Name o\' the Routine',
    'cron' => 'Bell Ringin\' (Cron)',
    'status' => 'Status o\' the Voyage',
    'inactive' => 'Sleepin\'',
    'processing' => 'Workin\' the Riggin\'',
    'active' => 'Full Sail Ahead',
    'no_tasks' => 'No Chores in the List',
    'run_now' => 'Fire It Up Now',
    'online_only' => 'Only When the Ship\'s Alive',
    'last_run' => 'Last Time She Sailed',
    'next_run' => 'Next Scheduled Voyage',
    'never' => 'Not Yet, Matey',
    'cancel' => 'Belay That!',

    'only_online' => 'Only if the Ship\'s Breathin\'?',
    'only_online_hint' => 'Only set sail with this routine if the ship be runnin\'.',
    'enabled' => 'Hoist the Routine?',
    'enabled_hint' => 'The routine will sail on its own if ye give the word.',

    'cron_body' => 'Keep yer eyes sharp — cron speak always goes by the UTC stars.',
    'cron_timezone' => 'Next voyage in yer timezone (:timezone): <b> :next_run </b>',

    'time' => [
        'minute' => 'Minuteglass',
        'hour' => 'Hour o\' the Watch',
        'day' => 'Day at Sea',
        'week' => 'Seven-Day Stretch',
        'month' => 'Full Moon Cycle',
        'day_of_month' => 'Day o\' the Moon',
        'day_of_week' => 'Day o\' the Week',

        'hourly' => 'Each Hour',
        'daily' => 'Every Tide',
        'weekly_mon' => 'Weekly (First Mate\'s Day)',
        'weekly_sun' => 'Weekly (Rest Day)',
        'monthly' => 'Each Full Moon',
        'every_min' => 'Every x Bells',
        'every_hour' => 'Every x Hours',
        'every_day' => 'Every x Sunrises',
        'every_week' => 'Every x Voyages',
        'every_month' => 'Every x Full Moons',
        'every_day_of_week' => 'Each x Weekday',

        'every' => 'Every',
        'minutes' => 'Bells',
        'hours' => 'Watches',
        'days' => 'Days',
        'months' => 'Moons',

        'monday' => 'First Mate\'s Day',
        'tuesday' => 'Two-Rum Tuesday',
        'wednesday' => 'Windsday',
        'thursday' => 'Thar\'sday',
        'friday' => 'Fish Fryday',
        'saturday' => 'Shipshape Saturday',
        'sunday' => 'Still Sunday',
    ],

    'tasks' => [
        'title' => 'Chores',
        'create' => 'Add a Chore',
        'limit' => 'Ye\'ve Hit the Chore Limit',
        'action' => 'What Be Done',
        'payload' => 'The Cargo (Payload)',
        'time_offset' => 'Time Delay',
        'seconds' => 'Seconds on the Hourglass',
        'continue_on_failure' => 'Keep On Even if Things Go South',

        'actions' => [
            'title' => 'Action',
            'power' => [
                'title' => 'Send Power Orders',
                'action' => 'Power Order',
                'start' => 'Hoist the Sails',
                'stop' => 'Drop Anchor',
                'restart' => 'Turn Her About',
                'kill' => 'Sink Her!',
            ],
            'command' => [
                'title' => 'Send a Command',
                'command' => 'Shouted Orders',
            ],
            'backup' => [
                'title' => 'Stash the Loot (Backup)',
                'files_to_ignore' => 'Files to Toss Overboard',
            ],
            'delete' => [
                'title' => 'Sink the Files',
                'files_to_delete' => 'Files to Send to Davy Jones',

            ],
        ],
    ],

    'notification_invalid_cron' => 'Arrr! That cron gibberish don\'t make no sense, matey.',

];
