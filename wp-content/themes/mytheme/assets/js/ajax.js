

jQuery(document).ready(function($){
        $('#myform .br').click(function(){

            // declaring an array
            var choices = {};

            $('.contents').remove();
            // $('.response').empty();

            $('input[type=checkbox]:checked').each(function() {
                if (!choices.hasOwnProperty(this.name)) 
                    choices[this.name] = [this.value];
                else 
                    choices[this.name].push(this.value);
            });


            console.log(choices);
            var ajaxurl = $('#myform').attr('href');
            var ajaxurl = $('.response');

            $.ajax({
                // url: ajaxobject.ajaxurl,
                url: ajaxobject.ajaxurl,
                type :'POST',
                data : {
                    'action' : 'call_post', // the php name function
                    'choices' : choices,
                },
                success: function (result) {
                    $('.response').html(result);
                    // just for test - success (you can remove it later)
                    //console.log(result);
                    console.log(choices);
                },
                error: function(err){
                    // just for test - error (you can remove it later)
                    console.log(err);
                    console.log(choices);
                }
            });
        })
    });