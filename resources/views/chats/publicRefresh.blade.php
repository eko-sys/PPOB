
	@foreach($publics as $public)
	<div>
		<h5 id="user-name">{{ '@' }}{{ strtoupper($public->name) }}</h5>
	</div>

	<div>
		<p id="user-message">{{ $public->message }}</p>
		<p class="text-right">{{ $public->created_at->diffForHumans() }}</p>
	</div>
	<hr>

	@endforeach