<?php

if (!function_exists('time_elapsed_string')) {
    function time_elapsed_string($datetime, $full = false)
    {
        $now  = new DateTime();
        $ago  = new DateTime($datetime);
        $diff = $now->diff($ago);

        // Safe week calculation
        $weeks = floor($diff->days / 7);
        $days  = $diff->days - ($weeks * 7);

        $string = [
            'y' => $diff->y ? $diff->y . ' year' . ($diff->y > 1 ? 's' : '') : null,
            'm' => $diff->m ? $diff->m . ' month' . ($diff->m > 1 ? 's' : '') : null,
            'w' => $weeks ? $weeks . ' week' . ($weeks > 1 ? 's' : '') : null,
            'd' => $days ? $days . ' day' . ($days > 1 ? 's' : '') : null,
        ];

        $string = array_filter($string);

        if (!$full) {
            $string = array_slice($string, 0, 1);
        }

        return $string ? implode(', ', $string) . ' ago' : 'Just now';
    }
}