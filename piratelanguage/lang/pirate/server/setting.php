<?php

return [
    'title' => 'Ship Settin\'s',
    'server_info' => [
        'title' => 'Ship\'s Scrolls',
        'information' => 'The Details',
        'name' => 'Name o\' the Ship',
        'notification_name' => 'Ship\'s Name Hoisted High',
        'description' => 'What the Ship Be About',
        'notification_description' => 'New Tale for the Ship Written',
        'failed' => 'Aye, It Failed',
        'uuid' => 'Ship\'s Secret Mark (UUID)',
        'id' => 'Ship ID',

        'limits' => [
            'title' => 'What Ye Be Allowed',
            'unlimited' => 'No Shackles',
            'of' => 'of',
            'cpu' => 'Thinkin\' Power (CPU)',
            'memory' => 'Mindspace (Memory)',
            'disk' => 'Cargo Hold (Disk Space)',
            'backups' => 'Stashed Loot (Backups)',
            'databases' => 'Tomes o\' Knowledge (Databases)',
            'allocations' => 'Dockin\' Spots (Allocations)',
            'no_allocations' => 'No More Dockin\' Spots for This Vessel',
        ],
    ],

    'node_info' => [
        'title' => 'Dock Info',
        'name' => 'Name o\' the Dock',
        'sftp' => [
            'title' => 'SFTP Ship Ropes',
            'connection' => 'Moorin\' Line (Connection)',
            'action' => 'Latch Onto SFTP',
            'username' => 'Deckhand\'s Name',
            'password' => 'Secret Code',
            'password_body' => 'Yer SFTP pass be the same one ye use to board this here panel.',
        ],
    ],

    'reinstall' => [
        'title' => 'Rig Her Again (Reinstall)',
        'body' => 'Riggin\' the ship anew will halt her sails and run the script that once gave her life.',
        'body2' => 'Mind ye, some maps or loot might be tossed o\'erboard. Back ‘em up first!',
        'action' => 'Rig Her Again',
        'modal' => 'Ye sure ye want to rig the ship anew?',
        'modal_description' => 'Beware! Some loot might be lost or changed. Best make a backup first.',
        'yes' => 'Aye, Rig Her Again!',
        'notification_start' => 'She Be Gettin\' Rigged',
        'notification_fail' => 'Re-Riggin\' Went Belly-Up',
    ],
];
