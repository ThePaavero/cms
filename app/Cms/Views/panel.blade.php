<div class='cms-admin-panel-wrapper clear'>

    <h1>CMS Panel</h1>
    <section>
        <nav class='controls'>
            @foreach($data['controls'] as $controlMarkup)
                {!! $controlMarkup !!}
            @endforeach
        </nav>
        <!-- controls -->
    </section>
    <section>
        <nav>
            <ul>
                <li><a href='{{ url('logout') }}'>Log out</a></li>
            </ul>
        </nav>
    </section>

</div>
<!-- cms-admin-panel-wrapper clear -->
