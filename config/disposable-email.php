<?php

return [
    /*
     * A local black‐list you can maintain in storage/app/blacklist_file
     */
    'blacklist_file' => storage_path('app/blacklist_file'), // ← note the closing quote & paren

    /*
     * Remote URLs you want to merge in
     */
    'remote_url' => [
        'https://raw.githubusercontent.com/disposable/disposable-email-domains/master/domains.txt',
        'https://raw.githubusercontent.com/7c/fakefilter/raw/main/txt/data.txt',
    ],
];
