<?php

namespace App\Services;

class SubunitService
{
    function checkDateOverlap($start1, $end1, $start2, $end2)
    {
        return ($start1 <= $end2) && ($end1 >= $start2);
    }
    // Can be done with Carbon
    // function checkDateOverlap($start1, $end1, $start2, $end2)
    // {
    //     $start1 = Carbon::parse($start1);
    //     $end1 = Carbon::parse($end1);
    //     $start2 = Carbon::parse($start2);
    //     $end2 = Carbon::parse($end2);

    //     return $start1->lt($end2) && $end1->gt($start2);
    // }
}
