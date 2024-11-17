import './bootstrap';

import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

document.addEventListener('DOMContentLoaded', () => {
    ClassicEditor
        .create(document.querySelector('#editor')) // 確保你的 textarea 有對應的 ID
        .catch(error => {
            console.error(error);
        });
});

