@foreach($tags as $tag)
    <div>
        <input type="checkbox" name="category" value="{{$tag->name}}" id="{{$tag->name}}">
        <label for="{{$tag->name}}">{{$tag->name}}</label>
    </div>
@endforeach
