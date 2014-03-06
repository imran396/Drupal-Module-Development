<?php
class GoogleAnalyticsHelper
{
    public static function getAccounts(Google_AnalyticsService $service)
    {
        $response = $props = $service->management_webproperties->listManagementWebproperties("~all");
        $result = array();
        if (is_array($response) && !empty($response['items'])) {
            foreach ($response['items'] as $item) {
                $row = array(
                    'name' => $item['name'],
                    'id' => $item['id'],
                    'accountId' => $item['accountId'],
                );
                $result[] = $row;
            }
        }

        return $result;
    }

    public static function getProfile($accountId, Google_AnalyticsService $service)
    {
        $response = $service->management_profiles->listManagementProfiles($accountId, '~all');
        $result = array();
        if (is_array($response) && !empty($response['items'])) {
            foreach ($response['items'] as $item) {
                $row = array(
                    'name' => $item['name'],
                    'id' => $item['id'],
                );
                $result[] = $row;
            }
        }

        return $result;
    }

    public static function getCountryStats($tableId, Google_AnalyticsService $service)
    {
        $optParams = array(
            'dimensions'  => 'ga:country',
            'sort'        => '-ga:visits',
            //'filters' => 'ga:medium==organic',
            'max-results' => '25'
        );
        $response  = $service->data_ga->get(
            urldecode("ga:" . $tableId),
            '2012-01-01',
            date("Y-m-d"),
            'ga:visits',
            $optParams
        );

        return $response;
    }

    public static function formatResult($response)
    {
        $result = array();
        if (is_array($response) && !empty($response['items'])) {
            foreach ($response['items'] as $item) {
                $row = array(
                    'name' => $item['name'],
                    'id' => $item['id'],
                    'accountId' => $item['accountId'],
                );
                $result[] = $row;
            }
        }

        return $result;
    }
}