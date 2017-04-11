<?php

namespace models;

use wii\model\ActiveRecord;

class Person extends ActiveRecord {

    public function tempEcho() {
        return $this->attrsGetAllAsArr();
    }

    protected function attrsRules()
    {
        return [
            'integer' => ['person_id'],
            'text' => ['login', 'msg_login', 'tech_login', 'pass'],
            'secured' => ['pass']
        ];
    }

}