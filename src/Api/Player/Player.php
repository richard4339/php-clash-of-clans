<?php


namespace ClashOfClans\Api\Player;


use ClashOfClans\Api\AbstractResource;
use ClashOfClans\Api\League\League;
use ClashOfClans\Api\Clan\Clan;

/**
 * @method string tag()
 * @method string name()
 * @method int townHallLevel()
 * @method int expLevel()
 * @method int trophies()
 * @method int bestTrophies()
 * @method int warStars()
 * @method int attackWins()
 * @method int defenseWins()
 * @method int builderHallLevel()
 * @method int versusTrophies()
 * @method int bestVersusTrophies()
 * @method int versusBattleWins()
 * @method int versusBattleWinCount()
 * @method string role()
 * @method int donations()
 * @method int donationsReceived()
 * @method int previousClanRank()
 *
 * @method Clan clan()
 * @method League league()
 * @method Achievements[] achievements()
 * @method Troops[] troops()
 * @method Heroes[] heroes()
 * @method Spells[] spells()
 */
class Player extends AbstractResource
{
    protected $casts = [
        'league' => League::class,
        'clan' => Clan::class,
        'achievements' => Achievements::class,
        'troops' => Troops::class,
        'heroes' => Heroes::class,
        'spells' => Spells::class
    ];

    public function isLeader()
    {
        return $this->role() === 'leader';
    }

    public function isCoLeader()
    {
        return $this->role() === 'coLeader';
    }

    public function isElder()
    {
        return $this->role() === 'admin';
    }
}
