<?php

namespace App\Enums;

enum Timer: string
{
  case HOUR = 'hour';
  case MINUTE = 'minute';
  case SECOND = 'second';
}
