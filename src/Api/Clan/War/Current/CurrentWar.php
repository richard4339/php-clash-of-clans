<?php

namespace ClashOfClans\Api\Clan\War\Current;

use ClashOfClans\Api\AbstractResource;

/**
 * Class CurrentWar
 * @package ClashOfClans\Api\Clan\War\Current
 *
 * @property-read string $state Known values include preparation, inWar
 * @property-read int $teamSize
 * @property-read string $preparationStartTime
 * @property-read string $startTime
 * @property-read string $endTime
 * @property-read WarClan $clan
 * @property-read WarClan $opponent
 */
class CurrentWar extends AbstractResource
{
    protected $casts = [
        'clan' => WarClan::class,
        'opponent' => WarClan::class
    ];

    /**
     * Formats the ending time using the supplied format
     *
     * @internal The Clash of Clans API returns their date in a format not directly parseable by PHP. This function makes the date parseable by PHP
     *
     * @param string $format
     * @return bool|string
     */
    public function formattedEndTime($format = DATE_ATOM) {
        return self::formatTime($this->endTime, $format);
    }

    /**
     * Formats the prep start time using the supplied format
     *
     * @internal The Clash of Clans API returns their date in a format not directly parseable by PHP. This function makes the date parseable by PHP
     *
     * @param string $format
     * @return bool|string
     */
    public function formattedPreparationStartTime($format = DATE_ATOM) {
        return self::formatTime($this->preparationStartTime, $format);
    }

    /**
     * Formats the start time using the supplied format
     *
     * @internal The Clash of Clans API returns their date in a format not directly parseable by PHP. This function makes the date parseable by PHP
     *
     * @param string $format
     * @return bool|string
     */
    public function formattedStartTime($format = DATE_ATOM) {
        return self::formatTime($this->startTime, $format);
    }

}