<?php namespace App\Services;

use App\GreenhouseSection;
use App\Interfaces\GreenhouseSectionServiceInterface;

class GreenhouseSectionService implements GreenhouseSectionServiceInterface
{
    public function getAvailableSections($greenhouseId)
    {
        $greenhouseSections = GreenhouseSection::where('greenhouse_id', $greenhouseId)->get();

        if (!$greenhouseSections) {
            return [];
        }

        return $greenhouseSections;
    }
}
