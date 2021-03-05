<?php

namespace XD\Basic\Services;

use Geocoder\Query\GeocodeQuery;
use GuzzleHttp\Client as GuzzleClient;
use Http\Adapter\Guzzle6\Client as HttpClient;
use Swis\Geocoder\NationaalGeoregister\NationaalGeoregister;
use Symbiote\Addressable\GeocodeServiceException;
use Symbiote\Addressable\GeocodeServiceInterface;

class NationaalGeoregisterService implements GeocodeServiceInterface
{
    /**
     * Get the coordinates from the dutch Nationaal Georegister
     *
     * @param string $address
     * @param string $region
     *
     * @return array
     * @throws GeocodeServiceException
     */
    public function addressToPoint($address, $region = '')
    {
        try {
            $guzzle = new GuzzleClient([
                'timeout' => 2.0,
                'verify' => false,
            ]);
            $client = new HttpClient($guzzle);
            $geocoder = new NationaalGeoregister($client);
            $query = GeocodeQuery::create($address);
            $result = $geocoder->geocodeQuery($query);

            if ($result->isEmpty()) {
                throw new GeocodeServiceException('No result found', 0, null);
            }

            $location = $result->first()->getCoordinates();
            return [
                'lat' => (float)$location->getLatitude(),
                'lng' => (float)$location->getLongitude()
            ];
        } catch(Exception $e){
            return null;
        }
    }
}
