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
        $this->mbus = new mbus_frame();
    }

    /**
     * NASCV starts function convert
     * @param $data
     */
    public function convert( $data, $option = array() )
    {
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