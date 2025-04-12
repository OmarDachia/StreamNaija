<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Filament Path
    |--------------------------------------------------------------------------
    |
    | This is the path where Filament will be accessible from. You can change
    | this to whatever you like, but make sure to update your routes and links
    | accordingly.
    |
    */

    'path' => 'admin',

    /*
    |--------------------------------------------------------------------------
    | File Upload Configuration
    |--------------------------------------------------------------------------
    |
    | Here you can configure the file upload settings for your application.
    |
    */  
    'file_upload' => [
        'max_size' => 20480, // Increase the file size limit to 20 MB
    ]
];