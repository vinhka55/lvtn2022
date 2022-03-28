@extends("welcome")
@section("content")
    @foreach($news as $item)
        <div class="container" style="margin-top:100px;">
            <p>{!!$item->content!!}</p>
        </div>
    @endforeach
@stop 