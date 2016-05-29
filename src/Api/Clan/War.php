<?php


namespace ClashOfClans\Api\Clan;


use ClashOfClans\Api\AbstractResource;
use ClashOfClans\Api\League\League;

class War extends AbstractResource
{
    protected $casts = [
        'opponent' => Clan::class,
        'clan' => Clan::class
    ];
}
