<?php

return [
    /*
    |---------------------------------------------------------------------------
    | Upload buckets mapped to folders in /uploads
    | disk:      'auto' = use AppSettings default disk (local or S3)
    | prefix:    subfolder under /uploads (or the key on S3)
    | visibility:'public' or 'private'
    | signed_urls: for private buckets, generate temporary URLs
    | signed_ttl: minutes for signed URLs
    |---------------------------------------------------------------------------
    */

    'app_logos' => [
        'disk'        => 'auto',
        'prefix'      => 'app_logos',
        'visibility'  => 'public',
        'signed_urls' => null,   
    'signed_ttl'  => null, 
    ],

    'business_logos' => [
        'disk'        => 'auto',
        'prefix'      => 'business_logos',
        'visibility'  => 'public',
        'signed_urls' => null,   
    'signed_ttl'  => null, 
    ],

    'carousel' => [
        'disk'        => 'auto',
        'prefix'      => 'carousel_images',
        'visibility'  => 'public',
        'signed_urls' => null,   
    'signed_ttl'  => null, 
    ],

    'bg_images' => [
        'disk'        => 'auto',
        'prefix'      => 'bg_images',
        'visibility'  => 'public',
        'signed_urls' => null,   
    'signed_ttl'  => null, 
    ],

    'invoice_logos' => [
        'disk'        => 'auto',
        'prefix'      => 'invoice_logos',
        'visibility'  => 'public',
        'signed_urls' => null,   
    'signed_ttl'  => null, 
    ],

    'img' => [
        'disk'        => 'auto',
        'prefix'      => 'img',
        'visibility'  => 'public',
       'signed_urls' => null,   
    'signed_ttl'  => null, 
    ],

    'cms' => [
        'disk'        => 'auto',
        'prefix'      => 'cms',
        'visibility'  => 'public',
       'signed_urls' => null,   
    'signed_ttl'  => null, 
    ],

    'media' => [
        'disk'        => 'auto',
        'prefix'      => 'media',
        'visibility'  => 'public',
        'signed_urls' => null,   
    'signed_ttl'  => null, 
    ],

    'documents' => [
        'disk'        => 'auto',
        'prefix'      => 'documents',
        'visibility'  => 'private',
        'signed_urls' => null,   
    'signed_ttl'  => null, 
    ],

    'temp' => [
        'disk'        => 'auto',
        'prefix'      => 'temp',
        'visibility'  => 'private',
       'signed_urls' => null,   
    'signed_ttl'  => null, 
    ],

    'bardpos' => [
        'disk'        => 'auto',
        'prefix'      => 'BardPOS',
        'visibility'  => 'private',
        'signed_urls' => null,   
    'signed_ttl'  => null, 
    ],
];
