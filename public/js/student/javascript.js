$(document).ready(function () {
    $('.collapsibleMenu').collapsible();

    $('.collapsibleSchedule').collapsible();
    $('#scheduler').modal();
    $('#eventModal').modal();
    $('.tabs').tabs();
    $('select').formSelect();
    $('.sidenav').sidenav();
    $('.tooltipped').tooltip();
    $('.tooltipped2').tooltip();

    $('select[required]').css({
        display: 'inline',
        position: 'absolute',
        float: 'left',
        padding: 0,
        margin: 0,
        border: '1px solid rgba(255,255,255,0)',
        height: 0,
        width: 0,
        top: '2em',
        left: '3em'
    });


    $('.tooltipped-error').tooltip({delay: 50}).each(function () {
        var background = $(this).data('background-color');
        if (background) {
            $("#" + $(this).data('tooltip-id')).find(".backdrop").addClass(background);
        }
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    if($('#calendar_lessondate').length > 0){
        $('#calendar_lessondate').fullCalendar({
            defaultView: 'month',
            events: events,
            timeFormat: 'h:mm',
            eventClick:  function(event, jsEvent, view) {
                if(event.status == 'open'){
                    $('#eventModal').modal('open');
                    $.get( '/student/registration/show/'+event.lessonDate_id, function( data ) {
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
        if($(this).attr('data-cancelled') == '2'){
            swal({
                title: 'Weet je zeker dat je wilt uitschijven?',
                text: "Dit is de laatste keer dat je kunt uitschrijven!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ja, schrijf mij uit!',
                cancelButtonText: 'Nee',

            }).then((result) => {
                $.get( $(this).attr('href'), function( data ) {
                    location.reload();
                });
            });

        }
        $.get( $(this).attr('href'), function( data ) {
            location.reload();
        });

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
            swal({
                title: 'Aan het inschrijven'
            });
            swal.showLoading();
            $.ajax({
                url: '/student/registration/store',
                type: 'POST',
                dataType: 'JSON',
                data: {'lessonDate_id' : $(this).attr('data-id'), 'skill' : $('#skill-field :selected').text()},
                success: function (data) {
                    swal({
                        title: 'Succesvol ingeschreven',
                        text: "Email confirmatie is verzonden",
                        type: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ok!'
                    }).then((result) => {
                        if(result){
                            window.location.replace("/student/account/appointments");
                        }else{
                            swal({
                                type: 'error',
                                title: 'Oops...',
                                text: 'Er is iets verkeerd gegaan!',
                            })
                        }
                    })
                }
            });
        }
    });

    if($('.succes-msg').length > 0){

        swal({
            type: 'success',
            title:  $('.succes-msg').attr('data-message'),
            showConfirmButton: true,
        });
    }

    $('.overlay').fadeTo('slow' , 0.9 );

    $('body').on('click','.btn-comment', function () {
        $('.message, .comment').toggle(500);

    });

    $('.fc-button').addClass('btn waves-effect');
});


