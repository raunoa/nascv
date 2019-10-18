<?php

include_once ("mbus_defs.php");

class EndOfBufferExeption extends Exception { }

/**
 * MBus is based on IEC standards.
 *  http://en.wikipedia.org/wiki/International_Electrotechnical_Commission
 *
 * Of which there are a quite a few.
 *  http://en.wikipedia.org/wiki/List_of_IEC_standards
 *
 * A sample mbus frame.
 *
 *   LONG: size = N >= 9 byte
 *
 *       byte1: start1  = 0x68
 *       byte2: length1 = ...
 *       byte3: length2 = ...
 *       byte4: start2  = 0x68
 *       byte5: control = ...
 *       byte6: address = ...
 *       byte7: ctl.info= ...
 *       byte8: data    = ...
 *             ...     = ...
 *       byteN-1: chksum  = ...
 *       byteN: stop    = 0x16
 *
 */
class mbus_frame {

    private $start1;
    private $length1 = 0;
    private $length2 = 0;
    private $start2;
    private $control;
    private $address;
    private $control_information;

    private $checksum;
    private $stop;

    private $type; // int

    private $mbus_frame_configured = false;

    /**
     * Frame types
     */
    public static $MBUS_FRAME_TYPE_ANY = 0;
    public static $MBUS_FRAME_TYPE_ACK = 1;
    public static $MBUS_FRAME_TYPE_SHORT = 2;
    public static $MBUS_FRAME_TYPE_CONTROL = 3;
    public static $MBUS_FRAME_TYPE_LONG = 4;

    public static $MBUS_FRAME_ACK_BASE_SIZE       = 1;
    public static $MBUS_FRAME_SHORT_BASE_SIZE     = 5;
    public static $MBUS_FRAME_CONTROL_BASE_SIZE   = 9;
    public static $MBUS_FRAME_LONG_BASE_SIZE      = 9;

    public static $MBUS_FRAME_BASE_SIZE_ACK       = 1;
    public static $MBUS_FRAME_BASE_SIZE_SHORT     = 5;
    public static $MBUS_FRAME_BASE_SIZE_CONTROL   = 9;
    public static $MBUS_FRAME_BASE_SIZE_LONG      = 9;

    public static $MBUS_FRAME_FIXED_SIZE_ACK      = 1;
    public static $MBUS_FRAME_FIXED_SIZE_SHORT    = 5;
    public static $MBUS_FRAME_FIXED_SIZE_CONTROL  = 6;
    public static $MBUS_FRAME_FIXED_SIZE_LONG     = 6;

    /**
     * Frame start/stop bits
     */
    public static $MBUS_FRAME_ACK_START = 0xE5;
    public static $MBUS_FRAME_SHORT_START = 0x10;
    public static $MBUS_FRAME_CONTROL_START = 0x68;
    public static $MBUS_FRAME_LONG_START = 0x68;
    public static $MBUS_FRAME_STOP = 0x16;

    /**
     * Control field
     */
    public static $MBUS_CONTROL_FIELD_DIRECTION    = 0x07;
    public static $MBUS_CONTROL_FIELD_FCB          = 0x06;
    public static $MBUS_CONTROL_FIELD_ACD          = 0x06;
    public static $MBUS_CONTROL_FIELD_FCV          = 0x05;
    public static $MBUS_CONTROL_FIELD_DFC          = 0x05;
    public static $MBUS_CONTROL_FIELD_F3           = 0x04;
    public static $MBUS_CONTROL_FIELD_F2           = 0x03;
    public static $MBUS_CONTROL_FIELD_F1           = 0x02;
    public static $MBUS_CONTROL_FIELD_F0           = 0x01;

    public static $MBUS_CONTROL_MASK_SND_NKE       = 0x40;
    public static $MBUS_CONTROL_MASK_SND_UD        = 0x53;
    public static $MBUS_CONTROL_MASK_REQ_UD2       = 0x5B;
    public static $MBUS_CONTROL_MASK_REQ_UD1       = 0x5A;
    public static $MBUS_CONTROL_MASK_RSP_UD        = 0x08;

    public static $MBUS_CONTROL_MASK_FCB           = 0x20;
    public static $MBUS_CONTROL_MASK_FCV           = 0x10;

    public static $MBUS_CONTROL_MASK_ACD           = 0x20;
    public static $MBUS_CONTROL_MASK_DFC           = 0x10;

    public static $MBUS_CONTROL_MASK_DIR           = 0x40;
    public static $MBUS_CONTROL_MASK_DIR_M2S       = 0x40;
    public static $MBUS_CONTROL_MASK_DIR_S2M       = 0x00;


    /**
     * Stores frame type.
     */
    private $frame_type = "";

    /**
     * Stores Variable Length Data Header.
     */
    private $varheader = array();


    /**
     * Stores Variable Length Data and other stuff
     */
    public $results = array();

    /**
     * Stores Variable Length Data only
     */
    public $results_datarec = array();

    /**
     * send a data request packet to from master to slave
     */
    public function get_data_request_frame($address) {

        if ( ! $this->mbus_frame_setup(mbus_frame::$MBUS_FRAME_TYPE_SHORT) ) {
            return false;
        }

        $this->control  = mbus_frame::$MBUS_CONTROL_MASK_REQ_UD2 | mbus_frame::$MBUS_CONTROL_MASK_DIR_M2S;
        $this->address  = $address;

        $frame_out = [];
        if ( ! $this->mbus_frame_pack($frame_out) ) {
            return false;
        }

        return mbus_utils::byteArray2byteStr($frame_out);
    }

    /**
     * Allocate an M-bus frame data structure and initialize it according to which
     * frame type is requested.
     */
    private function mbus_frame_setup($frame_type) {
        $this->frame_type = $frame_type;
        switch ($this->frame_type)
        {
            case mbus_frame::$MBUS_FRAME_TYPE_ACK:
                $this->start1 = mbus_frame::$MBUS_FRAME_ACK_START;
                break;

            case mbus_frame::$MBUS_FRAME_TYPE_SHORT:
                $this->start1 = mbus_frame::$MBUS_FRAME_SHORT_START;
                $this->stop   = mbus_frame::$MBUS_FRAME_STOP;
                break;

            case mbus_frame::$MBUS_FRAME_TYPE_CONTROL:
                $this->start1 = mbus_frame::$MBUS_FRAME_CONTROL_START;
                $this->start2 = mbus_frame::$MBUS_FRAME_CONTROL_START;
                $this->length1 = 3;
                $this->length2 = 3;
                $this->stop   = mbus_frame::$MBUS_FRAME_STOP;
                break;

            case mbus_frame::$MBUS_FRAME_TYPE_LONG:
                $this->start1 = mbus_frame::$MBUS_FRAME_LONG_START;
                $this->start2 = mbus_frame::$MBUS_FRAME_LONG_START;
                $this->stop   = mbus_frame::$MBUS_FRAME_STOP;
                break;

            default:
                $this->results['error'] = sprintf("Frame setup. Unknown frame type %02X", $this->frame_type);
                return false;
        }

        return true;
    }

    /**
     * Pack the M-bus frame into a binary string representation that can be sent
     * on the bus. The binary packet format is different for the different types
     * of M-bus frames.
     */
    private function mbus_frame_pack(&$frame_out, $user_data=[]) {
        $this->calc_checksum($user_data);

        switch ($this->frame_type)
        {
            case mbus_frame::$MBUS_FRAME_TYPE_ACK:
                $frame_out[0] = $this->start1;
                break;

            case mbus_frame::$MBUS_FRAME_TYPE_SHORT:
                $frame_out[] = $this->start1;
                $frame_out[] = $this->control;
                $frame_out[] = $this->address;
                $frame_out[] = $this->checksum;
                $frame_out[] = $this->stop;
                break;

            case mbus_frame::$MBUS_FRAME_TYPE_CONTROL:

                $frame_out[] = $this->start1;
                $frame_out[] = $this->length1;
                $frame_out[] = $this->length2;
                $frame_out[] = $this->start2;

                $frame_out[] = $this->control;
                $frame_out[] = $this->address;
                $frame_out[] = $this->control_information;

                $frame_out[] = $this->checksum;
                $frame_out[] = $this->stop;
                break;

            case mbus_frame::$MBUS_FRAME_TYPE_LONG:

                $frame_out[] = $this->start1;
                $frame_out[] = $this->length1;
                $frame_out[] = $this->length2;
                $frame_out[] = $this->start2;

                $frame_out[] = $this->control;
                $frame_out[] = $this->address;
                $frame_out[] = $this->control_information;

                for ($i = 0; $i < count($user_data); $i++) {
                    $frame_out[] = $user_data[i];
                }

                $frame_out[] = $this->checksum;
                $frame_out[] = $this->stop;
                break;

            default:
                $this->results['error'] = sprintf("Frame pack. Unknown frame type %02X.", $this->frame_type);
                return false;
        }
        return true;
    }

    /**
     * Caclulate the checksum of the M-Bus frame.
     */
    private function calc_checksum($user_data=[]) {

        switch($this->frame_type)
        {
            case mbus_frame::$MBUS_FRAME_TYPE_SHORT:
                $this->checksum = $this->control;
                $this->checksum += $this->address;
                break;

            case mbus_frame::$MBUS_FRAME_TYPE_CONTROL:
                $this->checksum = $this->control;
                $this->checksum += $this->address;
                $this->checksum += $this->control_information;
                break;

            case mbus_frame::$MBUS_FRAME_TYPE_LONG:

                $this->checksum = $this->control;
                $this->checksum += $this->address;
                $this->checksum += $this->control_information;

                for ($i = 0; $i < count($user_data); $i++) {
                    $this->checksum += $user_data[$i];
                }
                break;

            case mbus_frame::$MBUS_FRAME_TYPE_ACK:
            default:
                $this->checksum = 0;
        }
    }

    /**
     * Entry point, detect message type and direct to appropriate function.
     */
    // this was called parse()
    public function parse_packet(&$data) {
//        $this->results = [];
        $data_raw = mbus_utils::byteStr2byteArray($data);

        if ( count($data_raw) == 0 ) {
            $this->results['error'] = "No data to parse.";
            return false;
        }

        if ( dechex($data_raw[0]) == mbus_defs::$MBUS_FRAME_LONG_START ) {
            // "Long or Control Frame Detected."
            if(count($data_raw) < 21){
                $this->results['error'] = "Data payload too short.";
                return false;
            }

            $data_header = array_slice($data_raw, 0, 19);
            $data_header_fixed = array_slice($data_raw, 7, 12);
            $data_frames = array_slice($data_raw, 19, -2);

            $this->getSlaveInformation($data_header_fixed);
            $this->results['slave_information'] = $this->varheader;

            if ( !$this->parseLongFrameTypeHeader($data_header, $data_raw) ) {
                return false;
            }


            if ( !$this->parse_payload_variable_internal($data_frames, false) ) {
                return false;
            }

        } else {
            $this->results['error'] = sprintf("Parse. Unknown frame type %02X.", $data_raw[0]);
            return false;
        }

        $this->mbus_frame_configured = true;
        return true;
    }

    /**
     * Entry point for variable packet payload, expecting the slave information (and checksum and stop bytes) to be removed.
     */

    public function parse_variable_datarecords($data, $data_payload_optional_raw="")
    {
        $data_frame = mbus_utils::byteStr2byteArray($data);
        return $this->parse_payload_variable_internal($data_frame, false, $data_payload_optional_raw);
    }

    public function parse_variable_datarecord_headers($data)
    {
        $data_frame = mbus_utils::byteStr2byteArray($data);
        return $this->parse_payload_variable_internal($data_frame, true, false);
    }

    public function parse_fixed_header($data)
    {
        $data_header_fixed = mbus_utils::byteStr2byteArray($data);

        if( !$this->getSlaveInformation($data_header_fixed) )
        {
            $this->results['error'] = "Fixed header payload too short.";
            return false;
        }
        $this->results = $this->varheader;
        return true;
    }

    public function parse_variable_datarecords_usage_status( $data, $count_usage, $count_status )
    {
        $data_frame = mbus_utils::byteStr2byteArray($data);
        if( !$this->parse_payload_variable_internal($data_frame, true, false))
            return false;
        $i = 1;
        $i_count = count($this->results);

        $res = array();
        for($j = 0; $j < $count_usage; $j++){
            if($i > $i_count) break;
            $res['usage'][] = $this->results[$i];
            $i++;
        }

        for($j = 0; $j < $count_status; $j++){
            if($i > $i_count) break;
            $res['status'][] = $this->results[$i];
            $i++;
        }

        $this->results = $res;
        return true;
    }

    public function parse_payload_variable_internal($data_frame, $is_headers_only=false, $data_payload_optional_raw="") {
        if ( count($data_frame) == 0 ) {
            $this->results['error'] = "parse_variable_payload. No data to parse.";
            return false;
        }

        $data_payload_optional =  mbus_utils::byteStr2byteArray($data_payload_optional_raw);

        $this->type = mbus_defs::$MBUS_DATA_TYPE_VARIABLE;
        $parse_success = false;

        try {
            $parse_success = $this->parseVariableData($data_frame, $is_headers_only, $data_payload_optional);
        }
        catch(EndOfBufferExeption $e)
        {
            $this->results_datarec['hex'] = "";
            foreach ($data_frame as $byte)
                $this->results_datarec['hex'] .= mbus_utils::ByteToHex($byte);

            $this->results_datarec['error'] = "".$e->getMessage();
        }

//        $record_tag = $is_headers_only ? 'data_record_headers' : 'data_records';
        $this->results = $this->results_datarec;

        #        $this->mbus_frame_configured = true;
        return $parse_success;
    }

    /**
     * Frame data can be either fixed or variable.
     *
     * $data[6] = 0x72|0x76 = Variable Length Data Structure
     * $data[6] = 0x73|0x77 = Fixed Length Data Structure
     */
#    private function parseFrameData($data_header, $data_frame, $is_headers_only) {
#
#        switch (dechex($this->control_information)) {
#            case mbus_defs::$MBUS_CONTROL_INFO_RESP_VARIABLE: // 0x72
#                $this->type = mbus_defs::$MBUS_DATA_TYPE_VARIABLE;
#                //mbus_utils::mylog("Data type is variable. See: 6.3 Variable Data Structure");
#                $this->getSlaveInformation($data_header);
#                $this->results["slave_information"] = $this->varheader;
#
#                return mbus_utils::parse_payload_variable_internal();
#                break;
#
#            case mbus_defs::$MBUS_CONTROL_INFO_RESP_FIXED: // 0x73
#                $this->type = mbus_defs::$MBUS_DATA_TYPE_FIXED;
#                $this->results['error'] = "parseFrameData. Fixed data type not implemented.";
##                mbus_utils::mylog("NYI - Data type is fixed. See: 6.2 Fixed Data Structure");
#                return false;
#                // return mbus_data_fixed_parse(frame, &(data->data_fix));
#
#                break;
#
#            default:
#                $this->results['error'] = sprintf("parseFrameData. Could not determine frame data type: %02X.", $this->control_information);
##                mbus_utils::mylog("Could not determine frame data type!");
#                return false;
#        }
#        return true;
#    }

    /**
     * Returns the frame or false (use === to check return value)
     */
    public function getFrame() {
        if ( $this->mbus_frame_configured ) {
            return $this->mbus_frame;
        }
        return false;
    }
    /**
     * Parse an mbus "long" frame type.
     * Start1               [0]     \x68
     * Length1              [1]     \x56
     * Length2              [2]     \x56
     * Start2               [3]     \x68
     * Control              [4]     \x08
     * Address              [5]     \x06
     * Control_Information  [6]     \x72
     * ...
     * Checksum             [N-1]   \x97
     * StopByte             [N]     \x16
     */
    private function parseLongFrameTypeHeader($data_header, $data_all) {

        if (count($data_header) < 3) {
            $this->results['error'] = "parseLongFrameTypeHeader. Packet header too short.";
            return false;
        }

        $this->start1 = $data_header[0];
        $this->length1 = $data_header[1];
        $this->length2 = $data_header[2];

        if ( $this->length1 != $this->length2) {
            $this->results['error'] = "parseLongFrameTypeHeader. Packet header lengths not matching.";
            return false;
        }

        if (count($data_all) < (mbus_defs::$MBUS_FRAME_FIXED_SIZE_LONG + $this->length1)) {
            $this->results['error'] = "parseLongFrameTypeHeader. Packet too short.";
            return false;
        }

        $this->start2   = $data_header[3];
        $this->control  = $data_header[4];
        $this->address  = $data_header[5];
        $this->control_information = $data_header[6];
        $this->checksum = $data_all[count($data_all)-2];
        $this->stop     = $data_all[count($data_all)-1];

        if (count($data_all) == 7) {
            $frame_type = mbus_defs::$MBUS_FRAME_TYPE_CONTROL;
            $this->results['error'] = "parseLongFrameTypeHeader. Control frame not implemented.";
            return false;
        } else {
            $frame_type = mbus_defs::$MBUS_FRAME_TYPE_LONG;
        }

        /**
         * Calcuate checksum
         */
        $calculated_checksum = $this->control;
        $calculated_checksum += $this->address;
        $calculated_checksum += $this->control_information;

        for ($i = 7; $i < count($data_all) - 2; $i++) {
            $calculated_checksum += $data_all[$i];
            $calculated_checksum = $calculated_checksum % 256;
        }

        if ( $this->checksum != $calculated_checksum ) {
            $this->results['error'] = "parseLongFrameTypeHeader. Checksums do not match.";
            return false;
        }

        /**
         * Do some more checks.
         */
        if(dechex($this->start1) != mbus_defs::$MBUS_FRAME_CONTROL_START) {
            $this->results['error'] = "parseLongFrameTypeHeader. Invalid start1 frame code.";
            return false;
        }

        if(dechex($this->start2) != mbus_defs::$MBUS_FRAME_CONTROL_START) {
            $this->results['error'] = "parseLongFrameTypeHeader. Invalid start2 frame code.";
            return false;
        }

        /**
         * Data length is the array length minus 6.
         * It is 6 because of the first four bytes (start1, length1, start2 and length2) and
         * the last two bytes (checksum and stop byte) are not counted.
         */
        if($this->length1 != (count($data_all) - 6)) {
            $this->results['error'] = "parseLongFrameTypeHeader. Total packet length not matching.";
            return false;
        }
        return true;
    }


    /**
     *  6.3.1 Variable 'Fixed' Data Header
     *
     *  $data[7 - 18]
     *  |=============================================================================|
     *  | Ident. Nr.   | Manufr. | Version | Medium | Access No. | Status | Signature |
     *  | 4 Byte (BCD) | 2 Byte  | 1 Byte  | 1 Byte | 1 Byte     | 1 Byte | 2 Byte    |
     *  |=============================================================================|
     *
     *  Ident.Nr    [7-10]  \x86\x78\x01\x10
     *  Manufr.     [11-12] \x77\x04
     *  Version     [13]    \x14
     *  Medium      [14]    \x07
     *  Access No.  [15]    \xad
     *  Status      [16]    \x00
     *  Signature   [17-18] \x00\x00
     */
    private function getSlaveInformation($fixed_header_data) {
        if(count($fixed_header_data) != 12)
            return false;
        /**
         * Identity Number
         * Byte [7-10]
         * Translate 4 Byte BCD.
         * http://en.wikipedia.org/wiki/Binary-coded_decimal
         */
        $this->varheader['id'] = (($fixed_header_data[3] & 0xF0) >> 4) . ($fixed_header_data[3] & 0x0F);
        $this->varheader['id'] .= (($fixed_header_data[2] & 0xF0) >> 4) . ($fixed_header_data[2] & 0x0F);
        $this->varheader['id'] .= (($fixed_header_data[1] & 0xF0) >> 4) . ($fixed_header_data[1] & 0x0F);
        $this->varheader['id'] .= (($fixed_header_data[0] & 0xF0) >> 4) . ($fixed_header_data[0] & 0x0F);

        /**
         * Manufacturer
         * Byte [11-12]
         * Ascii encoding using IEC 61107.
         * http://en.wikipedia.org/wiki/Smart_meter
         */
        // https://www.m-bus.de/man.html
        $manByte1PlusByte2 = $fixed_header_data[4] + ($fixed_header_data[5] << 8);
        $this->varheader['manufacturer'] = chr(($manByte1PlusByte2 >> 10 & 0x001F) + 64) . chr(($manByte1PlusByte2 >> 5 & 0x001F) + 64) . chr(($manByte1PlusByte2 & 0x001F) + 64);

        /**
         * Version
         * Byte [13]
         */
        $this->varheader['version'] = $fixed_header_data[6];

        /**
         * Medium
         * Byte [14]
         */
        $this->varheader['medium'] = mbus_utils::getMedium(dechex($fixed_header_data[7]));

        /**
         * Access No.
         * Byte [15]
         */
        $this->varheader['access_number'] = $fixed_header_data[8];

        /**
         * Status
         * Byte [16]
         */
        $this->varheader['status'] = $fixed_header_data[9];

        /**
         * Signature - Reserved For Future
         * Byte [17]
         */
        $this->varheader['signature'] = $fixed_header_data[10] + ($fixed_header_data[11] << 8);

        return true;
    }

    /*
        6.3.2 Variable Data Blocks
        In the code watch for special cases such as where the VIF = 7C indicating units in the data (not just value).
        These are explained in the spec, but are not very obvious!

        First DIF   [19]    \x0c
        \x78\x86\x78\x01\x10\x0d\x7c\x08\x44
        \x49\x20\x2e\x74\x73\x75\x63\x0a\x30\x30\x30\x30\x30\x30\x30\x30\x30\x30\x04\x6d\x08\x09\x76\x1a\x02\x7c\x09\x65\x6d
        \x69\x74\x20\x2e\x74\x61\x62\x8b\x0f\x04\x13\x01\x00\x00\x00\x04\x93\x7f\x00\x00\x00\x00\x44\x13\x01\x00\x00\x00\x0f
        \x00\x02\x1f


    Documentation is under heading Variable Data Structure in section 6.3 of specification.


    |========|====================|========|========================|===========|
    | DIF    | DIFE               | VIF    | VIFE                   | Data      |
    | 1 Byte | 0-10 (1 Byte each) | 1 Byte | 0-10 (1 Byte each)     | 0-N Byte  |
    |========|====================|========|========================|===========|
    | Data Information Block (DIB)| Value Information Block (VIB)   |
    |=============================|=================================|
    |                 Data Record Header   DRH                      |
    |===============================================================|

    DIF - Data Information Format
    |========================================================|
    | Bit 7      |   6     |  5   4    |  3    2    1    0   |
    | Extension  | LSB of  |  Function |  Data Field:        |
    | Bit        | storage |  Field    |  Length and coding  |
    |            | number  |           |  of data            |
    |========================================================|

    DIFE - Data Information Format Extension
    |========================================================|
    | Bit 7      |   6     |  5   4    |  3    2    1    0   |
    | Extension  | (Device)|  Tariff   |  Storage Number     |
    | Bit        | Unit    |           |                     |
    |========================================================|

    VIF - Value Information Field
    |========================================================|
    | Bit 7      |   6        5   4       3    2    1    0   |
    | Extension  | Unit and Multiplier (value)               |
    | Bit        |                                           |
    |========================================================|

    */


    private static function incr_buf(&$i, $i_len){
        $i++;
        if($i >= $i_len)
            throw new EndOfBufferExeption('Buffer too short');
    }

    private function parseVariableData($data_frame, $is_headers_only, $data_payload_optional = []) {
        $i = 0;
        $record_num = 0;
        $data_len = count($data_frame);

        $results_top = &$this->results_datarec;

        if($data_len == 0)
        {
            $results_top = 'no data';
            return true;
        }

        while ($i < $data_len) {

            $record_num++;
            $dif = $data_frame[$i];

            // skip idle fillers before DIF
            while ($dif == 0x2F)
            {
                $i++;
                if($i >= $data_len)
                    return true; // work with empty fillers in the end too
                $dif = $data_frame[$i];
            }

            $this_record = &$results_top[$record_num];
            $start_byte_pos = $i;

            $record_data_len = $dif & 0x07;

            // DIF Real (float) length has to be corrected
            if(($dif & 0xf) == 0x5)
                $record_data_len = 4;

#            if ( $record_data_len == 0 ) {
#                //mbus_utils::mylog("0x20 indicates no data, skip reading VIF.");
#                mbus_frame::incr_buf($i, $data_len);
#                unset($this->varrecords[$record_num]); // Clear any data from the record.
#                $record_num--;
#                continue;
#            }

            $storage_num = ($dif >> 6) & 0x1;

            /**
             * The manufacturer data header (MDH) is made up by the character 0Fh or 1Fh and indicates the beginning of the manufacturer
             * specific part of the user data and should be omitted, if there is no manufacturer specific data.
             */
            if (($dif == 0x0F) || ($dif == 0x1F)) {
                if (($dif & 0xFF) == 0x1F) {
                    $this_record["value_type"] = "manufacturer data, more to follow";
                } else {
                    $this_record["value_type"] = "manufacturer data";
                }

                mbus_frame::incr_buf($i, $data_len);
                // Just copy the remaining data as it is vendor specific
                while ($i < $data_len) {
//                    $this_record['_data_raw'] .= mbus_utils::ByteToHex($data_frame[$i]);
                    $this_record['value'] .= mbus_utils::ByteToHex($data_frame[$i]);
#                    mbus_frame::incr_buf($i, $data_len);
                    $i++; // Increment byte pointer. not using incr_buf because it has to end at some point without exception
                }
                return true;
            }
            if ($dif == 0x7F) {
                $results_top['error'] .= "Errror. Global readout request not meant as a packet from slave.\n";
                return false;
            }

            // DIFE
            // If bit 8 is set then this means there is another DIFE to come.
            $dife_count = 0;
            $tariff_number = 0;
            while (($data_frame[$i] & 0x80) == 0x80) {
                mbus_frame::incr_buf($i, $data_len);
                $dife = $data_frame[$i];
                $dife_count++;

                $storage_num |= ($dife & 0x0F) << ($dife_count * 4 - 3);
                $tariff_number |= (($dife >> 4) & 0x3) << ($dife_count * 2 - 2);

                if($dife_count > 10){
                    $results_top['error'] = "parseVariableData. Found more than 10 DIFE's.";
                    return false;
                }
            }

            if($storage_num > 0){
                $this_record['storage_num'] = $storage_num;
            }
            if($dife_count > 0){
                $this_record['_tariff'] = $tariff_number;
            }

            // VIF (Value Information Block)
            mbus_frame::incr_buf($i, $data_len);
            $vif = $data_frame[$i];

            // VIFE
            $vife_count = 0;
            $vife_first = 0;
            while (($data_frame[$i] & 0x80) == 0x80) { // loop actually starts from vif, because vif itself must have extended bit
                $vife_count++;
                mbus_frame::incr_buf($i, $data_len);
                if($vife_count == 1)
                {
                    $vife_first = $data_frame[$i];
                }
                if($vife_count > 10){
                    $results_top['error'] = "parseVariableData. Found more than 10 VIFE's.";
                    return false;
                }
            }

            $this_record["_function"] = mbus_utils::getFunctionField(($dif & 0x30) >> 4);
            $vif_function_str = mbus_utils::getFunctionFieldShort(($dif & 0x30) >> 4);

            $plain_text_vif = false;

            $is_date_time = false;
            mbus_utils::vib_unit_lookup($vif, $vife_first, $this_record, $plain_text_vif, $is_date_time);

            if ($plain_text_vif) {
                // First byte of data is length.
                mbus_frame::incr_buf($i, $data_len);
                $plain_text_len = $data_frame[$i];

                $plain_text_data = [];
                for ($j = 0; $j < $plain_text_len; $j++) {
                    mbus_frame::incr_buf($i, $data_len);
                    $plain_text_data[] = $data_frame[$i];
                }

                $the_unit = mbus_utils::data_str_decode($plain_text_data);
                $this_record["value_type"] = "plain text unit: ".$the_unit;
                $this_record["unit"] = $the_unit;
            }

            // format vif function (min, max, during error) to beginning of value_type
            if(array_key_exists("value_type", $this_record)) {
                $this_record["value_type"] = $vif_function_str . $this_record["value_type"];
                /*
                                if(array_key_exists("_storage_num", $this_record))
                                {
                                    if($this_record['_storage_num'] == 1)
                                        $this_record["value_type"] = "last monthly? log of ". $this_record["value_type"];
                                    else if($this_record['_storage_num'] == 2)
                                        $this_record["value_type"] = "last daily? log of ". $this_record["value_type"];
                                    else
                                        $this_record["value_type"] = "log of ". $this_record["value_type"];
                                }
                */
            }

            $this_record['_encoding'] = mbus_utils::getDataFieldType($dif);

            // If Variable Length data field, then need to determine the length. LVAR
            if(($dif & 0x0F) == 0x0D) {
                mbus_frame::incr_buf($i, $data_len); // lvar is part of header, not payload, so incr the payload
                $lvar = $data_frame[$i];
                if($lvar <= 0xBF) { // Variable ASCII string
                    $record_data_len = $data_frame[$i];
                    // Note that 0x0A is a newline ascii character and it seems to be after the characters but not included in the length!
                    if ($data_frame[$i + $record_data_len] == 0x0A) {
                        $record_data_len += 1;
                    }
                    $this_record['_encoding'] = 'variable ASCII string';
                } else if($lvar >= 0xC0 && $lvar <= 0xCF) { // Variable Postive BCD
                    $record_data_len = $lvar - 0xC0;
                    $this_record['_encoding'] = 'variable postive BCD';
                } else if($lvar >= 0xD0 && $lvar <= 0xDF) { // Variable Negative BCD
                    $record_data_len = $lvar - 0xD0;
                    $this_record['_encoding'] = 'variable negative BCD';
                } else if($lvar >= 0xE0 && $lvar <= 0xEF) { // Variable Binary
                    $record_data_len = $lvar - 0xE0;
                    $this_record['_encoding'] = 'variable binary (integer)';
                } else if($lvar >= 0xF0 && $lvar <= 0xFA) { // Variable Floating Point
                    $record_data_len = $lvar - 0xF0;
                    $this_record['_encoding'] = 'variable floating point';
                }
            }

            // copy header buffer
            $header_end = $i;

            for ($j = $start_byte_pos; $j <= $header_end; $j++) {
                @$this_record['_header_raw'] .= mbus_utils::ByteToHex($data_frame[$j]);
            }

            if( !array_key_exists("value_type", $this_record))
                $this_record['value_type'] = 'unknown value type';

            // if payload consists only of headers, skip data part treatment
            if($is_headers_only)
            {
                $i++; // set the index ready for next data_record
                continue;
            }

            // copy the raw data, since the length is known by now
            $data_raw = [];
            if(count($data_payload_optional)) // for wmbus compact frames where only payload is send and header comes from every 8-th full packet
            {
                static $i_data = 0;
                if (count($data_payload_optional) < ($i_data + $record_data_len))
                    throw new EndOfBufferExeption('Secondary buffer too short');

                for ($j = 0; $j < $record_data_len; $j++) {
                    $data_raw[] = @$data_payload_optional[$i_data];
                    @$this_record['_data_raw'] .= mbus_utils::ByteToHex($data_payload_optional[$i_data]);
                    $i_data++;
                }
            }
            else // regular case, where data is in the same buffer with headers
            {
                for ($j = 0; $j < $record_data_len; $j++) {
                    mbus_frame::incr_buf($i, $data_len);
                    $data_raw[] = @$data_frame[$i];
                    @$this_record['_data_raw'] .= mbus_utils::ByteToHex($data_frame[$i]);
                }
            }

            @$this_record['value'] = mbus_utils::getValue($dif, $vif, $data_raw, $is_date_time);

            // Apply exponent to the value
            if(array_key_exists("_exp", $this_record) and is_numeric($this_record['value']) and ($this_record['_exp'] != 0))
            {
                $this_record['_value_raw'] = $this_record['value'];
                $exp = $this_record['_exp'];
                $multiplier = 1;
                for($ec = 0; $ec < abs($exp); $ec++){
                    $multiplier *= 10;
                }
                if($exp < 0){
                    $multiplier = 1.0 / $multiplier;
                    $this_record['value'] = $this_record['value'] * $multiplier;
                }
                else{
                    $this_record['value'] *= $multiplier;
                }
            }
            $i++; // set the index ready for next data_record
        }
        return true;
    }
}