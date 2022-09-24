@props(['services'])

<script>
    var servicesList = [
@foreach($services as $service)
        @php
            preg_match_all('/{refill}(.*?){\/refill}/s', $service->description, $refill);
            preg_match_all('/{starttime}(.*?){\/starttime}/s', $service->description, $starttime);
            preg_match_all('/{speed}(.*?){\/speed}/s', $service->description, $speed);

            $refillExp = array_key_exists(0, $refill) ? (array_key_exists(0, $refill[0]) ? $refill[0][0] : '') : '';
            $starttimeExp = array_key_exists(0, $starttime) ? (array_key_exists(0, $starttime[0]) ? $starttime[0][0] : '') : '';
            $speedExp = array_key_exists(0, $speed) ? (array_key_exists(0, $speed[0]) ? $speed[0][0] : '') : '';

            $tagsManual = ['{refill}', '{/refill}', '{starttime}', '{/starttime}', '{speed}', '{/speed}'];
            $refillExpFull = str_replace($tagsManual, '', $refillExp);
            $starttimeExpFull = str_replace($tagsManual, '', $starttimeExp);
            $speedExpFull = str_replace($tagsManual, '', $speedExp);

            $tags = [$refillExp, $starttimeExp, $speedExp];
            $newDescription = trim(str_replace($tags, '', $service->description));
        @endphp
        {id:{{$service->id}}, name:"{{$service->name}}", refill:"{{$refillExpFull}}", starttime:"{{$starttimeExpFull}}", speed:"{{$speedExpFull}}", description:"{{$newDescription}}"},
@endforeach
    ];
</script>
