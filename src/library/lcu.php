<?php

class lcu
{

    public $nascv;

    # structure by fport
    function rx_fport()
    {
        $struct = [];

        /** F24 */
        $struct[ 24 ] = [

            #packet type
            [ 'packet_type' => 'status_packet' ]
        ];

        $struct[ 24 ][ 'header' ] = [ '_cnf' => [ 'repeat' => false, 'name' => 'general' ],
            'device_unix_epoch' => [ 'type' => 'uint32', 'formatter' => ':date(d.m.Y H:i:s)' ],
            'status_field' => [ 'type' => 'byte', 'bits' =>
                [ 'dali_error_external' => [ 'ok', 'alert' ],
                    'dali_error_connection' => [ 'ok', 'alert' ],
                    'ldr_state' => [ 'off', 'on' ],
                    'thr_state' => [ 'off', 'on' ],
                    'dig_state' => [ 'off', 'on' ],
                    'hardware_error' => [ 'ok', 'error' ],
                    'software_error' => [ 'ok', 'error' ],
                    'relay_state' => [ 'off', 'on' ]
                ] ],
            'downlink_rssi' => [ 'type' => 'int8', 'unit' => 'dBm' ]
        ];

        $struct[ 24 ][ 'profiles' ] = [ '_cnf' => [ 'repeat' => true, 'name' => 'profiles' ],
            'profile_id' => [ 'type' => 'uint8' ],
            'profile_version' => [ 'type' => 'uint8' ],
            'dali_address_short' => [ 'type' => 'uint8' ],
            'days_active' => [ 'type' => 'byte', 'bits' =>
                [ 'holiday', 'mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'sun' ] ],
            'dim_level' => [ 'type' => 'uint8', 'unit' => '%' ]
        ];

        # firmware 0.7.0 updates
        if ($this->nascv->firmware >= 0.7) {

            # adding new lines to main
            $struct[ 24 ][ 'header' ][ 'temp' ] = [ 'type' => 'uint8', 'unit' => 'celsius' ];
            $struct[ 24 ][ 'header' ][ 'analog_mapping' ] = [ 'type' => 'byte', 'bits' => [ 'thr' => [ 'not reported', 'reported' ],
                'ldr' => [ 'not reported', 'reported' ] ] ];
            $struct[ 24 ][ 'header' ][ 'thr_value' ] = [ 'type' => 'uint8', 'when' => [ [ 'analog_mapping:thr' => 1 ] ] ];
            $struct[ 24 ][ 'header' ][ 'ldr_value' ] = [ 'type' => 'uint8', 'when' => [ [ 'analog_mapping:ldr' => 1 ] ] ];

        }


        /** F25 */
        $struct[ 25 ] = [

            #packet type
            [ 'packet_type' => 'usage_packet' ],

            #main
            [ '_cnf' => [ 'repeat' => false ],
                'cumulative_power_consumption' => [ 'type' => 'uint32', 'unit' => 'Wh' ],
                'current_consumption' => [ 'type' => 'uint16', 'unit' => 'W' ],
                'luminaire_burn_time' => [ 'type' => 'uint16', 'unit' => 'h' ],
                'system_voltage' => [ 'type' => 'uint8', 'unit' => 'V' ],
                'system_current' => [ 'type' => 'uint16', 'unit' => 'mA' ],
            ]
        ];

        if ($this->nascv->firmware >= 0.6) { # 0.6.20

            $struct[ 25 ] = [
                [ 'packet_type' => 'usage_packet' ],
                [ '_cnf' => [ 'repeat' => true, 'name' => 'consumption_data' ],
                    'dali_address' => [ 'type' => 'hex', 'formatter' => [
                        [ 'value' => 'ff', 'name' => 'internal_measurement' ]
                    ] ],
                    'reported_fields' => [ 'type' => 'byte', 'bits' =>
                        [ 'active_energy_total' => [ 'not sent', 'sent' ],
                            'active_energy_instant' => [ 'not sent', 'sent' ],
                            'load_side_energy_total' => [ 'not sent', 'sent' ],
                            'load_side_energy_instant' => [ 'not sent', 'sent' ],
                            'power_factor_instant' => [ 'not sent', 'sent' ],
                            'system_voltage' => [ 'not sent', 'sent' ]
                        ] ],
                    'active_energy_total' => [ 'type' => 'uint32', 'unit' => 'Wh',
                        'when' => [ [ 'reported_fields:active_energy_total' => 1 ] ] ],
                    'active_energy_instant' => [ 'type' => 'uint16', 'unit' => 'W',
                        'when' => [ [ 'reported_fields:active_energy_instant' => 1 ] ] ],
                    'load_side_energy_total' => [ 'type' => 'uint32', 'unit' => 'Wh',
                        'when' => [ [ 'reported_fields:load_side_energy_total' => 1 ] ] ],
                    'load_side_energy_instant' => [ 'type' => 'uint16', 'unit' => 'W',
                        'when' => [ [ 'reported_fields:load_side_energy_instant' => 1 ] ] ],
                    'power_factor_instant' => [ 'type' => 'uint8', 'converter' => '/100',
                        'when' => [ [ 'reported_fields:power_factor_instant' => 1 ] ] ],
                    'system_voltage' => [ 'type' => 'uint8', 'unit' => 'V',
                        'when' => [ [ 'reported_fields:system_voltage' => 1 ] ] ]
                ]
            ];
        }


        /** F50 */
        $struct[ 50 ] = [

            #packet type
            [ '_cnf' => [ 'repeat' => false, 'name' => 'packet_type', 'formatter' => '{packet_type:packet_type}' ],
                'packet_type' => [ 'type' => 'hex', 'formatter' => [
                    [ 'value' => '01', 'name' => 'ldr_config_packet' ],
                    [ 'value' => '02', 'name' => 'thr_config_packet' ],
                    [ 'value' => '03', 'name' => 'dig_config_packet' ],
                    [ 'value' => '05', 'name' => 'od_config_packet' ],
                    [ 'value' => '06', 'name' => 'calendar_config_packet' ],
                    [ 'value' => '07', 'name' => 'status_config_packet' ],
                    [ 'value' => '08', 'name' => 'profile_config_packet' ],
                    [ 'value' => '09', 'name' => 'time_config_packet' ],
                    [ 'value' => '0a', 'name' => 'defaults_config_packet' ],
                    [ 'value' => '0b', 'name' => 'usage_config_packet' ],
                    [ 'value' => '0c', 'name' => 'holiday_config_packet' ],
                    [ 'value' => '0d', 'name' => 'boot_delay_config_packet' ],

                ] ],
            ],
        ];


        #ldr_config_packet
        $struct[ 50 ][ 'ldr_config_packet' ] = [ '_cnf' => [ 'repeat' => false, 'when' => [ [ 'packet_type' => 'ldr_config_packet' ] ] ],
            [ '_cnf' => [ 'repeat' => false, 'name' => 'switch_thresholds' ],
                'high' => [ 'type' => 'uint8' ],
                'low' => [ 'type' => 'uint8' ],
            ],
            'switch_behaviour' => [ 'type' => 'byte', 'bits' =>
                [ 'switch_lights_on' => [ 'disabled', 'enabled' ],
                ] ],
        ];

        #thr_config_packet
        $struct[ 50 ][ 'thr_config_packet' ] = [ '_cnf' => [ 'repeat' => false, 'when' => [ [ 'packet_type' => 'thr_config_packet' ] ] ],
            [ '_cnf' => [ 'repeat' => false, 'name' => 'switch_thresholds' ],
                'high' => [ 'type' => 'uint8' ],
                'low' => [ 'type' => 'uint8' ],
            ],
            'switch_behaviour' => [ 'type' => 'byte', 'bits' =>
                [ 'switch_lights_on' => [ 'disabled', 'enabled' ],
                ] ],
        ];

        #dig_config_packet
        $struct[ 50 ][ 'dig_config_packet' ] = [ '_cnf' => [ 'repeat' => false, 'when' => [ [ 'packet_type' => 'dig_config_packet' ] ] ],
            'switch_time' => [ 'type' => 'uint16', 'unit' => 'seconds' ],
            'switch_behaviour' => [ 'type' => 'byte', 'bits' =>
                [ 'switch_lights_on' => [ 'disabled', 'enabled' ],
                ] ],
        ];

        #od_config_packet
        $struct[ 50 ][ 'od_config_packet' ] = [ '_cnf' => [ 'repeat' => false, 'when' => [ [ 'packet_type' => 'od_config_packet' ] ] ],
            'profile_id' => [ 'type' => 'uint8' ],
            'profile_version' => [ 'type' => 'uint8' ],
            'days_active' => [ 'type' => 'byte', 'bits' =>
                [ 'holiday', 'mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'sun' ] ],

            [ '_cnf' => [ 'repeat' => true, 'name' => 'dimming_step' ],
                'step_time' => [ 'type' => 'uint8' ],
                'dim_level' => [ 'type' => 'uint8' ],
            ]
        ];

        #calendar_config_packet
        $struct[ 50 ][ 'calendar_config_packet' ] = [ '_cnf' => [ 'repeat' => false, 'when' => [ [ 'packet_type' => 'calendar_config_packet' ] ] ],
            'sunrise_offset' => [ 'type' => 'int8' ],
            'sunset_offset' => [ 'type' => 'int8' ],
            'latitude' => [ 'type' => 'int16' ],
            'longitude' => [ 'type' => 'int16' ],

        ];

        #status_reporting_interval
        $struct[ 50 ][ 'status_config_packet' ] = [ '_cnf' => [ 'repeat' => false, 'when' => [ [ 'packet_type' => 'status_config_packet' ] ] ],
            'status_interval' => [ 'type' => 'uint32', 'unit' => 'seconds' ],
        ];

        #profile_config_packet
        $struct[ 50 ][ 'profile_config_packet' ] = [ '_cnf' => [ 'repeat' => false, 'when' => [ [ 'packet_type' => 'profile_config_packet' ] ] ],
            'profile_id' => [ 'type' => 'uint8' ],
            'profile_version' => [ 'type' => 'uint8' ],
            'dali_address_short' => [ 'type' => 'uint8' ],
            'days_active' => [ 'type' => 'byte', 'bits' =>
                [ 'holiday', 'mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'sun' ] ],

            [ '_cnf' => [ 'repeat' => true, 'name' => 'dimming_step' ],
                'step_time' => [ 'type' => 'uint8', 'formatter' => ':date10(H:i)' ],
                'dim_level' => [ 'type' => 'uint8' ],
            ]
        ];

        #time_config_packet
        $struct[ 50 ][ 'time_config_packet' ] = [ '_cnf' => [ 'repeat' => false, 'when' => [ [ 'packet_type' => 'time_config_packet' ] ] ],
            'device_unix_epoch' => [ 'type' => 'uint32', 'formatter' => ':date(d.m.Y H:i:s)' ],
        ];


        #defaults_config_packet
        $struct[ 50 ][ 'defaults_config_packet' ] = [ '_cnf' => [ 'repeat' => false, 'when' => [ [ 'packet_type' => 'defaults_config_packet' ] ] ],
            'default_dim' => [ 'type' => 'uint8', 'unit' => '%' ],
            'alert_behaviour' => [ 'type' => 'byte', 'bits' =>
                [ 'ldr_alert' => [ 'disabled', 'enabled' ],
                    'thr_alert' => [ 'disabled', 'enabled' ],
                    'dig_alert' => [ 'disabled', 'enabled' ],
                    'dali_alert' => [ 'disabled', 'enabled' ],
                ] ],
        ];


        #usage_config_packet
        $struct[ 50 ][ 'usage_config_packet' ] = [ '_cnf' => [ 'repeat' => false, 'when' => [ [ 'packet_type' => 'usage_config_packet' ] ] ],
            'usage_interval' => [ 'type' => 'uint32', 'unit' => 'seconds' ],
            'system_voltage' => [ 'type' => 'uint8', 'unit' => 'volts' ],
        ];

        #holiday_config_packet
        $struct[ 50 ][ 'holiday_config_packet' ] = [ '_cnf' => [ 'repeat' => false, 'when' => [ [ 'packet_type' => 'holiday_config_packet' ] ] ],
            [ '_cnf' => [ 'repeat' => true, 'name' => 'holiday' ],
                'day' => [ 'type' => 'uint16' ],
            ]
        ];


        #boot_delay_config_packet
        $struct[ 50 ][ 'boot_delay_config_packet' ] = [ '_cnf' => [ 'repeat' => false, 'when' => [ [ 'packet_type' => 'boot_delay_config_packet' ] ] ],
            'boot_delay_range' => [ 'type' => 'uint8', 'unit' => 'seconds' ],
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
                'clock' => [ 'type' => 'uint32', 'unit' => 'UTC', 'formatter' => ':date(d.m.Y H:i:s)' ],
                'hardware_config' => [ 'type' => 'hex', 'formatter' => [
                    [ 'value' => '00', 'name' => 'DALI only' ],
                    [ 'value' => '01', 'name' => 'DALI & NC relay' ],
                    [ 'value' => '02', 'name' => 'DALI & NO relay' ],
                    [ 'value' => '03', 'name' => '0..10v & NC relay' ],
                    [ 'value' => '04', 'name' => '0..10v & NO relay' ],
                    [ 'value' => '05', 'name' => 'DALI & 0..10V & NC relay' ],
                    [ 'value' => '06', 'name' => 'DALI & 0..10V & NO relay' ],
                    [ 'value' => '07', 'name' => 'DALI & 0..10V & NO relay & NC Relay (NC Active)' ],
                    [ 'value' => '08', 'name' => 'DALI & 0..10V & NO relay & NC Relay (NO Active)' ]
                ] ],
                'options' => [ 'type' => 'byte', 'bits' => [
                    'neutral_out' => [ 'no', 'yes' ],
                    'THR' => [ 'no', 'yes' ],
                    'DIG' => [ 'no', 'yes' ],
                    'LDR' => [ 'no', 'yes' ],
                    'OD' => [ 'no', 'yes' ],
                    'metering' => [ 'no', 'yes' ],
                    'extra_surge_protection' => [ 'no', 'yes' ],
                    'custom_request' => [ 'no', 'yes' ]
                ],
                ],
            ]

        ];


        return $struct;
    }

    /**
     * @return array
     */
    public
    function tx_fport()
    {
        $tx = self::rx_fport();
        return $tx;
    }

}