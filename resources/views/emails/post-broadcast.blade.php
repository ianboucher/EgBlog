@component('mail::message')
# Introduction

Hey! I just wanted to let you know that there's a new post out on the blog

@component('mail::button', ['url' => 'http://egblog.local/posts'])
Check it Out!
@endcomponent

@component('mail::panel', ['url' => ''])
I hope you enjoy it!
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
