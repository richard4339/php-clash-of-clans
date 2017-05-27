<?php

namespace ClashOfClans\Api\Clan\War\Current;

use ClashOfClans\Api\AbstractResource;
use ClashOfClans\Api\Clan\URLContainer;
use ClashOfClans\Api\Clan\War\Current\Member\MemberList;

/**
 * Class WarClan
 * @package ClashOfClans\Api\Clan\War\Current
 *
 * @property-read string $tag
 * @property-read string $name
 * @property-read URLContainer $badgeUrls
 * @property-read int $clanLevel
 * @property-read int $attacks
 * @property-read int $stars
 * @property-read float $destructionPercentage
 * @property-read int $expEarned
 * @property-read MemberList[] $members
 */
class WarClan extends AbstractResource
{
    protected $casts = [
        'badgeUrls' => URLContainer::class,
        'members' => MemberList::class
    ];
}