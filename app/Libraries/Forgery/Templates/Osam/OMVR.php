<?php
namespace App\Libraries\Forgery\Templates\Osam;


use App\Libraries\Forgery\Table;
use CodeIgniter\Database\RawSql;
use App\Libraries\Forgery\Field;

class OMVR extends Table {
    
    /**
     * {@inheritDoc}
     * @see \App\Libraries\Forgery\Table::__initTableAttributes()
     */
    protected function __initTableAttributes () {
        $this->tableName    = 'omvr';
        $this->tableFields  = [
            Field::__constructUnsignedPrimaryIntegerField ('id'),
            Field::__constructUUIDField ('uuid'),
            Field::__constructField ('docnum', VARCHAR, 100, '', FALSE, FALSE, TRUE, 'OARV_UNIQUE'),
            Field::__constructField ('docdate', DATETIME, 0, new RawSql ('NULL'), FALSE, FALSE, FALSE, '', FALSE, '', '', FALSE, TRUE),
            Field::__constructField ('docref_id', INTEGER, 0, 0, TRUE),
            Field::__constructField ('from_id', INTEGER, 0, 0, TRUE),
            Field::__constructField ('to_id', INTEGER, 0, 0, TRUE),
            Field::__constructField ('remarks', TEXT, 0, 0),
            Field::__constructField ('status', TINYINT, 0, 0, TRUE),
        ];
    }
    
}