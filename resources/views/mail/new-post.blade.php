@component('mail::message')
# New post created

A new post is benn public on your blog:

{{$title}}

@component('mail::button', ['url' => config('app.url') . '/posts'])
View Blog
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent