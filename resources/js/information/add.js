let informationAdd = (function () {
    let modules = {};

    modules.loadCkeditoer = function () {
        let editor;
        ClassicEditor
            .create( document.querySelector('#text-content'), {
                toolbar: {
                    items: [
                        'heading',
                        '|',
                        'bold',
                        'italic',
                        'link',
                        'bulletedList',
                        'numberedList',
                        '|',
                        'indent',
                        'outdent',
                        '|',
                        'blockQuote',
                        'insertTable',
                        'undo',
                        'redo',
                        'alignment',
                        'fontSize'
                    ]
                },
                language: 'ja',
                table: {
                    contentToolbar: [
                        'tableColumn',
                        'tableRow',
                        'mergeTableCells'
                    ]
                },
                licenseKey: '',
            })
            .then( newEditor => {
                editor = newEditor;
            })
            .catch( error => {
                alert('システムでの処理中にエラーが発生しました。\n' +
                    '時間を開けて再度お試しください。');
                window.location.reload();
            });
        $('#text-content').css({'display':'block'});
    };

    return modules;
}(window.jQuery, window, document));

$(document).ready(function(){
    informationAdd.loadCkeditoer();

    $('#submit-information').on('click', function () {
        $(this).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>少々お待ちください...');
        $(this).prop('disabled', true);
        $('#form-information').submit();
    });
});
