<?php

use Carbon\Carbon;

if (!function_exists('getMonthsArray')) {
    /**
     * This function return aray of months of year
     * @return array
     */
    function getMonthsArray(): array
    {
        return ['январь', 'февраль', 'март', 'апрель', 'май', 'июнь', 'июль', 'август', 'сентябрь', 'октябрь', 'ноябрь', 'декабрь'];
    }
}

if (!function_exists('lastDayOfMonth')) {
    /**
     * This function return last day of given month
     * @param int $month The given month
     * @param int $year The given year
     * @return int
     */
    function lastDayOfMonth(int $month, int $year): int
    {
        $date = $year . '-' . $month . '-01';
        return (int)date('t', strtotime($date . ' 01:01:01'));
    }
}

if (!function_exists('getMonth')) {
    /**
     * This function return name of month by index
     * @param int $month The index of month
     * @return string
     */
    function getMonth(int $month): string
    {
        $months = getMonthsArray();

        return $months[$month - 1];
    }
}

if (!function_exists('surname')) {
    /**
     * This function return the last name and initials of an employee.
     * @param string $lastName The surname of employee
     * @param string $firstName The name of employee
     * @param string $middleName The second name of employee
     * @return string
     */
    function surname(string $lastName, string $firstName, string $middleName): string
    {
        return ucwords($lastName) . ' ' . strtoupper(substr($firstName, 0, 2)) . '.' . strtoupper(substr($middleName, 0, 2)) . '.';
    }
}

if (!function_exists('getDay')) {
    /**
     * This function return the day from date.
     * @param string $date The date 'YYYY-mm-dd hh:mm:ss'
     * @return string
     */
    function getDay(string $date): string
    {
        return date('d', strtotime($date . '00:00:00'));
    }
}

if (!function_exists('totalColumn')) {
    /**
     * This function return the total column for table. Last day of month plus value in int parameter.
     * @param int $param
     * @return string
     */
    function totalColumn(int $param): string
    {
        return (int)date('t', time()) + $param;
    }
}

if (!function_exists('dayOfWeek')) {
    /**
     * This function return the name of day of week by date
     * @param int $year the year 'YYYY'
     * @param int $month the year 'mm'
     * @param int $day the year 'dd'
     * @return string
     */
    function dayOfWeek(int $year, int $month, int $day): string
    {
        $days = ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'];
        return $days[date('w', strtotime($year . '-' . $month . '-' . $day))];
    }
}

if (!function_exists('numOfWeek')) {
    /**
     * This function return the index of day of week by date
     * @param int $year the year 'YYYY'
     * @param int $month the year 'mm'
     * @param int $day the year 'dd'
     * @return string
     */
    function numOfWeek(int $year, int $month, int $day): int
    {
        return date('w', strtotime($year . '-' . $month . '-' . $day));
    }

    if (!function_exists('generateURL')) {
        /**
         * This function return the url of page for given month and year
         * @param string $url the url of current page
         * @param int $month the current month
         * @param int $year the current year
         * @return string
         */
        function generateURL(string $url, int $month, int $year): string
        {
            return $url . '?month=' . $month . '&year=' . $year;
        }
    }


    if (!function_exists('generateURLDecrement')) {
        /**
         * This function return the url of page for previous month
         * @param string $url the url of current page
         * @param int $month the current month
         * @param int $year the current year
         * @return string
         */
        function generateURLDecrement(string $url, int $month, int $year): string
        {
            $month--;
            if ($month < 1) {
                $month = 12;
                $year--;
            }

            return $url . '?month=' . $month . '&year=' . $year;
        }
    }

    if (!function_exists('generateURLIncrement')) {
        /**
         * This function return the url of page for next month
         * @param string $url the url of current page
         * @param int $month the current month
         * @param int $year the current year
         * @return string
         */
        function generateURLIncrement(string $url, int $month, int $year): string
        {
            $dateM = Carbon::now('Europe/Moscow')->format('m');
            $dateY = Carbon::now('Europe/Moscow')->format('Y');

            $month++;
            if (($month > $dateM) && ($year == $dateY)) {
                $month = ltrim($dateM, 0);
            }

            if ($month > 12) {
                $month = 1;
                $year++;
            }

            return $url . '?month=' . $month . '&year=' . $year;
        }
    }

    if (!function_exists('dateDDMMYYYY')) {
        /**
         * This function return the date in format DD.MM.YYYY
         * @param string $date the url of current page
         * @return string
         */
        function dateDDMMYYYY(string $date): string
        {
            return date('d.m.Y', strtotime($date));
        }
    }
}
