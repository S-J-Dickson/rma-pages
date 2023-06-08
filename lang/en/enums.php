<?php

use App\Models\RMA\Type\BATTERY;
use App\Models\RMA\Type\INVERTER;
use App\Models\RMA\Type\PERIPHERAL;
use App\Models\RMA\Type\RMA_TYPE;

return [
    RMA_TYPE::class => [
        RMA_TYPE::BATTERY => 'Battery',
        RMA_TYPE::INVERTER => 'Inverter',
        RMA_TYPE::PERIPHERAL => 'Peripheral'
    ],

    BATTERY::class => [
        BATTERY::_2_6_KWH => '2.6kWh',
        BATTERY::_5_2_KWH => '5.2kWh',
        BATTERY::_9_2_KWH => '9.2kWh',
    ],

    INVERTER::class => [
        INVERTER::_3_KW_AC_COUPLED => '3kW AC Coupled',
        INVERTER::_3_6_KW_AC_COUPLED => '3.6kW AC Coupled',
        INVERTER::_5_KW_HYBRID => '5kW Hybrid',
    ],

    PERIPHERAL::class => [
        PERIPHERAL::CABLE => 'Cable',
        PERIPHERAL::SCREWS => 'Screws'
    ]
];
