@php $set=$set??'robohash'; @endphp
<img src="https://www.gravatar.com/avatar/{$email}?r=g&d={$set}&s={$size}" />

{{--
    $hash = md5(strtolower($email));
    $url = "https://www.gravatar.com/avatar/{$hash}?r=g&d={$set}&s={$size}";
    return '<img src="' . $url . '" />';

--}}
