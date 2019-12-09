<?php
/*
 * NAS Converters TESTER
 * @author Rauno Avel
 * @copyright NAS 2019
 */

ini_set( 'display_errors', 1 );
ini_set( 'display_startup_errors', 1 );
error_reporting( E_ALL );

ini_set( 'memory_limit', '256M' );

$tests = [

    /*
    *
    * AEM
    *
    */
    'AEM f24 (status_packet)' => [ 'request' =>
        [ 'data' => 'iv4BACUSpRBAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA', 'fport' => '24', 'serial' => '50860012' ],
        'results' =>
            '{"packet_type":"status_packet","metering_data":{"value":130698,"formatted":"130698 L","_unit":"L"},"battery":{"value":2.81,"formatted":"2.81 V","value_raw":37,"_unit":"V"},"temperature":{"value":18,"formatted":"18\u00b0C","_unit":"\u00b0C"},"rssi":{"value":-91,"formatted":"-91 dBm","_unit":"dBm"},"hex":"8afe01002512a51040000000000000000000000000000000000000000000000000000000000000000000000000"}' ],

    'AEM f25 (status_packet)' => [ 'request' =>
        [ 'data' => 'iv4BAA==', 'fport' => '25', 'serial' => '50860012' ],
        'results' =>
            '{"packet_type":"usage_packet","counter":{"value":130698,"_unit":"L","formatted":"130698 L"},"hex":"8afe0100"}' ],

    'AEM f99 (boot_packet)' => [ 'request' =>
        [ 'data' => 'ABIAhlAAAicE', 'fport' => '99', 'serial' => '50860012' ],
        'results' =>
            '{"packet_type":"boot_packet","device_serial":"50860012","firmware_version":"0.2.39","reset_reason":["soft_reset"],"hex":"001200865000022704"}' ],

    'AEM f99 (shutdown_packet)' => [ 'request' =>
        [ 'data' => 'ATGK/gEAJBKcEAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA=', 'fport' => '99', 'serial' => '50860012' ],
        'results' =>
            '{"packet_type":"shutdown_packet","shutdown_reason":{"value":"31","formatted":"magnet_shutdown"},"metering_data":{"value":130698,"_unit":"L","formatted":"130698 L"},"battery":{"value":2.80600000000000004973799150320701301097869873046875,"_unit":"V","formatted":"2.806 V","value_raw":36},"temperature":{"value":18,"_unit":"\u00b0C","formatted":"18\u00b0C"},"rssi":{"value":-100,"_unit":"dBm","formatted":"-100 dBm"},"hex":"01318afe010024129c1000000000000000000000000000000000000000000000000000000000000000000000000000"}' ],

    'AEM f99 (boot_packet_nfc)' => [ 'request' =>
        [ 'data' => 'ABIAhlAAAieA', 'fport' => '99', 'serial' => '50860012' ],
        'results' =>
            '{"packet_type":"boot_packet","device_serial":"50860012","firmware_version":"0.2.39","reset_reason":["nfc_wakeup"],"hex":"001200865000022780"}' ],
    //AEM 1.0 *************************************************************************
    'AEM f24 (status_packet) 3.0' => [ 'request' =>
        [ 'data' => 'ASAA/3cSAKYHiv4BAA==', 'fport' => '24', 'serial' => '50860012', 'firmware' => '1.0.0' ],
        'results' =>
            '{"packet_type":"status_packet","general":{"_fixed_metering":{"value":0,"formatted":"disabled"},"_debug_info":{"value":0,"formatted":"not_sent"},"packet_reason_app":{"value":1,"formatted":"true"},"packet_reason_magnet":{"value":0,"formatted":"false"},"packet_reason_alert":{"value":0,"formatted":"false"}},"active_alerts":{"reverse_flow_detected":{"value":0,"formatted":"false"},"burst":{"value":0,"formatted":"false"},"leak":{"value":0,"formatted":"false"},"tamper":{"value":0,"formatted":"false"},"temperature_alert":{"value":0,"formatted":"false"},"battery":{"value":0,"formatted":"false"}},"battery_percentage":{"value":255,"formatted":"not_available","_unit":"%"},"battery_voltage":{"value":3.138,"formatted":"3.138 V","value_raw":119,"_unit":"V"},"mcu_temperature":{"value":18,"formatted":"18\u00b0C","_unit":"\u00b0C"},"temp_extremes":{"min_offset":{"value":0,"formatted":"-36 \u00b0C"},"max_offset":{"value":0,"formatted":"36 \u00b0C"}},"downlink_rssi":{"value":-166,"formatted":"-166 dBm","_unit":"dBm"},"downlink_snr":{"value":7,"formatted":"7 dB","_unit":"dB"},"accumulated_volume":{"value":130698,"formatted":"130698 L","_unit":"L"},"hex":"012000ff771200a6078afe0100"}' ],

    'AEM f99 (boot_packet)3.0' => [ 'request' =>
        [ 'data' => 'ABIAhlAAAwAEgAUAAA==', 'fport' => '99', 'serial' => '50860012', 'firmware' => '1.0.0' ],
        'results' =>
            '{"packet_type":"boot_packet","device_serial":"50860012","firmware_version":"0.3.0","reset_reason":["soft_reset"],"general_info ":{"configuration_restored":{"value":1,"formatted":"true"}},"hardware_config ":{"value":"05","formatted":"AEM_Water_int"},"sensor_fw_version":{"value":"0000","formatted":"not_available"},"hex":"00120086500003000480050000"}' ],

    'AEM f50 (reporting_conf_packet)0.1.0' => [ 'request' =>
        [ 'data' => 'AAc8ANACAQ==', 'fport' => '50', 'serial' => '50860012', 'firmware' => '1.0.0' ],
        'results' =>
            '{"packet_type":"reporting_config_packet","_configured_parameters":{"usage_interval":{"value":1,"formatted":"configured"},"status_interval":{"value":1,"formatted":"configured"},"behaviour":{"value":1,"formatted":"configured"},"fixed_measuring_interval":{"value":0,"formatted":"not_configured"}},"usage_interval":{"value":60,"_unit":"minutes","formatted":"60 minutes"},"status_interval":{"value":720,"_unit":"minutes","formatted":"720 minutes"},"behaviour":{"send_usage":{"value":1,"formatted":"always"},"include_previous_usage":{"value":0,"formatted":"false"}},"hex":"00073c00d00201"}' ],


    /*
    *
    * LCU
    *
    */

    'LCU f24 (status_packet)' => [ 'request' =>
        [ 'data' => 'SnUOXACfRAIE/zJEBQr/MkQBAv8ARAQI/wBEAwb/AEQGDP8A', 'fport' => '24', 'serial' => '4d1b0092' ],
        'results' =>
            '{"packet_type":"status_packet","general":{"device_unix_epoch":{"value":"10.12.2018 14:16:42","formatted":"10.12.2018 14:16:42 ","value_raw":1544451402},"status_field":{"dali_error_external":{"value":"0","formatted":"ok"},"dali_error_connection":{"value":"0","formatted":"ok"},"ldr_state":{"value":"0","formatted":"off"},"thr_state":{"value":"0","formatted":"off"},"dig_state":{"value":"0","formatted":"off"},"hardware_error":{"value":"0","formatted":"ok"},"software_error":{"value":"0","formatted":"ok"},"relay_state":{"value":"0","formatted":"off"}},"downlink_rssi":{"value":-97,"_unit":"dBm","formatted":"-97 dBm"}},"profiles":[{"profile_id":{"value":68,"formatted":"68 "},"profile_version":{"value":2,"formatted":"2 "},"dali_address_short":{"value":4,"formatted":"4 "},"days_active":["holiday","mon","tue","wed","thu","fri","sat","sun"],"dim_level":{"value":50,"_unit":"%","formatted":"50 %"}},{"profile_id":{"value":68,"formatted":"68 "},"profile_version":{"value":5,"formatted":"5 "},"dali_address_short":{"value":10,"formatted":"10 "},"days_active":["holiday","mon","tue","wed","thu","fri","sat","sun"],"dim_level":{"value":50,"_unit":"%","formatted":"50 %"}},{"profile_id":{"value":68,"formatted":"68 "},"profile_version":{"value":1,"formatted":"1 "},"dali_address_short":{"value":2,"formatted":"2 "},"days_active":["holiday","mon","tue","wed","thu","fri","sat","sun"],"dim_level":{"value":0,"_unit":"%","formatted":"0 %"}},{"profile_id":{"value":68,"formatted":"68 "},"profile_version":{"value":4,"formatted":"4 "},"dali_address_short":{"value":8,"formatted":"8 "},"days_active":["holiday","mon","tue","wed","thu","fri","sat","sun"],"dim_level":{"value":0,"_unit":"%","formatted":"0 %"}},{"profile_id":{"value":68,"formatted":"68 "},"profile_version":{"value":3,"formatted":"3 "},"dali_address_short":{"value":6,"formatted":"6 "},"days_active":["holiday","mon","tue","wed","thu","fri","sat","sun"],"dim_level":{"value":0,"_unit":"%","formatted":"0 %"}},{"profile_id":{"value":68,"formatted":"68 "},"profile_version":{"value":6,"formatted":"6 "},"dali_address_short":{"value":12,"formatted":"12 "},"days_active":["holiday","mon","tue","wed","thu","fri","sat","sun"],"dim_level":{"value":0,"_unit":"%","formatted":"0 %"}}],"hex":"4a750e5c009f440204ff3244050aff32440102ff00440408ff00440306ff0044060cff00"}' ],

    'LCU f25 (usage_packet)' => [ 'request' =>
        [ 'data' => '8ksDADMAVhM=', 'fport' => '25', 'serial' => '4d1b0092' ],
        'results' => '{"packet_type":"usage_packet","cumulative_power_consumption":{"value":216050,"_unit":"Wh","formatted":"216050 Wh"},"current_consumption":{"value":51,"_unit":"W","formatted":"51 W"},"luminaire_burn_time":{"value":4950,"_unit":"h","formatted":"4950 h"},"hex":"f24b030033005613"}' ],

    'LCU f25 (usage_packet) fw0.6.20' => [ 'request' =>
        [ 'data' => '/wMAAAAAAAAEA80PAAAAAAUDcg4AAAAABgM+DgAAAAAHAwsOAAAAAA==', 'fport' => '25', 'serial' => '4e1500bc', 'firmware' => '0.6.20' ],
        'results' => '{"packet_type":"usage_packet","consumption_data":[{"dali_address":{"value":"ff","formatted":"internal_measurement"},"reported_fields":{"active_energy_total":{"value":"1","formatted":"sent"},"active_energy_instant":{"value":"1","formatted":"sent"},"load_side_energy_total":{"value":"0","formatted":"not sent"},"load_side_energy_instant":{"value":"0","formatted":"not sent"},"power_factor_instant":{"value":"0","formatted":"not sent"},"system_voltage":{"value":"0","formatted":"not sent"}},"active_energy_total":{"value":0,"_unit":"Wh","formatted":"0 Wh"},"active_energy_instant":{"value":0,"_unit":"W","formatted":"0 W"}},{"dali_address":{"value":"04"},"reported_fields":{"active_energy_total":{"value":"1","formatted":"sent"},"active_energy_instant":{"value":"1","formatted":"sent"},"load_side_energy_total":{"value":"0","formatted":"not sent"},"load_side_energy_instant":{"value":"0","formatted":"not sent"},"power_factor_instant":{"value":"0","formatted":"not sent"},"system_voltage":{"value":"0","formatted":"not sent"}},"active_energy_total":{"value":4045,"_unit":"Wh","formatted":"4045 Wh"},"active_energy_instant":{"value":0,"_unit":"W","formatted":"0 W"}},{"dali_address":{"value":"05"},"reported_fields":{"active_energy_total":{"value":"1","formatted":"sent"},"active_energy_instant":{"value":"1","formatted":"sent"},"load_side_energy_total":{"value":"0","formatted":"not sent"},"load_side_energy_instant":{"value":"0","formatted":"not sent"},"power_factor_instant":{"value":"0","formatted":"not sent"},"system_voltage":{"value":"0","formatted":"not sent"}},"active_energy_total":{"value":3698,"_unit":"Wh","formatted":"3698 Wh"},"active_energy_instant":{"value":0,"_unit":"W","formatted":"0 W"}},{"dali_address":{"value":"06"},"reported_fields":{"active_energy_total":{"value":"1","formatted":"sent"},"active_energy_instant":{"value":"1","formatted":"sent"},"load_side_energy_total":{"value":"0","formatted":"not sent"},"load_side_energy_instant":{"value":"0","formatted":"not sent"},"power_factor_instant":{"value":"0","formatted":"not sent"},"system_voltage":{"value":"0","formatted":"not sent"}},"active_energy_total":{"value":3646,"_unit":"Wh","formatted":"3646 Wh"},"active_energy_instant":{"value":0,"_unit":"W","formatted":"0 W"}},{"dali_address":{"value":"07"},"reported_fields":{"active_energy_total":{"value":"1","formatted":"sent"},"active_energy_instant":{"value":"1","formatted":"sent"},"load_side_energy_total":{"value":"0","formatted":"not sent"},"load_side_energy_instant":{"value":"0","formatted":"not sent"},"power_factor_instant":{"value":"0","formatted":"not sent"},"system_voltage":{"value":"0","formatted":"not sent"}},"active_energy_total":{"value":3595,"_unit":"Wh","formatted":"3595 Wh"},"active_energy_instant":{"value":0,"_unit":"W","formatted":"0 W"}}],"hex":"ff030000000000000403cd0f000000000503720e0000000006033e0e0000000007030b0e00000000"}' ],


    'LCU f50 (configuration_packet - ldr_config_packet)' => [ 'request' =>
        [ 'data' => 'Af4y', 'fport' => '50', 'serial' => '4d1b0092' ],
        'results' => '{"packet_type":"ldr_config_packet","switch_thresholds":{"high":{"value":254,"formatted":"254 "},"low":{"value":50,"formatted":"50 "}},"hex":"01fe32"}' ],

    'LCU f50 (configuration_packet - profile_config_packet)' => [ 'request' =>
        [ 'data' => 'CAIGDP9LMngUigA=', 'fport' => '50', 'serial' => '4d1b0092' ],
        'results' => '{"packet_type":"profile_config_packet","profile_id":{"value":2,"formatted":"2 "},"profile_version":{"value":6,"formatted":"6 "},"dali_address_short":{"value":12,"formatted":"12 "},"days_active":["holiday","mon","tue","wed","thu","fri","sat","sun"],"dimming_step":[{"step_time":{"value":"12:30","formatted":"12:30 ","value_raw":75},"dim_level":{"value":50,"formatted":"50 "}},{"step_time":{"value":"20:00","formatted":"20:00 ","value_raw":120},"dim_level":{"value":20,"formatted":"20 "}},{"step_time":{"value":"23:00","formatted":"23:00 ","value_raw":138},"dim_level":{"value":0,"formatted":"0 "}}],"hex":"0802060cff4b3278148a00"}' ],

    'LCU f50 (configuration_packet - calendar_config_packet)' => [ 'request' =>
        [ 'data' => 'BuIeORecCQ==', 'fport' => '50', 'serial' => '4d1b0092' ],
        'results' => '{"packet_type":"calendar_config_packet","sunrise_offset":{"value":-30,"formatted":"-30 "},"sunset_offset":{"value":30,"formatted":"30 "},"latitude":{"value":5945,"formatted":"5945 "},"longitude":{"value":2460,"formatted":"2460 "},"hex":"06e21e39179c09"}' ],


    'LCU f50 (configuration_packet - time_config_packet)' => [ 'request' =>
        [ 'data' => 'CXBPp1w=', 'fport' => '50', 'serial' => '4d1b0092' ],
        'results' => '{"packet_type":"time_config_packet","device_unix_epoch":{"value":"05.04.2019 12:52:00","formatted":"05.04.2019 12:52:00 ","value_raw":1554468720},"hex":"09704fa75c"}' ],


    'LCU f50 (configuration_packet - dig_config_packet)' => [ 'request' =>
        [ 'data' => 'AwoAAQ==', 'fport' => '50', 'serial' => '4d1b0092' ],
        'results' => '{"packet_type":"dig_config_packet","switch_time":{"value":10,"_unit":"seconds","formatted":"10 seconds"},"switch_behaviour":{"switch_lights_on":{"value":"1","formatted":"enabled"}},"hex":"030a0001"}' ],

    'LCU f50 (configuration_packet - status_config_packet)' => [ 'request' =>
        [ 'data' => 'BwgHAAA=', 'fport' => '50', 'serial' => '4d1b0092' ],
        'results' => '{"packet_type":"status_config_packet","status_interval":{"value":1800,"_unit":"seconds","formatted":"1800 seconds"},"hex":"0708070000"}' ],

    'LCU f50 (configuration_packet - usage_config_packet)' => [ 'request' =>
        [ 'data' => 'CwgHAADm', 'fport' => '50', 'serial' => '4d1b0092' ],
        'results' => '{"packet_type":"usage_config_packet","usage_interval":{"value":1800,"_unit":"seconds","formatted":"1800 seconds"},"system_voltage":{"value":230,"_unit":"volts","formatted":"230 volts"},"hex":"0b08070000e6"}' ],
    

    

    'LCU f99 (boot_packet)' => [ 'request' =>
        [ 'data' => 'APQAHE0ABYkPFVRcAa0=', 'fport' => '99', 'serial' => '4d1b0092' ],
        'results' => '{"packet_type":"boot_packet","device_serial":"4d1c00f4","firmware_version":"0.5.137","clock":{"value":"01.02.2019 09:44:47","_unit":"UTC","formatted":"01.02.2019 09:44:47 UTC","value_raw":1549014287},"hardware_config":{"value":"01","formatted":"DALI & NC relay"},"options":{"neutral_out":{"value":"1","formatted":"yes"},"THR":{"value":"0","formatted":"no"},"DIG":{"value":"1","formatted":"yes"},"LDR":{"value":"1","formatted":"yes"},"OD":{"value":"0","formatted":"no"},"metering":{"value":"1","formatted":"yes"},"extra_surge_protection":{"value":"0","formatted":"no"},"custom_request":{"value":"1","formatted":"yes"}},"hex":"00f4001c4d0005890f15545c01ad"}' ],


    /**
     *
     * PMG
     *
     */
    'PMG f24 (status_packet)' => [ 'request' =>
        [ 'data' => 'AZqpnkNJw+hdAAAA', 'fport' => '24', 'serial' => '34103412' ],
        'results' => '{"packet_type":"status_packet","general":{"relay_state":{"value":1,"formatted":"on"},"relay_switched_packet":{"value":0,"formatted":false},"counter_reset_packet":{"value":0,"formatted":false}},"accumulated_energy":{"value":317.32501220703125,"_unit":"kWh","formatted":"317.325 kWh"},"instant":{"frequency":{"value":49.993,"_unit":"Hz","formatted":"49.993 Hz"},"voltage":{"value":240.4,"_unit":"V","formatted":"240.4 V"},"power":{"value":0,"_unit":"W","formatted":"0 W"}},"rssi":{"value":0,"_unit":"dBm","formatted":"0 dBm"},"hex":"019aa99e4349c3e85d000000"}' ],

    'PMG f25 (usage_packet)' => [ 'request' =>
        [ 'data' => 'LlJ7R2wA', 'fport' => '25', 'serial' => '34103412' ],
        'results' => '{"packet_type":"usage_packet","accumulated_energy":{"value":64338.1796875,"_unit":"kWh","formatted":"64338.180 kWh"},"power":{"value":10.8,"_unit":"W","formatted":"10.8 W"},"hex":"2e527b476c00"}' ],

    'PMG f99 (boot_packet)' => [ 'request' =>
        [ 'data' => 'AP////8AAgD//w==', 'fport' => '99', 'serial' => '34103412' ],
        'results' => '{"packet_type":"boot_packet","device_serial":"ffffffff","firmware_version":"0.2.0","extension_module_0":{"value":"ff","formatted":"not connected"},"extension_module_1":{"value":"ff","formatted":"not connected"},"hex":"00ffffffff000200ffff"}' ],


    /**
     *
     * GM1
     *
     */

    'GM1 f24 (status_packet)' => [ 'request' =>
        [ 'data' => 'A48UfECB9QgCEgAAAAA=', 'fport' => '24', 'serial' => '4E1B0018' ],
        'results' => '{"packet_type":"status_packet","header":{"interface":{"value":"03","formatted":"gas meter"},"user_triggered_packet":{"value":"0","formatted":"no"},"temperature_triggered_packet":{"value":"0","formatted":"no"}},"battery_index":{"value":3.234,"_unit":"V","formatted":"3.234 V","value_raw":143},"mcu_temp":{"value":20,"_unit":"\u00b0C","formatted":"20\u00b0C"},"downlink_rssi":{"value":-124,"_unit":"dBm","formatted":"-124 dBm"},"gas":{"settings":{"input_state":{"value":"0","formatted":false},"operational_mode":{"value":"0","formatted":"counter"},"medium_type":{"value":"04","formatted":"_gas"}},"counter":{"value":34141569,"_unit":"L","formatted":"34141569 L"}},"tamper":{"settings":{"input_state":{"value":"0","formatted":false},"operational_mode":{"value":"1","formatted":"trigger_mode"},"is_alert":{"value":"0","formatted":"no"},"medium_type":{"value":"01","formatted":"events_"}},"counter":{"value":0,"_unit":"events","formatted":"0 events"}},"hex":"038f147c4081f508021200000000"}' ],

    'GM1 f24 (status_packet)0.8.0 - 0.8.2' => [ 'request' =>
        [ 'data' => 'A2YQ4INApAYAABIAAAAA', 'fport' => '24', 'serial' => '4E1B0018', 'firmware' => '0.8.1' ],
        'results' => '{"packet_type":"status_packet","header":{"interface":{"value":3,"formatted":"gas meter"},"user_triggered_packet":{"value":0,"formatted":"no"},"active_alerts":{"value":0,"formatted":"no"}},"battery_index":{"value":3.069999999999999840127884453977458178997039794921875,"_unit":"V","formatted":"3.07 V","value_raw":102},"mcu_temperature":{"value":16,"_unit":"\u00b0C","formatted":"16\u00b0C"},"temp_extremes":{"min_offset":{"value":0,"formatted":"0\u00b0C"},"max_offset":{"value":28,"formatted":"28\u00b0C"}},"downlink_rssi":{"value":-131,"_unit":"dBm","formatted":"-131 dBm"},"gas":{"settings":{"input_state":{"value":0,"formatted":false},"operational_mode":{"value":0,"formatted":"counter"},"medium_type":{"value":4,"formatted":"_gas"}},"counter":{"value":1700,"_unit":"L","formatted":"1700 L"}},"tamper":{"settings":{"input_state":{"value":0,"formatted":false},"operational_mode":{"value":1,"formatted":"trigger_mode"},"is_alert":{"value":0,"formatted":"no"},"medium_type":{"value":1,"formatted":"events_"}},"counter":{"value":0,"_unit":"events","formatted":"0 events"}},"hex":"036610e08340a40600001200000000"}' ],

    'GM1 f24 (status_packet)fw0.8' => [ 'request' =>
        [ 'data' => 'Q/98GABWQAAAAAASAAAAAA==', 'fport' => '24', 'serial' => '4e1b0054', 'firmware' => '0.8' ],
        'results' => '{"packet_type":"status_packet","header":{"interface":{"value":3,"formatted":"gas meter"},"user_triggered_packet":{"value":1,"formatted":"yes"},"active_alerts":{"value":0,"formatted":"no"}},"battery_percentage":{"value":"255","_unit":"%","formatted":"not_available"},"battery_index":{"value":3.157999999999999918287585387588478624820709228515625,"_unit":"V","formatted":"3.158 V","value_raw":124},"mcu_temperature":{"value":24,"_unit":"\u00b0C","formatted":"24\u00b0C"},"temp_extremes":{"min_offset":{"value":0,"formatted":"0\u00b0C"},"max_offset":{"value":0,"formatted":"0\u00b0C"}},"downlink_rssi":{"value":-86,"_unit":"dBm","formatted":"-86 dBm"},"gas":{"settings":{"input_state":{"value":0,"formatted":false},"operational_mode":{"value":0,"formatted":"counter"},"device_serial_sent":{"value":0,"formatted":"not_sent"},"medium_type":{"value":4,"formatted":"_gas"}},"counter":{"value":0,"_unit":"L","formatted":"0 L"}},"tamper":{"settings":{"input_state":{"value":0,"formatted":false},"operational_mode":{"value":1,"formatted":"trigger_mode"},"is_alert":{"value":0,"formatted":"no"},"medium_type":{"value":1,"formatted":"events_"}},"counter":{"value":0,"_unit":"events","formatted":"0 events"}},"hex":"43ff7c18005640000000001200000000"}' ],

    'GM1 f24 (status_packet)fw0.8.1' => [ 'request' =>
        [ 'data' => 'Q//qFQCGSHDo7wCoBV0BEgAAAAA=', 'fport' => '24', 'serial' => '50100028', 'firmware' => '0.8.5' ],
        'results' => '{"packet_type":"status_packet","header":{"interface":{"value":3,"formatted":"gas meter"},"user_triggered_packet":{"value":1,"formatted":"yes"},"active_alerts":{"value":0,"formatted":"no"}},"battery_percentage":{"value":"255","_unit":"%","formatted":"not_available"},"battery_index":{"value":3.59799999999999986499688020558096468448638916015625,"_unit":"V","formatted":"3.598 V","value_raw":234},"mcu_temperature":{"value":21,"_unit":"\u00b0C","formatted":"21\u00b0C"},"temp_extremes":{"min_offset":{"value":0,"formatted":"0\u00b0C"},"max_offset":{"value":0,"formatted":"0\u00b0C"}},"downlink_rssi":{"value":-134,"_unit":"dBm","formatted":"-134 dBm"},"gas":{"settings":{"input_state":{"value":0,"formatted":false},"operational_mode":{"value":0,"formatted":"counter"},"device_serial_sent":{"value":1,"formatted":"sent"},"medium_type":{"value":4,"formatted":"_gas"}},"counter":{"value":15722608,"_unit":"L","formatted":"15722608 L"},"device_serial_set":{"value":22873512,"formatted":"22873512 "}},"tamper":{"settings":{"input_state":{"value":0,"formatted":false},"operational_mode":{"value":1,"formatted":"trigger_mode"},"is_alert":{"value":0,"formatted":"no"},"medium_type":{"value":1,"formatted":"events_"}},"counter":{"value":0,"_unit":"events","formatted":"0 events"}},"hex":"43ffea1500864870e8ef00a8055d011200000000"}' ],

    'GM1 f25 (usage_packet)' => [ 'request' =>
        [ 'data' => 'A0CwxZwBEgAAAAA=', 'fport' => '25', 'serial' => '4E1B0018' ],
        'results' => '{"packet_type":"usage_packet","interface":"03","gas":{"settings":{"input_state":{"value":"0","formatted":false},"operational_mode":{"value":"0","formatted":"counter"},"medium_type":{"value":"04","formatted":"_gas"}},"counter":{"value":27051440,"_unit":"L","formatted":"27051440 L"}},"tamper":{"settings":{"input_state":{"value":"0","formatted":false},"operational_mode":{"value":"1","formatted":"trigger_mode"},"is_alert":{"value":"0","formatted":"no"},"medium_type":{"value":"01","formatted":"events_"}},"counter":{"value":0,"_unit":"events","formatted":"0 events"}},"hex":"0340b0c59c011200000000"}' ],


    'GM1 f99 (boot_packet)' => [ 'request' =>
        [ 'data' => 'ACAAG04ABx8QAgA=', 'fport' => '99', 'serial' => '4E1B0018' ],
        'results' => '{"packet_type":"boot_packet","device_serial":"4e1b0020","firmware_version":"0.7.31","reset_reason":["magnet_wakeup"],"general_info":{"battery_type":{"value":2,"formatted":"3V6"}},"hardware_config":{"value":"00","formatted":"digital_only"},"hex":"0020001b4e00071f100200"}' ],


    'GM1 f99 (shutdown_packet)' => [ 'request' =>
        [ 'data' => 'ATEDLxJwQDwAAAASAAAAAA==', 'fport' => '99', 'serial' => '4E1B0018' ],
        'results' => '{"packet_type":"shutdown_packet","shutdown_reason":{"value":"31","formatted":"magnet_shutdown"},"header":{"interface":{"value":3,"formatted":"gas meter"},"user_triggered_packet":{"value":0,"formatted":"no"},"temperature_triggered_packet":{"value":0,"formatted":"no"}},"battery_index":{"value":2.8499999999999996447286321199499070644378662109375,"_unit":"V","formatted":"2.85 V","value_raw":47},"mcu_temp":{"value":18,"_unit":"\u00b0C","formatted":"18\u00b0C"},"downlink_rssi":{"value":-112,"_unit":"dBm","formatted":"-112 dBm"},"gas":{"settings":{"input_state":{"value":0,"formatted":false},"operational_mode":{"value":0,"formatted":"counter"},"medium_type":{"value":4,"formatted":"_gas"}},"counter":{"value":60,"_unit":"L","formatted":"60 L"}},"tamper":{"settings":{"input_state":{"value":0,"formatted":false},"operational_mode":{"value":1,"formatted":"trigger_mode"},"is_alert":{"value":0,"formatted":"no"},"medium_type":{"value":1,"formatted":"events_"}},"counter":{"value":0,"_unit":"events","formatted":"0 events"}},"hex":"0131032f1270403c0000001200000000"}' ],

    /* GM1 -> UKW *********************************************************************/
    
    'GM1 f24 (status_packet)fw1.0.0' => [ 'request' =>
        [ 'data' => 'ASAA/4YRAFEB8AAAAA==', 'fport' => '24', 'serial' => '50100028', 'firmware' => '1.0.0' ],
        'results' => '{"packet_type":"status_packet","general":{"_fixed_metering":{"value":0,"formatted":"disabled"},"_debug_info":{"value":0,"formatted":"not_sent"},"packet_reason_app":{"value":1,"formatted":"true"},"packet_reason_magnet":{"value":0,"formatted":"false"},"packet_reason_alert":{"value":0,"formatted":"false"}},"active_alerts":{"reverse_flow_detected":{"value":0,"formatted":"false"},"burst":{"value":0,"formatted":"false"},"leak":{"value":0,"formatted":"false"},"tamper":{"value":0,"formatted":"false"},"temperature_alert":{"value":0,"formatted":"false"},"battery":{"value":0,"formatted":"false"}},"battery_percentage":{"value":255,"formatted":"not_available","_unit":"%"},"battery_voltage":{"value":3.198,"formatted":"3.198 V","value_raw":134,"_unit":"V"},"mcu_temperature":{"value":17,"formatted":"17\u00b0C","_unit":"\u00b0C"},"temp_extremes":{"min_offset":{"value":0,"formatted":"-34 \u00b0C"},"max_offset":{"value":0,"formatted":"34 \u00b0C"}},"downlink_rssi":{"value":-81,"formatted":"-81 dBm","_unit":"dBm"},"downlink_snr":{"value":1,"formatted":"1 dB","_unit":"dB"},"accumulated_volume":{"value":240,"formatted":"240 L","_unit":"L"},"hex":"012000ff8611005101f0000000"}' ],

    
    
    
    /**
     *
     * LAC
     *
     */
    'LAC f24 (status_packet)' => [ 'request' =>
        [ 'data' => 'AEMAVQI=', 'fport' => '24', 'serial' => '4E09000A' ],
        'results' => '{"packet_type":"status_packet","status":{"lock":{"value":"0","formatted":"open"}},"rssi":{"value":-67,"_unit":"dBm","formatted":"-67 dBm"},"temp":{"value":0,"_unit":"C","formatted":"0 C"},"card_count":{"value":597,"formatted":"597 "},"hex":"0043005502"}' ],

    'LAC f25 (usage_packet)' => [ 'request' =>
        [ 'data' => 'AawtIAoA', 'fport' => '25', 'serial' => '4E09000A' ],
        'results' => '{"packet_type":"usage_packet","status":{"allowed":{"value":"1","formatted":"yes"},"command":{"value":"0","formatted":"no"}},"card_number":"202dac","time_closed":{"value":10,"_unit":"minutes","formatted":"10 minutes"},"hex":"01ac2d200a00"}' ],

    'LAC f50 (configuration_packet)' => [ 'request' =>
        [ 'data' => 'AQE=', 'fport' => '50', 'serial' => '4E09000A' ],
        'results' => '{"packet_type":"configuration_packet","header":"01","open_alert_timer":{"value":1,"_unit":"minutes","formatted":"1 minutes"},"hex":"0101"}' ],

    'LAC f53 (alert_packet - left open)' => [ 'request' =>
        [ 'data' => 'AQEBAA==', 'fport' => '53', 'serial' => '4E09000A' ],
        'results' => '{"packet_type":"alert_packet","alert":{"value":"01","formatted":"left_open"},"status":{"alert":{"value":"1","formatted":"raised"}},"time_open":{"value":1,"_unit":"min","formatted":"1 min"},"hex":"01010100"}' ],

    'LAC f53 (alert_packet - force open)' => [ 'request' =>
        [ 'data' => 'AgE=', 'fport' => '53', 'serial' => '4E09000A' ],
        'results' => '{"packet_type":"alert_packet","alert":{"value":"02","formatted":"force_open"},"status":{"alert":{"value":"1","formatted":"raised"}},"hex":"0201"}' ],


    'LAC f99 (boot_packet)' => [ 'request' =>
        [ 'data' => 'AAQACU4AAQ66AAA=', 'fport' => '99', 'serial' => '4E09000A' ],
        'results' => '{"packet_type":"boot_packet","device_serial":"4e090004","firmware_version":"0.1.14","card_count":{"value":186,"formatted":"186 "},"switch_direction":"00","hex":"000400094e00010eba0000"}' ],


    /**
     *
     * AXI
     *
     */
    'AXI f24 (status_packet)' => [ 'request' =>
        [ 'data' => 'lQ5rAJJ7AAAAAAAAAAA=', 'fport' => '24', 'serial' => '4D130024' ],
        'results' => '{"packet_type":"status_packet","module_battery":{"value":3.258,"_unit":"V","formatted":"3.258 V","value_raw":149},"module_temp":{"value":14,"_unit":"\u00b0C","formatted":"14\u00b0C"},"downlink_rssi":{"value":-107,"_unit":"dBm","formatted":"-107 dBm"},"state":{"user_triggered_packet":{"value":"0","formatted":"no"},"error_triggered_packet":{"value":"0","formatted":"no"},"temperature_triggered_packet":{"value":"0","formatted":"no"}},"accumulated_volume":{"value":31634,"_unit":"L","formatted":"31634 L"},"meter_error":"00000000","register_map":{"accumulated_heat_energy":{"value":"0","formatted":"not_sent"},"accumulated_cooling_energy":{"value":"0","formatted":"not_sent"},"accumulated_pulse_1":{"value":"0","formatted":"not_sent"},"accumulated_pulse_2":{"value":"0","formatted":"not_sent"},"instant_flow_rate":{"value":"0","formatted":"not_sent"},"instant_power":{"value":"0","formatted":"not_sent"},"instant_temp_in":{"value":"0","formatted":"not_sent"},"instant_temp_out":{"value":"0","formatted":"not_sent"}},"hex":"950e6b00927b0000000000000000"}' ],

    'AXI f25 (usage_packet heat)' => [ 'request' =>
        [ 'data' => 'OKoIAPMAf08AAAAAAADy8c5ChP/JPyUS+ww=', 'fport' => '25', 'serial' => '4D130024' ],
        'results' => '{"packet_type":"usage_packet","accumulated_volume":{"value":567864,"_unit":"L","formatted":"567864 L"},"register_map":{"accumulated_heat_energy":{"value":"1","formatted":"sent"},"accumulated_cooling_energy":{"value":"1","formatted":"sent"},"accumulated_pulse_1":{"value":"0","formatted":"not_sent"},"accumulated_pulse_2":{"value":"0","formatted":"not_sent"},"instant_flow_rate":{"value":"1","formatted":"sent"},"instant_power":{"value":"1","formatted":"sent"},"instant_temp_in":{"value":"1","formatted":"sent"},"instant_temp_out":{"value":"1","formatted":"sent"}},"accumulated_heat_energy":{"value":20351,"_unit":"kWh","formatted":"20351 kWh"},"accumulated_cooling_energy":{"value":0,"_unit":"kWh","formatted":"0 kWh"},"instant_flow_rate":{"value":103.47254943847656,"_unit":"L\/h","formatted":"103.473 L\/h"},"instant_power":{"value":1.5781102180480957,"_unit":"kW","formatted":"1.578 kW"},"instant_temp_in":{"value":46.45,"_unit":"\u00b0C","formatted":"46.45\u00b0C"},"instant_temp_out":{"value":33.23,"_unit":"\u00b0C","formatted":"33.23\u00b0C"},"hex":"38aa0800f3007f4f000000000000f2f1ce4284ffc93f2512fb0c"}' ],


    'AXI f25 (usage_packet)' => [ 'request' =>
        [ 'data' => 'lX4AABAAAAAAAA==', 'fport' => '25', 'serial' => '4D130024' ],
        'results' => '{"packet_type":"usage_packet","accumulated_volume":{"value":32405,"_unit":"L","formatted":"32405 L"},"register_map":{"accumulated_heat_energy":{"value":"0","formatted":"not_sent"},"accumulated_cooling_energy":{"value":"0","formatted":"not_sent"},"accumulated_pulse_1":{"value":"0","formatted":"not_sent"},"accumulated_pulse_2":{"value":"0","formatted":"not_sent"},"instant_flow_rate":{"value":"1","formatted":"sent"},"instant_power":{"value":"0","formatted":"not_sent"},"instant_temp_in":{"value":"0","formatted":"not_sent"},"instant_temp_out":{"value":"0","formatted":"not_sent"}},"instant_flow_rate":{"value":0,"_unit":"L\/h","formatted":"0.000 L\/h"},"hex":"957e0000100000000000"}' ],

    'AXI f25 (usage_packet - full)' => [ 'request' =>
        [ 'data' => '/IICAPMhNwAAAAAAAAAAAAAAAAAAxLw8QtxGA0I=', 'fport' => '25', 'serial' => '4D130024', 'firmware' => '0.7.63' ],
        'results' => '{"packet_type":"usage_packet","accumulated_volume":{"value":164604,"_unit":"L","formatted":"164604 L"},"register_map":{"accumulated_heat_energy":{"value":"1","formatted":"sent"},"accumulated_cooling_energy":{"value":"1","formatted":"sent"},"accumulated_pulse_1":{"value":"0","formatted":"not_sent"},"accumulated_pulse_2":{"value":"0","formatted":"not_sent"},"instant_flow_rate":{"value":"1","formatted":"sent"},"instant_power":{"value":"1","formatted":"sent"},"instant_temp_in":{"value":"1","formatted":"sent"},"instant_temp_out":{"value":"1","formatted":"sent"}},"accumulated_heat_energy":{"value":55,"_unit":"kWh","formatted":"55 kWh"},"accumulated_cooling_energy":{"value":0,"_unit":"kWh","formatted":"0 kWh"},"instant_flow_rate":{"value":0,"_unit":"L\/h","formatted":"0.000 L\/h"},"instant_power":{"value":-512,"_unit":"kW","formatted":"-512.000 kW"},"instant_temp_in":{"value":155.48,"_unit":"\u00b0C","formatted":"155.48\u00b0C"},"instant_temp_out":{"value":-91.5,"_unit":"\u00b0C","formatted":"-91.50\u00b0C"},"hex":"fc820200f321370000000000000000000000000000c4bc3c42dc460342"}' ],


    'AXI f99 (boot_packet)' => [ 'request' =>
        [ 'data' => 'ACQAE00AAwUQiRQIAAA=', 'fport' => '99', 'serial' => '4D130024' ],
        'results' => '{"packet_type":"boot_packet","device_serial":"4d130024","firmware_version":"0.3.5","reset_reason":["magnet_wakeup"],"meter_id":"00081489","meter_type":{"value":"00","formatted":"water_meter"},"hex":"002400134d000305108914080000"}' ],

    'AXI f99 (shutdown_packet)' => [ 'request' =>
        [ 'data' => 'ATGIGGIAAAAAAAQEAAAAAA==', 'fport' => '99', 'serial' => '4D130024' ],
        'results' => '{"packet_type":"shutdown_packet","shutdown_reason":{"value":"31","formatted":"magnet_shutdown"},"module_battery":{"value":3.205999999999999960920149533194489777088165283203125,"_unit":"V","formatted":"3.206 V","value_raw":136},"module_temp":{"value":24,"_unit":"\u00b0C","formatted":"24\u00b0C"},"downlink_rssi":{"value":-98,"_unit":"dBm","formatted":"-98 dBm"},"state":{"user_triggered_packet":{"value":"0","formatted":"no"},"error_triggered_packet":{"value":"0","formatted":"no"},"temperature_triggered_packet":{"value":"0","formatted":"no"}},"accumulated_volume":{"value":0,"_unit":"L","formatted":"0 L"},"meter_error":"00000404","register_map":{"accumulated_heat_energy":{"value":"0","formatted":"not_sent"},"accumulated_cooling_energy":{"value":"0","formatted":"not_sent"},"accumulated_pulse_1":{"value":"0","formatted":"not_sent"},"accumulated_pulse_2":{"value":"0","formatted":"not_sent"},"instant_flow_rate":{"value":"0","formatted":"not_sent"},"instant_power":{"value":"0","formatted":"not_sent"},"instant_temp_in":{"value":"0","formatted":"not_sent"},"instant_temp_out":{"value":"0","formatted":"not_sent"}},"hex":"01318818620000000000040400000000"}' ],


    /**
     *
     * WML
     *
     */

    'WML f24 (status_packet - payload)' => [ 'request' =>
        [ 'data' => 'Af/ESzFELSwWmBRpHASNIG7YOdgiRiB62UwfYi/xXrNKD26++drYGw135vvGYQ6z1qVLE1lL', 'fport' => '24', 'serial' => '4c1d0224' ],
        'results' => '{"packet_type":"status_packet","header":"01","device":{"time":{"value":"Live","_unit":"UTC","formatted":"Live","value_raw":255},"time_diff":{"value":-60,"_unit":"min","formatted":"-60 min"},"rssi":{"value":-75,"_unit":"dBm","formatted":"-75 dBm"},"wmbus":{"header":{"_control":"primary station, unidirectional","manufacturer":{"value":"KAM","_value_raw":"2d2c","formatted":"Kamstrup Energi A\/S"},"serial":"69149816","version":"1c","device_type":{"formatted":"heat (outlet volume)","value":"04"}},"_payload_hex":"8d206ed839d82246207ad94c1f622ff15eb34a0f6ebef9dad81b0d77e6fbc6610eb3d6a54b13594b","error":"wM-Bus key missing"}},"hex":"01ffc44b31442d2c169814691c048d206ed839d82246207ad94c1f622ff15eb34a0f6ebef9dad81b0d77e6fbc6610eb3d6a54b13594b"}' ],

    'WML f24 (status_packet - error)' => [ 'request' =>
        [ 'data' => 'Af8AbDFELSxjAJNpHAQc', 'fport' => '24', 'serial' => '4c1d0224' ],
        'results' => '{"packet_type":"status_packet","header":"01","device":{"time":{"value":"Live","_unit":"UTC","formatted":"Live","value_raw":255},"time_diff":{"value":0,"_unit":"min","formatted":"0 min"},"rssi":{"value":-108,"_unit":"dBm","formatted":"-108 dBm"},"wmbus":{"header":{"_control":"primary station, unidirectional","manufacturer":{"value":"KAM","_value_raw":"2d2c","formatted":"Kamstrup Energi A\/S"},"serial":"69930063","version":"1c","device_type":{"formatted":"heat (outlet volume)","value":"04"}},"communication_error":{"sf_limited":{"value":12},"sf_too_high":{"value":1,"formatted":"true"},"communication_lost":{"value":0,"formatted":"false"}}}},"hex":"01ff006c31442d2c630093691c041c"}' ],

    'WML f24 (status_packet - bridge)' => [ 'request' =>
        [ 'data' => 'AJIobzgAE/8AAwI=', 'fport' => '24', 'serial' => '4c1d0224' ],
        'results' => '{"packet_type":"status_packet","header":"00","bridge":{"time":{"value":"02.01.2000 10:29:38","_unit":"UTC","formatted":"02.01.2000 10:29:38 UTC","value_raw":946808978},"rssi":{"value":0,"_unit":"dBm","formatted":"0 dBm"},"temp":{"value":19,"_unit":"C","formatted":"19 C"},"battery":{"value":255,"formatted":"255 "},"status":{"grid_power":{"value":"0","formatted":false}},"connected_devices":{"value":3,"formatted":"3 "},"available devices":{"value":2,"formatted":"2 "}},"hex":"0092286f380013ff000302"}' ],

    // missing key
    'WML f25 (usage_packet)' => [ 'request' =>
        [ 'data' => 'Af/+LkQBBiMmAIABFnpbAyAFzwL7hhUP2kHJziFejXjxMaJ4rT28rp4yNxOXhioGeQU=', 'fport' => '25', 'serial' => '4c1d0224' ],
        'results' => '{"packet_type":"status_packet","header":"01","device":{"time":{"value":"Live","_unit":"UTC","formatted":"Live","value_raw":255},"time_diff":{"value":-2,"_unit":"min","formatted":"-2 min"},"wmbus":{"header":{"_control":"primary station, unidirectional","manufacturer":{"value":"APA","_value_raw":"0106","formatted":"Apator SA"},"serial":"80002623","version":"1","device_type":{"formatted":"cold water","value":"16"}},"_payload_hex":"7a5b032005cf02fb86150fda41c9ce215e8d78f131a278ad3dbcae9e32371397862a067905","error":"wM-Bus key missing"}},"hex":"01fffe2e4401062326008001167a5b032005cf02fb86150fda41c9ce215e8d78f131a278ad3dbcae9e32371397862a067905"}' ],

    'WML f25 (usage_packet - payload decryption)' => [ 'request' =>
        [ 'data' => 'Af/NHkQzOJSWAyABB3pBABAFUGwFvUa2Wwe+d74/+UUJFw==', 'fport' => '25', 'serial' => '4c1d001c', 'encrypt_key' => '72344e7a8e11177224a781c2ae151c51' ],
        'results' => '{"packet_type":"status_packet","header":"01","device":{"time":{"value":"Live","_unit":"UTC","formatted":"Live","value_raw":255},"time_diff":{"value":-51,"_unit":"min","formatted":"-51 min"},"wmbus":{"header":{"_control":"primary station, unidirectional","manufacturer":{"value":"NAS","_value_raw":"3338","formatted":"NAS Instruments O\u00dc"},"serial":"20039694","version":"1","device_type":{"formatted":"water","value":"07"}},"_payload_hex":"2f2f02fd0837000413000000002f2f2f","data_records":{"1":{"_function":"instant value","value_type":"access number","_encoding":"16 bit integer","_header_raw":"02fd08","_data_raw":"3700","value":55,"_value_raw":55,"formatted":"55"},"2":{"_function":"instant value","value_type":"volume","_unit":" m\u00b3","_exp":-3,"_encoding":"32 bit integer","_header_raw":"0413","_data_raw":"00000000","value":0,"_value_raw":0,"formatted":"0 m\u00b3"}}}},"hex":"01ffcd1e4433389496032001077a41001005506c05bd46b65b07be77be3ff9450917"}' ],


    'WML f49 (request_config_packet) device_list' => [ 'request' =>
        [ 'data' => 'AgCFB3EAAIclFpCWAyBQFQCAIyYAgJgyAIB0MnKIVxN1lCADlpQ=', 'fport' => '49', 'serial' => '4c1d0224' ],
        'results' => '{"packet_type":"device_list","message":{"current":{"value":0},"total":{"value":0}},"payload":[{"serial":"00710785"},{"serial":"16258700"},{"serial":"20039690"},{"serial":"80001550"},{"serial":"80002623"},{"serial":"80003298"},{"serial":"88723274"},{"serial":"94751357"},{"serial":"94960320"}],"hex":"0200850771000087251690960320501500802326008098320080743272885713759420039694"}' ],


    'WML f53 (alert_packet)' => [ 'request' =>
        [ 'data' => 'AAADawlgU1kACAMMIFY0Bgg7DBaYFGkIsAxjAJNpCC4MYXMygA==', 'fport' => '53', 'serial' => '4c1d0224' ],
        'results' => '{"packet_type":"wm_bus_discover","message":{"current":{"value":0},"total":{"value":0}},"payload":[{"mode":{"value":"03","formatted":"T1"},"rssi":{"value":-107,"_unit":"dBm","formatted":"-107 dBm"},"data_rate":{"maximum_sf":{"value":9}},"serial":"00595360"},{"mode":{"value":"08","formatted":"C2 T-A"},"rssi":{"value":-3,"_unit":"dBm","formatted":"-3 dBm"},"data_rate":{"maximum_sf":{"value":12}},"serial":"06345620"},{"mode":{"value":"08","formatted":"C2 T-A"},"rssi":{"value":-59,"_unit":"dBm","formatted":"-59 dBm"},"data_rate":{"maximum_sf":{"value":12}},"serial":"69149816"},{"mode":{"value":"08","formatted":"C2 T-A"},"rssi":{"value":-176,"_unit":"dBm","formatted":"-176 dBm"},"data_rate":{"maximum_sf":{"value":12}},"serial":"69930063"},{"mode":{"value":"08","formatted":"C2 T-A"},"rssi":{"value":-46,"_unit":"dBm","formatted":"-46 dBm"},"data_rate":{"maximum_sf":{"value":12}},"serial":"80327361"}],"hex":"0000036b096053590008030c20563406083b0c1698146908b00c63009369082e0c61733280"}' ],


    'WML f99 (boot_packet)' => [ 'request' =>
        [ 'data' => 'ABUAHUwAAQoA', 'fport' => '99', 'serial' => '4c1d0224' ],
        'results' => '{"packet_type":"boot_packet","device_serial":"4c1d0015","firmware_version":"0.1.10","connected_devices":{"value":0,"formatted":"0 "},"hex":"0015001d4c00010a00"}' ],


    /**
     *
     * OIR
     *
     */

    'OIR f99 (boot_packet)' => [ 'request' =>
        [ 'data' => 'AAcAEU0ABxkQAgQ=', 'fport' => '99', 'serial' => '4D110007' ],
        'results' => '{"packet_type":"boot_packet","device_serial":"4d110007","firmware_version":"0.7.25","reset_reason":["magnet_wakeup"],"general_info":{"battery_type":{"value":2,"formatted":"3V6"}},"hardware_config":{"value":"04","formatted":"digital_+_mbus"},"hex":"000700114d000719100204"}' ],

    'OIR f99 (boot_packet) fw0.8.0' => [ 'request' =>
        [ 'data' => 'AHkAgU0ACAAEgAQ=', 'fport' => '99', 'serial' => '4d810079', 'firmware' => '0.8.0' ],
        'results' => '{"packet_type":"boot_packet","device_serial":"4d810079","firmware_version":"0.8.0","reset_reason":["soft_reset"],"general_info":{"configuration_restored":{"value":1,"formatted":"true"}},"hardware_config":{"value":"04","formatted":"digital_+_mbus"},"hex":"007900814d000800048004"}' ],

    'OIR f99 (boot_packet)LBUS fw0.8.0' => [ 'request' =>
        [ 'data' => 'ABEAgVAACAAEAAY=', 'fport' => '99', 'serial' => '4d810079', 'firmware' => '0.8.4' ],
        'results' => '{"packet_type":"boot_packet","device_serial":"50810011","firmware_version":"0.8.0","reset_reason":["soft_reset"],"general_info":{"configuration_restored":{"value":0,"formatted":"false"}},"hardware_config":{"value":"06","formatted":"digital_+_lbus"},"hex":"0011008150000800040006"}' ],

    'OIR f24 (status_packet)' => [ 'request' =>
        [ 'data' => 'AawXcCCPeSUA', 'fport' => '24', 'serial' => '4C1600FF' ],
        'results' => '{"packet_type":"status_packet","reported_interfaces":{"digital_1":{"value":1,"formatted":"sent"},"digital_2":{"value":0,"formatted":"not_sent"},"analog_1":{"value":0,"formatted":"not_sent"},"analog_2":{"value":0,"formatted":"not_sent"},"ssi":{"value":0,"formatted":"not_sent"},"mbus":{"value":0,"formatted":"not_sent"},"user_triggered_packet":{"value":0,"formatted":"no"},"temperature_triggered_packet":{"value":0,"formatted":"no"}},"battery":{"value":3.350000000000000088817841970012523233890533447265625,"_unit":"V","formatted":"3.35 V","value_raw":172},"mcu_temperature":{"value":23,"_unit":"\u00b0C","formatted":"23\u00b0C"},"downlink_rssi":{"value":-112,"_unit":"dBm","formatted":"-112 dBm"},"digital_1":{"state":{"input_state":{"value":0,"formatted":"open"},"operational_mode":{"value":0,"formatted":"pulse_mode"},"alert_state":{"value":0},"medium_type":{"value":2,"formatted":"L_water"}},"counter":{"value":2455951,"_unit":"L_water","formatted":"2455951 L_water"}},"hex":"01ac1770208f792500"}' ],

    'OIR f24 (status_packet) 0.8.7' => [ 'request' =>
        [ 'data' => 'jwL/KxYAV1hOYbwARDMiERoAAAAAZneImUJodJlAQygoWkE=', 'fport' => '24', 'serial' => '4c860973', 'firmware' => '0.8.7' ],
        'results' => '{"packet_type":"status_packet","reported_interfaces":{"digital_1":{"value":1,"formatted":"sent"},"digital_2":{"value":1,"formatted":"sent"},"analog_1":{"value":1,"formatted":"sent"},"analog_2":{"value":1,"formatted":"sent"},"ssi":{"value":0,"formatted":"not_sent"},"mbus":{"value":0,"formatted":"not_sent"},"user_triggered_packet":{"value":0,"formatted":"no"},"active_alerts":{"value":1,"formatted":"yes"}},"active_alerts":{"digital_interface_alert":{"value":0,"formatted":"no"},"secondary_interface_alert":{"value":1,"formatted":"yes"},"temperature_alert":{"value":0,"formatted":"no"}},"battery_percentage":{"value":"255","_unit":"%","formatted":"not_available"},"battery_voltage":{"value":2.833999999999999630517777404747903347015380859375,"_unit":"V","formatted":"2.834 V","value_raw":43},"mcu_temperature":{"value":22,"_unit":"\u00b0C","formatted":"22\u00b0C"},"temp_extremes":{"min_offset":{"value":0,"formatted":"0\u00b0C"},"max_offset":{"value":0,"formatted":"0\u00b0C"}},"downlink_rssi":{"value":-87,"_unit":"dBm","formatted":"-87 dBm"},"digital_1":{"state":{"input_state":{"value":0,"formatted":"open"},"operational_mode":{"value":0,"formatted":"pulse_mode"},"alert_state":{"value":0},"medium_type":{"value":5,"formatted":"Wh_heat"},"device_serial_sent":{"value":1}},"counter":{"value":12345678,"_unit":"Wh_heat","formatted":"12345678 Wh_heat"},"device_serial":"11223344"},"digital_2":{"state":{"input_state":{"value":0,"formatted":"open"},"operational_mode":{"value":1,"formatted":"trigger_mode"},"alert_state":{"value":0},"medium_type":{"value":1,"formatted":"pulses"},"device_serial_sent":{"value":1}},"counter":{"value":0,"_unit":"pulses","formatted":"0 pulses"},"device_serial":"99887766"},"analog_1":{"general":{"input_mode":{"value":0,"formatted":"V"},"is_alert":{"value":1,"formatted":"yes"},"instant_value_reported":{"value":1,"formatted":"reported"},"average_value_reported":{"value":0,"formatted":"not reported"}},"instant_value":{"value":4.795459747314453125,"_unit":"V","formatted":"4.80 V"}},"analog_2":{"general":{"input_mode":{"value":1,"formatted":"mA"},"is_alert":{"value":1,"formatted":"yes"},"instant_value_reported":{"value":1,"formatted":"reported"},"average_value_reported":{"value":0,"formatted":"not reported"}},"instant_value":{"value":13.63480377197265625,"_unit":"mA","formatted":"13.63 mA"}},"hex":"8f02ff2b160057584e61bc00443322111a000000006677889942687499404328285a41"}' ],

    'OIR f24 (status_packet - 2x digital)' => [ 'request' =>
        [ 'data' => 'QxEXXxAAAAAAQhAAAJE=', 'fport' => '24', 'serial' => '4C1600FF' ],
        'results' => '{"packet_type":"status_packet","reported_interfaces":{"digital_1":{"value":1,"formatted":"sent"},"digital_2":{"value":1,"formatted":"sent"},"analog_1":{"value":0,"formatted":"not_sent"},"analog_2":{"value":0,"formatted":"not_sent"},"ssi":{"value":0,"formatted":"not_sent"},"mbus":{"value":0,"formatted":"not_sent"},"user_triggered_packet":{"value":1,"formatted":"yes"},"temperature_triggered_packet":{"value":0,"formatted":"no"}},"battery":{"value":2.68400000000000016342482922482304275035858154296875,"_unit":"V","formatted":"2.684 V","value_raw":17},"mcu_temperature":{"value":23,"_unit":"\u00b0C","formatted":"23\u00b0C"},"downlink_rssi":{"value":-95,"_unit":"dBm","formatted":"-95 dBm"},"digital_1":{"state":{"input_state":{"value":0,"formatted":"open"},"operational_mode":{"value":0,"formatted":"pulse_mode"},"alert_state":{"value":0},"medium_type":{"value":1,"formatted":"pulses"}},"counter":{"value":0,"_unit":"pulses","formatted":"0 pulses"}},"digital_2":{"state":{"input_state":{"value":0,"formatted":"open"},"operational_mode":{"value":1,"formatted":"trigger_mode"},"alert_state":{"value":0},"medium_type":{"value":4,"formatted":"L_gas"}},"counter":{"value":2432696336,"_unit":"L_gas","formatted":"2432696336 L_gas"}},"hex":"4311175f10000000004210000091"}' ],

    'OIR f24 (status_packet - mbus)' => [ 'request' =>
        [ 'data' => 'oxABchAAAAAAEAAAAAAAAAx4ITkTAAwUZAAAAA==', 'fport' => '24', 'serial' => '4C1600FF' ],
        'results' => '{"packet_type":"status_packet","reported_interfaces":{"digital_1":{"value":1,"formatted":"sent"},"digital_2":{"value":1,"formatted":"sent"},"analog_1":{"value":0,"formatted":"not_sent"},"analog_2":{"value":0,"formatted":"not_sent"},"ssi":{"value":0,"formatted":"not_sent"},"mbus":{"value":1,"formatted":"sent"},"user_triggered_packet":{"value":0,"formatted":"no"},"temperature_triggered_packet":{"value":1,"formatted":"yes"}},"battery":{"value":2.634,"_unit":"V","formatted":"2.634 V","value_raw":16},"mcu_temperature":{"value":1,"_unit":"\u00b0C","formatted":"1\u00b0C"},"downlink_rssi":{"value":-114,"_unit":"dBm","formatted":"-114 dBm"},"digital_1":{"state":{"input_state":{"value":0,"formatted":"open"},"operational_mode":{"value":0,"formatted":"pulse_mode"},"alert_state":{"value":0},"medium_type":{"value":"01","formatted":"pulses"}},"counter":{"value":0,"_unit":"pulses","formatted":"0 pulses"}},"digital_2":{"state":{"input_state":{"value":0,"formatted":"open"},"operational_mode":{"value":0,"formatted":"pulse_mode"},"alert_state":{"value":0},"medium_type":{"value":"01","formatted":"pulses"}},"counter":{"value":0,"_unit":"pulses","formatted":"0 pulses"}},"mbus":{"state":{"last_status":{"value":"00","formatted":"ok"}},"mbus_status":"00","data_records":{"1":{"_function":"instant value","value_type":"fabrication number","_encoding":"8 digit BCD","_header_raw":"0c78","_data_raw":"21391300","value":133921,"_value_raw":133921,"formatted":"133921"},"2":{"_function":"instant value","value_type":"volume","_unit":" m\u00b3","_exp":-2,"_encoding":"8 digit BCD","_header_raw":"0c14","_data_raw":"64000000","value":0.64,"_value_raw":64,"formatted":"0.64 m\u00b3"}}},"hex":"a31001721000000000100000000000000c78213913000c1464000000"}' ],

    'OIR f24 (status_packet - mbus) fw0.8.0' => [ 'request' =>
        [ 'data' => 'Y/+UFgBkEAAAAAASAAAAAAAAC1p4BAALYkgBAAwGCZICAA==', 'fport' => '24', 'serial' => '4d810079', 'firmware' => '0.8.3' ],
        'results' => '{"packet_type":"status_packet","reported_interfaces":{"digital_1":{"value":1,"formatted":"sent"},"digital_2":{"value":1,"formatted":"sent"},"analog_1":{"value":0,"formatted":"not_sent"},"analog_2":{"value":0,"formatted":"not_sent"},"ssi":{"value":0,"formatted":"not_sent"},"mbus":{"value":1,"formatted":"sent"},"user_triggered_packet":{"value":1,"formatted":"yes"},"active_alerts":{"value":0,"formatted":"no"}},"battery_percentage":{"value":255,"_unit":"%","formatted":"not_available"},"battery_voltage":{"value":3.254,"_unit":"V","formatted":"3.254 V","value_raw":148},"mcu_temperature":{"value":22,"_unit":"\u00b0C","formatted":"22\u00b0C"},"temp_extremes":{"min_offset":{"value":0,"formatted":"0\u00b0C"},"max_offset":{"value":0,"formatted":"0\u00b0C"}},"downlink_rssi":{"value":-100,"_unit":"dBm","formatted":"-100 dBm"},"digital_1":{"state":{"input_state":{"value":0,"formatted":"open"},"operational_mode":{"value":0,"formatted":"pulse_mode"},"alert_state":{"value":0},"medium_type":{"value":"01","formatted":"pulses"},"device_serial_sent":{"value":0}},"counter":{"value":0,"_unit":"pulses","formatted":"0 pulses"}},"digital_2":{"state":{"input_state":{"value":0,"formatted":"open"},"operational_mode":{"value":1,"formatted":"trigger_mode"},"alert_state":{"value":0},"medium_type":{"value":"01","formatted":"pulses"},"device_serial_sent":{"value":0}},"counter":{"value":0,"_unit":"pulses","formatted":"0 pulses"}},"mbus":{"state":{"last_status":{"value":"00","formatted":"ok"},"packet_truncated":{"value":0,"formatted":"false"}},"mbus_status":"00","data_records":{"1":{"_function":"instant value","value_type":"flow temperature","_unit":"\u00b0C","_exp":-1,"_encoding":"6 digit BCD","_header_raw":"0b5a","_data_raw":"780400","value":47.800000000000004,"_value_raw":478,"formatted":"47.8\u00b0C"},"2":{"_function":"instant value","value_type":"temperature difference","_unit":"\u00b0C","_exp":-1,"_encoding":"6 digit BCD","_header_raw":"0b62","_data_raw":"480100","value":14.8,"_value_raw":148,"formatted":"14.8\u00b0C"},"3":{"_function":"instant value","value_type":"energy","_unit":" Wh","_exp":3,"_encoding":"8 digit BCD","_header_raw":"0c06","_data_raw":"09920200","value":29209000,"_value_raw":29209,"formatted":"29209000 Wh"}}},"hex":"63ff941600641000000000120000000000000b5a7804000b624801000c0609920200"}' ],

    'OIR f24 (status_packet) fw0.8.4' => [ 'request' =>
        [ 'data' => 'jAL/phQAX0CabBA8QgAAAAA=', 'fport' => '24', 'serial' => '4d810079', 'firmware' => '0.8.4' ],
        'results' => '{"packet_type":"status_packet","reported_interfaces":{"digital_1":{"value":0,"formatted":"not_sent"},"digital_2":{"value":0,"formatted":"not_sent"},"analog_1":{"value":1,"formatted":"sent"},"analog_2":{"value":1,"formatted":"sent"},"ssi":{"value":0,"formatted":"not_sent"},"mbus":{"value":0,"formatted":"not_sent"},"user_triggered_packet":{"value":0,"formatted":"no"},"active_alerts":{"value":1,"formatted":"yes"}},"active_alerts":{"digital_interface_alert":{"value":0,"formatted":"no"},"secondary_interface_alert":{"value":1,"formatted":"yes"},"temperature_alert":{"value":0,"formatted":"no"}},"battery_percentage":{"value":"255","_unit":"%","formatted":"not_available"},"battery_voltage":{"value":3.326000000000000067501559897209517657756805419921875,"_unit":"V","formatted":"3.326 V","value_raw":166},"mcu_temperature":{"value":20,"_unit":"\u00b0C","formatted":"20\u00b0C"},"temp_extremes":{"min_offset":{"value":0,"formatted":"0\u00b0C"},"max_offset":{"value":0,"formatted":"0\u00b0C"}},"downlink_rssi":{"value":-95,"_unit":"dBm","formatted":"-95 dBm"},"analog_1":{"general":{"input_mode":{"value":0,"formatted":"V"},"is_alert":{"value":0,"formatted":"no"},"instant_value_reported":{"value":1,"formatted":"reported"},"average_value_reported":{"value":0,"formatted":"not reported"}},"instant_value":{"value":0.00881495513021945953369140625,"_unit":"V","formatted":"0.01 V"}},"analog_2":{"general":{"input_mode":{"value":0,"formatted":"V"},"is_alert":{"value":1,"formatted":"yes"},"instant_value_reported":{"value":1,"formatted":"reported"},"average_value_reported":{"value":0,"formatted":"not reported"}},"instant_value":{"value":0,"_unit":"V","formatted":"0.00 V"}},"hex":"8c02ffa614005f409a6c103c4200000000"}' ],

    'OIR f24 (status_packet - mbus empty)' => [ 'request' =>
        [ 'data' => 'o3QDchAAAAAAEAAAAAABAAA=', 'fport' => '24', 'serial' => '4C1600FF' ],
        'results' => '{"packet_type":"status_packet","reported_interfaces":{"digital_1":{"value":1,"formatted":"sent"},"digital_2":{"value":1,"formatted":"sent"},"analog_1":{"value":0,"formatted":"not_sent"},"analog_2":{"value":0,"formatted":"not_sent"},"ssi":{"value":0,"formatted":"not_sent"},"mbus":{"value":1,"formatted":"sent"},"user_triggered_packet":{"value":0,"formatted":"no"},"temperature_triggered_packet":{"value":1,"formatted":"yes"}},"battery":{"value":3.125999999999999889865875957184471189975738525390625,"_unit":"V","formatted":"3.126 V","value_raw":116},"mcu_temperature":{"value":3,"_unit":"\u00b0C","formatted":"3\u00b0C"},"downlink_rssi":{"value":-114,"_unit":"dBm","formatted":"-114 dBm"},"digital_1":{"state":{"input_state":{"value":0,"formatted":"open"},"operational_mode":{"value":0,"formatted":"pulse_mode"},"alert_state":{"value":0},"medium_type":{"value":1,"formatted":"pulses"}},"counter":{"value":0,"_unit":"pulses","formatted":"0 pulses"}},"digital_2":{"state":{"input_state":{"value":0,"formatted":"open"},"operational_mode":{"value":0,"formatted":"pulse_mode"},"alert_state":{"value":0},"medium_type":{"value":1,"formatted":"pulses"}},"counter":{"value":0,"_unit":"pulses","formatted":"0 pulses"}},"mbus":{"state":{"last_status":{"value":1,"formatted":"nothing_requested"}}},"hex":"a374037210000000001000000000010000"}' ],

    'OIR f24 (status_packet - ssi)' => [ 'request' =>
        [ 'data' => 'EfcaZBAAAAAAgQULRrU/9ijOQQ==', 'fport' => '24', 'serial' => '4d880060' ],
        'results' => '{"packet_type":"status_packet","reported_interfaces":{"digital_1":{"value":1,"formatted":"sent"},"digital_2":{"value":0,"formatted":"not_sent"},"analog_1":{"value":0,"formatted":"not_sent"},"analog_2":{"value":0,"formatted":"not_sent"},"ssi":{"value":1,"formatted":"sent"},"mbus":{"value":0,"formatted":"not_sent"},"user_triggered_packet":{"value":0,"formatted":"no"},"temperature_triggered_packet":{"value":0,"formatted":"no"}},"battery":{"value":3.649999999999999911182158029987476766109466552734375,"_unit":"V","formatted":"3.65 V","value_raw":247},"mcu_temperature":{"value":26,"_unit":"\u00b0C","formatted":"26\u00b0C"},"downlink_rssi":{"value":-100,"_unit":"dBm","formatted":"-100 dBm"},"digital_1":{"state":{"input_state":{"value":0,"formatted":"open"},"operational_mode":{"value":0,"formatted":"pulse_mode"},"alert_state":{"value":0},"medium_type":{"value":1,"formatted":"pulses"}},"counter":{"value":0,"_unit":"pulses","formatted":"0 pulses"}},"ssi":{"general":{"ssi_index":{"value":1},"is_alert":{"value":1,"formatted":true}},"reported_parameters":{"channel_1_instant":{"value":1,"formatted":"reported"},"channel_2_instant":{"value":1,"formatted":"reported"},"channel_3_instant":{"value":0,"formatted":"not reported"},"channel_4_instant":{"value":0,"formatted":"not reported"}},"channel_1_instant":{"value":1.41620004177093505859375,"_unit":"bar","formatted":"1.416 bar"},"channel_2_instant":{"value":25.770000457763671875,"_unit":"\u00b0C","formatted":"25.770 \u00b0C"}},"hex":"11f71a64100000000081050b46b53ff628ce41"}' ],

    'OIR f24 (status_packet - ssi) fw0.8.0' => [ 'request' =>
        [ 'data' => 'Uf9wGABSEAAAAAABBT9Xgz8zM7tB', 'fport' => '24', 'serial' => '4d98005b', 'firmware' => '0.8.3' ],
        'results' => '{"packet_type":"status_packet","reported_interfaces":{"digital_1":{"value":1,"formatted":"sent"},"digital_2":{"value":0,"formatted":"not_sent"},"analog_1":{"value":0,"formatted":"not_sent"},"analog_2":{"value":0,"formatted":"not_sent"},"ssi":{"value":1,"formatted":"sent"},"mbus":{"value":0,"formatted":"not_sent"},"user_triggered_packet":{"value":1,"formatted":"yes"},"active_alerts":{"value":0,"formatted":"no"}},"battery_percentage":{"value":"255","_unit":"%","formatted":"not_available"},"battery_voltage":{"value":3.109999999999999875655021241982467472553253173828125,"_unit":"V","formatted":"3.11 V","value_raw":112},"mcu_temperature":{"value":24,"_unit":"\u00b0C","formatted":"24\u00b0C"},"temp_extremes":{"min_offset":{"value":0,"formatted":"0\u00b0C"},"max_offset":{"value":0,"formatted":"0\u00b0C"}},"downlink_rssi":{"value":-82,"_unit":"dBm","formatted":"-82 dBm"},"digital_1":{"state":{"input_state":{"value":0,"formatted":"open"},"operational_mode":{"value":0,"formatted":"pulse_mode"},"alert_state":{"value":0},"medium_type":{"value":1,"formatted":"pulses"},"device_serial_sent":{"value":0}},"counter":{"value":0,"_unit":"pulses","formatted":"0 pulses"}},"ssi":{"general":{"ssi_index":{"value":1},"is_alert":{"value":0,"formatted":false}},"reported_parameters":{"channel_1_instant":{"value":1,"formatted":"reported"},"channel_2_instant":{"value":1,"formatted":"reported"},"channel_3_instant":{"value":0,"formatted":"not reported"},"channel_4_instant":{"value":0,"formatted":"not reported"}},"channel_1_instant":{"value":1.02610003948211669921875,"_unit":"bar","formatted":"1.026 bar"},"channel_2_instant":{"value":23.3999996185302734375,"_unit":"\u00b0C","formatted":"23.400 \u00b0C"}},"hex":"51ff70180052100000000001053f57833f3333bb41"}' ],

    'OIR f25 (usage_packet)' => [ 'request' =>
        [ 'data' => 'ASDw2yUA', 'fport' => '25', 'serial' => '4D110007' ],
        'results' => '{"packet_type":"usage_packet","reported_interfaces":{"digital_1":{"value":1,"formatted":"sent"},"digital_2":{"value":0,"formatted":"not_sent"},"analog_1":{"value":0,"formatted":"not_sent"},"analog_2":{"value":0,"formatted":"not_sent"},"ssi":{"value":0,"formatted":"not_sent"},"mbus":{"value":0,"formatted":"not_sent"}},"digital_1":{"state":{"input_state":{"value":0,"formatted":"open"},"operational_mode":{"value":0,"formatted":"pulse_mode"},"alert_state":{"value":0},"medium_type":{"value":2,"formatted":"L_water"}},"counter":{"value":2481136,"_unit":"L_water","formatted":"2481136 L_water"}},"hex":"0120f0db2500"}' ],

    'OIR f25 (usage_packet - analog)' => [ 'request' =>
        [ 'data' => 'DyAeAAAAIC0AAADAvxDyQEc66UDAMkHrQIb49kA=', 'fport' => '25', 'serial' => '4d98005b', 'firmware' => '0.8.3' ],
        'results' => '{"packet_type":"usage_packet","reported_interfaces":{"digital_1":{"value":1,"formatted":"sent"},"digital_2":{"value":1,"formatted":"sent"},"analog_1":{"value":1,"formatted":"sent"},"analog_2":{"value":1,"formatted":"sent"},"ssi":{"value":0,"formatted":"not_sent"},"mbus":{"value":0,"formatted":"not_sent"}},"digital_1":{"state":{"input_state":{"value":0,"formatted":"open"},"operational_mode":{"value":0,"formatted":"pulse_mode"},"alert_state":{"value":0},"medium_type":{"value":2,"formatted":"L_water"},"device_serial_sent":{"value":0}},"counter":{"value":30,"_unit":"L_water","formatted":"30 L_water"}},"digital_2":{"state":{"input_state":{"value":0,"formatted":"open"},"operational_mode":{"value":0,"formatted":"pulse_mode"},"alert_state":{"value":0},"medium_type":{"value":2,"formatted":"L_water"},"device_serial_sent":{"value":0}},"counter":{"value":45,"_unit":"L_water","formatted":"45 L_water"}},"analog_1":{"general":{"input_mode":{"value":0,"formatted":"V"},"is_alert":{"value":0,"formatted":"no"},"instant_value_reported":{"value":1,"formatted":"reported"},"average_value_reported":{"value":1,"formatted":"reported"}},"instant_value":{"value":7.564544200897216796875,"_unit":"V","formatted":"7.56 V"},"average_value":{"value":7.288363933563232421875,"_unit":"V","formatted":"7.29 V"}},"analog_2":{"general":{"input_mode":{"value":0,"formatted":"V"},"is_alert":{"value":0,"formatted":"no"},"instant_value_reported":{"value":1,"formatted":"reported"},"average_value_reported":{"value":1,"formatted":"reported"}},"instant_value":{"value":7.35170841217041015625,"_unit":"V","formatted":"7.35 V"},"average_value":{"value":7.71783733367919921875,"_unit":"V","formatted":"7.72 V"}},"hex":"0f201e000000202d000000c0bf10f240473ae940c03241eb4086f8f640"}' ],

    'OIR f25 (usage_packet)fw 0.8.4' => [ 'request' =>
        [ 'data' => 'DRAAAAAAwbY640DV2+hAwRP7/kG+Jv5B', 'fport' => '25', 'serial' => '4d98005b' ],
        'results' => '{"packet_type":"usage_packet","reported_interfaces":{"digital_1":{"value":1,"formatted":"sent"},"digital_2":{"value":0,"formatted":"not_sent"},"analog_1":{"value":1,"formatted":"sent"},"analog_2":{"value":1,"formatted":"sent"},"ssi":{"value":0,"formatted":"not_sent"},"mbus":{"value":0,"formatted":"not_sent"}},"digital_1":{"state":{"input_state":{"value":0,"formatted":"open"},"operational_mode":{"value":0,"formatted":"pulse_mode"},"alert_state":{"value":0},"medium_type":{"value":1,"formatted":"pulses"}},"counter":{"value":0,"_unit":"pulses","formatted":"0 pulses"}},"analog_1":{"general":{"input_mode":{"value":1,"formatted":"mA"},"is_alert":{"value":0,"formatted":"no"},"instant_value_reported":{"value":1,"formatted":"reported"},"average_value_reported":{"value":1,"formatted":"reported"}},"instant_value":{"value":7.10091686248779296875,"_unit":"mA","formatted":"7.10 mA"},"average_value":{"value":7.276834964752197265625,"_unit":"mA","formatted":"7.28 mA"}},"analog_2":{"general":{"input_mode":{"value":1,"formatted":"mA"},"is_alert":{"value":0,"formatted":"no"},"instant_value_reported":{"value":1,"formatted":"reported"},"average_value_reported":{"value":1,"formatted":"reported"}},"instant_value":{"value":31.8725948333740234375,"_unit":"mA","formatted":"31.87 mA"},"average_value":{"value":31.768917083740234375,"_unit":"mA","formatted":"31.77 mA"}},"hex":"0d1000000000c1b63ae340d5dbe840c113fbfe41be26fe41"}' ],

    'OIR f24 (status_packet - analog)' => [ 'request' =>
        [ 'data' => 'Da8UXRAAAAAAQbY640BBuWj+QQ==', 'fport' => '24', 'serial' => '4d98005b' ],
        'results' => '{"packet_type":"status_packet","reported_interfaces":{"digital_1":{"value":1,"formatted":"sent"},"digital_2":{"value":0,"formatted":"not_sent"},"analog_1":{"value":1,"formatted":"sent"},"analog_2":{"value":1,"formatted":"sent"},"ssi":{"value":0,"formatted":"not_sent"},"mbus":{"value":0,"formatted":"not_sent"},"user_triggered_packet":{"value":0,"formatted":"no"},"temperature_triggered_packet":{"value":0,"formatted":"no"}},"battery":{"value":3.3620000000000000994759830064140260219573974609375,"_unit":"V","formatted":"3.362 V","value_raw":175},"mcu_temperature":{"value":20,"_unit":"\u00b0C","formatted":"20\u00b0C"},"downlink_rssi":{"value":-93,"_unit":"dBm","formatted":"-93 dBm"},"digital_1":{"state":{"input_state":{"value":0,"formatted":"open"},"operational_mode":{"value":0,"formatted":"pulse_mode"},"alert_state":{"value":0},"medium_type":{"value":1,"formatted":"pulses"}},"counter":{"value":0,"_unit":"pulses","formatted":"0 pulses"}},"analog_1":{"general":{"input_mode":{"value":1,"formatted":"mA"},"is_alert":{"value":0,"formatted":"no"},"instant_value_reported":{"value":1,"formatted":"reported"},"average_value_reported":{"value":0,"formatted":"not reported"}},"instant_value":{"value":7.10091686248779296875,"_unit":"mA","formatted":"7.10 mA"}},"analog_2":{"general":{"input_mode":{"value":1,"formatted":"mA"},"is_alert":{"value":0,"formatted":"no"},"instant_value_reported":{"value":1,"formatted":"reported"},"average_value_reported":{"value":0,"formatted":"not reported"}},"instant_value":{"value":31.8011341094970703125,"_unit":"mA","formatted":"31.80 mA"}},"hex":"0daf145d100000000041b63ae34041b968fe41"}' ],

    'OIR f24 (status_packet - status) 0.8 - 0.8.2' => [ 'request' =>
        [ 'data' => 'A2YQ4INApAYAABIAAAAA', 'fport' => '24', 'serial' => '4d98005b', 'firmware' => '0.8.1' ],
        'results' => '{"packet_type":"status_packet","reported_interfaces":{"digital_1":{"value":1,"formatted":"sent"},"digital_2":{"value":1,"formatted":"sent"},"analog_1":{"value":0,"formatted":"not_sent"},"analog_2":{"value":0,"formatted":"not_sent"},"ssi":{"value":0,"formatted":"not_sent"},"mbus":{"value":0,"formatted":"not_sent"},"user_triggered_packet":{"value":0,"formatted":"no"},"active_alerts":{"value":0,"formatted":"no"}},"battery_voltage":{"value":3.069999999999999840127884453977458178997039794921875,"_unit":"V","formatted":"3.07 V","value_raw":102},"mcu_temperature":{"value":16,"_unit":"\u00b0C","formatted":"16\u00b0C"},"temp_extremes":{"min_offset":{"value":0,"formatted":"0\u00b0C"},"max_offset":{"value":28,"formatted":"28\u00b0C"}},"downlink_rssi":{"value":-131,"_unit":"dBm","formatted":"-131 dBm"},"digital_1":{"state":{"input_state":{"value":0,"formatted":"open"},"operational_mode":{"value":0,"formatted":"pulse_mode"},"alert_state":{"value":0},"medium_type":{"value":4,"formatted":"L_gas"},"device_serial_sent":{"value":0}},"counter":{"value":1700,"_unit":"L_gas","formatted":"1700 L_gas"}},"digital_2":{"state":{"input_state":{"value":0,"formatted":"open"},"operational_mode":{"value":1,"formatted":"trigger_mode"},"alert_state":{"value":0},"medium_type":{"value":1,"formatted":"pulses"},"device_serial_sent":{"value":0}},"counter":{"value":0,"_unit":"pulses","formatted":"0 pulses"}},"hex":"036610e08340a40600001200000000"}' ],

    'OIR f25 (usage_packet - ssi)' => [ 'request' =>
        [ 'data' => 'ERAAAAAAAQ/WVoQ/04aEPz0KuUEdQLpB', 'fport' => '25', 'serial' => '4c1608e5' ],
        'results' => '{"packet_type":"usage_packet","reported_interfaces":{"digital_1":{"value":1,"formatted":"sent"},"digital_2":{"value":0,"formatted":"not_sent"},"analog_1":{"value":0,"formatted":"not_sent"},"analog_2":{"value":0,"formatted":"not_sent"},"ssi":{"value":1,"formatted":"sent"},"mbus":{"value":0,"formatted":"not_sent"}},"digital_1":{"state":{"input_state":{"value":0,"formatted":"open"},"operational_mode":{"value":0,"formatted":"pulse_mode"},"alert_state":{"value":0},"medium_type":{"value":1,"formatted":"pulses"}},"counter":{"value":0,"_unit":"pulses","formatted":"0 pulses"}},"ssi":{"general":{"ssi_index":{"value":1}},"reported_parameters":{"channel_1_instant":{"value":1,"formatted":"reported"},"channel_1_average":{"value":1,"formatted":"reported"},"channel_2_instant":{"value":1,"formatted":"reported"},"channel_2_average":{"value":1,"formatted":"reported"},"channel_3_instant":{"value":0,"formatted":"not reported"},"channel_3_average":{"value":0,"formatted":"not reported"},"channel_4_instant":{"value":0,"formatted":"not reported"},"channel_4_average":{"value":0,"formatted":"not reported"}},"channel_1_instant":{"value":1.0339000225067138671875,"_unit":"bar","formatted":"1.034 bar"},"channel_1_average":{"value":1.03536450862884521484375,"_unit":"bar","formatted":"1.035 bar"},"channel_2_instant":{"value":23.1299991607666015625,"_unit":"\u00b0C","formatted":"23.130 \u00b0C"},"channel_2_average":{"value":23.2813053131103515625,"_unit":"\u00b0C","formatted":"23.281 \u00b0C"}},"hex":"111000000000010fd656843fd386843f3d0ab9411d40ba41"}' ],

    'OIR f25 (usage_packet - mbus)' => [ 'request' =>
        [ 'data' => 'IxAAAAAAEAAAAAAADBZhdQEA', 'fport' => '25', 'serial' => '4D110007' ],
        'results' => '{"packet_type":"usage_packet","reported_interfaces":{"digital_1":{"value":1,"formatted":"sent"},"digital_2":{"value":1,"formatted":"sent"},"analog_1":{"value":0,"formatted":"not_sent"},"analog_2":{"value":0,"formatted":"not_sent"},"ssi":{"value":0,"formatted":"not_sent"},"mbus":{"value":1,"formatted":"sent"}},"digital_1":{"state":{"input_state":{"value":0,"formatted":"open"},"operational_mode":{"value":0,"formatted":"pulse_mode"},"alert_state":{"value":0},"medium_type":{"value":1,"formatted":"pulses"}},"counter":{"value":0,"_unit":"pulses","formatted":"0 pulses"}},"digital_2":{"state":{"input_state":{"value":0,"formatted":"open"},"operational_mode":{"value":0,"formatted":"pulse_mode"},"alert_state":{"value":0},"medium_type":{"value":1,"formatted":"pulses"}},"counter":{"value":0,"_unit":"pulses","formatted":"0 pulses"}},"mbus":{"state":{"last_status":{"value":0,"formatted":"ok"}},"data_records":{"1":{"_function":"instant value","value_type":"volume","_unit":" m\u00b3","_exp":0,"_encoding":"8 digit BCD","_header_raw":"0c16","_data_raw":"61750100","value":17561,"_value_raw":17561,"formatted":"17561 m\u00b3"}}},"hex":"2310000000001000000000000c1661750100"}' ],

    'OIR f53 (mbus_connect_packet)' => [ 'request' =>
        [ 'data' => 'AcA0E5cj1iVAB8QAAAAMeAwW', 'fport' => '53', 'serial' => '4D110007' ],
        'results' => '{"packet_type":"mbus_connect_packet","interface":"01","header":{"packet_number":{"value":0},"more_to_follow":{"value":0},"fixed_data_header":{"value":1,"formatted":"sent"},"data_record_headers_only":{"value":1,"formatted":"headers only"}},"mbus_fixed_header":{"id":"23971334","manufacturer":"INV","version":64,"medium":"water","access_number":196,"status":0,"signature":0},"record_headers":{"1":{"_function":"instant value","value_type":"fabrication number","_encoding":"8 digit BCD","header_raw":"0c78"},"2":{"_function":"instant value","value_type":"volume","_unit":" m\u00b3","_exp":0,"_encoding":"8 digit BCD","header_raw":"0c16"}},"hex":"01c034139723d6254007c40000000c780c16"}' ],


    'OIR f49 (general_config_response)' => [ 'request' =>
        [ 'data' => 'ADwAoAUAIxMAEwA0E5cjByEMFgwWDHg=', 'fport' => '49', 'serial' => '4D110007' ],
        'results' => '{"packet_type":"general_config_response","usage_interval":{"value":60,"_unit":"minutes","formatted":"60 minutes"},"status_interval":{"value":1440,"_unit":"minutes","formatted":"1440 minutes"},"usage_behaviour":{"send_always":{"value":"0","formatted":"only_when_fresh_data"}},"configured_interfaces":{"digital_1":{"value":"1","formatted":"sent"},"digital_2":{"value":"1","formatted":"sent"},"analog_1":{"value":"0","formatted":"not_sent"},"analog_2":{"value":"0","formatted":"not_sent"},"ssi":{"value":"0","formatted":"not_sent"},"mbus":{"value":"1","formatted":"sent"}},"digital_1":{"configured_parameters":{"interface_enabled":{"value":1,"formatted":"enabled"},"mode":{"value":1,"formatted":"sent"},"multiplier":{"value":0,"formatted":"not_sent"},"true_reading":{"value":0,"formatted":"not_sent"},"medium_type":{"value":1,"formatted":"pulses"}},"mode":{"operational_mode":{"value":0,"formatted":"pulse_mode"},"trigger_time":{"value":0,"formatted":"1_sec"}}},"digital_2":{"configured_parameters":{"interface_enabled":{"value":1,"formatted":"enabled"},"mode":{"value":1,"formatted":"sent"},"multiplier":{"value":0,"formatted":"not_sent"},"true_reading":{"value":0,"formatted":"not_sent"},"medium_type":{"value":1,"formatted":"pulses"}},"mode":{"operational_mode":{"value":0,"formatted":"pulse_mode"},"trigger_time":{"value":0,"formatted":"1_sec"}}},"mbus":{"mbus_device_serial":{"value":"23971334"},"configured_parameters":{"interface_enabled":{"value":1,"formatted":"enabled"},"data_records_in_usage":{"value":1,"formatted":"configured"},"data_records_in_status":{"value":1,"formatted":"configured"}},"data_records_for_packets":{"count_in_usage":{"value":1},"count_in_status":{"value":2}},"records":{"usage":[{"_function":"instant value","value_type":"volume","_unit":" m\u00b3","_exp":0,"_encoding":"8 digit BCD","header_raw":"0c16"}],"status":[{"_function":"instant value","value_type":"volume","_unit":" m\u00b3","_exp":0,"_encoding":"8 digit BCD","header_raw":"0c16"},{"_function":"instant value","value_type":"fabrication number","_encoding":"8 digit BCD","header_raw":"0c78"}]}},"hex":"003c00a0050023130013003413972307210c160c160c78"}' ],

    'OIR f49 (general_config_response) fw0.8.4' => [ 'request' =>
        [ 'data' => 'AQ9dAgoAAgBOYbwARDMiEQFDZneImQUBTwAAkEAzMxNBBQNPZmYGQJqZWUA=', 'fport' => '49', 'serial' => '4D110007', 'firmware' => '0.8.4' ],
        'results' => '{"packet_type":"general_config_response","configured_interfaces":{"digital_1":{"value":1,"formatted":"sent"},"digital_2":{"value":1,"formatted":"sent"},"analog_1":{"value":1,"formatted":"sent"},"analog_2":{"value":1,"formatted":"sent"},"ssi":{"value":0,"formatted":"not_sent"},"mbus":{"value":0,"formatted":"not_sent"}},"digital_1":{"configured_parameters":{"interface_enabled":{"value":1,"formatted":"enabled"},"multiplier":{"value":1,"formatted":"sent"},"true_reading":{"value":1,"formatted":"sent"},"medium_type":{"value":"05","formatted":"Wh_heat"}},"mode":{"operational_mode":{"value":0,"formatted":"pulse_mode"},"set_device_serial":{"value":1,"formatted":"yes"},"trigger_time":{"value":"00","formatted":"1_sec"}},"multiplier":{"value":10,"formatted":"10 "},"divider":{"value":2,"formatted":"2 "},"true_reading":{"value":12345678,"_unit":"Wh_heat","formatted":"12345678 Wh_heat"},"device_serial":"11223344"},"digital_2":{"configured_parameters":{"interface_enabled":{"value":1,"formatted":"enabled"},"multiplier":{"value":0,"formatted":"not_sent"},"true_reading":{"value":0,"formatted":"not_sent"},"medium_type":{"value":"00","formatted":"n\/a"}},"mode":{"operational_mode":{"value":1,"formatted":"trigger_mode"},"set_device_serial":{"value":1,"formatted":"yes"},"trigger_time":{"value":"01","formatted":"10_sec"}},"device_serial":"99887766"},"analog_1":{"configured_parameters":{"interface_enabled":{"value":1,"formatted":"enabled"},"reporting":{"value":1,"formatted":"sent"}},"general":{"sampling_rate":{"value":1,"formatted":"1_sec"},"input_mode":{"value":0,"formatted":"V"}},"reporting":{"alert_enabled":{"value":1,"formatted":"enabled"},"alert_limiting_thresholds":{"value":1,"formatted":"sent"},"instant_value_in_usage":{"value":1,"formatted":"report"},"average_value_in_usage":{"value":1,"formatted":"report"},"alert_triggered_after":{"value":"01"}},"alert_low_threshold":{"value":4.5,"_unit":"V","formatted":"4.50 V"},"alert_high_threshold":{"value":9.199999809265137,"_unit":"V","formatted":"9.20 V"}},"analog_2":{"configured_parameters":{"interface_enabled":{"value":1,"formatted":"enabled"},"reporting":{"value":1,"formatted":"sent"}},"general":{"sampling_rate":{"value":1,"formatted":"1_sec"},"input_mode":{"value":1,"formatted":"mA"}},"reporting":{"alert_enabled":{"value":1,"formatted":"enabled"},"alert_limiting_thresholds":{"value":1,"formatted":"sent"},"instant_value_in_usage":{"value":1,"formatted":"report"},"average_value_in_usage":{"value":1,"formatted":"report"},"alert_triggered_after":{"value":"01"}},"alert_low_threshold":{"value":2.0999999046325684,"_unit":"mA","formatted":"2.10 mA"},"alert_high_threshold":{"value":3.4000000953674316,"_unit":"mA","formatted":"3.40 mA"}},"hex":"010f5d020a0002004e61bc004433221101436677889905014f000090403333134105034f666606409a995940"}' ],

    'OIR f49 (reporting_config_respons) fw0.8.0' => [ 'request' =>
        [ 'data' => 'AAc8ANACAQ==', 'fport' => '49', 'serial' => '4d98005b', 'firmware' => '0.8.0' ],
        'results' => '{"packet_type":"reporting_config_response","configured_parameters":{"usage_interval":{"value":"1","formatted":"sent"},"status_interval":{"value":"1","formatted":"sent"},"usage_behaviour":{"value":"1","formatted":"sent"}},"usage_interval":{"value":60,"_unit":"minutes","formatted":"60 minutes"},"status_interval":{"value":720,"_unit":"minutes","formatted":"720 minutes"},"usage_behaviour":{"send_always":{"value":"1","formatted":"always"}},"hex":"00073c00d00201"}' ],

    'OIR f49 (general_config_response) fw0.8.3' => [ 'request' =>
        [ 'data' => 'AQ8tAAIAAwB4VjQSAAUABAUABA==', 'fport' => '49', 'serial' => '4d98005b', 'firmware' => '0.8.3' ],
        'results' => '{"packet_type":"general_config_response","configured_interfaces":{"digital_1":{"value":1,"formatted":"sent"},"digital_2":{"value":1,"formatted":"sent"},"analog_1":{"value":1,"formatted":"sent"},"analog_2":{"value":1,"formatted":"sent"},"ssi":{"value":0,"formatted":"not_sent"},"mbus":{"value":0,"formatted":"not_sent"}},"digital_1":{"configured_parameters":{"interface_enabled":{"value":1,"formatted":"enabled"},"multiplier":{"value":1,"formatted":"sent"},"true_reading":{"value":1,"formatted":"sent"},"medium_type":{"value":"02","formatted":"L_water"}},"mode":{"operational_mode":{"value":0,"formatted":"pulse_mode"},"set_device_serial":{"value":0,"formatted":"no"},"trigger_time":{"value":"00","formatted":"1_sec"}},"multiplier":{"value":2,"formatted":"2 "},"divider":{"value":3,"formatted":"3 "},"true_reading":{"value":305419896,"_unit":"L_water","formatted":"305419896 L_water"}},"digital_2":{"configured_parameters":{"interface_enabled":{"value":0,"formatted":"disabled"},"multiplier":{"value":0,"formatted":"not_sent"},"true_reading":{"value":0,"formatted":"not_sent"},"medium_type":{"value":"00","formatted":"n\/a"}}},"analog_1":{"configured_parameters":{"interface_enabled":{"value":1,"formatted":"enabled"},"reporting":{"value":1,"formatted":"sent"}},"general":{"sampling_rate":{"value":0,"formatted":"1_min"},"input_mode":{"value":0,"formatted":"V"}},"reporting":{"alert_enabled":{"value":0,"formatted":"disabled"},"alert_limiting_thresholds":{"value":0,"formatted":"not_sent"},"instant_value_in_usage":{"value":1,"formatted":"report"},"average_value_in_usage":{"value":0,"formatted":"do_not_report "},"alert_triggered_after":{"value":"00"}}},"analog_2":{"configured_parameters":{"interface_enabled":{"value":1,"formatted":"enabled"},"reporting":{"value":1,"formatted":"sent"}},"general":{"sampling_rate":{"value":0,"formatted":"1_min"},"input_mode":{"value":0,"formatted":"V"}},"reporting":{"alert_enabled":{"value":0,"formatted":"disabled"},"alert_limiting_thresholds":{"value":0,"formatted":"not_sent"},"instant_value_in_usage":{"value":1,"formatted":"report"},"average_value_in_usage":{"value":0,"formatted":"do_not_report "},"alert_triggered_after":{"value":"00"}}},"hex":"010f2d00020003007856341200050004050004"}' ],

    'OIR f49 (general_config_response - ssi) fw0.8.3' => [ 'request' =>
        [ 'data' => 'ARMALQIBAAEADgAAAHhWNBINBU/NzEw/AACAP08AALBBAADIQQ==', 'fport' => '49', 'serial' => '4d98005b', 'firmware' => '0.8.3' ],
        'results' => '{"packet_type":"general_config_response","configured_interfaces":{"digital_1":{"value":1,"formatted":"sent"},"digital_2":{"value":1,"formatted":"sent"},"analog_1":{"value":0,"formatted":"not_sent"},"analog_2":{"value":0,"formatted":"not_sent"},"ssi":{"value":1,"formatted":"sent"},"mbus":{"value":0,"formatted":"not_sent"}},"digital_1":{"configured_parameters":{"interface_enabled":{"value":0,"formatted":"disabled"},"multiplier":{"value":0,"formatted":"not_sent"},"true_reading":{"value":0,"formatted":"not_sent"},"medium_type":{"value":"00","formatted":"n\/a"}}},"digital_2":{"configured_parameters":{"interface_enabled":{"value":1,"formatted":"enabled"},"multiplier":{"value":1,"formatted":"sent"},"true_reading":{"value":1,"formatted":"sent"},"medium_type":{"value":"02","formatted":"L_water"}},"mode":{"operational_mode":{"value":0,"formatted":"pulse_mode"},"set_device_serial":{"value":1,"formatted":"yes"},"trigger_time":{"value":"00","formatted":"1_sec"}},"multiplier":{"value":1,"formatted":"1 "},"divider":{"value":1,"formatted":"1 "},"true_reading":{"value":14,"_unit":"L_water","formatted":"14 L_water"},"device_serial":"12345678"},"ssi":{"configured_parameters":{"interface_enabled":{"value":1,"formatted":"enabled"},"channel_1":{"value":1,"formatted":"sent"},"channel_2":{"value":1,"formatted":"sent"},"channel_3":{"value":0,"formatted":"not_sent"},"channel_4":{"value":0,"formatted":"not_sent"}},"general":{"sampling_rate":{"value":1,"formatted":"fast"}}},"channel_1":{"reporting":{"alert_enabled":{"value":1,"formatted":"enabled"},"alert_thresholds":{"value":1,"formatted":"sent"},"instant_value_in_usage":{"value":1,"formatted":"reported"},"average_value_in_usage":{"value":1,"formatted":"reported"},"alert_triggered_after":{"value":"01"}},"alert_low_threshold":{"value":0.800000011920929,"formatted":"0.80 "},"alert_high_threshold":{"value":1,"formatted":"1.00 "}},"channel_2":{"reporting":{"alert_enabled":{"value":1,"formatted":"enabled"},"alert_thresholds":{"value":1,"formatted":"sent"},"instant_value_in_usage":{"value":1,"formatted":"reported"},"average_value_in_usage":{"value":1,"formatted":"reported"},"alert_triggered_after":{"value":"01"}},"alert_low_threshold":{"value":22,"formatted":"22.00 "},"alert_high_threshold":{"value":25,"formatted":"25.00 "}},"hex":"0113002d02010001000e000000785634120d054fcdcc4c3f0000803f4f0000b0410000c841"}' ],
    
    'OIR f49 (general_config_response_analog) fw0.8.7' => [ 'request' =>
        [ 'data' => 'AQ89AgEAAQAwQasA776t3gFBAAA=', 'fport' => '49', 'serial' => '4d98005b', 'firmware' => '0.8.3' ],
        'results' => '{"packet_type":"general_config_response","configured_interfaces":{"digital_1":{"value":1,"formatted":"sent"},"digital_2":{"value":1,"formatted":"sent"},"analog_1":{"value":1,"formatted":"sent"},"analog_2":{"value":1,"formatted":"sent"},"ssi":{"value":0,"formatted":"not_sent"},"mbus":{"value":0,"formatted":"not_sent"}},"digital_1":{"configured_parameters":{"interface_enabled":{"value":1,"formatted":"enabled"},"multiplier":{"value":1,"formatted":"sent"},"true_reading":{"value":1,"formatted":"sent"},"medium_type":{"value":"03","formatted":"Wh_electricity"}},"mode":{"operational_mode":{"value":0,"formatted":"pulse_mode"},"set_device_serial":{"value":1,"formatted":"yes"},"trigger_time":{"value":"00","formatted":"1_sec"}},"multiplier":{"value":1,"formatted":"1 "},"divider":{"value":1,"formatted":"1 "},"true_reading":{"value":11223344,"_unit":"Wh_electricity","formatted":"11223344 Wh_electricity"},"device_serial":"deadbeef"},"digital_2":{"configured_parameters":{"interface_enabled":{"value":1,"formatted":"enabled"},"multiplier":{"value":0,"formatted":"not_sent"},"true_reading":{"value":0,"formatted":"not_sent"},"medium_type":{"value":"00","formatted":"n\/a"}},"mode":{"operational_mode":{"value":1,"formatted":"trigger_mode"},"set_device_serial":{"value":0,"formatted":"no"},"trigger_time":{"value":"01","formatted":"10_sec"}}},"analog_1":{"configured_parameters":{"interface_enabled":{"value":0,"formatted":"disabled"},"reporting":{"value":0,"formatted":"not_sent"}}},"analog_2":{"configured_parameters":{"interface_enabled":{"value":0,"formatted":"disabled"},"reporting":{"value":0,"formatted":"not_sent"}}},"hex":"010f3d02010001003041ab00efbeadde01410000"}' ],

    'OIR f49 (mbus_config_response)fw0.8' => [ 'request' =>
        [ 'data' => 'BA+IAglpMQwGC1oLYgwG', 'fport' => '49', 'serial' => '4d98005b', 'firmware' => '0.8.0' ],
        'results' => '{"packet_type":"mbus_config_response","configured_parameters":{"interface_enabled":{"value":1,"formatted":"enabled"},"data_records_in_usage":{"value":1,"formatted":"enabled"},"data_records_in_status":{"value":1,"formatted":"enabled"},"mbus_device_serial_sent":{"value":1,"formatted":"sent"}},"mbus_device_serial":"69090288","data_records_for_packets":{"count_in_usage":{"value":1},"count_in_status":{"value":3}},"records":{"usage":[{"_function":"instant value","value_type":"energy","_unit":" Wh","_exp":3,"_encoding":"8 digit BCD","header_raw":"0c06"}],"status":[{"_function":"instant value","value_type":"flow temperature","_unit":"\u00b0C","_exp":-1,"_encoding":"6 digit BCD","header_raw":"0b5a"},{"_function":"instant value","value_type":"temperature difference","_unit":"\u00b0C","_exp":-1,"_encoding":"6 digit BCD","header_raw":"0b62"},{"_function":"instant value","value_type":"energy","_unit":" Wh","_exp":3,"_encoding":"8 digit BCD","header_raw":"0c06"}]},"hex":"040f88020969310c060b5a0b620c06"}' ],

    'OIR f53 (mbus_connected_packet)fw0.8' => [ 'request' =>
        [ 'data' => 'BMCIAglppzIHBAEAAAAJdAlwDAYMFAstCzsLWgteC2IMeIkQcTwiDCIMJoyQEAabEC2bEDubEFqbEF6UEK1vlBC7b5QQ2m+UEN5vTAZMFHwiTCbMkBAG2xAt2xA72xBa2xBehI8PbQRt', 'fport' => '53', 'serial' => '4d98005b', 'firmware' => '0.8.0' ],
        'results' => '{"packet_type":"mbus_connect_packet","interface":"04","header":{"packet_number":{"value":0},"more_to_follow":{"value":0},"fixed_data_header":{"value":1,"formatted":"sent"},"data_record_headers_only":{"value":1,"formatted":"headers only"}},"mbus_fixed_header":{"id":"69090288","manufacturer":"LUG","version":7,"medium":"heat","access_number":1,"status":0,"signature":0},"record_headers":{"1":{"_function":"instant value","value_type":"actuality duration (in seconds)","_unit":" s","_encoding":"2 digit BCD","header_raw":"0974"},"2":{"_function":"instant value","value_type":"averaging duration (in seconds)","_unit":" s","_encoding":"2 digit BCD","header_raw":"0970"},"3":{"_function":"instant value","value_type":"energy","_unit":" Wh","_exp":3,"_encoding":"8 digit BCD","header_raw":"0c06"},"4":{"_function":"instant value","value_type":"volume","_unit":" m\u00b3","_exp":-2,"_encoding":"8 digit BCD","header_raw":"0c14"},"5":{"_function":"instant value","value_type":"power","_unit":" W","_exp":2,"_encoding":"6 digit BCD","header_raw":"0b2d"},"6":{"_function":"instant value","value_type":"volume flow","_unit":" m\u00b3\/h","_exp":-3,"_encoding":"6 digit BCD","header_raw":"0b3b"},"7":{"_function":"instant value","value_type":"flow temperature","_unit":"\u00b0C","_exp":-1,"_encoding":"6 digit BCD","header_raw":"0b5a"},"8":{"_function":"instant value","value_type":"return temperature","_unit":"\u00b0C","_exp":-1,"_encoding":"6 digit BCD","header_raw":"0b5e"},"9":{"_function":"instant value","value_type":"temperature difference","_unit":"\u00b0C","_exp":-1,"_encoding":"6 digit BCD","header_raw":"0b62"},"10":{"_function":"instant value","value_type":"fabrication number","_encoding":"8 digit BCD","header_raw":"0c78"},"11":{"_tariff":1,"_function":"instant value","value_type":"averaging duration (in minutes)","_unit":" min","_encoding":"2 digit BCD","header_raw":"891071"},"12":{"_function":"value during error state","value_type":"(during error) operating time (in hours)","_unit":" h","_encoding":"8 digit BCD","header_raw":"3c22"},"13":{"_function":"instant value","value_type":"operating time (in hours)","_unit":" h","_encoding":"8 digit BCD","header_raw":"0c22"},"14":{"_function":"instant value","value_type":"on time (in hours)","_unit":" h","_encoding":"8 digit BCD","header_raw":"0c26"},"15":{"_tariff":5,"_function":"instant value","value_type":"energy","_unit":" Wh","_exp":3,"_encoding":"8 digit BCD","header_raw":"8c901006"},"16":{"_tariff":1,"_function":"maximum value","value_type":"(maximum) power","_unit":" W","_exp":2,"_encoding":"6 digit BCD","header_raw":"9b102d"},"17":{"_tariff":1,"_function":"maximum value","value_type":"(maximum) volume flow","_unit":" m\u00b3\/h","_exp":-3,"_encoding":"6 digit BCD","header_raw":"9b103b"},"18":{"_tariff":1,"_function":"maximum value","value_type":"(maximum) flow temperature","_unit":"\u00b0C","_exp":-1,"_encoding":"6 digit BCD","header_raw":"9b105a"},"19":{"_tariff":1,"_function":"maximum value","value_type":"(maximum) return temperature","_unit":"\u00b0C","_exp":-1,"_encoding":"6 digit BCD","header_raw":"9b105e"},"20":{"_tariff":1,"_function":"maximum value","value_type":"(maximum) date-time of last end of power","_encoding":"32 bit integer","header_raw":"9410ad6f"},"21":{"_tariff":1,"_function":"maximum value","value_type":"(maximum) date-time of last end of volume flow","_encoding":"32 bit integer","header_raw":"9410bb6f"},"22":{"_tariff":1,"_function":"maximum value","value_type":"(maximum) date-time of last end of flow temperature","_encoding":"32 bit integer","header_raw":"9410da6f"},"23":{"_tariff":1,"_function":"maximum value","value_type":"(maximum) date-time of last end of return temperature","_encoding":"32 bit integer","header_raw":"9410de6f"},"24":{"storage_num":1,"_function":"instant value","value_type":"energy","_unit":" Wh","_exp":3,"_encoding":"8 digit BCD","header_raw":"4c06"},"25":{"storage_num":1,"_function":"instant value","value_type":"volume","_unit":" m\u00b3","_exp":-2,"_encoding":"8 digit BCD","header_raw":"4c14"},"26":{"storage_num":1,"_function":"value during error state","value_type":"(during error) operating time (in hours)","_unit":" h","_encoding":"8 digit BCD","header_raw":"7c22"},"27":{"storage_num":1,"_function":"instant value","value_type":"on time (in hours)","_unit":" h","_encoding":"8 digit BCD","header_raw":"4c26"},"28":{"storage_num":1,"_tariff":5,"_function":"instant value","value_type":"energy","_unit":" Wh","_exp":3,"_encoding":"8 digit BCD","header_raw":"cc901006"},"29":{"storage_num":1,"_tariff":1,"_function":"maximum value","value_type":"(maximum) power","_unit":" W","_exp":2,"_encoding":"6 digit BCD","header_raw":"db102d"},"30":{"storage_num":1,"_tariff":1,"_function":"maximum value","value_type":"(maximum) volume flow","_unit":" m\u00b3\/h","_exp":-3,"_encoding":"6 digit BCD","header_raw":"db103b"},"31":{"storage_num":1,"_tariff":1,"_function":"maximum value","value_type":"(maximum) flow temperature","_unit":"\u00b0C","_exp":-1,"_encoding":"6 digit BCD","header_raw":"db105a"},"32":{"storage_num":1,"_tariff":1,"_function":"maximum value","value_type":"(maximum) return temperature","_unit":"\u00b0C","_exp":-1,"_encoding":"6 digit BCD","header_raw":"db105e"},"33":{"storage_num":510,"_tariff":0,"_function":"instant value","value_type":"time point (time & date)","_encoding":"32 bit integer","header_raw":"848f0f6d"},"34":{"_function":"instant value","value_type":"time point (time & date)","_encoding":"32 bit integer","header_raw":"046d"}},"hex":"04c088020969a732070401000000097409700c060c140b2d0b3b0b5a0b5e0b620c788910713c220c220c268c9010069b102d9b103b9b105a9b105e9410ad6f9410bb6f9410da6f9410de6f4c064c147c224c26cc901006db102ddb103bdb105adb105e848f0f6d046d"}' ],

    #OIR TX PACKETS

    /*'OIR f50 TX(reporting_config_packet)(only usage)fw0.8' => [ 'request' =>
        [ 'data' => 'AAEKAA==', 'fport' => '50', 'serial' => '4d98005b', 'firmware' => '0.8.0' ],
        'results' => '{"packet_type":"reporting_config_packet","configured_parameters":{"usage_interval":{"value":"1","formatted":"sent"},"usage_interval":{"value":10,"_unit":"minutes","formatted":"10 minutes"}}}'],
    */
    /**
     *
     * MLM
     *
     */

    'MLM f24 (status_packet)' => [ 'request' =>
        [ 'data' => '7FEAAKUHAAAA', 'fport' => '24', 'serial' => '4C11004D' ],
        'results' => '{"packet_type":"status_packet","metering_data":{"value":20972,"_unit":"L","formatted":"20972 L"},"battery":{"value":2.83,"_unit":"V","formatted":"2.83 V","value_raw":165},"temperature":{"value":7,"_unit":"\u00b0C","formatted":"7\u00b0C"},"rssi":{"value":0,"_unit":"dBm","formatted":"0 dBm"},"mode":"00000000","alerts":"00000000","hex":"ec510000a507000000"}' ],

    'MLM f99 (boot_packet)' => [ 'request' =>
        [ 'data' => 'AE0CEUwABgECBAB5AGUBAAAAAA==', 'fport' => '99', 'serial' => '4C11004D' ],
        'results' => '{"packet_type":"boot_packet","device_serial":"4c11024d","firmware_version":"0.6.1","reset_reason":["watchdog_reset"],"calibration_debug ":"0400790065010000","hex":"004d02114c0006010204007900650100000000"}' ],

    'MLM f99 (shutdown_packet)' => [ 'request' =>
        [ 'data' => 'ATGbAAAAxxcAAAA=', 'fport' => '99', 'serial' => '4C11004D' ],
        'results' => '{"packet_type":"shutdown_packet","shutdown_reason":{"value":"31","formatted":"magnet_shutdown"},"metering_data":{"value":155,"_unit":"L","formatted":"155 L"},"battery":{"value":2.965999999999999747757328805164434015750885009765625,"_unit":"V","formatted":"2.966 V","value_raw":199},"temperature":{"value":23,"_unit":"\u00b0C","formatted":"23\u00b0C"},"rssi":{"value":0,"_unit":"dBm","formatted":"0 dBm"},"mode":"00000000","alerts":"00000000","hex":"01319b000000c717000000"}' ],


    /**
     *
     * KLM
     *
     */

    'KLM f99 (boot_packet)' => [ 'request' =>
        [ 'data' => 'ABMAHk0ACAKrG8UEAHetAAA2AQAYGBQAGwIAAAEwZQlc', 'fport' => '99', 'serial' => '4D1E0013' ],
        'results' => '{"packet_type":"boot_packet","device_serial":"4d1e0013","firmware_version":"0.8.2","kamstrup_meter_id":{"value":80026539,"formatted":"80026539 "},"kamstrup_config_a":"00ad7700","kamstrup_config_b":"14181800013600","kamstrup_type":"00021b00","device_mode":"00000000","clock":{"value":157626369,"formatted":"157626369 "},"hex":"0013001e4d000802ab1bc5040077ad0000360100181814001b020000013065095c"}' ],


    'KLM f24 (status_packet) fw0.8.2' => [ 'request' =>
        [ 'data' => 'dwv1VVz/AAIAAAAADQAAAAATAHiTRRcK18dBGKRwx0EbzMxMPR4AAAAAIAAAAAA=', 'fport' => '24', 'serial' => '4D1E0013', 'firmware' => '0.8.2' ],
        'results' => '{"packet_type":"status_packet","measuring_time":{"value":"19:50","formatted":"19:50 UTC","value_raw":119,"_unit":"UTC"},"clock":{"value":"02.02.2019 19:52:43","formatted":"02.02.2019 19:52:43 UTC","value_raw":1549137163,"_unit":"UTC"},"battery":{"value":"no battery info","formatted":"no battery info V","value_raw":255,"_unit":"V"},"rssi":{"value":0,"formatted":"0 dBm","_unit":"dBm"},"register":[{"register_id":{"value":2,"formatted":"E1","description":"Energy register 1: Heat energy","_value_formatter":"%.3f %s","_value_type":"float","_unit":"kWh"},"register_value":{"value":0,"formatted":"0.000 kWh","_unit":"kWh"}},{"register_id":{"value":13,"formatted":"V1","description":"Volume register V1","_value_formatter":"%.3f %s","_value_type":"float","_unit":"m3"},"register_value":{"value":0,"formatted":"0.000 m3","_unit":"m3"}},{"register_id":{"value":19,"formatted":"HR","description":"Operational hour counter","_value_formatter":"%d","_value_type":"uint32"},"register_value":{"value":4719,"formatted":"4719"}},{"register_id":{"value":23,"formatted":"T1","description":"Current flow temperature","_value_formatter":"%.2f %s","_value_type":"float","_unit":"\u00b0C"},"register_value":{"value":24.979999542236328,"formatted":"24.98 \u00b0C","_unit":"\u00b0C"}},{"register_id":{"value":24,"formatted":"T2","description":"Current return flow temperature","_value_formatter":"%.2f %s","_value_type":"float","_unit":"\u00b0C"},"register_value":{"value":24.93000030517578,"formatted":"24.93 \u00b0C","_unit":"\u00b0C"}},{"register_id":{"value":27,"formatted":"T1-T2","description":"Current temperature difference","_value_formatter":"%.2f %s","_value_type":"float","_unit":"\u00b0C"},"register_value":{"value":0.04999999701976776,"formatted":"0.05 \u00b0C","_unit":"\u00b0C"}},{"register_id":{"value":30,"formatted":"FLOW1","description":"Current flow in flow","_value_formatter":"%.2f %s","_value_type":"float","_unit":"l\/h"},"register_value":{"value":0,"formatted":"0.00 l\/h","_unit":"l\/h"}},{"register_id":{"value":32,"formatted":"EFFEKT1 (POWER)","description":"Current power calculated on the basis of V1-T1-T2","_value_formatter":"%.3f %s","_value_type":"float","_unit":"kW"},"register_value":{"value":0,"formatted":"0.000 kW","_unit":"kW"}}],"hex":"770bf5555cff0002000000000d000000001300789345170ad7c74118a470c7411bcccc4c3d1e000000002000000000"}' ],

    'KLM f25 (usage_packet) fw0.8.2' => [ 'request' =>
        [ 'data' => 'AP8Ne7TLQwIBsDpFEwDwpEUX4Xo1Qhh7FBxCHgBAD0QgMzODQBYAAAAAHAAAAAA=', 'fport' => '25', 'serial' => '4D1E0013', 'firmware' => '0.8.2' ],
        'results' => '{"packet_type":"usage_packet","header":"00","measuring_time":{"value":"Live","formatted":"Live","value_raw":255,"_unit":"UTC"},"register":[{"register_id":{"value":13,"formatted":"V1","description":"Volume register V1","_value_formatter":"%.3f %s","_value_type":"float","_unit":"m3"},"register_value":{"value":407.4100036621094,"formatted":"407.410 m3","_unit":"m3"}},{"register_id":{"value":2,"formatted":"E1","description":"Energy register 1: Heat energy","_value_formatter":"%.3f %s","_value_type":"float","_unit":"kWh"},"register_value":{"value":2987.000244140625,"formatted":"2987.000 kWh","_unit":"kWh"}},{"register_id":{"value":19,"formatted":"HR","description":"Operational hour counter","_value_formatter":"%d","_value_type":"uint32"},"register_value":{"value":5278,"formatted":"5278"}},{"register_id":{"value":23,"formatted":"T1","description":"Current flow temperature","_value_formatter":"%.2f %s","_value_type":"float","_unit":"\u00b0C"},"register_value":{"value":45.369998931884766,"formatted":"45.37 \u00b0C","_unit":"\u00b0C"}},{"register_id":{"value":24,"formatted":"T2","description":"Current return flow temperature","_value_formatter":"%.2f %s","_value_type":"float","_unit":"\u00b0C"},"register_value":{"value":39.02000045776367,"formatted":"39.02 \u00b0C","_unit":"\u00b0C"}},{"register_id":{"value":30,"formatted":"FLOW1","description":"Current flow in flow","_value_formatter":"%.2f %s","_value_type":"float","_unit":"l\/h"},"register_value":{"value":573,"formatted":"573.00 l\/h","_unit":"l\/h"}},{"register_id":{"value":32,"formatted":"EFFEKT1 (POWER)","description":"Current power calculated on the basis of V1-T1-T2","_value_formatter":"%.3f %s","_value_type":"float","_unit":"kW"},"register_value":{"value":4.099999904632568,"formatted":"4.100 kW","_unit":"kW"}},{"register_id":{"value":22,"formatted":"INFO","description":"Infocode register, current","_value_formatter":"%d","_value_type":"uint32"},"register_value":{"value":0,"formatted":"0"}},{"register_id":{"value":28,"formatted":"P1","description":"Pressure in flow","_value_formatter":"%.2f %s","_value_type":"float","_unit":"Bar"},"register_value":{"value":0,"formatted":"0.00 Bar","_unit":"Bar"}}],"hex":"00ff0d7bb4cb430201b03a451300f0a44517e17a3542187b141c421e00400f44203333834016000000001c00000000"}' ],


    'KLM f25 (usage_packet) fw0.5.2' => [ 'request' =>
        [ 'data' => 'AA0azc9HAuFCZ0UTAH4MRxd7lKRCGM3MQkIeAMDARSCaGW5DFgAAAAAcAAAAAA==', 'fport' => '25', 'serial' => '4D1E0013', 'firmware' => '0.5.2' ],
        'results' => '{"packet_type":"usage_packet","header":"00","register":[{"register_id":{"value":13,"formatted":"V1","description":"Volume register V1","_value_formatter":"%.3f %s","_value_type":"float","_unit":"m3"},"register_value":{"value":106394.203125,"formatted":"106394.203 m3","_unit":"m3"}},{"register_id":{"value":2,"formatted":"E1","description":"Energy register 1: Heat energy","_value_formatter":"%.3f %s","_value_type":"float","_unit":"kWh"},"register_value":{"value":3700.179931640625,"formatted":"3700.180 kWh","_unit":"kWh"}},{"register_id":{"value":19,"formatted":"HR","description":"Operational hour counter","_value_formatter":"%d","_value_type":"uint32"},"register_value":{"value":35966,"formatted":"35966"}},{"register_id":{"value":23,"formatted":"T1","description":"Current flow temperature","_value_formatter":"%.2f %s","_value_type":"float","_unit":"\u00b0C"},"register_value":{"value":82.29000091552734,"formatted":"82.29 \u00b0C","_unit":"\u00b0C"}},{"register_id":{"value":24,"formatted":"T2","description":"Current return flow temperature","_value_formatter":"%.2f %s","_value_type":"float","_unit":"\u00b0C"},"register_value":{"value":48.70000076293945,"formatted":"48.70 \u00b0C","_unit":"\u00b0C"}},{"register_id":{"value":30,"formatted":"FLOW1","description":"Current flow in flow","_value_formatter":"%.2f %s","_value_type":"float","_unit":"l\/h"},"register_value":{"value":6168,"formatted":"6168.00 l\/h","_unit":"l\/h"}},{"register_id":{"value":32,"formatted":"EFFEKT1 (POWER)","description":"Current power calculated on the basis of V1-T1-T2","_value_formatter":"%.3f %s","_value_type":"float","_unit":"kW"},"register_value":{"value":238.10000610351562,"formatted":"238.100 kW","_unit":"kW"}},{"register_id":{"value":22,"formatted":"INFO","description":"Infocode register, current","_value_formatter":"%d","_value_type":"uint32"},"register_value":{"value":0,"formatted":"0"}},{"register_id":{"value":28,"formatted":"P1","description":"Pressure in flow","_value_formatter":"%.2f %s","_value_type":"float","_unit":"Bar"},"register_value":{"value":0,"formatted":"0.00 Bar","_unit":"Bar"}}],"hex":"000d1acdcf4702e142674513007e0c47177b94a44218cdcc42421e00c0c045209a196e4316000000001c00000000"}' ],


    'KLM f25 (usage_packet) fw xx' => [ 'request' =>
        [ 'data' => 'AP8NhasSRgKnW09DEwDMP0YX9qiKQhh7FCVCHgCA/UMgZ2aCQRYAAAAAHAAAAAA=', 'fport' => '25', 'serial' => '4D1E0013', 'firmware' => '0.8.0' ],
        'results' => '{"packet_type":"usage_packet","header":"00","measuring_time":{"value":"Live","formatted":"Live","value_raw":255,"_unit":"UTC"},"register":[{"register_id":{"value":13,"formatted":"V1","description":"Volume register V1","_value_formatter":"%.3f %s","_value_type":"float","_unit":"m3"},"register_value":{"value":9386.8798828125,"formatted":"9386.880 m3","_unit":"m3"}},{"register_id":{"value":2,"formatted":"E1","description":"Energy register 1: Heat energy","_value_formatter":"%.3f %s","_value_type":"float","_unit":"kWh"},"register_value":{"value":207.35801696777344,"formatted":"207.358 kWh","_unit":"kWh"}},{"register_id":{"value":19,"formatted":"HR","description":"Operational hour counter","_value_formatter":"%d","_value_type":"uint32"},"register_value":{"value":12275,"formatted":"12275"}},{"register_id":{"value":23,"formatted":"T1","description":"Current flow temperature","_value_formatter":"%.2f %s","_value_type":"float","_unit":"\u00b0C"},"register_value":{"value":69.33000183105469,"formatted":"69.33 \u00b0C","_unit":"\u00b0C"}},{"register_id":{"value":24,"formatted":"T2","description":"Current return flow temperature","_value_formatter":"%.2f %s","_value_type":"float","_unit":"\u00b0C"},"register_value":{"value":41.27000045776367,"formatted":"41.27 \u00b0C","_unit":"\u00b0C"}},{"register_id":{"value":30,"formatted":"FLOW1","description":"Current flow in flow","_value_formatter":"%.2f %s","_value_type":"float","_unit":"l\/h"},"register_value":{"value":507,"formatted":"507.00 l\/h","_unit":"l\/h"}},{"register_id":{"value":32,"formatted":"EFFEKT1 (POWER)","description":"Current power calculated on the basis of V1-T1-T2","_value_formatter":"%.3f %s","_value_type":"float","_unit":"kW"},"register_value":{"value":16.30000114440918,"formatted":"16.300 kW","_unit":"kW"}},{"register_id":{"value":22,"formatted":"INFO","description":"Infocode register, current","_value_formatter":"%d","_value_type":"uint32"},"register_value":{"value":0,"formatted":"0"}},{"register_id":{"value":28,"formatted":"P1","description":"Pressure in flow","_value_formatter":"%.2f %s","_value_type":"float","_unit":"Bar"},"register_value":{"value":0,"formatted":"0.00 Bar","_unit":"Bar"}}],"hex":"00ff0d85ab124602a75b4f431300cc3f4617f6a88a42187b1425421e0080fd43206766824116000000001c00000000"}' ],
    
    'KLM f24 (status_packet) fw0.9.0' => [ 'request' =>
        [ 'data' => '/zhK6l3/tAHm6gIAFRLhAQACAAAAADurG8UE', 'fport' => '24', 'serial' => '4D1E0013', 'firmware' => '0.9.0' ],
        'results' => '{"packet_type":"status_packet","measuring_time":{"value":"Live","formatted":"Live","value_raw":255,"_unit":"UTC"},"clock":{"value":"06.12.2019 12:31:52","formatted":"06.12.2019 12:31:52 UTC","value_raw":1575635512,"_unit":"UTC"},"battery":{"value":"no battery info","formatted":"no battery info V","value_raw":255,"_unit":"V"},"rssi":{"value":76,"formatted":"76 dBm","_unit":"dBm"},"register":[{"register_id":{"value":1,"formatted":"DATE","description":"Current date (YY-MMDD)","_value_formatter":"%d","_value_type":"uint32"},"register_value":{"value":191206,"formatted":"191206"}},{"register_id":{"value":21,"formatted":"CLOCK","description":"Current time (hhmmss)","_value_formatter":"%d","_value_type":"uint32"},"register_value":{"value":123154,"formatted":"123154"}},{"register_id":{"value":2,"formatted":"E1","description":"Energy register 1: Heat energy","_value_formatter":"%.3f %s","_value_type":"float","_unit":"kWh"},"register_value":{"value":0,"formatted":"0.000 kWh","_unit":"kWh"}},{"register_id":{"value":59,"formatted":"SERIAL NO","description":"Serial no. (unique number for each meter) (or custom. num)","_value_formatter":"%d","_value_type":"uint32"},"register_value":{"value":80026539,"formatted":"80026539"}}],"hex":"ff384aea5dffb401e6ea02001512e1010002000000003bab1bc504"}' ],


    /**
     *
     * WMR
     *
     */

    'WMR f24 (status_packet)' => [ 'request' =>
        [ 'data' => 'vgAAADwOiUwA', 'fport' => '24', 'serial' => '35100076' ],
        'results' => '{"packet_type":"status_packet","metering_data":{"value":190,"_unit":"L","formatted":"190 L"},"battery":{"value":2.902,"_unit":"V","formatted":"2.902 V","value_raw":60},"temp":{"value":14,"_unit":"C","formatted":"14 C"},"rssi":{"value":-137,"_unit":"dBm","formatted":"-137 dBm"},"mode":"01001100","alerts":"00000000","hex":"be0000003c0e894c00"}' ],


    'WMR f99 (boot_packet)' => [ 'request' =>
        [ 'data' => 'AHYAEDUAApg=', 'fport' => '99', 'serial' => '35100076' ],
        'results' => '{"packet_type":"boot_packet","device_serial":"35100076","firmware_version":"0.2.152","hex":"0076001035000298"}' ],


    /**
     *
     * LGM
     *
     */

    'LGM f99 (boot_packet)' => [ 'request' =>
        [ 'data' => 'AJ0AkksABAAARJg5OBYDAAA=', 'fport' => '99', 'serial' => '4b92009d' ],
        'results' => '{"packet_type":"boot_packet","device_serial":"4b92009d","firmware_version":"0.4.0","card_count":{"value":17408,"formatted":"17408 "},"switch_direction":"98","hex":"009d00924b000400004498393816030000"}' ],


    /**
     *
     * LWM
     *
     */

    'LWM F18 (Kamstrup MC21 Full frame)' => [ 'request' =>
        [ 'data' => 'IkQtLEaGFGMXBo0g0WDx6AOKjXgC/yAPAAQTL4UHAFI7AAA=', 'fport' => '18', 'serial' => '4c12002c',  'encrypt_key'=>'00000000000000000000000000000000' ],
        'results' => '{"wmbus":{"header":{"_control":"primary station, unidirectional","manufacturer":{"value":"KAM","_value_raw":"2d2c","formatted":"Kamstrup Energi A\/S"},"serial":"63148646","version":"17","device_type":{"formatted":"hot water","value":"06"},"_control_information":"full_frame"},"_payload_hex":"02ff200f0004132f850700523b0000","data_records":{"1":{"_function":"instant value","value_type":"manufacturer specific vife\'s and data","_encoding":"16 bit integer","_header_raw":"02ff20","_data_raw":"0f00","value":15,"_value_raw":15,"formatted":"15"},"2":{"_function":"instant value","value_type":"volume","_unit":" m\u00b3","_exp":-3,"_encoding":"32 bit integer","_header_raw":"0413","_data_raw":"2f850700","value":492.84700000000004,"_value_raw":492847,"formatted":"492.847 m\u00b3"},"3":{"storage_num":1,"_function":"maximum value","value_type":"(maximum) volume flow","_unit":" m\u00b3\/h","_exp":-3,"_encoding":"16 bit integer","_header_raw":"523b","_data_raw":"0000","value":0,"_value_raw":0,"formatted":"0 m\u00b3\/h"}}},"hex":"22442d2c4686146317068d20d160f1e8038a8d7802ff200f0004132f850700523b0000"}' ],

    'LWM f24 (status_packet)' => [ 'request' =>
        [ 'data' => 'AQAAAPUPAAAACQAAfgeQB2MHqwdyB6YH', 'fport' => '24', 'serial' => '4c12002c' ],
        'results' => '{"packet_type":"status_packet","metering_data":{"value":1,"_unit":"L","formatted":"1 L"},"battery":{"value":3.641999999999999904076730672386474907398223876953125,"_unit":"V","formatted":"3.642 V","value_raw":245},"temperature":{"value":15,"_unit":"\u00b0C","formatted":"15\u00b0C"},"rssi":{"value":0,"_unit":"dBm","formatted":"0 dBm"},"mode":"00000000","alerts":"00000000","noise":{"value":9,"formatted":"9 "},"accumulated_delta":{"value":0,"formatted":"0 "},"dec":[{"value":1918,"formatted":"1918 "},{"value":1936,"formatted":"1936 "}],"afe_1":{"min":{"value":1891,"formatted":"1891 "},"max":{"value":1963,"formatted":"1963 "}},"afe_2":{"min":{"value":1906,"formatted":"1906 "},"max":{"value":1958,"formatted":"1958 "}},"hex":"01000000f50f0000000900007e0790076307ab077207a607"}' ],


    'LWM f24 (status_packet - first)' => [ 'request' =>
        [ 'data' => '/////98SAAAABAAA/////wEHBwf/////', 'fport' => '24', 'serial' => '4c12002c' ],
        'results' => '{"packet_type":"status_packet","metering_data":{"value":4294967295,"_unit":"L","formatted":"n\/a"},"battery":{"value":3.553999999999999825917029738775454461574554443359375,"_unit":"V","formatted":"3.554 V","value_raw":223},"temperature":{"value":18,"_unit":"\u00b0C","formatted":"18\u00b0C"},"rssi":{"value":0,"_unit":"dBm","formatted":"0 dBm"},"mode":"00000000","alerts":"00000000","noise":{"value":4,"formatted":"4 "},"accumulated_delta":{"value":0,"formatted":"0 "},"dec":[{"value":65535,"formatted":"65535 "},{"value":65535,"formatted":"65535 "}],"afe_1":{"min":{"value":1793,"formatted":"1793 "},"max":{"value":1799,"formatted":"1799 "}},"afe_2":{"min":{"value":65535,"formatted":"65535 "},"max":{"value":65535,"formatted":"65535 "}},"hex":"ffffffffdf12000000040000ffffffff01070707ffffffff"}' ],

    'LWM f24 (status_packet - 0.2.27)' => [ 'request' =>
        [ 'data' => 'HFcAAHITsRAAkQbDBwAA8Ab3BwAAoQa4BwAA3wbwBwAAAAoABwEAAAA=', 'fport' => '24', 'serial' => '4c12002c', 'firmware' => '0.2.27' ],
        'results' => '{"packet_type":"status_packet","metering_data":{"value":22300,"_unit":"L","formatted":"22300 L"},"battery":{"value":3.117999999999999882760448599583469331264495849609375,"_unit":"V","formatted":"3.118 V","value_raw":114},"temperature":{"value":19,"_unit":"\u00b0C","formatted":"19\u00b0C"},"rssi":{"value":-79,"_unit":"dBm","formatted":"-79 dBm"},"mode":"00010000","alerts":"00000000","afe_1_min":{"ch1":{"value":1681,"formatted":"1681 "},"ch2":{"value":1987,"formatted":"1987 "},"ch3":{"value":0,"formatted":"0 "}},"afe_1_max":{"ch1":{"value":1776,"formatted":"1776 "},"ch2":{"value":2039,"formatted":"2039 "},"ch3":{"value":0,"formatted":"0 "}},"afe_2_min":{"ch1":{"value":1697,"formatted":"1697 "},"ch2":{"value":1976,"formatted":"1976 "},"ch3":{"value":0,"formatted":"0 "}},"afe_2_max":{"ch1":{"value":1759,"formatted":"1759 "},"ch2":{"value":2032,"formatted":"2032 "},"ch3":{"value":0,"formatted":"0 "}},"recalib_delta":{"ch1":{"value":0,"formatted":"0 "},"ch2":{"value":10,"formatted":"10 "},"ch3":{"value":0,"formatted":"0 "}},"initial_noise":{"ch1":{"value":7,"formatted":"7 "},"ch2":{"value":1,"formatted":"1 "},"ch3":{"value":0,"formatted":"0 "}},"error_count":{"value":0,"formatted":"0 "},"hex":"1c5700007213b110009106c3070000f006f7070000a106b8070000df06f0070000000a000701000000"}' ],


    'LWM f99 (shutdown_packet)' => [ 'request' =>
        [ 'data' => 'ATEZAAAA6xEAAAAIAACTB6MHiwerB5IHsgc=', 'fport' => '99', 'serial' => '4c12002c' ],
        'results' => '{"packet_type":"shutdown_packet","shutdown_reason":{"value":"31","formatted":"magnet_shutdown"},"metering_data":{"value":25,"_unit":"L","formatted":"25 L"},"battery":{"value":3.601999999999999868549593884381465613842010498046875,"_unit":"V","formatted":"3.602 V","value_raw":235},"temperature":{"value":17,"_unit":"\u00b0C","formatted":"17\u00b0C"},"rssi":{"value":0,"_unit":"dBm","formatted":"0 dBm"},"mode":"00000000","alerts":"00000000","noise":{"value":8,"formatted":"8 "},"accumulated_delta":{"value":0,"formatted":"0 "},"dec":[{"value":1939,"formatted":"1939 "},{"value":1955,"formatted":"1955 "}],"afe_1":{"min":{"value":1931,"formatted":"1931 "},"max":{"value":1963,"formatted":"1963 "}},"afe_2":{"min":{"value":1938,"formatted":"1938 "},"max":{"value":1970,"formatted":"1970 "}},"hex":"013119000000eb110000000800009307a3078b07ab079207b207"}' ],

    'LWM f99 (boot_packet)' => [ 'request' =>
        [ 'data' => 'ACwAEkwAAQgQAAAAAAAAAAAAAA==', 'fport' => '99', 'serial' => '4c12002c' ],
        'results' => '{"packet_type":"boot_packet","device_serial":"4c12002c","firmware_version":"0.1.8","reset_reason":["magnet_wakeup"],"calibration_debug ":"0000000000000000","hex":"002c00124c0001081000000000000000000000"}' ],
    // UKW 1.0 ******************************************************************************'

    /**
     *
     * UKW
     *
     */

    'UKW f99 (shutdown_packet)1.0.0' => [ 'request' =>
        [ 'data' => 'ATMBEABkgBIArgcDAAAAAAAA', 'fport' => '99', 'serial' => '4c12002c', 'firmware' => '1.0.0' ],
        'results' => '{"packet_type":"shutdown_packet","shutdown_reason":{"value":"33","formatted":"app_shutdown"},"secondary_packet_type":"status_packet","general":{"_fixed_metering":{"value":0,"formatted":"disabled"},"_debug_info":{"value":1,"formatted":"sent"},"packet_reason_app":{"value":0,"formatted":"false"},"packet_reason_magnet":{"value":0,"formatted":"false"},"packet_reason_alert":{"value":0,"formatted":"false"}},"active_alerts":{"reverse_flow_detected":{"value":0,"formatted":"false"},"burst":{"value":0,"formatted":"false"},"leak":{"value":0,"formatted":"false"},"tamper":{"value":0,"formatted":"false"},"temperature_alert":{"value":0,"formatted":"false"},"battery":{"value":0,"formatted":"false"}},"battery_percentage":{"value":39.37007874015748,"_unit":"%","formatted":"39.4%"},"battery_voltage":{"value":3.174,"_unit":"V","formatted":"3.174 V","value_raw":128},"mcu_temperature":{"value":18,"_unit":"\u00b0C","formatted":"18\u00b0C"},"temp_extremes":{"min_offset":{"value":0,"formatted":"0\u00b0C"},"max_offset":{"value":0,"formatted":"0\u00b0C"}},"downlink_rssi":{"value":-174,"_unit":"dBm","formatted":"-174 dBm"},"downlink_snr":{"value":7,"_unit":"dB","formatted":"7 dB"},"instant_counter":{"value":3,"_unit":"L","formatted":"3 L"},"calibration_delta":{"ch_1":{"value":0,"formatted":"0 "},"ch_2":{"value":0,"formatted":"0 "},"ch_3":{"value":0,"formatted":"0 "}},"hex":"013301100064801200ae0703000000000000"}' ],
    
    'UKW f99 (boot_packet)1.0.0' => [ 'request' =>
        [ 'data' => 'AJYAgkwAAjqAAAECAAAAAA==', 'fport' => '99', 'serial' => '4c12002c', 'firmware' => '1.0.0' ],
        'results' => '{"packet_type":"boot_packet","device_serial":"4c820096","firmware_version":"0.2.58","reset_reason":["nfc_wakeup"],"general_info ":{"configuration_restored":{"value":0,"formatted":"false"}},"hardware_config ":{"value":"01","formatted":"Cyble"},"sensor_fw_version":{"value":2},"uptime":{"value":0,"_unit":"hours","formatted":"0 hours"},"hex":"009600824c00023a8000010200000000"}' ],
    
    'UKW f24 (status)1.0.0' => [ 'request' =>
        [ 'data' => 'ATAA/1ESAK8HAwAAAAAAAA==', 'fport' => '24', 'serial' => '4c12002c', 'firmware' => '1.0.0' ],
        'results' => '{"packet_type":"status_packet","general":{"_fixed_metering":{"value":0,"formatted":"disabled"},"_debug_info":{"value":1,"formatted":"sent"},"packet_reason_app":{"value":1,"formatted":"true"},"packet_reason_magnet":{"value":0,"formatted":"false"},"packet_reason_alert":{"value":0,"formatted":"false"}},"active_alerts":{"reverse_flow_detected":{"value":0,"formatted":"false"},"burst":{"value":0,"formatted":"false"},"leak":{"value":0,"formatted":"false"},"tamper":{"value":0,"formatted":"false"},"temperature_alert":{"value":0,"formatted":"false"},"battery":{"value":0,"formatted":"false"}},"battery_percentage":{"value":255,"formatted":"not_available","_unit":"%"},"battery_voltage":{"value":2.9859999999999998,"formatted":"2.986 V","value_raw":81,"_unit":"V"},"mcu_temperature":{"value":18,"formatted":"18\u00b0C","_unit":"\u00b0C"},"temp_extremes":{"min_offset":{"value":0,"formatted":"-36 \u00b0C"},"max_offset":{"value":0,"formatted":"36 \u00b0C"}},"downlink_rssi":{"value":-175,"formatted":"-175 dBm","_unit":"dBm"},"downlink_snr":{"value":7,"formatted":"7 dB","_unit":"dB"},"accumulated_volume":{"value":3,"formatted":"3 L","_unit":"L"},"calibration_delta":{"ch_1":{"value":0,"formatted":"0 "},"ch_2":{"value":0,"formatted":"0 "},"ch_3":{"value":0,"formatted":"0 "}},"hex":"013000ff511200af0703000000000000"}' ],

    'UKW f25 (usage)1.0.0' => [ 'request' =>
        [ 'data' => 'AQBtXwYA', 'fport' => '25', 'serial' => '4c12002c', 'firmware' => '1.0.0' ],
        'results' => '{"packet_type":"usage_packet","general":{"_fixed_metering":{"value":0,"formatted":"disabled"},"_counters_previous":{"value":0,"formatted":"not_sent"},"usage_detected":{"value":0,"formatted":"false"}},"counter":{"value":417645,"_unit":"L","formatted":"417645 L"},"hex":"01006d5f0600"}' ],
    
    'UKW f25 (usage)1.0.22' => [ 'request' =>
        [ 'data' => 'ARABAAAAAgME', 'fport' => '25', 'serial' => '4c12002c', 'firmware' => '1.1.22' ],
        'results' => '{"packet_type":"usage_packet","general":{"_fixed_metering":{"value":0,"formatted":"disabled"},"_counters_previous":{"value":0,"formatted":"not_sent"},"usage_detected":{"value":0,"formatted":"false"},"_debug_info":{"value":1,"formatted":"sent"}},"counter":{"value":1,"_unit":"L","formatted":"1 L"},"hex":"011001000000020304"}' ],

    'UKW f50 (reporting_conf_packet)1.0.0' => [ 'request' =>
        [ 'data' => 'AA9oAXgAAQE=', 'fport' => '50', 'serial' => '4c12002c', 'firmware' => '1.0.0' ],
        'results' => '{"packet_type":"reporting_config_packet","_configured_parameters":{"usage_interval":{"value":1,"formatted":"configured"},"status_interval":{"value":1,"formatted":"configured"},"behaviour":{"value":1,"formatted":"configured"},"fixed_measuring_interval":{"value":1,"formatted":"configured"}},"usage_interval":{"value":360,"_unit":"minutes","formatted":"360 minutes"},"status_interval":{"value":120,"_unit":"minutes","formatted":"120 minutes"},"behaviour":{"send_usage":{"value":1,"formatted":"always"},"include_previous_usage":{"value":0,"formatted":"false"}},"fixed_measuring_interval":{"interval":{"value":"01","formatted":"hourly"}},"hex":"000f680178000101"}' ],

    'UKW f50 (metering_config_packet)1.0.0' => [ 'request' =>
        [ 'data' => 'BRJA4gEA776t3g==', 'fport' => '50', 'serial' => '4c12002c', 'firmware' => '1.0.0' ],
        'results' => '{"packet_type":"metering_config_packet","_configured_parameters":{"general_config":{"value":0,"formatted":"not_configured"},"absolute_reading":{"value":1,"formatted":"configured"},"offset":{"value":0,"formatted":"not_configured"},"permanent_flow":{"value":0,"formatted":"not_configured"},"meter_serial":{"value":1,"formatted":"configured"}},"absolute_reading":{"value":123456,"_unit":"L","formatted":"123456 L"},"meter_serial":"deadbeef","hex":"051240e20100efbeadde"}' ],

    'UKW f50 (meta_eic_config_packet)1.0.0' => [ 'request' =>
        [ 'data' => 'EQMLZWljMV9vbl9zZWULZWljMl9vbl90b28=', 'fport' => '50', 'serial' => '4c12002c', 'firmware' => '1.0.0' ],
        'results' => '{"packet_type":"meta_eic_config_packet","_configured_parameters":{"eic_1":{"value":1,"formatted":"sent"},"eic_2":{"value":1,"formatted":"sent"}},"customer_eic":"eic1_on_see","location_eic":"eic2_on_too","hex":"11030b656963315f6f6e5f7365650b656963325f6f6e5f746f6f"}' ],

    'UKW f50 (meta_pos_config_packet)1.0.0' => [ 'request' =>
        [ 'data' => 'EANF3WsjGgCzDhZWYWJhw7VodW11dXNldW1pIHRlZSAx', 'fport' => '50', 'serial' => '4c12002c', 'firmware' => '1.0.0' ],
        'results' => '{"packet_type":"meta_pos_config_packet","_configured_parameters":{"gps_position":{"value":1,"formatted":"configured"},"address":{"value":1,"formatted":"configured"}},"latitude":{"value":59.4271557,"formatted":"59.4271557 "},"longitude":{"value":24.6611994,"formatted":"24.6611994 "},"address":"Vaba\u00f5humuuseumi tee 1","hex":"100345dd6b231a00b30e1656616261c3b568756d75757365756d69207465652031"}' ],

    'UKW f60 (request_calibration_data)1.0.0' => [ 'request' =>
        [ 'data' => 'AgECAJIGcgbyBr4GugYjB50GfQbzBsIGvgYlBwAAABEJCQ4A', 'fport' => '60', 'serial' => '4c12002c', 'firmware' => '1.0.0' ],
        'results' => '{"packet_type":"request_calibration_data","sensor_type":{"value":"1","formatted":"inductive_sensor"},"fw_version":{"value":2,"formatted":"2 "},"afe_1_min":{"ch_1":{"value":1682,"formatted":"1682 "},"ch_2":{"value":1650,"formatted":"1650 "},"ch_3":{"value":1778,"formatted":"1778 "}},"afe_1_max":{"ch_1":{"value":1726,"formatted":"1726 "},"ch_2":{"value":1722,"formatted":"1722 "},"ch_3":{"value":1827,"formatted":"1827 "}},"afe_2_min":{"ch_1":{"value":1693,"formatted":"1693 "},"ch_2":{"value":1661,"formatted":"1661 "},"ch_3":{"value":1779,"formatted":"1779 "}},"afe_2_max":{"ch_1":{"value":1730,"formatted":"1730 "},"ch_2":{"value":1726,"formatted":"1726 "},"ch_3":{"value":1829,"formatted":"1829 "}},"recalib_delta":{"ch_1":{"value":0,"formatted":"0 "},"ch_2":{"value":0,"formatted":"0 "},"ch_3":{"value":0,"formatted":"0 "}},"initial_noise":{"ch_1":{"value":17,"formatted":"17 "},"ch_2":{"value":9,"formatted":"9 "},"ch_3":{"value":9,"formatted":"9 "}},"communication_error_count":{"value":14,"formatted":"14 "},"hex":"0201020092067206f206be06ba0623079d067d06f306c206be0625070000001109090e00"}' ],    

    /**
     *
     * WMB
     *
     */

    'WMB f24 (wmbus-meter)' => [ 'request' =>
        [ 'data' => 'HkQzOIuWAyABB3rPABAl5NUcZ1x370nWOvq9GLqA7w==', 'fport' => '24', 'serial' => '509b0001', 'encrypt_key' => 'db127bd37432415ac69a15ecedac8146'],
        'results' => '{"wmbus":{"header":{"_control":"primary station, unidirectional","manufacturer":{"value":"NAS","_value_raw":"3338","formatted":"NAS Instruments O\u00dc"},"serial":"2003968b","version":"1","device_type":{"formatted":"water","value":"07"}},"_payload_hex":"2f2f02fd086d170413188204002f2f2f","data_records":{"1":{"_function":"instant value","value_type":"access number","_encoding":"16 bit integer","_header_raw":"02fd08","_data_raw":"6d17","value":5997,"_value_raw":5997,"formatted":"5997"},"2":{"_function":"instant value","value_type":"volume","_unit":" m\u00b3","_exp":-3,"_encoding":"32 bit integer","_header_raw":"0413","_data_raw":"18820400","value":295.448,"_value_raw":295448,"formatted":"295.448 m\u00b3"}}},"hex":"1e4433388b96032001077acf001025e4d51c675c77ef49d63afabd18ba80ef"}' ],


    /**
     *
     * Global (OTHER)
     *
     */

    'F18 (wM-Bus - long header decryption)' => [ 'request' =>
        [ 'data' => 'NkTmHmBTWQACDnJRlFQW5h48B40wIGUsL+pay8LcX2/AheyaJz1TZQyxTZd07FMlVaIzc/BEdA==', 'fport' => '18', 'encrypt_key'=>'18011605e61e0d02bf0cfa357d9e7703' ],
        'results' => '{"wmbus":{"header":{"_control":"primary station, unidirectional","manufacturer":{"value":"GWF","_value_raw":"e61e","formatted":"Gas- u. Wassermesserfabrik"},"serial":"00595360","version":"2","device_type":{"formatted":"bus \/ system","value":"0e"}},"_payload_hex":"2f2f03747e558c04134ffd01004413c3020000426c7f2102fd7415110f0100b8","data_records":{"1":{"_function":"instant value","value_type":"actuality duration (in seconds)","_unit":" s","_encoding":"24 bit integer","_header_raw":"0374","_data_raw":"7e558c","value":9196926,"_value_raw":9196926,"formatted":"9196926 s"},"2":{"_function":"instant value","value_type":"volume","_unit":" m\u00b3","_exp":-3,"_encoding":"32 bit integer","_header_raw":"0413","_data_raw":"4ffd0100","value":130.383,"_value_raw":130383,"formatted":"130.383 m\u00b3"},"3":{"storage_num":1,"_function":"instant value","value_type":"volume","_unit":" m\u00b3","_exp":-3,"_encoding":"32 bit integer","_header_raw":"4413","_data_raw":"c3020000","value":0.707,"_value_raw":707,"formatted":"0.707 m\u00b3"},"4":{"storage_num":1,"_function":"instant value","value_type":"time point (date)","_encoding":"16 bit integer","_header_raw":"426c","_data_raw":"7f21","value":"31-01-2019","_value_raw":"31-01-2019","formatted":"31-01-2019"},"5":{"_function":"instant value","value_type":"parameter set identification","_encoding":"16 bit integer","_header_raw":"02fd74","_data_raw":"1511","value":4373,"_value_raw":4373,"formatted":"4373"},"6":{"value_type":"manufacturer data","_header_raw":"0f","value":"0100b8"}}},"hex":"3644e61e60535900020e7251945416e61e3c078d3020652c2fea5acbc2dc5f6fc085ec9a273d53650cb14d9774ec532555a23373f04474"}' ],


    'F18 (Kamstrup MC21 Full frame)' => [ 'request' =>
        [ 'data' => 'IkQtLEaGFGMXBo0g0WDx6AOKjXgC/yAPAAQTL4UHAFI7AAA=', 'fport' => '18', 'encrypt_key'=>'00000000000000000000000000000000' ],
        'results' => '{"wmbus":{"header":{"_control":"primary station, unidirectional","manufacturer":{"value":"KAM","_value_raw":"2d2c","formatted":"Kamstrup Energi A\/S"},"serial":"63148646","version":"17","device_type":{"formatted":"hot water","value":"06"},"_control_information":"full_frame"},"_payload_hex":"02ff200f0004132f850700523b0000","data_records":{"1":{"_function":"instant value","value_type":"manufacturer specific vife\'s and data","_encoding":"16 bit integer","_header_raw":"02ff20","_data_raw":"0f00","value":15,"_value_raw":15,"formatted":"15"},"2":{"_function":"instant value","value_type":"volume","_unit":" m\u00b3","_exp":-3,"_encoding":"32 bit integer","_header_raw":"0413","_data_raw":"2f850700","value":492.84700000000004,"_value_raw":492847,"formatted":"492.847 m\u00b3"},"3":{"storage_num":1,"_function":"maximum value","value_type":"(maximum) volume flow","_unit":" m\u00b3\/h","_exp":-3,"_encoding":"16 bit integer","_header_raw":"523b","_data_raw":"0000","value":0,"_value_raw":0,"formatted":"0 m\u00b3\/h"}}},"hex":"22442d2c4686146317068d20d160f1e8038a8d7802ff200f0004132f850700523b0000"}' ],

    'F18 (Kamstrup MC21 Compact frame)' => [ 'request' =>
        [ 'data' => 'H0QtLEaGFGMXBo0g2GHx6AOW03kOfOf0DwAvhQcAAAA=', 'fport' => '18', 'encrypt_key'=>'00000000000000000000000000000000' ],
        'results' => '{"wmbus":{"header":{"_control":"primary station, unidirectional","manufacturer":{"value":"KAM","_value_raw":"2d2c","formatted":"Kamstrup Energi A\/S"},"serial":"63148646","version":"17","device_type":{"formatted":"hot water","value":"06"},"_control information":"compact_frame"},"_payload_hex":"0e7ce7f40f002f8507000000","data_records":{"error":"Compact frame parsing is not supported at this point"}},"hex":"1f442d2c4686146317068d20d861f1e80396d3790e7ce7f40f002f8507000000"}' ],

    'F18 (Kamstrup Multical Ovre full)' => [ 'request' =>
        [ 'data' => 'KkQtLEF4ZXcbFo0osHSfRCC58OeTMdcnyXwDRJSVN5fVq6KMxtbXfkjfsg==', 'fport' => '18', 'encrypt_key'=>'d2e3e7f61b698c709fc1853502c48c4a' ],
        'results' => '{"wmbus":{"header":{"_control":"primary station, unidirectional","manufacturer":{"value":"KAM","_value_raw":"2d2c","formatted":"Kamstrup Energi A\/S"},"serial":"77657841","version":"1b","device_type":{"formatted":"cold water","value":"16"},"_control_information":"full_frame"},"_payload_hex":"02ff207100041300000000441300000000615b0b616715","data_records":{"1":{"_function":"instant value","value_type":"manufacturer specific vife\'s and data","_encoding":"16 bit integer","_header_raw":"02ff20","_data_raw":"7100","value":113,"_value_raw":113,"formatted":"113"},"2":{"_function":"instant value","value_type":"volume","_unit":" m\u00b3","_exp":-3,"_encoding":"32 bit integer","_header_raw":"0413","_data_raw":"00000000","value":0,"_value_raw":0,"formatted":"0 m\u00b3"},"3":{"storage_num":1,"_function":"instant value","value_type":"volume","_unit":" m\u00b3","_exp":-3,"_encoding":"32 bit integer","_header_raw":"4413","_data_raw":"00000000","value":0,"_value_raw":0,"formatted":"0 m\u00b3"},"4":{"storage_num":1,"_function":"minimum value","value_type":"(minimum) flow temperature","_unit":"\u00b0C","_exp":0,"_encoding":"8 bit integer","_header_raw":"615b","_data_raw":"0b","value":11,"_value_raw":11,"formatted":"11\u00b0C"},"5":{"storage_num":1,"_function":"minimum value","value_type":"(minimum) external temperature","_unit":"\u00b0C","_exp":0,"_encoding":"8 bit integer","_header_raw":"6167","_data_raw":"15","value":21,"_value_raw":21,"formatted":"21\u00b0C"}}},"hex":"2a442d2c417865771b168d28b0749f4420b9f0e79331d727c97c034494953797d5aba28cc6d6d77e48dfb2"}' ],


    'F18 (Kamstrup Multical decryption example)' => [ 'request' =>
        [ 'data' => 'JUQtLFY0EgAbFo0gEYAlACDFu2d2yyZV3Ey2QOjtXjjLVGEs6z8=', 'fport' => '18', 'encrypt_key'=>'01010101010101010101010101010101' ],
        'results' => '{"wmbus":{"header":{"_control":"primary station, unidirectional","manufacturer":{"value":"KAM","_value_raw":"2d2c","formatted":"Kamstrup Energi A\/S"},"serial":"00123456","version":"1b","device_type":{"formatted":"cold water","value":"16"},"_control information":"compact_frame"},"_payload_hex":"eda826b40000590d0200f4050200090f2908","data_records":{"error":"Compact frame parsing is not supported at this point"}},"hex":"25442d2c563412001b168d201180250020c5bb6776cb2655dc4cb640e8ed5e38cb54612ceb3f"}' ],


    'F99 (boot_packet)' => [ 'request' =>
        [ 'data' => 'AEsDE08BABUAAAACAAAAAA==', 'fport' => '99'],
        'results' => '{"packet_type":"boot_packet","device_serial":"4f13034b","firmware_version":"1.0.21","card_count":{"value":0,"formatted":"0 "},"switch_direction":"00","hex":"004b03134f0100150000000200000000"}' ],



];


/*
 * TESTER
 */


require 'src/nascv.php';
$cv = new nascv;

function array_diff_assoc_recursive( $array1, $array2 )
{
    if (!is_array( $array1 )) return [ 'error' => 'very different' ];
    foreach ($array1 as $key => $value) {
        if (is_array( $value )) {
            if (!isset( $array2[ $key ] )) {
                $difference[ $key ] = $value;
            } elseif (!is_array( $array2[ $key ] )) {
                $difference[ $key ] = $value;
            } else {
                $new_diff = array_diff_assoc_recursive( $value, $array2[ $key ] );
                if ($new_diff != FALSE) {
                    $difference[ $key ] = $new_diff;
                }
            }
        } elseif (!isset( $array2[ $key ] ) || $array2[ $key ] != $value) {
            $difference[ $key ] = $value;
        }
    }
    return !isset( $difference ) ? 0 : $difference;
}

function correct_array( $array )
{
    if(is_array($array)) {
        foreach ($array as $k => $v) {
            if (is_array( $v )) {
                $array[ $k ] = correct_array( $v );
            } else {
                if (is_bool( $v )) {
                    $array[ $k ] = ($v ? 'true' : 'false');
                }
                if (is_float( $v )) {
                    $array[ $k ] = $v;
                }
            }
        }
    }
    return $array;
}

?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>NASCV v<?= $cv->version ?> tester</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <style type="text/css">
        td {
            word-break: break-all;
        }
    </style>
</head>

<body>
<?php

ksort( $tests );
foreach ($tests as $type => $v) {
    $got = $cv->data( $v[ 'request' ] );
    if (isset( $_GET[ 'product' ] )) {
        if ($_GET[ 'product' ] != $cv->product) continue;
    }
    if (isset( $_GET[ 'fport' ] )) {
        if ($_GET[ 'fport' ] != $cv->fport) continue;
    }
    $capability = $cv->capability_structure($cv->product);
    echo '<table class="table table-sm table-bordered" style="margin-bottom:0px;">';
    $need = json_decode( $v[ 'results' ], true );
    if (correct_array( $need ) == correct_array( $got )) {
        echo '<tr class="bg-success"><td colspan="2"><h5 style="display:inline-block;margin-top:5px;margin-bottom:0px;font-size:20px;font-family: monospace;">' . $type . '</h5>' . PHP_EOL;
    } else {
        echo '<tr class="bg-danger"><td colspan="2"><h5 style="display:inline-block;margin-top:5px;margin-bottom:0px;font-size:20px;font-family: monospace;">' . $type . '</h5>';
        echo '<h6>DIFF: </h6><code style="color:black">';
        var_dump( array_diff_assoc_recursive( $got, $need ) ) . PHP_EOL;
        echo '</code>';
    }
    echo ' <button class="btn btn-sm btn-warning float-right ml-2" data-id="' . sha1( $type ) . '">Library</button>';
    echo ' <button class="btn btn-sm btn-secondary float-right ml-2" '.($capability==false?'disabled':'').' data-id="' . sha1( $type ) . '">Capability</button>';
    echo ' <button class="btn btn-sm btn-dark float-right ml-2" '.($capability==false?'disabled':'').' data-id="' . sha1( $type ) . '">Metering</button> ';
    echo ' <button class="btn btn-sm btn-primary float-right" data-id="' . sha1( $type ) . '">Results</button></td><tr>';
    echo '<tr style="display:none;" class="originals" data-id="' . sha1( $type ) . '"><td>';
    echo '<h6>CONVERTED: </h6>';
    echo '<pre>';
    echo json_encode( correct_array( $got ), JSON_PRETTY_PRINT);
    echo '</pre>';
    echo '<code>JSON compact: ';
    echo json_encode( $got );
    echo '</code>';
    echo '</td><td>';
    echo '<h6>NEEDED:</h6> ';
    echo '<pre>';
    echo json_encode( correct_array( $need ), JSON_PRETTY_PRINT);
    echo '</pre>';
    echo '<code>JSON compact: ';
    echo json_encode( $need );
    echo '</code>';
    echo '</td></tr>';


    echo '<tr style="display:none;" class="originals" data-id="' . sha1( $type ) . '-metering"><td>';
    echo '<h6>CONVERTED: </h6>';
    echo '<pre>';
    echo json_encode( correct_array( $cv->metering( $got ) ), JSON_PRETTY_PRINT) ;
    echo '</pre>';
    echo '<code>JSON compact: ';
    echo json_encode( $cv->metering( $got ) );
    echo '</code>';
    echo '</td><td>';
    echo '<h6>NEEDED:</h6> ';
    echo '<pre>';
    echo json_encode( correct_array( $cv->metering( $need ) ), JSON_PRETTY_PRINT);
    echo '</pre>';
    echo '<code>JSON compact: ';
    echo json_encode( $cv->metering( $need ) );
    echo '</code>';
    echo '</td></tr>';

    echo '<tr style="display:none;" class="originals" data-id="' . sha1( $type ) . '-capability"><td colspan="2">';
    echo '<pre>';
    echo json_encode( correct_array( $capability ), JSON_PRETTY_PRINT) ;
    echo '</pre>';
    echo '</td></tr>';

    echo '<tr style="display:none;" class="originals" data-id="' . sha1( $type ) . '-library"><td colspan="2">';
    echo '<pre>';
    echo json_encode( correct_array( $cv->call_library( $cv->product )->rx_fport()[ $cv->fport ] ), JSON_PRETTY_PRINT) ;
    echo '</pre>';
    echo '</td></tr>';

    echo '</table>';
}

?>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
<script type="text/javascript">
    $(function () {
        $('.btn-primary').click(function () {
            $('.originals[data-id="' + $(this).data('id') + '"]').toggle('fast');
        });
        $('.btn-dark').click(function () {
            $('.originals[data-id="' + $(this).data('id') + '-metering"]').toggle('fast');
        });
        $('.btn-secondary').click(function () {
            $('.originals[data-id="' + $(this).data('id') + '-capability"]').toggle('fast');
        });
        $('.btn-warning').click(function () {
            $('.originals[data-id="' + $(this).data('id') + '-library"]').toggle('fast');
        });
        $('table').width($(window).innerWidth());
        $('td').css('max-width', ($(window).innerWidth() / 2));
    })
</script>
</body>
</html>