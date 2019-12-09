<?php
require_once 'components/registers.php';

class wml extends registers
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

            #header
            [ '_cnf' => [ 'repeat' => false ],
                'header' => [ 'type' => 'hex' ]
            ],

            #Payload bridge
            [ '_cnf' => [ 'repeat' => false, 'name' => 'bridge', 'when' => [ [ 'header' => '00' ] ] ],
                'time' => [ 'type' => 'uint32', 'unit' => 'UTC', 'formatter' => ':date(d.m.Y H:i:s)' ],
                'rssi' => [ 'type' => 'uint8', 'unit' => 'dBm', 'converter' => '*-1' ],
                'temp' => [ 'type' => 'int8', 'unit' => 'C' ],
                'battery' => [ 'type' => 'uint8', 'unit' => '' ],
                'status' => [ 'type' => 'byte', 'bits' => [
                    'grid_power' => [ false, true ] ] ],
                'connected_devices' => [ 'type' => 'uint8', 'unit' => '' ],
                'available devices' => [ 'type' => 'uint8', 'unit' => '' ],
            ],

            #Payload devices
            [ '_cnf' => [ 'repeat' => false, 'name' => 'device', 'when' => [ [ 'header' => '01' ] ] ],
                'time' => [ 'type' => 'uint8', 'unit' => 'UTC', 'formatter' => ':date10(H:i)' ],
                'time_diff' => [ 'type' => 'int8', 'unit' => 'min' ],
                'rssi' => [ 'type' => 'uint8', 'unit' => 'dBm', 'converter' => '*-1' ],
                'wmbus' => [ 'type' => 'hex', 'byte_order' => 'LSB', 'length' => '*',
                    'ext' => [ 'php-mbus', [ 'type' => 'wml_wmbus_frame_b' ] ],
                ]
            ],
        ];

        # fport 25

        $struct[ 25 ] = $struct[ 24 ];
        unset( $struct[ 25 ][ 3 ][ 'rssi' ] );

        # fport 49
        $struct[ 49 ] = [

            #packet type
            [ '_cnf' => [ 'repeat' => false, 'name' => 'packet_type', 'formatter' => '{packet_type:packet_type}' ],
                'packet_type' => [ 'type' => 'hex', 'formatter' => [
                    [ 'value' => '00', 'name' => 'reporting_interval' ],
                    [ 'value' => '01', 'name' => 'time' ],
                    [ 'value' => '02', 'name' => 'device_list' ],
                    [ 'value' => '03', 'name' => 'lost_alert' ],
                    [ 'value' => '04', 'name' => 'bridge_mode' ]
                ] ],
            ],

            #device list
            [ '_cnf' => [ 'repeat' => false, 'when' => [ [ 'packet_type' => 'device_list' ] ] ],
                [ '_cnf' => [ 'repeat' => false ],
                    'message' => [ 'type' => 'byte', 'bits' => [
                        [ 'bit' => '0-3', 'parameter' => 'current', 'type' => 'decimal' ],
                        [ 'bit' => '4-7', 'parameter' => 'total', 'type' => 'decimal' ]
                    ] ],
                ],

                [ '_cnf' => [ 'repeat' => true, 'name' => 'payload' ],
                    'serial' => [ 'type' => 'hex', 'length' => 4 ],
                ]

            ]


        ];


        # fport 53
        $struct[ 53 ] = [

            #packet type
            [ '_cnf' => [ 'repeat' => false, 'name' => 'packet_type', 'formatter' => '{packet_type:packet_type}' ],
                'packet_type' => [ 'type' => 'hex', 'formatter' => [
                    [ 'value' => '00', 'name' => 'wm_bus_discover' ],
                    [ 'value' => '01', 'name' => 'communication_lost' ]
                ] ],
            ],


            [ '_cnf' => [ 'repeat' => false ],
                'message' => [ 'type' => 'byte', 'bits' => [
                    [ 'bit' => '0-3', 'parameter' => 'current', 'type' => 'decimal' ],
                    [ 'bit' => '4-7', 'parameter' => 'total', 'type' => 'decimal' ]
                ] ],
            ],

            [ '_cnf' => [ 'repeat' => true, 'name' => 'payload' ],

                'mode' => [ 'type' => 'hex', 'formatter' => [
                    [ 'value' => '00', 'name' => 'S1' ],
                    [ 'value' => '01', 'name' => 'S1-m' ],
                    [ 'value' => '02', 'name' => 'S2' ],
                    [ 'value' => '03', 'name' => 'T1' ],
                    [ 'value' => '04', 'name' => 'T2' ],
                    [ 'value' => '05', 'name' => 'R2' ],
                    [ 'value' => '06', 'name' => 'C1 T-A' ],
                    [ 'value' => '07', 'name' => 'C1 T-B' ],
                    [ 'value' => '08', 'name' => 'C2 T-A' ],
                    [ 'value' => '09', 'name' => 'C2 T-B' ],
                ] ],
                'rssi' => [ 'type' => 'uint8', 'unit' => 'dBm', 'converter' => '*-1' ],
                'data_rate' => [ 'type' => 'byte', 'bits' => [
                    [ 'bit' => '0-3', 'parameter' => 'maximum_sf', 'type' => 'decimal' ],
                ] ],
                'serial' => [ 'type' => 'hex', 'length' => 4 ],

            ]


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
                'connected_devices' => [ 'type' => 'uint8' ],
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