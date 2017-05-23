@component('mail::message')
# Introduction

Hey {{ $user->name }}! Thanks so much for registering. Here's what you can look forward to...

- Point one
- Point two
- Point three

@component('mail::button', ['url' => 'http://egblog.local'])
Get Started
@endcomponent

@component('mail::panel', ['url' => ''])
It's great to have you on board!
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
