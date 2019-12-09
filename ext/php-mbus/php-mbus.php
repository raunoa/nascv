<?php

/**
 * Class php_mbus
 */
class php_mbus
{

    /**
     * variable where nascv can get converted results
     * @var null
     */
    public $results = NULL;
    private $mbus;

    /**
     * php_mbus constructor.
     */
    function __construct()
    {
        include_once("mbus_defs.php");
        include_once("mbus_frame.php");
        include_once("mbus_utils.php");
        include_once("wmbus_decrypt.php");
        $this->mbus = new mbus_frame();
    }

    /**
     * NASCV starts function convert
     * @param $data
     */
    public function convert( $data, $option = array() )
    {
        if($option[ 'type' ] == 'wml_wmbus_frame_b') {
            $key = (isset( $option[ 'encrypt_key' ] ) ? $option[ 'encrypt_key' ] : '');
            $wmbus = new ParseWmbus();
            if(strlen($data) / 2 == 11) {
                $this->results = $wmbus->parse_wmbus_frame_b_header($data, $key);
                $status = hexdec(substr($data, -2));
                $this->results['communication_error'] = [];
                $dev_stat = &$this->results['communication_error'];

                $dev_stat['sf_limited'] = [];
                $dev_stat['sf_limited']['value'] = $status & 0xF;

                $sf_low = ($status >> 4) & 1;
                $dev_stat['sf_too_high'] = [];
                $dev_stat['sf_too_high']['value'] = $sf_low;
                $dev_stat['sf_too_high']['formatted'] = $sf_low ? 'true' : 'false';

                $comm_lost = ($status >> 5) & 1;
                $dev_stat['communication_lost'] = [];
                $dev_stat['communication_lost']['value'] = $comm_lost;
                $dev_stat['communication_lost']['formatted'] = $comm_lost ? 'true' : 'false';
                return;
            }
            else {
                $this->results = $wmbus->decrypt_parse_wmbus_frame_b($data, $key);
                return;
            }
        }

        if($option[ 'type' ] == 'wmbus_frame_b') {
            $key = (isset( $option[ 'encrypt_key' ] ) ? $option[ 'encrypt_key' ] : '');
            $wmbus = new ParseWmbus();
            $this->results = $wmbus->decrypt_parse_wmbus_frame_b($data, $key);
            return;
        }

        $this->mbus = new mbus_frame();
        switch ($option[ 'type' ]):
            case 'fixed_header':
                $this->mbus->parse_fixed_header( $data );
                break;
            case 'data_record_headers':
                $this->mbus->parse_variable_datarecord_headers( $data );
                break;
            case 'data_records':
                $this->mbus->parse_variable_datarecords( $data );
                break;
            case 'data_record_headers_usage_status':
                $this->mbus->parse_variable_datarecords_usage_status( $data, $option[ 'count_usage' ], $option[ 'count_status' ]);
                break;
            default:
                $this->mbus->parse_packet( $data );

        endswitch;
        $this->results = $this->mbus->results;
    }
}

/*
require '../../src/nascv.php';
$cv = new nascv;

// F18 (Kamstrup MC21 Full frame)
//$test = [ 'data' => 'IkQtLEaGFGMXBo0g0WDx6AOKjXgC/yAPAAQTL4UHAFI7AAA=', 'fport' => '18', 'encrypt_key'=>'00000000000000000000000000000000' ];

// F18 (Kamstrup MC21 Compact frame)
//$test = [ 'data' => 'H0QtLEaGFGMXBo0g2GHx6AOW03kOfOf0DwAvhQcAAAA=', 'fport' => '18', 'encrypt_key'=>'00000000000000000000000000000000' ];

// F18 (wM-Bus - long header decryption)
//$test = [ 'data' => 'NkTmHmBTWQACDnJRlFQW5h48B40wIGUsL+pay8LcX2/AheyaJz1TZQyxTZd07FMlVaIzc/BEdA==', 'fport' => '18', 'encrypt_key'=>'18011605e61e0d02bf0cfa357d9e7703' ];

// UKW f18 (w-mbus)1.0.0
//$test = [ 'data' => 'JkQzOAaJmSkBDnJRlFQW5h48B4MAECWi8TpJqvfZn5N9Q2D+EWTd', 'fport' => '18', 'serial' => '4c12002c', 'firmware' => '1.0.0' ];

//'WML f25 (usage_packet - payload decryption)' => [ 'request' =>
//$test = [ 'data' => 'Af/NHkQzOJSWAyABB3pBABAFUGwFvUa2Wwe+d74/+UUJFw==', 'fport' => '25', 'serial' => '4c1d001c', 'encrypt_key' => '72344e7a8e11177224a781c2ae151c51' ];

// 'WMB f24 (wmbus-meter)' => [ 'request' =>
$test = [ 'data' => 'HkQzOIuWAyABB3rPABAl5NUcZ1x370nWOvq9GLqA7w==', 'fport' => '24', 'serial' => '509b0001', 'encrypt_key' => 'db127bd37432415ac69a15ecedac8146'];

$res = $cv->data( $test );
print(json_encode($res, JSON_PRETTY_PRINT));
*/