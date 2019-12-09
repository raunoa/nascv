<?php

class lac
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
                'status' => [ 'type' => 'byte', 'bits' => [ 'lock' => [ 'open', 'close' ] ] ],
                'rssi' => [ 'type' => 'uint8', 'unit' => 'dBm', 'converter' => '*-1' ],
                'temp' => [ 'type' => 'uint8', 'unit' => 'C' ],
                'card_count' => [ 'type' => 'uint16' ],
            ]
        ];

        # fport 25
        $struct[ 25 ] = [

            #packet type
            [ 'packet_type' => 'usage_packet' ],

            #main
            [ '_cnf' => [ 'repeat' => false ],
                'status' => [ 'type' => 'byte', 'bits' =>
                    [ 'allowed' => [ 'no', 'yes' ],
                        'command' => [ 'no', 'yes' ] ] ],
                'card_number' => [ 'type' => 'hex', 'length' => 3 ],
                'time_closed' => [ 'type' => 'uint16', 'unit' => 'minutes' ],
            ]
        ];

        # fport 50
        $struct[ 50 ] = [

            #packet type
            [ 'packet_type' => 'configuration_packet' ],

            #header
            [ '_cnf' => [ 'repeat' => false ],
                'header' => [ 'type' => 'hex' ]
            ],

            #Status interval
            [ '_cnf' => [ 'repeat' => false, 'when' => [ [ 'header' => '00' ] ] ],
                'status_interval' => [ 'type' => 'uint16', 'unit' => 'minutes' ]
            ],

            #Open alert timer
            [ '_cnf' => [ 'repeat' => false, 'when' => [ [ 'header' => '01' ] ] ],
                'open_alert_timer' => [ 'type' => 'uint8', 'unit' => 'minutes' ]
            ],
            #Open time
            [ '_cnf' => [ 'repeat' => false, 'when' => [ [ 'header' => '02' ] ] ],
                'open_time' => [ 'type' => 'uint16', 'unit' => 'seconds' ]
            ],
            #Direction
            [ '_cnf' => [ 'repeat' => false, 'when' => [ [ 'header' => '03' ] ] ],
                'direction' => [ 'type' => 'hex', 'length' => 1, 'formatter' => [ [ 'value' => '00', 'name' => 'default_signal_on', 'value' => '01', 'name' => 'default_signal_off' ] ] ],
            ],
        ];


        # fport 50
        $struct[ 53 ] = [
            #packet type
            [ 'packet_type' => 'alert_packet' ],

            #header
            [ '_cnf' => [ 'repeat' => false ],
                'alert' => [ 'type' => 'hex', 'formatter' => [
                    [ 'value' => '01', 'name' => 'left_open' ],
                    [ 'value' => '02', 'name' => 'force_open' ]
                ] ]
            ],

            #left open
            [ '_cnf' => [ 'when' => [ [ 'alert' => '01' ] ] ],
                'status' => [ 'type' => 'byte', 'bits' => [  'alert' => [ 'cleared', 'raised' ]  ] ],
                'time_open' => [ 'type' => 'uint16', 'unit' => 'min' ]
            ],

            #force open
            [ '_cnf' => [ 'when' => [ [ 'alert' => '02' ] ] ],
                'status' => [ 'type' => 'byte', 'bits' => [  'alert' => [ 'cleared', 'raised' ]  ] ],
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
                'card_count' => [ 'type' => 'uint16' ],
                'switch_direction' => [ 'type' => 'hex' ]
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