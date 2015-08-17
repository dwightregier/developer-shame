@if (Auth::check() && $object->upvotes()->where('user_id', Auth::user()->id)->count() > 0)
    <button type="submit" class="btn btn-success">
        <i class="fa fa-arrow-down"></i>
        <br>
        {{ $object->upvotes->count() }}
    </button>
@else
    <button type="submit" class="btn btn-default">
        <i class="fa fa-arrow-up"></i>
        <br>
        {{ $object->upvotes->count() }}
    </button>
@endif