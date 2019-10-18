<?php

class axi
{

    public $nascv;

    # structure by fport
    function rx_fport()
    {
        $struct = [];

        # fport 24
        $struct[ 24 ] = [

            #packet type
            [ 'packet_type' => 'status_packet' ],

            #main
            [ '_cnf' => [ 'repeat' => false ],
                'module_battery' => [ 'type' => 'uint8', 'unit' => 'index', 'formatter' => ':battery:3.6' ],
                'module_temp' => [ 'type' => 'uint8', 'unit' => '°C', 'formatter' => '%s%s' ],
                'downlink_rssi' => [ 'type' => 'uint8', 'unit' => 'dBm', 'converter' => '*-1' ],
                'state' => [ 'type' => 'byte', 'bits' =>
                    [ 'user_triggered_packet' => [ 'no', 'yes' ],
                        'error_triggered_packet' => [ 'no', 'yes' ],
                        'temperature_triggered_packet' => [ 'no', 'yes' ],
                    ] ],
                'accumulated_volume' => [ 'type' => 'int32', 'unit' => 'L' ],
                'meter_error' => [ 'type' => 'hex', 'length' => 4 ]
            ],
        ];

        $struct[ 24 ][ 'register_map' ] = [ '_cnf' => [ 'repeat' => false ],
            'register_map' => [ 'type' => 'byte', 'bits' =>
                [ 'accumulated_heat_energy' => [ 'not_sent', 'sent' ],
                    'accumulated_cooling_energy' => [ 'not_sent', 'sent' ],
                    'accumulated_pulse_1' => [ 'not_sent', 'sent' ],
                    'accumulated_pulse_2' => [ 'not_sent', 'sent' ],
                    'instant_flow_rate' => [ 'not_sent', 'sent' ],
                    'instant_power' => [ 'not_sent', 'sent' ],
                    'instant_temp_in' => [ 'not_sent', 'sent' ],
                    'instant_temp_out' => [ 'not_sent', 'sent' ]
                ] ],
            '' => [ 'type' => 'byte' ]
        ];

        $struct[ 24 ][ 'reported_registers' ] = [ '_cnf' => [ 'repeat' => false ],
            'accumulated_heat_energy' => [ 'type' => 'int32', 'unit' => 'kWh',
                'when' => [ [ 'register_map:accumulated_heat_energy' => 1 ] ] ],
            'accumulated_cooling_energy' => [ 'type' => 'int32', 'unit' => 'kWh',
                'when' => [ [ 'register_map:accumulated_cooling_energy' => 1 ] ] ],
            'accumulated_pulse_1' => [ 'type' => 'int32', 'unit' => 'L',
                'when' => [ [ 'register_map:accumulated_pulse_1' => 1 ] ] ],
            'accumulated_pulse_2' => [ 'type' => 'int32', 'unit' => 'L',
                'when' => [ [ 'register_map:accumulated_pulse_2' => 1 ] ] ],
            'instant_flow_rate' => [ 'type' => 'float', 'unit' => 'L/h', 'formatter' => '%.3f %s',
                'when' => [ [ 'register_map:instant_flow_rate' => 1 ] ] ],
            'instant_power' => [ 'type' => 'float', 'unit' => 'kW', 'formatter' => '%.3f %s',
                'when' => [ [ 'register_map:instant_power' => 1 ] ] ],
            'instant_temp_in' => [ 'type' => 'int16', 'unit' => '°C', 'converter' => '/100.0', 'formatter' => '%.2f%s',
                'when' => [ [ 'register_map:instant_temp_in' => 1 ] ] ],
            'instant_temp_out' => [ 'type' => 'int16', 'unit' => '°C', 'converter' => '/100.0', 'formatter' => '%.2f%s',
                'when' => [ [ 'register_map:instant_temp_out' => 1 ] ] ]
        ];


        # fport 25
        $struct[ 25 ] = [

            #packet type
            [ 'packet_type' => 'usage_packet' ],
            #main
            [ '_cnf' => [ 'repeat' => false ],
                'accumulated_volume' => [ 'type' => 'int32', 'unit' => 'L' ]
            ]
        ];

        $struct[ 25 ][ 'register_map' ] = $struct[ 24 ][ 'register_map' ];
        $struct[ 25 ][ 'reported_registers' ] = $struct[ 24 ][ 'reported_registers' ];


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
                'meter_id' => [ 'type' => 'hex', 'length' => 4 ],
                'meter_type' => [ 'type' => 'hex', 'formatter' => [
                    [ 'value' => '00', 'name' => 'water_meter' ],
                    [ 'value' => '01', 'name' => 'heat_meter' ]
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