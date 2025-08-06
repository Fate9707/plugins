<?php

return [
    'title' => 'Ship\'s Logs',
    'name' => 'Name o\' the Scroll',
    'size' => 'Heft o\' the Loot',
    'modified_at' => 'Last Tampered',
    'actions' => [
        'open' => 'Crack It Open',
        'download' => 'Snag It',
        'copy' => [
            'title' => 'Make a Twin',
            'notification' => 'Scroll Be Duplicated',
        ],
        'upload' => [
            'title' => 'Stash Aboard',
            'from_files' => 'Bring Files Aboard',
            'from_url' => 'Fetch from Faraway Lands (URL)',
            'url' => 'Map to the Loot (URL)',
        ],
        'rename' => [
            'title' => 'Change the Name',
            'file_name' => 'New Scroll Title',
            'notification' => 'Scroll Be Renamed',
        ],
        'move' => [
            'title' => 'Stow Elsewhere',
            'directory' => 'Locker',
            'directory_hint' => 'Point the way to the new locker (relative to now)',
            'new_location' => 'New Dock',
            'new_location_hint' => 'Chart the new dock (relative)',
            'notification' => 'Scroll Moved',
            'bulk_notification' => ':count scrolls moved to :directory',
        ],
        'permissions' => [
            'title' => 'Who Can Touch It?',
            'read' => 'Spy It',
            'write' => 'Scratch on It',
            'execute' => 'Set It Sailin\'',
            'owner' => 'Cap\'n',
            'group' => 'The Crew',
            'public' => 'All Hands',
            'notification' => 'Rules be changed to :mode',
        ],
        'archive' => [
            'title' => 'Bottle It Up',
            'archive_name' => 'Name o\' the Barrel',
            'notification' => 'Barrel Sealed Tight',
        ],
        'unarchive' => [
            'title' => 'Crack Open the Barrel',
            'notification' => 'Booty Unpacked',
        ],
        'new_file' => [
            'title' => 'Scribe New Scroll',
            'file_name' => 'Name o\' the New Scroll',
            'syntax' => 'Scroll Style (Syntax)',
            'create' => 'Start Scribblin\'',
        ],
        'new_folder' => [
            'title' => 'Build New Locker',
            'folder_name' => 'Name o\' the New Locker',
        ],
        'global_search' => [
            'title' => 'Search the Seven Seas',
            'search_term' => 'What Be Ye Lookin\' For?',
            'search_term_placeholder' => 'Toss a word in, like *.txt',
            'search' => 'Start the Hunt',
        ],
        'delete' => [
            'notification' => 'Scroll Sent to the Depths',
            'bulk_notification' => ':count scrolls tossed overboard',
        ],
        'edit' => [
            'title' => 'Scribblin\' on: :file',
            'save_close' => 'Seal & Close',
            'save' => 'Seal the Changes',
            'cancel' => 'Abandon Ship',
            'notification' => 'Scroll Sealed Up',
        ],
    ],
];
