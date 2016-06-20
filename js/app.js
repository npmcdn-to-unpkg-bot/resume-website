//INIT FOUNDATION
$(document).foundation();

//SKILLS BLOCK
$(document).ready(function () {
    $.ajax({
        dataType: 'html',
        url: '../fetch_skills.php',
        success: function (data) {
            //append returned html to dom
            $('.mastrianni_skills_wrapper').append(data);
            
            //init foundation tooltips on returned html
            $('.mastrianni_skills_wrapper').foundation();
            
            //wait for images to load before firing isotope
            $(window).load(function () {
                
                //check that isotope loaded successfully
                if ($.fn.isotope) {
                    var $grid = $('.mastrianni-iso-grid').isotope({
                        itemSelector: '.mastrianni-iso-grid-item',
                        percentPosition: true,
                        layoutMode: 'fitRows'
                    });
                    // filter items on button click
                    $('.filter-button-group').on('click', 'a', function () {
                        //removes class from all filter buttons
                        $('.filter-button-group .button').removeClass("current");
                        //adds the class to whichever filter button was clicked
                        $(this).addClass("current");
                        var filterValue = $(this).attr('data-filter');
                        $grid.isotope({ filter: filterValue });
                    });                  
                }
            });
        }
    });
});

//CONTACT FORM
$(document).ready(function () {
    //VARS
	var form = $('#mastrianni_ajax_contact'); //<form>
	var formMsgWrapper = $('#m_success_error_wrapper'); //Error message wrapper
	var formMessages = $('#m_success_error'); //Error message <p> tag

	//Prevent default form behavior when form submit is clicked
	$(form).submit(function(e) {e.preventDefault();});
    
    //Check that abide validation passed
    $(form).on("formvalid.zf.abide", function() {
        //Serialize data
        var formData = $(form).serialize();
        //AJAX REQUEST
        $.ajax({
            type: 'POST',
            url: $(form).attr('action'),
            data: formData
        })
        //AJAX SUCCESS
        .done(function(response) {
            //Show success message wrapper
            $(formMsgWrapper).removeClass('alert');
            $(formMsgWrapper).addClass('success');
            $(formMsgWrapper).show();
            //Set success message text.
            $(formMessages).text(response);
            //Clear the form
            $('#name').val('');
            $('#email').val('');
            $('#phone').val('');
            $('#comments').val('');
            //Reset recaptcha
            grecaptcha.reset();            
        })
        //AJAX FAILURE
        .fail(function(data) {
            //Show error message wrapper
            $(formMsgWrapper).removeClass('success');
            $(formMsgWrapper).addClass('alert');            
            $(formMsgWrapper).show();
            //Set error message text.
            if (data.responseText !== '') {
                $(formMessages).text(data.responseText);
            } else {
                $(formMessages).text('Oops! An error occured and your message could not be sent.');
            }
            //Reset recaptcha
            grecaptcha.reset();            
        });
	});
});
