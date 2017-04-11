<?php

namespace wii\model;

use wii\contracts\IActiveRecord;
use wii\contracts\IQueryBuilder;

abstract class ActiveRecord extends Model implements IActiveRecord, IQueryBuilder  {

}