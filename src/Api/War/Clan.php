<?php


namespace ClashOfClans\Api\War;


use ClashOfClans\Api\AbstractResource;
use ClashOfClans\Api\Clan\Badge;
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
        'badgeUrls' => Badge::class
    ];

    /**
     * @return Badge|null
     */
    public function badge()
    {
        return $this->get('badgeUrls');
    }
}
