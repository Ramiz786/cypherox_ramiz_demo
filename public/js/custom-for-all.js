function get_updated_datatable() {

    $('#add_edit_form').slideUp(500, function () {
        $('#display_update_form').html('');
    });

    if ($(".dataTables_paginate li.active a").length > 0) {

        $(".dataTables_paginate li.active a").trigger("click");
        $(".dataTable th:eq(0)").trigger("click");
    }
    else {
        $(".dataTable th:eq(0)").trigger("click");
    }
}

function stick_toster_message_error(msg, title, behaviour) { //behaviour = success, warning, error
    toastr.options = {
        autoDismiss: false,
        "closeButton": true,
        "debug": false,
        "progressBar": false,
        "positionClass": "toast-top-center",
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "0",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
    toastr[behaviour](msg, title)
}

function toster_message_error(msg, title, behaviour) { //behaviour = success, warning, error
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "20000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
    toastr[behaviour](msg, title)
}
function toster_message(msg, title, behaviour) { //behaviour = success, warning, error
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
    toastr[behaviour](msg, title)
}


$(document).ready(function () {

    var start = moment().subtract(29, 'days');
    var end = moment();

    function cb(start, end) {
        $('#reportrange span').html(start.format('DD-MM-YYYY') + ' - ' + end.format('DD-MM-YYYY'));
        $('.start_date').val(start.format('YYYY-MM-DD'))
        $('.end_date').val(end.format('YYYY-MM-DD')).trigger('change')
    }

    $('#reportrange').daterangepicker({
        startDate: start,
        endDate: end,
        autoUpdateInput: false,
        locale: {
            cancelLabel: 'Reset'
        },
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);

    // cb(start, end);

    $(document).on("click", ".art_download_withfilter", function (event) {
        var $status_filter = $('.status_filter').val();
        var $url = BASE_URL + '/art/export?status_filter=' + $status_filter;
        window.location.href = $url;

    });
    $(document).on("click", ".remove_exhibition_art", function (event) {

        var $this = $(this);
        var art_id = $(this).data('art-id');
        var exhibition_id = $(this).data('exhibition-id');

        $('#exhibitonDtlModal').modal('show');
        $('.modal-body').html('Select "Delete" below if you are ready to delete art.');
        $("#btnYes").text('Delete')
        $('#btnYes').click(function () {
            var $url = BASE_URL + '/exhibition/art-delete';
            $.ajax({
                type: 'POST',
                url: $url,
                data: { art_id: art_id, exhibition_id: exhibition_id, _token: $('meta[name="csrf-token"]').attr('content') },
                dataType: 'json',

                beforeSend: function () {
                    $('.alert.alert-danger').slideUp(500).remove();
                    $('input[type="submit"]').val('Please wait..!').attr('disabled', 'disabled');

                },
                success: function (returnData) {

                    if (returnData.status == 400) {

                        if (typeof returnData.error != "undefined") {
                            toster_message('error', returnData.error, 'error');
                        }
                    } else {
                        $('#exhibitonDtlModal').modal('hide');

                        toster_message('Success', returnData.message, 'success');
                        $('.exhibition_art_' + art_id).remove()
                    }

                },
                error: function (xhr, textStatus, errorThrown) {
                    toster_message('error', 'There was an unknown error that occurred. You will need to refresh the page to continue working.', 'error');
                },
                complete: function () {
                    $('input[type="submit"]').val('Submit').removeAttr('disabled');
                }
            });

            return false;

        });
        $('.btnNo').click(function () {
            $('#exhibitonDtlModal').modal('hide');

        });



    });
    $(document).on("click", ".remove_all_exhibition_art", function (event) {

        var $this = $(this);
        var art_id = $(this).data('art-id');
        var exhibition_id = $(this).data('exhibition-id');

        $('#exhibitonDtlModal').modal('show');
        $('.modal-body').html('Select "Delete" below if you are ready to delete all art.');
        $("#btnYes").text('Delete')
        $('#btnYes').click(function () {
            var $url = BASE_URL + '/exhibition/art-all-delete';
            $.ajax({
                type: 'POST',
                url: $url,
                data: { art_id: art_id, exhibition_id: exhibition_id, _token: $('meta[name="csrf-token"]').attr('content') },
                dataType: 'json',

                beforeSend: function () {
                    $('.alert.alert-danger').slideUp(500).remove();
                    $('input[type="submit"]').val('Please wait..!').attr('disabled', 'disabled');

                },
                success: function (returnData) {

                    if (returnData.status == 400) {

                        if (typeof returnData.error != "undefined") {
                            toster_message('error', returnData.error, 'error');
                        }
                    } else {
                        $('#exhibitonDtlModal').modal('hide');

                        toster_message('Success', returnData.message, 'success');
                        $('.art_exhibition_body').html('')
                    }

                },
                error: function (xhr, textStatus, errorThrown) {
                    toster_message('error', 'There was an unknown error that occurred. You will need to refresh the page to continue working.', 'error');
                },
                complete: function () {
                    $('input[type="submit"]').val('Submit').removeAttr('disabled');
                }
            });

            return false;

        });
        $('.btnNo').click(function () {
            $('#commonModal').modal('hide');

        });



    });

    if ($('#HomeCMSDesc').length > 0) {
        CKEDITOR.replace('HomeCMSDesc', {

        });
    }
    $(document).on("click", ".status_update_btn", function (event) {
        if ($("input[name='row_id[]']").length > 0) {
            $('#statusModalArt').modal('show');
            $('.status_form').trigger("reset")

        } else {
            toster_message('error', 'Select At least one row', 'error');
        }
    });
    $(document).on("click", ".section_update_btn", function (event) {
        if ($("input[name='row_id[]']").length > 0) {
            $('#sectionModalArt').modal('show');

        } else {
            toster_message('error', 'Select At least one row', 'error');
        }
    });
    $(document).on("click", ".currency_rate", function (event) {

        var $url = $(this).data('method');
        $.ajax({
            type: 'POST',
            url: $url,
            data: { _token: $('meta[name="csrf-token"]').attr('content') },
            dataType: 'json',

            beforeSend: function () {
                $('.alert.alert-danger').slideUp(500).remove();
                $('input[type="submit"]').val('Please wait..!').attr('disabled', 'disabled');

            },
            success: function (returnData) {

                if (returnData.status == 400) {

                    if (typeof returnData.error != "undefined") {
                        toster_message('error', returnData.error, 'error');
                    }
                } else {
                    $('#commonModal').modal('hide');
                    $("#bulk_div").html('');
                    get_updated_datatable();
                    ODataTable.ajax.reload();

                    toster_message('Success', returnData.message, 'success');
                }

            },
            error: function (xhr, textStatus, errorThrown) {

                toster_message('error', 'There was an unknown error that occurred. You will need to refresh the page to continue working.', 'error');
            },
            complete: function () {
                $('input[type="submit"]').val('Submit').removeAttr('disabled');
            }
        });

        return false;


    });
    $(document).on("click", ".exhibition_add_btn", function (event) {
        if ($("input[name='row_id[]']").length > 0) {
            $('#exhibitionModalArt').modal('show');
            $('.form-control').css('width', '100% !important')

        } else {
            toster_message('error', 'Select At least one row', 'error');
        }
    });
    $(document).on("click", ".bulk_dtl_btn", function (event) {

        var $this = $(this);
        if ($("input[name='row_id[]']").length > 0) {

            $('#commonModal').modal('show');
            $('.modal-body').html('Select "Delete" below if you are ready to delete multiple rows.');
            $("#btnYes").text('Delete')
            $('#btnYes').click(function () {

                var formData = new FormData($('.bluk_dlt_frm')[0]);
                var $url = $($this).data('method');
                $.ajax({
                    type: 'POST',
                    url: $url,
                    data: formData,
                    dataType: 'json',
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function () {
                        $('.alert.alert-danger').slideUp(500).remove();
                        $('input[type="submit"]').val('Please wait..!').attr('disabled', 'disabled');

                    },
                    success: function (returnData) {

                        if (returnData.status == 400) {

                            if (typeof returnData.error != "undefined") {
                                toster_message('error', returnData.error, 'error');
                            }
                        } else {
                            $('#commonModal').modal('hide');
                            $("#bulk_div").html('');
                            get_updated_datatable();
                            ODataTable.ajax.reload();

                            toster_message('Success', returnData.message, 'success');
                        }

                    },
                    error: function (xhr, textStatus, errorThrown) {

                        toster_message('error', 'There was an unknown error that occurred. You will need to refresh the page to continue working.', 'error');
                    },
                    complete: function () {
                        $('input[type="submit"]').val('Submit').removeAttr('disabled');
                    }
                });

                return false;

            });
            $('.btnNo').click(function () {
                $('#commonModal').modal('hide');

            });
        } else {
            toster_message('error', 'Select At least one row', 'error');
        }


    });
    $(document).on("click", ".bulk_approve_btn", function (event) {

        var $this = $(this);

        if ($("input[name='row_id[]']").length > 0) {
            $('#commonModal').modal('show');
            if ($($this).data('value') == 1) {
                $('.modal-body').html('Select "Approve" below if you are ready to approve multiple art.');
                $("#btnYes").text('Approve')
            } else {
                $('.modal-body').html('Select "Disapprove" below if you are ready to disapprove multiple art.');
                $("#btnYes").text('Dispprove')
            }
            $('#btnYes').click(function () {

                var formData = new FormData($('.bluk_dlt_frm')[0]);
                formData.append('approve', $($this).data('value'));
                var $url = $($this).data('method');
                $.ajax({
                    type: 'POST',
                    url: $url,
                    data: formData,
                    dataType: 'json',
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function () {
                        $('.alert.alert-danger').slideUp(500).remove();
                        $('input[type="submit"]').val('Please wait..!').attr('disabled', 'disabled');

                    },
                    success: function (returnData) {

                        if (returnData.status == 400) {

                            if (typeof returnData.error != "undefined") {
                                toster_message('error', returnData.error, 'error');
                            }
                        } else {
                            $('#commonModal').modal('hide');
                            $("#bulk_div").html('');
                            get_updated_datatable();
                            ODataTable.ajax.reload();
                            toster_message('Success', returnData.message, 'success');
                        }

                    },
                    error: function (xhr, textStatus, errorThrown) {

                        toster_message('error', 'There was an unknown error that occurred. You will need to refresh the page to continue working.', 'error');
                    },
                    complete: function () {
                        $('input[type="submit"]').val('Submit').removeAttr('disabled');
                    }
                });

                return false;

            });
            $('.btnNo').click(function () {
                $('#commonModal').modal('hide');

            });
        } else {
            toster_message('error', 'Select At least one row', 'error');
        }


    });
    $(document).on("keyup", ".get_size", function (event) {
        get_size_id()
    });
    $(document).on("click", ".dlt_art_image", function (event) {
        var img_id = $(this).data('id')
        var method = $(this).data('method')
        if (img_id > 0) {

            $.ajax({
                type: 'GET',
                url: method,
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $('.alert.alert-danger').slideUp(500).remove();
                    $('input[type="submit"]').val('Please wait..!').attr('disabled', 'disabled');
                },
                success: function (returnData) {

                    if (returnData.status == 400) {
                        $('#save_msgList').html("");
                        $('#save_msgList').addClass('alert alert-danger');


                        $.each(returnData.errors, function (key, err_value) {
                            console.log(key, 'key')
                            // $('#save_msgList').append('<li>' + err_value + '</li>');
                            var ind = key.indexOf("[");
                            if (ind != -1) {
                                $(form).find('#span-error-' + key.substring(0, ind)).html(err_value);
                            } else {
                                $(form).find('#span-error-' + key).html(err_value);
                            }
                        });
                        setTimeout(function () {
                            $.each(returnData.errors, function (idx, topic) {
                                // Object.keys(returnData.errors)[0];
                                var ind = idx.indexOf("[");
                                if (ind != -1) {
                                    $(form).find('#span-error-' + idx.substring(0, ind)).html('');
                                } else {
                                    $(form).find('#span-error-' + idx).html('');
                                }
                            });
                        }
                            , 5000);

                        if (typeof returnData.error != "undefined") {
                            toster_message('error', returnData.error, 'error');
                        }
                    } else {
                        $('.edit_art_img_' + img_id).remove();
                        toster_message('deleted', returnData.message, 'success');
                    }

                },
                error: function (xhr, textStatus, errorThrown) {

                    toster_message('error', 'There was an unknown error that occurred. You will need to refresh the page to continue working.', 'error');
                },
                complete: function () {
                    $('input[type="submit"]').val('Submit').removeAttr('disabled');
                }
            });

            return false;


        }
    });
    $(document).on("click", ".cancel_button", function (event) {
        $('#add_edit_form').slideUp(500, function () {
            $('#display_update_form').html('');
        });
        return false;
    });

    $(document).on("submit", "form.default_form", function (event) {
        var form = $(this);

        var formData = new FormData($(this)[0]);
        var formId = $(this).attr('id');
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: formData,
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function () {
                $('.alert.alert-danger').slideUp(500).remove();
                $('input[type="submit"]').val('Please wait..!').attr('disabled', 'disabled');
            },
            success: function (returnData) {

                if (returnData.status == 400) {
                    $('#save_msgList').html("");
                    $('#save_msgList').addClass('alert alert-danger');


                    $.each(returnData.errors, function (key, err_value) {
                        console.log(key, 'key')
                        // $('#save_msgList').append('<li>' + err_value + '</li>');
                        var ind = key.indexOf("[");
                        if (ind != -1) {
                            $(form).find('#span-error-' + key.substring(0, ind)).html(err_value);
                        } else {
                            console.log('505')
                            if ($('#span-error-' + key).length > 0) {

                                $(form).find('#span-error-' + key).html(err_value);
                            } else {
                                $(form).find('#span-error-general-message').append('<br>' + err_value);
                            }
                        }
                    });
                    setTimeout(function () {
                        $.each(returnData.errors, function (idx, topic) {
                            // Object.keys(returnData.errors)[0];
                            var ind = idx.indexOf("[");
                            if (ind != -1) {
                                $(form).find('#span-error-' + idx.substring(0, ind)).html('');
                            } else {
                                $(form).find('#span-error-' + idx).html('');
                            }
                        });
                        $(form).find('#span-error-general-message').html('');
                    }
                        , 5000);

                    if (formId == 'order_update' || formId == 'change_password') {
                        setTimeout(function () {
                            window.location.reload();
                        }, 5000);
                    }

                    if (typeof returnData.error != "undefined") {
                        toster_message('error', returnData.error, 'error');
                    }
                } else {
                    get_updated_datatable();
                    ODataTable.ajax.reload();
                    toster_message('Success', returnData.message, 'success');
                }

            },
            error: function (xhr, textStatus, errorThrown) {

                toster_message('error', 'There was an unknown error that occurred. You will need to refresh the page to continue working.', 'error');
            },
            complete: function () {
                $('input[type="submit"]').val('Submit').removeAttr('disabled');
            }
        });

        return false;

    });
    $(document).on("submit", "form.status_form", function (event) {
        var form = $(this);

        var formData = new FormData($('#bluk_dlt_frm')[0]);
        formData.append('status', $('.form-control-status').val());
        var formId = $(this).attr('id');
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: formData,
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function () {
                $('.alert.alert-danger').slideUp(500).remove();
                $('input[type="submit"]').val('Please wait..!').attr('disabled', 'disabled');
            },
            success: function (returnData) {

                if (returnData.status == 400) {
                    $('#save_msgList').html("");
                    $('#save_msgList').addClass('alert alert-danger');


                    $.each(returnData.errors, function (key, err_value) {
                        console.log(key, 'key')
                        // $('#save_msgList').append('<li>' + err_value + '</li>');
                        var ind = key.indexOf("[");
                        if (ind != -1) {
                            $(form).find('#span-error-' + key.substring(0, ind)).html(err_value);
                        } else {
                            $(form).find('#span-error-' + key).html(err_value);
                        }
                    });
                    setTimeout(function () {
                        $.each(returnData.errors, function (idx, topic) {
                            // Object.keys(returnData.errors)[0];
                            var ind = idx.indexOf("[");
                            if (ind != -1) {
                                $(form).find('#span-error-' + idx.substring(0, ind)).html('');
                            } else {
                                $(form).find('#span-error-' + idx).html('');
                            }
                        });
                    }
                        , 5000);

                    if (typeof returnData.error != "undefined") {
                        toster_message('error', returnData.error, 'error');
                    }
                } else {
                    get_updated_datatable();
                    $("#bulk_div").html('');
                    ODataTable.ajax.reload();
                    $('#statusModalArt').modal('hide');
                    toster_message('Success', returnData.message, 'success');
                }

            },
            error: function (xhr, textStatus, errorThrown) {

                toster_message('error', 'There was an unknown error that occurred. You will need to refresh the page to continue working.', 'error');
            },
            complete: function () {
                $('input[type="submit"]').val('Submit').removeAttr('disabled');
            }
        });

        return false;

    });
    $(document).on("submit", "form.add_art_exhibition", function (event) {
        var form = $(this);

        var formData = new FormData($('#bluk_dlt_frm')[0]);
        formData.append('exhibition_id', $('.form-control-exhibition').val());
        var formId = $(this).attr('id');
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: formData,
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function () {
                $('.alert.alert-danger').slideUp(500).remove();
                $('input[type="submit"]').val('Please wait..!').attr('disabled', 'disabled');
            },
            success: function (returnData) {

                if (returnData.status == 400) {
                    $('#save_msgList').html("");
                    $('#save_msgList').addClass('alert alert-danger');


                    $.each(returnData.errors, function (key, err_value) {
                        console.log(key, 'key')
                        // $('#save_msgList').append('<li>' + err_value + '</li>');
                        var ind = key.indexOf("[");
                        if (ind != -1) {
                            $(form).find('#span-error-' + key.substring(0, ind)).html(err_value);
                        } else {
                            $(form).find('#span-error-' + key).html(err_value);
                        }
                    });
                    setTimeout(function () {
                        $.each(returnData.errors, function (idx, topic) {
                            // Object.keys(returnData.errors)[0];
                            var ind = idx.indexOf("[");
                            if (ind != -1) {
                                $(form).find('#span-error-' + idx.substring(0, ind)).html('');
                            } else {
                                $(form).find('#span-error-' + idx).html('');
                            }
                        });
                    }
                        , 5000);

                    if (typeof returnData.error != "undefined") {
                        toster_message('error', returnData.error, 'error');
                    }
                } else {
                    get_updated_datatable();
                    ODataTable.ajax.reload();
                    $('#exhibitionModalArt').modal('hide');
                    toster_message('Success', returnData.message, 'success');
                }

            },
            error: function (xhr, textStatus, errorThrown) {

                toster_message('error', 'There was an unknown error that occurred. You will need to refresh the page to continue working.', 'error');
            },
            complete: function () {
                $('input[type="submit"]').val('Submit').removeAttr('disabled');
            }
        });

        return false;

    });


    $('.active_record').change(function () {

        var $url = $(this).data('url')
        $.ajax({
            type: 'POST',
            url: $url,
            data: {
                StateID: StateID
            },
            dataType: 'json',
            success: function (returnData) {
                if (returnData.status == "ok") {
                    $("#City").html('');
                    $('#City').html('<option value=""></option>');
                    //                    $("#City").select2("val", "");
                    $.each(returnData.data, function (idx, topic) {
                        $("#City").append('<option value="' + idx + '">' + topic + '</option>');
                    });
                }
            },
            error: function (xhr, textStatus, errorThrown) {
                toster_message('There was an unknown error that occurred. You will need to refresh the page to continue working.', 'error', 'error');
            },
            complete: function () {
                $('input[type="submit"]').val('Submit').removeAttr('disabled');
            }
        });

    });
    $(document).on("keyup", "#exampleArtSlug", function (event) {
        $('#exampleArtSlug').val(convertToSlug($(this).val()))
    });
    $(document).on("keyup", "#exampleSectionName", function (event) {
        $('#exampleSlugURL').val(convertToSlug($(this).val()))
    });
    $(document).on("keyup", "#exampleArtistName", function (event) {
        $('#exampleArtistSlug').val('artists/' + convertToSlug($(this).val()) + '-artist-painting')
    });
    $(document).on("keyup", "#examplePageName", function (event) {
        $('#examplePageSlug').val(convertToSlug($(this).val()))
    });
    $(document).on("keyup", "#exampleArtTitle", function (event) {
        get_art_slug()

    });
    $(document).on("keyup", "#exampleRefNo", function (event) {
        get_art_slug()

    });
    $(document).on("change", "#ArtistName", function (event) {
        get_art_slug()

    });
    $(document).on("change", "#ArtType", function (event) {
        get_art_slug()

    });
    $(document).on("keyup", "#exampleExhibitionName", function (event) {
        $('#exampleExhibitionSlugURL').val(convertToSlug($(this).val()))
    });
    $(document).on("keyup", "#exampleArtistSlug", function (event) {
        $(this).val(convertToSlug($(this).val()))
    });
    $(document).on("keyup", "#exampleSlugURL", function (event) {
        $(this).val(convertToSlug($(this).val()))
    });
    $(document).on("change", "#switch4", function (event) {
        $.ajax({
            type: 'POST',
            url: BASE_URL + 'common-ajax/get_city',
            data: {
                StateID: StateID
            },
            dataType: 'json',
            success: function (returnData) {
                if (returnData.status == "ok") {
                    $("#City").html('');
                    $('#City').html('<option value=""></option>');
                    //                    $("#City").select2("val", "");
                    $.each(returnData.data, function (idx, topic) {
                        $("#City").append('<option value="' + idx + '">' + topic + '</option>');
                    });
                }
            },
            error: function (xhr, textStatus, errorThrown) {
                toster_message('There was an unknown error that occurred. You will need to refresh the page to continue working.', 'error', 'error');
            },
            complete: function () {
                $('input[type="submit"]').val('Submit').removeAttr('disabled');
            }
        });
    });



});

function convertToSlug(Text) {

    return Text.toLowerCase().replace(/ /g, '-').replace(/[]+/g, '');
}

function get_size_id() {
    var Depth = $('#exampleDepth').val()
    var Heigth = $('#exampleHeight').val()
    var Width = $('#exampleWidth').val()
    $.ajax({
        type: 'POST',
        url: 'art/get-size',
        data: {
            Depth: Depth,
            Heigth: Heigth,
            Width: Width,
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        dataType: 'json',
        success: function (returnData) {
            if (returnData.status == "200") {
                if (returnData.size_id > 0) {
                    $('.SizeID').val(returnData.size_id).trigger('change');
                    $('.SizeHidden').val(returnData.size_id);
                } else {
                    $('.SizeID').val(null).trigger('change');
                    $('.SizeHidden').val('');

                }
            }
        },
        error: function (xhr, textStatus, errorThrown) {
            toster_message('There was an unknown error that occurred. You will need to refresh the page to continue working.', 'error', 'error');
        },
        complete: function () {
            $('input[type="submit"]').val('Submit').removeAttr('disabled');
        }
    });
    return false;

}

function get_art_slug() {
    $('#exampleArtSlug').val(convertToSlug($('#exampleArtTitle').val()))

    var ArtistName = convertToSlug($("#ArtistName option:selected").text());
    var selText = 'Painting';
    var selArtText = '';
    var flag = 0;
    $("#ArtType option:selected").each(function () {
        var $this = $(this);
        if ($this.length) {
            flag = 1
            selText = $this.text();
            if (selArtText == '') {
                selArtText = selArtText + '' + selText
            } else {
                selArtText = selArtText + '-' + selText

            }
        }
    });
    if (flag == 0) {
        selText = 'Painting';
    } else {
        selText = selArtText
    }
    selText = convertToSlug(selText);
    var RefNo = $("#exampleRefNo").val();
    $('#exampleArtSlug').val('buy-' + selText + '-of-' + ArtistName + '-on-online-art-gallery-ref-no-' + RefNo)

}