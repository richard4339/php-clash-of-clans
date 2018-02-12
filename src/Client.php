<?php

namespace ClashOfClans;

use ClashOfClans\Api\Clan\Clan;
use ClashOfClans\Api\Clan\War\Current\CurrentWar;
use ClashOfClans\Api\Exception\BadTokenException;
use ClashOfClans\Api\Player\Player;
use ClashOfClans\Api\League\League;
use ClashOfClans\Api\Location\Location;
use ClashOfClans\Api\ResponseMediator;
use ClashOfClans\Api\War\War;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\RequestException;

/**
 * Class Client
 * @package ClashOfClans
 */
class Client
{
    /**
     * @var GuzzleClient
     */
    protected $httpClient;

    /**
     * @var string
     */
    protected $token;

    /**
     * Client constructor.
     * @param string $token
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get full details for specific clan
     *
     * @param string $tag
     * @return Clan
     *
     * @throws BadTokenException
     * @throws RequestException
     */
    public function getClan($tag)
    {
        $response = $this->request('clans/' . urlencode($tag));

        return Clan::makeFromArray($response);
    }

    /**
     * @param string $tag
     * @return War[]
     *
     * @throws BadTokenException
     * @throws RequestException
     */
    public function getWarLog($tag, $params = null)
    {

        $url = 'clans/' . urlencode($tag) . '/warlog?';

        if (!is_null($params)) {
            if (is_array($params)) {
                $url .= http_build_query($params);
            }
        }

        $response = $this->request($url);

        return array_map(function ($item) {
            return War::makeFromArray($item);
        }, $response['items']);
    }

    /**
     * Search for clans using parameters
     * @see Documentation at https://developer.clashofclans.com/
     *
     * @param array $params
     * @return Clan[]
     *
     * @throws BadTokenException
     * @throws RequestException
     */
    public function getClans($params)
    {
        $params = is_array($params) ? $params : ['name' => $params];

        $response = $this->request('clans?' . http_build_query($params));

        return array_map(function ($item) {
            return Clan::makeFromArray($item);
        }, $response['items']);
    }

    /**
     * Get current war
     * @see Documentation at https://developer.clashofclans.com/
     *
     * @param string $tag
     * @param mixed $params
     * @return CurrentWar
     *
     * @throws BadTokenException
     * @throws RequestException
     */
    public function getCurrentWar($tag, $params = null)
    {

        $url = 'clans/' . urlencode($tag) . '/currentwar?';

        if (!is_null($params)) {
            if (is_array($params)) {
                $url .= http_build_query($params);
            }
        }

        $response = $this->request($url);

        return CurrentWar::makeFromArray($response);
    }

    /**
     * Get details for specific location
     * @param $id
     * @return Location
     *
     * @throws BadTokenException
     * @throws RequestException
     */
    public function getLocation($id)
    {
        return Location::makeFromArray($this->request('locations/' . urlencode($id)));
    }

    /**
     * Get list of all locations
     *
     * @return Location[]
     *
     * @throws BadTokenException
     * @throws RequestException
     */
    public function getLocations()
    {
        return array_map(function ($item) {
            return Location::makeFromArray($item);
        }, $this->request('locations')['items']);
    }

    /**
     * Get rankings for specific location
     * @param $locationId
     * @param $rankingId
     * @return array
     *
     * @throws BadTokenException
     * @throws RequestException
     */
    public function getRankingsForLocation($locationId, $rankingId)
    {
        $url = 'locations/' . $locationId . '/rankings/' . $rankingId;

        if ($rankingId == 'clans') {
            return array_map(function ($item) {
                return Clan::makeFromArray($item);
            }, $this->request($url)['items']);
        }

        return array_map(function ($item) {
            return Player::makeFromArray($item);
        }, $this->request($url)['items']);
    }

    /**
     * Get all available leagues
     *
     * @return array
     *
     * @throws BadTokenException
     * @throws RequestException
     */
    public function getLeagues()
    {
        return array_map(function ($item) {
            return League::makeFromArray($item);
        }, $this->request('leagues')['items']);
    }

    /**
     * Get full details for a specific player
     *
     * @param string $tag
     * @return Player
     *
     * @throws BadTokenException
     * @throws RequestException
     */
    public function getPlayer($tag)
    {
        $response = $this->request('players/' . urlencode($tag));

        return Player::makeFromArray($response);
    }

    /**
     * @param $url
     * @return mixed
     *
     * @throws BadTokenException
     * @throws RequestException
     */
    protected function request($url)
    {
        try {
            $response = $this->getHttpClient()
                ->request('GET', $url, ['headers' => ['authorization' => 'Bearer ' . $this->getToken()]]);
        } catch (RequestException $x) {
            switch ($x->getCode()) {
                case 403:
                    throw new BadTokenException();
                    break;
                default:
                    throw $x;
                    break;
            }
        }

        return ResponseMediator::convertResponseToArray($response);
    }

    /**
     * @return GuzzleClient
     */
    public function getHttpClient()
    {
        if ($this->httpClient === null) {
            $this->httpClient = new GuzzleClient(['base_uri' => 'https://api.clashofclans.com/v1/']);
        }

        return $this->httpClient;
    }

    /**
     * @param GuzzleClient $client
     * @return Client
     */
    public function setHttpClient(GuzzleClient $client)
    {
        $this->httpClient = $client;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getToken()
    {
        return $this->token;
    }

}
