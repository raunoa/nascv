<?php

require_once 'components/registers.php';

class klm extends registers
{

    public $nascv;

    # structure by fport
    function rx_fport()
    {
        $struct = [];

        # firmware 0.5.0 updates
        $struct[ 24 ] = [

            #packet type
            [ 'packet_type' => 'status_packet' ],

            #main
            [ '_cnf' => [ 'repeat' => false ],
                'rssi' => [ 'type' => 'int8', 'unit' => 'dBm', 'converter' => '*-1' ],
            ],

            [ '_cnf' => [ 'repeat' => true, 'name' => 'register' ],
                'register_id' => [ 'type' => 'uint8', 'formatter' => json_decode( $this->klm_register, true ) ],
                'register_value' => [ 'type' => 'uint32', 'unit' => '{register_id>_unit}', 'formatter' => '{register_id>_value_formatter}' ],
            ]
        ];


        # firmware 0.6.0 updates
        if ($this->nascv->firmware >= 0.6) {
            $struct[ 24 ][ 1 ] = [ '_cnf' => [ 'repeat' => false ],
                'measuring_time' => [ 'type' => 'uint8', 'unit' => 'UTC', 'formatter' => ':date10(H:i)' ],
                'clock' => [ 'type' => 'uint32', 'unit' => 'UTC', 'formatter' => ':date(d.m.Y H:i:s)', 'when' => [ [ 'measuring_time' => '<255' ] ] ],
                'rssi' => [ 'type' => 'int8', 'unit' => 'dBm', 'converter' => '*-1' ],
            ];

        }

        # firmware 0.7.0 updates
        if ($this->nascv->firmware >= 0.7) {
            $struct[ 24 ][ 1 ] = [ '_cnf' => [ 'repeat' => false ],
                'measuring_time' => [ 'type' => 'uint8', 'unit' => 'UTC', 'formatter' => ':date10(H:i)' ],
                'clock' => [ 'type' => 'uint32', 'unit' => 'UTC', 'formatter' => ':date(d.m.Y H:i:s)', 'when' => [ [ 'measuring_time' => '<255' ] ] ],
                'battery' => [ 'type' => 'uint8', 'formatter' => ':battery' ],
                'rssi' => [ 'type' => 'int8', 'unit' => 'dBm', 'converter' => '*-1' ],
            ];

            $struct[ 24 ][ 2 ] = [ '_cnf' => [ 'repeat' => true, 'name' => 'register' ],
                'register_id' => [ 'type' => 'uint8', 'formatter' => json_decode( $this->klm_register, true ) ],
                'register_value' => [ 'type' => 'float', 'unit' => '{register_id>_unit}', 'formatter' => '{register_id>_value_formatter}' ],
            ];
        }

        # firmware 0.9.0 updates
        if ($this->nascv->firmware >= 0.9) {
            $struct[ 24 ][ 2 ]['register_value'] = [ 'type' => '{register_id>_value_type}', 'unit' => '{register_id>_unit}', 'formatter' => '{register_id>_value_formatter}' ];
        }

        # firmware 0.5.0 updates
        $struct[ 25 ] = [

            #packet type
            [ 'packet_type' => 'usage_packet' ],

            #main
            [ '_cnf' => [ 'repeat' => false ],
                'header' => [ 'type' => 'hex' ],
            ],

            [ '_cnf' => [ 'repeat' => true, 'name' => 'register', 'when' => [ [ 'header' => '00' ] ] ],
                'register_id' => [ 'type' => 'uint8', 'formatter' => json_decode( $this->klm_register, true ) ],
                'register_value' => [ 'type' => 'float', 'unit' => '{register_id>_unit}', 'formatter' => '{register_id>_value_formatter}' ],
            ],

            [ '_cnf' => [ 'repeat' => false, 'when' => [ [ 'header' => '02' ] ] ],
                'measuring_time' => [ 'type' => 'uint8' ],
                [ '_cnf' => [ 'repeat' => false, 'pulse_count' ],
                    '1' => [ 'type' => 'uint32' ],
                    '2' => [ 'type' => 'uint32' ],
                ]
            ]
        ];


        # firmware 0.7.0
        if ($this->nascv->firmware >= 0.7) {
            $mesuring = [ '_cnf' => [ 'repeat' => false, 'when' => [ [ 'header' => '00' ] ] ],
                'measuring_time' => [ 'type' => 'uint8', 'unit' => 'UTC', 'formatter' => ':date10(H:i)' ]
            ];
            array_splice( $struct[ 25 ], 2, 0, [ $mesuring ] );

        }

        # firmware 0.9.0 updates
        if ($this->nascv->firmware >= 0.9) {
            $struct[ 25 ][ 2 ]['register_value'] = [ 'type' => '{register_id>_value_type}', 'unit' => '{register_id>_unit}', 'formatter' => '{register_id>_value_formatter}' ];
        }


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
                'kamstrup_meter_id' => [ 'type' => 'uint32' ],
                'kamstrup_config_a' => [ 'type' => 'hex', 'length' => 4 ],
                'kamstrup_config_b' => [ 'type' => 'hex', 'length' => 7, ],
                'kamstrup_type' => [ 'type' => 'hex', 'length' => 4, ],
                'device_mode' => [ 'type' => 'byte' ],
                'clock' => [ 'type' => 'uint32' ],
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
        $tx = (self::rx_fport);
        return $tx;
    }

}