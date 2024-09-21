<x-mail::message>
# Introduction

The code:{{$code}}

<x-mail::button :url="'http://127.0.0.1:8000/login'">
Update Password
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
