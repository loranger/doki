<ul class="nav navbar-nav">
    @foreach($items as $name => $value)
        @if (is_array($value))
            <li class="dropdown">
              <a href="{{ $root }}/{{ $name }}" class="dropdown-toggle" data-toggle="dropdown">{{ ucfirst($name) }} <span class="caret"></span></a>
              @include('ui.dropdown-menu', array('items' => $value, 'root' => $root.'/'.$name))
            </li>
            @else
            <li><a href="{{ $root }}/{{ $name }}">{{ ucfirst($name) }}</a></li>
        @endif
    @endforeach
</ul>
