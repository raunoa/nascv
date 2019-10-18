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
            '{"packet_type":"status_packet","metering_data":{"value":130698,"unit":"L","formatted":"130698 L"},"battery":{"value":2.810000000000000053290705182007513940334320068359375,"unit":"V","formatted":"2.81 V","value_raw":37},"temperature":{"value":18,"unit":"\u00b0C","formatted":"18\u00b0C"},"rssi":{"value":-91,"unit":"dBm","formatted":"-91 dBm"},"hex":"8afe01002512a51040000000000000000000000000000000000000000000000000000000000000000000000000"}' ],

    'AEM f25 (status_packet)' => [ 'request' =>
        [ 'data' => 'iv4BAA==', 'fport' => '25', 'serial' => '50860012' ],
        'results' =>
            '{"packet_type":"usage_packet","counter":{"value":130698,"unit":"L","formatted":"130698 L"},"hex":"8afe0100"}' ],

    'AEM f99 (boot_packet)' => [ 'request' =>
        [ 'data' => 'ABIAhlAAAicE', 'fport' => '99', 'serial' => '50860012' ],
        'results' =>
            '{"packet_type":"boot_packet","device_serial":"50860012","firmware_version":"0.2.39","reset_reason":["soft_reset"],"hex":"001200865000022704"}' ],

    'AEM f99 (shutdown_packet)' => [ 'request' =>
        [ 'data' => 'ATGK/gEAJBKcEAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA=', 'fport' => '99', 'serial' => '50860012' ],
        'results' =>
            '{"packet_type":"shutdown_packet","shutdown_reason":{"value":"31","unit":"","formatted":"magnet_shutdown"},"metering_data":{"value":130698,"unit":"L","formatted":"130698 L"},"battery":{"value":2.80600000000000004973799150320701301097869873046875,"unit":"V","formatted":"2.806 V","value_raw":36},"temperature":{"value":18,"unit":"\u00b0C","formatted":"18\u00b0C"},"rssi":{"value":-100,"unit":"dBm","formatted":"-100 dBm"},"hex":"01318afe010024129c1000000000000000000000000000000000000000000000000000000000000000000000000000"}' ],

    'AEM f99 (boot_packet_nfc)' => [ 'request' =>
        [ 'data' => 'ABIAhlAAAieA', 'fport' => '99', 'serial' => '50860012' ],
        'results' =>
            '{"packet_type":"boot_packet","device_serial":"50860012","firmware_version":"0.2.39","reset_reason":["nfc_wakeup"],"hex":"001200865000022780"}' ],
    //AEM 1.0 *************************************************************************
    'AEM f24 (status_packet)3.0' => [ 'request' =>
        [ 'data' => 'ASAA/3cSAKYHiv4BAA==', 'fport' => '24', 'serial' => '50860012', 'firmware' => '1.0.0' ],
        'results' =>
            '{"packet_type":"status_packet","general":{"fixed_metering":{"value":0,"formatted":"disabled"},"previous_counter":{"value":0,"formatted":"not_sent"},"debug_info":{"value":0,"formatted":"not_sent"},"packet_reason_app":{"value":1,"formatted":"true"},"packet_reason_magnet":{"value":0,"formatted":"false"},"packet_reason_alert":{"value":0,"formatted":"false"}},"active_alerts":{"reverse_flow_detected":{"value":0,"formatted":"false"},"burst":{"value":0,"formatted":"false"},"leak":{"value":0,"formatted":"false"},"tamper":{"value":0,"formatted":"false"},"temperature_alert":{"value":0,"formatted":"false"},"battery":{"value":0,"formatted":"false"}},"battery_percentage":{"value":"255","unit":"%","formatted":"not_available"},"battery_voltage":{"value":3.1379999999999999005240169935859739780426025390625,"unit":"V","formatted":"3.138 V","value_raw":119},"mcu_temperature":{"value":18,"unit":"\u00b0C","formatted":"18\u00b0C"},"temp_extremes":{"min_offset":{"value":0,"formatted":"0\u00b0C"},"max_offset":{"value":0,"formatted":"0\u00b0C"}},"downlink_rssi":{"value":-166,"unit":"dBm","formatted":"-166 dBm"},"downlink_snr":{"value":7,"unit":"dB","formatted":"7 dB"},"instant_counter":{"value":130698,"unit":"L","formatted":"130698 L"},"hex":"012000ff771200a6078afe0100"}' ],

    'AEM f99 (boot_packet)3.0' => [ 'request' =>
        [ 'data' => 'ABIAhlAAAwAEgAUAAA==', 'fport' => '99', 'serial' => '50860012', 'firmware' => '1.0.0' ],
        'results' =>
            '{"packet_type":"boot_packet","device_serial":"50860012","firmware_version":"0.3.0","reset_reason":["soft_reset"],"general_info ":{"configuration_restored":{"value":1,"formatted":"true"}},"hardware_config ":{"value":"05","unit":"","formatted":"AEM_Water_int"},"sensor_fw_version":{"value":"0000","unit":"","formatted":"not_available"},"hex":"00120086500003000480050000"}' ],

    'AEM f50 (reporting_conf_packet)0.1.0' => [ 'request' =>
        [ 'data' => 'AAc8ANACAQ==', 'fport' => '50', 'serial' => '50860012', 'firmware' => '1.0.0' ],
        'results' =>
            '{"packet_type":"reporting_config_packet","configured_parameters":{"usage_interval":{"value":"1","formatted":"configured"},"status_interval":{"value":"1","formatted":"configured"},"behaviour":{"value":"1","formatted":"configured"},"fixed_measuring_interval":{"value":"0","formatted":"not_configured"}},"usage_interval":{"value":60,"unit":"minutes","formatted":"60 minutes"},"status_interval":{"value":720,"unit":"minutes","formatted":"720 minutes"},"behaviour":{"send_usage":{"value":"1","formatted":"always"},"include_previous_usage":{"value":"0","formatted":"false"}},"hex":"00073c00d00201"}' ],


    /*
    *
    * LCU
    *
    */

    'LCU f24 (status_packet)' => [ 'request' =>
        [ 'data' => 'SnUOXACfRAIE/zJEBQr/MkQBAv8ARAQI/wBEAwb/AEQGDP8A', 'fport' => '24', 'serial' => '4d1b0092' ],
        'results' =>
            '{"packet_type":"status_packet","general":{"device_unix_epoch":{"value":"10.12.2018 14:16:42","unit":"","formatted":"10.12.2018 14:16:42 ","value_raw":1544451402},"status_field":{"dali_error_external":{"value":"0","formatted":"ok"},"dali_error_connection":{"value":"0","formatted":"ok"},"ldr_state":{"value":"0","formatted":"off"},"thr_state":{"value":"0","formatted":"off"},"dig_state":{"value":"0","formatted":"off"},"hardware_error":{"value":"0","formatted":"ok"},"software_error":{"value":"0","formatted":"ok"},"relay_state":{"value":"0","formatted":"off"}},"downlink_rssi":{"value":-97,"unit":"dBm","formatted":"-97 dBm"}},"profiles":[{"profile_id":{"value":68,"unit":"","formatted":"68 "},"profile_version":{"value":2,"unit":"","formatted":"2 "},"dali_address_short":{"value":4,"unit":"","formatted":"4 "},"days_active":["holiday","mon","tue","wed","thu","fri","sat","sun"],"dim_level":{"value":50,"unit":"%","formatted":"50 %"}},{"profile_id":{"value":68,"unit":"","formatted":"68 "},"profile_version":{"value":5,"unit":"","formatted":"5 "},"dali_address_short":{"value":10,"unit":"","formatted":"10 "},"days_active":["holiday","mon","tue","wed","thu","fri","sat","sun"],"dim_level":{"value":50,"unit":"%","formatted":"50 %"}},{"profile_id":{"value":68,"unit":"","formatted":"68 "},"profile_version":{"value":1,"unit":"","formatted":"1 "},"dali_address_short":{"value":2,"unit":"","formatted":"2 "},"days_active":["holiday","mon","tue","wed","thu","fri","sat","sun"],"dim_level":{"value":0,"unit":"%","formatted":"0 %"}},{"profile_id":{"value":68,"unit":"","formatted":"68 "},"profile_version":{"value":4,"unit":"","formatted":"4 "},"dali_address_short":{"value":8,"unit":"","formatted":"8 "},"days_active":["holiday","mon","tue","wed","thu","fri","sat","sun"],"dim_level":{"value":0,"unit":"%","formatted":"0 %"}},{"profile_id":{"value":68,"unit":"","formatted":"68 "},"profile_version":{"value":3,"unit":"","formatted":"3 "},"dali_address_short":{"value":6,"unit":"","formatted":"6 "},"days_active":["holiday","mon","tue","wed","thu","fri","sat","sun"],"dim_level":{"value":0,"unit":"%","formatted":"0 %"}},{"profile_id":{"value":68,"unit":"","formatted":"68 "},"profile_version":{"value":6,"unit":"","formatted":"6 "},"dali_address_short":{"value":12,"unit":"","formatted":"12 "},"days_active":["holiday","mon","tue","wed","thu","fri","sat","sun"],"dim_level":{"value":0,"unit":"%","formatted":"0 %"}}],"hex":"4a750e5c009f440204ff3244050aff32440102ff00440408ff00440306ff0044060cff00"}' ],

    'LCU f25 (usage_packet)' => [ 'request' =>
        [ 'data' => '8ksDADMAVhM=', 'fport' => '25', 'serial' => '4d1b0092' ],
        'results' => '{"packet_type":"usage_packet","cumulative_power_consumption":{"value":216050,"unit":"Wh","formatted":"216050 Wh"},"current_consumption":{"value":51,"unit":"W","formatted":"51 W"},"luminaire_burn_time":{"value":4950,"unit":"h","formatted":"4950 h"},"hex":"f24b030033005613"}' ],

    'LCU f25 (usage_packet) fw0.6.20' => [ 'request' =>
        [ 'data' => '/wMAAAAAAAAEA80PAAAAAAUDcg4AAAAABgM+DgAAAAAHAwsOAAAAAA==', 'fport' => '25', 'serial' => '4e1500bc', 'firmware' => '0.6.20' ],
        'results' => '{"packet_type":"usage_packet","consumption_data":[{"dali_address":{"value":"ff","unit":"","formatted":"internal_measurement"},"reported_fields":{"active_energy_total":{"value":"1","formatted":"sent"},"active_energy_instant":{"value":"1","formatted":"sent"},"load_side_energy_total":{"value":"0","formatted":"not sent"},"load_side_energy_instant":{"value":"0","formatted":"not sent"},"power_factor_instant":{"value":"0","formatted":"not sent"},"system_voltage":{"value":"0","formatted":"not sent"}},"active_energy_total":{"value":0,"unit":"Wh","formatted":"0 Wh"},"active_energy_instant":{"value":0,"unit":"W","formatted":"0 W"}},{"dali_address":{"value":"04","unit":""},"reported_fields":{"active_energy_total":{"value":"1","formatted":"sent"},"active_energy_instant":{"value":"1","formatted":"sent"},"load_side_energy_total":{"value":"0","formatted":"not sent"},"load_side_energy_instant":{"value":"0","formatted":"not sent"},"power_factor_instant":{"value":"0","formatted":"not sent"},"system_voltage":{"value":"0","formatted":"not sent"}},"active_energy_total":{"value":4045,"unit":"Wh","formatted":"4045 Wh"},"active_energy_instant":{"value":0,"unit":"W","formatted":"0 W"}},{"dali_address":{"value":"05","unit":""},"reported_fields":{"active_energy_total":{"value":"1","formatted":"sent"},"active_energy_instant":{"value":"1","formatted":"sent"},"load_side_energy_total":{"value":"0","formatted":"not sent"},"load_side_energy_instant":{"value":"0","formatted":"not sent"},"power_factor_instant":{"value":"0","formatted":"not sent"},"system_voltage":{"value":"0","formatted":"not sent"}},"active_energy_total":{"value":3698,"unit":"Wh","formatted":"3698 Wh"},"active_energy_instant":{"value":0,"unit":"W","formatted":"0 W"}},{"dali_address":{"value":"06","unit":""},"reported_fields":{"active_energy_total":{"value":"1","formatted":"sent"},"active_energy_instant":{"value":"1","formatted":"sent"},"load_side_energy_total":{"value":"0","formatted":"not sent"},"load_side_energy_instant":{"value":"0","formatted":"not sent"},"power_factor_instant":{"value":"0","formatted":"not sent"},"system_voltage":{"value":"0","formatted":"not sent"}},"active_energy_total":{"value":3646,"unit":"Wh","formatted":"3646 Wh"},"active_energy_instant":{"value":0,"unit":"W","formatted":"0 W"}},{"dali_address":{"value":"07","unit":""},"reported_fields":{"active_energy_total":{"value":"1","formatted":"sent"},"active_energy_instant":{"value":"1","formatted":"sent"},"load_side_energy_total":{"value":"0","formatted":"not sent"},"load_side_energy_instant":{"value":"0","formatted":"not sent"},"power_factor_instant":{"value":"0","formatted":"not sent"},"system_voltage":{"value":"0","formatted":"not sent"}},"active_energy_total":{"value":3595,"unit":"Wh","formatted":"3595 Wh"},"active_energy_instant":{"value":0,"unit":"W","formatted":"0 W"}}],"hex":"ff030000000000000403cd0f000000000503720e0000000006033e0e0000000007030b0e00000000"}' ],


    'LCU f50 (configuration_packet - ldr_config_packet)' => [ 'request' =>
        [ 'data' => 'Af4y', 'fport' => '50', 'serial' => '4d1b0092' ],
        'results' => '{"packet_type":"ldr_config_packet","switch_thresholds":{"high":{"value":254,"unit":"","formatted":"254 "},"low":{"value":50,"unit":"","formatted":"50 "}},"hex":"01fe32"}' ],

    'LCU f50 (configuration_packet - profile_config_packet)' => [ 'request' =>
        [ 'data' => 'CAIGDP9LMngUigA=', 'fport' => '50', 'serial' => '4d1b0092' ],
        'results' => '{"packet_type":"profile_config_packet","profile_id":{"value":2,"unit":"","formatted":"2 "},"profile_version":{"value":6,"unit":"","formatted":"6 "},"dali_address_short":{"value":12,"unit":"","formatted":"12 "},"days_active":["holiday","mon","tue","wed","thu","fri","sat","sun"],"dimming_step":[{"step_time":{"value":"12:30","unit":"","formatted":"12:30 ","value_raw":75},"dim_level":{"value":50,"unit":"","formatted":"50 "}},{"step_time":{"value":"20:00","unit":"","formatted":"20:00 ","value_raw":120},"dim_level":{"value":20,"unit":"","formatted":"20 "}},{"step_time":{"value":"23:00","unit":"","formatted":"23:00 ","value_raw":138},"dim_level":{"value":0,"unit":"","formatted":"0 "}}],"hex":"0802060cff4b3278148a00"}' ],

    'LCU f50 (configuration_packet - calendar_config_packet)' => [ 'request' =>
        [ 'data' => 'BuIeORecCQ==', 'fport' => '50', 'serial' => '4d1b0092' ],
        'results' => '{"packet_type":"calendar_config_packet","sunrise_offset":{"value":-30,"unit":"","formatted":"-30 "},"sunset_offset":{"value":30,"unit":"","formatted":"30 "},"latitude":{"value":5945,"unit":"","formatted":"5945 "},"longitude":{"value":2460,"unit":"","formatted":"2460 "},"hex":"06e21e39179c09"}' ],


    'LCU f50 (configuration_packet - time_config_packet)' => [ 'request' =>
        [ 'data' => 'CXBPp1w=', 'fport' => '50', 'serial' => '4d1b0092' ],
        'results' => '{"packet_type":"time_config_packet","device_unix_epoch":{"value":"05.04.2019 12:52:00","unit":"","formatted":"05.04.2019 12:52:00 ","value_raw":1554468720},"hex":"09704fa75c"}' ],


    'LCU f50 (configuration_packet - dig_config_packet)' => [ 'request' =>
        [ 'data' => 'AwoAAQ==', 'fport' => '50', 'serial' => '4d1b0092' ],
        'results' => '{"packet_type":"dig_config_packet","switch_time":{"value":10,"unit":"seconds","formatted":"10 seconds"},"switch_behaviour":{"switch_lights_on":{"value":"1","formatted":"enabled"}},"hex":"030a0001"}' ],

    'LCU f50 (configuration_packet - status_config_packet)' => [ 'request' =>
        [ 'data' => 'BwgHAAA=', 'fport' => '50', 'serial' => '4d1b0092' ],
        'results' => '{"packet_type":"status_config_packet","status_interval":{"value":1800,"unit":"seconds","formatted":"1800 seconds"},"hex":"0708070000"}' ],

    'LCU f50 (configuration_packet - usage_config_packet)' => [ 'request' =>
        [ 'data' => 'CwgHAADm', 'fport' => '50', 'serial' => '4d1b0092' ],
        'results' => '{"packet_type":"usage_config_packet","usage_interval":{"value":1800,"unit":"seconds","formatted":"1800 seconds"},"system_voltage":{"value":230,"unit":"volts","formatted":"230 volts"},"hex":"0b08070000e6"}' ],


    'LCU f99 (boot_packet)' => [ 'request' =>
        [ 'data' => 'APQAHE0ABYkPFVRcAa0=', 'fport' => '99', 'serial' => '4d1b0092' ],
        'results' => '{"packet_type":"boot_packet","device_serial":"4d1c00f4","firmware_version":"0.5.137","clock":{"value":"01.02.2019 09:44:47","unit":"UTC","formatted":"01.02.2019 09:44:47 UTC","value_raw":1549014287},"hardware_config":{"value":"01","unit":"","formatted":"DALI & NC relay"},"options":{"neutral_out":{"value":"1","formatted":"yes"},"THR":{"value":"0","formatted":"no"},"DIG":{"value":"1","formatted":"yes"},"LDR":{"value":"1","formatted":"yes"},"OD":{"value":"0","formatted":"no"},"metering":{"value":"1","formatted":"yes"},"extra_surge_protection":{"value":"0","formatted":"no"},"custom_request":{"value":"1","formatted":"yes"}},"hex":"00f4001c4d0005890f15545c01ad"}' ],


    /**
     *
     * PMG
     *
     */
    'PMG f24 (status_packet)' => [ 'request' =>
        [ 'data' => 'AZqpnkNJw+hdAAAA', 'fport' => '24', 'serial' => '34103412' ],
        'results' => '{"packet_type":"status_packet","general":{"relay_state":{"value":"1","formatted":"on"},"relay_switched_packet":{"value":"0","formatted":false},"counter_reset_packet":{"value":"0","formatted":false}},"accumulated_energy":{"value":317.32501220703,"unit":"kWh","formatted":"317.325 kWh"},"instant":{"frequency":{"value":49.993,"unit":"Hz","formatted":"49.993 Hz"},"voltage":{"value":240.4,"unit":"V","formatted":"240.4 V"},"power":{"value":0,"unit":"W","formatted":"0 W"}},"rssi":{"value":0,"unit":"dBm","formatted":"0 dBm"},"hex":"019aa99e4349c3e85d000000"}' ],

    'PMG f25 (usage_packet)' => [ 'request' =>
        [ 'data' => 'LlJ7R2wA', 'fport' => '25', 'serial' => '34103412' ],
        'results' => '{"packet_type":"usage_packet","accumulated_energy":{"value":64338.1796875,"unit":"kWh","formatted":"64338.180 kWh"},"power":{"value":10.8,"unit":"W","formatted":"10.8 W"},"hex":"2e527b476c00"}' ],

    'PMG f99 (boot_packet)' => [ 'request' =>
        [ 'data' => 'AP////8AAgD//w==', 'fport' => '99', 'serial' => '34103412' ],
        'results' => '{"packet_type":"boot_packet","device_serial":"ffffffff","firmware_version":"0.2.0","extension_module_0":{"value":"ff","unit":"","formatted":"not connected"},"extension_module_1":{"value":"ff","unit":"","formatted":"not connected"},"hex":"00ffffffff000200ffff"}' ],


    /**
     *
     * GM1
     *
     */

    'GM1 f24 (status_packet)' => [ 'request' =>
        [ 'data' => 'A48UfECB9QgCEgAAAAA=', 'fport' => '24', 'serial' => '4E1B0018' ],
        'results' => '{"packet_type":"status_packet","header":{"interface":{"value":"03","formatted":"gas meter"},"user_triggered_packet":{"value":"0","formatted":"no"},"temperature_triggered_packet":{"value":"0","formatted":"no"}},"battery_index":{"value":3.234,"unit":"V","formatted":"3.234 V","value_raw":143},"mcu_temp":{"value":20,"unit":"\u00b0C","formatted":"20\u00b0C"},"downlink_rssi":{"value":-124,"unit":"dBm","formatted":"-124 dBm"},"gas":{"settings":{"input_state":{"value":"0","formatted":false},"operational_mode":{"value":"0","formatted":"counter"},"medium_type":{"value":"04","formatted":"_gas"}},"counter":{"value":34141569,"unit":"L","formatted":"34141569 L"}},"tamper":{"settings":{"input_state":{"value":"0","formatted":false},"operational_mode":{"value":"1","formatted":"trigger_mode"},"is_alert":{"value":"0","formatted":"no"},"medium_type":{"value":"01","formatted":"events_"}},"counter":{"value":0,"unit":"events","formatted":"0 events"}},"hex":"038f147c4081f508021200000000"}' ],

    'GM1 f24 (status_packet)0.8.0 - 0.8.2' => [ 'request' =>
        [ 'data' => 'A2YQ4INApAYAABIAAAAA', 'fport' => '24', 'serial' => '4E1B0018', 'firmware' => '0.8.1' ],
        'results' => '{"packet_type":"status_packet","header":{"interface":{"value":3,"formatted":"gas meter"},"user_triggered_packet":{"value":0,"formatted":"no"},"active_alerts":{"value":0,"formatted":"no"}},"battery_index":{"value":3.069999999999999840127884453977458178997039794921875,"unit":"V","formatted":"3.07 V","value_raw":102},"mcu_temperature":{"value":16,"unit":"\u00b0C","formatted":"16\u00b0C"},"temp_extremes":{"min_offset":{"value":0,"formatted":"0\u00b0C"},"max_offset":{"value":28,"formatted":"28\u00b0C"}},"downlink_rssi":{"value":-131,"unit":"dBm","formatted":"-131 dBm"},"gas":{"settings":{"input_state":{"value":0,"formatted":false},"operational_mode":{"value":0,"formatted":"counter"},"medium_type":{"value":4,"formatted":"_gas"}},"counter":{"value":1700,"unit":"L","formatted":"1700 L"}},"tamper":{"settings":{"input_state":{"value":0,"formatted":false},"operational_mode":{"value":1,"formatted":"trigger_mode"},"is_alert":{"value":0,"formatted":"no"},"medium_type":{"value":1,"formatted":"events_"}},"counter":{"value":0,"unit":"events","formatted":"0 events"}},"hex":"036610e08340a40600001200000000"}' ],

    'GM1 f24 (status_packet)fw0.8' => [ 'request' =>
        [ 'data' => 'Q/98GABWQAAAAAASAAAAAA==', 'fport' => '24', 'serial' => '4e1b0054', 'firmware' => '0.8' ],
        'results' => '{"packet_type":"status_packet","header":{"interface":{"value":3,"formatted":"gas meter"},"user_triggered_packet":{"value":1,"formatted":"yes"},"active_alerts":{"value":0,"formatted":"no"}},"battery_percentage":{"value":"255","unit":"%","formatted":"not_available"},"battery_index":{"value":3.157999999999999918287585387588478624820709228515625,"unit":"V","formatted":"3.158 V","value_raw":124},"mcu_temperature":{"value":24,"unit":"\u00b0C","formatted":"24\u00b0C"},"temp_extremes":{"min_offset":{"value":0,"formatted":"0\u00b0C"},"max_offset":{"value":0,"formatted":"0\u00b0C"}},"downlink_rssi":{"value":-86,"unit":"dBm","formatted":"-86 dBm"},"gas":{"settings":{"input_state":{"value":0,"formatted":false},"operational_mode":{"value":0,"formatted":"counter"},"medium_type":{"value":4,"formatted":"_gas"}},"counter":{"value":0,"unit":"L","formatted":"0 L"}},"tamper":{"settings":{"input_state":{"value":0,"formatted":false},"operational_mode":{"value":1,"formatted":"trigger_mode"},"is_alert":{"value":0,"formatted":"no"},"medium_type":{"value":1,"formatted":"events_"}},"counter":{"value":0,"unit":"events","formatted":"0 events"}},"hex":"43ff7c18005640000000001200000000"}' ],

    'GM1 f24 (status_packet)fw0.8' => [ 'request' =>
        [ 'data' => 'Q//qFQCGSHDo7wCoBV0BEgAAAAA=', 'fport' => '24', 'serial' => '50100028', 'firmware' => '0.8.5' ],
        'results' => '{"packet_type":"status_packet","header":{"interface":{"value":3,"formatted":"gas meter"},"user_triggered_packet":{"value":1,"formatted":"yes"},"active_alerts":{"value":0,"formatted":"no"}},"battery_percentage":{"value":"255","unit":"%","formatted":"not_available"},"battery_index":{"value":3.59799999999999986499688020558096468448638916015625,"unit":"V","formatted":"3.598 V","value_raw":234},"mcu_temperature":{"value":21,"unit":"\u00b0C","formatted":"21\u00b0C"},"temp_extremes":{"min_offset":{"value":0,"formatted":"0\u00b0C"},"max_offset":{"value":0,"formatted":"0\u00b0C"}},"downlink_rssi":{"value":-134,"unit":"dBm","formatted":"-134 dBm"},"gas":{"settings":{"input_state":{"value":0,"formatted":false},"operational_mode":{"value":0,"formatted":"counter"},"device_serial_sent":{"value":1,"formatted":"sent"},"medium_type":{"value":4,"formatted":"_gas"}},"counter":{"value":15722608,"unit":"L","formatted":"15722608 L"},"device_serial_set":{"value":22873512,"unit":"","formatted":"22873512 "}},"tamper":{"settings":{"input_state":{"value":0,"formatted":false},"operational_mode":{"value":1,"formatted":"trigger_mode"},"is_alert":{"value":0,"formatted":"no"},"medium_type":{"value":1,"formatted":"events_"}},"counter":{"value":0,"unit":"events","formatted":"0 events"}},"hex":"43ffea1500864870e8ef00a8055d011200000000"}' ],

    'GM1 f25 (usage_packet)' => [ 'request' =>
        [ 'data' => 'A0CwxZwBEgAAAAA=', 'fport' => '25', 'serial' => '4E1B0018' ],
        'results' => '{"packet_type":"usage_packet","interface":"03","gas":{"settings":{"input_state":{"value":"0","formatted":false},"operational_mode":{"value":"0","formatted":"counter"},"medium_type":{"value":"04","formatted":"_gas"}},"counter":{"value":27051440,"unit":"L","formatted":"27051440 L"}},"tamper":{"settings":{"input_state":{"value":"0","formatted":false},"operational_mode":{"value":"1","formatted":"trigger_mode"},"is_alert":{"value":"0","formatted":"no"},"medium_type":{"value":"01","formatted":"events_"}},"counter":{"value":0,"unit":"events","formatted":"0 events"}},"hex":"0340b0c59c011200000000"}' ],


    'GM1 f99 (boot_packet)' => [ 'request' =>
        [ 'data' => 'ACAAG04ABx8QAgA=', 'fport' => '99', 'serial' => '4E1B0018' ],
        'results' => '{"packet_type":"boot_packet","device_serial":"4e1b0020","firmware_version":"0.7.31","reset_reason":["magnet_wakeup"],"general_info":{"battery_type":{"value":2,"formatted":"3V6"}},"hardware_config":{"value":"00","unit":"","formatted":"digital_only"},"hex":"0020001b4e00071f100200"}' ],


    'GM1 f99 (shutdown_packet)' => [ 'request' =>
        [ 'data' => 'ATEDLxJwQDwAAAASAAAAAA==', 'fport' => '99', 'serial' => '4E1B0018' ],
        'results' => '{"packet_type":"shutdown_packet","shutdown_reason":{"value":"31","unit":"","formatted":"magnet_shutdown"},"header":{"interface":{"value":"03","formatted":"gas meter"},"user_triggered_packet":{"value":"0","formatted":"no"},"temperature_triggered_packet":{"value":"0","formatted":"no"}},"battery_index":{"value":2.85,"unit":"V","formatted":"2.85 V","value_raw":47},"mcu_temp":{"value":18,"unit":"\u00b0C","formatted":"18\u00b0C"},"downlink_rssi":{"value":-112,"unit":"dBm","formatted":"-112 dBm"},"gas":{"settings":{"input_state":{"value":"0","formatted":false},"operational_mode":{"value":"0","formatted":"counter"},"medium_type":{"value":"04","formatted":"_gas"}},"counter":{"value":60,"unit":"L","formatted":"60 L"}},"tamper":{"settings":{"input_state":{"value":"0","formatted":false},"operational_mode":{"value":"1","formatted":"trigger_mode"},"is_alert":{"value":"0","formatted":"no"},"medium_type":{"value":"01","formatted":"events_"}},"counter":{"value":0,"unit":"events","formatted":"0 events"}},"hex":"0131032f1270403c0000001200000000"}' ],

    /* GM1 -> UKW *********************************************************************/
    
    'GM1 f24 (status_packet)fw1.0.0' => [ 'request' =>
        [ 'data' => 'ASAA/4YRAFEB8AAAAA==', 'fport' => '24', 'serial' => '50100028', 'firmware' => '1.0.0' ],
        'results' => '{"packet_type":"status_packet","general":{"fixed_metering":{"value":0,"formatted":"disabled"},"previous_counter":{"value":0,"formatted":"not_sent"},"debug_info":{"value":0,"formatted":"not_sent"},"packet_reason_app":{"value":1,"formatted":"true"},"packet_reason_magnet":{"value":0,"formatted":"false"},"packet_reason_alert":{"value":0,"formatted":"false"}},"active_alerts":{"reverse_flow_detected":{"value":0,"formatted":"false"},"burst":{"value":0,"formatted":"false"},"leak":{"value":0,"formatted":"false"},"tamper":{"value":0,"formatted":"false"},"temperature_alert":{"value":0,"formatted":"false"},"battery":{"value":0,"formatted":"false"}},"battery_percentage":{"value":"255","unit":"%","formatted":"not_available"},"battery_voltage":{"value":3.197999999999999953814722175593487918376922607421875,"unit":"V","formatted":"3.198 V","value_raw":134},"mcu_temperature":{"value":17,"unit":"\u00b0C","formatted":"17\u00b0C"},"temp_extremes":{"min_offset":{"value":0,"formatted":"0\u00b0C"},"max_offset":{"value":0,"formatted":"0\u00b0C"}},"downlink_rssi":{"value":-81,"unit":"dBm","formatted":"-81 dBm"},"downlink_snr":{"value":1,"unit":"dB","formatted":"1 dB"},"instant_counter":{"value":240,"unit":"L","formatted":"240 L"},"hex":"012000ff8611005101f0000000"}' ],

    
    
    
    /**
     *
     * LAC
     *
     */
    'LAC f24 (status_packet)' => [ 'request' =>
        [ 'data' => 'AEMAVQI=', 'fport' => '24', 'serial' => '4E09000A' ],
        'results' => '{"packet_type":"status_packet","status":{"lock":{"value":"0","formatted":"open"}},"rssi":{"value":-67,"unit":"dBm","formatted":"-67 dBm"},"temp":{"value":0,"unit":"C","formatted":"0 C"},"card_count":{"value":597,"unit":"","formatted":"597 "},"hex":"0043005502"}' ],

    'LAC f25 (usage_packet)' => [ 'request' =>
        [ 'data' => 'AawtIAoA', 'fport' => '25', 'serial' => '4E09000A' ],
        'results' => '{"packet_type":"usage_packet","status":{"allowed":{"value":"1","formatted":"yes"},"command":{"value":"0","formatted":"no"}},"card_number":"202dac","time_closed":{"value":10,"unit":"minutes","formatted":"10 minutes"},"hex":"01ac2d200a00"}' ],

    'LAC f50 (configuration_packet)' => [ 'request' =>
        [ 'data' => 'AQE=', 'fport' => '50', 'serial' => '4E09000A' ],
        'results' => '{"packet_type":"configuration_packet","header":"01","open_alert_timer":{"value":1,"unit":"minutes","formatted":"1 minutes"},"hex":"0101"}' ],

    'LAC f53 (alert_packet - left open)' => [ 'request' =>
        [ 'data' => 'AQEBAA==', 'fport' => '53', 'serial' => '4E09000A' ],
        'results' => '{"packet_type":"alert_packet","alert":{"value":"01","unit":"","formatted":"left_open"},"status":{"alert":{"value":"1","formatted":"raised"}},"time_open":{"value":1,"unit":"min","formatted":"1 min"},"hex":"01010100"}' ],

    'LAC f53 (alert_packet - force open)' => [ 'request' =>
        [ 'data' => 'AgE=', 'fport' => '53', 'serial' => '4E09000A' ],
        'results' => '{"packet_type":"alert_packet","alert":{"value":"02","unit":"","formatted":"force_open"},"status":{"alert":{"value":"1","formatted":"raised"}},"hex":"0201"}' ],


    'LAC f99 (boot_packet)' => [ 'request' =>
        [ 'data' => 'AAQACU4AAQ66AAA=', 'fport' => '99', 'serial' => '4E09000A' ],
        'results' => '{"packet_type":"boot_packet","device_serial":"4e090004","firmware_version":"0.1.14","card_count":{"value":186,"unit":"","formatted":"186 "},"switch_direction":"00","hex":"000400094e00010eba0000"}' ],


    /**
     *
     * AXI
     *
     */
    'AXI f24 (status_packet)' => [ 'request' =>
        [ 'data' => 'lQ5rAJJ7AAAAAAAAAAA=', 'fport' => '24', 'serial' => '4D130024' ],
        'results' => '{"packet_type":"status_packet","module_battery":{"value":3.258,"unit":"V","formatted":"3.258 V","value_raw":149},"module_temp":{"value":14,"unit":"\u00b0C","formatted":"14\u00b0C"},"downlink_rssi":{"value":-107,"unit":"dBm","formatted":"-107 dBm"},"state":{"user_triggered_packet":{"value":"0","formatted":"no"},"error_triggered_packet":{"value":"0","formatted":"no"},"temperature_triggered_packet":{"value":"0","formatted":"no"}},"accumulated_volume":{"value":31634,"unit":"L","formatted":"31634 L"},"meter_error":"00000000","register_map":{"accumulated_heat_energy":{"value":"0","formatted":"not_sent"},"accumulated_cooling_energy":{"value":"0","formatted":"not_sent"},"accumulated_pulse_1":{"value":"0","formatted":"not_sent"},"accumulated_pulse_2":{"value":"0","formatted":"not_sent"},"instant_flow_rate":{"value":"0","formatted":"not_sent"},"instant_power":{"value":"0","formatted":"not_sent"},"instant_temp_in":{"value":"0","formatted":"not_sent"},"instant_temp_out":{"value":"0","formatted":"not_sent"}},"hex":"950e6b00927b0000000000000000"}' ],

    'AXI f25 (usage_packet heat)' => [ 'request' =>
        [ 'data' => 'OKoIAPMAf08AAAAAAADy8c5ChP/JPyUS+ww=', 'fport' => '25', 'serial' => '4D130024' ],
        'results' => '{"packet_type":"usage_packet","accumulated_volume":{"value":567864,"unit":"L","formatted":"567864 L"},"register_map":{"accumulated_heat_energy":{"value":"1","formatted":"sent"},"accumulated_cooling_energy":{"value":"1","formatted":"sent"},"accumulated_pulse_1":{"value":"0","formatted":"not_sent"},"accumulated_pulse_2":{"value":"0","formatted":"not_sent"},"instant_flow_rate":{"value":"1","formatted":"sent"},"instant_power":{"value":"1","formatted":"sent"},"instant_temp_in":{"value":"1","formatted":"sent"},"instant_temp_out":{"value":"1","formatted":"sent"}},"accumulated_heat_energy":{"value":20351,"unit":"kWh","formatted":"20351 kWh"},"accumulated_cooling_energy":{"value":0,"unit":"kWh","formatted":"0 kWh"},"instant_flow_rate":{"value":103.47254943847656,"unit":"L\/h","formatted":"103.473 L\/h"},"instant_power":{"value":1.5781102180480957,"unit":"kW","formatted":"1.578 kW"},"instant_temp_in":{"value":46.45,"unit":"\u00b0C","formatted":"46.45\u00b0C"},"instant_temp_out":{"value":33.23,"unit":"\u00b0C","formatted":"33.23\u00b0C"},"hex":"38aa0800f3007f4f000000000000f2f1ce4284ffc93f2512fb0c"}' ],


    'AXI f25 (usage_packet)' => [ 'request' =>
        [ 'data' => 'lX4AABAAAAAAAA==', 'fport' => '25', 'serial' => '4D130024' ],
        'results' => '{"packet_type":"usage_packet","accumulated_volume":{"value":32405,"unit":"L","formatted":"32405 L"},"register_map":{"accumulated_heat_energy":{"value":"0","formatted":"not_sent"},"accumulated_cooling_energy":{"value":"0","formatted":"not_sent"},"accumulated_pulse_1":{"value":"0","formatted":"not_sent"},"accumulated_pulse_2":{"value":"0","formatted":"not_sent"},"instant_flow_rate":{"value":"1","formatted":"sent"},"instant_power":{"value":"0","formatted":"not_sent"},"instant_temp_in":{"value":"0","formatted":"not_sent"},"instant_temp_out":{"value":"0","formatted":"not_sent"}},"instant_flow_rate":{"value":0,"unit":"L\/h","formatted":"0.000 L\/h"},"hex":"957e0000100000000000"}' ],

    'AXI f25 (usage_packet - full)' => [ 'request' =>
        [ 'data' => '/IICAPMhNwAAAAAAAAAAAAAAAAAAxLw8QtxGA0I=', 'fport' => '25', 'serial' => '4D130024', 'firmware' => '0.7.63' ],
        'results' => '{"packet_type":"usage_packet","accumulated_volume":{"value":164604,"unit":"L","formatted":"164604 L"},"register_map":{"accumulated_heat_energy":{"value":"1","formatted":"sent"},"accumulated_cooling_energy":{"value":"1","formatted":"sent"},"accumulated_pulse_1":{"value":"0","formatted":"not_sent"},"accumulated_pulse_2":{"value":"0","formatted":"not_sent"},"instant_flow_rate":{"value":"1","formatted":"sent"},"instant_power":{"value":"1","formatted":"sent"},"instant_temp_in":{"value":"1","formatted":"sent"},"instant_temp_out":{"value":"1","formatted":"sent"}},"accumulated_heat_energy":{"value":55,"unit":"kWh","formatted":"55 kWh"},"accumulated_cooling_energy":{"value":0,"unit":"kWh","formatted":"0 kWh"},"instant_flow_rate":{"value":0,"unit":"L\/h","formatted":"0.000 L\/h"},"instant_power":{"value":-512,"unit":"kW","formatted":"-512.000 kW"},"instant_temp_in":{"value":155.48,"unit":"\u00b0C","formatted":"155.48\u00b0C"},"instant_temp_out":{"value":-91.5,"unit":"\u00b0C","formatted":"-91.50\u00b0C"},"hex":"fc820200f321370000000000000000000000000000c4bc3c42dc460342"}' ],


    'AXI f99 (boot_packet)' => [ 'request' =>
        [ 'data' => 'ACQAE00AAwUQiRQIAAA=', 'fport' => '99', 'serial' => '4D130024' ],
        'results' => '{"packet_type":"boot_packet","device_serial":"4d130024","firmware_version":"0.3.5","reset_reason":["magnet_wakeup"],"meter_id":"00081489","meter_type":{"value":"00","unit":"","formatted":"water_meter"},"hex":"002400134d000305108914080000"}' ],

    'AXI f99 (shutdown_packet)' => [ 'request' =>
        [ 'data' => 'ATGIGGIAAAAAAAQEAAAAAA==', 'fport' => '99', 'serial' => '4D130024' ],
        'results' => '{"packet_type":"shutdown_packet","shutdown_reason":{"value":"31","unit":"","formatted":"magnet_shutdown"},"module_battery":{"value":3.206,"unit":"V","formatted":"3.206 V","value_raw":136},"module_temp":{"value":24,"unit":"\u00b0C","formatted":"24\u00b0C"},"downlink_rssi":{"value":-98,"unit":"dBm","formatted":"-98 dBm"},"state":{"user_triggered_packet":{"value":"0","formatted":"no"},"error_triggered_packet":{"value":"0","formatted":"no"},"temperature_triggered_packet":{"value":"0","formatted":"no"}},"accumulated_volume":{"value":0,"unit":"L","formatted":"0 L"},"meter_error":"00000404","register_map":{"accumulated_heat_energy":{"value":"0","formatted":"not_sent"},"accumulated_cooling_energy":{"value":"0","formatted":"not_sent"},"accumulated_pulse_1":{"value":"0","formatted":"not_sent"},"accumulated_pulse_2":{"value":"0","formatted":"not_sent"},"instant_flow_rate":{"value":"0","formatted":"not_sent"},"instant_power":{"value":"0","formatted":"not_sent"},"instant_temp_in":{"value":"0","formatted":"not_sent"},"instant_temp_out":{"value":"0","formatted":"not_sent"}},"hex":"01318818620000000000040400000000"}' ],


    /**
     *
     * WML
     *
     */

    'WML f24 (status_packet - payload)' => [ 'request' =>
        [ 'data' => 'Af/ESzFELSwWmBRpHASNIG7YOdgiRiB62UwfYi/xXrNKD26++drYGw135vvGYQ6z1qVLE1lL', 'fport' => '24', 'serial' => '4c1d0224' ],
        'results' => '{"packet_type":"status_packet","header":"01","device":{"time":{"value":"Live","unit":"UTC","formatted":"Live","value_raw":255},"time_diff":{"value":-60,"unit":"min","formatted":"-60 min"},"rssi":{"value":-75,"unit":"dBm","formatted":"-75 dBm"},"wm_bus":{"length":"31","c_field":"44","man_id":{"value":"KAM","unit":"","formatted":"Kamstrup Energi A\/S (KAM)","value_raw":"2c2d"},"serial":"69149816","version":"1c","type":"04","payload":"8d206ed839d82246207ad94c1f622ff15eb34a0f6ebef9dad81b0d77e6fbc6610eb3d6a54b13594b"}},"hex":"01ffc44b31442d2c169814691c048d206ed839d82246207ad94c1f622ff15eb34a0f6ebef9dad81b0d77e6fbc6610eb3d6a54b13594b"}' ],

    'WML f24 (status_packet - error)' => [ 'request' =>
        [ 'data' => 'Af8AbDFELSxjAJNpHAQc', 'fport' => '24', 'serial' => '4c1d0224' ],
        'results' => '{"packet_type":"status_packet","header":"01","device":{"time":{"value":"Live","unit":"UTC","formatted":"Live","value_raw":255},"time_diff":{"value":0,"unit":"min","formatted":"0 min"},"rssi":{"value":-108,"unit":"dBm","formatted":"-108 dBm"},"wm_bus":{"length":"31","c_field":"44","man_id":{"value":"KAM","unit":"","formatted":"Kamstrup Energi A\/S (KAM)","value_raw":"2c2d"},"serial":"69930063","version":"1c","type":"04","status":{"maximum_sf":{"value":12},"sf_too_low":{"value":1,"formatted":true},"communication_lost":{"value":0,"formatted":false}}}},"hex":"01ff006c31442d2c630093691c041c"}' ],

    'WML f24 (status_packet - bridge)' => [ 'request' =>
        [ 'data' => 'AJIobzgAE/8AAwI=', 'fport' => '24', 'serial' => '4c1d0224' ],
        'results' => '{"packet_type":"status_packet","header":"00","bridge":{"time":{"value":"02.01.2000 10:29:38","unit":"UTC","formatted":"02.01.2000 10:29:38 UTC","value_raw":946808978},"rssi":{"value":0,"unit":"dBm","formatted":"0 dBm"},"temp":{"value":19,"unit":"C","formatted":"19 C"},"battery":{"value":255,"unit":"","formatted":"255 "},"status":{"grid_power":{"value":"0","formatted":false}},"connected_devices":{"value":3,"unit":"","formatted":"3 "},"available devices":{"value":2,"unit":"","formatted":"2 "}},"hex":"0092286f380013ff000302"}' ],

    'WML f25 (usage_packet)' => [ 'request' =>
        [ 'data' => 'Af/+LkQBBiMmAIABFnpbAyAFzwL7hhUP2kHJziFejXjxMaJ4rT28rp4yNxOXhioGeQU=', 'fport' => '25', 'serial' => '4c1d0224' ],
        'results' => '{"packet_type":"status_packet","header":"01","device":{"time":{"value":"Live","unit":"UTC","formatted":"Live","value_raw":255},"time_diff":{"value":-2,"unit":"min","formatted":"-2 min"},"wm_bus":{"length":"2e","c_field":"44","man_id":{"value":"APA","unit":"","formatted":"Apator SA (APA)","value_raw":"0601"},"serial":"80002623","version":"01","type":"16","payload":"7a5b032005cf02fb86150fda41c9ce215e8d78f131a278ad3dbcae9e32371397862a067905"}},"hex":"01fffe2e4401062326008001167a5b032005cf02fb86150fda41c9ce215e8d78f131a278ad3dbcae9e32371397862a067905"}' ],

    'WML f25 (usage_packet - payload decryption)' => [ 'request' =>
        [ 'data' => 'Af/NHkQzOJSWAyABB3pBABAFUGwFvUa2Wwe+d74/+UUJFw==', 'fport' => '25', 'serial' => '4c1d001c', 'encrypt_key' => '72344e7a8e11177224a781c2ae151c51' ],
        'results' => '{"packet_type":"status_packet","header":"01","device":{"time":{"value":"Live","unit":"UTC","formatted":"Live","value_raw":255},"time_diff":{"value":-51,"unit":"min","formatted":"-51 min"},"wm_bus":{"length":"1e","c_field":"44","man_id":{"value":"NAS","unit":"","formatted":"NAS Instruments O\u00dc (NAS)","value_raw":"3833"},"serial":"20039694","version":"01","type":"07","payload":[{"hex":"2f2f02fd0837000413000000002f2f2f","data_records":{"1":{"_function":"instant value","value_type":"unrecongized VIF extension 0x08","_encoding":"16 bit integer","_header_raw":"02fd08","_data_raw":"3700","value":55},"2":{"_function":"instant value","value_type":"volume","unit":" m\u00b3","_exp":-3,"_encoding":"32 bit integer","_header_raw":"0413","_data_raw":"00000000","value":0,"_value_raw":0}}}]}},"hex":"01ffcd1e4433389496032001077a41001005506c05bd46b65b07be77be3ff9450917"}' ],


    'WML f49 (request_config_packet) device_list' => [ 'request' =>
        [ 'data' => 'AgCFB3EAAIclFpCWAyBQFQCAIyYAgJgyAIB0MnKIVxN1lCADlpQ=', 'fport' => '49', 'serial' => '4c1d0224' ],
        'results' => '{"packet_type":"device_list","message":{"current":{"value":0},"total":{"value":0}},"payload":[{"serial":"00710785"},{"serial":"16258700"},{"serial":"20039690"},{"serial":"80001550"},{"serial":"80002623"},{"serial":"80003298"},{"serial":"88723274"},{"serial":"94751357"},{"serial":"94960320"}],"hex":"0200850771000087251690960320501500802326008098320080743272885713759420039694"}' ],


    'WML f53 (alert_packet)' => [ 'request' =>
        [ 'data' => 'AAADawlgU1kACAMMIFY0Bgg7DBaYFGkIsAxjAJNpCC4MYXMygA==', 'fport' => '53', 'serial' => '4c1d0224' ],
        'results' => '{"packet_type":"wm_bus_discover","message":{"current":{"value":0},"total":{"value":0}},"payload":[{"mode":{"value":"03","unit":"","formatted":"T1"},"rssi":{"value":-107,"unit":"dBm","formatted":"-107 dBm"},"data_rate":{"maximum_sf":{"value":9}},"serial":"00595360"},{"mode":{"value":"08","unit":"","formatted":"C2 T-A"},"rssi":{"value":-3,"unit":"dBm","formatted":"-3 dBm"},"data_rate":{"maximum_sf":{"value":12}},"serial":"06345620"},{"mode":{"value":"08","unit":"","formatted":"C2 T-A"},"rssi":{"value":-59,"unit":"dBm","formatted":"-59 dBm"},"data_rate":{"maximum_sf":{"value":12}},"serial":"69149816"},{"mode":{"value":"08","unit":"","formatted":"C2 T-A"},"rssi":{"value":-176,"unit":"dBm","formatted":"-176 dBm"},"data_rate":{"maximum_sf":{"value":12}},"serial":"69930063"},{"mode":{"value":"08","unit":"","formatted":"C2 T-A"},"rssi":{"value":-46,"unit":"dBm","formatted":"-46 dBm"},"data_rate":{"maximum_sf":{"value":12}},"serial":"80327361"}],"hex":"0000036b096053590008030c20563406083b0c1698146908b00c63009369082e0c61733280"}' ],


    'WML f99 (boot_packet)' => [ 'request' =>
        [ 'data' => 'ABUAHUwAAQoA', 'fport' => '99', 'serial' => '4c1d0224' ],
        'results' => '{"packet_type":"boot_packet","device_serial":"4c1d0015","firmware_version":"0.1.10","connected_devices":{"value":0,"unit":"","formatted":"0 "},"hex":"0015001d4c00010a00"}' ],


    /**
     *
     * OIR
     *
     */

    'OIR f99 (boot_packet)' => [ 'request' =>
        [ 'data' => 'AAcAEU0ABxkQAgQ=', 'fport' => '99', 'serial' => '4D110007' ],
        'results' => '{"packet_type":"boot_packet","device_serial":"4d110007","firmware_version":"0.7.25","reset_reason":["magnet_wakeup"],"general_info":{"battery_type":{"value":2,"formatted":"3V6"}},"hardware_config":{"value":"04","unit":"","formatted":"digital_+_mbus"},"hex":"000700114d000719100204"}' ],

    'OIR f99 (boot_packet) fw0.8.0' => [ 'request' =>
        [ 'data' => 'AHkAgU0ACAAEgAQ=', 'fport' => '99', 'serial' => '4d810079', 'firmware' => '0.8.0' ],
        'results' => '{"packet_type":"boot_packet","device_serial":"4d810079","firmware_version":"0.8.0","reset_reason":["soft_reset"],"general_info":{"configuration_restored":{"value":1,"formatted":"true"}},"hardware_config":{"value":"04","unit":"","formatted":"digital_+_mbus"},"hex":"007900814d000800048004"}' ],

    'OIR f99 (boot_packet)LBUS fw0.8.0' => [ 'request' =>
        [ 'data' => 'ABEAgVAACAAEAAY=', 'fport' => '99', 'serial' => '4d810079', 'firmware' => '0.8.4' ],
        'results' => '{"packet_type":"boot_packet","device_serial":"50810011","firmware_version":"0.8.0","reset_reason":["soft_reset"],"general_info":{"configuration_restored":{"value":0,"formatted":"false"}},"hardware_config":{"value":"06","unit":"","formatted":"digital_+_lbus"},"hex":"0011008150000800040006"}' ],

    'OIR f24 (status_packet)' => [ 'request' =>
        [ 'data' => 'AawXcCCPeSUA', 'fport' => '24', 'serial' => '4C1600FF' ],
        'results' => '{"packet_type":"status_packet","reported_interfaces":{"digital_1":{"value":1,"formatted":"sent"},"digital_2":{"value":0,"formatted":"not_sent"},"analog_1":{"value":0,"formatted":"not_sent"},"analog_2":{"value":0,"formatted":"not_sent"},"ssi":{"value":0,"formatted":"not_sent"},"mbus":{"value":0,"formatted":"not_sent"},"user_triggered_packet":{"value":0,"formatted":"no"},"temperature_triggered_packet":{"value":0,"formatted":"no"}},"battery":{"value":3.350000000000000088817841970012523233890533447265625,"unit":"V","formatted":"3.35 V","value_raw":172},"mcu_temperature":{"value":23,"unit":"\u00b0C","formatted":"23\u00b0C"},"downlink_rssi":{"value":-112,"unit":"dBm","formatted":"-112 dBm"},"digital_1":{"state":{"input_state":{"value":0,"formatted":"open"},"operational_mode":{"value":0,"formatted":"pulse_mode"},"alert_state":{"value":0},"medium_type":{"value":2,"formatted":"L_water"}},"counter":{"value":2455951,"unit":"L_water","formatted":"2455951 L_water"}},"hex":"01ac1770208f792500"}' ],

    'OIR f24 (status_packet) 0.8.7' => [ 'request' =>
        [ 'data' => 'jwL/KxYAV1hOYbwARDMiERoAAAAAZneImUJodJlAQygoWkE=', 'fport' => '24', 'serial' => '4c860973', 'firmware' => '0.8.7' ],
        'results' => '{"packet_type":"status_packet","reported_interfaces":{"digital_1":{"value":1,"formatted":"sent"},"digital_2":{"value":1,"formatted":"sent"},"analog_1":{"value":1,"formatted":"sent"},"analog_2":{"value":1,"formatted":"sent"},"ssi":{"value":0,"formatted":"not_sent"},"mbus":{"value":0,"formatted":"not_sent"},"user_triggered_packet":{"value":0,"formatted":"no"},"active_alerts":{"value":1,"formatted":"yes"}},"active_alerts":{"digital_interface_alert":{"value":0,"formatted":"no"},"secondary_interface_alert":{"value":1,"formatted":"yes"},"temperature_alert":{"value":0,"formatted":"no"}},"battery_percentage":{"value":"255","unit":"%","formatted":"not_available"},"battery_voltage":{"value":2.833999999999999630517777404747903347015380859375,"unit":"V","formatted":"2.834 V","value_raw":43},"mcu_temperature":{"value":22,"unit":"\u00b0C","formatted":"22\u00b0C"},"temp_extremes":{"min_offset":{"value":0,"formatted":"0\u00b0C"},"max_offset":{"value":0,"formatted":"0\u00b0C"}},"downlink_rssi":{"value":-87,"unit":"dBm","formatted":"-87 dBm"},"digital_1":{"state":{"input_state":{"value":0,"formatted":"open"},"operational_mode":{"value":0,"formatted":"pulse_mode"},"alert_state":{"value":0},"medium_type":{"value":5,"formatted":"Wh_heat"},"device_serial_sent":{"value":1}},"counter":{"value":12345678,"unit":"Wh_heat","formatted":"12345678 Wh_heat"},"device_serial":"11223344"},"digital_2":{"state":{"input_state":{"value":0,"formatted":"open"},"operational_mode":{"value":1,"formatted":"trigger_mode"},"alert_state":{"value":0},"medium_type":{"value":1,"formatted":"pulses"},"device_serial_sent":{"value":1}},"counter":{"value":0,"unit":"pulses","formatted":"0 pulses"},"device_serial":"99887766"},"analog_1":{"general":{"input_mode":{"value":0,"formatted":"V"},"is_alert":{"value":1,"formatted":"yes"},"instant_value_reported":{"value":1,"formatted":"reported"},"average_value_reported":{"value":0,"formatted":"not reported"}},"instant_value":{"value":4.795459747314453125,"unit":"V","formatted":"4.80 V"}},"analog_2":{"general":{"input_mode":{"value":1,"formatted":"mA"},"is_alert":{"value":1,"formatted":"yes"},"instant_value_reported":{"value":1,"formatted":"reported"},"average_value_reported":{"value":0,"formatted":"not reported"}},"instant_value":{"value":13.63480377197265625,"unit":"mA","formatted":"13.63 mA"}},"hex":"8f02ff2b160057584e61bc00443322111a000000006677889942687499404328285a41"}' ],

    'OIR f24 (status_packet - 2x digital)' => [ 'request' =>
        [ 'data' => 'QxEXXxAAAAAAQhAAAJE=', 'fport' => '24', 'serial' => '4C1600FF' ],
        'results' => '{"packet_type":"status_packet","reported_interfaces":{"digital_1":{"value":1,"formatted":"sent"},"digital_2":{"value":1,"formatted":"sent"},"analog_1":{"value":0,"formatted":"not_sent"},"analog_2":{"value":0,"formatted":"not_sent"},"ssi":{"value":0,"formatted":"not_sent"},"mbus":{"value":0,"formatted":"not_sent"},"user_triggered_packet":{"value":1,"formatted":"yes"},"temperature_triggered_packet":{"value":0,"formatted":"no"}},"battery":{"value":2.68400000000000016342482922482304275035858154296875,"unit":"V","formatted":"2.684 V","value_raw":17},"mcu_temperature":{"value":23,"unit":"\u00b0C","formatted":"23\u00b0C"},"downlink_rssi":{"value":-95,"unit":"dBm","formatted":"-95 dBm"},"digital_1":{"state":{"input_state":{"value":0,"formatted":"open"},"operational_mode":{"value":0,"formatted":"pulse_mode"},"alert_state":{"value":0},"medium_type":{"value":1,"formatted":"pulses"}},"counter":{"value":0,"unit":"pulses","formatted":"0 pulses"}},"digital_2":{"state":{"input_state":{"value":0,"formatted":"open"},"operational_mode":{"value":1,"formatted":"trigger_mode"},"alert_state":{"value":0},"medium_type":{"value":4,"formatted":"L_gas"}},"counter":{"value":2432696336,"unit":"L_gas","formatted":"2432696336 L_gas"}},"hex":"4311175f10000000004210000091"}' ],

    'OIR f24 (status_packet - mbus)' => [ 'request' =>
        [ 'data' => 'oxABchAAAAAAEAAAAAAAAAx4ITkTAAwUZAAAAA==', 'fport' => '24', 'serial' => '4C1600FF' ],
        'results' => ' {"packet_type":"status_packet","reported_interfaces":{"digital_1":{"value":1,"formatted":"sent"},"digital_2":{"value":1,"formatted":"sent"},"analog_1":{"value":0,"formatted":"not_sent"},"analog_2":{"value":0,"formatted":"not_sent"},"ssi":{"value":0,"formatted":"not_sent"},"mbus":{"value":1,"formatted":"sent"},"user_triggered_packet":{"value":0,"formatted":"no"},"temperature_triggered_packet":{"value":1,"formatted":"yes"}},"battery":{"value":2.633999999999999896971303314785473048686981201171875,"unit":"V","formatted":"2.634 V","value_raw":16},"mcu_temperature":{"value":1,"unit":"\u00b0C","formatted":"1\u00b0C"},"downlink_rssi":{"value":-114,"unit":"dBm","formatted":"-114 dBm"},"digital_1":{"state":{"input_state":{"value":0,"formatted":"open"},"operational_mode":{"value":0,"formatted":"pulse_mode"},"alert_state":{"value":0},"medium_type":{"value":1,"formatted":"pulses"}},"counter":{"value":0,"unit":"pulses","formatted":"0 pulses"}},"digital_2":{"state":{"input_state":{"value":0,"formatted":"open"},"operational_mode":{"value":0,"formatted":"pulse_mode"},"alert_state":{"value":0},"medium_type":{"value":1,"formatted":"pulses"}},"counter":{"value":0,"unit":"pulses","formatted":"0 pulses"}},"mbus":{"state":{"last_status":{"value":0,"formatted":"ok"}},"mbus_status":"00","data_records":{"1":{"_function":"instant value","value_type":"fabrication number","_encoding":"8 digit BCD","_header_raw":"0c78","_data_raw":"21391300","value":133921},"2":{"_function":"instant value","value_type":"volume","unit":" m\u00b3","_exp":-2,"_encoding":"8 digit BCD","_header_raw":"0c14","_data_raw":"64000000","value":0.64000000000000001332267629550187848508358001708984375,"_value_raw":64}}},"hex":"a31001721000000000100000000000000c78213913000c1464000000"}' ],

    'OIR f24 (status_packet - mbus) fw0.8.0' => [ 'request' =>
        [ 'data' => 'Y/+UFgBkEAAAAAASAAAAAAAAC1p4BAALYkgBAAwGCZICAA==', 'fport' => '24', 'serial' => '4d810079', 'firmware' => '0.8.3' ],
        'results' => '{"packet_type":"status_packet","reported_interfaces":{"digital_1":{"value":1,"formatted":"sent"},"digital_2":{"value":1,"formatted":"sent"},"analog_1":{"value":0,"formatted":"not_sent"},"analog_2":{"value":0,"formatted":"not_sent"},"ssi":{"value":0,"formatted":"not_sent"},"mbus":{"value":1,"formatted":"sent"},"user_triggered_packet":{"value":1,"formatted":"yes"},"active_alerts":{"value":0,"formatted":"no"}},"battery_percentage":{"value":"255","unit":"%","formatted":"not_available"},"battery_voltage":{"value":3.254000000000000003552713678800500929355621337890625,"unit":"V","formatted":"3.254 V","value_raw":148},"mcu_temperature":{"value":22,"unit":"\u00b0C","formatted":"22\u00b0C"},"temp_extremes":{"min_offset":{"value":0,"formatted":"0\u00b0C"},"max_offset":{"value":0,"formatted":"0\u00b0C"}},"downlink_rssi":{"value":-100,"unit":"dBm","formatted":"-100 dBm"},"digital_1":{"state":{"input_state":{"value":0,"formatted":"open"},"operational_mode":{"value":0,"formatted":"pulse_mode"},"alert_state":{"value":0},"medium_type":{"value":1,"formatted":"pulses"},"device_serial_sent":{"value":0}},"counter":{"value":0,"unit":"pulses","formatted":"0 pulses"}},"digital_2":{"state":{"input_state":{"value":0,"formatted":"open"},"operational_mode":{"value":1,"formatted":"trigger_mode"},"alert_state":{"value":0},"medium_type":{"value":1,"formatted":"pulses"},"device_serial_sent":{"value":0}},"counter":{"value":0,"unit":"pulses","formatted":"0 pulses"}},"mbus":{"state":{"last_status":{"value":0,"formatted":"ok"},"packet_truncated":{"value":0,"formatted":"false"}},"mbus_status":"00","data_records":{"1":{"_function":"instant value","value_type":"flow temperature","unit":"\u00b0C","_exp":-1,"_encoding":"6 digit BCD","_header_raw":"0b5a","_data_raw":"780400","value":47.80000000000000426325641456060111522674560546875,"_value_raw":478},"2":{"_function":"instant value","value_type":"temperature difference","unit":"\u00b0C","_exp":-1,"_encoding":"6 digit BCD","_header_raw":"0b62","_data_raw":"480100","value":14.800000000000000710542735760100185871124267578125,"_value_raw":148},"3":{"_function":"instant value","value_type":"energy","unit":" Wh","_exp":3,"_encoding":"8 digit BCD","_header_raw":"0c06","_data_raw":"09920200","value":29209000,"_value_raw":29209}}},"hex":"63ff941600641000000000120000000000000b5a7804000b624801000c0609920200"}' ],

    'OIR f24 (status_packet) fw0.8.4' => [ 'request' =>
        [ 'data' => 'jAL/phQAX0CabBA8QgAAAAA=', 'fport' => '24', 'serial' => '4d810079', 'firmware' => '0.8.4' ],
        'results' => '{"packet_type":"status_packet","reported_interfaces":{"digital_1":{"value":0,"formatted":"not_sent"},"digital_2":{"value":0,"formatted":"not_sent"},"analog_1":{"value":1,"formatted":"sent"},"analog_2":{"value":1,"formatted":"sent"},"ssi":{"value":0,"formatted":"not_sent"},"mbus":{"value":0,"formatted":"not_sent"},"user_triggered_packet":{"value":0,"formatted":"no"},"active_alerts":{"value":1,"formatted":"yes"}},"active_alerts":{"digital_interface_alert":{"value":0,"formatted":"no"},"secondary_interface_alert":{"value":1,"formatted":"yes"},"temperature_alert":{"value":0,"formatted":"no"}},"battery_percentage":{"value":"255","unit":"%","formatted":"not_available"},"battery_voltage":{"value":3.326000000000000067501559897209517657756805419921875,"unit":"V","formatted":"3.326 V","value_raw":166},"mcu_temperature":{"value":20,"unit":"\u00b0C","formatted":"20\u00b0C"},"temp_extremes":{"min_offset":{"value":0,"formatted":"0\u00b0C"},"max_offset":{"value":0,"formatted":"0\u00b0C"}},"downlink_rssi":{"value":-95,"unit":"dBm","formatted":"-95 dBm"},"analog_1":{"general":{"input_mode":{"value":0,"formatted":"V"},"is_alert":{"value":0,"formatted":"no"},"instant_value_reported":{"value":1,"formatted":"reported"},"average_value_reported":{"value":0,"formatted":"not reported"}},"instant_value":{"value":0.00881495513021945953369140625,"unit":"V","formatted":"0.01 V"}},"analog_2":{"general":{"input_mode":{"value":0,"formatted":"V"},"is_alert":{"value":1,"formatted":"yes"},"instant_value_reported":{"value":1,"formatted":"reported"},"average_value_reported":{"value":0,"formatted":"not reported"}},"instant_value":{"value":0,"unit":"V","formatted":"0.00 V"}},"hex":"8c02ffa614005f409a6c103c4200000000"}' ],

    'OIR f24 (status_packet - mbus empty)' => [ 'request' =>
        [ 'data' => 'o3QDchAAAAAAEAAAAAABAAA=', 'fport' => '24', 'serial' => '4C1600FF' ],
        'results' => '{"packet_type":"status_packet","reported_interfaces":{"digital_1":{"value":1,"formatted":"sent"},"digital_2":{"value":1,"formatted":"sent"},"analog_1":{"value":0,"formatted":"not_sent"},"analog_2":{"value":0,"formatted":"not_sent"},"ssi":{"value":0,"formatted":"not_sent"},"mbus":{"value":1,"formatted":"sent"},"user_triggered_packet":{"value":0,"formatted":"no"},"temperature_triggered_packet":{"value":1,"formatted":"yes"}},"battery":{"value":3.125999999999999889865875957184471189975738525390625,"unit":"V","formatted":"3.126 V","value_raw":116},"mcu_temperature":{"value":3,"unit":"\u00b0C","formatted":"3\u00b0C"},"downlink_rssi":{"value":-114,"unit":"dBm","formatted":"-114 dBm"},"digital_1":{"state":{"input_state":{"value":0,"formatted":"open"},"operational_mode":{"value":0,"formatted":"pulse_mode"},"alert_state":{"value":0},"medium_type":{"value":1,"formatted":"pulses"}},"counter":{"value":0,"unit":"pulses","formatted":"0 pulses"}},"digital_2":{"state":{"input_state":{"value":0,"formatted":"open"},"operational_mode":{"value":0,"formatted":"pulse_mode"},"alert_state":{"value":0},"medium_type":{"value":1,"formatted":"pulses"}},"counter":{"value":0,"unit":"pulses","formatted":"0 pulses"}},"mbus":{"state":{"last_status":{"value":1,"formatted":"nothing_requested"}}},"hex":"a374037210000000001000000000010000"}' ],

    'OIR f24 (status_packet - ssi)' => [ 'request' =>
        [ 'data' => 'EfcaZBAAAAAAgQULRrU/9ijOQQ==', 'fport' => '24', 'serial' => '4d880060' ],
        'results' => '{"packet_type":"status_packet","reported_interfaces":{"digital_1":{"value":1,"formatted":"sent"},"digital_2":{"value":0,"formatted":"not_sent"},"analog_1":{"value":0,"formatted":"not_sent"},"analog_2":{"value":0,"formatted":"not_sent"},"ssi":{"value":1,"formatted":"sent"},"mbus":{"value":0,"formatted":"not_sent"},"user_triggered_packet":{"value":0,"formatted":"no"},"temperature_triggered_packet":{"value":0,"formatted":"no"}},"battery":{"value":3.649999999999999911182158029987476766109466552734375,"unit":"V","formatted":"3.65 V","value_raw":247},"mcu_temperature":{"value":26,"unit":"\u00b0C","formatted":"26\u00b0C"},"downlink_rssi":{"value":-100,"unit":"dBm","formatted":"-100 dBm"},"digital_1":{"state":{"input_state":{"value":0,"formatted":"open"},"operational_mode":{"value":0,"formatted":"pulse_mode"},"alert_state":{"value":0},"medium_type":{"value":1,"formatted":"pulses"}},"counter":{"value":0,"unit":"pulses","formatted":"0 pulses"}},"ssi":{"general":{"ssi_index":{"value":1},"is_alert":{"value":1,"formatted":true}},"reported_parameters":{"channel_1_instant":{"value":1,"formatted":"reported"},"channel_2_instant":{"value":1,"formatted":"reported"},"channel_3_instant":{"value":0,"formatted":"not reported"},"channel_4_instant":{"value":0,"formatted":"not reported"}},"channel_1_instant":{"value":1.41620004177093505859375,"unit":"bar","formatted":"1.416 bar"},"channel_2_instant":{"value":25.770000457763671875,"unit":"\u00b0C","formatted":"25.770 \u00b0C"}},"hex":"11f71a64100000000081050b46b53ff628ce41"}' ],

    'OIR f24 (status_packet - ssi) fw0.8.0' => [ 'request' =>
        [ 'data' => 'Uf9wGABSEAAAAAABBT9Xgz8zM7tB', 'fport' => '24', 'serial' => '4d98005b', 'firmware' => '0.8.3' ],
        'results' => '{"packet_type":"status_packet","reported_interfaces":{"digital_1":{"value":1,"formatted":"sent"},"digital_2":{"value":0,"formatted":"not_sent"},"analog_1":{"value":0,"formatted":"not_sent"},"analog_2":{"value":0,"formatted":"not_sent"},"ssi":{"value":1,"formatted":"sent"},"mbus":{"value":0,"formatted":"not_sent"},"user_triggered_packet":{"value":1,"formatted":"yes"},"active_alerts":{"value":0,"formatted":"no"}},"battery_percentage":{"value":"255","unit":"%","formatted":"not_available"},"battery_voltage":{"value":3.109999999999999875655021241982467472553253173828125,"unit":"V","formatted":"3.11 V","value_raw":112},"mcu_temperature":{"value":24,"unit":"\u00b0C","formatted":"24\u00b0C"},"temp_extremes":{"min_offset":{"value":0,"formatted":"0\u00b0C"},"max_offset":{"value":0,"formatted":"0\u00b0C"}},"downlink_rssi":{"value":-82,"unit":"dBm","formatted":"-82 dBm"},"digital_1":{"state":{"input_state":{"value":0,"formatted":"open"},"operational_mode":{"value":0,"formatted":"pulse_mode"},"alert_state":{"value":0},"medium_type":{"value":1,"formatted":"pulses"},"device_serial_sent":{"value":0}},"counter":{"value":0,"unit":"pulses","formatted":"0 pulses"}},"ssi":{"general":{"ssi_index":{"value":1},"is_alert":{"value":0,"formatted":false}},"reported_parameters":{"channel_1_instant":{"value":1,"formatted":"reported"},"channel_2_instant":{"value":1,"formatted":"reported"},"channel_3_instant":{"value":0,"formatted":"not reported"},"channel_4_instant":{"value":0,"formatted":"not reported"}},"channel_1_instant":{"value":1.02610003948211669921875,"unit":"bar","formatted":"1.026 bar"},"channel_2_instant":{"value":23.3999996185302734375,"unit":"\u00b0C","formatted":"23.400 \u00b0C"}},"hex":"51ff70180052100000000001053f57833f3333bb41"}' ],

    'OIR f25 (usage_packet)' => [ 'request' =>
        [ 'data' => 'ASDw2yUA', 'fport' => '25', 'serial' => '4D110007' ],
        'results' => '{"packet_type":"usage_packet","reported_interfaces":{"digital_1":{"value":1,"formatted":"sent"},"digital_2":{"value":0,"formatted":"not_sent"},"analog_1":{"value":0,"formatted":"not_sent"},"analog_2":{"value":0,"formatted":"not_sent"},"ssi":{"value":0,"formatted":"not_sent"},"mbus":{"value":0,"formatted":"not_sent"}},"digital_1":{"state":{"input_state":{"value":0,"formatted":"open"},"operational_mode":{"value":0,"formatted":"pulse_mode"},"alert_state":{"value":0},"medium_type":{"value":2,"formatted":"L_water"}},"counter":{"value":2481136,"unit":"L_water","formatted":"2481136 L_water"}},"hex":"0120f0db2500"}' ],

    'OIR f25 (usage_packet - analog)' => [ 'request' =>
        [ 'data' => 'DyAeAAAAIC0AAADAvxDyQEc66UDAMkHrQIb49kA=', 'fport' => '25', 'serial' => '4d98005b', 'firmware' => '0.8.3' ],
        'results' => '{"packet_type":"usage_packet","reported_interfaces":{"digital_1":{"value":1,"formatted":"sent"},"digital_2":{"value":1,"formatted":"sent"},"analog_1":{"value":1,"formatted":"sent"},"analog_2":{"value":1,"formatted":"sent"},"ssi":{"value":0,"formatted":"not_sent"},"mbus":{"value":0,"formatted":"not_sent"}},"digital_1":{"state":{"input_state":{"value":0,"formatted":"open"},"operational_mode":{"value":0,"formatted":"pulse_mode"},"alert_state":{"value":0},"medium_type":{"value":2,"formatted":"L_water"},"device_serial_sent":{"value":0}},"counter":{"value":30,"unit":"L_water","formatted":"30 L_water"}},"digital_2":{"state":{"input_state":{"value":0,"formatted":"open"},"operational_mode":{"value":0,"formatted":"pulse_mode"},"alert_state":{"value":0},"medium_type":{"value":2,"formatted":"L_water"},"device_serial_sent":{"value":0}},"counter":{"value":45,"unit":"L_water","formatted":"45 L_water"}},"analog_1":{"general":{"input_mode":{"value":0,"formatted":"V"},"is_alert":{"value":0,"formatted":"no"},"instant_value_reported":{"value":1,"formatted":"reported"},"average_value_reported":{"value":1,"formatted":"reported"}},"instant_value":{"value":7.564544200897216796875,"unit":"V","formatted":"7.56 V"},"average_value":{"value":7.288363933563232421875,"unit":"V","formatted":"7.29 V"}},"analog_2":{"general":{"input_mode":{"value":0,"formatted":"V"},"is_alert":{"value":0,"formatted":"no"},"instant_value_reported":{"value":1,"formatted":"reported"},"average_value_reported":{"value":1,"formatted":"reported"}},"instant_value":{"value":7.35170841217041015625,"unit":"V","formatted":"7.35 V"},"average_value":{"value":7.71783733367919921875,"unit":"V","formatted":"7.72 V"}},"hex":"0f201e000000202d000000c0bf10f240473ae940c03241eb4086f8f640"}' ],

    'OIR f25 (usage_packet)fw 0.8.4' => [ 'request' =>
        [ 'data' => 'DRAAAAAAwbY640DV2+hAwRP7/kG+Jv5B', 'fport' => '25', 'serial' => '4d98005b' ],
        'results' => '{"packet_type":"usage_packet","reported_interfaces":{"digital_1":{"value":1,"formatted":"sent"},"digital_2":{"value":0,"formatted":"not_sent"},"analog_1":{"value":1,"formatted":"sent"},"analog_2":{"value":1,"formatted":"sent"},"ssi":{"value":0,"formatted":"not_sent"},"mbus":{"value":0,"formatted":"not_sent"}},"digital_1":{"state":{"input_state":{"value":0,"formatted":"open"},"operational_mode":{"value":0,"formatted":"pulse_mode"},"alert_state":{"value":0},"medium_type":{"value":1,"formatted":"pulses"}},"counter":{"value":0,"unit":"pulses","formatted":"0 pulses"}},"analog_1":{"general":{"input_mode":{"value":1,"formatted":"mA"},"is_alert":{"value":0,"formatted":"no"},"instant_value_reported":{"value":1,"formatted":"reported"},"average_value_reported":{"value":1,"formatted":"reported"}},"instant_value":{"value":7.10091686248779296875,"unit":"mA","formatted":"7.10 mA"},"average_value":{"value":7.276834964752197265625,"unit":"mA","formatted":"7.28 mA"}},"analog_2":{"general":{"input_mode":{"value":1,"formatted":"mA"},"is_alert":{"value":0,"formatted":"no"},"instant_value_reported":{"value":1,"formatted":"reported"},"average_value_reported":{"value":1,"formatted":"reported"}},"instant_value":{"value":31.8725948333740234375,"unit":"mA","formatted":"31.87 mA"},"average_value":{"value":31.768917083740234375,"unit":"mA","formatted":"31.77 mA"}},"hex":"0d1000000000c1b63ae340d5dbe840c113fbfe41be26fe41"}' ],

    'OIR f24 (status_packet - analog)' => [ 'request' =>
        [ 'data' => 'Da8UXRAAAAAAQbY640BBuWj+QQ==', 'fport' => '24', 'serial' => '4d98005b' ],
        'results' => '{"packet_type":"status_packet","reported_interfaces":{"digital_1":{"value":1,"formatted":"sent"},"digital_2":{"value":0,"formatted":"not_sent"},"analog_1":{"value":1,"formatted":"sent"},"analog_2":{"value":1,"formatted":"sent"},"ssi":{"value":0,"formatted":"not_sent"},"mbus":{"value":0,"formatted":"not_sent"},"user_triggered_packet":{"value":0,"formatted":"no"},"temperature_triggered_packet":{"value":0,"formatted":"no"}},"battery":{"value":3.3620000000000000994759830064140260219573974609375,"unit":"V","formatted":"3.362 V","value_raw":175},"mcu_temperature":{"value":20,"unit":"\u00b0C","formatted":"20\u00b0C"},"downlink_rssi":{"value":-93,"unit":"dBm","formatted":"-93 dBm"},"digital_1":{"state":{"input_state":{"value":0,"formatted":"open"},"operational_mode":{"value":0,"formatted":"pulse_mode"},"alert_state":{"value":0},"medium_type":{"value":1,"formatted":"pulses"}},"counter":{"value":0,"unit":"pulses","formatted":"0 pulses"}},"analog_1":{"general":{"input_mode":{"value":1,"formatted":"mA"},"is_alert":{"value":0,"formatted":"no"},"instant_value_reported":{"value":1,"formatted":"reported"},"average_value_reported":{"value":0,"formatted":"not reported"}},"instant_value":{"value":7.10091686248779296875,"unit":"mA","formatted":"7.10 mA"}},"analog_2":{"general":{"input_mode":{"value":1,"formatted":"mA"},"is_alert":{"value":0,"formatted":"no"},"instant_value_reported":{"value":1,"formatted":"reported"},"average_value_reported":{"value":0,"formatted":"not reported"}},"instant_value":{"value":31.8011341094970703125,"unit":"mA","formatted":"31.80 mA"}},"hex":"0daf145d100000000041b63ae34041b968fe41"}' ],

    'OIR f24 (status_packet - status) 0.8 - 0.8.2' => [ 'request' =>
        [ 'data' => 'A2YQ4INApAYAABIAAAAA', 'fport' => '24', 'serial' => '4d98005b', 'firmware' => '0.8.1' ],
        'results' => '{"packet_type":"status_packet","reported_interfaces":{"digital_1":{"value":1,"formatted":"sent"},"digital_2":{"value":1,"formatted":"sent"},"analog_1":{"value":0,"formatted":"not_sent"},"analog_2":{"value":0,"formatted":"not_sent"},"ssi":{"value":0,"formatted":"not_sent"},"mbus":{"value":0,"formatted":"not_sent"},"user_triggered_packet":{"value":0,"formatted":"no"},"active_alerts":{"value":0,"formatted":"no"}},"battery_voltage":{"value":3.069999999999999840127884453977458178997039794921875,"unit":"V","formatted":"3.07 V","value_raw":102},"mcu_temperature":{"value":16,"unit":"\u00b0C","formatted":"16\u00b0C"},"temp_extremes":{"min_offset":{"value":0,"formatted":"0\u00b0C"},"max_offset":{"value":28,"formatted":"28\u00b0C"}},"downlink_rssi":{"value":-131,"unit":"dBm","formatted":"-131 dBm"},"digital_1":{"state":{"input_state":{"value":0,"formatted":"open"},"operational_mode":{"value":0,"formatted":"pulse_mode"},"alert_state":{"value":0},"medium_type":{"value":4,"formatted":"L_gas"},"device_serial_sent":{"value":0}},"counter":{"value":1700,"unit":"L_gas","formatted":"1700 L_gas"}},"digital_2":{"state":{"input_state":{"value":0,"formatted":"open"},"operational_mode":{"value":1,"formatted":"trigger_mode"},"alert_state":{"value":0},"medium_type":{"value":1,"formatted":"pulses"},"device_serial_sent":{"value":0}},"counter":{"value":0,"unit":"pulses","formatted":"0 pulses"}},"hex":"036610e08340a40600001200000000"}' ],

    'OIR f25 (usage_packet - ssi)' => [ 'request' =>
        [ 'data' => 'ERAAAAAAAQ/WVoQ/04aEPz0KuUEdQLpB', 'fport' => '25', 'serial' => '4c1608e5' ],
        'results' => '{"packet_type":"usage_packet","reported_interfaces":{"digital_1":{"value":1,"formatted":"sent"},"digital_2":{"value":0,"formatted":"not_sent"},"analog_1":{"value":0,"formatted":"not_sent"},"analog_2":{"value":0,"formatted":"not_sent"},"ssi":{"value":1,"formatted":"sent"},"mbus":{"value":0,"formatted":"not_sent"}},"digital_1":{"state":{"input_state":{"value":0,"formatted":"open"},"operational_mode":{"value":0,"formatted":"pulse_mode"},"alert_state":{"value":0},"medium_type":{"value":1,"formatted":"pulses"}},"counter":{"value":0,"unit":"pulses","formatted":"0 pulses"}},"ssi":{"general":{"ssi_index":{"value":1}},"reported_parameters":{"channel_1_instant":{"value":1,"formatted":"reported"},"channel_1_average":{"value":1,"formatted":"reported"},"channel_2_instant":{"value":1,"formatted":"reported"},"channel_2_average":{"value":1,"formatted":"reported"},"channel_3_instant":{"value":0,"formatted":"not reported"},"channel_3_average":{"value":0,"formatted":"not reported"},"channel_4_instant":{"value":0,"formatted":"not reported"},"channel_4_average":{"value":0,"formatted":"not reported"}},"channel_1_instant":{"value":1.0339000225067138671875,"unit":"bar","formatted":"1.034 bar"},"channel_1_average":{"value":1.03536450862884521484375,"unit":"bar","formatted":"1.035 bar"},"channel_2_instant":{"value":23.1299991607666015625,"unit":"\u00b0C","formatted":"23.130 \u00b0C"},"channel_2_average":{"value":23.2813053131103515625,"unit":"\u00b0C","formatted":"23.281 \u00b0C"}},"hex":"111000000000010fd656843fd386843f3d0ab9411d40ba41"}' ],

    'OIR f25 (usage_packet - mbus)' => [ 'request' =>
        [ 'data' => 'IxAAAAAAEAAAAAAADBZhdQEA', 'fport' => '25', 'serial' => '4D110007' ],
        'results' => '{"packet_type":"usage_packet","reported_interfaces":{"digital_1":{"value":1,"formatted":"sent"},"digital_2":{"value":1,"formatted":"sent"},"analog_1":{"value":0,"formatted":"not_sent"},"analog_2":{"value":0,"formatted":"not_sent"},"ssi":{"value":0,"formatted":"not_sent"},"mbus":{"value":1,"formatted":"sent"}},"digital_1":{"state":{"input_state":{"value":0,"formatted":"open"},"operational_mode":{"value":0,"formatted":"pulse_mode"},"alert_state":{"value":0},"medium_type":{"value":1,"formatted":"pulses"}},"counter":{"value":0,"unit":"pulses","formatted":"0 pulses"}},"digital_2":{"state":{"input_state":{"value":0,"formatted":"open"},"operational_mode":{"value":0,"formatted":"pulse_mode"},"alert_state":{"value":0},"medium_type":{"value":1,"formatted":"pulses"}},"counter":{"value":0,"unit":"pulses","formatted":"0 pulses"}},"mbus":{"state":{"last_status":{"value":0,"formatted":"ok"}},"data_records":{"1":{"_function":"instant value","value_type":"volume","unit":" m\u00b3","_exp":0,"_encoding":"8 digit BCD","_header_raw":"0c16","_data_raw":"61750100","value":17561}}},"hex":"2310000000001000000000000c1661750100"}' ],

    'OIR f53 (mbus_connect_packet)' => [ 'request' =>
        [ 'data' => 'AcA0E5cj1iVAB8QAAAAMeAwW', 'fport' => '53', 'serial' => '4D110007' ],
        'results' => '{"packet_type":"mbus_connect_packet","interface":"01","header":{"packet_number":{"value":0},"more_to_follow":{"value":0},"fixed_data_header":{"value":"1","formatted":"sent"},"data_record_headers_only":{"value":"1","formatted":"headers only"}},"mbus_fixed_header":{"id":"23971334","manufacturer":"INV","version":64,"medium":"water","access_number":196,"status":0,"signature":0},"record_headers":{"1":{"_function":"instant value","value_type":"fabrication number","_encoding":"8 digit BCD","_header_raw":"0c78"},"2":{"_function":"instant value","value_type":"volume","unit":" m\u00b3","_exp":0,"_encoding":"8 digit BCD","_header_raw":"0c16"}},"hex":"01c034139723d6254007c40000000c780c16"}' ],


    'OIR f49 (general_config_response)' => [ 'request' =>
        [ 'data' => 'ADwAoAUAIxMAEwA0E5cjByEMFgwWDHg=', 'fport' => '49', 'serial' => '4D110007' ],
        'results' => '{"packet_type":"general_config_response","usage_interval":{"value":60,"unit":"minutes","formatted":"60 minutes"},"status_interval":{"value":1440,"unit":"minutes","formatted":"1440 minutes"},"usage_behaviour":{"send_always":{"value":"0","formatted":"only_when_fresh_data"}},"configured_interfaces":{"digital_1":{"value":"1","formatted":"sent"},"digital_2":{"value":"1","formatted":"sent"},"analog_1":{"value":"0","formatted":"not_sent"},"analog_2":{"value":"0","formatted":"not_sent"},"ssi":{"value":"0","formatted":"not_sent"},"mbus":{"value":"1","formatted":"sent"}},"digital_1":{"configured_parameters":{"interface_enabled":{"value":"1","formatted":"enabled"},"mode":{"value":"1","formatted":"sent"},"multiplier":{"value":"0","formatted":"not_sent"},"true_reading":{"value":"0","formatted":"not_sent"},"medium_type":{"value":"01","formatted":"pulses"}},"mode":{"operational_mode":{"value":"0","formatted":"pulse_mode"},"trigger_time":{"value":"00","formatted":"1_sec"}}},"digital_2":{"configured_parameters":{"interface_enabled":{"value":"1","formatted":"enabled"},"mode":{"value":"1","formatted":"sent"},"multiplier":{"value":"0","formatted":"not_sent"},"true_reading":{"value":"0","formatted":"not_sent"},"medium_type":{"value":"01","formatted":"pulses"}},"mode":{"operational_mode":{"value":"0","formatted":"pulse_mode"},"trigger_time":{"value":"00","formatted":"1_sec"}}},"mbus":{"mbus_device_serial":{"value":"23971334","unit":""},"configured_parameters":{"interface_enabled":{"value":"1","formatted":"enabled"},"data_records_in_usage":{"value":"1","formatted":"configured"},"data_records_in_status":{"value":"1","formatted":"configured"}},"data_records_for_packets":{"count_in_usage":{"value":1},"count_in_status":{"value":2}},"records":{"usage":[{"_function":"instant value","value_type":"volume","unit":" m\u00b3","_exp":0,"_encoding":"8 digit BCD","_header_raw":"0c16"}],"status":[{"_function":"instant value","value_type":"volume","unit":" m\u00b3","_exp":0,"_encoding":"8 digit BCD","_header_raw":"0c16"},{"_function":"instant value","value_type":"fabrication number","_encoding":"8 digit BCD","_header_raw":"0c78"}]}},"hex":"003c00a0050023130013003413972307210c160c160c78"}' ],

    'OIR f49 (general_config_response) fw0.8.4' => [ 'request' =>
        [ 'data' => 'AQ9dAgoAAgBOYbwARDMiEQFDZneImQUBTwAAkEAzMxNBBQNPZmYGQJqZWUA=', 'fport' => '49', 'serial' => '4D110007', 'firmware' => '0.8.4' ],
        'results' => '{"packet_type":"general_config_response","configured_interfaces":{"digital_1":{"value":"1","formatted":"sent"},"digital_2":{"value":"1","formatted":"sent"},"analog_1":{"value":"1","formatted":"sent"},"analog_2":{"value":"1","formatted":"sent"},"ssi":{"value":"0","formatted":"not_sent"},"mbus":{"value":"0","formatted":"not_sent"}},"digital_1":{"configured_parameters":{"interface_enabled":{"value":1,"formatted":"enabled"},"multiplier":{"value":1,"formatted":"sent"},"true_reading":{"value":1,"formatted":"sent"},"medium_type":{"value":5,"formatted":"Wh_heat"}},"mode":{"operational_mode":{"value":0,"formatted":"pulse_mode"},"set_device_serial":{"value":1,"formatted":"yes"},"trigger_time":{"value":0,"formatted":"1_sec"}},"multiplier":{"value":10,"unit":"","formatted":"10 "},"divider":{"value":2,"unit":"","formatted":"2 "},"true_reading":{"value":12345678,"unit":"Wh_heat","formatted":"12345678 Wh_heat"},"device_serial":"11223344"},"digital_2":{"configured_parameters":{"interface_enabled":{"value":1,"formatted":"enabled"},"multiplier":{"value":0,"formatted":"not_sent"},"true_reading":{"value":0,"formatted":"not_sent"},"medium_type":{"value":0,"formatted":"other"}},"mode":{"operational_mode":{"value":1,"formatted":"trigger_mode"},"set_device_serial":{"value":1,"formatted":"yes"},"trigger_time":{"value":1,"formatted":"10_sec"}},"device_serial":"99887766"},"analog_1":{"configured_parameters":{"interface_enabled":{"value":1,"formatted":"enabled"},"reporting":{"value":1,"formatted":"sent"}},"general":{"sampling_rate":{"value":"1","formatted":"1_sec"},"input_mode":{"value":"0","formatted":"V"}},"reporting":{"alert_enabled":{"value":1,"formatted":"enabled"},"alert_limiting_thresholds":{"value":1,"formatted":"sent"},"instant_value_in_usage":{"value":1,"formatted":"report"},"average_value_in_usage":{"value":1,"formatted":"report"},"alert_triggered_after":{"value":1}},"alert_low_threshold":{"value":4.5,"unit":"V","formatted":"4.50 V"},"alert_high_threshold":{"value":9.19999980926513671875,"unit":"V","formatted":"9.20 V"}},"analog_2":{"configured_parameters":{"interface_enabled":{"value":1,"formatted":"enabled"},"reporting":{"value":1,"formatted":"sent"}},"general":{"sampling_rate":{"value":"1","formatted":"1_sec"},"input_mode":{"value":"1","formatted":"mA"}},"reporting":{"alert_enabled":{"value":1,"formatted":"enabled"},"alert_limiting_thresholds":{"value":1,"formatted":"sent"},"instant_value_in_usage":{"value":1,"formatted":"report"},"average_value_in_usage":{"value":1,"formatted":"report"},"alert_triggered_after":{"value":1}},"alert_low_threshold":{"value":2.099999904632568359375,"unit":"mA","formatted":"2.10 mA"},"alert_high_threshold":{"value":3.400000095367431640625,"unit":"mA","formatted":"3.40 mA"}},"hex":"010f5d020a0002004e61bc004433221101436677889905014f000090403333134105034f666606409a995940"}' ],

    'OIR f49 (reporting_config_respons) fw0.8.0' => [ 'request' =>
        [ 'data' => 'AAc8ANACAQ==', 'fport' => '49', 'serial' => '4d98005b', 'firmware' => '0.8.0' ],
        'results' => '{"packet_type":"reporting_config_response","configured_parameters":{"usage_interval":{"value":"1","formatted":"sent"},"status_interval":{"value":"1","formatted":"sent"},"usage_behaviour":{"value":"1","formatted":"sent"}},"usage_interval":{"value":60,"unit":"minutes","formatted":"60 minutes"},"status_interval":{"value":720,"unit":"minutes","formatted":"720 minutes"},"usage_behaviour":{"send_always":{"value":"1","formatted":"always"}},"hex":"00073c00d00201"}' ],

    'OIR f49 (general_config_response) fw0.8.3' => [ 'request' =>
        [ 'data' => 'AQ8tAAIAAwB4VjQSAAUABAUABA==', 'fport' => '49', 'serial' => '4d98005b', 'firmware' => '0.8.3' ],
        'results' => '{"packet_type":"general_config_response","configured_interfaces":{"digital_1":{"value":"1","formatted":"sent"},"digital_2":{"value":"1","formatted":"sent"},"analog_1":{"value":"1","formatted":"sent"},"analog_2":{"value":"1","formatted":"sent"},"ssi":{"value":"0","formatted":"not_sent"},"mbus":{"value":"0","formatted":"not_sent"}},"digital_1":{"configured_parameters":{"interface_enabled":{"value":1,"formatted":"enabled"},"multiplier":{"value":1,"formatted":"sent"},"true_reading":{"value":1,"formatted":"sent"},"medium_type":{"value":2,"formatted":"L_water"}},"mode":{"operational_mode":{"value":0,"formatted":"pulse_mode"},"set_device_serial":{"value":0,"formatted":"no"},"trigger_time":{"value":0,"formatted":"1_sec"}},"multiplier":{"value":2,"unit":"","formatted":"2 "},"divider":{"value":3,"unit":"","formatted":"3 "},"true_reading":{"value":305419896,"unit":"L_water","formatted":"305419896 L_water"}},"digital_2":{"configured_parameters":{"interface_enabled":{"value":0,"formatted":"disabled"},"multiplier":{"value":0,"formatted":"not_sent"},"true_reading":{"value":0,"formatted":"not_sent"},"medium_type":{"value":0,"formatted":"other"}}},"analog_1":{"configured_parameters":{"interface_enabled":{"value":1,"formatted":"enabled"},"reporting":{"value":1,"formatted":"sent"}},"general":{"sampling_rate":{"value":"0","formatted":"1_min"},"input_mode":{"value":"0","formatted":"V"}},"reporting":{"alert_enabled":{"value":0,"formatted":"disabled"},"alert_limiting_thresholds":{"value":0,"formatted":"not_sent"},"instant_value_in_usage":{"value":1,"formatted":"report"},"average_value_in_usage":{"value":0,"formatted":"do_not_report "},"alert_triggered_after":{"value":0}}},"analog_2":{"configured_parameters":{"interface_enabled":{"value":1,"formatted":"enabled"},"reporting":{"value":1,"formatted":"sent"}},"general":{"sampling_rate":{"value":"0","formatted":"1_min"},"input_mode":{"value":"0","formatted":"V"}},"reporting":{"alert_enabled":{"value":0,"formatted":"disabled"},"alert_limiting_thresholds":{"value":0,"formatted":"not_sent"},"instant_value_in_usage":{"value":1,"formatted":"report"},"average_value_in_usage":{"value":0,"formatted":"do_not_report "},"alert_triggered_after":{"value":0}}},"hex":"010f2d00020003007856341200050004050004"}' ],

    'OIR f49 (general_config_response - ssi) fw0.8.3' => [ 'request' =>
        [ 'data' => 'ARMALQIBAAEADgAAAHhWNBINBU/NzEw/AACAP08AALBBAADIQQ==', 'fport' => '49', 'serial' => '4d98005b', 'firmware' => '0.8.3' ],
        'results' => '{"packet_type":"general_config_response","configured_interfaces":{"digital_1":{"value":"1","formatted":"sent"},"digital_2":{"value":"1","formatted":"sent"},"analog_1":{"value":"0","formatted":"not_sent"},"analog_2":{"value":"0","formatted":"not_sent"},"ssi":{"value":"1","formatted":"sent"},"mbus":{"value":"0","formatted":"not_sent"}},"digital_1":{"configured_parameters":{"interface_enabled":{"value":0,"formatted":"disabled"},"multiplier":{"value":0,"formatted":"not_sent"},"true_reading":{"value":0,"formatted":"not_sent"},"medium_type":{"value":0,"formatted":"other"}}},"digital_2":{"configured_parameters":{"interface_enabled":{"value":1,"formatted":"enabled"},"multiplier":{"value":1,"formatted":"sent"},"true_reading":{"value":1,"formatted":"sent"},"medium_type":{"value":2,"formatted":"L_water"}},"mode":{"operational_mode":{"value":0,"formatted":"pulse_mode"},"set_device_serial":{"value":1,"formatted":"yes"},"trigger_time":{"value":0,"formatted":"1_sec"}},"multiplier":{"value":1,"unit":"","formatted":"1 "},"divider":{"value":1,"unit":"","formatted":"1 "},"true_reading":{"value":14,"unit":"L_water","formatted":"14 L_water"},"device_serial":"12345678"},"ssi":{"configured_parameters":{"interface_enabled":{"value":1,"formatted":"enabled"},"channel_1":{"value":1,"formatted":"sent"},"channel_2":{"value":1,"formatted":"sent"},"channel_3":{"value":0,"formatted":"not_sent"},"channel_4":{"value":0,"formatted":"not_sent"}},"general":{"sampling_rate":{"value":1,"formatted":"fast"}}},"channel_1":{"reporting":{"alert_enabled":{"value":1,"formatted":"enabled"},"alert_thresholds":{"value":1,"formatted":"sent"},"instant_value_in_usage":{"value":1,"formatted":"reported"},"average_value_in_usage":{"value":1,"formatted":"reported"},"alert_triggered_after":{"value":1}},"alert_low_threshold":{"value":0.800000011920928955078125,"unit":"","formatted":"0.80 "},"alert_high_threshold":{"value":1,"unit":"","formatted":"1.00 "}},"channel_2":{"reporting":{"alert_enabled":{"value":1,"formatted":"enabled"},"alert_thresholds":{"value":1,"formatted":"sent"},"instant_value_in_usage":{"value":1,"formatted":"reported"},"average_value_in_usage":{"value":1,"formatted":"reported"},"alert_triggered_after":{"value":1}},"alert_low_threshold":{"value":22,"unit":"","formatted":"22.00 "},"alert_high_threshold":{"value":25,"unit":"","formatted":"25.00 "}},"hex":"0113002d02010001000e000000785634120d054fcdcc4c3f0000803f4f0000b0410000c841"}' ],
    
    'OIR f49 (general_config_response_analog) fw0.8.7' => [ 'request' =>
        [ 'data' => 'AQ89AgEAAQAwQasA776t3gFBAAA=', 'fport' => '49', 'serial' => '4d98005b', 'firmware' => '0.8.3' ],
        'results' => '{"packet_type":"general_config_response","configured_interfaces":{"digital_1":{"value":"1","formatted":"sent"},"digital_2":{"value":"1","formatted":"sent"},"analog_1":{"value":"1","formatted":"sent"},"analog_2":{"value":"1","formatted":"sent"},"ssi":{"value":"0","formatted":"not_sent"},"mbus":{"value":"0","formatted":"not_sent"}},"digital_1":{"configured_parameters":{"interface_enabled":{"value":1,"formatted":"enabled"},"multiplier":{"value":1,"formatted":"sent"},"true_reading":{"value":1,"formatted":"sent"},"medium_type":{"value":3,"formatted":"Wh_electricity"}},"mode":{"operational_mode":{"value":0,"formatted":"pulse_mode"},"set_device_serial":{"value":1,"formatted":"yes"},"trigger_time":{"value":0,"formatted":"1_sec"}},"multiplier":{"value":1,"unit":"","formatted":"1 "},"divider":{"value":1,"unit":"","formatted":"1 "},"true_reading":{"value":11223344,"unit":"Wh_electricity","formatted":"11223344 Wh_electricity"},"device_serial":"deadbeef"},"digital_2":{"configured_parameters":{"interface_enabled":{"value":1,"formatted":"enabled"},"multiplier":{"value":0,"formatted":"not_sent"},"true_reading":{"value":0,"formatted":"not_sent"},"medium_type":{"value":0,"formatted":"other"}},"mode":{"operational_mode":{"value":1,"formatted":"trigger_mode"},"set_device_serial":{"value":0,"formatted":"no"},"trigger_time":{"value":1,"formatted":"10_sec"}}},"analog_1":{"configured_parameters":{"interface_enabled":{"value":0,"formatted":"disabled"},"reporting":{"value":0,"formatted":"not_sent"}}},"analog_2":{"configured_parameters":{"interface_enabled":{"value":0,"formatted":"disabled"},"reporting":{"value":0,"formatted":"not_sent"}}},"hex":"010f3d02010001003041ab00efbeadde01410000"}' ],

    'OIR f49 (mbus_config_response)fw0.8' => [ 'request' =>
        [ 'data' => 'BA+IAglpMQwGC1oLYgwG', 'fport' => '49', 'serial' => '4d98005b', 'firmware' => '0.8.0' ],
        'results' => '{"packet_type":"mbus_config_response","configured_parameters":{"interface_enabled":{"value":1,"formatted":"enabled"},"data_records_in_usage":{"value":1,"formatted":"enabled"},"data_records_in_status":{"value":1,"formatted":"enabled"},"mbus_device_serial_sent":{"value":1,"formatted":"sent"}},"mbus_device_serial":"69090288","data_records_for_packets":{"count_in_usage":{"value":1},"count_in_status":{"value":3}},"records":{"usage":[{"_function":"instant value","value_type":"energy","unit":" Wh","_exp":3,"_encoding":"8 digit BCD","_header_raw":"0c06"}],"status":[{"_function":"instant value","value_type":"flow temperature","unit":"\u00b0C","_exp":-1,"_encoding":"6 digit BCD","_header_raw":"0b5a"},{"_function":"instant value","value_type":"temperature difference","unit":"\u00b0C","_exp":-1,"_encoding":"6 digit BCD","_header_raw":"0b62"},{"_function":"instant value","value_type":"energy","unit":" Wh","_exp":3,"_encoding":"8 digit BCD","_header_raw":"0c06"}]},"hex":"040f88020969310c060b5a0b620c06"}' ],

    'OIR f53 (mbus_connected_packet)fw0.8' => [ 'request' =>
        [ 'data' => 'BMCIAglppzIHBAEAAAAJdAlwDAYMFAstCzsLWgteC2IMeIkQcTwiDCIMJoyQEAabEC2bEDubEFqbEF6UEK1vlBC7b5QQ2m+UEN5vTAZMFHwiTCbMkBAG2xAt2xA72xBa2xBehI8PbQRt', 'fport' => '53', 'serial' => '4d98005b', 'firmware' => '0.8.0' ],
        'results' => '{"packet_type":"mbus_connect_packet","interface":"04","header":{"packet_number":{"value":0},"more_to_follow":{"value":0},"fixed_data_header":{"value":1,"formatted":"sent"},"data_record_headers_only":{"value":1,"formatted":"headers only"}},"mbus_fixed_header":{"id":"69090288","manufacturer":"LUG","version":7,"medium":"heat","access_number":1,"status":0,"signature":0},"record_headers":{"1":{"_function":"instant value","value_type":"actuality duration (in seconds)","unit":" s","_encoding":"2 digit BCD","_header_raw":"0974"},"2":{"_function":"instant value","value_type":"averaging duration (in seconds)","unit":" s","_encoding":"2 digit BCD","_header_raw":"0970"},"3":{"_function":"instant value","value_type":"energy","unit":" Wh","_exp":3,"_encoding":"8 digit BCD","_header_raw":"0c06"},"4":{"_function":"instant value","value_type":"volume","unit":" m\u00b3","_exp":-2,"_encoding":"8 digit BCD","_header_raw":"0c14"},"5":{"_function":"instant value","value_type":"power","unit":" W","_exp":2,"_encoding":"6 digit BCD","_header_raw":"0b2d"},"6":{"_function":"instant value","value_type":"volume flow","unit":" m\u00b3\/h","_exp":-3,"_encoding":"6 digit BCD","_header_raw":"0b3b"},"7":{"_function":"instant value","value_type":"flow temperature","unit":"\u00b0C","_exp":-1,"_encoding":"6 digit BCD","_header_raw":"0b5a"},"8":{"_function":"instant value","value_type":"return temperature","unit":"\u00b0C","_exp":-1,"_encoding":"6 digit BCD","_header_raw":"0b5e"},"9":{"_function":"instant value","value_type":"temperature difference","unit":"\u00b0C","_exp":-1,"_encoding":"6 digit BCD","_header_raw":"0b62"},"10":{"_function":"instant value","value_type":"fabrication number","_encoding":"8 digit BCD","_header_raw":"0c78"},"11":{"_tariff":1,"_function":"instant value","value_type":"averaging duration (in minutes)","unit":" min","_encoding":"2 digit BCD","_header_raw":"891071"},"12":{"_function":"value during error state","value_type":"(during error) operating time (in hours)","unit":" h","_encoding":"8 digit BCD","_header_raw":"3c22"},"13":{"_function":"instant value","value_type":"operating time (in hours)","unit":" h","_encoding":"8 digit BCD","_header_raw":"0c22"},"14":{"_function":"instant value","value_type":"on time (in hours)","unit":" h","_encoding":"8 digit BCD","_header_raw":"0c26"},"15":{"_tariff":5,"_function":"instant value","value_type":"energy","unit":" Wh","_exp":3,"_encoding":"8 digit BCD","_header_raw":"8c901006"},"16":{"_tariff":1,"_function":"maximum value","value_type":"(maximum) power","unit":" W","_exp":2,"_encoding":"6 digit BCD","_header_raw":"9b102d"},"17":{"_tariff":1,"_function":"maximum value","value_type":"(maximum) volume flow","unit":" m\u00b3\/h","_exp":-3,"_encoding":"6 digit BCD","_header_raw":"9b103b"},"18":{"_tariff":1,"_function":"maximum value","value_type":"(maximum) flow temperature","unit":"\u00b0C","_exp":-1,"_encoding":"6 digit BCD","_header_raw":"9b105a"},"19":{"_tariff":1,"_function":"maximum value","value_type":"(maximum) return temperature","unit":"\u00b0C","_exp":-1,"_encoding":"6 digit BCD","_header_raw":"9b105e"},"20":{"_tariff":1,"_function":"maximum value","value_type":"(maximum) power","unit":" W","_exp":2,"_encoding":"32 bit integer","_header_raw":"9410ad6f"},"21":{"_tariff":1,"_function":"maximum value","value_type":"(maximum) volume flow","unit":" m\u00b3\/h","_exp":-3,"_encoding":"32 bit integer","_header_raw":"9410bb6f"},"22":{"_tariff":1,"_function":"maximum value","value_type":"(maximum) flow temperature","unit":"\u00b0C","_exp":-1,"_encoding":"32 bit integer","_header_raw":"9410da6f"},"23":{"_tariff":1,"_function":"maximum value","value_type":"(maximum) return temperature","unit":"\u00b0C","_exp":-1,"_encoding":"32 bit integer","_header_raw":"9410de6f"},"24":{"storage_num":1,"_function":"instant value","value_type":"energy","unit":" Wh","_exp":3,"_encoding":"8 digit BCD","_header_raw":"4c06"},"25":{"storage_num":1,"_function":"instant value","value_type":"volume","unit":" m\u00b3","_exp":-2,"_encoding":"8 digit BCD","_header_raw":"4c14"},"26":{"storage_num":1,"_function":"value during error state","value_type":"(during error) operating time (in hours)","unit":" h","_encoding":"8 digit BCD","_header_raw":"7c22"},"27":{"storage_num":1,"_function":"instant value","value_type":"on time (in hours)","unit":" h","_encoding":"8 digit BCD","_header_raw":"4c26"},"28":{"storage_num":1,"_tariff":5,"_function":"instant value","value_type":"energy","unit":" Wh","_exp":3,"_encoding":"8 digit BCD","_header_raw":"cc901006"},"29":{"storage_num":1,"_tariff":1,"_function":"maximum value","value_type":"(maximum) power","unit":" W","_exp":2,"_encoding":"6 digit BCD","_header_raw":"db102d"},"30":{"storage_num":1,"_tariff":1,"_function":"maximum value","value_type":"(maximum) volume flow","unit":" m\u00b3\/h","_exp":-3,"_encoding":"6 digit BCD","_header_raw":"db103b"},"31":{"storage_num":1,"_tariff":1,"_function":"maximum value","value_type":"(maximum) flow temperature","unit":"\u00b0C","_exp":-1,"_encoding":"6 digit BCD","_header_raw":"db105a"},"32":{"storage_num":1,"_tariff":1,"_function":"maximum value","value_type":"(maximum) return temperature","unit":"\u00b0C","_exp":-1,"_encoding":"6 digit BCD","_header_raw":"db105e"},"33":{"storage_num":510,"_tariff":0,"_function":"instant value","value_type":"time point (time & date)","_encoding":"32 bit integer","_header_raw":"848f0f6d"},"34":{"_function":"instant value","value_type":"time point (time & date)","_encoding":"32 bit integer","_header_raw":"046d"}},"hex":"04c088020969a732070401000000097409700c060c140b2d0b3b0b5a0b5e0b620c788910713c220c220c268c9010069b102d9b103b9b105a9b105e9410ad6f9410bb6f9410da6f9410de6f4c064c147c224c26cc901006db102ddb103bdb105adb105e848f0f6d046d"}' ],

    #OIR TX PACKETS

    /*'OIR f50 TX(reporting_config_packet)(only usage)fw0.8' => [ 'request' =>
        [ 'data' => 'AAEKAA==', 'fport' => '50', 'serial' => '4d98005b', 'firmware' => '0.8.0' ],
        'results' => '{"packet_type":"reporting_config_packet","configured_parameters":{"usage_interval":{"value":"1","formatted":"sent"},"usage_interval":{"value":10,"unit":"minutes","formatted":"10 minutes"}}}'],
    */
    /**
     *
     * MLM
     *
     */

    'MLM f24 (status_packet)' => [ 'request' =>
        [ 'data' => '7FEAAKUHAAAA', 'fport' => '24', 'serial' => '4C11004D' ],
        'results' => '{"packet_type":"status_packet","metering_data":{"value":20972,"unit":"L","formatted":"20972 L"},"battery":{"value":2.83,"unit":"V","formatted":"2.83 V","value_raw":165},"temperature":{"value":7,"unit":"\u00b0C","formatted":"7\u00b0C"},"rssi":{"value":0,"unit":"dBm","formatted":"0 dBm"},"mode":"00000000","alerts":"00000000","hex":"ec510000a507000000"}' ],

    'MLM f99 (boot_packet)' => [ 'request' =>
        [ 'data' => 'AE0CEUwABgECBAB5AGUBAAAAAA==', 'fport' => '99', 'serial' => '4C11004D' ],
        'results' => '{"packet_type":"boot_packet","device_serial":"4c11024d","firmware_version":"0.6.1","reset_reason":["watchdog_reset"],"calibration_debug ":"0400790065010000","hex":"004d02114c0006010204007900650100000000"}' ],

    'MLM f99 (shutdown_packet)' => [ 'request' =>
        [ 'data' => 'ATGbAAAAxxcAAAA=', 'fport' => '99', 'serial' => '4C11004D' ],
        'results' => '{"packet_type":"shutdown_packet","shutdown_reason":{"value":"31","unit":"","formatted":"magnet_shutdown"},"metering_data":{"value":155,"unit":"L","formatted":"155 L"},"battery":{"value":2.966,"unit":"V","formatted":"2.966 V","value_raw":199},"temperature":{"value":23,"unit":"\u00b0C","formatted":"23\u00b0C"},"rssi":{"value":0,"unit":"dBm","formatted":"0 dBm"},"mode":"00000000","alerts":"00000000","hex":"01319b000000c717000000"}' ],


    /**
     *
     * KLM
     *
     */

    'KLM f99 (boot_packet)' => [ 'request' =>
        [ 'data' => 'ABMAHk0ACAKrG8UEAHetAAA2AQAYGBQAGwIAAAEwZQlc', 'fport' => '99', 'serial' => '4D1E0013' ],
        'results' => '{"packet_type":"boot_packet","device_serial":"4d1e0013","firmware_version":"0.8.2","kamstrup_meter_id":{"value":80026539,"unit":"","formatted":"80026539 "},"kamstrup_config_a":"00ad7700","kamstrup_config_b":"14181800013600","kamstrup_type":"00021b00","device_mode":"00000000","clock":{"value":157626369,"unit":"","formatted":"157626369 "},"hex":"0013001e4d000802ab1bc5040077ad0000360100181814001b020000013065095c"}' ],


    'KLM f24 (status_packet) fw0.8.2' => [ 'request' =>
        [ 'data' => 'dwv1VVz/AAIAAAAADQAAAAATAHiTRRcK18dBGKRwx0EbzMxMPR4AAAAAIAAAAAA=', 'fport' => '24', 'serial' => '4D1E0013', 'firmware' => '0.8.2' ],
        'results' => '{"packet_type":"status_packet","measuring_time":{"value":"19:50","unit":"UTC","formatted":"19:50 UTC","value_raw":119},"clock":{"value":"02.02.2019 19:52:43","unit":"UTC","formatted":"02.02.2019 19:52:43 UTC","value_raw":1549137163},"battery":{"value":"no battery info","unit":"V","formatted":"no battery info V","value_raw":255},"rssi":{"value":0,"unit":"dBm","formatted":"0 dBm"},"register":[{"register_id":{"value":"2","unit":"kWh","formatted":"E1","description":"Energy register 1: Heat energy","value_formatter":"%.3f %s"},"register_value":{"value":0,"unit":"kWh","formatted":"0.000 kWh"}},{"register_id":{"value":"13","unit":"m3","formatted":"V1","description":"Volume register V1","value_formatter":"%.3f %s"},"register_value":{"value":0,"unit":"m3","formatted":"0.000 m3"}},{"register_id":{"value":"19","unit":"","formatted":"HR","description":"Operational hour counter","value_formatter":"%d"},"register_value":{"value":4719,"unit":"","formatted":"4719"}},{"register_id":{"value":"23","unit":"\u00b0C","formatted":"T1","description":"Current flow temperature","value_formatter":"%.2f %s"},"register_value":{"value":24.979999542236328125,"unit":"\u00b0C","formatted":"24.98 \u00b0C"}},{"register_id":{"value":"24","unit":"\u00b0C","formatted":"T2","description":"Current return flow temperature","value_formatter":"%.2f %s"},"register_value":{"value":24.93000030517578125,"unit":"\u00b0C","formatted":"24.93 \u00b0C"}},{"register_id":{"value":"27","unit":"\u00b0C","formatted":"T1-T2","description":"Current temperature difference","value_formatter":"%.2f %s"},"register_value":{"value":0.04999999701976776123046875,"unit":"\u00b0C","formatted":"0.05 \u00b0C"}},{"register_id":{"value":"30","unit":"l\/h","formatted":"FLOW1","description":"Current flow in flow","value_formatter":"%.2f %s"},"register_value":{"value":0,"unit":"l\/h","formatted":"0.00 l\/h"}},{"register_id":{"value":"32","unit":"kW","formatted":"EFFEKT1 (POWER)","description":"Current power calculated on the basis of V1-T1-T2","value_formatter":"%.3f %s"},"register_value":{"value":0,"unit":"kW","formatted":"0.000 kW"}}],"hex":"770bf5555cff0002000000000d000000001300789345170ad7c74118a470c7411bcccc4c3d1e000000002000000000"}' ],

    'KLM f25 (usage_packet) fw0.8.2' => [ 'request' =>
        [ 'data' => 'AP8Ne7TLQwIBsDpFEwDwpEUX4Xo1Qhh7FBxCHgBAD0QgMzODQBYAAAAAHAAAAAA=', 'fport' => '25', 'serial' => '4D1E0013', 'firmware' => '0.8.2' ],
        'results' => '{"packet_type":"usage_packet","header":"00","measuring_time":{"value":"Live","unit":"UTC","formatted":"Live","value_raw":255},"register":[{"register_id":{"value":"13","unit":"m3","formatted":"V1","description":"Volume register V1","value_formatter":"%.3f %s"},"register_value":{"value":407.410003662109375,"unit":"m3","formatted":"407.410 m3"}},{"register_id":{"value":"2","unit":"kWh","formatted":"E1","description":"Energy register 1: Heat energy","value_formatter":"%.3f %s"},"register_value":{"value":2987.000244140625,"unit":"kWh","formatted":"2987.000 kWh"}},{"register_id":{"value":"19","unit":"","formatted":"HR","description":"Operational hour counter","value_formatter":"%d"},"register_value":{"value":5278,"unit":"","formatted":"5278"}},{"register_id":{"value":"23","unit":"\u00b0C","formatted":"T1","description":"Current flow temperature","value_formatter":"%.2f %s"},"register_value":{"value":45.369998931884765625,"unit":"\u00b0C","formatted":"45.37 \u00b0C"}},{"register_id":{"value":"24","unit":"\u00b0C","formatted":"T2","description":"Current return flow temperature","value_formatter":"%.2f %s"},"register_value":{"value":39.020000457763671875,"unit":"\u00b0C","formatted":"39.02 \u00b0C"}},{"register_id":{"value":"30","unit":"l\/h","formatted":"FLOW1","description":"Current flow in flow","value_formatter":"%.2f %s"},"register_value":{"value":573,"unit":"l\/h","formatted":"573.00 l\/h"}},{"register_id":{"value":"32","unit":"kW","formatted":"EFFEKT1 (POWER)","description":"Current power calculated on the basis of V1-T1-T2","value_formatter":"%.3f %s"},"register_value":{"value":4.099999904632568359375,"unit":"kW","formatted":"4.100 kW"}},{"register_id":{"value":"22","unit":"","formatted":"INFO","description":"Infocode register, current","value_formatter":"%d"},"register_value":{"value":0,"unit":"","formatted":"0"}},{"register_id":{"value":"28","unit":"Bar","formatted":"P1","description":"Pressure in flow","value_formatter":"%.2f %s"},"register_value":{"value":0,"unit":"Bar","formatted":"0.00 Bar"}}],"hex":"00ff0d7bb4cb430201b03a451300f0a44517e17a3542187b141c421e00400f44203333834016000000001c00000000"}' ],
    /*'KLM f24 (usage_packet) fw0.5.2' => [ 'request' =>
        [ 'data' => 'eg8AAAAADAAAAAARzdrNRwYAAAAAHwAAAAAaCtcjPAGA2DlIMwAAlkI1AAAAAA==', 'fport' => '24', 'serial' => '4D1E0013', 'firmware' => '0.5.2' ],
        'results' => '{}' ],*/

    'KLM f25 (usage_packet) fw0.5.2' => [ 'request' =>
        [ 'data' => 'AA0azc9HAuFCZ0UTAH4MRxd7lKRCGM3MQkIeAMDARSCaGW5DFgAAAAAcAAAAAA==', 'fport' => '25', 'serial' => '4D1E0013', 'firmware' => '0.5.2' ],
        'results' => '{"packet_type":"usage_packet","header":"00","register":[{"register_id":{"value":"13","unit":"m3","formatted":"V1","description":"Volume register V1","value_formatter":"%.3f %s"},"register_value":{"value":106394.203125,"unit":"m3","formatted":"106394.203 m3"}},{"register_id":{"value":"2","unit":"kWh","formatted":"E1","description":"Energy register 1: Heat energy","value_formatter":"%.3f %s"},"register_value":{"value":3700.179931640625,"unit":"kWh","formatted":"3700.180 kWh"}},{"register_id":{"value":"19","unit":"","formatted":"HR","description":"Operational hour counter","value_formatter":"%d"},"register_value":{"value":35966,"unit":"","formatted":"35966"}},{"register_id":{"value":"23","unit":"\u00b0C","formatted":"T1","description":"Current flow temperature","value_formatter":"%.2f %s"},"register_value":{"value":82.29000091552734375,"unit":"\u00b0C","formatted":"82.29 \u00b0C"}},{"register_id":{"value":"24","unit":"\u00b0C","formatted":"T2","description":"Current return flow temperature","value_formatter":"%.2f %s"},"register_value":{"value":48.700000762939453125,"unit":"\u00b0C","formatted":"48.70 \u00b0C"}},{"register_id":{"value":"30","unit":"l\/h","formatted":"FLOW1","description":"Current flow in flow","value_formatter":"%.2f %s"},"register_value":{"value":6168,"unit":"l\/h","formatted":"6168.00 l\/h"}},{"register_id":{"value":"32","unit":"kW","formatted":"EFFEKT1 (POWER)","description":"Current power calculated on the basis of V1-T1-T2","value_formatter":"%.3f %s"},"register_value":{"value":238.100006103515625,"unit":"kW","formatted":"238.100 kW"}},{"register_id":{"value":"22","unit":"","formatted":"INFO","description":"Infocode register, current","value_formatter":"%d"},"register_value":{"value":0,"unit":"","formatted":"0"}},{"register_id":{"value":"28","unit":"Bar","formatted":"P1","description":"Pressure in flow","value_formatter":"%.2f %s"},"register_value":{"value":0,"unit":"Bar","formatted":"0.00 Bar"}}],"hex":"000d1acdcf4702e142674513007e0c47177b94a44218cdcc42421e00c0c045209a196e4316000000001c00000000"}' ],


    'KLM f25 (usage_packet) fw xx' => [ 'request' =>
        [ 'data' => 'AP8NhasSRgKnW09DEwDMP0YX9qiKQhh7FCVCHgCA/UMgZ2aCQRYAAAAAHAAAAAA=', 'fport' => '25', 'serial' => '4D1E0013', 'firmware' => '0.8.0' ],
        'results' => '{"packet_type":"usage_packet","header":"00","measuring_time":{"value":"Live","unit":"UTC","formatted":"Live","value_raw":255},"register":[{"register_id":{"value":"13","unit":"m3","formatted":"V1","description":"Volume register V1","value_formatter":"%.3f %s"},"register_value":{"value":9386.8798828125,"unit":"m3","formatted":"9386.880 m3"}},{"register_id":{"value":"2","unit":"kWh","formatted":"E1","description":"Energy register 1: Heat energy","value_formatter":"%.3f %s"},"register_value":{"value":207.3580169677734375,"unit":"kWh","formatted":"207.358 kWh"}},{"register_id":{"value":"19","unit":"","formatted":"HR","description":"Operational hour counter","value_formatter":"%d"},"register_value":{"value":12275,"unit":"","formatted":"12275"}},{"register_id":{"value":"23","unit":"\u00b0C","formatted":"T1","description":"Current flow temperature","value_formatter":"%.2f %s"},"register_value":{"value":69.3300018310546875,"unit":"\u00b0C","formatted":"69.33 \u00b0C"}},{"register_id":{"value":"24","unit":"\u00b0C","formatted":"T2","description":"Current return flow temperature","value_formatter":"%.2f %s"},"register_value":{"value":41.270000457763671875,"unit":"\u00b0C","formatted":"41.27 \u00b0C"}},{"register_id":{"value":"30","unit":"l\/h","formatted":"FLOW1","description":"Current flow in flow","value_formatter":"%.2f %s"},"register_value":{"value":507,"unit":"l\/h","formatted":"507.00 l\/h"}},{"register_id":{"value":"32","unit":"kW","formatted":"EFFEKT1 (POWER)","description":"Current power calculated on the basis of V1-T1-T2","value_formatter":"%.3f %s"},"register_value":{"value":16.3000011444091796875,"unit":"kW","formatted":"16.300 kW"}},{"register_id":{"value":"22","unit":"","formatted":"INFO","description":"Infocode register, current","value_formatter":"%d"},"register_value":{"value":0,"unit":"","formatted":"0"}},{"register_id":{"value":"28","unit":"Bar","formatted":"P1","description":"Pressure in flow","value_formatter":"%.2f %s"},"register_value":{"value":0,"unit":"Bar","formatted":"0.00 Bar"}}],"hex":"00ff0d85ab124602a75b4f431300cc3f4617f6a88a42187b1425421e0080fd43206766824116000000001c00000000"}' ],
    /**
     *
     * WMR
     *
     */

    'WMR f24 (status_packet)' => [ 'request' =>
        [ 'data' => 'vgAAADwOiUwA', 'fport' => '24', 'serial' => '35100076' ],
        'results' => '{"packet_type":"status_packet","metering_data":{"value":190,"unit":"L","formatted":"190 L"},"battery":{"value":2.902,"unit":"V","formatted":"2.902 V","value_raw":60},"temp":{"value":14,"unit":"C","formatted":"14 C"},"rssi":{"value":-137,"unit":"dBm","formatted":"-137 dBm"},"mode":"01001100","alerts":"00000000","hex":"be0000003c0e894c00"}' ],


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
        'results' => '{"packet_type":"boot_packet","device_serial":"4b92009d","firmware_version":"0.4.0","card_count":{"value":17408,"unit":"","formatted":"17408 "},"switch_direction":"98","hex":"009d00924b000400004498393816030000"}' ],


    /**
     *
     * LWM
     *
     */

    'LWM f24 (status_packet)' => [ 'request' =>
        [ 'data' => 'AQAAAPUPAAAACQAAfgeQB2MHqwdyB6YH', 'fport' => '24', 'serial' => '4c12002c' ],
        'results' => '{"packet_type":"status_packet","metering_data":{"value":1,"unit":"L","formatted":"1 L"},"battery":{"value":3.642,"unit":"V","formatted":"3.642 V","value_raw":245},"temperature":{"value":15,"unit":"\u00b0C","formatted":"15\u00b0C"},"rssi":{"value":0,"unit":"dBm","formatted":"0 dBm"},"mode":"00000000","alerts":"00000000","noise":{"value":9,"unit":"","formatted":"9 "},"accumulated_delta":{"value":0,"unit":"","formatted":"0 "},"dec":[{"value":1918,"unit":"","formatted":"1918 "},{"value":1936,"unit":"","formatted":"1936 "}],"afe_1":{"min":{"value":1891,"unit":"","formatted":"1891 "},"max":{"value":1963,"unit":"","formatted":"1963 "}},"afe_2":{"min":{"value":1906,"unit":"","formatted":"1906 "},"max":{"value":1958,"unit":"","formatted":"1958 "}},"hex":"01000000f50f0000000900007e0790076307ab077207a607"}' ],


    'LWM f24 (status_packet - first)' => [ 'request' =>
        [ 'data' => '/////98SAAAABAAA/////wEHBwf/////', 'fport' => '24', 'serial' => '4c12002c' ],
        'results' => '{"packet_type":"status_packet","metering_data":{"value":4294967295,"unit":"L","formatted":"n\/a"},"battery":{"value":3.554,"unit":"V","formatted":"3.554 V","value_raw":223},"temperature":{"value":18,"unit":"\u00b0C","formatted":"18\u00b0C"},"rssi":{"value":0,"unit":"dBm","formatted":"0 dBm"},"mode":"00000000","alerts":"00000000","noise":{"value":4,"unit":"","formatted":"4 "},"accumulated_delta":{"value":0,"unit":"","formatted":"0 "},"dec":[{"value":65535,"unit":"","formatted":"65535 "},{"value":65535,"unit":"","formatted":"65535 "}],"afe_1":{"min":{"value":1793,"unit":"","formatted":"1793 "},"max":{"value":1799,"unit":"","formatted":"1799 "}},"afe_2":{"min":{"value":65535,"unit":"","formatted":"65535 "},"max":{"value":65535,"unit":"","formatted":"65535 "}},"hex":"ffffffffdf12000000040000ffffffff01070707ffffffff"}' ],

    'LWM f24 (status_packet - 0.2.27)' => [ 'request' =>
        [ 'data' => 'HFcAAHITsRAAkQbDBwAA8Ab3BwAAoQa4BwAA3wbwBwAAAAoABwEAAAA=', 'fport' => '24', 'serial' => '4c12002c', 'firmware' => '0.2.27' ],
        'results' => '{"packet_type":"status_packet","metering_data":{"value":22300,"unit":"L","formatted":"22300 L"},"battery":{"value":3.117999999999999882760448599583469331264495849609375,"unit":"V","formatted":"3.118 V","value_raw":114},"temperature":{"value":19,"unit":"\u00b0C","formatted":"19\u00b0C"},"rssi":{"value":-79,"unit":"dBm","formatted":"-79 dBm"},"mode":"00010000","alerts":"00000000","afe_1_min":{"ch1":{"value":1681,"unit":"","formatted":"1681 "},"ch2":{"value":1987,"unit":"","formatted":"1987 "},"ch3":{"value":0,"unit":"","formatted":"0 "}},"afe_1_max":{"ch1":{"value":1776,"unit":"","formatted":"1776 "},"ch2":{"value":2039,"unit":"","formatted":"2039 "},"ch3":{"value":0,"unit":"","formatted":"0 "}},"afe_2_min":{"ch1":{"value":1697,"unit":"","formatted":"1697 "},"ch2":{"value":1976,"unit":"","formatted":"1976 "},"ch3":{"value":0,"unit":"","formatted":"0 "}},"afe_2_max":{"ch1":{"value":1759,"unit":"","formatted":"1759 "},"ch2":{"value":2032,"unit":"","formatted":"2032 "},"ch3":{"value":0,"unit":"","formatted":"0 "}},"recalib_delta":{"ch1":{"value":0,"unit":"","formatted":"0 "},"ch2":{"value":10,"unit":"","formatted":"10 "},"ch3":{"value":0,"unit":"","formatted":"0 "}},"initial_noise":{"ch1":{"value":7,"unit":"","formatted":"7 "},"ch2":{"value":1,"unit":"","formatted":"1 "},"ch3":{"value":0,"unit":"","formatted":"0 "}},"error_count":{"value":0,"unit":"","formatted":"0 "},"hex":"1c5700007213b110009106c3070000f006f7070000a106b8070000df06f0070000000a000701000000"}' ],


    'LWM f99 (shutdown_packet)' => [ 'request' =>
        [ 'data' => 'ATEZAAAA6xEAAAAIAACTB6MHiwerB5IHsgc=', 'fport' => '99', 'serial' => '4c12002c' ],
        'results' => '{"packet_type":"shutdown_packet","shutdown_reason":{"value":"31","unit":"","formatted":"magnet_shutdown"},"metering_data":{"value":25,"unit":"L","formatted":"25 L"},"battery":{"value":3.602,"unit":"V","formatted":"3.602 V","value_raw":235},"temperature":{"value":17,"unit":"\u00b0C","formatted":"17\u00b0C"},"rssi":{"value":0,"unit":"dBm","formatted":"0 dBm"},"mode":"00000000","alerts":"00000000","noise":{"value":8,"unit":"","formatted":"8 "},"accumulated_delta":{"value":0,"unit":"","formatted":"0 "},"dec":[{"value":1939,"unit":"","formatted":"1939 "},{"value":1955,"unit":"","formatted":"1955 "}],"afe_1":{"min":{"value":1931,"unit":"","formatted":"1931 "},"max":{"value":1963,"unit":"","formatted":"1963 "}},"afe_2":{"min":{"value":1938,"unit":"","formatted":"1938 "},"max":{"value":1970,"unit":"","formatted":"1970 "}},"hex":"013119000000eb110000000800009307a3078b07ab079207b207"}' ],

    'LWM f99 (boot_packet)' => [ 'request' =>
        [ 'data' => 'ACwAEkwAAQgQAAAAAAAAAAAAAA==', 'fport' => '99', 'serial' => '4c12002c' ],
        'results' => '{"packet_type":"boot_packet","device_serial":"4c12002c","firmware_version":"0.1.8","reset_reason":["magnet_wakeup"],"calibration_debug ":"0000000000000000","hex":"002c00124c0001081000000000000000000000"}' ],
    // LWM 3.0 ******************************************************************************'

    'LWM f99 (shutdown_packet)3.0' => [ 'request' =>
        [ 'data' => 'ATMBEABkgBIArgcDAAAAAAAA', 'fport' => '99', 'serial' => '4c12002c', 'firmware' => '1.0.0' ],
        'results' => '{"packet_type":"shutdown_packet","shutdown_reason":{"value":"33","unit":"","formatted":"app_shutdown"},"secondary_packet_type":"status_packet","general":{"fixed_metering":{"value":0,"formatted":"disabled"},"previous_counter":{"value":0,"formatted":"not_sent"},"debug_info":{"value":1,"formatted":"sent"},"packet_reason_app":{"value":0,"formatted":"false"},"packet_reason_magnet":{"value":0,"formatted":"false"},"packet_reason_alert":{"value":0,"formatted":"false"}},"active_alerts":{"reverse_flow_detected":{"value":0,"formatted":"false"},"burst":{"value":0,"formatted":"false"},"leak":{"value":0,"formatted":"false"},"tamper":{"value":0,"formatted":"false"},"temperature_alert":{"value":0,"formatted":"false"},"battery":{"value":0,"formatted":"false"}},"battery_percentage":{"value":39.370078740157481433925568126142024993896484375,"unit":"%","formatted":"39.4%"},"battery_voltage":{"value":3.173999999999999932498440102790482342243194580078125,"unit":"V","formatted":"3.174 V","value_raw":128},"mcu_temperature":{"value":18,"unit":"\u00b0C","formatted":"18\u00b0C"},"temp_extremes":{"min_offset":{"value":0,"formatted":"0\u00b0C"},"max_offset":{"value":0,"formatted":"0\u00b0C"}},"downlink_rssi":{"value":-174,"unit":"dBm","formatted":"-174 dBm"},"downlink_snr":{"value":7,"unit":"dB","formatted":"7 dB"},"instant_counter":{"value":3,"unit":"L","formatted":"3 L"},"calibration_delta":{"ch_1":{"value":0,"unit":"","formatted":"0 "},"ch_2":{"value":0,"unit":"","formatted":"0 "},"ch_3":{"value":0,"unit":"","formatted":"0 "}},"hex":"013301100064801200ae0703000000000000"}' ],
    
    'LWM f99 (boot_packet)3.0' => [ 'request' =>
        [ 'data' => 'AJYAgkwAAjqAAAECAAAAAA==', 'fport' => '99', 'serial' => '4c12002c', 'firmware' => '1.0.0' ],
        'results' => '{"packet_type":"boot_packet","device_serial":"4c820096","firmware_version":"0.2.58","reset_reason":["nfc_wakeup"],"general_info ":{"configuration_restored":{"value":0,"formatted":"false"}},"hardware_config ":{"value":"01","unit":"","formatted":"Cyble"},"sensor_fw_version":{"value":2,"unit":""},"uptime":{"value":0,"unit":"hours","formatted":"0 hours"},"hex":"009600824c00023a8000010200000000"}' ],

    
    'LWM f24 (status)3.0' => [ 'request' =>
        [ 'data' => 'ATAA/1ESAK8HAwAAAAAAAA==', 'fport' => '24', 'serial' => '4c12002c', 'firmware' => '1.0.0' ],
        'results' => '{"packet_type":"status_packet","general":{"fixed_metering":{"value":0,"formatted":"disabled"},"previous_counter":{"value":0,"formatted":"not_sent"},"debug_info":{"value":1,"formatted":"sent"},"packet_reason_app":{"value":1,"formatted":"true"},"packet_reason_magnet":{"value":0,"formatted":"false"},"packet_reason_alert":{"value":0,"formatted":"false"}},"active_alerts":{"reverse_flow_detected":{"value":0,"formatted":"false"},"burst":{"value":0,"formatted":"false"},"leak":{"value":0,"formatted":"false"},"tamper":{"value":0,"formatted":"false"},"temperature_alert":{"value":0,"formatted":"false"},"battery":{"value":0,"formatted":"false"}},"battery_percentage":{"value":"255","unit":"%","formatted":"not_available"},"battery_voltage":{"value":2.98599999999999976552089719916693866252899169921875,"unit":"V","formatted":"2.986 V","value_raw":81},"mcu_temperature":{"value":18,"unit":"\u00b0C","formatted":"18\u00b0C"},"temp_extremes":{"min_offset":{"value":0,"formatted":"0\u00b0C"},"max_offset":{"value":0,"formatted":"0\u00b0C"}},"downlink_rssi":{"value":-175,"unit":"dBm","formatted":"-175 dBm"},"downlink_snr":{"value":7,"unit":"dB","formatted":"7 dB"},"instant_counter":{"value":3,"unit":"L","formatted":"3 L"},"calibration_delta":{"ch_1":{"value":0,"unit":"","formatted":"0 "},"ch_2":{"value":0,"unit":"","formatted":"0 "},"ch_3":{"value":0,"unit":"","formatted":"0 "}},"hex":"013000ff511200af0703000000000000"}' ],

    'LWM f25 (usage)3.0' => [ 'request' =>
        [ 'data' => 'AQBtXwYA', 'fport' => '25', 'serial' => '4c12002c', 'firmware' => '1.0.0' ],
        'results' => '{"packet_type":"usage_packet","general":{"fixed_metering":{"value":0,"formatted":"disabled"},"counters_previous":{"value":0,"formatted":"not_sent"},"usage_detected":{"value":0,"formatted":"false"}},"counter":{"value":417645,"unit":"L","formatted":"417645 L"},"hex":"01006d5f0600"}' ],

    'LWM f50 (reporting_conf_packet)3.0' => [ 'request' =>
        [ 'data' => 'AA9oAXgAAQE=', 'fport' => '50', 'serial' => '4c12002c', 'firmware' => '1.0.0' ],
        'results' => '{"packet_type":"reporting_config_packet","configured_parameters":{"usage_interval":{"value":"1","formatted":"configured"},"status_interval":{"value":"1","formatted":"configured"},"behaviour":{"value":"1","formatted":"configured"},"fixed_measuring_interval":{"value":"1","formatted":"configured"}},"usage_interval":{"value":360,"unit":"minutes","formatted":"360 minutes"},"status_interval":{"value":120,"unit":"minutes","formatted":"120 minutes"},"behaviour":{"send_usage":{"value":"1","formatted":"always"},"include_previous_usage":{"value":"0","formatted":"false"}},"fixed_measuring_interval":{"interval":{"value":1,"formatted":"hourly"}},"hex":"000f680178000101"}' ],

    'LWM f50 (metering_config_packet)3.0' => [ 'request' =>
        [ 'data' => 'BRJA4gEA776t3g==', 'fport' => '50', 'serial' => '4c12002c', 'firmware' => '1.0.0' ],
        'results' => '{"packet_type":"metering_config_packet","configured_parameters":{"general_config":{"value":"0","formatted":"not_configured"},"absolute_reading":{"value":"1","formatted":"configured"},"offset":{"value":"0","formatted":"not_configured"},"permanent_flow":{"value":"0","formatted":"not_configured"},"meter_serial":{"value":"1","formatted":"configured"}},"absolute_reading":{"value":123456,"unit":"L","formatted":"123456 L"},"meter_serial":"deadbeef","hex":"051240e20100efbeadde"}' ],

    'LWM f50 (meta_eic_config_packet)3.0' => [ 'request' =>
        [ 'data' => 'EQMLZWljMV9vbl9zZWULZWljMl9vbl90b28=', 'fport' => '50', 'serial' => '4c12002c', 'firmware' => '1.0.0' ],
        'results' => '{"packet_type":"meta_eic_config_packet","configured_parameters":{"eic_1":{"value":1,"formatted":"sent"},"eic_2":{"value":1,"formatted":"sent"}},"id_costumer":"eic1_on_see","id_location":"eic2_on_too","hex":"11030b656963315f6f6e5f7365650b656963325f6f6e5f746f6f"}' ],

    'LWM f50 (meta_pos_config_packet)3.0' => [ 'request' =>
        [ 'data' => 'EANF3WsjGgCzDhZWYWJhw7VodW11dXNldW1pIHRlZSAx', 'fport' => '50', 'serial' => '4c12002c', 'firmware' => '1.0.0' ],
        'results' => '{"packet_type":"meta_pos_config_packet","configured_parameters":{"gps_position":{"value":1,"formatted":"configured"},"address":{"value":1,"formatted":"configured"}},"latitude":{"value":59.4271557000000001380612957291305065155029296875,"unit":"","formatted":"59.4271557 "},"longitude":{"value":24.6611994000000009918949217535555362701416015625,"unit":"","formatted":"24.6611994 "},"address":"Vaba\u00f5humuuseumi tee 1","hex":"100345dd6b231a00b30e1656616261c3b568756d75757365756d69207465652031"}' ],

    'LWM f60 (request_calibration_data)3.0' => [ 'request' =>
        [ 'data' => 'AgECAJIGcgbyBr4GugYjB50GfQbzBsIGvgYlBwAAABEJCQ4A', 'fport' => '60', 'serial' => '4c12002c', 'firmware' => '1.0.0' ],
        'results' => '{"packet_type":"request_calibration_data","sensor_type":{"value":"1","unit":"","formatted":"inductive_sensor"},"fw_version":{"value":2,"unit":"","formatted":"2 "},"afe_1_min":{"ch_1":{"value":1682,"unit":"","formatted":"1682 "},"ch_2":{"value":1650,"unit":"","formatted":"1650 "},"ch_3":{"value":1778,"unit":"","formatted":"1778 "}},"afe_1_max":{"ch_1":{"value":1726,"unit":"","formatted":"1726 "},"ch_2":{"value":1722,"unit":"","formatted":"1722 "},"ch_3":{"value":1827,"unit":"","formatted":"1827 "}},"afe_2_min":{"ch_1":{"value":1693,"unit":"","formatted":"1693 "},"ch_2":{"value":1661,"unit":"","formatted":"1661 "},"ch_3":{"value":1779,"unit":"","formatted":"1779 "}},"afe_2_max":{"ch_1":{"value":1730,"unit":"","formatted":"1730 "},"ch_2":{"value":1726,"unit":"","formatted":"1726 "},"ch_3":{"value":1829,"unit":"","formatted":"1829 "}},"recalib_delta":{"ch_1":{"value":0,"unit":"","formatted":"0 "},"ch_2":{"value":0,"unit":"","formatted":"0 "},"ch_3":{"value":0,"unit":"","formatted":"0 "}},"initial_noise":{"ch_1":{"value":17,"unit":"","formatted":"17 "},"ch_2":{"value":9,"unit":"","formatted":"9 "},"ch_3":{"value":9,"unit":"","formatted":"9 "}},"communication_error_count":{"value":14,"unit":"","formatted":"14 "},"hex":"0201020092067206f206be06ba0623079d067d06f306c206be0625070000001109090e00"}' ],


    /**
     *
     * WMB
     *
     */

    'WMB f24 (wmbus-meter)' => [ 'request' =>
        [ 'data' => 'HkQzOIuWAyABB3rPABAl5NUcZ1x370nWOvq9GLqA7w==', 'fport' => '24', 'serial' => '509b0001' ],
        'results' => '{"wm_bus":{"length":{"value":30,"unit":"","formatted":"30 "},"c_field":"44","man_id":{"value":"NAS","unit":"","formatted":"NAS Instruments O\u00dc (NAS)","value_raw":"3833"},"serial":"2003968b","version":"01","type":"07","payload":"7acf001025e4d51c675c77ef49d63afabd18ba80ef"},"hex":"1e4433388b96032001077acf001025e4d51c675c77ef49d63afabd18ba80ef"}' ],


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
    foreach ($array as $k => $v) {
        if (is_array( $v )) {
            $array[ $k ] = correct_array( $v );
        } else {
            if (is_bool( $v )) {
                $array[ $k ] = ($v ? 'true' : 'false');
            }
            if (is_float( $v )) {
                $array[ $k ] = "$v";
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
    echo ' <button class="btn btn-sm btn-dark float-right ml-2" data-id="' . sha1( $type ) . '">Metering</button> ';
    echo ' <button class="btn btn-sm btn-primary float-right" data-id="' . sha1( $type ) . '">Results</button></td><tr>';
    echo '<tr style="display:none;" class="originals" data-id="' . sha1( $type ) . '"><td>';
    echo '<h6>CONVERTED: </h6>';
    echo '<pre>';
    print_r( correct_array( $got ) );
    echo '</pre>';
    echo '<code>JSON: ';
    echo json_encode( $got );
    echo '</code>';
    echo '</td><td>';
    echo '<h6>NEEDED:</h6> ';
    echo '<pre>';
    print_r( correct_array( $need ) );
    echo '</pre>';
    echo '<code>JSON: ';
    echo json_encode( $need );
    echo '</code>';
    echo '</td></tr>';


    echo '<tr style="display:none;" class="originals" data-id="' . sha1( $type ) . '-metering"><td>';
    echo '<h6>CONVERTED: </h6>';
    echo '<pre>';
    print_r( correct_array( $cv->toMetering( $got ) ) );
    echo '</pre>';
    echo '<code>JSON: ';
    echo json_encode( $cv->toMetering( $got ) );
    echo '</code>';
    echo '</td><td>';
    echo '<h6>NEEDED:</h6> ';
    echo '<pre>';
    print_r( correct_array( $cv->toMetering( $need ) ) );
    echo '</pre>';
    echo '<code>JSON: ';
    echo json_encode( $cv->toMetering( $need ) );
    echo '</code>';
    echo '</td></tr>';

    echo '<tr style="display:none;" class="originals" data-id="' . sha1( $type ) . '-library"><td colspan="2">';
    echo '<pre>';
    print_r( correct_array( $cv->call_library( $cv->product )->rx_fport()[ $cv->fport ] ) );
    echo '</pre>';
    echo '<code>';
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
        $('.btn-warning').click(function () {
            $('.originals[data-id="' + $(this).data('id') + '-library"]').toggle('fast');
        });
        $('table').width($(window).innerWidth());
        $('td').css('max-width', ($(window).innerWidth() / 2));
    })
</script>
</body>
</html>