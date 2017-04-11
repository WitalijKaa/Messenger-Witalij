<?php

namespace wii\model;

use wii\contracts\IModel;

abstract class Model implements IModel {

    public function attrsGetAllAsArr() {
        $attrsRulesArr = $this->attrsRules();
        $attrsArr = [];
        foreach ($attrsRulesArr as $attrsTypeRule => $attrsInRule) {
            $attrsArr = array_merge($attrsArr, $attrsInRule);
        }
        return array_unique($attrsArr);
    }

    protected function attrsRules() { return []; }

}