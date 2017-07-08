<?php

namespace ClashOfClans\Api\Clan\War\Current\Member;

use ClashOfClans\Api\AbstractResource;
use ClashOfClans\Api\Clan\URLContainer;
use JsonSerializable;

/**
 * Class WarClanMember
 * @package ClashOfClans\Api\Clan\War\Current
 *
 * @property-read string $tag
 * @property-read string $name
 * @property-read int $townhallLevel
 * @property-read int $mapPosition
 * @property-read int $opponentAttacks
 * @property-read AttackList $attacks
 */
class Member extends AbstractResource implements JsonSerializable
{
    protected $casts = [
        'attacks' => AttackList::class
    ];

    /**
     * Calls the overloaded get() method for numeric data types which will return 0 if null
     *
     * @param $name
     * @return array|mixed|null
     */
    public function __get($name)
    {
        switch ($name) {
            case 'townhallLevel':
            case 'mapPosition':
            case 'opponentAttacks':
                return $this->get($name, 0);
                break;
            default:
                return parent::__get($name);
        }
    }

    /**
     * Gets the count of attacks made by this member
     *
     * @return int
     */
    public function attackCount()
    {
        if(!isset($this->data['attacks'])) {
            return 0;
        }

        return count($this->data['attacks']->data);
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        $response = [
            'tag' => $this->tag,
            'name' => $this->name,
            'townhallLevel' => $this->townhallLevel,
            'mapPosition' => $this->mapPosition,
            'opponentAttacks' => $this->opponentAttacks,
            'attacks' => [],
        ];

        if ($this->attackCount() > 0) {
            $response['attacks'] = $this->attacks->all();
        }

        return $response;
    }
}