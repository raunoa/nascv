<?php

class lgm
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


        ];

        # fport 25
        $struct[ 25 ] = [

            #packet type
            [ 'packet_type' => 'usage_packet' ],

            [ '_cnf' => [ 'repeat' => 3, ],
                'mesuring_time' => [ 'type' => 'uint8' ],
                'metering_data' => [ 'type' => 'uint32', 'unit' => 'L' ],
            ],

            [ '_cnf' => [ 'repeat' => false, ],
                'elster_meter_id' => [ 'type' => 'hex', 'length' => 4 ],
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