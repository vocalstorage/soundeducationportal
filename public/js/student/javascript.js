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
    $('.dropdown-trigger').dropdown();
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

    $('.card-studio-description').matchHeight({'byRow' : true});
    $('.card-studio-title').matchHeight({'byRow' : true});


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

    if ($('#calendar_lessondate').length > 0) {
        var view = "month";
        if (window.innerWidth < 600) {
            view = "listWeek";
        }
        $('#calendar_lessondate').fullCalendar({
            header: {
                left: 'myCustomButton',
                center: 'title',
                right: 'today, prev,next'
            },
            defaultView: view,
            events: events,
            timeFormat: 'H:mm',
            eventClick: function (event, jsEvent, view) {
                if (event.status == 'open') {
                    $('#eventModal').modal('open');
                    $('#eventModalLoader').show();
                    $('.event-modal-content').html('');
                    $.get('/student/registration/show/' + event.lessonDate_id, function (data) {
                        $('.event-modal-content').fadeOut(200, function () {
                            $('.event-modal-content').append(data);
                            $('#eventModalLoader').hide();
                            $('.event-modal-content').fadeIn(200, function () {
                                $('#eventTabs').tabs();
                            })
                            $('select').formSelect();
                        });
                    });
                }
            },
        });
    }


    $('body').on('click', '.collapsibleSchedule', function () {
        var target = $(this).find('li.active .collapsible-body');

        $('html, body').stop().animate({
            scrollTop: target.offset().top
        }, 500);
    });

    $('body').on('click', '.btnScheduleLessonsBack', function () {
        var target = $('.collapsibleSchedule').find('li.active');
        $('.collapsible').collapsible('close', target.index());
    });


    $('body').on('click', '.lessonDateRegisterBtn', function () {
        swal({
        title: 'Aan het inschrijven'
        });
        swal.showLoading();
        $.ajax({
            url: '/student/registration/store',
            type: 'POST',
            dataType: 'JSON',
            data: {'lesson_date_id': $(this).attr('data-id'), 'skill': $('#skill-field :selected').val()},
            success: function (data) {
                if (data) {
                    swal({
                        title: 'Succesvol ingeschreven',
                        text: "Email confirmatie is verzonden",
                        type: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ok!'
                    }).then((result) => {
                        if (result) {
                            window.location.replace("/student/account/appointments");
                        } else {
                            swal({
                                type: 'error',
                                title: 'Oops...',
                                text: 'Er is iets verkeerd gegaan!',
                            })
                        }
                    })
                }
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                var errors = JSON.parse(XMLHttpRequest.responseText).errors;
                var html = '';
                console.log(JSON.parse(XMLHttpRequest.responseText));

                $.each(errors, function (key,message) {
                    html += '<p class=error>' + message + '</p>';
                });

                if (!html) {
                    html = 'Er is iets fout gegaan!';
                }

                swal({
                    type: 'error',
                    title: 'Oeps...',
                    html: html,
                })
            }
        });

    });

    if ($('.succes-msg').length > 0) {
        swal({
            type: 'success',
            title: $('.succes-msg').attr('data-message'),
            confirmButtonClass: 'btn waves-effect blue ligthen-1 swal-custom-btn',
        });
        $('.swal2-styled').removeClass('swal2-styled');
    }

    $('.overlay').fadeTo('slow', 0.9);


    $('body').on('click', '.btn-comment', function () {
        $('#comment-' + $(this).attr('data-id')).toggle();
        $('#message-' + $(this).attr('data-id')).toggle();
    });

    $('.fc-button').addClass('btn waves-effect').removeClass('fc-state-default');

    $("body").on("click", ".swal-show-warning-confirm", function (e) {
        e.preventDefault();

        var elem = $(this);


        confirmDelete($(this).attr('data-title'), $(this).attr('data-message'), $(this).attr('data-confirm'), $(this).attr('data-loading-message'), elem);
    });

    $('body').on('click', '.show-swal-loading', function () {
        var message = "aan het laden";

        if ($(this).attr('data-message')) {
            message = $(this).attr('data-message');
        }
        swal({
            title: message
        });
        swal.showLoading();
    });

    $("body").on("click", ".swal-show-warning", function (e) {
        e.preventDefault();

        swal({
            title: $(this).attr('data-title'),
            html: $(this).attr('data-message'),
            confirmButtonClass: 'btn waves-effect blue ligthen-1 swal-custom-btn',
            confirmButtonText: 'oke',
            type: 'warning',
        });
        $('.swal2-styled').removeClass('swal2-styled');
    });
});


function confirmDelete(title, html, confirmtext, loadMessage, elem) {
    swal({
        title: title,
        html: html,
        type: 'warning',
        showCancelButton: true,
        confirmButtonClass: 'btn waves-effect blue ligthen-1 swal-custom-btn',
        cancelButtonClass: 'btn waves-effect red ligthen-1 swal-custom-btn',
        confirmButtonText: confirmtext
    }).then((result) => {
        if (result.value) {
            swal({
                title: loadMessage
            });
            swal.showLoading();
            $.get(elem.attr('href'), function (data) {
                if (data) {
                    location.reload();
                }
            });
        }
    })
    $('.swal2-styled').removeClass('swal2-styled');
}


