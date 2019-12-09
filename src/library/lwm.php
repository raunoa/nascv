<?php
require_once 'components/registers.php';

class lwm extends registers
{

    public $nascv;

    /**
     * Capability structure for LWM
     * @return array
     */
    public function capability_structure()
    {
        $base = $this->capability_base_structure;

        $upn = $this->nascv->product_upn;

        $base[ 'data' ] = array_merge( $base[ 'data' ], [
            'accumulated_volume' => [ 'available' => true ],
            'flow_rate' => [ 'available' => false ],
            'flow_rate_max' => [ 'available' => false ],
            'flow_rate_min' => [ 'available' => false ],
            'water_temperature' => [ 'available' => false ],
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
            'reverse_flow_alert' => [ 'available' => true ],
            'leak_alert' => [ 'available' => true ],
            'burst_alert' => [ 'available' => true ] ] );

        if ($upn != 'CM3021') {
            $base[ 'event' ][ 'burst_alert' ] = [ 'available' => false ];
        }

        return $base;
    }

    # structure by fport
    function rx_fport()
    {

        $struct = [];

        # fport 18
        $struct[ 18 ] = [
            [ '_cnf' => [ 'repeat' => false ],
                'wmbus' => [ 'type' => 'hex', 'byte_order' => 'LSB', 'length' => '*',
                    'ext' => [ 'php-mbus', [ 'type' => 'wmbus_frame_b' ] ],
                    'metering' => [
                        [ 'tag' => 'accumulated_volume', 'path' => 'data_records:*:_header_raw=0413' ],
                        [ 'tag' => 'flow_rate_max', 'path' => 'data_records:*:_header_raw=523b' ]
                    ]
                ],
            ] ];

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
                'mode' => [ 'type' => 'byte' ],
                'alerts' => [ 'type' => 'byte' ]
            ],
        ];

        $struct[ 24 ][ 'debug' ] = [
            [ '_cnf' => [ 'repeat' => false ],
                'noise' => [ 'type' => 'uint8' ],
                'accumulated_delta' => [ 'type' => 'uint16' ],
            ],

            [ '_cnf' => [ 'repeat' => 2, 'name' => 'dec' ],
                [ 'type' => 'uint16' ],
            ],


            [ '_cnf' => [ 'repeat' => false, 'name' => 'afe_1' ],
                'min' => [ 'type' => 'uint16' ],
                'max' => [ 'type' => 'uint16' ]
            ],

            [ '_cnf' => [ 'repeat' => false, 'name' => 'afe_2' ],
                'min' => [ 'type' => 'uint16' ],
                'max' => [ 'type' => 'uint16' ]
            ]
        ];

        if ($this->nascv->firmware >= 0.2 && $this->nascv->firmware_patch >= 26) {
            unset ( $struct[ 24 ][ 'debug' ] );

            $struct[ 24 ][ 'debug' ] = [
                [ '_cnf' => [ 'repeat' => false, 'name' => 'afe_1_min' ],
                    'ch1' => [ 'type' => 'uint16' ],
                    'ch2' => [ 'type' => 'uint16' ],
                    'ch3' => [ 'type' => 'uint16' ],
                ],
                [ '_cnf' => [ 'repeat' => false, 'name' => 'afe_1_max' ],
                    'ch1' => [ 'type' => 'uint16' ],
                    'ch2' => [ 'type' => 'uint16' ],
                    'ch3' => [ 'type' => 'uint16' ],
                ],
                [ '_cnf' => [ 'repeat' => false, 'name' => 'afe_2_min' ],
                    'ch1' => [ 'type' => 'uint16' ],
                    'ch2' => [ 'type' => 'uint16' ],
                    'ch3' => [ 'type' => 'uint16' ],
                ],
                [ '_cnf' => [ 'repeat' => false, 'name' => 'afe_2_max' ],
                    'ch1' => [ 'type' => 'uint16' ],
                    'ch2' => [ 'type' => 'uint16' ],
                    'ch3' => [ 'type' => 'uint16' ],
                ],
                [ '_cnf' => [ 'repeat' => false, 'name' => 'recalib_delta' ],
                    'ch1' => [ 'type' => 'int8' ],
                    'ch2' => [ 'type' => 'int8' ],
                    'ch3' => [ 'type' => 'int8' ],
                ],
                [ '_cnf' => [ 'repeat' => false, 'name' => 'initial_noise' ],
                    'ch1' => [ 'type' => 'uint8' ],
                    'ch2' => [ 'type' => 'uint8' ],
                    'ch3' => [ 'type' => 'uint8' ],
                ],
                [ '_cnf' => [ 'repeat' => false ],
                    'error_count' => [ 'type' => 'uint16' ],
                ],
            ];
        }


        # fport 25
        $struct[ 25 ] = [

            #packet type
            [ 'packet_type' => 'usage_packet' ],

            #main
            [ '_cnf' => [ 'repeat' => false ],

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
                'reset_reason' => [ 'type' => 'byte', 'bits' => [ 'RFU', 'watchdog_reset', 'soft_reset', 'RFU', 'magnet_wakeup', 'RFU', 'RFU', 'nfc_wakeup' ] ],
                'calibration_debug ' => [ 'type' => 'hex', 'length' => 8, 'byte_order' => 'LSB' ],
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