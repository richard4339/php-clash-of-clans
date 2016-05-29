<?php


namespace ClashOfClans\Api\War;


use ClashOfClans\Api\AbstractResource;

/**
 * @method string result()
 * @method string endTime()
 * @method int teamSize()
 * @method Clan clan()
 * @method Clan opponent()
 */
class War extends AbstractResource
{
    protected $casts = [
        'opponent' => Clan::class,
        'clan' => Clan::class
    ];
    
    public function getAllValues() {
        return array('result' => $this->result(),
            'endTime' => $this->endTime(),
            'teamSize' => $this->teamSize(),
            'clanName' => $this->clan()->name(),
            'clanTag' => $this->clan()->tag(),
            'clanLevel' => $this->clan()->clanLevel(),
            'clanAttacks' => $this->clan()->attacks(),
            'clanStars' => $this->clan()->stars(),
            'clanDestructionPercentage' => $this->clan()->destructionPercentage(),
            'clanExpEarned' => $this->clan()->expEarned(),
            'clanBadgeSmall' => $this->clan()->badge()->small(),
            'clanBadgeMedium' => $this->clan()->badge()->medium(),
            'clanBadgeLarge' => $this->clan()->badge()->large(),
            'opponentName' => $this->opponent()->name(),
            'opponentTag' => $this->opponent()->tag(),
            'opponentLevel' => $this->opponent()->clanLevel(),
            'opponentStars' => $this->opponent()->stars(),
            'opponentDestructionPercentage' => $this->opponent()->destructionPercentage(),
            'opponentBadgeSmall' => $this->opponent()->badge()->small(),
            'opponentBadgeMedium' => $this->opponent()->badge()->medium(),
            'opponentBadgeLarge' => $this->opponent()->badge()->large()
            );
    }
}