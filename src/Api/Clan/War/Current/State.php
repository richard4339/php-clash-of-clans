<?php

namespace ClashOfClans\Api\Clan\War\Current;

/**
 * Class State
 *
 * Contains enum/constants for known war states
 *
 * @package ClashOfClans\Api\Clan\War\Current
 */
class State
{
    public const PREPARATION = 'preparation';
    public const INWAR = 'inWar';
    public const WARENDED = 'warEnded';
    public const NOTINWAR = 'notInWar';
}