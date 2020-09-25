<?php

namespace App\Returns;

use SimpleXMLElement;

trait ReturnXml
{
    public function modeXml(array $student) 
    {
        $xml = new \SimpleXMLElement('<student/>');

        array_walk_recursive($student, function($value, $key) use ($xml) {
                $xml->addChild($key, $value);
        });

        return response($xml->asXML(), 200)
        ->header('Content-Type', 'application/xml');
    }
}