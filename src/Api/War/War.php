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

    /**
     * Helper method which gets all of the possible values
     * @return array
     */
    public function getAllValues() {
        return array('result' => $this->result(),
            'endTime' => $this->formattedEndTime(),
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

    /**
     * Formats the ending time using the supplied format
     *
     * @internal The Clash of Clans API returns their date in a format not directly parseable by PHP. This function makes the date parseable by PHP
     *
     * @param string $format
     * @return bool|string
     */
    public function formattedEndTime($format = DATE_ATOM) {
        $a = str_split($this->endTime());

        array_splice($a, 4, 0, '-');
        array_splice($a, 7, 0, '-');
        array_splice($a, 13, 0, ':');
        array_splice($a, 16, 0, ':');

        return date($format, strtotime(implode("", $a)));
    }


}