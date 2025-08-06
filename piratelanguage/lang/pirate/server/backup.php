<?php

return [
    'title' => 'Booty Logs',
    'empty' => 'No Booty in the Hold',
    'size' => 'Cargo Weight',
    'created_at' => 'Stashed On',
    'status' => 'Condition o\' the Booty',
    'is_locked' => 'Be It Locked?',
    'backup_status' => [
        'in_progress' => 'Still Bein\' Buried',
        'successful' => 'Buried Treasure Found',
        'failed' => 'The Buryin\' Failed',
    ],
    'actions' => [
        'create' => [
            'title' => 'Stash New Booty',
            'limit' => 'Booty Hold Be Full',
            'created' => ':name be buried deep',
            'notification_success' => 'Booty Buried Successfully',
            'notification_fail' => 'Couldn\'t Bury the Booty',
            'name' => 'Name o\' the Booty',
            'ignored' => 'Files & Folders Left Behind',
            'locked' => 'Chained Down?',
            'lock_helper' => 'Stops this treasure from bein\' tossed until ye unchain it yerself.',
        ],
        'lock' => [
            'lock' => 'Chain It',
            'unlock' => 'Unchain It',
        ],
        'download' => 'Snag It',
        'restore' => [
            'title' => 'Raise the Booty',
            'helper' => 'Yer ship\'ll be stopped cold. No controls, no charts, no new stashin\' until the booty be back in place.',
            'delete_all' => 'Scuttle all files before raisin\' the treasure?',
            'notification_started' => 'Booty Be Comin\' Back',
            'notification_success' => 'Booty Raised from the Depths',
            'notification_fail' => 'Couldn\'t Raise the Booty',
            'notification_fail_body_1' => 'This vessel ain\'t ready to raise no treasure just yet.',
            'notification_fail_body_2' => 'This booty can\'t be raised now — it\'s either lost or unfinished.',
        ],
        'delete' => [
            'title' => 'Sink the Booty',
            'description' => 'Ye sure ye want to sink :backup to the deep?',
            'notification_success' => 'Booty Sunk to the Briny Deep',
            'notification_fail' => 'Couldn\'t Sink the Booty',
            'notification_fail_body' => 'Lost contact with the crow\'s nest. Try again later.',
        ],
    ],
];
