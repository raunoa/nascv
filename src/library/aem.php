<?php

class aem
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

        $struct[ 24 ][ 'header' ] = [

            #main
            [ '_cnf' => [ 'repeat' => false ],
                'metering_data' => [ 'type' => 'uint32', 'unit' => 'L', 'formatter' => [
                    [ 'value' => 4294967295, 'name' => 'n/a' ],
                    [ 'value' => '*', 'name' => '%s %s' ]
                ] ],
                'battery' => [ 'type' => 'uint8', 'formatter' => ':battery:3.6' ],
                'temperature' => [ 'type' => 'int8', 'unit' => '°C', 'formatter' => '%s%s' ],
                'rssi' => [ 'type' => 'int8', 'unit' => 'dBm' ],
            ],
        ];

        

        


        # fport 25
        $struct[ 25 ] = [

            #packet type
            [ 'packet_type' => 'usage_packet' ],

            #main
            [ '_cnf' => [ 'repeat' => false ],
                'counter' => [ 'type' => 'uint32','unit' => 'L']
            ]
        ];

        # fport 50
        $struct[ 50 ] = [

            #packet type
            [ 'packet_type' => 'configuration_packet' ],

            #main
            [ '_cnf' => [ 'repeat' => false ],

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
                'reset_reason' => [ 'type' => 'byte', 'bits' => [ 'RFU', 'watchdog_reset', 'soft_reset', 'RFU', 'magnet_wakeup', 'RFU', 'RFU', 'nfc_wakeup' ] ]
                
            ],


            #shutdown_packet
            [ '_cnf' => [ 'repeat' => false, 'when' => [ [ 'packet_type' => 'shutdown_packet' ] ] ],
                'shutdown_reason' => [ 'type' => 'hex', 'formatter' => [
                    [ 'value' => '20', 'name' => 'hardware_error' ],
                    [ 'value' => '30', 'name' => 'lora_shutdown' ],
                    [ 'value' => '31', 'name' => 'magnet_shutdown' ],
                    [ 'value' => '32', 'name' => 'entering_dfu' ],
                ] ],
                '_struct' => $struct[ 24 ],
            ],
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