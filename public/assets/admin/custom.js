$(function () {
    $(".datepicker").datepicker();

    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
        theme: 'bootstrap4'
    })

    // Event listener for the brightness toggle button
    $('#brightness-toggle').on('click', function () {
        toggleDarkMode();
    });

    // Function to toggle between dark and light mode
    function toggleDarkMode() {
        // Add/remove a class to switch between dark and light mode styles
        $('body').toggleClass('dark-mode');
    }


});


