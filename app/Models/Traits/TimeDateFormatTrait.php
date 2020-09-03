<?php

namespace App\Models\Traits;

use PhpParser\Node\Expr\Cast\String_;

trait TimeDateFormatTrait
{
    /**
     * get formatted timeDate
     * @param String $timeDate
     * @return String
     */
    public function getFormattedTimeDate(String $timeDate) :String
    {
        return subStr($timeDate, 0, 10) . ' ' . substr($timeDate, 11, 8);
    }

    /**
     * get formatted created_at
     * @return String
     */
    public function getFormattedCreatedAt() :String
    {
        return $this->getFormattedTimeDate($this->created_at);
    }

    /**
     * get formatted updated_at
     * @return String
     */
    public function getFormattedUpdatedAt() :String
    {
        return $this->getFormattedTimeDate($this->updated_at);
    }
}