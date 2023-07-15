$(document).ready(function () {
    int_open_close_grid();

    $('#load_more_content').scrollPagination({
        url: BASE_URL + '/home/get_images',
        int_fun: 'int_open_close_grid()',
        nop: 15, // The number of posts per scroll to be loaded
        offset: 0, // Initial offset, begins at 0 in this case
        error: '<div class="alert alert-error"><a href="javascript:;" class="link">No More Notice Board!</a></div>', // When the user reaches the end this is the message that is
        // displayed. You can change this if you want.
        delay: 500, // When you scroll down the posts will load after a delayed amount of time.
        // This is mainly for usability concerns. You can alter this as you see fit
        scroll: true, // The main bit, if set to false posts will not load as the user scrolls. 
        // but will still load if the user clicks.
    });
});