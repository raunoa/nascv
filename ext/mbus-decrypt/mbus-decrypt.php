<?php

/**
 * Class mbus_decrypt
 * @author Rauno Avel
 */
class mbus_decrypt
{

    /**
     * variable where nascv can get converted results
     * @var null
     */
    public $results = NULL;


    /**
     * @param $hex
     * @return string
     */
    public function memcpy( $hex )
    {
        return implode( '', array_reverse( str_split( $hex, 2 ) ) );
    }

    /**
     * @param $data
     * @param array $option
     * @return string
     */
    public function convert( $data, $option = array() )
    {

        $hex = str_split( $data, 2 );
        $valid_length = hexdec( $option[ 'length' ] );
        $current_length = count( $hex ) + 9;
        $key = (isset( $option[ 'encrypt_key' ] ) ? $option[ 'encrypt_key' ] : '');

        if ($key == '') {
            return $this->results = $data;
        }

        $payload = array();
        $payload[ 'output' ] = array();

        foreach ($hex as $k => $v) {
            $hex[ $k ] = hexdec( $v );
        }

        $ACC = $hex[ 1 ]; // ACC, access counter from TPL-header, used in decryption
        $enc_mode = $hex[ 4 ] & 0x1F; // 5 lower bits tell us the encryption mode
        $enc_blocks = $hex[ 3 ] >> 4; // 4 upper bits tell us the number of encyption blocks
        $enc_len = count( $hex ) - 5;
        $pay_load = str_split( substr( $data, 10 ), 32 ); // encrypted block starts after the two headers

        $iv = self::memcpy( $option[ 'man_id' ] ) . self::memcpy( $option[ 'serial' ] ) . $option[ 'version' ] . $option[ 'type' ];

        for ($i = 0; $i < 8; $i++) {
            $iv .= dechex( $ACC );
        }

        if ($key == '') {
            $payload[ 'output' ][] = 'Missing encryption key!';
        }

        if ($hex[ 0 ] != '122') {
            $payload[ 'output' ][] = array( 'text' => "Only decrypts short header!", 'hex' => $hex[ 0 ] );
        }

        if ($valid_length != $current_length) {
            $payload[ 'output' ][] = array( 'text' => 'Invalid L-field, frame isn\'t valid', 'l' => $valid_length, 'c' => count( $hex ) );
        }

        if ($enc_mode != 5) {
            $payload[ 'output' ][] = "only encyption mode 5 is supported!";
        }

        if ($enc_len != $enc_blocks * 16) {
            $payload[ 'output' ][] = sprintf( "invalid encryption lenght for aes-128 CBC = %d, expected = %d!", $enc_len, $enc_blocks * 16 );
        }

        foreach ($pay_load as $p) {
            $output = bin2hex( openssl_decrypt( hex2bin( $p ), 'AES-128-CBC', hex2bin( $key ), 3, hex2bin( $iv ) ) );
            if (substr( $output, 0, 4 ) != '2f2f') {
                $output = "Decryption failed! The first two bytes must be 0x2F after decryption!";
            } else {
                $output = array('hex'=>$output, 'data_records'=>self::php_mbus($output));
            }
            $payload[ 'output' ][] = $output;
        }
        $this->results = $payload[ 'output' ];
    }

    /**
     * Trying to use external plugin php-mbus if exists.
     * @param $data
     * @return string|void
     */
    public function php_mbus($data) {
       $php_mbus_file = dirname(__DIR__).'/php-mbus/php-mbus.php';
       if(file_exists($php_mbus_file)) {
           include_once $php_mbus_file;
           if(class_exists('php_mbus')) {
               $m = new php_mbus;
               $m->convert($data, array('type'=>'data_records'));
               $data = $m->results;
           }
       }
       return $data;
    }

    /**
     * add Zeros to number
     * @param $nr
     * @param int $range
     * @param bool $left
     * @param string $char
     * @return string
     */
    public

    function addZero( $nr, $range = 2, $left = true, $char = "0" )
    {
        $nr = trim( $nr );
        if ($left) {
            $method = STR_PAD_LEFT;
        } else {
            $method = STR_PAD_RIGHT;
        }
        return str_pad( $nr, $range, $char, $method );
    }
}
