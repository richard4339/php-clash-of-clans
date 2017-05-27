<?php


namespace ClashOfClans\Api\War;


use ClashOfClans\Api\AbstractResource;
use ClashOfClans\Api\Clan\URLContainer;
use ClashOfClans\Api\Location\Location;

/**
 * @method string name()
 * @method string tag()
 * @method int clanLevel()
 * @method int attacks()
 * @method int stars()
 * @method float destructionPercentage()
 * @method int expEarned()
 */

class Clan extends AbstractResource
{

    protected $casts = [
        'badgeUrls' => URLContainer::class
    ];

    /**
     * @return URLContainer|null
     */
    public function badge()
    {
        return $this->get('badgeUrls');
    }
}
