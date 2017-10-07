hola desde el view student
@if(Auth::user('student'))
	si hay check
@else
	no hay check
@endif

{{ \Auth::user('student')->name }}