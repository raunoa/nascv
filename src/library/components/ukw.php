<?php




# fport 18
$struct[ 18 ] = [
    [ '_cnf' => [ 'repeat' => false ],
        'wmbus' => [ 'type' => 'hex', 'byte_order' => 'LSB', 'length' => '*',
            'ext' => [ 'php-mbus', [ 'type' => 'wmbus_frame_b' ] ],
            'metering' => [ [ 'tag' => 'accumulated_volume', 'path' => 'data_records:*:_header_raw=0413' ] ]
        ],
    ] ];

/**
 * FPORT 24
 */
 
 
$struct[ 24 ] = [

    #status packet type
    [ '_cnf' => [ 'repeat' => false, 'name' => 'packet_type', 'formatter' => '{packet_type:packet_type}' ],
        'packet_type' => [ 'type' => 'hex', 'formatter' => [
            [ 'value' => '01', 'name' => 'status_packet' ]
        ] ],
    ],

    [ '_cnf' => [ 'repeat' => false, 'when' => [ [ 'packet_type' => [ 'status_packet' ] ] ] ],
        'general' => [ 'type' => 'byte', 'bits' => [
            [ 'bit' => 1, 'parameter' => '_fixed_metering', 'formatter' => [ 'disabled', 'enabled' ],
                'metering' => [ 'tag' => 'fixed_metering_enabled' ] ],
            [ 'bit' => 4, 'parameter' => '_debug_info', 'formatter' => [ 'not_sent', 'sent' ] ],
            [ 'bit' => 5, 'parameter' => 'packet_reason_app', 'formatter' => [ 'false', 'true' ],
                'metering' => [ 'tag' => 'node_app_connected' ] ],
            [ 'bit' => 6, 'parameter' => 'packet_reason_magnet', 'formatter' => [ 'false', 'true' ],
                'metering' => [ 'tag' => 'node_magnet_triggered' ]],
            [ 'bit' => 7, 'parameter' => 'packet_reason_alert', 'formatter' => [ 'false', 'true' ] ],
            ]],
        'active_alerts' => [ 'type' => 'byte', 'bits' => [
            [ 'bit' => 0, 'parameter' => 'reverse_flow_detected', 'formatter' => [ 'false', 'true' ],
                'metering' => [ 'tag' => 'reverse_flow_alert' ] ],
            [ 'bit' => 1, 'parameter' => 'burst', 'formatter' => [ 'false', 'true' ],
                'metering' => [ 'tag' => 'burst_alert' ], 'disabled' => true ],
            [ 'bit' => 2, 'parameter' => 'leak', 'formatter' => [ 'false', 'true' ],
                'metering' => [ 'tag' => 'leak_alert' ] ],
            [ 'bit' => 3, 'parameter' => 'tamper', 'formatter' => [ 'false', 'true' ],
                'metering' => [ 'tag' => 'tamper_alert' ] ],
            [ 'bit' => 4, 'parameter' => 'temperature_alert', 'formatter' => [ 'false', 'true' ],
                'metering' => [ 'tag' => 'temperature_alert' ] ],
            [ 'bit' => 5, 'parameter' => 'battery', 'formatter' => [ 'false', 'true' ],
                'metering' => [ 'tag' => 'battery_alert' ] ],
        ] ],
        'battery_percentage' => [ 'type' => 'uint8', 'unit' => '%', 'formatter' => [
            [ 'value' => 255, 'name' => 'not_available' ],
            [ 'value' => '*', 'name' => '%.1f%s', 'converter' => '/2.54' ],
        ],'metering' => [ 'tag' => 'battery_percentage' ] ],
        'battery_voltage' => [ 'type' => 'uint8', 'formatter' => ':battery:3.6', 'metering' => [ 'tag' => 'battery_voltage' ] ],
        'mcu_temperature' => [ 'type' => 'int8', 'unit' => '°C', 'formatter' => '%s%s', 'metering' => [ 'tag' => 'board_temperature' ] ],
        'temp_extremes' => [ 'type' => 'byte', 'bits' => [
            [ 'bit' => '0-3',
                'parameter' => 'min_offset',
                'type' => 'decimal',
                'unit' => '°C',
                'formatter' => 'Math(({general:mcu_temperature}+{this})*-2)',
                
            ],
            [ 'bit' => '4-7',
                'parameter' => 'max_offset',
                'type' => 'decimal',
                'unit' => '°C',
                'formatter' => 'Math(({general:mcu_temperature}+{this})*2)',
            ],
        ] ],
        'downlink_rssi' => [ 'type' => 'uint8', 'unit' => 'dBm', 'converter' => '*-1', 'metering' => [ 'tag' => 'node_rx_rssi' ] ],
        'downlink_snr' => [ 'type' => 'int8', 'unit' => 'dB', 'metering' => [ 'tag' => 'node_rx_snr' ] ],

        'accumulated_volume' => [ 'type' => 'uint32', 'unit' => 'L', 'metering' => [ 'tag' => 'accumulated_volume' ] ],
        'metering_time' => [ 'type' => 'byte', 'when' => [ [ 'general:_fixed_metering' => 1 ] ],
            'bits' => [
                [ 'bit' => '0-4', 'parameter' => 'hour', 'type' => 'decimal', 'unit' => 'hrs from 00:00' ],
                [ 'bit' => 5, 'parameter' => 'fixed_metering_interval', 'formatter' => [ 'hourly', 'daily' ], 'metering' => [ 'tag' => 'accumulated_volume' ] ],
            ] ],
        [ '_cnf' => [ 'when' => [ [ 'general:_debug_info' => 1 ] ], 'repeat' => false, 'name' => 'calibration_delta' ],
            'ch_1' => [ 'type' => 'int8' ],
            'ch_2' => [ 'type' => 'int8' ],
            'ch_3' => [ 'type' => 'int8' ],
        ],


    ],
];


/**
 * FPORT 25
 */
$struct[ 25 ] = [

    #usage packet type
    [ '_cnf' => [ 'repeat' => false, 'name' => 'packet_type', 'formatter' => '{packet_type:packet_type}' ],
        'packet_type' => [ 'type' => 'hex', 'formatter' => [
            [ 'value' => '01', 'name' => 'usage_packet' ],
        ] ],
    ],

    [ '_cnf' => [ 'repeat' => false, 'when' => [ [ 'packet_type' => 'usage_packet' ] ] ],
        'general' => [ 'type' => 'byte', 'bits' => [
            [ 'bit' => 0, 'parameter' => '_fixed_metering', 'formatter' => [ 'disabled', 'enabled' ], 'metering' => [ 'tag' => 'fixed_metering_enabled' ] ],
            [ 'bit' => 1, 'parameter' => '_counters_previous', 'formatter' => [ 'not_sent', 'sent' ] ],
            [ 'bit' => 2, 'parameter' => 'usage_detected', 'formatter' => [ 'false', 'true' ] ],
            [ 'bit' => 4, 'parameter' => '_debug_info', 'formatter' => [ 'not_sent', 'sent' ] ],
        ] ],
        'metering_time' => [ 'when' => [ [ 'general:_fixed_metering' => 1 ] ] ],
        [ 'type' => 'byte', 'bits' =>
            [
                [ 'bit' => '0-4', 'parameter' => 'hour', 'type' => 'uint8', 'unit' => 'hrs from 00:00', 'formatter' => '/4' ],
                [ 'bit' => 5, 'parameter' => 'fixed_metering_interval', 'formatter' => [ 'hourly', 'daily' ],
                    'metering' => [ 'tag' => 'fixed_metering_interval' ] ],
            ]
        ],
        'counter' => [ 'type' => 'uint32', 'unit' => 'L', 'metering' => [ 'tag' => 'accumulated_volume', 'when' => [ [ 'general:_fixed_metering' => 0 ] ] ] ],
        'counter_prev_1' => [ 'when' => [ [ 'general:_counters_previous' => 1 ] ], 'type' => 'uint32', /* when >= 1*/
            'counter_prev_2' => [ 'when' => [ [ 'general:_counters_previous' => 1 ] ], 'type' => 'uint32' ], /* when >= 2*/
            [ '_cnf' => [ 'when' => [ [ 'general:_debug_info' => 1 ] ], 'repeat' => false, 'name' => 'calibration_delta' ],
                'ch_1' => [ 'type' => 'int8' ],
                'ch_2' => [ 'type' => 'int8' ],
                'ch_3' => [ 'type' => 'int8' ],
            ],
        ],
    ]
];


if ($this->nascv->firmware >= 1.0 && $this->nascv->firmware_patch <= 21) {
    unset ( $struct[ 25 ][ 1 ][ 5 ] ); //calibration_delta
}
if ($this->nascv->firmware >= 1.0 && $this->nascv->firmware_patch <= 21) {
    unset ( $struct[ 25 ][ 1 ][ 'general' ][ 'bits' ][ 3 ] );
}


/**
 * FPORT 50
 */
$struct[ 50 ] = [

    #configuration packet type
    [ '_cnf' => [ 'repeat' => false, 'name' => 'packet_type', 'formatter' => '{packet_type:packet_type}' ],
        'packet_type' => [ 'type' => 'hex', 'formatter' => [
            [ 'value' => '00', 'name' => 'reporting_config_packet' ],
            [ 'value' => '05', 'name' => 'metering_config_packet' ],
            [ 'value' => '06', 'name' => 'alert_config_packet' ],
            [ 'value' => '10', 'name' => 'meta_pos_config_packet' ],
            [ 'value' => '11', 'name' => 'meta_eic_config_packet' ],
        ] ],
    ],

    [ '_cnf' => [ 'repeat' => false, 'when' => [ [ 'packet_type' => 'reporting_config_packet' ] ] ],
        '_configured_parameters' => [ 'type' => 'byte', 'bits' => [
            'usage_interval' => [ 'not_configured', 'configured' ],
            'status_interval' => [ 'not_configured', 'configured' ],
            'behaviour' => [ 'not_configured', 'configured' ],
            'fixed_measuring_interval' => [ 'not_configured', 'configured' ],
        ] ],
        'usage_interval' => [ 'when' => [ [ '_configured_parameters:usage_interval' => 1 ] ], 'type' => 'int16', 'unit' => 'minutes',
            'metering' => [ 'tag' => 'usage_interval' ] ],
        'status_interval' => [ 'when' => [ [ '_configured_parameters:status_interval' => 1 ] ], 'type' => 'int16', 'unit' => 'minutes',
            'metering' => [ 'tag' => 'status_interval' ] ],
        'behaviour' => [ 'when' => [ [ '_configured_parameters:behaviour' => 1 ] ], 'type' => 'byte', 'bits' => [
            'send_usage' => [ 'only_when_new_data', 'always', 'metering' => [ 'tag' => 'usage_send_always' ] ],
            'include_previous_usage' => [ 'false', 'true' ]
        ],
        ],
        'fixed_measuring_interval' => [ 'when' => [ [ '_configured_parameters:fixed_measuring_interval' => 1 ] ], 'type' => 'byte', 'bits' => [
            [ 'bit' => '0-1', 'parameter' => 'interval', 'type' => 'hex', 'metering' => [ 'tag' => 'fixed_metering_interval' ], 'formatter' => [
                [ 'value' => '00', 'name' => 'off' ],
                [ 'value' => '01', 'name' => 'hourly' ],
                [ 'value' => '02', 'name' => 'daily' ],
                [ 'value' => '03', 'name' => 'rfu' ],

            ] ],
        ] ],
    ],

    [ '_cnf' => [ 'repeat' => false, 'when' => [ [ 'packet_type' => 'metering_config_packet' ] ] ],
        '_configured_parameters' => [ 'type' => 'byte', 'bits' => [
            'general_config' => [ 'not_configured', 'configured' ],
            'absolute_reading' => [ 'not_configured', 'configured' ],
            'offset' => [ 'not_configured', 'configured' ],
            'permanent_flow' => [ 'not_configured', 'configured' ],
            'meter_serial' => [ 'not_configured', 'configured' ],
        ] ],
        'general_config' => [ 'when' => [ [ '_configured_parameters:general_config' => 1 ] ], 'type' => 'byte', 'bits' => [
            [ 'bit' => '0-2', 'parameter' => 'metering_multiplier', 'type' => 'hex', 'metering' => [ 'tag' => 'metering_multiplier' ], 'formatter' => [
                [ 'value' => '00', 'name' => 'ignore' ],
                [ 'value' => '01', 'name' => '1_L' ],
                [ 'value' => '02', 'name' => '10_L' ],
                [ 'value' => '03', 'name' => '100_L' ],
                [ 'value' => '04', 'name' => '1000_L' ],
            ] ],
        ] ],
        'absolute_reading' => [ 'when' => [ [ '_configured_parameters:absolute_reading' => 1 ] ], 'type' => 'uint32', 'unit' => 'L' ],
        'offset' => [ 'when' => [ [ '_configured_parameters:offset' => 1 ] ], 'type' => 'int16', 'unit' => 'L' ],
        'permanent_flow' => [ 'when' => [ [ '_configured_parameters:permanent_flow' => 1 ] ], 'type' => 'uint16', 'unit' => 'm³/h', 'converter' => '/10',
            'metering' => [ 'tag' => 'nominal_flow' ] ],
        'meter_serial' => [ 'when' => [ [ '_configured_parameters:meter_serial' => 1 ] ], 'type' => 'hex', 'length' => 4,
            'metering' => [ 'tag' => 'meter_serial' ] ]
    ],


    [ '_cnf' => [ 'repeat' => false, 'when' => [ [ 'packet_type' => 'meta_pos_config_packet' ] ] ],
        '_configured_parameters' => [ 'type' => 'byte', 'bits' => [
            [ 'bit' => 0, 'parameter' => 'gps_position', 'formatter' => [ 'not_configured', 'configured' ] ],
            [ 'bit' => 1, 'parameter' => 'address', 'formatter' => [ 'not_configured', 'configured' ] ],
        ] ],
        'latitude' => [ 'when' => [ [ '_configured_parameters:gps_position' => 1 ] ], 'type' => 'int32', 'converter' => '/10000000',
            'metering' => [ 'tag' => 'location_latitude' ] ],
        'longitude' => [ 'when' => [ [ '_configured_parameters:gps_position' => 1 ] ], 'type' => 'int32', 'converter' => '/10000000',
            'metering' => [ 'tag' => 'location_longitude' ] ],
        'address_length' => [ 'when' => [ [ '_configured_parameters:address' => 1 ] ], 'type' => 'uint8', 'hidden' => true ],
        'address' => [ 'when' => [ [ '_configured_parameters:address' => 1 ] ], 'type' => "text", 'length' => [ 'address_length' ],
            'metering' => [ 'tag' => 'location_address' ] ],
    ],

    [ '_cnf' => [ 'repeat' => false, 'when' => [ [ 'packet_type' => 'meta_eic_config_packet' ] ] ],
        '_configured_parameters' => [ 'type' => 'byte', 'bits' => [
            [ 'bit' => 0, 'parameter' => 'eic_1', 'formatter' => [ 'not_sent', 'sent' ] ],
            [ 'bit' => 1, 'parameter' => 'eic_2', 'formatter' => [ 'not_sent', 'sent' ] ],
        ] ],
        'eic_1_len' => [ 'when' => [ [ '_configured_parameters:eic_1' => 1 ] ], 'type' => 'hex', 'hidden' => true ],
        'customer_eic' => [ 'when' => [ [ '_configured_parameters:eic_1' => 1 ] ], 'type' => 'text', 'length' => [ 'eic_1_len' ],
             'metering' => [ 'tag' =>'customer_eic' ] ],
        'eic_2_len' => [ 'when' => [ [ '_configured_parameters:eic_2' => 1 ] ], 'type' => 'hex', 'hidden' => true ],
        'location_eic' => [ 'when' => [ [ '_configured_parameters:eic_2' => 1 ] ], 'type' => 'text', 'length' => [ 'eic_2_len' ],
            'metering' => [ 'tag' => 'location_eic' ] ],
    ] ];


/**
 * FPORT 99
 */
$struct[ 99 ] = [

    #packet type
    [ '_cnf' => [ 'repeat' => false, 'name' => 'packet_type', 'formatter' => '{packet_type:packet_type}' ],
        'packet_type' => [ 'type' => 'hex', 'formatter' => [
            [ 'value' => '00', 'name' => 'boot_packet' ],
            [ 'value' => '01', 'name' => 'shutdown_packet' ],
            [ 'value' => '13', 'name' => 'config_failed_packet' ],
        ] ],
    ],

    #boot packet
    [ '_cnf' => [ 'repeat' => false, 'when' => [ [ 'packet_type' => 'boot_packet' ] ] ],
        'device_serial' => [ 'type' => 'hex', 'length' => 4 ],
        [ '_cnf' => [ 'repeat' => false, 'name' => 'firmware_version',
            'formatter' => '{firmware_version:major}.{firmware_version:minor}.{firmware_version:patch}' ],
            'major' => [ 'type' => 'uint8' ],
            'minor' => [ 'type' => 'uint8' ],
            'patch' => [ 'type' => 'uint8' ],
            'metering' => [ 'tag' => 'firmware_version' ]
        ],
        'reset_reason' => [ 'type' => 'byte', 'bits' => [ 'test', 'watchdog_reset', 'soft_reset', 'RFU', 'magnet_wakeup', 'RFU', 'RFU', 'nfc_wakeup' ] ],
        'general_info ' => [ 'type' => 'byte', 'bits' => [
            [ 'bit' => 7, 'parameter' => 'configuration_restored', 'formatter' => [ 'false', 'true' ] ],
        ] ],
        'hardware_config ' => [ 'type' => 'hex', 'metering' => [ 'tag' => 'module_name', 'type' => 'config' ], 'formatter' => [
            [ 'value' => '00', 'name' => 'Modularis' ],
            [ 'value' => '01', 'name' => 'Cyble' ],
            [ 'value' => '02', 'name' => 'Falcon' ],
            [ 'value' => '03', 'name' => 'Picoflux' ],
            [ 'value' => '04', 'name' => 'eSens' ],
            [ 'value' => '05', 'name' => 'AEM_Water_int' ],
            [ 'value' => '06', 'name' => 'AEM_Water_ext' ],
            [ 'value' => '20', 'name' => 'BK-G' ],
            [ 'value' => '21', 'name' => 'Rychem' ],
            [ 'value' => '22', 'name' => 'AEM_Gas' ],
            [ 'value' => 'ff', 'name' => 'N/A' ],
        ] ],
        'sensor_fw_version' => [ 'type' => 'uint16', 'formatter' => [
            [ 'value' => '0000', 'name' => 'not_available' ],
        ] ],
        'uptime' => [ 'type' => 'uint24', 'unit' => 'hours' ],
    ],


    #shutdown_packet
    [ '_cnf' => [ 'repeat' => false, 'when' => [ [ 'packet_type' => 'shutdown_packet' ] ] ],
        'shutdown_reason' => [ 'type' => 'hex', 'formatter' => [
            [ 'value' => '10', 'name' => 'calibration_timeout' ],
            [ 'value' => '20', 'name' => 'hardware_error' ],
            [ 'value' => '31', 'name' => 'magnet_shutdown' ],
            [ 'value' => '32', 'name' => 'entering_dfu' ],
            [ 'value' => '33', 'name' => 'app_shutdown' ],
            [ 'value' => '34', 'name' => 'switch_to_wmbus' ],
        ] ],
        //TODO FIND BETTER WAY TO ADD STATUS TO SHUTDOWN

        [ '_cnf' => [ 'repeat' => false, 'name' => 'secondary_packet_type', 'formatter' => '{packet_type:secondary_packet_type}' ],
            'secondary_packet_type' => [ 'type' => 'hex', 'formatter' => [
                [ 'value' => '01', 'name' => 'status_packet' ]
            ] ],
        ],
        'general' => [ 'type' => 'byte', 'bits' => [
            [ 'bit' => 1, 'parameter' => '_fixed_metering', 'formatter' => [ 'disabled', 'enabled' ] ],
            [ 'bit' => 4, 'parameter' => '_debug_info', 'formatter' => [ 'not_sent', 'sent' ] ],
            [ 'bit' => 5, 'parameter' => 'packet_reason_app', 'formatter' => [ 'false', 'true' ] ],
            [ 'bit' => 6, 'parameter' => 'packet_reason_magnet', 'formatter' => [ 'false', 'true' ] ],
            [ 'bit' => 7, 'parameter' => 'packet_reason_alert', 'formatter' => [ 'false', 'true' ] ],
        ] ],
        'active_alerts' => [ 'type' => 'byte', 'bits' => [
            [ 'bit' => 0, 'parameter' => 'reverse_flow_detected', 'formatter' => [ 'false', 'true' ] ],
            [ 'bit' => 1, 'parameter' => 'burst', 'formatter' => [ 'false', 'true' ] ],
            [ 'bit' => 2, 'parameter' => 'leak', 'formatter' => [ 'false', 'true' ] ],
            [ 'bit' => 3, 'parameter' => 'tamper', 'formatter' => [ 'false', 'true' ] ],
            [ 'bit' => 4, 'parameter' => 'temperature_alert', 'formatter' => [ 'false', 'true' ] ],
            [ 'bit' => 5, 'parameter' => 'battery', 'formatter' => [ 'false', 'true' ] ],
        ] ],
        'battery_percentage' => [ 'type' => 'uint8', 'unit' => '%', 'formatter' => [
            [ 'value' => '255', 'name' => 'not_available' ],
            [ 'value' => '*', 'name' => '%.1f%s', 'converter' => '/2.54' ]
        ] ],
        'battery_voltage' => [ 'type' => 'uint8', 'formatter' => ':battery:3.6' ],
        'mcu_temperature' => [ 'type' => 'int8', 'unit' => '°C', 'formatter' => '%s%s' ],
        'temp_extremes' => [ 'type' => 'byte', 'bits' => [
            [ 'bit' => '0-3',
                'parameter' => 'min_offset',
                'type' => 'decimal',
                'unit' => '°C',
                'formatter' => '%s%s',
                'converter' => '*-2'
            ],
            [ 'bit' => '4-7',
                'parameter' => 'max_offset',
                'type' => 'decimal',
                'unit' => '°C',
                'formatter' => '%s%s',
                'converter' => '*2' ],
        ] ],
        'downlink_rssi' => [ 'type' => 'uint8', 'unit' => 'dBm', 'converter' => '*-1' ],
        'downlink_snr' => [ 'type' => 'int8', 'unit' => 'dB' ],

        'instant_counter' => [ 'type' => 'uint32', 'unit' => 'L' ],
        'metering_time' => [ 'type' => 'byte', 'when' => [ [ 'general:_fixed_metering' => 1 ] ],
            'bits' => [
                [ 'bit' => '0-4', 'parameter' => 'hour', 'type' => 'decimal', 'unit' => 'hrs from 00:00' ],
                [ 'bit' => 5, 'parameter' => 'fixed_metering_interval', 'formatter' => [ 'hourly', 'daily' ] ],
            ] ],
        [ '_cnf' => [ 'when' => [ [ 'general:_debug_info' => 1 ] ], 'repeat' => false, 'name' => 'calibration_delta' ],
            'ch_1' => [ 'type' => 'int8' ],
            'ch_2' => [ 'type' => 'int8' ],
            'ch_3' => [ 'type' => 'int8' ],
        ],


    ],


    #calib
    [ '_cnf' => [ 'when' => [ [ 'packet_type' => 'config_failed_packet' ] ] ],
        'from_fport' => [ 'type' => 'uint8' ],
        'parser_error_code' => [ 'type' => 'uint8', 'metering' => [ 'tag' => 'node_rx_packet_parse_error' ], 'formatter' => [
            [ 'value' => '0', 'name' => 'RFU' ],
            [ 'value' => '1', 'name' => 'RFU' ],
            [ 'value' => '2', 'name' => 'unknown_fport' ],
            [ 'value' => '3', 'name' => 'packet_size_short' ],
            [ 'value' => '4', 'name' => 'packet_size_long' ],
            [ 'value' => '5', 'name' => 'value_error' ],
            [ 'value' => '6', 'name' => 'protocol_parse_error' ],
            [ 'value' => '7', 'name' => 'reserved_flag_set' ],
            [ 'value' => '8', 'name' => 'invalid_flag_combination' ],
            [ 'value' => '9', 'name' => 'unavailable_feature_request' ],
            [ 'value' => '10', 'name' => 'unsupported_header' ],
            [ 'value' => '11', 'name' => 'unavailable_hw_request' ],
            [ 'value' => '12', 'name' => 'address_not_available' ],
            [ 'value' => '13', 'name' => 'internal_error' ],
        ] ]
    ]
];

$struct[ 60 ] = [
    [ '_cnf' => [ 'repeat' => false, 'name' => 'packet_type', 'formatter' => '{packet_type:packet_type}' ],
        'packet_type' => [ 'type' => 'hex', 'formatter' => [
            [ 'value' => '00', 'name' => 'request_flow_counters' ],
            [ 'value' => '01', 'name' => 'request_historic_data' ],
            [ 'value' => '02', 'name' => 'request_calibration_data' ],
            [ 'value' => 'ff', 'name' => 'DFU' ],
        ] ],
    ],

    [ '_cnf' => [ 'repeat' => false, 'when' => [ [ 'packet_type' => 'request_calibration_data' ] ] ],
        'sensor_type' => [ 'type' => 'uint8', 'formatter' => [
            [ 'value' => '0', 'name' => 'not_available' ],
            [ 'value' => '1', 'name' => 'inductive_sensor' ],
        ] ],
        'fw_version' => [ 'type' => 'uint16' ],
        [ '_cnf' => [ 'repeat' => false, 'name' => 'afe_1_min' ],
            'ch_1' => [ 'type' => 'uint16' ],
            'ch_2' => [ 'type' => 'uint16' ],
            'ch_3' => [ 'type' => 'uint16' ],
        ],
        [ '_cnf' => [ 'repeat' => false, 'name' => 'afe_1_max' ],
            'ch_1' => [ 'type' => 'uint16' ],
            'ch_2' => [ 'type' => 'uint16' ],
            'ch_3' => [ 'type' => 'uint16' ],
        ],
        [ '_cnf' => [ 'repeat' => false, 'name' => 'afe_2_min' ],
            'ch_1' => [ 'type' => 'uint16' ],
            'ch_2' => [ 'type' => 'uint16' ],
            'ch_3' => [ 'type' => 'uint16' ],
        ],
        [ '_cnf' => [ 'repeat' => false, 'name' => 'afe_2_max' ],
            'ch_1' => [ 'type' => 'uint16' ],
            'ch_2' => [ 'type' => 'uint16' ],
            'ch_3' => [ 'type' => 'uint16' ],
        ],
        [ '_cnf' => [ 'repeat' => false, 'name' => 'recalib_delta' ],
            'ch_1' => [ 'type' => 'int8' ],
            'ch_2' => [ 'type' => 'int8' ],
            'ch_3' => [ 'type' => 'int8' ],
        ],
        [ '_cnf' => [ 'repeat' => false, 'name' => 'initial_noise' ],
            'ch_1' => [ 'type' => 'uint8' ],
            'ch_2' => [ 'type' => 'uint8' ],
            'ch_3' => [ 'type' => 'uint8' ],
        ],
        'communication_error_count' => [ 'type' => 'uint16' ]
    ],

];