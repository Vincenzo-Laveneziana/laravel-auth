@component('mail::message')
# Update post 

@component('mail::button', ['url' => config('app.url') . '/posts'])
View Blog
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent