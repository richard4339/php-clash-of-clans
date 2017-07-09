<?php

namespace ClashOfClans\Api\Clan\War\Current;

use ClashOfClans\Api\AbstractResource;
use ClashOfClans\Api\Clan\URLContainer;
use ClashOfClans\Api\Clan\War\Current\Member\MemberList;
use JsonSerializable;

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
 * @property-read MemberList $members
 */
class WarClan extends AbstractResource implements JsonSerializable
{
    protected $casts = [
        'badgeUrls' => URLContainer::class,
        'members' => MemberList::class
    ];

    /**
     * Gets the number of members for this clan in this war
     *
     * @return int
     */
    public function memberCount()
    {
        if (!isset($this->data['members'])) {
            return 0;
        }

        return count($this->data['members']->data);
    }

    /**
     * Calls the overloaded get() method for numeric data types which will return 0 if null
     *
     * @param $name
     * @return array|mixed|null
     */
    public function __get($name)
    {
        switch ($name) {
            case 'clanLevel':
            case 'attacks':
            case 'stars':
            case 'destructionPercentage':
            case 'expEarned':
                return $this->get($name, 0);
                break;
            default:
                return parent::__get($name);
        }
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        $response = [
            'tag' => $this->tag,
            'name' => $this->name,
            'badgeUrls' => $this->badgeUrls,
            'clanLevel' => $this->clanLevel,
            'attacks' => $this->attacks,
            'stars' => $this->stars,
            'destructionPercentage' => $this->destructionPercentage,
            'expEarned' => $this->expEarned,
            'members' => $this->members->all(),
        ];

        return $response;
    }
}