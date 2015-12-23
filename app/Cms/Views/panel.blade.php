<div class='cms-admin-panel-wrapper clear'>

    <h1>CMS Panel</h1>
    <section>
        @foreach($data['controls'] as $controlMarkup)
            <nav class='controls'>
                {{ $controlMarkup }}
            </nav>
            <!-- controls -->
        @endforeach
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
