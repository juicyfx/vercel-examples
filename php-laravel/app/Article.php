<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Phased\State\Traits\Vuexable;

class Article extends Model
{
    use Vuexable;
}
