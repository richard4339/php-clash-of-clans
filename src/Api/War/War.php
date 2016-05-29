<?php


namespace ClashOfClans\Api\War;


use ClashOfClans\Api\AbstractResource;

class War extends AbstractResource
{
    protected $casts = [
        'opponent' => Clan::class,
        'clan' => Clan::class
    ];
}
