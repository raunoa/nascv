<?php
require_once 'components/registers.php';

class wmb extends registers
{

    public $nascv;

    # structure by fport
    function rx_fport()
    {
        $struct = [];

        # fport 24
        $struct[ 24 ] = [
            #WM-BUS
            [ '_cnf' => [ 'repeat' => false ],
                # OK

                'wmbus' => [ 'type' => 'hex', 'byte_order' => 'LSB', 'length' => '*', 
                    'ext' => [ 'php-mbus', [ 'type' => 'wmbus_frame_b' ] ],
                ]
            ]
        ];

        return $struct;
    }


    /**
     * @return array
     */
    public function tx_fport()
    {
        $tx = self::rx_fport();
        return $tx;
    }

}