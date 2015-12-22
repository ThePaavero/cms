class TextBlock {

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
        });
    }
}

export default TextBlock;
