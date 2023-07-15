function int_open_close_grid() {
//    $('.notification-messages-notice .clickable').unbind().bind('click', function () {
//        var el = jQuery(this).parents(".notification-messages-notice").children(".notification-messages-notice-body");
//        el.slideToggle(200);
//    });

    $('.notification-messages-notice a.remove').unbind().bind('click', function () {
            var id = $(this).parents('.notification-messages-notice').attr('id');
                var removable = jQuery(this).parents(".notification-messages-notice");
//                if (removable.next().hasClass('notification-messages-notice') || removable.prev().hasClass('notification-messages-notice')) {
//                    var remove_note = jQuery(this).parents(".notification-messages-notice");
//                    var temp = 1;
//                } else {
//                    var remove_note = jQuery(this).parents(".notification-messages-notice");
//                    var temp = 0;
//                }
//                alert(temp);
        $.alert.open('confirm', 'Are you sure you want to remove this Notice?', function (button) {
            if (button == 'yes') {
                $.ajax({
                    type: 'POST',
                    url: BASEURL + 'notice_board/delete_notice',
                    data: {id: id},
                    dataType: 'json',
                    success: function (returnData) {
                        if (returnData.status == "ok") {
                                removable.remove();
//                            if(temp == 1){
//                                remove_note.remove();
//                            }else{
//                                remove_note.parent().remove();
//                            }
                            if($.trim($("#load_more_content .load_more_content").html()).length == 0) {
                                $(".notice-error").removeClass('hidden');
                            }
                            toster_message(returnData.message, returnData.heading, 'success');

                        } else if (returnData.status == "error") {
                            toster_message(returnData.message, returnData.heading, 'error');
                        }
                    },
                });
            }
        });
    });
}
(function ($) {
    

    $.fn.scrollPagination = function (options) {

        var settings = {
            nop: 10, // The number of posts per scroll to be loaded
            offset: 0, // Initial offset, begins at 0 in this case
            error: 'No More Posts!', // When the user reaches the end this is the message that is
            int_fun: '',
            // displayed. You can change this if you want.
            delay: 500, // When you scroll down the posts will load after a delayed amount of time.
            // This is mainly for usability concerns. You can alter this as you see fit
            scroll: true, // The main bit, if set to false posts will not load as the user scrolls. 
                    // but will still load if the user clicks.
        }

        // Extend the options so they work with the plugin
        if (options) {
            $.extend(settings, options);
        }

        // For each so that we keep chainability.
        return this.each(function () {


            // Some variables 
            $this = $(this);
            $settings = settings;
            var offset = $settings.offset;
            
            var busy = false; // Checks if the scroll action is happening 
            // so we don't run it multiple times

            // Custom messages based on settings
            if ($settings.scroll == true)
                $initmessage = 'Scroll for more or click here';
            else
                $initmessage = 'Click for more';

            // Append custom messages and extra UI
            // $this.append('<div class="content"></div><div class="loading-bar">' + $initmessage + '</div>');
           // $this.append('<center><img src="'+ BASEURL +'assets/images/wait_loader.gif" id="loader" class="loader"/></center>');
            $this.append('<div class="load_more_content row justify-content-center"></div><!--center><button class="btn btn-primary btn-large loading-bar">' + $initmessage + '</button></center -->');
            function getData() {
                alert('92')
                // Post data to ajax.php
                $.post($settings.url, {
                    action: 'scrollpagination',
                    number: $settings.nop,
                    offset: offset,
                   
                }, function (data) {

                    // Change loading bar content (it may have been altered)
                    // setTimeout(function () {
                        $this.find('.loading-bar').html($initmessage);
                     //}, 1000);   
                    // If there is no data returned, there are no more posts to be shown. Show error
                    if (data == "") {
                        if(($.trim($this.find('.load_more_content').html()).length == 0) || (offset == 0)) {
                            $("#load_more_content .load_more_content").html('');
                            $(".notice-error").removeClass('hidden');
                        }
                        $this.find('.loading-bar').html($settings.error);
                        $(".loader").css('display','none');
                        //$(".loading-bar").css('display','none');
                        $(".loading-bar").prop('disabled', true);                        
                        $('body').css('opacity','1');    
                    }
                    else {
                        $(".notice-error").addClass('hidden');
                        // Offset increases
                        offset = offset + $settings.nop;

                        // Append the data to the content div
                            setTimeout(function () {
                                $this.find('.load_more_content').append(data);
                                $(".loader").css('display','none');
                                $('body').css('opacity','1');
                            
                        // No longer busy!	
                        busy = false;
                        int_open_close_grid();
                        }, 1000);
                    }

                });

            }

            getData(); // Run function initially

            // If scrolling is enabled
            if ($settings.scroll == true) {
                // .. and the user is scrolling
                $(window).scroll(function () {

                    // Check the user is at the bottom of the element
                    if ($(window).scrollTop() + $(window).height() > $this.height() && !busy) {

                        // Now we are working, so busy is true
                        busy = true;

                        // Tell the user we're loading posts
                        $this.find('.loading-bar').html('Loading ...');
                        $(".loader").css('display','block');
                        $('body').css('opacity','0.7');

                        // Run the function to fetch the data inside a delay
                        // This is useful if you have content in a footer you
                        // want the user to see.
                        setTimeout(function () {

                            getData();

                        }, $settings.delay);

                    }
                });
            }

            // Also content can be loaded by clicking the loading bar/
            $this.find('.loading-bar').click(function () {

                if (busy == false) {
                    busy = true;
                    $(this).html('Loading ...');
                    $(".loader").css('display','block');
                    $('body').css('opacity','0.7');
                    getData();
                }

            });
            
            $(document).on("change", "#Filter_StandardID", function (event) {
                $(".loader").css('display','block');
                $(".load_more_content").html('');
                offset = 0;
                getData();
            });

        });
    }
        
    
})(jQuery);
