<x-mail::message>
# Introduction

Lists of latest posts published since 7 days

<ul>
    @foreach ($posts as $post)
        <li><a href="{{ route('post.show', $post->slug) }}">{{ $post->title }}</a></li>
    @endforeach
</ul>
<p>Click on the links to read the full posts.</p>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
