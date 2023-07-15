$(document).ready(function () {
    $('[data-fancybox]').fancybox();
    
    $(document).on('click', '.open_modal', function (e) { 
        alert('hi')
        $ModalID = $(this).data('target')
        var $data_id = $(this).data('id')
        $($ModalID).modal('show');
        $('.data_id').val($data_id);
    });
    $(document).on('click', '.cancel_model', function (e) {
        $($ModalID).modal('hide'); 
    });



    
});