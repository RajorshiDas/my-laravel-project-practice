<h1>Hello {{$user->name}}</h1>
<p>Welcome to our application. We are glad to have you here.</p>
<p>Thank you for joining us!</p>
<div>
<p>You created this post {{$post->title}}</p>
<p>{{$post->body}}</p>
<img width="300" src="{{ $message->embed('storage/' . $post->image) }}" alt="">

</div>
