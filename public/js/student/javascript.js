$(document).ready(function () {
    $('.collapsibleMenu').collapsible();
    $('.collapsibleSchedule').collapsible();


    $('#scheduler').modal();
    $('#eventModal').modal();
    $('.tabs').tabs();
    $('select').formSelect();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })
    if($('#calendar_lessondate').length > 0){
        $('#calendar_lessondate').fullCalendar({
            defaultView: 'month',
            events: events,
            timeFormat: 'h:mm',
            eventClick:  function(event, jsEvent, view) {
                if(event.status == 'open'){
                    $('#eventModal').modal('open');
                    $.get( '/lessonDate/showRegistrationForm/'+event.lessonDate_id, function( data ) {
                        console.log(data);
                        $('#eventModal').html('');
                        $('#eventModal').append(data);
                        $('select').formSelect();
                    });
                }
            },
        });
    }

    $('body').on('click', '.lessonDateCancelBtn' , function (e){
        e.preventDefault();
        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            $.get( $(this).attr('href'), function( data ) {
                location.reload();
            });
        })
    });

    $('body').on('click', '.collapsibleSchedule', function () {
        var target = $(this).find('li.active .collapsible-body');

        $('html, body').animate({
            scrollTop: target.offset().top
        }, 1000);
    });

    $('body').on('click', '.btnScheduleLessonsBack', function () {
        var target = $('.collapsibleSchedule').find('li.active');
        $('.collapsible').collapsible('close',target.index());
    });


    $('body').on('click','.lessonDateRegisterBtn', function () {

        if($('#skill-field :selected').val() !== '0'){
            $.ajax({
                url: '/lessonDate/postRegistrationForm',
                type: 'POST',
                dataType: 'JSON',
                data: {'lessonDate_id' : $(this).attr('id'), 'skill' : $('#skill-field :selected').text()},
                success: function (data) {
                    swal({
                        title: 'Successfully scheduled lesson',
                        text: "We send your an email",
                        type: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ok!'
                    }).then((result) => {
                        window.location.replace("/account/appointments");
                    })
                }
            });
        }else{

        }
    });
});


