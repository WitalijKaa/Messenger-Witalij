<?php

namespace wii\model;

use wii\contracts\IModel;

abstract class Model implements IModel {

    /** @var array */
    private $_attrsAllList = false;
    public function attrsGetListArr() {
        if (false === $this->_attrsAllList) {
            $attrsRulesArr = $this->attrsRules();

            // составим список всех аттрибутов
            $this->_attrsAllList = [];
            foreach ($attrsRulesArr as $attrsTypeRule => $attrsInRule) {
                $this->_attrsAllList = array_merge($this->_attrsAllList, $attrsInRule);
            }
            $this->_attrsAllList = array_unique($this->_attrsAllList);

            $this->defineAttrsTypesArr();
            $this->defineAttrsKeysValuesArr();
        }
        return $this->_attrsAllList;
    }

    /** @var array */
    private $_attrsTypes = false;
    private function defineAttrsTypesArr() {
        // разберем аттрибуты по типам
        $attrsRulesArr = $this->attrsRules();
        $allowedTypes = [
            'text' => 'string', // по умолчанию
            'integer' => 'integer',
            'boolean' => 'boolean'
        ];
        $this->_attrsTypes = [];
        foreach ($this->_attrsAllList as $attr) {
            $this->_attrsTypes[$attr] = 'string';
            foreach ($attrsRulesArr as $attrsTypeRule => $attrsInRule) {
                if (array_key_exists($attrsTypeRule, $allowedTypes)) {
                    if (in_array($attr, $attrsInRule)) {
                        $this->_attrsTypes[$attr] = $allowedTypes[$attrsTypeRule];
                        break;
                    }
                }
            }
        }
    }
    public function attrsGetTypes() {
        if (false === $this->_attrsAllList) { $this->attrsGetListArr(); }
        return $this->_attrsTypes;
    }

    /** @var array */
    private $_attrsKeyVal = false;
    private function defineAttrsKeysValuesArr() {
        $defaulsValues = [
            'string' => '',
            'integer' => 0,
            'boolean' => false
        ];
        $this->_attrsKeyVal = [];
        foreach ($this->_attrsAllList as $attr) {
            $this->_attrsKeyVal[$attr] = $defaulsValues[$this->_attrsTypes[$attr]];
        }
    }
    public function attrsGetKeyValArr() {
        if (false === $this->_attrsAllList) { $this->attrsGetListArr(); }
        return $this->_attrsKeyVal;
    }

    public function __get($name) {
        if (in_array($name, $this->attrsGetListArr())) {
            return $this->attrsGetKeyValArr()[$name];
        }
    }

    public function __set($name, $value) {
        $attrsList = $this->attrsGetListArr();
        if (in_array($name, $attrsList)) {
            $this->setAttrTranformingType($name, $value);
        }
    }

    private function setAttrTranformingType($name, $value) {
        $attrsTypes = $this->attrsGetTypes(); // нельзя удалять, так как этот метод конроллирует созданием массива $this->_attrsKeyVal
        $this->attrsGetDirtyClean();
        if ('string' == $attrsTypes[$name]) {
            $this->_attrsKeyVal[$name] = (string)$value;
        }
        else if ('integer' == $attrsTypes[$name]) {
            $this->_attrsKeyVal[$name] = (integer)$value;
        }
        else if ('boolean' == $attrsTypes[$name]) {
            $this->_attrsKeyVal[$name] = (boolean)$value;
        }
        $this->_attrsDirtyCleanArr[$name] = true;
    }

    /** @var array */
    private $_attrsDirtyCleanArr = false;
    protected function attrsGetDirtyClean() {
        if (false === $this->_attrsDirtyCleanArr) {
            $allAttrs = $this->attrsGetListArr();
            $this->_attrsDirtyCleanArr = [];
            foreach ($allAttrs as $attr) {
                $this->_attrsDirtyCleanArr[$attr] = false;
            }
        }
        return $this->_attrsDirtyCleanArr;
    }

    protected function attrsRules() { return []; }

}