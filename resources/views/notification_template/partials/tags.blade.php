@foreach($tags as $tag)
<span>
	{{implode(', ', $tag)}}
</span>
@endforeach