import TextBlock from 'modules/contentTypes/TextBlock';
import Heading from 'modules/contentTypes/Heading';

class Cms {

    constructor() {
        this.userIsAdmin = window._CmsUserIsAdmin;
        this.contentTypes = {
            'TextBlock': TextBlock,
            'Heading': Heading
        };
    }

    init() {
        if (this.userIsAdmin) {
            console.log('CMS initiating... (admin is logged in)');
            this.doAjaxSetup();
            this.doEditableBlocks();
        }
    }

    doAjaxSetup() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    }

    doEditableBlocks() {
        let myTargetElements = document.querySelectorAll('.cms-content-wrapper');

        for (let node of myTargetElements) {
            let $node = $(node);
            let contentType = $node.data('content-type');

            if (typeof this.contentTypes[contentType] === 'undefined') {
                console.error('No content type JS class for type "' + contentType + '"');
                continue;
            }

            let contentTypeInstance = new this.contentTypes[contentType]();
            contentTypeInstance.bootElement($node);
        }
    }
}

export default Cms;
