<?php

namespace ww\model;

use ww\contracts\IActiveRecord;
use ww\contracts\IQueryBuilder;

abstract class ActiveRecord extends Model implements IActiveRecord, IQueryBuilder  {

}