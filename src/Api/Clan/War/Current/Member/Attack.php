<?php

namespace ClashOfClans\Api\Clan\War\Current\Member;

use ClashOfClans\Api\AbstractResource;
use ClashOfClans\Api\Clan\URLContainer;
use JsonSerializable;

/**
 * Class Attack
 * @package ClashOfClans\Api\Clan\War\Current
 *
 * @property-read string $attackerTag
 * @property-read string $defenderTag
 * @property-read int $stars
 * @property-read float $destructionPercentage
 * @property-read int $order
 */
class Attack extends AbstractResource implements JsonSerializable
{
    /**
     * Calls the overloaded get() method for numeric data types which will return 0 if null
     *
     * @param $name
     * @return array|mixed|null
     */
    public function __get($name)
    {
        switch ($name) {
            case 'stars':
            case 'destructionPercentage':
            case 'order':
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
            'attackerTag' => $this->attackerTag,
            'defenderTag' => $this->defenderTag,
            'stars' => $this->stars,
            'destructionPercentage' => $this->destructionPercentage,
            'order' => $this->order,
        ];

        return $response;
    }
}