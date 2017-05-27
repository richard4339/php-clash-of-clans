<?php

namespace ClashOfClans\Api\Clan\War\Current\Member;

use ClashOfClans\Api\AbstractResource;
use ClashOfClans\Api\Clan\URLContainer;

/**
 * Class WarClanMember
 * @package ClashOfClans\Api\Clan\War\Current
 *
 * @property-read string $tag
 * @property-read string $name
 * @property-read int $townhallLevel
 * @property-read int $mapPosition
 * @property-read int $opponentAttacks
 * @property-read Attack[] $attacks
 */
class Member extends AbstractResource
{
    protected $casts = [
        'attacks' => Attack::class
    ];
}