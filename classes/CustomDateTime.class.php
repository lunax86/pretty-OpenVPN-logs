<?php

class CustomDateTime
{

    const DATETIME_FORMAT = 'j.n.Y G:i:s';
    const DATE_FORMAT = 'j.n.Y';
    const TIME_FORMAT = 'G:i:s';
    const DB_DATETIME_FORMAT = 'Y-m-d H:i:s';
    const DB_DATE_FORMAT = 'Y-m-d';
    const DB_TIME_FORMAT = 'H:i:s';

    private static $months = [
        'January',
        'February',
        'March',
        'April',
        'May',
        'June',
        'July',
        'August',
        'September',
        'October',
        'November',
        'December',
    ];

    private static $monthsCZ = [
        'Leden',
        'Únor',
        'Březen',
        'Duben',
        'Květen',
        'Červen',
        'Červenen',
        'Srpen',
        'Září',
        'Říjen',
        'Listopad',
        'Prosinec'
    ];

    public static function getDateTime($date)
    {
        if (ctype_digit($date) || is_int($date)) $date = '@' . $date;
            return new DateTime($date);
    }

    public static function formatDate($date)
    {
        $dateTime = self::getDateTime($date);
            return $dateTime->format('d.m.Y');
    }
    
    public static function formatDateTime($date, $withSeconds = false)
    {
        $dateTime = self::getDateTime($date);
            if ($withSeconds) return $dateTime->format('d.m.Y H:i:s');
            return $dateTime->format('d.m.Y H:i');
    }

    private static function getPrettyDate($dateTime)
    {
        $now = new DateTime();
        if ($dateTime->format('Y') != $now->format('Y'))
            return $dateTime->format('j.n.Y');
        $dayMonth = $dateTime->format('d-m');
        if ($dayMonth == $now->format('d-m'))
            return 'Today';
        $now->modify('-1 DAY');
        if ($dayMonth == $now->format('d-m'))
            return 'Yesterday';
        $now->modify('+2 DAYS');
        if ($dayMonth == $now->format('d-m'))
            return 'Tomorrow';
        return $dateTime->format('j ') . self::$months[$dateTime->format('n') - 1];
    }

    private static function getPrettyDateCZ($dateTime)
    {
        $now = new DateTime();
        if ($dateTime->format('Y') != $now->format('Y'))
            return $dateTime->format('j.n.Y');
        $dayMonth = $dateTime->format('d-m');
        if ($dayMonth == $now->format('d-m'))
            return "Dnes";
        $now->modify('-1 DAY');
        if ($dayMonth == $now->format('d-m'))
            return "Včera";
        $now->modify('+2 DAYS');
        if ($dayMonth == $now->format('d-m'))
            return "Zítra";
        return $dateTime->format('j.') . self::$monthsCZ[$dateTime->format('n') - 1];
    }

    public static function prettyDate($date)
    {
        return self::getPrettyDate(self::getDateTime($date));
    }
    
    public static function prettyDateTime($date, $withSeconds = false)
    {
        $dateTime = self::getDateTime($date);
        if ($withSeconds) self::getPrettyDate($dateTime) . $dateTime->format(' H:i:s');
        return self::getPrettyDate($dateTime) . $dateTime->format(' H:i');
    }

    public static function prettyDateTimeCZ($date, $withSeconds = false)
    {
        $dateTime = self::getDateTime($date);
        if ($withSeconds) self::getPrettyDateCZ($dateTime) . $dateTime->format(' H:i:s');
        return self::getPrettyDateCZ($dateTime) . $dateTime->format(' H:i');
    }

}