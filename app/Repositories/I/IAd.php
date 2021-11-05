<?php

namespace App\Repositories\I;

interface IAd
{

  // functions needs

  public function adFilterByCategoryAndTag($category,$tag);
  public function getNextDayAds();

}
