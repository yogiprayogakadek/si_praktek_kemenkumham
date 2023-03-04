<?php
    function diffDate($date) {
        $newDate = explode(' s/d ', $date);
        $date1 = $newDate[0];
        $date2 = $newDate[1];

        $d1 = new DateTime($date1);
        $d2 = new DateTime($date2);
        $diff = $d1->diff($d2);
        return $diff->days . " hari";
    }