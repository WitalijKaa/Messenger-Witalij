<?php

namespace ww\contracts;

interface IModel {

    public function attrsGetListArr();
    public function attrsGetTypes();
    public function attrsGetKeyValArr();

    public function isAttrDirty($name);
    public function attrGetType($name);
}