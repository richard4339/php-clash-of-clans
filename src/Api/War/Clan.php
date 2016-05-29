<?php


namespace ClashOfClans\Api\War;


use ClashOfClans\Api\AbstractResource;
use ClashOfClans\Api\Location\Location;

/**
 * @method string name()
 * @method string tag()
 * @method string type()
 * @method Location location()
 * @method string warFrequency()
 * @method int clanLevel()
 * @method int warWins()
 * @method int clanPoints()
 * @method MemberList memberList()
 * @method WarLog warLog()
 * @method int rank()
 * @method int previousRank()
 */

class Clan extends AbstractResource
{

    protected $casts = [
        'warLog' => WarLog::class
    ];
}
