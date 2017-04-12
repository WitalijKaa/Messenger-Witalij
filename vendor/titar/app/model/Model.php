<?php

namespace ww\model;

use ww\contracts\IModel;

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
    public function attrGetType($name) {
        $aTypes = $this->attrsGetTypes();
        if (array_key_exists($name, $aTypes)) { return $aTypes[$name]; }
        return 'string'; // todo здесь по-хорошему нужно бросать исключение
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
        $aTypes = $this->attrsGetTypes(); // нельзя удалять, так как $this->attrsGetTypes() конроллирует созданием массива $this->_attrsKeyVal
        $attrs = &$this->_attrsKeyVal;

        if ('string' == $aTypes[$name]) {
            $attrs[$name] = (string)$value;
        }
        else if ('integer' == $aTypes[$name]) {
            $attrs[$name] = (integer)$value;
        }
        else if ('boolean' == $aTypes[$name]) {
            $attrs[$name] = (boolean)$value;
        }
        $this->attrsSetDirty($name);
    }

    /** @var array */
    private $_attrsDirtyCleanArr = false;
    private function attrsGetDirtyClean() {
        if (false === $this->_attrsDirtyCleanArr) {
            $allAttrs = $this->attrsGetListArr();
            $this->_attrsDirtyCleanArr = [];
            foreach ($allAttrs as $attr) {
                $this->_attrsDirtyCleanArr[$attr] = false;
            }
        }
        return $this->_attrsDirtyCleanArr;
    }
    private function attrsSetDirty($name) {
        if (false === $this->_attrsDirtyCleanArr) { $this->attrsGetDirtyClean(); }
        $this->_attrsDirtyCleanArr[$name] = true;
    }
    public function isAttrDirty($name) {
        if ($this->_attrsDirtyCleanArr) {
            return !!$this->_attrsDirtyCleanArr[$name];
        }
        return false;
    }

    protected function attrsRules() { return []; }

}