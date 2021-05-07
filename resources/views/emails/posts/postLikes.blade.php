@component('mail::message')
    {{-- Subject --}}
    # Your post was liked

    {{ $liker->name }} liked one of your post

    @component('mail::button', ['url' => route('showpost', $post)])
        View Post
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
