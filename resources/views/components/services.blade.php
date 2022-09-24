@props(['description'])
@php
    preg_match_all('/{refill}(.*?){\/refill}/s', $description, $refill);
    preg_match_all('/{starttime}(.*?){\/starttime}/s', $description, $starttime);
    preg_match_all('/{speed}(.*?){\/speed}/s', $description, $speed);

    $refillExp = array_key_exists(0, $refill) ? (array_key_exists(0, $refill[0]) ? $refill[0][0] : '') : '';
    $starttimeExp = array_key_exists(0, $starttime) ? (array_key_exists(0, $starttime[0]) ? $starttime[0][0] : '') : '';
    $speedExp = array_key_exists(0, $speed) ? (array_key_exists(0, $speed[0]) ? $speed[0][0] : '') : '';

    $tags = [$refillExp, $starttimeExp, $speedExp];
    $newDescription = trim(str_replace($tags, '', $description));
@endphp
{{$newDescription}}
