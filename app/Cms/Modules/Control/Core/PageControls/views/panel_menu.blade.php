<ul class='panel-menu-with-overlays'>
    <li>
        <a href='#' class='child-toggler'>Page</a>
        <ul class='overlay'>
            <li>
                <a href='{{ url('admin/controls/PageControls/create-new-page-under/' . $data['pageId']) }}'>Create new page under this one</a>
            </li>
        </ul>
    </li>
</ul>