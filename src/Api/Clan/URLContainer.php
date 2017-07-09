<?php

namespace ClashOfClans\Api\Clan;

use ClashOfClans\Api\AbstractResource;
use JsonSerializable;

/**
 * @method string small()
 * @method string medium()
 * @method string large()
 */
class URLContainer extends AbstractResource implements JsonSerializable
{
    /**
     * @return array
     */
    public function jsonSerialize()
    {
        $response = [
            'small' => $this->small,
            'medium' => $this->medium,
            'large' => $this->large,
        ];

        return $response;
    }
}