<?php
require_once 'components/registers.php';

class gm1 extends registers
{

    public $nascv;
    
    public function capability_structure()
    {
        $base = $this->capability_base_structure;

        $upn = $this->nascv->product_upn;

        $base[ 'data' ] = array_merge( $base[ 'data' ], [
            'accumulated_volume' => [ 'available' => true ],
            'node_temperature' => [ 'available' => true ],
            'node_status' => [ 'available' => true ],
            'node_battery_voltage' => [ 'available' => true ],
            'node_battery_percentage' => [ 'available' => true ]
        ] );

        $base[ 'network' ] = array_merge( $base[ 'network' ], [
            'gateway_rssi_avg' => [ 'available' => true ],
            'gateway_snr_avg' => [ 'available' => true ],
            'gateway_rssi_last' => [ 'available' => true ],
            'gateway_snr_last' => [ 'available' => true ],
            'node_rssi_avg' => [ 'available' => true ],
            'node_snr_avg' => [ 'available' => true ],
        ] );

        $base[ 'configuration' ] = array_merge( $base[ 'configuration' ], [
            'radio_mode' => [ 'available' => true ],
            'fixed_metering_enabled' => [ 'available' => true ],
            'reporting_interval' => [ 'available' => true ],
            'customer_eic' => [ 'available' => true ],
            'location_eic' => [ 'available' => true ] ] );

        $base[ 'event' ] = array_merge( $base[ 'event' ], [
            'node_app_connected' => [ 'available' => false ],
            'node_magnet_triggered' => [ 'available' => true ],
            'tamper_alert' => [ 'available' => true ],
            'temperature_alert' => [ 'available' => true ],
            'battery_alert' => [ 'available' => true ]]);

        return $base;
    }
    # structure by fport
    function rx_fport()
    {
        $struct = [];

        # fport 25
        $struct[ 25 ] = [
            #packet type
            [ 'packet_type' => 'usage_packet' ],

            #header
            [ '_cnf' => [ 'repeat' => false ],
                'interface' => [ 'type' => 'hex' ]
            ]
        ];

        # gas
        $struct[ 25 ][ 'gas' ] = [ '_cnf' => [ 'repeat' => false, 'name' => 'gas', 'when' => [ [ 'interface' => '03' ] ] ],
            'settings' => [ 'type' => 'byte', 'bits' => [
                [ 'bit' => 0, 'parameter' => 'input_state', 'formatter' =>
                    [ false, true ] ],
                [ 'bit' => 1, 'parameter' => 'operational_mode', 'formatter' =>
                    [ 'counter', 'n/a' ] ],

                [ 'bit' => '4-7', 'parameter' => 'medium_type', 'type' => 'hex', 'formatter' => [
                    [ 'value' => '04', 'name' => '_gas' ],
                    [ 'value' => '?', 'name' => 'n/a' ] ] ],
            ] ],
            'counter' => [ 'type' => 'uint32', 'unit' => 'L' ],

        ];
        if ($this->nascv->firmware >= 0.8 && $this->nascv->firmware_patch >= 4) {
            $struct[ 25 ][ 'gas' ] = [ '_cnf' => [ 'repeat' => false, 'name' => 'gas', 'when' => [ [ 'interface' => '03' ] ] ],
                'settings' => [ 'type' => 'byte', 'bits' => [
                    [ 'bit' => 0, 'parameter' => 'input_state', 'formatter' =>
                        [ false, true ] ],
                    [ 'bit' => 1, 'parameter' => 'operational_mode', 'formatter' =>
                        [ 'counter', 'n/a' ] ],
                    [ 'bit' => 3, 'parameter' => 'device_serial_sent', 'formatter' =>
                        [ 'not_sent', 'sent' ] ],
                    [ 'bit' => '4-7', 'parameter' => 'medium_type', 'type' => 'hex', 'formatter' => [
                        [ 'value' => '04', 'name' => '_gas' ],
                        [ 'value' => '?', 'name' => 'n/a' ] ] ],
                ] ],
                'counter' => [ 'type' => 'uint32', 'unit' => 'L' ],
                'device_serial_set' => [ 'type' => 'uint32', 'when' => [ [ 'settings:device_serial_sent' => 1 ] ] ]
            ];
        }
        # tamper
        $struct[ 25 ][ 'tamper' ] = [ '_cnf' => [ 'repeat' => false, 'name' => 'tamper', 'when' => [ [ 'interface' => '03' ] ] ],
            'settings' => [ 'type' => 'byte', 'bits' => [
                [ 'bit' => 0, 'parameter' => 'input_state', 'formatter' =>
                    [ false, true ] ],
                [ 'bit' => 1, 'parameter' => 'operational_mode', 'formatter' =>
                    [ 'n/a', 'trigger_mode' ] ],
                [ 'bit' => 2, 'parameter' => 'is_alert', 'formatter' =>
                    [ 'no', 'yes' ] ],
                [ 'bit' => '4-7', 'parameter' => 'medium_type', 'type' => 'hex', 'formatter' => [
                    [ 'value' => '01', 'name' => 'events_' ],
                    [ 'value' => '?', 'name' => 'n/a' ] ] ],
            ] ],
            'counter' => [ 'type' => 'uint32', 'unit' => 'events' ]
        ];


        # fport 24
        $struct[ 24 ] = [

            #packet type
            [ 'packet_type' => 'status_packet' ],

            #main
            [ '_cnf' => [ 'repeat' => false ],
                'header' => [ 'type' => 'byte', 'bits' => [
                    [ 'bit' => '0-5', 'parameter' => 'interface', 'type' => 'hex', 'formatter' => [
                        [ 'value' => '03', 'name' => 'gas meter' ],
                        [ 'value' => '?', 'name' => 'strange packet' ],
                    ] ],
                    [ 'bit' => 6, 'parameter' => 'user_triggered_packet', 'formatter' => [ 'no', 'yes' ] ],
                    [ 'bit' => 7, 'parameter' => 'temperature_triggered_packet', 'formatter' => [ 'no', 'yes' ] ]
                ] ],
                'battery_index' => [ 'type' => 'uint8', 'unit' => 'index', 'formatter' => ':battery:3.6' ],
                'mcu_temp' => [ 'type' => 'int8', 'unit' => '°C', 'formatter' => '%s%s' ],
                'downlink_rssi' => [ 'type' => 'uint8', 'unit' => 'dBm', 'converter' => '*-1' ]
            ],

        ];


        if ($this->nascv->firmware >= 0.8) {
            $struct[ 24 ][ 1 ] =
                # reported_interfaces
                [ '_cnf' => [ 'repeat' => false ],
                    'header' => [ 'type' => 'byte', 'bits' => [
                        [ 'bit' => '0-5', 'parameter' => 'interface', 'type' => 'hex', 'formatter' => [
                            [ 'value' => '03', 'name' => 'gas meter' ],
                            [ 'value' => '?', 'name' => 'strange packet' ],
                        ] ],
                        [ 'bit' => 6, 'parameter' => 'user_triggered_packet', 'formatter' => [ 'no', 'yes' ] ],
                        [ 'bit' => 7, 'parameter' => 'active_alerts', 'formatter' => [ 'no', 'yes' ] ],
                    ] ],
                    'active_alerts' => [ 'type' => 'byte',
                        'when' => [ [ 'header:active_alerts' => 1 ] ], 'bits' => [
                            [ 'bit' => 0, 'parameter' => 'digital_interface_alert', 'formatter' => [ 'no', 'yes' ] ],
                            [ 'bit' => 1, 'parameter' => 'secondary_interface_alert', 'formatter' => [ 'no', 'yes' ] ],
                            [ 'bit' => 2, 'parameter' => 'temperature_alert', 'formatter' => [ 'no', 'yes' ] ]
                        ] ],
                    'battery_percentage' => [ 'type' => 'uint8', 'unit' => '%', 'formatter' => [
                        [ 'value' => '255', 'name' => 'not_available' ],
                        [ 'value' => '*', 'name' => '%.1f%s', 'converter' => '/2.54' ]
                    ] ],
                    'battery_index' => [ 'type' => 'uint8', 'formatter' => ':battery:3.6' ],
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
                    'downlink_rssi' => [ 'type' => 'uint8', 'unit' => 'dBm', 'converter' => '*-1' ]
                ];
        }
        if ($this->nascv->firmware >= 0.8 && $this->nascv->firmware_patch <= 2) {
            unset ( $struct[ 24 ][ 1 ][ 'battery_percentage' ] );
        }

        $struct[ 24 ][ 'digital_1' ] = [
            '_cnf' => [ 'when' => [ [ 'reported_interfaces' => '03' ] ], 'name' => 'counter' ],
            'state' => [ 'type' => 'byte', 'bits' => [
                [ 'bit' => 0, 'parameter' => 'input_state' ],
                [ 'bit' => 1, 'parameter' => 'operational_mode', 'formatter' => [ 'pulse_mode', 'trigger_mode' ] ],
                [ 'bit' => 2, 'parameter' => 'alert_state' ],
                [ 'bit' => '4-7', 'parameter' => 'medium_type', 'type' => 'hex', 'formatter' => [
                    [ 'value' => '01', 'name' => 'pulses' ],
                    [ 'value' => '02', 'name' => 'L_water' ],
                    [ 'value' => '03', 'name' => 'Wh_electricity' ],
                    [ 'value' => '04', 'name' => 'L_gas' ],
                    [ 'value' => '05', 'name' => 'Wh_heat' ],
                    [ 'value' => '0F', 'name' => 'other' ],
                    [ 'value' => '?', 'name' => 'n/a' ],
                ] ],
            ] ],
            'counter' => [ 'type' => 'uint32', 'unit' => '{state:medium_type}' ],

        ];

        if ($this->nascv->firmware >= 0.8 && $this->nascv->firmware_patch >= 4) {
            $struct[ 24 ][ 'digital_1' ] = [
                '_cnf' => [ 'when' => [ [ 'reported_interfaces' => '03' ] ], 'name' => 'counter' ],
                'state' => [ 'type' => 'byte', 'bits' => [
                    [ 'bit' => 0, 'parameter' => 'input_state' ],
                    [ 'bit' => 1, 'parameter' => 'operational_mode', 'formatter' => [ 'pulse_mode', 'trigger_mode' ] ],
                    [ 'bit' => 2, 'parameter' => 'alert_state' ],
                    [ 'bit' => 3, 'parameter' => 'device_serial_sent' ],
                    [ 'bit' => '4-7', 'parameter' => 'medium_type', 'type' => 'hex', 'formatter' => [
                        [ 'value' => '01', 'name' => 'pulses' ],
                        [ 'value' => '02', 'name' => 'L_water' ],
                        [ 'value' => '03', 'name' => 'Wh_electricity' ],
                        [ 'value' => '04', 'name' => 'L_gas' ],
                        [ 'value' => '05', 'name' => 'Wh_heat' ],
                        [ 'value' => '0F', 'name' => 'other' ],
                        [ 'value' => '?', 'name' => 'n/a' ],
                    ] ],
                ] ],
                'counter' => [ 'type' => 'uint32', 'unit' => '{state:medium_type}' ],
                'device_serial' => [ 'type' => 'uint32' ]
            ];
        }


        # gas
        $struct[ 24 ][ 'gas' ] = $struct[ 25 ][ 'gas' ];
        $struct[ 24 ][ 'gas' ][ '_cnf' ][ 'when' ] = [ [ 'header:interface' => '03' ] ];
        # tamper
        $struct[ 24 ][ 'tamper' ] = $struct[ 25 ][ 'tamper' ];
        $struct[ 24 ][ 'tamper' ][ '_cnf' ][ 'when' ] = [ [ 'header:interface' => '03' ] ];


        # fport 50
        $struct[ 50 ] = [

            #main
            [ '_cnf' => [ 'repeat' => false ],
                'packet_type' => [ 'type' => 'hex' ]
            ],

            [ '_cnf' => [ 'repeat' => false, 'when' => [ [ 'packet_type' => '00' ] ] ],
                'configured_parameters' => [ 'type' => 'byte', 'bits' => [
                    [ 'usage_interval' => [ 'not_configured', 'configured' ] ],
                    [ 'status_interval' => [ 'not_configured', 'configured' ] ],
                    [ 'usage_behaviour' => [ 'not_configured', 'configured' ] ],
                ] ],
                'usage_interval' => [ 'type' => 'uint16', 'unit' => 'minutes' ],
                'status_interval' => [ 'type' => 'uint16', 'unit' => 'minutes' ],
                'usage_behaviour' => [ 'type' => 'byte', 'bits' =>
                    [ 'only_when_fresh_data', 'always' ] ],
            ],

            [ '_cnf' => [ 'repeat' => false, 'when' => [ [ 'packet_type' => '02' ] ] ],
                'multiplier' => [ 'type' => 'byte', 'bits' =>
                    [ '10_L', '100_L', '1000_L' ] ],
            ],
            'true_reading' => [ 'type' => 'uint32', 'unit' => 'L', ] ];


        # fport 99
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
                ],
                'reset_reason' => [ 'type' => 'byte', 'bits' => [ 'RFU', 'watchdog_reset', 'soft_reset', 'RFU', 'magnet_wakeup', 'RFU', 'RFU', 'nfc_wakeup' ] ],
                'general_info' => [ 'type' => 'byte', 'bits' => [
                    [ 'bit' => '0-1', 'parameter' => 'battery_type', 'type' => 'decimal', 'formatter' => [
                        [ 'value' => '2', 'name' => '3V6' ] ] ],
                ] ],
                'hardware_config' => [ 'type' => 'hex', 'formatter' => [
                    [ 'value' => '00', 'name' => 'digital_only' ],
                    [ 'value' => '01', 'name' => 'digital_+_analog' ],
                    [ 'value' => '02', 'name' => 'digital_+_ssi' ],
                    [ 'value' => '03', 'name' => 'RFU' ],
                    [ 'value' => '04', 'name' => 'digital_+_mbus' ],
                    [ 'value' => '05', 'name' => 'bk-g_pulser' ]
                ] ]
            ],


            #shutdown_packet
            [ '_cnf' => [ 'repeat' => false, 'when' => [ [ 'packet_type' => 'shutdown_packet' ] ] ],
                'shutdown_reason' => [ 'type' => 'hex', 'formatter' => [
                    [ 'value' => '20', 'name' => 'hardware_error' ],
                    [ 'value' => '30', 'name' => 'lora_shutdown' ],
                    [ 'value' => '31', 'name' => 'magnet_shutdown' ],
                    [ 'value' => '32', 'name' => 'entering_dfu' ],
                ] ],
                [ '_struct' => $struct[ 24 ] ]
            ],

            #config_failed_packet
            [ '_cnf' => [ 'repeat' => false, 'when' => [ [ 'packet_type' => 'config_failed_packet' ] ] ],
                'from_fport' => [ 'type' => 'uint8' ],
                'parser_error_code' => [ 'type' => 'uint8', 'formatter' => [
                    [ 'value' => '0', 'name' => 'RFU' ],
                    [ 'value' => '1', 'name' => 'RFU' ],
                    [ 'value' => '2', 'name' => 'unknown_fport' ],
                    [ 'value' => '3', 'name' => 'packet_size_short' ],
                    [ 'value' => '4', 'name' => 'packet_size_long' ],
                    [ 'value' => '5', 'name' => 'value_error' ],
                    [ 'value' => '6', 'name' => 'mbus_parse_error' ],
                    [ 'value' => '7', 'name' => 'reserved_flag_set' ],
                    [ 'value' => '8', 'name' => 'invalid_flag_combination' ],
                    [ 'value' => '9', 'name' => 'unavailable_feature_request' ],
                    [ 'value' => '10', 'name' => 'unsupported_header' ],
                    [ 'value' => '11', 'name' => 'unavailable_hw_request' ],
                ] ]
            ]

        ];
        if ($this->nascv->firmware >= 1.0) {
            include 'components/ukw.php';
        }

        return $struct;
    }


    /**
     * @return array
     */
    public function tx_fport()
    {
        $tx = self::rx_fport();
        return $tx;
    }

}