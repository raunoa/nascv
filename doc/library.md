
# NASCV Librarys
An overview of how the library structure is and how to use it
## Library logic example
example where library name is axi
```sh
<?php 
class axi {
	public $nascv;
	# structure by fport
	function rx_fport() {
		$struct = [); #start array

		# fport 24
		$struct[ 24 ] = [

			#packet type
			[ 'packet_type' => 'status_packet' ],
			
			#main
			[ '_cnf' => [ 'repeat' => false ],
				'volume' => [ 'type' => 'uint32', 'unit' => 'L' ],
				# etc ....
			)
		);
		
		# fport 25
		$struct[ 25 ] = [
			#...
		)
		return $struct;
	}
}
?>
```
## Parameter types
```sh
'volume' => [ 'type' => 'uint32', 'unit' => 'L' ],
```
| type | bytes | description |
|--|--|--|
| uint8 | 1 | integer |
| uint16 | 2 | integer |
| uint32 | 4 | integer |
| int8 | 1 | signed integer |
| int16 | 2 | signed integer |
| int32 | 4 | signed integer |
| float | 4 | float |
| hex | 1 | hexidecimal |
| byte | 1 | bits * |

> bits - look next article how to use that type of paramaters

If using hex and need to get more bytes with hex then need to write length with byte nr.
```sh	
'device_serial' => [ 'type' => 'hex', 'length' => 4 ],
```
## How to use byte type parameters
There is four ways how to use byte type parameters, three of them must have a bits parameter set:
```sh
'reset_reason' => [ 'type' => 'byte', 'bits' => [...)),
```
### 1. show 8 bits
```sh
'reset_reason' => [ 'type' => 'byte' ],
```
### 2. bits list - when specific bit is 1 then shows that name from array
```sh
'reset_reason' => [ 'type' => 'byte', 'bits' => [ 'holiday', 'mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'sun' ] ],
```
if bits are 00001010 then result will be:
```sh
[reset_reason] => Array (
	[0] => "mon"
	[1] => "wed"
)
```
### 3. Each bit has parameter  with formatted value
```sh
'status_field' => [ 'type' => 'byte', 'bits' =>
		[ 'dali_error_external' => [ 'ok', 'alert' ],
			   'dali_error_connection' => [ 'ok', 'alert' ],
	    	   'ldr_state' => [ 'off', 'on' ],
			   'thr_state' => [ 'off', 'on' ],
			   'dig_state' => [ 'off', 'on' ],
		       'hardware_error' => [ 'ok', 'error' ],
			   'software_error' => [ 'ok', 'error' ],
			   'relay_state' => [ 'off', 'on' ]
) ],
```
Results will be:
```sh
[status_field] => Array
                (
                    [dali_error_external] => Array
                        (
                            [value] => 0
                            [formatted] => ok
                        ]

                    [dali_error_connection] => Array
                        (
                            [value] => 0
                            [formatted] => ok
                        ]

                    [ldr_state] => Array
                        (
                            [value] => 0
                            [formatted] => off
                        ]

                    [thr_state] => Array
                        (
                            [value] => 0
                            [formatted] => off
                        ]

                    [dig_state] => Array
                        (
                            [value] => 0
                            [formatted] => off
                        ]

                    [hardware_error] => Array
                        (
                            [value] => 0
                            [formatted] => ok
                        ]

                    [software_error] => Array
                        (
                            [value] => 0
                            [formatted] => ok
                        ]

                    [relay_state] => Array
                        (
                            [value] => 0
                            [formatted] => off
                        ]
               ]
```
### 4. Can define bit and parameter with advanced formatted field
```sh
'settings' => [ 'type' => 'byte', 'bits' => [
						[ 'bit' => 0, 'parameter' => 'input_state', 'formatter' =>
							[ false, true ] ],
						[ 'bit' => 1, 'parameter' => 'operational_mode', 'formatter' =>
							[ 'counter', 'n/a' ] ],
						[ 'bit' => '4-7', 'parameter' => 'medium_type', 'type' => 'hex', 'formatter' => [
							[ 'value' => '04', 'name' => 'gas_L' ],
							[ 'value' => '?', 'name' => 'n/a' ] ] ]
					) ],
```
|variable|description|
|--|--|
|bit|can be integer or string where is possible to set specified range|
|parameter|parameter name|
|type|when is selected more then one bit then can set converting type|
|formatter|can define how to format that value|
**Types in bits**
 * hex
 * decimal
 
Upper example results will be:
```sh
[settings] => Array
                (
                    [input_state] => Array
                        (
                            [value] => 0
                            [formatted] => false
                        ]
                    [operational_mode] => Array
                        (
                            [value] => 0
                            [formatted] => counter
                        ]
                    [medium_type] => Array
                        (
                            [value] => 04
                            [formatted] => gas_L
                        ]
                ]
```
## Get unit from another paramater
	'true_reading' => [ 'type' => 'uint16', 'unit' => [ 'configured_parameters:medium_type' ] ]
true_reading is uint16 and unit comes from formatted (default) of **$data['configured_parameters']['medium_type']**

    'true_reading' => [ 'type' => 'uint16', 'unit' => [ 'configured_parameters:medium_type>value' ] ]
true_reading is uint16 and unit comes specified field: **$data['configured_parameters']['medium_type']['value']**

## Parameter converter
```sh
'frequency' => [ 'type' => 'uint16', 'unit' => 'Hz', 'converter' => '/1000' ],
```
In this example frequency (unit16) value will be divided by 1000
**Possible marks:**

| Mark | Example | Description |
|--|--|--|
| / | /1000 | divide |
| * | *-1 | multiply |
| - | -1 | minus |
| + | +1 | plus |

## Parameter formatter
Formatter use sprintf functions. first variable is value and second is unit.
by default is:
```sh
%s %s
```
**Example with float value**
```sh
'accumulated_energy' => [ 'type' => 'float', 'unit' => 'kWh', 'formatter' => '%.3f %s' ],
```
**Using battery function**
```sh
'battery' => [ 'type' => 'uint8', 'formatter' => ':battery' ],
```
battery function will set automatically unit to V and also move original value to new parameter **value_raw**.
Results will be:
```sh
[battery] => Array
        (
            [value] => 2.766
            [unit] => V
            [formatted] => 2.766 V
            [value_raw] => 149
        ]
```

**formatting unix timestamp**
```sh
'clock' => [ 'type' => 'uint32', 'unit' => 'UTC', 'formatter'=>':date(d.m.Y H:i:s)' ],
```
result will be
```sh
[clock] => Array
        (
            [value] => 01.02.2019 09:44:47
            [unit] => UTC
            [formatted] => 01.02.2019 09:44:47 UTC
            [value_raw] => 1549014287
        ]
```

**Manually defined formation**
This is important if some values means certain meanings. Like in the example below we want that if value is 255 then we show text "not_available" and other ways we divide value with /2.54 and formatting to float.
```sh
'battery_percentage' => [ 'type' => 'uint8', 'unit' => '%', 'formatter' => [
                        [ 'value' => '255', 'name' => 'not_available' ],
                        [ 'value' => '*', 'name' => '%.1f%s', 'converter' => '/2.54' ]
                    ] ],
```

## Change byte order MSB or LSB
to change byte order MSB (default is LSB) then is possible to write it to group (**_cnf**) or individual parameter using **byte_order**
**MSB for all parameters in group**
```sh
[ '_cnf' => [ 'repeat' => false, 'byte_order' => 'MSB' ],
				'battery' => [ 'type' => 'uint8', 'unit' => 'index', 'formatter' => ':battery' ],
				'temp' => [ 'type' => 'uint8', 'unit' => '°C' ],
				'rssi' => [ 'type' => 'uint8', 'unit' => 'dBm', 'converter' => '*-1' ],
)
```
**MSB for only one paramater**
```sh
'heat_energy' => [ 'type' => 'int32', 'unit' => 'kWh', 'byte_order' => 'MSB' ]
```
## How to use _cnf 
_cnf array is like group array and also this is main array where you write all parameters. Can make more groups inside group and also outside, but can't set parameters without group (**_cnf array**)

**Repeat** clouse is importent to use when this same group must be repeated until the hex ends:
```sh
[ '_cnf' => [ 'repeat' => true, 'name' => 'extension' ],
				'device_type' => [ 'type' => 'hex' ],
	)
```
When repeat is in use, then name is importent to set, then name is key of array of repeats. result example:
```sh
	[extension] => Array
        (
            [0] => Array
                ( ... ]
            [1] => Array 
                ( ... ]
         ]
```

### Group formatter
```sh
[ '_cnf' => [ 'repeat' => false, 'name' => 'firmware_version',
	'formatter' => '{firmware_version:major}.{firmware_version:minor}.{firmware_version:patch}' ],
	'major' => [ 'type' => 'uint8' ],
	'minor' => [ 'type' => 'uint8' ],
	'patch' => [ 'type' => 'uint8' ],
),
```
In this example formatter is used to but 3 different uint8 values together to make good looking firmware_version value. Results will be:
```sh	 
[firmware_version] => 0.7.31
```
If using formatter then name will be new paramater name. In the logical brackets is full path where this value comes. In that example is writed new parameter name **firmware_version** and in that parameter name like **major**, **minor** or **patch**

## When - when to show this group or parameter
Can use in individual parameter
```sh
'power' => [ 'type' => 'float', 'unit' => 'kW', 'when' => [ [ 'register_map:power' => 1 ] ] ],
```
Also can use in group
```sh
[ '_cnf' => [ 'repeat' => false, 'when' => [ [ 'device_type' => '00' ] ] ],
	# ...
)
```

## Converting data
In library is possible to specify which fields should undergo some calculation before shows data. Like in the example below we want the RSS info to always be - value
```sh
  'downlink_rssi' => [ 'type' => 'uint8', 'unit' => 'dBm', 'converter' => '*-1' ]
```
This results will be:
```sh
[downlink_rssi] => Array
        (
            [value] => -95
            [unit] => dBm
            [formatted] => -95 dBm
        )
```

## Array `AND / OR` logic
*[ 
	["parameter_full_path"=>"value"* OR *"parameter_full_path2"=>"value")* 
	AND 
	*["parameter_full_path3"=>"value"* OR *"parameter_full_path4=>"value")
)*

> Use a colon to separate the different parameters in path

## External plugins
NASCV can use external plugins to make some specific formatting/calculations.
```sh
'data_records' => [ 'type' => 'hex', 
                    'length' => '*', 
'                   'ext' => [ 'php-mbus', [ 'type' => 'data_records' ] ] ],
```

variable **ext** calls external plugins and in the example above we use php-mbus plugin and also sending external data to plugin what is optional.

One advanced example, how you can send before converted data to external plugin.

```sh
'records' => [ 'type' => 'hex',
               'length' => '*',
               'ext' => [ 'php-mbus', [ 'type' => 'data_record_headers_usage_status', 'count_usage' => '{data_records_for_packets:count_in_usage}', 'count_status' => '{data_records_for_packets:count_in_status}' ] ]
            ],
```

>Length `*` symbol means that we use all the rest of the data not just 1byte.