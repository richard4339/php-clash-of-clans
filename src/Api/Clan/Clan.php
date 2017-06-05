<?php


namespace ClashOfClans\Api\Clan;


use ClashOfClans\Api\AbstractResource;
use ClashOfClans\Api\Location\Location;

/**
 * @method string name()
 * @method string tag()
 * @method string type()
 * @method string description()
 * @method Location location()
 * @method int clanLevel()
 * @method int clanPoints()
 * @method int clanVersusPoints()
 * @method int requiredTrophies()
 * @method string warFrequency()
 * @method int warWins()
 * @method int warWinStreak()
 * @method int warLosses()
 * @method int warTies()
 * @method boolean isWarLogPublic()
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

    /**
     * @return int|null
     */
    public function membersCount()
    {
        return $this->get('members');
    }

    /**
     * @return int|null
     */
    public function warTotal()
    {
        return $this->get('warWins') + $this->get('warLosses') + $this->get('warTies');
    }
}
