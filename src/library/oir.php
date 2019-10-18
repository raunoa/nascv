<?php

class oir
{

    public $nascv;

    private $ssi_unit_library = [
        1 => [ 'bar', '°C', 'n/a', 'n/a' ], // index = 1 then channel 1 -> bar, channel 2 -> °C etc
        2 => [ 'n/a', 'n/a', 'n/a', 'n/a' ], // index = 2 then ...
    ];

    /**
     * @return array
     */
    function rx_fport()
    {
        $struct = [];


        /**
         *
         * FPORT 24 (status_packet)
         *
         */

        $struct[ 24 ] = [

            #packet type
            [ 'packet_type' => 'status_packet' ]
        ];

        $struct[ 24 ][ 'reported_interfaces' ] = [
            # reported_interfaces
            [ '_cnf' => [ 'repeat' => false ],
                'reported_interfaces' => [ 'type' => 'byte', 'bits' => [
                    [ 'bit' => 0, 'parameter' => 'digital_1', 'formatter' => [ 'not_sent', 'sent' ] ],
                    [ 'bit' => 1, 'parameter' => 'digital_2', 'formatter' => [ 'not_sent', 'sent' ] ],
                    [ 'bit' => 2, 'parameter' => 'analog_1', 'formatter' => [ 'not_sent', 'sent' ] ],
                    [ 'bit' => 3, 'parameter' => 'analog_2', 'formatter' => [ 'not_sent', 'sent' ] ],
                    [ 'bit' => 4, 'parameter' => 'ssi', 'formatter' => [ 'not_sent', 'sent' ] ],
                    [ 'bit' => 5, 'parameter' => 'mbus', 'formatter' => [ 'not_sent', 'sent' ] ],
                    [ 'bit' => 6, 'parameter' => 'user_triggered_packet', 'formatter' => [ 'no', 'yes' ] ],
                    [ 'bit' => 7, 'parameter' => 'temperature_triggered_packet', 'formatter' => [ 'no', 'yes' ] ],
                ] ],
            ] ];

        /** FIRMWARE 0.8 new lines */
        if ($this->nascv->firmware >= 0.8) {
            $struct[ 24 ][ 'reported_interfaces' ] =
                # reported_interfaces
                [ '_cnf' => [ 'repeat' => false ],
                    'reported_interfaces' => [ 'type' => 'byte', 'bits' => [
                        [ 'bit' => 0, 'parameter' => 'digital_1', 'formatter' => [ 'not_sent', 'sent' ] ],
                        [ 'bit' => 1, 'parameter' => 'digital_2', 'formatter' => [ 'not_sent', 'sent' ] ],
                        [ 'bit' => 2, 'parameter' => 'analog_1', 'formatter' => [ 'not_sent', 'sent' ] ],
                        [ 'bit' => 3, 'parameter' => 'analog_2', 'formatter' => [ 'not_sent', 'sent' ] ],
                        [ 'bit' => 4, 'parameter' => 'ssi', 'formatter' => [ 'not_sent', 'sent' ] ],
                        [ 'bit' => 5, 'parameter' => 'mbus', 'formatter' => [ 'not_sent', 'sent' ] ],
                        [ 'bit' => 6, 'parameter' => 'user_triggered_packet', 'formatter' => [ 'no', 'yes' ] ],
                        [ 'bit' => 7, 'parameter' => 'active_alerts', 'formatter' => [ 'no', 'yes' ] ],
                    ] ]
                ];
        }

        if ($this->nascv->firmware >= 0.8) {
            $struct[ 24 ][ 'active_alerts' ] =
                # active_alerts
                [ '_cnf' => [ 'repeat' => false ],
                    'active_alerts' => [ 'type' => 'byte',
                        'when' => [ [ 'reported_interfaces:active_alerts' => 1 ] ], 'bits' => [
                            [ 'bit' => 0, 'parameter' => 'digital_interface_alert', 'formatter' => [ 'no', 'yes' ] ],
                            [ 'bit' => 1, 'parameter' => 'secondary_interface_alert', 'formatter' => [ 'no', 'yes' ] ],
                            [ 'bit' => 2, 'parameter' => 'temperature_alert', 'formatter' => [ 'no', 'yes' ] ]
                        ] ]
                ];
        }
        $struct[ 24 ][ 'battery' ] = [
            # battery
            [ '_cnf' => [ 'repeat' => false ],
                'battery' => [ 'type' => 'uint8', 'formatter' => ':battery:3.6' ]
            ] ];


        if ($this->nascv->firmware >= 0.8) {
            $struct[ 24 ][ 'battery' ] =
                # battery
                [ '_cnf' => [ 'repeat' => false ],
                    'battery_percentage' => [ 'type' => 'uint8', 'unit' => '%', 'formatter' => [
                        [ 'value' => '255', 'name' => 'not_available' ],
                        [ 'value' => '*', 'name' => '%.1f%s', 'converter' => '/2.54' ]
                    ] ],
                    'battery_voltage' => [ 'type' => 'uint8', 'formatter' => ':battery:3.6' ]
                ];
        }

        if ($this->nascv->firmware >= 0.8 && $this->nascv->firmware_patch <= 2) {
            unset ( $struct[ 24 ][ 'battery' ][ 'battery_percentage' ] );
        }

        $struct[ 24 ][ 'mcu_temperature' ] = [
            # mcu_temperature
            [ '_cnf' => [ 'repeat' => false ],
                'mcu_temperature' => [ 'type' => 'int8', 'unit' => '°C', 'formatter' => '%s%s' ]
            ] ];

        if ($this->nascv->firmware >= 0.8) {
            $struct[ 24 ][ 'mcu_temperature' ] =
                # mcu_temperature
                [ '_cnf' => [ 'repeat' => false ],
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
                ];
        }

        $struct[ 24 ][ 'downlink_rssi' ] = [
            # downlink_rssi
            [ '_cnf' => [ 'repeat' => false ],
                'downlink_rssi' => [ 'type' => 'uint8', 'unit' => 'dBm', 'converter' => '*-1' ]
            ]
        ];


        if ($this->nascv->firmware >= 0.8) {
            $struct[ 24 ][ 'downlink_rssi' ] =
                # downlink_rssi
                [ '_cnf' => [ 'repeat' => false ],
                    'downlink_rssi' => [ 'type' => 'uint8', 'unit' => 'dBm', 'converter' => '*-1' ]
                ];
        }


        /** DEFINE -- digital_interface_channel_1 */
        $struct[ 24 ][ 'digital_1' ] = [
            '_cnf' => [ 'when' => [ [ 'reported_interfaces:digital_1' => 1 ] ], 'name' => 'digital_1' ],
            'state' => [ 'type' => 'byte', 'bits' => [
                [ 'bit' => 0, 'parameter' => 'input_state', 'formatter' => [ 'open', 'closed' ] ],
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
            'counter' => [ 'type' => 'uint32', 'unit' => '{state:medium_type}' ]
        ];

        /** FIRMWARE 0.8 new lines */
        if ($this->nascv->firmware >= 0.8) {
            $struct[ 24 ][ 'digital_1' ][ 'state' ][ 'bits' ][] = [ 'bit' => 3, 'parameter' => 'device_serial_sent' ];
            $struct[ 24 ][ 'digital_1' ][ 'device_serial' ] = [ 'type' => 'hex', 'length' => 4,
                'when' => [ [ 'state:device_serial_sent' => 1 ] ] ];
        }

        /** DEFINE -- digital_interface_channel_2 */
        $struct[ 24 ][ 'digital_2' ] = $struct[ 24 ][ 'digital_1' ];
        $struct[ 24 ][ 'digital_2' ][ '_cnf' ][ 'when' ] = [ [ 'reported_interfaces:digital_2' => 1 ] ];
        $struct[ 24 ][ 'digital_2' ][ '_cnf' ][ 'name' ] = 'digital_2';

        /** DEFINE -- analog_interface_channel_1 */
        $struct[ 24 ][ 'analog_1' ] = [ '_cnf' => [ 'when' => [ [ 'reported_interfaces:analog_1' => 1 ] ], 'name' => 'analog_1' ],
            'general' => [ 'type' => 'byte', 'bits' => [
                [ 'bit' => 0, 'parameter' => 'input_mode', 'formatter' => [ 'V', 'mA' ] ],
                [ 'bit' => 1, 'parameter' => 'is_alert', 'formatter' => [ 'no', 'yes' ] ],
                [ 'bit' => 6, 'parameter' => 'instant_value_reported', 'formatter' => [ 'not reported', 'reported' ] ],
                [ 'bit' => 7, 'parameter' => 'average_value_reported', 'formatter' => [ 'not reported', 'reported' ] ],
            ] ],
            'instant_value' => [ 'type' => 'float', 'when' => [ [ 'general:instant_value_reported' => 1 ] ], 'formatter' => '%0.2f %s', 'unit' => '{general:input_mode}' ],
            'average_value' => [ 'type' => 'float', 'when' => [ [ 'general:average_value_reported' => 1 ] ], 'formatter' => '%0.2f %s', 'unit' => '{general:input_mode}' ],
        ];


        /** DEFINE -- analog_interface_channel_2 */
        $struct[ 24 ][ 'analog_2' ] = $struct[ 24 ][ 'analog_1' ];
        $struct[ 24 ][ 'analog_2' ][ '_cnf' ][ 'when' ] = [ [ 'reported_interfaces:analog_2' => 1 ] ];
        $struct[ 24 ][ 'analog_2' ][ '_cnf' ][ 'name' ] = 'analog_2';


        /** DEFINE -- ssi_interface_channel */
        $struct[ 24 ][ 'ssi' ] = [ '_cnf' => [ 'name' => 'ssi', 'when' => [ [ 'reported_interfaces:ssi' => 1 ] ] ],
            'general' => [ 'type' => 'byte', 'bits' => [
                [ 'bit' => '0-5', 'type' => 'decimal', 'parameter' => 'ssi_index' ],
                [ 'bit' => 7, 'parameter' => 'is_alert', 'formatter' => [ false, true ] ],
            ] ],
            'reported_parameters' => [ 'type' => 'byte', 'bits' => [
                [ 'bit' => 0, 'parameter' => 'channel_1_instant', 'formatter' => [ 'not reported', 'reported' ] ],
                [ 'bit' => 2, 'parameter' => 'channel_2_instant', 'formatter' => [ 'not reported', 'reported' ] ],
                [ 'bit' => 4, 'parameter' => 'channel_3_instant', 'formatter' => [ 'not reported', 'reported' ] ],
                [ 'bit' => 6, 'parameter' => 'channel_4_instant', 'formatter' => [ 'not reported', 'reported' ] ],
            ] ],

            'channel_1_instant' => [ 'type' => 'float', 'formatter' => '%0.3f %s',
                'unit' => [ 'general:ssi_index', $this->ssi_unit_library, 0 ],
                'when' => [ [ 'ssi:reported_parameters:channel_1_instant' => 1 ] ]
            ],
            'channel_2_instant' => [ 'type' => 'float', 'formatter' => '%0.3f %s',
                'unit' => [ 'general:ssi_index', $this->ssi_unit_library, 1 ],
                'when' => [ [ 'ssi:reported_parameters:channel_2_instant' => 1 ] ]
            ],
            'channel_3_instant' => [ 'type' => 'float', 'formatter' => '%0.3f %s',
                'unit' => [ 'general:ssi_index', $this->ssi_unit_library, 2 ],
                'when' => [ [ 'ssi:reported_parameters:channel_3_instant' => 1 ] ]
            ],
            'channel_4_instant' => [ 'type' => 'float', 'formatter' => '%0.3f %s',
                'unit' => [ 'general:ssi_index', $this->ssi_unit_library, 3 ],
                'when' => [ [ 'ssi:reported_parameters:channel_4_instant' => 1 ] ]
            ],
        ];


        /** DEFINE -- mbus_interface_channel */
        $struct[ 24 ][ 'mbus' ] = [
            '_cnf' => [ 'name' => 'mbus', 'when' => [ [ 'reported_interfaces:mbus' => 1 ] ] ],
            'state' => [ 'type' => 'byte', 'bits' => [
                [ 'bit' => '0-3', 'parameter' => 'last_status', 'type' => 'hex', 'formatter' => [
                    [ 'value' => '00', 'name' => 'ok' ],
                    [ 'value' => '01', 'name' => 'nothing_requested' ],
                    [ 'value' => '02', 'name' => 'bus_unpowered' ],
                    [ 'value' => '03', 'name' => 'no_response' ],
                    [ 'value' => '04', 'name' => 'empty_response' ],
                    [ 'value' => '05', 'name' => 'invalid_data' ],

                ] ]
            ] ],

            'mbus_status' => [ 'type' => 'hex', 'when' => [ [ 'state:last_status' => '00' ] ] ],

            'data_records' => [ 'type' => 'hex', 'when' => [ [ 'state:last_status' => '00' ] ],
                'byte_order' => 'MSB', 'length' => '*', 'ext' => [ 'php-mbus', [ 'type' => 'data_records' ] ] ],
        ];


        /** FIRMWARE 0.8 new lines */
        if ($this->nascv->firmware >= 0.8) {
            $struct[ 24 ][ 'mbus' ][ 'state' ][ 'bits' ][] =
                [ 'bit' => 4, 'parameter' => 'packet_truncated', 'formatter' => [ 'false', 'true' ] ];
        }


        /**
         *
         * FPORT 25 (usage_packet)
         *
         */
        $struct[ 25 ] = [

            #packet type
            [ 'packet_type' => 'usage_packet' ],

            # reported_interfaces
            [ '_cnf' => [ 'repeat' => false ],
                'reported_interfaces' => [ 'type' => 'byte', 'bits' => [
                    [ 'bit' => 0, 'parameter' => 'digital_1', 'formatter' => [ 'not_sent', 'sent' ] ],
                    [ 'bit' => 1, 'parameter' => 'digital_2', 'formatter' => [ 'not_sent', 'sent' ] ],
                    [ 'bit' => 2, 'parameter' => 'analog_1', 'formatter' => [ 'not_sent', 'sent' ] ],
                    [ 'bit' => 3, 'parameter' => 'analog_2', 'formatter' => [ 'not_sent', 'sent' ] ],
                    [ 'bit' => 4, 'parameter' => 'ssi', 'formatter' => [ 'not_sent', 'sent' ] ],
                    [ 'bit' => 5, 'parameter' => 'mbus', 'formatter' => [ 'not_sent', 'sent' ] ],
                ] ],
            ]
        ];

        /** DEFINE -- digital_interface_channel_1 */
        $struct[ 25 ][ 'digital_1' ] = $struct[ 24 ][ 'digital_1' ];

        /** DEFINE -- digital_interface_channel_2 */
        $struct[ 25 ][ 'digital_2' ] = $struct[ 24 ][ 'digital_2' ];

        /** DEFINE -- analog_interface_channel_1 */
        $struct[ 25 ][ 'analog_1' ] = $struct[ 24 ][ 'analog_1' ];

        /** DEFINE -- analog_interface_channel_2 */
        $struct[ 25 ][ 'analog_2' ] = $struct[ 24 ][ 'analog_2' ];

        /** DEFINE -- ssi_interface_channel */
        $struct[ 25 ][ 'ssi' ] = [
            '_cnf' => [ 'name' => 'ssi', 'when' => [ [ 'reported_interfaces:ssi' => 1 ] ] ],
            'general' => [ 'type' => 'byte', 'bits' => [
                [ 'bit' => '0-5', 'type' => 'decimal', 'parameter' => 'ssi_index' ],
            ] ],
            'reported_parameters' => [ 'type' => 'byte', 'bits' => [
                [ 'bit' => 0, 'parameter' => 'channel_1_instant', 'formatter' => [ 'not reported', 'reported' ] ],
                [ 'bit' => 1, 'parameter' => 'channel_1_average', 'formatter' => [ 'not reported', 'reported' ] ],
                [ 'bit' => 2, 'parameter' => 'channel_2_instant', 'formatter' => [ 'not reported', 'reported' ] ],
                [ 'bit' => 3, 'parameter' => 'channel_2_average', 'formatter' => [ 'not reported', 'reported' ] ],
                [ 'bit' => 4, 'parameter' => 'channel_3_instant', 'formatter' => [ 'not reported', 'reported' ] ],
                [ 'bit' => 5, 'parameter' => 'channel_3_average', 'formatter' => [ 'not reported', 'reported' ] ],
                [ 'bit' => 6, 'parameter' => 'channel_4_instant', 'formatter' => [ 'not reported', 'reported' ] ],
                [ 'bit' => 7, 'parameter' => 'channel_4_average', 'formatter' => [ 'not reported', 'reported' ] ],
            ] ],

            'channel_1_instant' => [ 'type' => 'float', 'formatter' => '%0.3f %s',
                'unit' => [ 'general:ssi_index', $this->ssi_unit_library, 0 ],
                'when' => [ [ 'ssi:reported_parameters:channel_1_instant' => 1 ] ]
            ],
            'channel_1_average' => [ 'type' => 'float', 'formatter' => '%0.3f %s',
                'unit' => [ 'general:ssi_index', $this->ssi_unit_library, 0 ],
                'when' => [ [ 'ssi:reported_parameters:channel_1_average' => 1 ] ]
            ],
            'channel_2_instant' => [ 'type' => 'float', 'formatter' => '%0.3f %s',
                'unit' => [ 'general:ssi_index', $this->ssi_unit_library, 1 ],
                'when' => [ [ 'ssi:reported_parameters:channel_2_instant' => 1 ] ]
            ],
            'channel_2_average' => [ 'type' => 'float', 'formatter' => '%0.3f %s',
                'unit' => [ 'general:ssi_index', $this->ssi_unit_library, 1 ],
                'when' => [ [ 'ssi:reported_parameters:channel_2_average' => 1 ] ]
            ],
            'channel_3_instant' => [ 'type' => 'float', 'formatter' => '%0.3f %s',
                'unit' => [ 'general:ssi_index', $this->ssi_unit_library, 2 ],
                'when' => [ [ 'ssi:reported_parameters:channel_3_instant' => 1 ] ]
            ],
            'channel_3_average' => [ 'type' => 'float', 'formatter' => '%0.3f %s',
                'unit' => [ 'general:ssi_index', $this->ssi_unit_library, 2 ],
                'when' => [ [ 'ssi:reported_parameters:channel_3_average' => 1 ] ]
            ],
            'channel_4_instant' => [ 'type' => 'float', 'formatter' => '%0.3f %s',
                'unit' => [ 'general:ssi_index', $this->ssi_unit_library, 3 ],
                'when' => [ [ 'ssi:reported_parameters:channel_4_instant' => 1 ] ]
            ],
            'channel_4_average' => [ 'type' => 'float', 'formatter' => '%0.3f %s',
                'unit' => [ 'general:ssi_index', $this->ssi_unit_library, 3 ],
                'when' => [ [ 'ssi:reported_parameters:channel_4_average' => 1 ] ]
            ],
        ];


        /** DEFINE -- mbus_interface_channel */
        $struct[ 25 ][ 'mbus' ] = $struct[ 24 ][ 'mbus' ];
        unset( $struct[ 25 ][ 'mbus' ][ 'mbus_status' ] );


        /**
         *
         * FPORT 49 (general_config_request/mbus_config_response)
         *
         */
        $struct[ 49 ] = [
            # packet_type
            [ '_cnf' => [ 'repeat' => false, 'name' => 'packet_type', 'formatter' => '{packet_type:packet_type}' ],
                'packet_type' => [ 'type' => 'hex', 'formatter' => [
                    [ 'value' => '00', 'name' => 'general_config_response' ],
                    [ 'value' => '01', 'name' => 'mbus_config_response' ],
                    [ 'value' => '*', 'name' => 'unknown_packet' ],
                ] ],
            ],
        ];
        if ($this->nascv->firmware >= 0.8) {
            $struct[ 49 ] = [
                # packet_type
                [ '_cnf' => [ 'repeat' => false, 'name' => 'packet_type', 'formatter' => '{packet_type:packet_type}' ],
                    'packet_type' => [ 'type' => 'hex', 'formatter' => [
                        [ 'value' => '00', 'name' => 'reporting_config_response' ],
                        [ 'value' => '01', 'name' => 'general_config_response' ],
                        [ 'value' => '04', 'name' => 'mbus_config_response' ],
                    ] ],
                ],
            ];
        }

        # reporting_config_packet
        if ($this->nascv->firmware < 0.8) {
            $struct[ 49 ][ 'conf_reporting' ] = [
                '_cnf' => [ 'when' => [ [ 'packet_type' => 'general_config_response' ] ] ],
                'usage_interval' => [ 'type' => 'uint16', 'unit' => 'minutes' ],
                'status_interval' => [ 'type' => 'uint16', 'unit' => 'minutes' ],
                'usage_behaviour' => [ 'type' => 'byte', 'bits' =>
                    [ 'send_always' => [ 'only_when_fresh_data', 'always' ] ], 'unit' => 'minutes'
                ],
            ];
        }
        if ($this->nascv->firmware >= 0.8) {
            $struct[ 49 ][ 'configured_parameters' ] = [ [
                #configured_parameters
                '_cnf' => [ 'when' => [ [ 'packet_type' => 'reporting_config_response' ] ] ],
                'configured_parameters' => [ 'type' => 'byte', 'bits' =>
                    [ 'usage_interval' => [ 'not_sent', 'sent' ],
                        'status_interval' => [ 'not_sent', 'sent' ],
                        'usage_behaviour' => [ 'not_sent', 'sent' ],
                    ] ],
                'usage_interval' => [ 'type' => 'uint16', 'unit' => 'minutes' ],
                'status_interval' => [ 'type' => 'uint16', 'unit' => 'minutes' ],
                'usage_behaviour' => [ 'type' => 'byte', 'bits' =>
                    [ 'send_always' => [ 'only_when_fresh_data', 'always' ] ],
                ] ],
            ];

        }


        # input_config_packet
        $struct[ 49 ][ 'conf_general' ] = [ [ '_cnf' => [ 'when' => [ [ 'packet_type' => 'general_config_response' ] ] ],
            'configured_interfaces' => [ 'type' => 'byte', 'bits' =>
                [ 'digital_1' => [ 'not_sent', 'sent' ],
                    'digital_2' => [ 'not_sent', 'sent' ],
                    'analog_1' => [ 'not_sent', 'sent' ],
                    'analog_2' => [ 'not_sent', 'sent' ],
                    'ssi' => [ 'not_sent', 'sent' ],
                    'mbus' => [ 'not_sent', 'sent' ],
                ] ]
        ],
        ];


        /** DEFINE -- digital_interface_channel_1_configuration */
        $struct[ 49 ][ 'conf_general' ][ 'digital_1' ] = [
            '_cnf' => [ 'name' => 'digital_1', 'when' => [ [ 'configured_interfaces:digital_1' => 1 ]
#                , [ 'packet_type' => 'general_config_response' ]
            ] ],
            'configured_parameters' => [ 'type' => 'byte', 'bits' => [
                [ 'bit' => 0, 'parameter' => 'interface_enabled', 'formatter' =>
                    [ 'disabled', 'enabled' ] ],
                [ 'bit' => 1, 'parameter' => 'mode', 'formatter' =>
                    [ 'not_sent', 'sent' ] ],
                [ 'bit' => 2, 'parameter' => 'multiplier', 'formatter' =>
                    [ 'not_sent', 'sent' ] ],
                [ 'bit' => 3, 'parameter' => 'true_reading', 'formatter' =>
                    [ 'not_sent', 'sent' ] ],
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
            'mode' => [ 'when' => [ [ 'configured_parameters:interface_enabled' => 1 ] ], 'type' => 'byte', 'bits' => [
                [ 'bit' => 0, 'parameter' => 'operational_mode', 'formatter' => [ 'pulse_mode', 'trigger_mode' ] ],
                [ 'bit' => 1, 'parameter' => 'set_device_serial', 'formatter' => [ 'no', 'yes' ] ],
                [ 'bit' => '6-7', 'when' => [ [ 'mode:operational_mode' => 1 ] ], 'parameter' => 'trigger_time', 'type' => 'hex', 'formatter' => [
                    [ 'value' => '00', 'name' => '1_sec' ],
                    [ 'value' => '01', 'name' => '10_sec' ],
                    [ 'value' => '02', 'name' => '1_min' ],
                    [ 'value' => '03', 'name' => '1_h' ]
                ]
                ]
            ]
            ],
            'multiplier' => [ 'when' => [ [ 'configured_parameters:interface_enabled' => 1, 'configured_parameters:multiplier' => 1 ] ],
                'type' => 'float', ],
            'true_reading' => [ 'when' => [ [ 'configured_parameters:interface_enabled' => 1, 'configured_parameters:true_reading' => 1 ] ],
                'type' => 'uint32', 'unit' => [ 'configured_parameters:medium_type' ] ],
            'device_serial' => [ 'when' => [ [ 'mode:set_device_serial' => 1 ] ], 'type' => 'hex', 'length' => 4 ],
        ];


        if ($this->nascv->firmware >= 0.8 && $this->nascv->firmware_patch >= 3) {
            $struct[ 49 ][ 'conf_general' ][ 'digital_1' ] = [
                '_cnf' => [ 'name' => 'digital_1', 'when' => [ [ 'configured_interfaces:digital_1' => 1 ]
#                , [ 'packet_type' => 'general_config_response' ]
                ] ],
                'configured_parameters' => [ 'type' => 'byte', 'bits' => [
                    [ 'bit' => 0, 'parameter' => 'interface_enabled', 'formatter' =>
                        [ 'disabled', 'enabled' ] ],
                    [ 'bit' => 2, 'parameter' => 'multiplier', 'formatter' =>
                        [ 'not_sent', 'sent' ] ],
                    [ 'bit' => 3, 'parameter' => 'true_reading', 'formatter' =>
                        [ 'not_sent', 'sent' ] ],
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
                'mode' => [ 'when' => [ [ 'configured_parameters:interface_enabled' => 1 ] ], 'type' => 'byte', 'bits' => [
                    [ 'bit' => 0, 'parameter' => 'operational_mode', 'formatter' => [ 'pulse_mode', 'trigger_mode' ] ],
                    [ 'bit' => 1, 'parameter' => 'set_device_serial', 'formatter' => [ 'no', 'yes' ] ],
                    [ 'bit' => '6-7', 'when' => [ [ 'mode:operational_mode' => 1 ] ], 'parameter' => 'trigger_time', 'type' => 'hex', 'formatter' => [
                        [ 'value' => '00', 'name' => '1_sec' ],
                        [ 'value' => '01', 'name' => '10_sec' ],
                        [ 'value' => '02', 'name' => '1_min' ],
                        [ 'value' => '03', 'name' => '1_h' ]
                    ]
                    ]
                ]
                ],

                'multiplier' => [ 'type' => 'uint16', 'when' => [ [ 'configured_parameters:multiplier' => 1 ] ] ],
                'divider' => [ 'type' => 'uint16', 'when' => [ [ 'configured_parameters:multiplier' => 1 ] ] ],
                'true_reading' => [ 'when' => [ [ 'configured_parameters:interface_enabled' => 1, 'configured_parameters:true_reading' => 1 ] ],
                    'type' => 'uint32', 'unit' => [ 'configured_parameters:medium_type' ] ],
                'device_serial' => [ 'when' => [ [ 'mode:set_device_serial' => 1 ] ], 'type' => 'hex', 'length' => 4 ],
            ];

        }

        if ($this->nascv->firmware < 0.8) {
            unset ( $struct[ 49 ][ 'conf_general' ][ 'digital_1' ][ 'mode' ][ 'bits' ][ 1 ] );
        }

        /** DEFINE -- digital_interface_channel_2_configuration */
        $struct[ 49 ][ 'conf_general' ][ 'digital_2' ] = $struct[ 49 ][ 'conf_general' ][ 'digital_1' ];
        $struct[ 49 ][ 'conf_general' ][ 'digital_2' ][ '_cnf' ][ 'when' ] = [ [ 'configured_interfaces:digital_2' => 1 ] ];
        $struct[ 49 ][ 'conf_general' ][ 'digital_2' ][ '_cnf' ][ 'name' ] = 'digital_2';


        /** DEFINE -- analog_interface_channel_1_configuration */
        $struct[ 49 ][ 'conf_general' ][ 'analog_1' ] = [
            '_cnf' => [ 'name' => 'analog_1', 'when' => [ [ 'configured_interfaces:analog_1' => 1 ]
#                , [ 'packet_type' => 'general_config_response' ]
            ] ],
            'configured_parameters' => [ 'type' => 'byte', 'bits' =>
                [ 'interface_enabled' => [ 'disabled', 'enabled' ],
                    'general' => [ 'not_sent', 'sent' ],
                    'reporting' => [ 'not_sent', 'sent' ] ] ],
            'general' => [ 'type' => 'byte', 'when' => [ [ 'analog:configured_parameters:general' => 1 ] ],
                'bits' => [
                    'sampling_rate' => [ '1_min', '1_sec' ],
                    'input_mode' => [ 'voltage', 'current' ] ] ],
            'reporting' => [ 'type' => 'byte', 'when' => [ [ 'analog:configured_parameters:reporting' ] ],
                'bits' => [
                    [ 'bit' => 0, 'parameter' => 'alert_enabled', 'formatter' =>
                        [ 'disabled', 'enabled' ] ],
                    [ 'bit' => 1, 'parameter' => 'alert_limiting_thresholds', 'formatter' =>
                        [ 'not_sent', 'sent' ] ],
                    [ 'bit' => 2, 'parameter' => 'instant_value_in_usage', 'formatter' =>
                        [ 'do_not_report ', 'report' ] ],
                    [ 'bit' => 3, 'parameter' => 'average_value_in_usage', 'formatter' =>
                        [ 'do_not_report ', 'report' ] ],
                    [ 'bit' => '6-7', 'parameter' => 'alert_triggered_after', 'type' => 'hex', 'formatter' =>
                        [ 'value' => '00', 'name' => '1_sample' ],
                        [ 'value' => '01', 'name' => '3_samples' ],
                        [ 'value' => '02', 'name' => '10_samples' ],
                        [ 'value' => '03', 'name' => '100_samples' ]
                    ] ] ],

            'alert_low_threshold' => [ 'type' => 'float', 'unit' => '{general:input_mode}', 'when' => [ [ 'reporting:alert_limiting_thresholds' => 1 ] ], 'formatter' => '%0.2f %s' ],
            'alert_high_threshold' => [ 'type' => 'float', 'unit' => '{general:input_mode}', 'when' => [ [ 'reporting:alert_limiting_thresholds' => 1 ] ], 'formatter' => '%0.2f %s' ],
        ];
        if ($this->nascv->firmware >= 0.8) {
            $struct[ 49 ][ 'conf_general' ][ 'analog_1' ] = [
                '_cnf' => [ 'name' => 'analog_1', 'when' => [ [ 'configured_interfaces:analog_1' => 1 ]
#                , [ 'packet_type' => 'general_config_response' ]
                ] ],
                'configured_parameters' => [ 'type' => 'byte', 'bits' => [
                    [ 'bit' => 0, 'parameter' => 'interface_enabled', 'formatter' => [ 'disabled', 'enabled' ] ],
                    [ 'bit' => 2, 'parameter' => 'reporting', 'formatter' => [ 'not_sent', 'sent' ] ],
                ] ],
                'general' => ['when' => [ [ 'configured_parameters:interface_enabled' => 1 ]], 'type' => 'byte', 'bits' => [
                    'sampling_rate' => [ '1_min', '1_sec' ],
                    'input_mode' => [ 'V', 'mA' ] ] ],
                'reporting' => [ 'type' => 'byte', 'when' => [ [ 'configured_parameters:reporting' => 1 ] ],
                    'bits' => [
                        [ 'bit' => 0, 'parameter' => 'alert_enabled', 'formatter' =>
                            [ 'disabled', 'enabled' ] ],
                        [ 'bit' => 1, 'parameter' => 'alert_limiting_thresholds', 'formatter' =>
                            [ 'not_sent', 'sent' ] ],
                        [ 'bit' => 2, 'parameter' => 'instant_value_in_usage', 'formatter' =>
                            [ 'do_not_report ', 'report' ] ],
                        [ 'bit' => 3, 'parameter' => 'average_value_in_usage', 'formatter' =>
                            [ 'do_not_report ', 'report' ] ],
                        [ 'bit' => '6-7', 'parameter' => 'alert_triggered_after', 'type' => 'hex', 'formatter' =>
                            [ 'value' => '00', 'name' => '1_sample' ],
                            [ 'value' => '01', 'name' => '3_samples' ],
                            [ 'value' => '02', 'name' => '10_samples' ],
                            [ 'value' => '03', 'name' => '100_samples' ]
                        ] ] ],


                'alert_low_threshold' => [ 'type' => 'float', 'unit' => '{general:input_mode}', 'when' => [ [ 'reporting:alert_limiting_thresholds' => 1 ] ], 'formatter' => '%0.2f %s' ],
                'alert_high_threshold' => [ 'type' => 'float', 'unit' => '{general:input_mode}', 'when' => [ [ 'reporting:alert_limiting_thresholds' => 1 ] ], 'formatter' => '%0.2f %s' ],
            ];
        }


        /** DEFINE -- analog_interface_channel_2_configuration */
        $struct[ 49 ][ 'conf_general' ][ 'analog_2' ] = $struct[ 49 ][ 'conf_general' ][ 'analog_1' ];
        $struct[ 49 ][ 'conf_general' ][ 'analog_2' ][ '_cnf' ][ 'when' ] = [ [ 'configured_interfaces:analog_2' => 1 ] ];
        $struct[ 49 ][ 'conf_general' ][ 'analog_2' ][ '_cnf' ][ 'name' ] = 'analog_2';


        /** DEFINE -- ssi_interface_configuration */
        $struct[ 49 ][ 'conf_general' ][ 'ssi' ] = [
            '_cnf' => [ 'name' => 'ssi', 'when' => [ [ 'configured_interfaces:ssi' => 1 ]
#                , [ 'packet_type' => 'general_config_response' ]
            ] ],
            'configured_parameters' => [ 'type' => 'byte', 'bits' =>
                [ 'interface_enabled' => [ 'disabled', 'enabled' ],
                    'general' => [ 'not_sent', 'sent' ],
                    'channel_1' => [ 'not_sent', 'sent' ],
                    'channel_2' => [ 'not_sent', 'sent' ],
                    'channel_3' => [ 'not_sent', 'sent' ],
                    'channel_4' => [ 'not_sent', 'sent' ] ] ],
            'general' => [ 'type' => 'byte', 'when' => [ [ 'configured_parameters:general' ] ],
                'bits' => [ 'sampling_rate' => [ 'slow', 'fast' ] ] ],
            'channel_1' => [ 'type' => 'float', 'when' => [ [ 'configured_parameters:channel_1' ] ] ],
            'channel_2' => [ 'type' => 'float', 'when' => [ [ 'configured_parameters:channel_2' ] ] ],
            'channel_3' => [ 'type' => 'float', 'when' => [ [ 'configured_parameters:channel_3' ] ] ],
            'channel_4' => [ 'type' => 'float', 'when' => [ [ 'configured_parameters:channel_4' ] ] ],

        ];


        if ($this->nascv->firmware >= 0.8) {
            $struct[ 49 ][ 'conf_general' ][ 'ssi' ] = [
                '_cnf' => [ 'name' => 'ssi', 'when' => [ [ 'configured_interfaces:ssi' => 1 ]
                    #                , [ 'packet_type' => 'general_config_response' ]
                ] ],
                'configured_parameters' => [ 'type' => 'byte', 'bits' => [
                    [ 'bit' => 0, 'parameter' => 'interface_enabled', 'formatter' => [ 'disabled', 'enabled' ] ],

                    [ 'bit' => 2, 'parameter' => 'channel_1', 'formatter' => [ 'not_sent', 'sent' ] ],
                    [ 'bit' => 3, 'parameter' => 'channel_2', 'formatter' => [ 'not_sent', 'sent' ] ],
                    [ 'bit' => 4, 'parameter' => 'channel_3', 'formatter' => [ 'not_sent', 'sent' ] ],
                    [ 'bit' => 5, 'parameter' => 'channel_4', 'formatter' => [ 'not_sent', 'sent' ] ] ] ],

                'general' => [ 'type' => 'byte', 'bits' => [
                    [ 'bit' => 0, 'parameter' => 'sampling_rate', 'formatter' => [ 'slow', 'fast' ] ] ],

                ],

            ];
        }
        if ($this->nascv->firmware >= 0.8) {
            $struct[ 49 ][ 'conf_general' ][ 'channel_1' ] = [
                '_cnf' => [ 'name' => 'channel_1', 'when' => [ [ 'ssi:configured_parameters:channel_1' => 1 ]
#                , [ 'packet_type' => 'general_config_response' ]
                ] ],
                'reporting' => [ 'type' => 'byte', 'bits' => [
                    [ 'bit' => 0, 'parameter' => 'alert_enabled', 'formatter' => [ 'disabled', 'enabled' ] ],
                    [ 'bit' => 1, 'parameter' => 'alert_thresholds', 'formatter' => [ 'not_sent', 'sent' ] ],
                    [ 'bit' => 2, 'parameter' => 'instant_value_in_usage', 'formatter' => [ 'not_reported', 'reported' ] ],
                    [ 'bit' => 3, 'parameter' => 'average_value_in_usage', 'formatter' => [ 'not_reported', 'reported' ] ],
                    [ 'bit' => '6-7', 'parameter' => 'alert_triggered_after', 'type' => 'hex', 'formatter' =>
                        [ 'value' => '00', 'formatted' => '1_sample' ],
                        [ 'value' => '01', '' => '3_samples' ],
                        [ 'value' => '02', 'name' => '10_samples' ],
                        [ 'value' => '03', 'name' => '100_samples' ],
                    ] ] ],
                'alert_low_threshold' => [ 'type' => 'float', 'formatter' => '%0.2f %s', 'when' => [ [ 'reporting:alert_thresholds' => 1 ] ] ],
                'alert_high_threshold' => [ 'type' => 'float', 'formatter' => '%0.2f %s', 'when' => [ [ 'reporting:alert_thresholds' => 1 ] ] ],

            ];


            /** DEFINE -- ssi_interface_channel_2_configuration */
            $struct[ 49 ][ 'conf_general' ][ 'channel_2' ] = $struct[ 49 ][ 'conf_general' ][ 'channel_1' ];
            $struct[ 49 ][ 'conf_general' ][ 'channel_2' ][ '_cnf' ][ 'when' ] = [ [ 'ssi:configured_parameters:channel_2' => 1 ] ];
            $struct[ 49 ][ 'conf_general' ][ 'channel_2' ][ '_cnf' ][ 'name' ] = 'channel_2';

            /** DEFINE -- ssi_interface_channel_2_configuration */
            $struct[ 49 ][ 'conf_general' ][ 'channel_3' ] = $struct[ 49 ][ 'conf_general' ][ 'channel_1' ];
            $struct[ 49 ][ 'conf_general' ][ 'channel_3' ][ '_cnf' ][ 'when' ] = [ [ 'ssi:configured_parameters:channel_3' => 1 ] ];
            $struct[ 49 ][ 'conf_general' ][ 'channel_3' ][ '_cnf' ][ 'name' ] = 'channel_3';

            /** DEFINE -- ssi_interface_channel_2_configuration */
            $struct[ 49 ][ 'conf_general' ][ 'channel_4' ] = $struct[ 49 ][ 'conf_general' ][ 'channel_1' ];
            $struct[ 49 ][ 'conf_general' ][ 'channel_4' ][ '_cnf' ][ 'when' ] = [ [ 'ssi:configured_parameters:channel_4' => 1 ] ];
            $struct[ 49 ][ 'conf_general' ][ 'channel_4' ][ '_cnf' ][ 'name' ] = 'channel_4';
        }


        /** DEFINE -- mbus_interface_configuration */
        $struct[ 49 ][ 'conf_general' ][ 'mbus' ] = [
            '_cnf' => [ 'name' => 'mbus', 'when' => [ [ 'configured_interfaces:mbus' => 1 ]
#                , [ 'packet_type' => 'general_config_response' ]
            ] ],
            'mbus_device_serial' => [ 'type' => 'hex', 'length' => 4,
                'formatter' => [ [ 'value' => 'ffffffff', 'name' => 'no device found' ] ]
            ],


            'configured_parameters' => [ 'type' => 'byte', 'bits' => [
                [ 'bit' => 0, 'parameter' => 'interface_enabled', 'formatter' => [ 'disabled', 'enabled' ] ],
                [ 'bit' => 0, 'parameter' => 'data_records_in_usage', 'formatter' => [ 'not configured', 'configured' ] ],
                [ 'bit' => 0, 'parameter' => 'data_records_in_status', 'formatter' => [ 'not configured', 'configured' ] ],
            ] ],

            'data_records_for_packets' => [ 'type' => 'byte', 'bits' => [
                [ 'bit' => '0-3', 'parameter' => 'count_in_usage', 'type' => 'decimal',
                    'formatter' => [ 'value' => 0, 'name' => 'not sent' ] ],
                [ 'bit' => '4-7', 'parameter' => 'count_in_status', 'type' => 'decimal',
                    'formatter' => [ 'value' => 0, 'name' => 'not sent' ] ],
            ] ],

            'records' => [ 'type' => 'hex', 'byte_order' => 'MSB', 'length' => '*',
                'ext' => [ 'php-mbus', [ 'type' => 'data_record_headers_usage_status', 'count_usage' => '{data_records_for_packets:count_in_usage}', 'count_status' => '{data_records_for_packets:count_in_status}' ] ]
            ],
        ];

        if ($this->nascv->firmware >= 0.8) {
            $struct[ 49 ][ 'conf_reporting' ] = [
                '_cnf' => [ 'when' => [ [ 'packet_type' => 'mbus_config_response' ] ] ],
                'configured_parameters' => [ 'type' => 'byte', 'bits' => [
                    [ 'bit' => 0, 'parameter' => 'interface_enabled',
                        'formatter' => [ 'disabled', 'enabled' ] ],
                    [ 'bit' => 1, 'parameter' => 'data_records_in_usage',
                        'formatter' => [ 'disabled', 'enabled' ] ],
                    [ 'bit' => 2, 'parameter' => 'data_records_in_status',
                        'formatter' => [ 'disabled', 'enabled' ] ],
                    [ 'bit' => 3, 'parameter' => 'mbus_device_serial_sent',
                        'formatter' => [ 'not_sent', 'sent' ] ],
                ] ],
                'mbus_device_serial' => [ 'when' => [ [ 'configured_parameters:mbus_device_serial_sent' => 1 ] ], 'length' => 4, 'type' => 'hex' ],
                'data_records_for_packets' => [ 'type' => 'byte', 'bits' => [
                    [ 'bit' => '0-3', 'parameter' => 'count_in_usage', 'type' => 'decimal',
                        'formatter' => [ 'value' => 0, 'name' => 'not sent' ] ],
                    [ 'bit' => '4-7', 'parameter' => 'count_in_status', 'type' => 'decimal',
                        'formatter' => [ 'value' => 0, 'name' => 'not sent' ] ],
                ] ],
                'records' => [ 'type' => 'hex', 'byte_order' => 'MSB', 'length' => '*',
                    'ext' => [ 'php-mbus', [ 'type' => 'data_record_headers_usage_status', 'count_usage' => '{data_records_for_packets:count_in_usage}', 'count_status' => '{data_records_for_packets:count_in_status}' ] ]
                ],
            ];
        }

        /**
         *
         * FPORT 53 (mbus_connect_packet)
         *
         */
        $struct[ 53 ] = [

            #packet type
            [ 'packet_type' => 'mbus_connect_packet' ],

            # interface
            [ '_cnf' => [ 'repeat' => false ],
                'interface' => [ 'type' => 'hex' ]
            ],

            # reported_interfaces
            [ '_cnf' => [ 'when' => [ [ 'interface' => '01' ] ] ],
                'header' => [ 'type' => 'byte', 'bits' => [
                    [ 'bit' => '0-2', 'parameter' => 'packet_number', 'type' => 'decimal' ],
                    [ 'bit' => 3, 'parameter' => 'more_to_follow', 'type' => 'decimal' ],
                    [ 'bit' => 6, 'parameter' => 'fixed_data_header', 'formatter' => [ 'not sent', 'sent' ] ],
                    [ 'bit' => 7, 'parameter' => 'data_record_headers_only', 'formatter' => [ 'with data', 'headers only' ] ],
                ] ],
            ],

            [ '_cnf' => [ 'repeat' => false, 'when' => [ [ 'header:fixed_data_header' => true ] ] ],
                'mbus_fixed_header' => [ 'type' => 'hex', 'byte_order' => 'MSB', 'length' => 12,
                    'ext' => [ 'php-mbus', [ 'type' => 'fixed_header' ] ],
                ],

                [ '_cnf' => [ 'when' => [ [ 'header:data_record_headers_only' => true ] ] ],
                    'record_headers' => [ 'type' => 'hex', 'byte_order' => 'MSB', 'length' => '*',
                        'ext' => [ 'php-mbus', [ 'type' => 'data_record_headers' ] ] ],
                ],

                [ '_cnf' => [ 'when' => [ [ 'header:data_record_headers_only' => false ] ] ],
                    'records' => [ 'type' => 'hex', 'byte_order' => 'MSB',
                        'ext' => [ 'php-mbus', [ 'type' => 'data_records' ] ], 'length' => '*' ],
                ],
            ]
        ];

        if ($this->nascv->firmware >= 0.8) {
            $struct[ 53 ][ 2 ] = [
                [ '_cnf' => [ 'when' => [ [ 'interface' => '04' ] ] ],
                    'header' => [ 'type' => 'byte', 'bits' => [
                        [ 'bit' => '0-2', 'parameter' => 'packet_number', 'type' => 'decimal' ],
                        [ 'bit' => 3, 'parameter' => 'more_to_follow', 'type' => 'decimal' ],
                        [ 'bit' => 6, 'parameter' => 'fixed_data_header', 'formatter' => [ 'not sent', 'sent' ] ],
                        [ 'bit' => 7, 'parameter' => 'data_record_headers_only', 'formatter' => [ 'with data', 'headers only' ] ],
                    ] ],
                ],
            ];

        }


        /**
         *
         * FPORT 99 (boot_packet/shutdown_packet/config_failed_packet)
         *
         */
        $struct[ 99 ] = [

            #packet type
            [ '_cnf' => [ 'name' => 'packet_type', 'formatter' => '{packet_type:packet_type}' ],
                'packet_type' => [ 'type' => 'hex', 'formatter' => [
                    [ 'value' => '00', 'name' => 'boot_packet' ],
                    [ 'value' => '01', 'name' => 'shutdown_packet' ],
                    [ 'value' => '13', 'name' => 'config_failed_packet' ],
                ] ],
            ],


            #boot packet
            [ '_cnf' => [ 'when' => [ [ 'packet_type' => 'boot_packet' ] ] ],
                'device_serial' => [ 'type' => 'hex', 'length' => 4 ],
                [ '_cnf' => [ 'name' => 'firmware_version',
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
                    [ 'value' => '05', 'name' => 'bk-g_pulser' ],
                    [ 'value' => '06', 'name' => 'digital_+_lbus' ]
                ] ]
            ],


            #shutdown_packet
            [ '_cnf' => [ 'when' => [ [ 'packet_type' => 'shutdown_packet' ] ] ],
                'shutdown_reason' => [ 'type' => 'hex', 'formatter' => [
                    [ 'value' => '20', 'name' => 'hardware_error' ],
                    [ 'value' => '30', 'name' => 'lora_shutdown' ],
                    [ 'value' => '31', 'name' => 'magnet_shutdown' ],
                    [ 'value' => '32', 'name' => 'entering_dfu' ],
                ] ],
                [ '_struct' => $struct[ 24 ] ]
            ],

            #config_failed_packet
            [ '_cnf' => [ 'when' => [ [ 'packet_type' => 'config_failed_packet' ] ] ],
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

        /** FIRMWARE 0.8 new lines */
        if ($this->nascv->firmware >= 0.8) {
            $struct[ 99 ][ 1 ][ 'general_info' ] = [ 'type' => 'byte', 'bits' => [
                [ 'bit' => 7, 'parameter' => 'configuration_restored', 'formatter' => [ 'false', 'true' ] ],
            ] ];
        }


        return $struct;
    }

    /**
     * @return array
     */
    public function tx_fport()   
    {
        $rx_obj = rx_fport();

        $struct = [];
        return $struct;
    }
}

?>