<?php

namespace DelamatreZend\Mvc\Controller;

use GeoIp2\WebService\Client;
use GeoIp2\Database\Reader;

trait GoogleAnalyticsIntegration{

    function getGoogleServiceAnalayticsProfileId($division=null){

        if(isset($this->getConfig()['google']['reports']['profile_id'][$division])){
            return $this->getConfig()['google']['reports']['profile_id'][$division];
        }else{
            return $this->getConfig()['google']['reports']['profile_id'][$this->getConfig()['google']['reports']['default_profile']];
        }

    }

    /**
     * @return \Google_Service_Analytics
     */
    function getGoogleServiceAnalytics()
    {

        // Create and configure a new client object.
        $client = new \Google_Client();
        $client->setApplicationName($this->getConfig()['myapp']['name']);
        $client->setAuthConfig($this->getConfig()['google']['reports']['json_key_file']);
        $client->setScopes(['https://www.googleapis.com/auth/analytics.readonly']);
        $analytics = new \Google_Service_Analytics($client);
        return $analytics;
    }

    function getFirstProfileId($analytics) {
        // Get the user's first view (profile) ID.

        // Get the list of accounts for the authorized user.
        $accounts = $analytics->management_accounts->listManagementAccounts();

        if (count($accounts->getItems()) > 0) {
            $items = $accounts->getItems();
            $firstAccountId = $items[0]->getId();

            // Get the list of properties for the authorized user.
            $properties = $analytics->management_webproperties
                ->listManagementWebproperties($firstAccountId);

            if (count($properties->getItems()) > 0) {
                $items = $properties->getItems();
                $firstPropertyId = $items[0]->getId();

                // Get the list of views (profiles) for the authorized user.
                $profiles = $analytics->management_profiles
                    ->listManagementProfiles($firstAccountId, $firstPropertyId);

                if (count($profiles->getItems()) > 0) {
                    $items = $profiles->getItems();

                    var_dump($profiles->getItems());

                    // Return the first view (profile) ID.
                    //return $items[0]->getId();

                } else {
                    throw new \Exception('No views (profiles) found for this user.');
                }
            } else {
                throw new \Exception('No properties found for this user.');
            }
        } else {
            throw new \Exception('No accounts found for this user.');
        }
    }

    function getResults($analytics, $profileId) {
        // Calls the Core Reporting API and queries for the number of sessions
        // for the last seven days.
        return $analytics->data_ga->get(
            'ga:' . $profileId,
            '7daysAgo',
            'today',
            'ga:sessions');
    }

}