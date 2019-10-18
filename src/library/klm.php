<?php

class klm
{

    public $nascv;

    public $register = '[
{"description":"","name":"RFU","unit":"","value":"0"},                        
{"description":"Current date (YY-MMDD)","name":"DATE","unit":"","value":"1", "value_formatter":"YYMM-DD","value_formatter":"%d"},                        
{"description":"Energy register 1: Heat energy","name":"E1","unit":"kWh","value":"2","value_formatter":"%.3f %s"},                        
{"description":"Energy register 2: Control energy","name":"E2","unit":"kWh","value":"3","value_formatter":"%.3f %s"},                        
{"description":"Energy register 3: Cooling energy","name":"E3","unit":"kWh","value":"4","value_formatter":"%.3f %s"},                        
{"description":"Energy register 4: Flow energy","name":"E4","unit":"kWh","value":"5","value_formatter":"%.3f %s"},                        
{"description":"Energy register 5: Return flow energy","name":"E5","unit":"kWh","value":"6","value_formatter":"%.3f %s"},                        
{"description":"Energy register 6: Tap water energy","name":"E6","unit":"kWh","value":"7","value_formatter":"%.3f %s"},                        
{"description":"Energy register 7: Heat energy Y","name":"E7","unit":"kWh","value":"8","value_formatter":"%.3f %s"},                        
{"description":"Energy register 8: [m3 • T1]","name":"E8","unit":"","value":"9","value_formatter":"%.3f %s"},                        
{"description":"Energy register 9: [m3 • T2]","name":"E9","unit":"","value":"10","value_formatter":"%.3f %s"},                        
{"description":"Tariff register 2","name":"TA2","unit":"","value":"11","value_formatter":"%.3f %s"},                        
{"description":"Tariff register 3","name":"TA3","unit":"","value":"12","value_formatter":"%.3f %s"},                        
{"description":"Volume register V1","name":"V1","unit":"m3","value":"13","value_formatter":"%.3f %s"},                        
{"description":"Volume register V2","name":"V2","unit":"m3","value":"14","value_formatter":"%.3f %s"},                        
{"description":"Input register VA","name":"VA","unit":"","value":"15","value_formatter":"%d"},                        
{"description":"Input register VB","name":"VB","unit":"","value":"16","value_formatter":"%d"},                        
{"description":"Mass register V1","name":"M1","unit":"ton","value":"17","value_formatter":"%.3f %s"},                        
{"description":"Mass register V2","name":"M2","unit":"ton","value":"18","value_formatter":"%.3f %s"},                        
{"description":"Operational hour counter","name":"HR","unit":"","value":"19","value_formatter":"%d"},                        
{"description":"Info-event counter","name":"INFOEV","unit":"","value":"20","value_formatter":" %d"},                        
{"description":"Current time (hhmmss)","name":"CLOCK","unit":"","value":"21","value_formatter": "%d"},                        
{"description":"Infocode register, current","name":"INFO","unit":"","value":"22","value_formatter":"%d" },                        
{"description":"Current flow temperature","name":"T1","unit":"°C","value":"23","value_formatter": "%.2f %s"},                        
{"description":"Current return flow temperature","name":"T2","unit":"°C","value":"24","value_formatter": "%.2f %s"},                        
{"description":"Current temperature T3","name":"T3","unit":"°C","value":"25","value_formatter":"%.2f %s"},                        
{"description":"Current temperature T4","name":"T4","unit":"°C","value":"26","value_formatter":"%.2f %s"},                        
{"description":"Current temperature difference","name":"T1-T2","unit":"°C","value":"27","value_formatter":"%.2f %s"},                        
{"description":"Pressure in flow","name":"P1","unit":"Bar","value":"28","value_formatter":"%.2f %s"},                        
{"description":"Pressure in return flow","name":"P2","unit":"Bar","value":"29","value_formatter":"%.2f %s"},                        
{"description":"Current flow in flow","name":"FLOW1","unit":"l/h","value":"30","value_formatter":"%.2f %s"},                        
{"description":"Current flow in return flow","name":"FLOW2","unit":"l/h","value":"31","value_formatter":"%. 2f %s"},                        
{"description":"Current power calculated on the basis of V1-T1-T2","name":"EFFEKT1 (POWER)","unit":"kW","value":"32","value_formatter":"%.3f %s"},                        
{"description":"Date for max. this year","name":"MAXFLOW1DATE/Y","unit":"l/h","value":"33","value_f ormatter":"%.2f %s"},                        
{"description":"Max. value this year","name":"MAXFLOW1/Y","unit":"l/h","value":"34","value_format ter":"%.2f %s"},                        
{"description":"Date for min. this year","name":"MINFLOW1DATE/Y","unit":"l/h","value":"35","value_f ormatter":"%.2f %s"},                        
{"description":"Min. value this year","name":"MINFLOW1/Y","unit":"l/h","value":"36","value_formatt er":"%.2f %s"},                        
{"description":"Date for max. this year","name":"MAXEFFEKT1DATE/Y","unit":"kW","value":"37","valu e_formatter":"%.3f %s"},                        
{"description":"Max. value this year","name":"MAXEFFEKT1/Y","unit":"kW","value":"38","value_for matter":"%.3f %s"},                        
{"description":"Date for min. this year","name":"MINEFFEKT1DATE/Y","unit":"kW","value":"39","valu e_formatter":"%.3f %s"},                       
{"description":"Min. value this year","name":"MINEFFEKT1/Y","unit":"kW","value":"40","value_form atter":"%.3f %s"},                   
{"description":"Date for max. this year","name":"MAXFLOW1DATE/M","unit":"l/h","value":"41","value_ formatter":"%.2f %s"},                        
{"description":"Max. value this year","name":"MAXFLOW1/M","unit":"l/h","value":"42","value_format ter":"%.2f %s"},                        
{"description":"Date for min. this month","name":"MINFLOW1DATE/M","unit":"l/h","value":"43","value _formatter":"%.2f %s"},                        
{"description":"Min. value this month","name":"MINFLOW1/M","unit":"l/h","value":"44","value_form atter":"%.2f %s"},                        
{"description":"Date for max. this month","name":"MAXEFFEKT1DATE/M","unit":"kW","value":"45","v alue_formatter":"%.3f %s"},                        
{"description":"Max. value this month","name":"MAXEFFEKT1/M","unit":"kW","value":"46","value_f ormatter":"%.3f %s"},                        
{"description":"Date for min. this month","name":"MINEFFEKT1DATE/M","unit":"kW","value":"47","val ue_formatter":"%.3f %s"},                        
{"description":"Min. value this month","name":"MINEFFEKT1/M","unit":"kW","value":"48","value_fo rmatter":"%.3f %s"},                        
{"description":"Year-to-date average for T1","name":"AVR T1/Y","unit":"°C","value":"49","value_formatter":"%.2f %s"},                        
{"description":"Year-to-date average for T2","name":"AVR T2/Y","unit":"°C","value":"50","value_formatter":"%.2f %s"},                        
{"description":"Month-to-date average for T1","name":"AVR T1/M","unit":"°C","value":"51","value_formatter":"%.2f %s"},                        
{"description":"Month-to-date average for T2","name":"AVR T2/M","unit":"°C","value":"52","value_formatter":"%.2f %s"},                        
{"description":"Tariff limit 2","name":"TL2","unit":"","value":"53","value_formatter":"%d"},                        
{"description":"Tariff limit 3","name":"TL3","unit":"","value":"54","value_formatter":"%d"},                     
{"description":"Target date (reading date)","name":"XDAY","unit":"","value":"55","value_formatter":"%d"},                        
{"description":"Program no. ABCCCCCC","name":"PROG NO","unit":"","value":"56","value_formatter":"%d"},                        
{"description":"Config no. DDDEE","name":"CONFIG NO 1","unit":"","value":"57","value_formatter":"%d"},                        
{"description":"Config no. FFGGMN","name":"CONFIG NO 2","unit":"","value":"58","value_formatter":"%d"},                        
{"description":"Serial no. (unique number for each meter) (or custom. num)","name":"SERIAL NO","unit":"","value":"59","value_formatter":"%d"},                        
{"description":"Customer number (8 most important digits)","name":"METER NO 2","unit":"","value":"60","value_formatter":"%d"},                        
{"description":"Customer number (8 less important digits)","name":"METER NO 1","unit":"","value":"61","value_formatter":"%d"},                        
{"description":"Meter no. for VA","name":"METER NO VA","unit":"","value":"62","value_formatter":"%d"},                        
{"description":"Meter no. for VB","name":"METER NO VB","unit":"","value":"63","value_formatter":"%d"},                        
{"description":"Software edition","name":"METER TYPE","unit":"","value":"64","value_formatter":"%d"},                        
{"description":"Software check sum","name":"CHECK SUM 1","unit":"","value":"65","value_formatter":"%d"},                        
{"description":"High-resolution energy register for testing purposes","name":"HIGH RES","unit":"","value":"66","value_formatter":"%d"},                        
{"description":"ID number for top module ( only mc 601 )","name":"TOPMODUL ID","unit":"","value":"67","value_formatter":"%d"},                        
{"description":"ID number for base module","name":"BOTMODUL ID","unit":"","value":"68","value_formatter":"%d"},                        
{"description":"Error hour counter","name":"ERROR HOUR COUNTER","unit":"","value":"69","v alue_formatter":"%d"},                      
{"description":"Liter/imp value for input A","name":"Pulse value A1/A2","unit":"","value":"70","value_formatter":"%d"},                        
{"description":"Liter/imp value for input B","name":"Pulse value B1/B2","unit":"","value":"71","value_formatter":"%d"},                        
{"description":"","name":"E1-E2","unit":"kWh","value":"72","value_formatter":"%.3f %s"},                        
{"description":"High resolution measuring unit for heat energy 1","name":"QSUM1","unit":"kWh","value":"73","value_formatter":"%d "},                        
{"description":"High resolution measuring unit for heat energy 2","name":"QSUM2","unit":"kWh","value":"74","value_formatter":"%d "},                        
{"description":"-","name":"PRE COUNTER 1","unit":"","value":"75","value_formatter":"%d"},                        
{"description":"-","name":"PRE COUNTER 2","unit":"","value":"76","value_formatter":"%d"},                        
{"description":"-","name":"E_COLD","unit":"kWh","value":"77","value _formatter":"%.3f %s"},                        
{"description":"-","name":"M3TF","unit":"","value":"78","value_formatt er":"%d"},                        
{"description":"-","name":"M3TR","unit":"","value":"79","value_format ter":"%d"},                        
{"description":"-","name":"CALENDAR","unit":"","value":"80","value_f ormatter":"%d"},                        
{"description":"Peak power current period","name":"P POWER ACT","unit":"kW","value":"81","value_formatter":"%.3f %s"},                        
{"description":"Annual peak power","name":"P POWER YEAR","unit":"kW","value":"82","value_formatter":"%.3f %s"},                         
{"description":"-","name":"Date and time","unit":"","value":"83","value_formatter":"%d"},                       
{"description":"Energy register 10: [m3 • V1]","name":"Energy E10","unit":"m3","value":"84","value_formatter":"%.3f %s"},                         
{"description":"Energy register 11: [m3 • V2]","name":"Energy E11","unit":"m3","value":"85","value_formatter":"%.3f %s"},                         
{"description":"Differential energy","name":"Differential energy dE","unit":"kWh","value":"86","value_formatter":"%.3f %s"},                         
{"description":"Control energy","name":"Control Energy cE","unit":"kWh","value":"87","value_formatter":"%.3f %s"},                         
{"description":"Differential volume","name":"Differential volume dV","unit":"m3","value":"88","value_formatter":"%.3f %s"},                         
{"description":"Control volume","name":"Control volume cV","unit":"m3","value":"89","value_formatter":"%.3f %s"},                         
{"description":"Heat energy with discount","name":"Heat Energy A1","unit":"kWh","value":"90","value_formatter":"%.3f %s"},                         
{"description":"Heat energy with surcharge","name":"Heat Energy A2","unit":"kWh","value":"91","value_formatter":"%.3f %s"},                         
{"description":"Tariff register 4","name":"Tariff TA4","unit":"","value":"92","value_formatter":"%d"},                         
{"description":"Tariff limit 4","name":"Tariff limit TL4","unit":"","value":"93","value_formatter":"%d"},                         
{"description":"","name":"Pulse value V1","unit":"","value":"94","value_formatter":"%d"},                         
{"description":"","name":"Pulse value V2","unit":"","value":"95","value_formatter":"%d"},                         
{"description":"Permanent/approved nominal flow of V1","name":"Qp V1","unit":"m3/h","value":"96","value_formatter":"%.3f %s"},                         
{"description":"Permanent/approved nominal flow of V2","name":"Qp V2","unit":"m3/h","value":"97","value_formatter":"%.3f %s"},                         
{"description":"","name":"Pulse input A2","unit":"","value":"98","value_formatter":"%d"},                         
{"description":"","name":"Pulse input B2","unit":"","value":"99","value_formatter":"%d"},                  
{"description":"","name":"Meter No. input A2","unit":"","value":"100","value_formatter":"%d"},                         
{"description":"","name":"Meter No. input B2","unit":"","value":"101","value_formatter":"%d"},                         
{"description":"","name":"Info bits","unit":"","value":"102","value_formatter":"%d"},                         
{"description":"Value of max Flow V1 for the year","name":"Flow V1 max year time","unit":"l/h","value":"103","value_formatter":"%.3f %s"},                         
{"description":"Value of min Flow V1 for the year","name":"Flow V1 min year time","unit":"l/h","value":"104","value_formatter":"%.3f %s"},                         
{"description":"Value of max power for the year","name":"Power max year time","unit":"","value":"105","value_formatter":"%.3f %s"},                         
{"description":"Value for min. power for the year","name":"Power min year time","unit":"","value":"106","value_formatter":"%.3f %s"},                         
{"description":"Date stamp for max Flow V1 for the month","name":"Flow V1 max month time","unit":"","value":"107","value_formatter":"%.3f %s"},                         
{"description":"Date stamp for min. Flow V1 for the month","name":"Flow V1 min month time","unit":"","value":"108","value_formatter":"%.3f %s"},                         
{"description":"Date stamp for max power for the month","name":"Power max month time","unit":"","value":"109","value_formatter":"%.3f %s"},                         
{"description":"Date stamp for min. Power for the month","name":"Power min month time","unit":"","value":"110","value_formatter":"%.3f %s"},                         
{"description":"Max flow of day V1","name":"Flow V1 max day","unit":"l/h","value":"111","value_formatter":"%.3f %s"},                         
{"description":"Min flow of day V1","name":"Flow V1 min day","unit":"l/h","value":"112","value_formatter":"%.3f %s"},                         
{"description":"Coefficient Of Performance","name":"COP","unit":"","value":"113","value_formatter ":"%d"},                         
{"description":"","name":"COP average period","unit":"","value":"114","value_formatter":"%d"},                         
{"description":"Coefficient Of Performance, year","name":"COP year","unit":"","value":"115","value_formatter":"%d"},                         
{"description":"Coefficient Of Performance, month","name":"COP month","unit":"","value":"116","value_formatter":"%d"},                         
{"description":"Time average (day) of t1","name":"t1 time average day","unit":"","value":"117","value_formatter":"%.2f %s"},                         
{"description":"Time average (day) of t2","name":"t2 time average day","unit":"","value":"118","value_formatter":"%.2f %s"},                         
{"description":"Time average (day) of t3 ","name":"t3 time average day","unit":"","value":"119","value_formatter":"%.2f %s"},                         
{"description":"Time average (hour) of t1","name":"t1 time average hour","unit":"","value":"120","value_formatter":"%.2f %s"},                         
{"description":"Time average (hour) of t2","name":"t2 time average hour","unit":"","value":"121","value_formatter":"%.2f %s"},                         
{"description":"Time average (hour) of t2","name":"t3 time average hour","unit":"","value":"122","value_formatter":"%.2f %s"},                         
{"description":"Time averaged analog input (day) of P1","name":"P1 average day","unit":"","value":"123","value_formatter":"%.2f %s"},                         
{"description":"Time averaged analog input (day) of P2","name":"P2 average day","unit":"","value":"124","value_formatter":"%.2f %s"},                         
{"description":"Time averaged analog input (hour) of P1","name":"P1 average hour","unit":"","value":"125","value_formatter":"%.2f %s"},                         
{"description":"Time averaged analog input (hour) of P2","name":"P2 average hour","unit":"","value":"126","value_formatter":"%.2f %s"},                         
{"description":"Current value of t1","name":"t1 actual (1 decimal)","unit":"°C","value":"127","value_formatter":"%.1f %s"},                         
{"description":"Current value of t2","name":"t2 actual (1 decimal)","unit":"°C","value":"128","value_formatter":"%.1f %s"},                         
{"description":"Current differential value","name":"t1t2 diff. temp. (1 decimal)","unit":"°C","value":"129","value_formatter":"%.1f %s"},                         
{"description":"","name":"Power input B1","unit":"","value":"130","value_formatter":"%d"},                         
{"description":"Controlled pulse output C1/C2","name":"Controlled output C1/C2","unit":"","value":"131","value_formatter":"%d"},                         
{"description":"Controlled pulse output D1/D2","name":"Controller output D1/D2","unit":"","value":"132","value_formatter":"%d"},                         
{"description":"","name":"Theta HC","unit":"","value":"133","value_formatter":"%d"},                         
{"description":"","name":"Temperature offset","unit":"°C","value":"134","value_formatter":"%d"},                         
{"description":"","name":"t2 preset","unit":"°C","value":"135","value_formatter":"%.2f %s"},                         
{"description":"","name":"t5 limit","unit":"°C","value":"136","value_formatter":"%.2f %s"},                         
{"description":"","name":"QP average time","unit":"","value":"137","value_formatter":"%d"},                         
{"description":"","name":"Target date 1 year","unit":"","value":"138","value_formatter":"%d"},                         
{"description":"","name":"Target date 2 year","unit":"","value":"139","value_formatter":"%d"},                         
{"description":"","name":"Target date 1 month","unit":"","value":"140","value_formatter":"%d"},                         
{"description":"","name":"Target date 2 month","unit":"","value":"141","value_formatter":"%d"},                         
{"description":"","name":"Config No. 3","unit":"","value":"142","value_formatter":"%d"},                         
{"description":"","name":"Config No. 4","unit":"","value":"143","value_formatter":"%d"},                         
{"description":"","name":"Type No.","unit":"","value":"144","value_formatter":"%d"},                         
{"description":"","name":"DIN meter ID","unit":"","value":"145","value_formatter":"%d"},                         
{"description":"","name":"SW revision","unit":"","value":"146","value_formatter":"%d"},                         
{"description":"","name":"Base module 2 ID","unit":"","value":"147","value_formatter":"%d"},                 
{"description":"","name":"External module ID","unit":"","value":"148","value_formatter":"%d"},                         
{"description":"","name":"Bus pri. adr. module 1","unit":"","value":"149","value_formatter":"%d"},                         
{"description":"","name":"M-Bus sec. adr. module 1","unit":"","value":"150","value_formatter":"%d"},                         
{"description":"","name":"Bus pri. adr. module 2","unit":"","value":"151","value_formatter":"%d"},                         
{"description":"","name":"M-Bus sec. adr. module 2","unit":"","value":"152","value_formatter":"%d"},                         
{"description":"","name":"Bus pri. adr. ext. module","unit":"","value":"153","value_formatter":"%d"},                         
{"description":"","name":"M-Bus sec. adr. ext. module","unit":"","value":"154","value_formatter":"%d"},                         
{"description":"","name":"M-Bus pri. adr. internal","unit":"","value":"155","value_formatter":"%d"},                         
{"description":"","name":"M-Bus sec. adr. internal","unit":"","value":"156","value_formatter":"%d"},                         
{"description":"","name":"Config counter","unit":"","value":"157","value_formatter":"%d"},                         
{"description":"","name":"Time stamp 1 (yy.mm)","unit":"","value":"158","value_formatter":"%d"},                         
{"description":"","name":"Time stamp 1 (dd.hh)","unit":"","value":"159","value_formatter":"%d"},                         
{"description":"","name":"Type approval rev. heat","unit":"","value":"160","value_formatter":"%d"},                         
{"description":"","name":"Type approval rev. cooling","unit":"","value":"161","value_formatter":"%d"},                         
{"description":"","name":"Type approval rev. national","unit":"","value":"162","value_formatter":"%d"},                         
{"description":"","name":"E1 high res. auto int.","unit":"","value":"163","value_formatter":"%.3f %s"},                         
{"description":"","name":"E3 high res. auto int.","unit":"","value":"164","value_formatter":"%.3f %s"},                         
{"description":"","name":"V1 high res. auto int.","unit":"","value":"165","value_formatter":"%.3f %s"},                         
{"description":"","name":"t1 avg. auto int.","unit":"°C","value":"166","value_formatter":"%.2f %s"},                         
{"description":"","name":"t2 avg. auto int.","unit":"°C","value":"167","value_formatter":"%.2f %s"},                        
{"description":"","name":"A1 auto int.","unit":"","value":"168","value_formatter":"%d"},                         
{"description":"","name":"A2 auto int.","unit":"","value":"169","value_formatter":"%d"},                         
{"description":"","name":"E1 high res.","unit":"","value":"170","value_formatter":"%.3f %s"},                         
{"description":"","name":"E3 high res.","unit":"","value":"171","value_formatter":"%.3f %s"},                         
{"description":"","name":"V1 high res.","unit":"","value":"172","value_formatter":"%.3f %s"},                         
{"description":"","name":"V1 reverse","unit":"","value":"173","value_formatter":"%.3f %s"},                         
{"description":"","name":"Volume high res. TEST","unit":"","value":"174","value_formatter":"%.3f %s"},                         
{"description":"","name":"Optical eye lock","unit":"","value":"175","value_formatter":""},                         
{"description":"When this is sent, then queries will be emptied","name":"Disable all registers","unit":"If unit is none, then the register is not converted.","value":"255"}]';

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
                'register_id' => [ 'type' => 'uint8', 'formatter' => json_decode( $this->register, true ) ],
                'register_value' => [ 'type' => 'uint32', 'unit' => '{register_id>unit}', 'formatter' => '{register_id>value_formatter}' ],
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
                'register_id' => [ 'type' => 'uint8', 'formatter' => json_decode( $this->register, true ) ],
                'register_value' => [ 'type' => 'float', 'unit' => '{register_id>unit}', 'formatter' => '{register_id>value_formatter}' ],

            ];

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
                'register_id' => [ 'type' => 'uint8', 'formatter' => json_decode( $this->register, true ) ],
                'register_value' => [ 'type' => 'float', 'unit' => '{register_id>unit}', 'formatter' => '{register_id>value_formatter}' ],
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

?>