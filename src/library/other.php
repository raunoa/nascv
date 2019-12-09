<?php
require_once 'components/registers.php';

class other extends registers
{

    public $nascv;

    /**
     * @return array
     */
    function rx_fport()
    {

        $struct = [];

        $struct[ 18 ] = [
            [ '_cnf' => [ 'repeat' => false ],
                # OK
                'wmbus' => [ 'type' => 'hex', 'byte_order' => 'LSB', 'length' => '*',
                    'ext' => [ 'php-mbus', [ 'type' => 'wmbus_frame_b' ] ],
                ]
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