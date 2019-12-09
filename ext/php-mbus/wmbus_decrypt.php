<?php

include_once ("mbus_defs.php");
include_once ("mbus_utils.php");
include_once ("mbus_frame.php");

include_once dirname(dirname(__DIR__))."/src/library/components/registers.php";


//include_once ("handle_kem.php");
# kamsrup meters readable by wmbus
# flowIQ 21xx
# flowIQ 31xx
# MC 21 with Wireless M-Bus Mode C1
# MC 61 with Wireless M-Bus Mode C1
# MC 62 with Wireless M-Bus Mode C1
# MC 302 with Wireless M-Bus Mode C1
# MC 402 with Wireless M-Bus Mode C1
# MC 601 with Wireless M-Bus Mode C1
# MC 602 with Wireless M-Bus Mode C1
# MC 801 with Wireless M-Bus Mode C1


function hexToStr($hex){
    $string='';
    for ($i=0; $i < strlen($hex)-1; $i+=2){
        $string .= chr(hexdec($hex[$i].$hex[$i+1]));
    }
    return $string;
}

// https://gist.github.com/srsbiz/8373451ed3450c0548c3
function pad_zero($data)
{
    $len = 16;
    if (strlen($data) % $len) {
        $padLength = $len - strlen($data) % $len;
        $data .= str_repeat("\0", $padLength);
    }
    return $data;
}

function byte_2_hex($byte) {
    $retval = sprintf("%02x", $byte);
    return $retval;
}

function array_2_hex($array)
{
    $res = "";
    foreach ($array as $byte){
        $res .= sprintf("%02x", $byte);
    }
    return $res;
}

function hex_2_array($hex)
{
    return array_values(unpack("C*", hex2bin(str_replace(' ', '', $hex))));
}

function data_integer_decode($data) {
    $val = 0;
    for ($i = count($data); $i > 0; $i--) {
        $val = ($val << 8) + $data[$i-1];
    }
    return $val;
}

function print_buffer_hex($data){
    for($j = 0; $j < sizeof($data); $j++){
        print(mbus_utils::ByteToHex($data[$j]));
    }
    print("\n");
}

class ParseException extends Exception { }

function get_manufacturer_info($manuf_raw_arr)
{
    $manByte1PlusByte2 = $manuf_raw_arr[0] + ($manuf_raw_arr[1] << 8);
    $manuf = chr(($manByte1PlusByte2 >> 10 & 0x001F) + 64) . chr(($manByte1PlusByte2 >> 5 & 0x001F) + 64) . chr(($manByte1PlusByte2 & 0x001F) + 64);
    return $manuf;
}

function get_manufacturer_name($man_id_char) {
    $regs = new registers;
    $man_list = json_decode($regs->wmbus_manufacturers);

    foreach ($man_list as $item) {
        if(strcmp($item->id, $man_id_char) == 0) {
            return $item->manufacturer;
        }
    }
    return $man_id_char;
}

class ParseWmbus
{
    private $error = "";
    private $iv_input = [];
    private $control_info = 0x00;
    private $data_wmbus_crypted = [];
//    public $data_wmbus_decrypted = [];
//    private $data_wmbus_data_records = [];
    private $parsed_info = [];
    private $result = [];

    public $datarecord_headers = "";
/*
    private function reset_variables()
    {
        $this->error = "";
        $this->data_wmbus_crypted = [];
        $this->data_wmbus_decrypted = [];
        $this->data_wmbus_data_records = [];
        $this->parsed_info = [];
        $this->result = [];
    }
*/
    private function parse_frame_b_block_1($data)
    {
        $this->iv_input = [];
        $iv_info = &$this->iv_input;

        $this->result["header"] = [];
        $res = &$this->result["header"];

        if(count($data) < 10)
            throw new ParseException(sprintf("Packet too short to parse frame-B len: %d", count($data)));

        $len = $data[0];
        $iv_info["length"] = $len;

        // TODO
//        if ($valid_length != $current_length) {
//            $payload[ 'output' ][] = 'Invalid L-field, frame isn\'t valid';
//        }


        # https://www.infineon.com/dgdl/TDA5340_AN_WMBus_v1.0.pdf?fileId=db3a304336797ff90136c14855cb7030
        # C=06h: Mode T2
        # C=46h: Mode T1
        # C=44h: (SEND/NO REPLY)
        # C=4Bh: (REQUEST/RESPOND)
        # C=08h: (RESPOND)
        $control = $data[1];
        if ($control == 0x44) {
            $res["_control"] = "primary station, unidirectional";
        } else {
            throw new ParseException(sprintf("WMBus control field not 0x44 - Primary station, unidirectional, %02x", $control));
        }

        $res["manufacturer"] = [];
        $res["manufacturer"]["value"] = get_manufacturer_info(array_slice($data, 2, 2));
        $res["manufacturer"]["_value_raw"] = array_2_hex(array_slice($data, 2, 2));
        $res["manufacturer"]["formatted"] = get_manufacturer_name($res["manufacturer"]["value"]);
        $iv_info["manufacturer"] = array_slice($data, 2, 2);

        $res["serial"] = array_2_hex(array_reverse(array_slice($data, 4, 4)));
        $iv_info["serial"] = array_slice($data, 4, 4);

        $res["version"] = dechex($data[8]);
        $iv_info["version"] = $data[8];

        $rew["device_type"] = [];
        $res["device_type"]["formatted"] = mbus_utils::getMediumType($data[9]);
        $res["device_type"]["value"] = byte_2_hex($data[9]);
        $iv_info["type"] = $data[9];
        
        return array_slice($data, 10);
    }

    private function get_ell_iv()
    {
        # M-field KAM, A-field, CC, SN, FN, BC
        $info = &$this->iv_input;

//        if($info["version"] == 0x17)
//        if($info["version"] == 0x1b)
        $res = Array(); 
        array_push($res, $info["manufacturer"]);
        array_push($res, $info["serial"]);
        array_push($res, Array($info["version"]));
        array_push($res, Array($info["type"]));
        array_push($res, Array($info["communication_control"]));
        array_push($res, $info["session_number"]);
        array_push($res, Array(0, 0, 0));
        $res = array_merge(...$res);
        return $res;
    }

    private function get_short_header_iv()
    {
        # M-field KAM, A-field, CC, SN, FN, BC
        $info = &$this->iv_input;

        $res = Array(); 
        array_push($res, $info["manufacturer"]);
        array_push($res, $info["serial"]);
        array_push($res, Array($info["version"]));
        array_push($res, Array($info["type"]));
        for ($i = 0; $i < 8; $i++) {
            array_push($res, Array($info["access_number"]));
        }
        $res = array_merge(...$res);
        return $res;
    }

    private function decrypt_payload_ctr($data_crypted, $key, $iv) {
        if(strlen($key) == 0) {
            throw new ParseException("wM-Bus key missing");
        }
        if(strlen($key) != 16) {
            throw new ParseException("wM-Bus wrong key lenght");
        }
        $payload = hex2bin(array_2_hex($data_crypted));
        $options = OPENSSL_RAW_DATA;
        $payload_padded = pad_zero($payload);
        $decrypted = openssl_decrypt($payload_padded, 'aes-128-ctr', $key, $options, hex2bin(array_2_hex($iv)));
        return array_values(unpack("C*", substr($decrypted, 0, strlen($payload))));
    }    

    private function decrypt_payload_cbc($data_crypted, $key, $iv) {
        if(strlen($key) == 0) {
            throw new ParseException("wM-Bus key missing");
        }
        if(strlen($key) != 16) {
            throw new ParseException("wM-Bus wrong key lenght");
        }

        $payload = hex2bin(array_2_hex($data_crypted));
        $options = OPENSSL_RAW_DATA | OPENSSL_ZERO_PADDING;
        $payload_padded = pad_zero($payload);
        $decrypted = openssl_decrypt($payload_padded, 'aes-128-cbc', $key, $options, hex2bin(array_2_hex($iv)));
        $res = array_values(unpack("C*", substr($decrypted, 0, strlen($payload))));

        if($res[0] != 0x2f || $res[1] != 0x2f) {
            throw new ParseException("wM-Bus key wrong");
        }

        return $res;
    }

    private function parse_datarecords_store_results($data_application) {
        $appl = array_2_hex($data_application);
//        $this->data_wmbus_data_records = $appl;
    
        $this->result["data_records"] = [];
        $datarec = &$this->result["data_records"];

        $mbusFrame = new mbus_frame();
        $mbusFrame->parse_variable_datarecords($appl);
        $datarec = $mbusFrame->results_datarec;

        $this->datarecord_headers = "";
        foreach ($datarec as $record)
        {
            if (!isset( $record["_header_raw"] )) {
                $this->datarecord_headers = "";
                break;
            }
            $this->datarecord_headers .= $record["_header_raw"];
        }
    }


    private function parse_decrypted_headers_and_data_records($data_crypted, $key, $datarec_headers="")
    {
        $res = &$this->result;
        $iv_info = &$this->iv_input;

        $len_offset = 9;
        if(count($data_crypted) != ($iv_info['length'] - $len_offset))
            throw new ParseException(sprintf("Packet length field and real length mismatch. expecting: %d real: %d", $iv_info['length'] - $len_offset, count($data_crypted)));


        $this->control_info = $data_crypted[0];
        $data_application = Array();
        if ($this->control_info == 0x8d) // Extended link layer II,
        {
//            print_buffer_hex($data_crypted);
            $iv_info["communication_control"] = $data_crypted[1];
//            if ($iv_info["communication_control"] != 0x20)
//                throw new ParseException(sprintf("WMBus communication control field not 0x20, but %02x", $iv_info["communication_control"]));
        
            $iv_info["access_number"] = $data_crypted[2];
            $iv_info["session_number"] = array_slice($data_crypted, 3, 4);
            $enc_mode = ($iv_info["session_number"][3] >> 5) & 0x07; 

            if($enc_mode == 0x01) {
                // cut off the extended Link Layer header and continue finding the real header
                $data_decrypted = $this->decrypt_payload_ctr(array_slice($data_crypted, 7), $key, $this->get_ell_iv());
                // TODO check CRCs
  //            $info["payload crc"] = array_slice($data_decrypted, 0, 2);
            }
            else {
                $data_decrypted = array_slice($data_crypted, 7); 
            }

            $data_application = array_slice($data_decrypted, 2); // remove crc from the beginning
            
            // update control information accordingly
            $this->control_info = $data_application[0];

            $res["_payload_hex"] = array_2_hex(array_slice($data_application, 1));

            if($this->control_info == 0x78) // Full frame
            {
                $res["header"]["_control_information"] = "full_frame";

    #            $crc = calculate_crc(array_slice($data, 7));
                $this->parse_datarecords_store_results(array_slice($data_application, 1));
                return;      
            }
            else if($this->control_info == 0x79) // Compact frame
            {
                $res["header"]["_control information"] = "compact_frame";
                $res["data_records"] = Array("error" => "Compact frame parsing is not supported at this point");
                return;      
            }  
            else
            {
                throw new ParseException(sprintf("WMBus probably decrypted wrong, %02x", $this->control_info));
            }
        }

        $data_for_decryption = Array();
        $iv = Array();

        if($this->control_info == 0x7a) { // Short header
            $iv_info["access_number"] = $data_crypted[ 1 ]; // ACC, access counter from TPL-header, used in decryption
            $enc_mode = $data_crypted[ 4 ] & 0x1F; // 5 lower bits tell us the encryption mode
            $enc_blocks = $data_crypted[ 3 ] >> 4; // 4 upper bits tell us the number of encyption blocks
            $enc_blocks = ($enc_blocks < 1 ? 1 : $enc_blocks);
            $enc_len = count( $data_crypted ) - 5;
            $block_size = $enc_len / $enc_blocks;

            $data_for_decryption = array_slice($data_crypted, 5); // or 10  

            $iv = $this->get_short_header_iv();

        } elseif ($this->control_info == 0x72) { // long header

            $enc_mode = $data_crypted[ 12 ] & 0x1F; // 5 lower bits tell us the encryption mode
            $enc_blocks = $data_crypted[ 11 ] >> 4; // 4 upper bits tell us the number of encyption blocks
            $enc_len = count( $data_crypted ) - 13;
            $block_size = $enc_len / $enc_blocks;

            $data_for_decryption = array_slice($data_crypted, 13); //or 26
//            $pay_load = str_split( substr( $data, 26 ), $block_size * 2 ); // encrypted block starts after the two headers
/*
            $iv = $hex[ 5 ] . $hex[ 6 ] . $hex[ 1 ] . $hex[ 2 ] . $hex[ 3 ] . $hex[ 4 ] . $hex[ 7 ] . $hex[ 8 ];
            for ($i = 0; $i < 8; $i++) {
                $iv .= $hex[ 9 ];
            }*/
            $iv_temp = Array(Array($data_crypted[ 5 ], $data_crypted[ 6 ], $data_crypted[ 1 ], $data_crypted[ 2 ], $data_crypted[ 3 ], $data_crypted[ 4 ], $data_crypted[ 7 ], $data_crypted[ 8 ]));
            $acc = $data_crypted[ 9 ];
            array_push($iv_temp, Array($acc, $acc, $acc, $acc, $acc, $acc, $acc, $acc));
            $iv = array_merge(...$iv_temp);
        } else {
            // TODO  raise exception
            $payload[ 'output' ][] = "unknown_header";
        }

        $data_decrypted = $this->decrypt_payload_cbc($data_for_decryption, $key, $iv);
        
        $res["_payload_hex"] = array_2_hex($data_decrypted);
        $this->parse_datarecords_store_results($data_decrypted);                    

        // https://www.infineon.com/dgdl/TDA5340_AN_WMBus_v1.0.pdf?fileId=db3a304336797ff90136c14855cb7030 p8 crc example

#        if(array_key_exists("hex", $res["data records"]))
#            unset($res["data records"]["hex"]);
#        if(array_key_exists("error", $res["data records"]))
#            unset($res["data records"]["error"]);
    }

    public function decrypt_parse_wmbus_frame_b($data_in_hex, $key_hex, $datarec_headers="")
    {
        $application_payload = Array();
        try {
            $data_in = hex_2_array($data_in_hex);
            $key = hexToStr($key_hex);

            $application_payload = $this->parse_frame_b_block_1($data_in);
            $this->parse_decrypted_headers_and_data_records($application_payload, $key, $datarec_headers);
        }
        catch(ParseException $e)
        {
            if(!array_key_exists("_payload_hex", $this->result) && $application_payload) {
                $this->result["_payload_hex"] = array_2_hex($application_payload);
            }

            $this->result["error"] = "".$e->getMessage();
        }
        return $this->result;
    }

    public function parse_wmbus_frame_b_header($data_in_hex)
    {
        try {
            $data_in = hex_2_array($data_in_hex);

            $application_payload = $this->parse_frame_b_block_1($data_in);
        }
        catch(ParseException $e)
        {
            $this->result["error"] = "".$e->getMessage();
        }
        return $this->result;
    }
}

