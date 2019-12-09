<?php

class pmg
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
                'general' => [ 'type' => 'byte', 'bits' => [
                    'relay_state' => [ 'off', 'on' ],
                    'relay_switched_packet' => [ false, true ],
                    'counter_reset_packet' => [ false, true ]
                ] ],
                'accumulated_energy' => [ 'type' => 'float', 'unit' => 'kWh', 'formatter' => '%.3f %s' ],
                [ '_cnf' => [ 'repeat' => false, 'name' => 'instant' ],
                    'frequency' => [ 'type' => 'uint16', 'unit' => 'Hz', 'converter' => '/1000' ],
                    'voltage' => [ 'type' => 'uint16', 'unit' => 'V', 'converter' => '/100' ],
                    'power' => [ 'type' => 'uint16', 'unit' => 'W', 'converter' => '/10' ],
                ],
                'rssi' => [ 'type' => 'int8', 'unit' => 'dBm', 'converter' => '*-1' ],
            ],

            # Extension module data
            [ '_cnf' => [ 'repeat' => true, 'name' => 'extension' ],
                'device_type' => [ 'type' => 'hex' ],

                # swithc
                [ '_cnf' => [ 'repeat' => false, 'name' => 'switch', 'when' => [ [ 'device_type' => '00' ] ] ],
                    'channel_map' => [ 'type' => 'byte', 'bits' => [
                        'channel_0' => [ 'off', 'on' ],
                        'channel_1' => [ 'off', 'on' ],
                        'channel_2' => [ 'off', 'on' ],
                        'channel_3' => [ 'off', 'on' ],
                        'channel_4' => [ 'off', 'on' ],
                        'channel_5' => [ 'off', 'on' ],
                        'channel_6' => [ 'off', 'on' ],
                        'channel_7' => [ 'off', 'on' ],
                    ], ]
                ],

                # meter
                [ '_cnf' => [ 'repeat' => false, 'name' => 'meter', 'when' => [ [ 'device_type' => '01' ] ] ],
                    'channel_map' => [ 'type' => 'byte', 'bits' => [
                        'channel_0' => [ 'diconnected', 'connected' ],
                        'channel_1' => [ 'diconnected', 'connected' ],
                        'channel_2' => [ 'diconnected', 'connected' ],
                        'channel_3' => [ 'diconnected', 'connected' ],
                        'channel_4' => [ 'diconnected', 'connected' ],
                        'channel_5' => [ 'diconnected', 'connected' ],
                        'channel_6' => [ 'diconnected', 'connected' ],
                        'channel_7' => [ 'diconnected', 'connected' ],
                    ], ],
                    'channel_x' => [ 'type' => 'float', 'unit' => 'kWh' ],
                    'channel_n' => [ 'type' => 'float', 'unit' => 'kWh' ],
                ]
            ]

        ];


        # fport 25
        $struct[ 25 ] = [

            #packet type
            [ 'packet_type' => 'usage_packet' ],

            #main
            [ '_cnf' => [ 'repeat' => false ],
                'accumulated_energy' => [ 'type' => 'float', 'unit' => 'kWh', 'formatter' => '%0.3f %s' ],
                'power' => [ 'type' => 'uint16', 'unit' => 'W', 'converter' => '/10' ],
            ],

            [ '_cnf' => [ 'repeat' => true, 'name' => 'extension' ],
                'device_type' => [ 'type' => 'hex' ],

                # meter
                [ '_cnf' => [ 'repeat' => false, 'name' => 'meter', 'when' => [ [ 'device_type' => '01' ] ] ],
                    'channel_map' => [ 'type' => 'byte', 'bits' => [
                        'channel_0' => [ 'diconnected', 'connected' ],
                        'channel_1' => [ 'diconnected', 'connected' ],
                        'channel_2' => [ 'diconnected', 'connected' ],
                        'channel_3' => [ 'diconnected', 'connected' ],
                        'channel_4' => [ 'diconnected', 'connected' ],
                        'channel_5' => [ 'diconnected', 'connected' ],
                        'channel_6' => [ 'diconnected', 'connected' ],
                        'channel_7' => [ 'diconnected', 'connected' ],
                    ], ],
                    'channel_x' => [ 'type' => 'float', 'unit' => 'kWh' ],
                    'channel_n' => [ 'type' => 'float', 'unit' => 'kWh' ],
                ]
            ]

        ];

        # fport 50
        $struct[ 50 ] = [

            #packet type
            [ 'packet_type' => 'configuration_packet' ],

            #main
            [ '_cnf' => [ 'repeat' => false ],
                'header' => [ 'type' => 'hex' ]
            ],

            #Reporting intervals
            [ '_cnf' => [ 'repeat' => false, 'when' => [ [ 'header' => '00' ] ] ],
                'usage_interval' => [ 'type' => 'uint16', 'unit' => 'minutes' ],
                'status_interval' => [ 'type' => 'uint16', 'unit' => 'minutes' ],
            ],

            #Metering module config
            [ '_cnf' => [ 'repeat' => false, 'when' => [ [ 'header' => '01' ] ] ],

                'device' => [ 'type' => 'byte', 'bits' => [
                    'device_0' => [ 'not selected', 'selected' ],
                    'device_1' => [ 'not selected', 'selected' ]
                ] ],

                'channel' => [ 'type' => 'byte', 'bits' => [
                    'channel_0' => [ 'not selected', 'selected' ],
                    'channel_1' => [ 'not selected', 'selected' ],
                    'channel_2' => [ 'not selected', 'selected' ],
                    'channel_3' => [ 'not selected', 'selected' ],
                    'channel_4' => [ 'not selected', 'selected' ],
                    'channel_5' => [ 'not selected', 'selected' ],
                    'channel_6' => [ 'not selected', 'selected' ],
                    'channel_7' => [ 'not selected', 'selected' ]
                ] ],

                'transformer' => [ 'type' => 'hex', 'formatter' => [
                    [ 'value' => '00', 'type' => 'disabled' ],
                    [ 'value' => '01', 'type' => 'closed_loop' ],
                    [ 'value' => '02', 'type' => "open_loop" ],
                    [ 'value' => '02', 'type' => "3rd_party" ]
                ] ],

                'amp_rating' => [ 'type' => 'uint8', 'unit' => 'amp' ],
                'twist_count' => [ 'type' => 'uint16' ],
            ],
        ];

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
                'extension_module_0' => [ 'type' => 'hex', 'formatter' => [
                    [ 'value' => '00', 'name' => 'switch' ],
                    [ 'value' => '01', 'name' => 'meter' ],
                    [ 'value' => 'ff', 'name' => 'not connected' ]
                ] ],
                'extension_module_1' => [ 'type' => 'hex', 'formatter' => [
                    [ 'value' => '00', 'name' => 'switch' ],
                    [ 'value' => '01', 'name' => 'meter' ],
                    [ 'value' => 'ff', 'name' => 'not connected' ]
                ] ],
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