<?php

namespace App\Http\Controllers\Api;

use App\TenantSetting;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Response;

class TenantSettingsController extends BaseController
{

    public function getAllSettings(Request $request)
    {
       $result = TenantSetting::where('id', 1)->get();
        return $result[0];
    }

    public function setEnvTempScale(Request $request)
    {
            $settings = TenantSetting::find(1);
            $settings->temp_scale_value = $request->temp_scale_value;
            $settings->save();

            return 204;
    }

    public function getTimezone()
    {
        $collection = TenantSetting::select('timezone')->get();
        return $collection[0];
    }

    public function getTempScale()
    {
        $collection = TenantSetting::select('temp_scale_value')->get();
        return $collection[0];
    }

    public function listTimeZones()
    {
        return $this->generate_timezone_list();
    }

    private function generate_timezone_list()
    {
        static $regions = array(
            DateTimeZone::AFRICA,
            DateTimeZone::AMERICA,
            DateTimeZone::ANTARCTICA,
            DateTimeZone::ASIA,
            DateTimeZone::ATLANTIC,
            DateTimeZone::AUSTRALIA,
            DateTimeZone::EUROPE,
            DateTimeZone::INDIAN,
            DateTimeZone::PACIFIC,
        );

        $timezones = array();
        foreach ($regions as $region) {
            $timezones = array_merge($timezones, DateTimeZone::listIdentifiers($region));
        }

        $timezone_offsets = array();
        foreach ($timezones as $timezone) {
            $tz = new DateTimeZone($timezone);
            $timezone_offsets[$timezone] = $tz->getOffset(new DateTime);
        }

        // sort timezone by offset
        asort($timezone_offsets);

        $timezone_list = array();
        foreach ($timezone_offsets as $timezone => $offset) {
            $offset_prefix = $offset < 0 ? '-' : '+';
            $offset_formatted = gmdate('H.i', abs($offset));

            $pretty_offset = "UTC${offset_prefix}${offset_formatted}";

            $timezone_list[$timezone]['string'] = "(${pretty_offset}) $timezone";
            $timezone_list[$timezone]['offset_string'] = $pretty_offset;
            $timezone_list[$timezone]['offset'] = "${offset_prefix}${offset_formatted}";
        }
        ksort($timezone_list);
        return $timezone_list;
    }

    private function format_GMT_offset($offset)
    {
        $hours = intval($offset / 3600);
        $minutes = abs(intval($offset % 3600 / 60));
        return 'GMT' . ($offset ? sprintf('%+03d:%02d', $hours, $minutes) : '');
    }

    private function format_timezone_name($name)
    {
        $name = str_replace('/', ', ', $name);
        $name = str_replace('_', ' ', $name);
        $name = str_replace('St ', 'St. ', $name);
        return $name;
    }

    public function updateTimezone(Request $request)
    {
        try {
            $settings = TenantSetting::find(1);
            $settings->timezone = $request->timezone;
            $settings->timezone_offset = $request->offset;
            $settings->save();

            $output = array('success' => true,
                'data' => $settings,
                'msg' => 'Timezone updated successfully',
            );

            $responseArray = array('success' => 200);
            return Response::json($responseArray);

        } catch (\Exception $e) {
            $output = array('success' => false,
                'msg' => $e->getMessage(),
            );
        }
        return $output;
    }

}
