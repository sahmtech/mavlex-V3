<?php

namespace Modules\Zatca\Classes\Actions;

class GetXmlFileAction
{
    /**
     * handle get content of xml file.
     *
     * @param  string $filename
     * @return string
     */
    public static function handle(string $filename): string
    {
        return file_get_contents(module_path('Zatca', "public/xml/{$filename}.xml"));
    
    }
}
