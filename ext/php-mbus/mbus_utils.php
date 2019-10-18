<?php

/**
 * Class mbus_utils
 */
class mbus_utils {

    private static $log_to_terminal = true;
    private static $log_turned_on = true;

    // View Browser in Source mode to get nice formatting.
    public static function logToTerminal($toTerminal = true) {
        mbus_utils::$log_to_terminal = $toTerminal;
    }
    public static function logToBrowser($toTerminal = false) {
        mbus_utils::$log_to_terminal = $toTerminal;
    }
    public static function turnLogOff() {
        mbus_utils::$log_turned_on = false;
    }

    public static function mylog($message) {
        if ( mbus_utils::$log_turned_on ) {
            if ( mbus_utils::$log_to_terminal ) {
                // Use \n as line delimiter for a terminal
                echo "\n" . date("c") . " - " . $message;
            } else {
                // Use <br> as a line delimieter for web browser.
                echo "<br>" . date("c") . " - " . $message;
            }
        }
    }

    /**
     * IMPORTANT: Values are stored in the array as decimal.
     *            E.g. Hex 0x68 is stored and returned as 104.
     *            Use isDecEqualToHex to compare values or see an example.
     */
    public static function byteStr2byteArray($s) {
        return array_values(unpack("C*", hex2bin($s)));
#        $string = hex2bin($s);
#         return unpack(‘C*’, $string);
#            return array_slice(unpack("C*", $s), 1);
    }

    /**
     * Can be used to compare values returned from the array in byteStr2byteArray to a hex value.
     * Usage:
     *   mbus_utils::isDecEqualToHex("104", "68"); // Returns true.
     */
    public static function isDecEqualToHex($decbyte, $test) {
        mbus_utils::mylog("Comparing [" . dechex($decbyte) . "] with [" . $test . "]");
        return (dechex($decbyte) == $test);
    }

    public static function byteArray2byteStr(array $t) {
        return call_user_func_array(pack, array_merge(array("C*"), $t));
    }
    public static function lsbStr2ushortArray($s) {
        return array_slice(unpack("v*", "\0\0".$s), 1);
    }
    public static function ushortArray2lsbStr(array $t) {
        return call_user_func_array(pack, array_merge(array("v*"), $t));
    }
    public static function lsbStr2ulongArray($s) {
        return array_slice(unpack("V*", "\0\0\0\0".$s), 1);
    }
    public static function ulongArray2lsbStr(array $t) {
        return call_user_func_array(pack, array_merge(array("V*"), $t));
    }
    public static function outputByteString($byteString) {
        //echo "\n\n[" . mbus_utils::returnByteString($byteString) . "]\n";
        mbus_utils::mylog(mbus_utils::returnByteString2($byteString));
    }

    public static function returnByteString($byteString) {
        $out = "";
        $byteArr = mbus_utils::byteStr2byteArray($byteString);
        foreach( $byteArr as $byte ) {
            //$out .= "\\x";

            if ( intval($byte) < 16 ) {
                $out .= "0";
            }
            $out .= dechex($byte) . " ";
        }
        return strtoupper($out);
    }

    public static function returnByteString2($byteString) {
        $out = "\n" . str_pad("", 30) . "       0  1  2  3  4  5  6  7  8  9";
        $out .= "\n" . str_pad("", 30) . "       -----------------------------";
        $out .= "\n" . str_pad("", 30) . " 0  |  ";
        $byteArr = mbus_utils::byteStr2byteArray($byteString);
        $i = 1;
        foreach( $byteArr as $key => $byte ) {
            //$out .= "\\x";

            //$out .= "k" . $key . " ";
            if ( intval($byte) < 16 ) {
                $out .= "0";
            }
            $out .= dechex($byte) . " ";
            if ( $i % 10 == 0 ) {

                $out .= "\n" . str_pad("", 30) . ($i) . "  |  ";
            }
            $i++;
        }

        return strtoupper($out);
    }

    public static function getMedium($medium)
    {
        switch ($medium)
        {
            case mbus_defs::$MBUS_VARIABLE_DATA_MEDIUM_OTHER:
                return "other";
                break;

            case mbus_defs::$MBUS_VARIABLE_DATA_MEDIUM_OIL:
                return "oil";
                break;

            case mbus_defs::$MBUS_VARIABLE_DATA_MEDIUM_ELECTRICITY:
                return "electricity";
                break;

            case mbus_defs::$MBUS_VARIABLE_DATA_MEDIUM_GAS:
                return "gas";
                break;

            case mbus_defs::$MBUS_VARIABLE_DATA_MEDIUM_HEAT:
                return "heat";
                break;

            case mbus_defs::$MBUS_VARIABLE_DATA_MEDIUM_STEAM:
                return "steam";
                break;

            case mbus_defs::$MBUS_VARIABLE_DATA_MEDIUM_HOT_WATER:
                return "hot water";
                break;

            case mbus_defs::$MBUS_VARIABLE_DATA_MEDIUM_WATER:
                return "water";
                break;

            case mbus_defs::$MBUS_VARIABLE_DATA_MEDIUM_HEAT_COST:
                return "heat Cost Allocator";
                break;

            case mbus_defs::$MBUS_VARIABLE_DATA_MEDIUM_COMPR_AIR:
                return "compressed Air";
                break;

            case mbus_defs::$MBUS_VARIABLE_DATA_MEDIUM_COOL_OUT:
                return "cooling load meter: Outlet";
                break;

            case mbus_defs::$MBUS_VARIABLE_DATA_MEDIUM_COOL_IN:
                return "cooling load meter: Inlet";
                break;

            case mbus_defs::$MBUS_VARIABLE_DATA_MEDIUM_BUS:
                return "bus/system";
                break;

            case mbus_defs::$MBUS_VARIABLE_DATA_MEDIUM_COLD_WATER:
                return "cold water";
                break;

            case mbus_defs::$MBUS_VARIABLE_DATA_MEDIUM_DUAL_WATER:
                return "dual water";
                break;

            case mbus_defs::$MBUS_VARIABLE_DATA_MEDIUM_PRESSURE:
                return "pressure";
                break;

            case mbus_defs::$MBUS_VARIABLE_DATA_MEDIUM_ADC:
                return "A/D Converter";
                break;

            case 0x0C:
                return "heat (Volume measured at flow temperature: inlet)";
                break;

            case 0x20: // - 0xFF
                return "reserved";
                break;


            // add more ...
            default:
                return "unknown medium " . $medium;
                break;
        }

        return buff;
    }

    /**
     * Pass in the decimal value and returns a string containing the function description.
     *
     * 6.3 Variable Data Structure
     *
     * |=======================================|
     * | Dec | Bin  | Description              |
     * | 0   | 00b  | Instantaneous value      |
     * | 2   | 10b  | Minimum value            |
     * | 1   | 01b  | Maximum value            |
     * | 3   | 11b  | Value during error state |
     * |=======================================|
     */
    public static function getFunctionField($decimal)
    {
        switch ($decimal)
        {
            case 0:
                return "instant value";
                break;

            case 1:
                return "maximum value";
                break;

            case 2:
                return "minimum value";
                break;

            case 3:
                return "value during error state";
                break;

            default:
                return "unknown";
        }
    }

    public static function getFunctionFieldShort($decimal)
    {
        switch ($decimal)
        {
            case 0:
                return "";
                break;

            case 1:
                return "(maximum) ";
                break;

            case 2:
                return "(minimum) ";
                break;

            case 3:
                return "(during error) ";
                break;

            default:
                return "";
        }
    }


    /**
     * Lookup the unit from the VIB (VIF or VIFE)
     */
    public static function vib_unit_lookup($vif, $vife_first, &$record, &$plain_text_vif) {

        if ($vif == 0xFD) // first type of VIF extention: see table 8.4.4a
        {

            if ($vife_first == 0x0B)
            {
                // VIFE = E000 1011 Parameter set identification
                $record["value_type"] = "parameter set identification";
                return;
            }
            else if ($vife_first == 0x0C)
            {
                // E000 1100 Model / Version
                $record["value_type"] = "model / version";
                return;
            }
            else if ($vife_first == 0x10)
            {
                // VIFE = E001 0000 Customer location
                $record["value_type"] = "customer location";
                return;
            }
            else if ($vife_first == 0x11)
            {
                // VIFE = E001 0001 Customer
                $record["value_type"] = "customer";
                return;
            }
            else if ($vife_first == 0x16)
            {
                // VIFE = E001 0110 Password
                $record["value_type"] = "password";
                return;
            }
            else if ($vife_first == 0x17)
            {
                // VIFE = E001 0111 Error flags
                $record["value_type"] = "error flags (binary)";
                return;
            }
            else if (($vife_first & 0x70) == 0x40)
            {
                // VIFE = E100 nnnn 10^(nnnn-9) V
                $n = ($vife_first & 0x0F);
                $record["value_type"] = "voltage";
                $record["unit"] = " V";
                $record["_exp"] = $n-9;
                return;
            }
            else if (($vife_first & 0x70) == 0x50)
            {
                // VIFE = E101 nnnn 10nnnn-12 A
                $n = ($vife_first & 0x0F);
                $record["value_type"] = "electrical current";
                $record["unit"] = " A";
                $record["_exp"] = $n-12;
                return;
            }
            else if (($vife_first & 0xF0) == 0x70)
            {
                // VIFE = E111 nnn Reserved
                $record["value_type"] = "reserved VIF extension";
                return;
            }
            else
            {
                $record["value_type"] = "unrecongized VIF extension " . sprintf("0x%02X", $vife_first);
                return;
            }
            return;
        }
        if($vif == 0xFB) // first type of VIF extention: see table 8.4.4b
        {
            return;
        }

        return mbus_utils::vif_unit_lookup_record($vif, $record, $plain_text_vif); // no extention, use VIF
    }


    /**
     * Look up the unit from a VIF field in the data record.
     *
     * See section 8.4.3  Codes for Value Information Field (VIF) in the M-BUS spec
     */
    public static function vif_unit_lookup_record($vif, &$record, &$plain_text_vif)
    {
        $vifNoExt = $vif & 0x7F;
        switch ($vifNoExt) // ignore the extension bit in this selection
        {
            // E000 0nnn Energy 10(nnn-3) W
            case ($vifNoExt >= 0x00 && $vifNoExt <= 0x07):
                $n = ($vif & 0x07) - 3;
                $record["value_type"] = "energy";
                $record["unit"] = " Wh";
                $record["_exp"] = $n;
                break;

            // 0000 1nnn          Energy       10(nnn)J     (0.001kJ to 10000kJ)
            case ($vifNoExt >= 0x08 && $vifNoExt <= 0x0F):
                $n = ($vif & 0x07);
                $record["value_type"] = "energy";
                $record["unit"] = " J";
                $record["_exp"] = $n;
                break;

            // E001 1nnn Mass 10(nnn-3) kg 0.001kg to 10000kg
            case ($vifNoExt >= 0x18 && $vifNoExt <= 0x1F):
                $n = ($vif & 0x07);
                $record["value_type"] = "mass";
                $record["unit"] = " kg";
                $record["_exp"] = $n-3;
                break;

            // E010 1nnn Power 10(nnn-3) W 0.001W to 10000W
            case ($vifNoExt >= 0x28 && $vifNoExt <= 0x2F):
                $n = ($vif & 0x07);
                $record["value_type"] = "power";
                $record["unit"] = " W";
                $record["_exp"] = $n-3;
                break;

            // E011 0nnn Power 10(nnn) J/h 0.001kJ/h to 10000kJ/h
            case ($vifNoExt >= 0x30 && $vifNoExt <= 0x37):
                $n = ($vif & 0x07);
                $record["value_type"] = "power";
                $record["unit"] = " J/h";
                $record["_exp"] = $n;
                break;

            // E001 0nnn Volume 10(nnn-6) m3 0.001l to 10000l
            case ($vifNoExt >= 0x10 && $vifNoExt <= 0x17):
                $n = ($vif & 0x07);
                $record["value_type"] = "volume";
                $record["unit"] = " m³";
                $record["_exp"] = $n-6;
                break;

            // E011 1nnn Volume Flow 10(nnn-6) m3/h 0.001l/h to 10000l/
            case ($vifNoExt >= 0x38 && $vifNoExt <= 0x3F):
                $n = ($vif & 0x07);
                $record["value_type"] = "volume flow";
                $record["unit"] = " m³/h";
                $record["_exp"] = $n-6;
                break;

            // E100 0nnn Volume Flow ext. 10(nnn-7) m3/min 0.0001l/min to 1000l/min
            case ($vifNoExt >= 0x40 && $vifNoExt <= 0x47):
                $n = ($vif & 0x07);
                $record["value_type"] = "volume flow";
                $record["unit"] = " m³/min";
                $record["_exp"] = $n-7;
                break;

            // E100 1nnn Volume Flow ext. 10(nnn-9) m3/s 0.001ml/s to 10000ml/
            case ($vifNoExt >= 0x48 && $vifNoExt <= 0x4F):
                $n = ($vif & 0x07);
                $record["value_type"] = "volume flow";
                $record["unit"] = " m³/s";
                $record["_exp"] = $n-9;
                break;

            // E101 0nnn Mass flow 10(nnn-3) kg/h 0.001kg/h to 10000kg/h
            case ($vifNoExt >= 0x50 && $vifNoExt <= 0x57):
                $n = ($vif & 0x07);
                $record["value_type"] = "mass flow";
                $record["unit"] = " kg/h";
                $record["_exp"] = $n-3;
                break;

            // E101 10nn Flow Temperature 10(nn-3) °C 0.001°C to 1°C
            case ($vifNoExt >= 0x58 && $vifNoExt <= 0x5B):
                $n = ($vif & 0x03);
                $record["value_type"] = "flow temperature";
                $record["unit"] = "°C";
                $record["_exp"] = $n-3;
                break;

            // E101 11nn Return Temperature 10(nn-3) °C 0.001°C to 1°C
            case ($vifNoExt >= 0x5C && $vifNoExt <= 0x5F):
                $n = ($vif & 0x03);
                $record["value_type"] = "return temperature";
                $record["unit"] = "°C";
                $record["_exp"] = $n-3;
                break;


            // E110 10nn Pressure 10(nn-3) bar 1mbar to 1000mbar
            case ($vifNoExt >= 0x68 && $vifNoExt <= 0x6B):
                $n = ($vif & 0x03);
                $record["value_type"] = "pressure";
                $record["unit"] = " bar";
                $record["_exp"] = $n-3;
                break;

            // E010 00nn On Time
            // nn = 00 seconds
            // nn = 01 minutes
            // nn = 10   hours
            // nn = 11    days
            // E010 01nn Operating Time coded like OnTime
            case ($vifNoExt >= 0x20 && $vifNoExt <= 0x23):
            case ($vifNoExt >= 0x24 && $vifNoExt <= 0x27):
            case ($vifNoExt >= 0x70 && $vifNoExt <= 0x73):
            case ($vifNoExt >= 0x74 && $vifNoExt <= 0x77):
                {
                    if (($vif & 0x7c) == 0x20)
                        $record["value_type"] = "operating time";
                    else if (($vif & 0x7c) == 0x24)
                        $record["value_type"] = "on time";
                    else if (($vif & 0x7c) == 0x70)
                        $record["value_type"] = "averaging duration";
                    else if (($vif & 0x7c) == 0x74)
                        $record["value_type"] = "actuality duration";

                    switch ($vif & 0x03)
                    {
                        case 0x00:
                            $record["value_type"] .= " (in seconds)";
                            $record["unit"] = " s";
                            break;
                        case 0x01:
                            $record["value_type"] .= " (in minutes)";
                            $record["unit"] = " min";
                            break;
                        case 0x02:
                            $record["value_type"] .= " (in hours)";
                            $record["unit"] = " h";
                            break;
                        case 0x03:
                            $record["value_type"] .= " (in days)";
                            $record["unit"] = " d";
                            break;
                    }
                }
                break;

            // E110 110n Time Point
            // n = 0        date
            // n = 1 time & date
            // data type G
            // data type F
            case ($vifNoExt >= 0x6C && $vifNoExt <= 0x6D):
                if ($vif & 0x1)
                    $record["value_type"] = "time point (time & date)";
                else
                    $record["value_type"] = "time point (date)";
                break;

            // E110 00nn    Temperature Difference   10(nn-3)K   (mK to  K)
            case ($vifNoExt >= 0x60 && $vifNoExt <= 0x63):
                $n = ($vif & 0x03);
                $record["value_type"] = "temperature difference";
                $record["unit"] = "°C";
                $record["_exp"] = $n-3;
                break;

            // E110 01nn External Temperature 10(nn-3) °C 0.001°C to 1°C
            case ($vifNoExt >= 0x64 && $vifNoExt <= 0x67):
                $n = ($vif & 0x03);
                $record["value_type"] = "external temperature";
                $record["unit"] = "°C";
                $record["_exp"] = $n-3;
                break;

            // E110 1110 Units for H.C.A. dimensionless
            case 0x6E:
                $record["value_type"] = "units for H.C.A.";
                break;

            case 0x6F:
                $record["value_type"] = "reserved";
                break;

            case 0x78:
                $record["value_type"] = "fabrication number";
                break;

            case 0x7C:
                $record["value_type"] = "plain text";
                $plain_text_vif = true;
                break;

            case 0x7F:
            case 0xFF:
                $record["value_type"] = "manufacturer specific";
                break;

            default:
                $record["value_type"] = sprintf('unknown VIF (0x%02X)', $vif);
                break;
        }
    }




    public static function vife_unit_lookup_record($vif, $vife, &$record, &$is_datetime)
    {
        $is_datetime = false;
        $vifeNoExt = ($vife & 0x7F);
        switch ($vifeNoExt) // ignore the extension bit in this selection
        {
            case 0x20:
                $record["value_type"] .= " per second";
                $record["unit"] .= "/s";
                break;
            case 0x21:
                $record["value_type"] .= " per minute";
                $record["unit"] .= "/min";
                break;
            case 0x22:
                $record["value_type"] .= " per hour";
                $record["unit"] .= "/hour";
                break;
            case 0x23:
                $record["value_type"] .= " per day";
                $record["unit"] .= "/day";
                break;
            case 0x24:
                $record["value_type"] .= " per week";
                $record["unit"] .= "/week";
                break;
            case 0x25:
                $record["value_type"] .= " per month";
                $record["unit"] .= "/mon";
                break;
            case 0x26:
                $record["value_type"] .= " per year";
                $record["unit"] .= "/yr";
                break;
            case 0x27:
                $record["value_type"] .= " per revolution or measurement";
                $record["unit"] .= "/rev";
                break;
            case 0x28:
                $record["value_type"] .= " increment per pulse on input ch 0";
                $record["unit"] .= "/pulse";
                break;
            case 0x29:
                $record["value_type"] .= " increment per pulse on input ch 1";
                $record["unit"] .= "/pulse";
                break;
            case 0x2A:
                $record["value_type"] .= " increment per pulse on output ch 0";
                $record["unit"] .= "/pulse";
                break;
            case 0x2B:
                $record["value_type"] .= " increment per pulse on output ch 1";
                $record["unit"] .= "/pulse";
                break;
            case 0x2C:
                $record["value_type"] .= " per liter";
                $record["unit"] .= "/l";
                break;
            case 0x2D:
                $record["value_type"] .= " per m³";
                $record["unit"] .= "/m³";
                break;
            case 0x2E:
                $record["value_type"] .= " per kg";
                $record["unit"] .= "/kg";
                break;
            case 0x2F:
                $record["value_type"] .= " per Kelvin";
                $record["unit"] .= "/K";
                break;
            case 0x30:
                $record["value_type"] .= " per kWh";
                $record["unit"] .= "/kWh";
                break;
            case 0x31:
                $record["value_type"] .= " per GJ";
                $record["unit"] .= "/GJ";
                break;
            case 0x32:
                $record["value_type"] .= " per kW";
                $record["unit"] .= "/kW";
                break;
            case 0x33:
                $record["value_type"] .= " per (Kelvin*Liter)";
                $record["unit"] .= "/(K*l)";
                break;
            case 0x34:
                $record["value_type"] .= " per Volt";
                $record["unit"] .= "/V";
                break;
            case 0x35:
                $record["value_type"] .= " per Ampere";
                $record["unit"] .= "/A";
                break;
            case 0x36:
                $record["value_type"] .= " multiplied by sec";
                $record["unit"] .= "*s";
                break;
            case 0x37:
                $record["value_type"] .= " multiplied by sec over Volt";
                $record["unit"] .= "*s/V";
                break;
            case 0x38:
                $record["value_type"] .= " multiplied by sec over Ampere";
                $record["unit"] .= "*s/A";
                break;
            case 0x39:
                $record["value_type"] = "start date-time of ".$record["value_type"];
                $is_datetime = true;
                if(array_key_exists("unit", $record))
                    unset($record["unit"]);
                if(array_key_exists("_exp", $record))
                    unset($record["_exp"]);
            case 0x3A:
                $record["value_type"] = "uncorrected ".$record["value_type"];
                break;
            case 0x3B:
                $record["value_type"] .= ", accumulated if positive";
                break;
            case 0x3C:
                $record["value_type"] .= ", accumulated abs value if negative";
                break;
            case 0x40:
                $record["value_type"] .= ", lower limit value";
                break;
            case 0x48:
                $record["value_type"] .= ", upper limit value";
                break;
            case 0x41:
                $record["value_type"] = "number of lower limit exceeds of ".$record["value_type"];
                if(array_key_exists("unit", $record))
                    unset($record["unit"]);
                if(array_key_exists("_exp", $record))
                    unset($record["_exp"]);
                break;
            case 0x49:
                $record["value_type"] = "number of upper limit exceeds of ".$record["value_type"];
                if(array_key_exists("unit", $record))
                    unset($record["unit"]);
                if(array_key_exists("_exp", $record))
                    unset($record["_exp"]);
                break;
            case 0b1000010: // 0x42
            case 0b1000011:
            case 0b1000110:
            case 0b1000111:
            case 0b1001010:
            case 0b1001011:
            case 0b1001110:
            case 0b1001111:
                $info = sprintf("date-time of %s of %s %s limit exceeded of ",
                    ($vifeNoExt & 0b1) ? "end" : "begin",
                    ($vifeNoExt & 0b100) ? "last" : "first",
                    ($vifeNoExt & 0b1000) ? "upper" : "lower");
                $record["value_type"] = $info . $record["value_type"];
                $is_datetime = true;
                if(array_key_exists("unit", $record))
                    unset($record["unit"]);
                if(array_key_exists("_exp", $record))
                    unset($record["_exp"]);
                break;
            case 0b1010000:
            case 0b1010001:
            case 0b1010100:
            case 0b1010101:
            case 0b1011000:
            case 0b1011001:
            case 0b1011100:
            case 0b1011101:
            case 0b1010010:
            case 0b1010011:
            case 0b1010110:
            case 0b1010111:
            case 0b1011010:
            case 0b1011011:
            case 0b1011110:
            case 0b1011111:
                $record["value_type"] .= sprintf(" %s %s limit exceeded for %d",
                    ($vifeNoExt & 0b100) ? "last" : "first",
                    ($vifeNoExt & 0b1000) ? "upper" : "lower",
                    ($vifeNoExt & 0b11));
                break;
            case 0b1100000: // 0x60
            case 0b1100001:
            case 0b1100010:
            case 0b1100011:
            case 0b1100100:
            case 0b1100101:
            case 0b1100110:
            case 0b1100111:
                $record["value_type"] .= sprintf(" %s limit exceeded for %d",
                    ($vifeNoExt & 0b100) ? "last" : "first",
                    ($vifeNoExt & 0b11));
                break;
            case 0b1101010: // 0x
            case 0b1101011:
            case 0b1101110:
            case 0b1101111:
                $info = sprintf("date-time of %s %s of ",
                    ($vifeNoExt & 0b100) ? "last" : "first",
                    ($vifeNoExt & 0b1) ? "end" : "begin");
                $record["value_type"] = $info . $record["value_type"];
                $is_datetime = true;
                if(array_key_exists("unit", $record))
                    unset($record["unit"]);
                if(array_key_exists("_exp", $record))
                    unset($record["_exp"]);
                break;
            case 0b1110000: // 0x
            case 0b1110001:
            case 0b1110010:
            case 0b1110011:
            case 0b1110100:
            case 0b1110101:
            case 0b1110110:
            case 0b1110111:
                $record["value_type"] .= sprintf(" (*10^%d)", $vifeNoExt & 0x7 - 6);
                $record["unit"] = sprintf("*10^%d ", $vifeNoExt & 0x7 - 6) . $record["unit"];
                $record["_exp"] += $vifeNoExt & 0x7 - 6;
                break;
            case 0b1111000: // 0x
            case 0b1111001:
            case 0b1111010:
            case 0b1111011:
                $record["value_type"] .= sprintf(" (+10^%d)", $vifeNoExt & 0x3 - 3);
                $record["unit"] = sprintf("+%d ", 10**($vifeNoExt & 0x3 - 3)) . $record["unit"];
                break;
            case 0b1111111:
                $record["value_type"] .= " + mfg specific data";
                break;
            default:
                break;
        }
        return;
    }






    /**
     *
     * Lookup the unit description from a VIF field in a data record
     *
     */
    public static function unit_prefix($exp)
    {
        switch ($exp)
        {
            case 0:
                return "";
                break;

            case -3:
                return "m";
                break;

            case -6:
                return "my";
                break;

            case 1:
                return "10 ";
                break;

            case 2:
                return "100 ";
                break;

            case 3:
                return "k";
                break;

            case 4:
                return "10 k";
                break;

            case 5:
                return "100 k";
                break;

            case 6:
                return "M";
                break;

            case 9:
                return "T";
                break;

            default:
                return "10^". $exp;
        }

        return "";
    }

    /**
     *
     * Lookup the unit description from a VIF field in a data record
     *
     */
    public static function getDataFieldType($dif)
    {
        //mbus_utils::mylog("Data field 6.3 - table 5 - binary [" . decbin($record_data_len) . "]");

        switch ($dif & 0x0F) {
            case 0:
                return 'no data';
                break;
            case 1:
                return '8 bit integer';
                break;
            case 2:
                return '16 bit integer';
                break;
            case 3:
                return '24 bit integer';
                break;
            case 4:
                return '32 bit integer';
                break;
            case 5:
                return '32 bit real';
                break;
            case 6:
                return '48 bit integer';
                break;
            case 7:
                return '64 bit integer';
                break;
            case 8:
                return 'selection for readout';
                break;
            case 9:
                return '2 digit BCD';
                break;
            case 10:
                return '4 digit BCD';
                break;
            case 11:
                return '6 digit BCD';
                break;
            case 12:
                return '8 digit BCD';
                break;
            case 13:
                return 'variable length';
                break;
            case 14:
                return '12 digit BCD';
                break;
            case 15:
                return 'special functions';
                break;
            default:
                return 'data type not in spec!!';
        }
    }


    //------------------------------------------------------------------------------
    // Decode data and write to string
    //
    // Data format (for record->data data array)
    //
    // Length in Bit   Code    Meaning           Code      Meaning
    //      0          0000    No data           1000      Selection for Readout
    //      8          0001     8 Bit Integer    1001      2 digit BCD
    //     16          0010    16 Bit Integer    1010      4 digit BCD
    //     24          0011    24 Bit Integer    1011      6 digit BCD
    //     32          0100    32 Bit Integer    1100      8 digit BCD
    //   32 / N        0101    32 Bit Real       1101      variable length
    //     48          0110    48 Bit Integer    1110      12 digit BCD
    //     64          0111    64 Bit Integer    1111      Special Functions
    //
    // The Code is stored in record->drh.dib.dif
    //
    ///
    /// Return a string containing the data
    ///
    // Source: MBDOC48.PDF
    //
    //------------------------------------------------------------------------------
    public static function getValue($dif, $vif, $data, $is_datetime) {

        if ( $vif != 0x00 ) {
            $vifNoExt = $vif & 0x7F;
            if($is_datetime || ($vifNoExt >= 0x6C && $vifNoExt <= 0x6D)){
                // E110 110n Time Point
                // n = 0        date
                // n = 1 time & date
                // data type G
                // data type F
                if ( count($data) != 4 && count($data) != 2 ) {
                    return "invalid number of bytes for time point!";
                }
                return mbus_utils::data_date_time_decode($data);
            }
        }

        switch ($dif & 0x0F)
        {
            case 0x00: // no data
                return "no data";
                break;

            case 0x01: // 1 byte integer (8 bit)
            case 0x02: // 2 byte integer (16 bit)
            case 0x03: // 3 byte integer (24 bit)
            case 0x04: // 4 byte integer (32 bit)
            case 0x06: // 6 byte integer (48 bit)
            case 0x07: // 8 byte integer (64 bit)
                return mbus_utils::data_int_decode($data);
                break;

            case 0x09: // 2 digit BCD (8 bit)
            case 0x0A: // 4 digit BCD (16 bit)
            case 0x0B: // 6 digit BCD (24 bit)
            case 0x0C: // 8 digit BCD (32 bit)
            case 0x0E: // 12 digit BCD
                return mbus_utils::data_bcd_decode($data);
                break;
            case 0x05: // 4 byte Real (float)
                return mbus_utils::data_float_decode($data);
                break;

            case 0x0E: // Special Functions
                return "special functions";
                break;

            case 0x0D: // variable length data
                $lvar = $data[0];
                unset($data[0]);
                if($lvar <= 0xBF) {
                    return mbus_utils::data_str_decode($data);
                    break;
                }
                if(($lvar >= 0xC0) && ($lvar >= 0xCF)) {
                    return mbus_utils::data_bcd_decode($data);
                    break;
                }
                if(($lvar >= 0xD0) && ($lvar >= 0xDF)) {
                    return -mbus_utils::data_bcd_decode($data);
                    break;
                }
                if(($lvar >= 0xE0) && ($lvar >= 0xEF)) {
                    return -mbus_utils::data_int_decode($data);
                    break;
                }
                if(($lvar >= 0xF0) && ($lvar >= 0xFA)) {
                    return sprintf('unknown DIF (0x%02X) - float', $dif);
                    break;
                }

            default:

                return sprintf('unknown DIF (0x%02X)', $dif);
                break;
        }

        return "";
    }

    /**
     * Decode Date Time data
     */
    public static function data_date_time_decode($data) {
        if(count($data) == 4){
            if(($data[0] == 0) and ($data[1] == 0) and ($data[2] == 0) and ($data[3] == 0)){
                return "";
            }
            $minute = $data[0] & 0x3F;
            $hour = $data[1] & 0x1F;
            $day = $data[2] & 0x1F;
            $month = $data[3] & 0x0F;
            $year = bindec(decbin(($data[3] & 0xF0) >> 3) . " " . decbin(($data[2] & 0xE0) >> 5));
            return date("d-m-Y H:i", mktime($hour, $minute, 0, $month, $day, $year));
        }
        else if (count($data) == 2){
            if(($data[0] == 0) and ($data[1] == 0)){
                return "";
            }
            $day = $data[0] & 0x1F;
            $month = $data[1] & 0x0F;
            $year = (($data[0] >> 5) & 0x7) | (($data[1] & 0xf0) >> (4 - 3));
            return date("d-m-Y", mktime(0, 0, 0, $month, $day, $year));
        }
        return "date-time data length mismatch.";
    }
    /**
     * Decode Integer data
     */
    public static function data_int_decode($data) {
        $val = 0;
        //mbus_utils::mylog("count(data)" . count($data));
        for ($i = count($data); $i > 0; $i--) {
            //mbus_utils::mylog("data[i-1]: " . dechex($data[$i-1]));
            $val = ($val << 8) + $data[$i-1];
            //mbus_utils::mylog("$val: " . $val);
        }

        return $val;

    }
    /**
     * Decode BCD data
     */
    public static function data_bcd_decode($data) {
        //mbus_utils::mylog("Data field 6.3 - table 5 - binary");
        $val = 0;
        $negative = false;
        if(($data[count($data)-1] & 0xF0) == 0xF0)
        {
            $negative = true;
            $data[count($data)-1] &= 0x0F;
        }
        for ($i = count($data); $i > 0; $i--) {
            $val = ($val * 10) + (($data[$i-1]>>4) & 0xF);
            $val = ($val * 10) + ( $data[$i-1]     & 0xF);

        }
        if($negative)
            return -$val;
        return $val;
    }

    /**
     * Decode float (Real) data
     */
    public static function data_float_decode($data){
        $data_str = "";
        foreach ($data as $byte){
            $data_str .= pack("C*", $byte);
        }
        $f = @unpack( 'f*', $data_str )[1];
        return $f;
//        return number_format( $f, 2 );
    }

    /**
     * Decode ascii data (skip first byte)
     */
    public static function data_str_decode($data) {

        $s = "";
        for ($i = count($data); $i >= 0; $i--) {
            $s .= chr($data[$i]);
        }
        //mbus_utils::mylog("Decode string: " . $s);
        return trim($s);
    }

    /**
     * Returns a hex converted byte in the format 0xNN.
     * Remember that PHP always stores values as decimal.
     */
    public static function ByteToHex($byte) {
        $retval = sprintf("%02x", $byte);
        return $retval;
    }
}
