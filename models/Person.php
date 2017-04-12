<?php

namespace models;

use wii\model\ActiveRecord;

/**
 * @property integer $person_id
 * @property string $login
 * @property string $msg_login
 * @property string $tech_login
 * @property string $pass
 */

class Person extends ActiveRecord {

    public function tempEcho() {
        $arr = [];

        $this->login = 'PHPcoder';
        $this->person_id = '555';
        $arr['kv'] = $this->attrsGetKeyValArr();

        return $arr;
    }

    protected function attrsRules()
    {
        return [
            'integer' => ['person_id'],
            'text' => ['login', 'msg_login', 'tech_login', 'pass'],
            'pk' => ['person_id'],
            'secured' => ['pass']
        ];
    }

}