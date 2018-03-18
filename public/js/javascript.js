var dates = [];
var datepickerDates = [];
var times = [];
var times_edit = [];
var times_edit_removed = [];
var times_edit_added = [];
var fadeSpeed = 500;
var lesson_date_edit_id = '';
createDatepicker();
$.trumbowyg.svgPath = '/assets/icons.svg';

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$('#description').trumbowyg({
    btns: [
        ['foreColor', 'backColor', 'strong', 'em'],
        ['undo', 'redo'], // Only supported in Blink browsers
        ['formatting'],
        ['strong', 'em'],
        ['superscript', 'subscript'],
        ['link'],
        ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
        ['unorderedList', 'orderedList'],
        ['horizontalRule'],
        ['removeformat'],
        ['fullscreen']
    ]
});

function createDatepicker() {
    $('#datepicker').datepicker({
        dateFormat: "dd-mm-yy",
        beforeShowDay: function (date) {
            if ($.inArray($.datepicker.formatDate('dd-mm-yy', date), datepickerDates) > -1) {
                return [false, '', "Booked out"];

            }
            else {
                return [true, '', "Available"];
            }
        }
    });
}

$("#datepicker").change(function () {
    $("#deadlineForm").fadeIn(300).focus();
});

$("#deadlineNr").change(function () {
    $("#times").fadeIn(300);
});

$("body").on("click", "i", function () {
    var tr = $(this).closest("tr");
    var text = $(tr).first("td").find(".date").text();

    tr.fadeOut("fast", function () {
        tr.remove();
    });

    index = datepickerDates.indexOf(text);
    datepickerDates.splice(index, 1);
    datepickerDates.splice(index, 1);

});

$("body").on("click", "span", function () {
    var span = $(this).closest("span");
    if ($(span).css("background-color") == "rgb(76, 175, 80)") {
        $(span).css({"background-color": "transparent", "color": "black"});
        times = times.filter(function (e) {
            return e !== $(span).text()
        });
        if (times.length == 0) {
            $("#btnAddDate").fadeOut(fadeSpeed);
        }
    } else {
        $(span).css({"background-color": "#4CAF50", "color": "white"});
        times.push($(span).text());
        if ($("#btnAddDate").length == 0) {
            html = '<div class="form-group">\n' +
                '                    <button type="button" class="btn btn-success" id="btnAddDate" style="display: none">Voeg datum toe</button>\n' +
                '                </div>';
            $("#scheduler-form-left").append(html);
            $("#btnAddDate").fadeIn(fadeSpeed);
        } else {
            $("#btnAddDate").fadeIn(fadeSpeed);
        }
    }
});

$("body").on("click", ".span_edit", function () {
    var span = $(this).closest("span");
    //removed
    if ($(span).css("background-color") == "rgb(76, 175, 80)" || $(span).css("background-color") == "rgb(20, 20, 80)") {
        $(span).css({"background-color": "transparent", "color": "black"});
        if(times_edit.indexOf($(span).text()) > -1){
            times_edit_removed.push($(span).text());
        }

        if(times_edit_added.indexOf($(span).text()) > -1){
            times_edit_added = times_edit_added.filter(function (e) {
                return e !== $(span).text()
            });
        }

    } else {
        console.log('erbij');
        $(span).css({"background-color": "#4CAF50", "color": "white"});
        if(times_edit.indexOf($(span).text()) < 0){
            times_edit_added.push($(span).text());
        }
        if(times_edit_removed .indexOf($(span).text()) > -1){
            times_edit_removed  = times_edit_removed .filter(function (e) {
                return e !== $(span).text()
            });
        }
    }
});

$("body").on("click", "#btnAddDate", function () {
    allTimes = "";
    //order times from am to pm
    times.sort();

    $("#datePlaceholder").remove();

    allTimes = times.join();


    var lesson_date = {
        date: $("#datepicker").val(),
        deadline: $("#deadlineNr").val(),
        teacher_id: $("#teacher_id").val(),
        times: times,
    };

    console.log(lesson_date);

    datepickerDates.push($("#datepicker").val());
    createDatepicker();

    html = '<tr class="entries" id="fadeIn" style="display:none;">';
    html += '<td scope="col">' + $("#teacher_id :selected").text();
    +'</td>';
    html += '<td scope="col">' + $("#datepicker").val() + '</td>';
    html += '<td scope="col">' + $("#deadlineNr").val() + '</td>';
    html += '<td scope="col">' + allTimes + '</td>';
    html += '<td scope="col"><a href="#"  class="lesson_date_edit">edit</a></td>';
    html += '<td scope="col"><i class="fa fa-times-circle fa-1x" aria-hidden="true"></i><input type="hidden" name="dates[]" value="' + encodeURIComponent(JSON.stringify(lesson_date)) + '"></td>';
    html += '</tr>';

    if ($("#btnMakeLesson").length == 0) {
        $("#lesson_header").append('<button class="btn btn-success" id="btnMakeLesson">Maak les aan</button>');
    } else {
        $("#lesson_header").fadeIn(fadeSpeed);
    }

    $("span").css({"background-color": "transparent", "color": "black"});
    $("#btnAddDate").fadeOut(fadeSpeed);
    $("#dates-table-items").append(html);
    $('tr.entries').each(function () {
        var $this = $(this),
            t = this.cells[0].textContent.split('-');
        $this.data('_ts', new Date(t[2], t[1] - 1, t[0]).getTime());
    }).sort(function (a, b) {
        return $(a).data('_ts') > $(b).data('_ts');
    }).appendTo($('.tbodyDate'));

    $("#fadeIn").fadeIn(fadeSpeed).removeAttr('id');
    $("#times").fadeOut(fadeSpeed);
    $("html, body").animate({scrollTop: 0}, 1000);
    $("#datepicker").val("");
    $("#deadlineForm").fadeOut(fadeSpeed);
    $("#deadlineNr").val("");
    times = [];
    dates = [];

});

$("body").on("click", "#btnMakeLesson", function () {

    if (!$('#lessonTitle').val()) {
        swal(
            'Oops...',
            'Titel is nog niet ingevuld',
            'error'
        )
    } else if (!$('#description').text()) {
        swal(
            'Oops...',
            'Beschrijving is nog niet ingevuld.',
            'error'
        )
    } else {

    }
});

$("body").on("click", ".btnShowLessonDates", function () {
    if ($('#showLessonDates' + $(this).attr('id')).attr('class') !== "collapsing") {
        if ($('#showLessonDates' + $(this).attr('id')).attr('class') == "collapse") {
            $('.last').hide();
            $('#trShowLessonDates' + $(this).attr('id')).addClass('last');
            $('#trShowLessonDates' + $(this).attr('id')).show();
        }
        if ($('#showLessonDates' + $(this).attr('id')).attr('class') == "collapse show") {
            $('#trShowLessonDates' + $(this).attr('id')).hide();
        }
    }
});

$(" body").on("click", ".lesson_date_edit", function () {
    //$(this).closest().attr('id');
    $.ajax({
        url: '/admin/lesson_date/edit',
        type: 'POST',
        dataType: 'JSON',
        data: {lesson_date_id: $(this).attr('id')},
        success: function (data) {
            $('#lesson_date_form').modal('show');
            $('.modal-body').html(data[0].html);
            lesson_date_edit_id = data[0].lesson_date_edit_id;
            times_edit = data[0].times;
            console.log(data[0].lesson_date_edit_id);
        }
    });
});

$(" body").on("click", ".lesson_date_update", function () {
    //$(this).closest().attr('id');
    $.ajax({
        url: '/admin/lesson_date/update',
        type: 'POST',
        dataType: 'JSON',
        data: {lesson_date_id: lesson_date_edit_id, times_edit_added: times_edit_added,times_edit_removed: times_edit_removed, teacher_id: $("#teacher_id").val()},
        success: function (data) {
            console.log(data.success);
        }
    });
});

