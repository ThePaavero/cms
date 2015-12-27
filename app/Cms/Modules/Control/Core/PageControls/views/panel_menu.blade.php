<ul class='panel-menu-with-overlays'>
    <li>
        <a href='#' class='child-toggler'>Page</a>
        <ul class='overlay'>
            <li>
                <a href='{{ url('admin/*Modules/Control/Core/PageControls*/create-new-page-under/' . $data['pageId']) }}' class='modal-link'>Create new page under this one</a>
                <a href='{{ url('admin/*Modules/Control/Core/PageControls*/edit-meta-data/' . $data['pageId']) }}' class='modal-link'>Edit this page's meta data</a>
            </li>
        </ul>
    </li>
</ul>

<script src='{{ url('assets/js/custombox.min.js') }}'></script>
