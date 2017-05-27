<?php


namespace ClashOfClans\Api\Clan;


use ClashOfClans\Api\AbstractResource;
use ClashOfClans\Api\Location\Location;

/**
 * @method string name()
 * @method string tag()
 * @method string type()
 * @method Location location()
 * @method string warFrequency()
 * @method int clanLevel()
 * @method int clanPoints()
 * @method int requiredTrophies()
 * @method int warWins()
 * @method int warLosses()
 * @method int warTies()
 * @method int warWinStreak()
 * @method MemberList[] memberList()
 * @method int rank()
 * @method int previousRank()
 */

class Clan extends AbstractResource
{

    protected $casts = [
        'location' => Location::class,
        'badgeUrls' => URLContainer::class,
        'memberList' => MemberList::class
    ];

    /**
     * @return URLContainer|null
     */
    public function badge()
    {
        return $this->get('badgeUrls');
    }

    public function membersCount()
    {
        return $this->get('members');
    }

    public function warTotal()
    {
        return $this->get('warWins') + $this->get('warLosses') + $this->get('warTies');
    }
}
