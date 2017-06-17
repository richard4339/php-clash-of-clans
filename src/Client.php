<?php


namespace ClashOfClans;

use ClashOfClans\Api\Clan\Clan;
use ClashOfClans\Api\Clan\War\Current\CurrentWar;
use ClashOfClans\Api\Player\Player;
use ClashOfClans\Api\League\League;
use ClashOfClans\Api\Location\Location;
use ClashOfClans\Api\ResponseMediator;
use ClashOfClans\Api\War\War;
use GuzzleHttp\Client as GuzzleClient;

/**
 * Class Client
 * @package ClashOfClans
 */
class Client
{
    /**
     * @var
     */
    protected $httpClient;

    /**
     * @var
     */
    protected $token;

    /**
     * Client constructor.
     * @param $token
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
     */
    public function getClan($tag)
    {
        $response = $this->request('clans/' . urlencode($tag));

        return Clan::makeFromArray($response);
    }

    /**
     * @param string $tag
     * @return War[]
     */
    public function getWarLog($tag, $params = null) {

        $url = 'clans/' . urlencode($tag) . '/warlog?';

        if(!is_null($params)) {
            if(is_array($params)) {
                $url .= http_build_query($params);
            }
        }

        $response = $this->request($url);

        return array_map(function($item){
            return War::makeFromArray($item);
        }, $response['items']);
    }

    /**
     * Search for clans using parameters
     * @see Documentation at https://developer.clashofclans.com/
     *
     * @param $params
     * @return Clan[]
     */
    public function getClans($params)
    {
        $params = is_array($params) ? $params : ['name' => $params];

        $response = $this->request('clans?' . http_build_query($params));

        return array_map(function($item){
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
     */
    public function getCurrentWar($tag, $params = null) {

        $url = 'clans/' . urlencode($tag) . '/currentwar?';

        if(!is_null($params)) {
            if(is_array($params)) {
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
     */
    public function getLocation($id)
    {
        return Location::makeFromArray($this->request('locations/' . urlencode($id)));
    }

    /**
     * Get list of all locations
     *
     * @return Location[]
     */
    public function getLocations()
    {
        return array_map(function($item){
            return Location::makeFromArray($item);
        }, $this->request('locations')['items']);
    }

    /**
     * Get rankings for specific location
     * @param $locationId
     * @param $rankingId
     * @return array
     */
    public function getRankingsForLocation($locationId, $rankingId)
    {
        $url = 'locations/' . $locationId . '/rankings/' . $rankingId;

        if($rankingId == 'clans'){
            return array_map(function($item){
                return Clan::makeFromArray($item);
            }, $this->request($url)['items']);
        }

        return array_map(function($item){
            return Player::makeFromArray($item);
        }, $this->request($url)['items']);
    }

    /**
     * Get all available leagues
     *
     * @return array
     */
    public function getLeagues()
    {
        return array_map(function($item){
            return League::makeFromArray($item);
        }, $this->request('leagues')['items']);
    }

    /**
     * Get full details for a specific player
     *
     * @param string $tag
     * @return Player
     */
    public function getPlayer($tag)
    {
        $response = $this->request('players/' . urlencode($tag));

        return Player::makeFromArray($response);
    }

    /**
     * @param $url
     * @return array
     */
    protected function request($url)
    {
        $response = $this->getHttpClient()
                         ->request('GET', $url, ['headers' => ['authorization' => 'Bearer ' . $this->getToken()]]);

        return ResponseMediator::convertResponseToArray($response);
    }

    /**
     * @return GuzzleClient
     */
    public function getHttpClient()
    {
        if($this->httpClient === null)
        {
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
