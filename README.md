# NASCV `v8.4`

NAS Converter for IoT Systems

  - Can understand product serials and fPort to convert data
  - Has all possible converters to convert data

### Installation

NASCV requires [PHP](http://php.net/) V7.0+

```sh
$cv = new nascv;
```

### Usage

NASCV can automatically convert payloads when all needed information is present
```sh
$data = $cv->data($msg);
```
$msg contains base64 data, fport, serial, firmware (optional)
```sh
$msg = array('data'=>'8ksDADMAVhM=', 'fport'=>25, 'serial'=>'4d1b0092', 'firmware'=>'7.0')
```

see example.php

### Product mapping

| Code | Products |
| ------ | ------ |
| AEM | CM3011, CM3110, CM3120 |
| AXI | IM307x |
| GM1 | CM3060 |
| KLM | IM3060, IM3080, IM310x |
| LAC | US200x |
| LCU | UL200x, UL201x, UL2020, UL2030 |
| LGM | CM3010 |
| LWM | CM3021, CM3030, CM3040, CM3070, CM3080 |
| MLM | CM3020 |
| OIR | UM302x, UM303x, UM3070, UM3080 |
| PMG | CM1010 |
| WML | UM6000 |
| WMR | CM300x |

### Class data() response

| Type | Description |
| ------ | ------ |
| Simple data | Responds with single piece of converted data |
| Array data | If data has many different values, then it responds with a list of converted values.  |

Sample of array data (LCU fport 25 example):
```sh
Array
(
    [cumulative_power_consumption] => Array
        (
            [value] => 216050
            [unit] => Wh
            [formatted] => 216050 Wh
        )

    [current_consumption] => Array
        (
            [value] => 51
            [unit] => W
            [formatted] => 51 W
        )

    [luminaire_burn_time] => Array
        (
            [value] => 4950
            [unit] => h
            [formatted] => 4950 h
        )

    [hex] => f24b030033005613
)
```

### Manual Converters

```sh
# hex to ...
$str = $cv->hex2base64($str); #converting hex to base64
$str = $cv->hex2bin($str); #converting hex to binary
$str = $cv->hex2float($str); #converting hex to float
$str = $cv->hex2dec($str); #converting hex to dec

# ascii to ...
$str = $cv->ascii2hex($str); #converting ascii to hex
$str = $cv->ascii2dhex($str); #converting ascii to double hex (16byte split to 8bytes)
$str = $cv->ascii2gps($str); #converting ascii to gps (lat,lon)
$str = $cv->ascii2float($str); #converting ascii to float 
$str = $cv->ascii2dec($str); #converting ascii to dec

# string to ...
$str = $cv->str2bin($str); #converting string to binary
$str = $cv->str2json($str); #converting string to json
$str = $cv->string2ascii($str); #converting string to ascii

# bin to ...
$str = $cv->bin2hex($bin); #converting binary to hex

# dec to ...
$str = $cv->dec2hex($dec); #converting dec to hex

# base64 to ...
$str = $cv->base642hex($base64); #converting base64 to hex
```

### More classes

```sh
$cv->isNAS($devEUI); #is NAS device
$cv->getfPorts(); #get all fPorts
$cv->getfPort($fport) #get specific fPort info
$cv->getProducts() # $msg['appEUI'] required - shows product type (LCU, WMR, MLM, etc)
$cv->addZero($nr [, $range = 2, $left = true, $char = "0" ]) # adding characters before or after $str
$cv->call_library( 'library_name' ) # possible to call library
$cv->call_library($cv->product)->rx_fport()[$cv->fport] ) # current used library structure
$cv->find_library('library_code') # will set $cv->product, $cv->product_name and $cv->product_upn
$cv->wmbus_manufacturer("ID|Hex") # returns the opposite of ID or Hex
$cv->toHTML() # put data to nice HTML view
$cv->metering($data) # formatting data to capability structure
```

### $cv->toHTML() example

```sh
$data = $cv->data($msg);
echo $cv->toHTML($data);
```



### $cv->metering() example (New)

```sh
$data = $cv->data($msg);
print_r($cv->metering($data));
```

Result example:
```sh
{
    "data": {
        "accumulated_volume": {
            "value": 3,
            "unit": "L",
            "formatted": "3 L"
        }
    },
    "configuration": {
        "fixed_metering_enabled": {
            "value": 0,
            "formatted": "disabled"
        }
    },
    "event": {
        "tamper_alert": {
            "value": 0,
            "formatted": "false"
        },
        "temperature_alert": {
            "value": 0,
            "formatted": "false"
        },
        "battery_alert": {
            "value": 0,
            "formatted": "false"
        },
        "reverse_flow_alert": {
            "value": 0,
            "formatted": "false"
        },
        "leak_alert": {
            "value": 0,
            "formatted": "false"
        },
        "burst_alert": {
            "value": 0,
            "formatted": "false"
        }
    }
}
```

### $cv->toMetering() example (Deprecated)

```sh
$data = $cv->data($msg);
print_r($cv->toMetering($data));
```

This will be deleted in next version

### Advanced

You can manually set data converting, when you configure following variables:
```sh
$cv->unit = 'hex'; #can be anything
$cv->type = 'hex'; #list of types is showed belowe
$cv->byte = 'LSB'; #LSB or MSB

$cv->overwrite = true; # default is false. if you want predefined unit, type and byte then set true
$data = $cv->data(array('data'=>'I0Vn'));
```
`If you set serial then product is priority and this will still overwrite type, byte even if you set $cv->overwrite true and predefined own type, byte.`

Also after $cv->data() use can print unit, type, byte and data over $cv objects
```sh
echo $cv->data;
echo $cv->description;
echo $cv->direction;
echo $cv->fport;
echo $cv->product; #shows product type (LCU, WMR, MLM, etc)
echo $cv->product_name; #shows product name (Luminaire Controller Bare, etc)
echo $cv->product_upn; #shows product upn (UL2002, CM3040, etc)
echo $cv->rawdata; #shows rawdata in base64
```

### Configuration
```sh
$cv->showHex = true; # default is true
$cv->direction = 'rx'; #rx or tx (rx is default)
$cv->firmware = ''; // can also be set in $cv->data($data)
$cv->firmware_patch = ''; // can also be set in $cv->data($data)
$cv->encrypt_key = ''; // can also be set in $cv->data($data)
```

### WM-BUS Decrypting
To decrypt WML payload you have to send encrypt key with other datas.
```sh
$msg = array('data'=>'{base64_data}', 'fport'=>25, 'serial'=>'{product_serial}', 'encrypt_key'=>'01020304050607080911121314151617')
$data = $cv->data($msg);
```
