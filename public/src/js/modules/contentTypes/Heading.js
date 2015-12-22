class Heading {

    constructor() {
        // ...
    }

    bootElement($element) {
        console.log($element);
        $element.on('dblclick', (e) => {
            let $me = $(e.currentTarget);
            $me.prop('contenteditable', true);
        });


        $element.on('blur', (e) => {
            let $me = $(e.currentTarget);
            $me.prop('contenteditable', false);

            let myContents = $me.html();
            let contentId = $me.data('content-id');
            let data = 'newContent=' + encodeURIComponent(myContents);

            $.ajax({
                type: 'POST',
                url: _root + 'admin/contentType/Heading/updateContent/' + contentId,
                data: data,
                success: (response) => {
                    $me.html(response);
                }
            });
        });
    }
}

export default Heading;
