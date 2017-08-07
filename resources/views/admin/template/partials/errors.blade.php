<!--
/**
 * Created by PhpStorm.
 * User: Eliseo
 * Date: 05/08/2017
 * Time: 01:05 AM
 */
-->
@if(count($errors) > 0 )
    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach($errors->all() as $error)
                <li> {{ $error }} </li>
            @endforeach
        </ul>
    </div>
@endif
