<x-master-layout>
    @section('head')
        <!-- روابط FullCalendar -->
        <link href="https://cdn.jsdelivr.net/npm/fullcalendar@3.10.2/dist/fullcalendar.min.css" rel="stylesheet" />

        <style>
            #calendar {
                max-width: 900px;
                margin: 0 auto;
            }

            .modal-header {
                background-color: #3f51b5;
                color: white;
            }

            /* تعديل طريقة عرض العمود الأول (التوقيت) */
            .fc-axis {
                text-align: left;
                padding-left: 10px;
                background-color: #f8f9fa;
                border-right: 1px solid #ddd;
            }

            /* خطوط منقطة للوقت */
            .fc-time-grid .fc-slats table tbody tr td {
                border-bottom: 1px dotted #ddd;
            }

            /* تخصيص مؤشر الوقت الحالي */
            .fc-now-indicator-line {
                background-color: transparent;
                border-top: 1px dotted red;
            }

            .fc-now-indicator-time {
                color: #ff0000 !important;
                font-weight: bold;
                font-size: 12px;
                position: absolute;
                transform: translateX(-100%);
            }

        </style>
    @endsection

    <!-- الكود الأساسي الخاص بك -->
    <div class="container-fluid">
        <div class="row">
            <!-- قسم إضافي للتقويم -->
            <div class="col-md-12">
                <div class="col-md-12">
                    <!-- التابات الخاصة بالغرف -->
                    <ul class="nav nav-tabs" id="roomTabs" role="tablist">
                        <!-- سيتم ملء التابات ديناميكيًا عبر AJAX -->
                    </ul>

                </div>
                    <!-- محتويات التاب -->
                    <div class="tab-content" id="roomTabsContent">
                        <!-- سيتم ملء محتويات الغرف ديناميكيًا عبر AJAX -->
                    </div>
                </div>
                   <!--  تفاصيل -->
                <div class="modal fade" id="eventDetailsModal" tabindex="-1" aria-labelledby="eventDetailsModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header bg-primary text-white">
                                <h5 class="modal-title">{{__('messages.DetailsEvent')}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- تصميم بطاقة التفاصيل -->
                                <div class="container">
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <div class="info-box d-flex justify-content-between">
                                                <strong>{{__('messages.Coach')}}</strong>
                                                <span id="eventCoach" class="text-muted"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="info-box d-flex justify-content-between">
                                                <strong>{{__('messages.Classe')}}</strong>
                                                <span id="eventClass" class="text-muted"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <div class="info-box d-flex justify-content-between">
                                                <strong>{{__('messages.Time')}}</strong>
                                                <span id="eventTime" class="text-muted"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="info-box d-flex justify-content-between">
                                                <strong>{{__('messages.Shift')}}</strong>
                                                <span id="eventShift" class="text-muted"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer d-flex justify-content-between">
                                <button type="button" class="btn btn-danger" id="deleteEventBtn">{{__('messages.delete')}}</button>
                                <button type="button" class="btn btn-primary" id="editEventBtn">{{__('messages.Update')}}</button>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- نافذة إضافة الحدث -->
             
                <!-- نافذة تعديل الحقول -->
                <div class="modal fade" id="addEventModal" tabindex="-1" aria-labelledby="addEventModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">{{__('messages.addEventnew')}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="addEventForm">
                                    <!-- اختيار المدرب -->
                                    <div class="form-group">
                                        <label for="coachId">{{__('messages.Coach')}}</label>
                                        <select id="coachId" name="coachId" class="form-control select2js" required>
                                            @foreach ($coaches as $coach)
                                                <option value="{{ $coach->id }}">{{ $coach->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- اختيار الصف -->
                                    <div class="form-group">
                                        <label for="subscription">{{__('messages.Classe')}}</label>
                                        <select id="subscription" name="subscriptionId" class="form-control select2js"
                                            required>
                                        </select>
                                    </div>

                                    <!-- وقت البداية -->
                                    <div class="form-group">
                                        <label for="eventStartTime">{{__('messages.From_Hour')}}</label>
                                        <input type="time" class="form-control" id="eventStartTime" required>
                                    </div>

                                    <!-- وقت النهاية -->
                                    <div class="form-group">
                                        <label for="eventEndTime">{{__('messages.To_Hour')}}</label>
                                        <input type="time" class="form-control" id="eventEndTime" required>
                                    </div>

                                    <!-- اختيار الشيفت -->
                                    <div class="form-group">
                                        <label>{{__('messages.Shift')}}</label>
                                        <div class="d-flex flex-wrap">
                                            @for ($i = 1; $i <= 15; $i++)
                                                <div class="form-check mr-2">
                                                    <input class="form-check-input" type="radio" name="shift"
                                                        id="shift{{ $i }}" value="{{ $i }}"
                                                        required>
                                                    <label class="form-check-label" for="shift{{ $i }}">{{__('messages.Shift')}}
                                                        {{ $i }}</label>
                                                </div>
                                            @endfor
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary">{{__('messages.add_Event')}}</button>
                                </form>


                            </div>
                        </div>
                    </div>
                </div>
       
                <!-- نهاية نافذة الحدث -->
            </div>
        </div>
    </div>

    @section('bottom_script')
        <!-- روابط JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.10.2/dist/fullcalendar.min.js"></script>

        <script>

            $(document).ready(function () {
    const eventColors = ['#3f51b5', '#e91e63', '#ff9800', '#4caf50', '#9c27b0', '#009688', '#2196f3'];

    // جلب قائمة الغرف عبر API
    $.ajax({
        url: "{{ route('Room') }}", // تأكد من إعداد هذا المسار
        type: "GET",
        success: function (response) {
            if (response.status === 200) {
                const rooms = response.data;

                if (rooms.length === 0) {

                const noRoomsHtml = `
                    <div class="d-flex justify-content-center align-items-center" style="height: 300px;">
                        <div class="alert alert-warning text-center" role="alert" style="font-size: 1.5rem; font-weight: bold;">
                            {{ __('messages.no_rooms') }}
                        </div>
                    </div>
                `;

                $("#roomTabsContent").html(noRoomsHtml);
                return;
            }

                // إنشاء التابات ومحتوى التاب لكل غرفة
                let tabsHtml = "";
                let contentHtml = "";
                rooms.forEach((room, index) => {
                    const isActive = index === 0 ? "active" : "";
                    tabsHtml += `
                        <li class="nav-item">
                            <a class="nav-link ${isActive}" id="room-tab-${room.id}"
                                data-toggle="tab" href="#room-${room.id}" role="tab"
                                aria-controls="room-${room.id}" aria-selected="${index === 0}">
                                ${room.name}
                            </a>
                        </li>
                    `;

                    contentHtml += `
                        <div class="tab-pane fade ${isActive ? "show active" : ""}" id="room-${room.id}"
                            role="tabpanel" aria-labelledby="room-tab-${room.id}">
                            <div class="card">
                                <div class="card-body">
                                    <div id="calendar-room-${room.id}"></div>
                                </div>
                            </div>
                        </div>
                    `;
                });

                $("#roomTabs").html(tabsHtml);
                $("#roomTabsContent").html(contentHtml);

                // تهيئة تقاويم الغرف
                rooms.forEach((room) => {
                    initializeCalendar(room.id);
                });

                // إعادة تحميل التقويم عند التبديل بين التابات
                $('a[data-toggle="tab"]').on("shown.bs.tab", function (e) {
                    const roomId = $(e.target).attr("href").replace("#room-", "");
                    $(`#calendar-room-${roomId}`).fullCalendar("render");
                });
            }
        },
    });

    // تهيئة التقويم لغرفة معينة
    function initializeCalendar(roomId) {
        $(`#calendar-room-${roomId}`).fullCalendar({
       header: {
    left: "",
    center: "title",
    right: "" // إزالة جميع أزرار التنقل
},

buttonText: {
    today: "Today",
    month: "Month",
    week: "Week",
    day: "Day"
},
        defaultView: "agendaWeek", // العرض الافتراضي هو أسبوع
        defaultDate: moment().startOf('isoWeek'), // تثبيت الأسبوع الحالي
        titleFormat: 'dddd', // عرض اسم اليوم فقط في العنوان
        slotDuration: "00:15:00", // مدة الفواصل الزمنية (15 دقيقة)
        slotLabelInterval: "01:00", // تكرار التسمية كل ساعة
        slotLabelFormat: ["h:mm A"], // صيغة التوقيت (AM/PM)
        minTime: "00:00:00", // الوقت الأدنى للعرض (منتصف الليل)
        maxTime: "24:00:00", // الوقت الأقصى للعرض (نهاية اليوم)
        allDaySlot: false, // إخفاء خيار "كل اليوم"
        editable: true, // تمكين تعديل الأحداث
        selectable: true, // تمكين تحديد الفواصل الزمنية
        selectHelper: true, // عرض مساعد التحديد
        firstDay: 1, // بداية الأسبوع (1 = الاثنين)
        nowIndicator: true, // مؤشر الوقت الحالي
        navLinks: false, // تعطيل روابط التنقل بين الأيام أو العناوين

            events: function (start, end, timezone, callback) {
    $.ajax({
        url: "{{ route('SubscriptionCoach') }}",
        type: "GET",
        data: { roomId: roomId },
        success: function (response) {
            if (response.status === 200) {
                const events = [];

                // جلب الأحداث من الخادم
                response.data.forEach((event) => {
                    const dayOfWeek = event.dayOfWeek; // اليوم المحدد
                    const currentStart = moment(start); // بداية الفترة المعروضة على التقويم
                    const currentEnd = moment(end); // نهاية الفترة المعروضة

                    // إنشاء أحداث لكل أسبوع في الفترة الحالية
                    while (currentStart <= currentEnd) {
                        const eventDate = currentStart.isoWeekday(dayOfWeek); // تثبيت اليوم
                        if (eventDate >= start && eventDate <= end) {
                            // إضافة الحدث لهذا الأسبوع
                            events.push({
                                id: event.id,
                                title: event.subscription.name,
                                start: eventDate.format('YYYY-MM-DD') + 'T' + event.fromHouer,
                                end: eventDate.format('YYYY-MM-DD') + 'T' + event.toHouer,
                                description: `Coach: ${event.coach.name}, Period: ${event.period}`,
                                backgroundColor: eventColors[event.dayOfWeek % eventColors.length],
                                borderColor: eventColors[event.dayOfWeek % eventColors.length],
                            });
                        }
                        // انتقل إلى الأسبوع التالي
                        currentStart.add(1, 'weeks');
                    }
                });

                callback(events); // عرض الأحداث
            }
        },
        error: function (error) {
            console.log("Error fetching events:", error);
        }
    });
},



eventClick: function(event) {

    // تعبئة تفاصيل الحدث
    $("#eventCoach").text(event.description.split(", ")[0].split(": ")[1]); // جلب اسم المدرب
    $("#eventClass").text(event.title); // اسم الصف
    $("#eventTime").text(moment(event.start).format("h:mm A") + " - " + moment(event.end).format("h:mm A")); // الوقت
    $("#eventShift").text(event.description.split(", ")[1].split(": ")[1]); // الشيفت

    // عرض النافذة
    $("#eventDetailsModal").modal("show");

    // حفظ معرف الحدث لاستخدامه في التعديل أو الحذف
    $("#deleteEventBtn").data("eventId", event.id);
    $("#editEventBtn").data("event", event);
   

},




            select: function (start, end) {
                // فتح نافذة الإضافة عند اختيار حدث جديد
              
                $("#addEventModal").modal("show");
                $("#addEventForm").data("eventStart", start);
                $("#addEventForm").data("eventEnd", end);
                $("#addEventForm").data("roomId", roomId);
                var dayOfWeek = moment(start).isoWeekday(); // ISO weekday: 1=الاثنين, 2=الثلاثاء, ..., 7=الأحد
                $('#addEventForm').data('dayOfWeek', dayOfWeek);
            },
        });
    }



    $("#coachId").on("change", function() {
        const select2 = document.getElementById('subscription');
        select2.innerHTML = '<option value="">جارٍ التحميل...</option>';
        $.ajax({
            url: "{{ route('getCoachSubscription') }}",
            method: "POST",
            data: {
                coachId: $(this).val()
            },
            dataType: "json",
            success: function(response) {
                console.log(response.data);
                $("#subscription").empty();
                response.data.forEach(element => {
                    $("#subscription").append('<option value="' + element.id +
                        '">' + element.name + '</option>');
                });
            },
            error: function(error) {
                console.log(error);
            }
        });
    });

    // إضافة حدث جديد
    $("#addEventForm").on("submit", function (e) {
        e.preventDefault();

        const roomId = $(this).data("roomId");
        const startDate = $(this).data("eventStart");
        const endDate = $(this).data("eventEnd");

        const coachName = $('select[name="coachId"] option:selected').val();
        const className = $('select[name="subscriptionId"] option:selected').val();
        const startTime = $("#eventStartTime").val();
        const endTime = $("#eventEndTime").val();
        const shift = $('input[name="shift"]:checked').val();
        var dayOfWeek = $('#addEventForm').data('dayOfWeek');

        if (!coachName || !className || !startTime || !endTime || !shift) {
            alert("Please fill all required fields.");
            return;
        }

        $.ajax({
            url: "{{ route('addSubscriptionCoach') }}",
            method: "POST",
            data: {
                'coachId': coachName,
                'subscriptionId': className,
                'roomId': roomId,
                'fromHouer': startTime,
                'toHouer': endTime,
                'period': shift,
                'dayOfWeek': dayOfWeek // إرسال رقم اليوم
            },
            success: function (response) {
                $(`#calendar-room-${roomId}`).fullCalendar("refetchEvents");
                $("#addEventModal").modal("hide");
                $("#addEventForm")[0].reset();
            },
        });
    });
});

// حذف الحدث
$("#deleteEventBtn").on("click", function() {
    const eventId = $(this).data("eventId");
    if (confirm("هل أنت متأكد من حذف هذا الحدث؟")) {
        $.ajax({
            url: "{{ route('deleteEvent') }}", // ضع المسار الصحيح لحذف الحدث
            method: "POST",
            data: { subscriptionCoachId: eventId },
            success: function(response) {
                if (response.status === 200) {
                    $(`#calendar-room-${response.roomId}`).fullCalendar("refetchEvents");
                    $("#eventDetailsModal").modal("hide");
                    location.reload();
                }
            },
            error: function(error) {
                console.error("Error deleting event:", error);
            }
        });
    }
});

////تعديل الحدث
$("#editEventBtn").on("click", function() {
    const event = $(this).data("event");

    // تعبئة النموذج بقيم الحدث
    $("#coachId").val(event.description.split(", ")[0].split(": ")[1]).trigger("change");
    $("#subscription").val(event.title).trigger("change");
    $("#eventStartTime").val(moment(event.start).format("HH:mm"));
    $("#eventEndTime").val(moment(event.end).format("HH:mm"));
    $("input[name='shift'][value='" + event.description.split(", ")[1].split(": ")[1] + "']").prop("checked", true);

    // إخفاء نافذة التفاصيل وعرض نافذة الإضافة (للتعديل)
    $("#eventDetailsModal").modal("hide");
    $("#addEventModal").modal("show");

    // تحديث الزر لحفظ التعديل
    $("#addEventForm").off("submit").on("submit", function(e) {
        e.preventDefault();

        const roomId = event.roomId;
        const updatedData = {
            subscriptionCoachId: event.id,
            coachId: $("#coachId").val(),
            subscriptionId: $("#subscription").val(),
            fromHouer: $("#eventStartTime").val(),
            toHouer: $("#eventEndTime").val(),
            period: $("input[name='shift']:checked").val(),
        };

        $.ajax({
            url: "{{ route('updateEvent') }}", // ضع المسار الصحيح للتعديل
            method: "POST",
            data: updatedData,
            success: function(response) {
                $(`#calendar-room-${roomId}`).fullCalendar("refetchEvents");
                $("#addEventModal").modal("hide");
                $("#addEventForm")[0].reset();
                location.reload();
            },
            error: function(error) {
                console.error("Error updating event:", error);
            }
        });
    });
});


            </script>

    @endsection
    <style>
        .fc-toolbar .fc-center {
           display: none !important;
       }
   </style>
   <style>
    /* تحسين تصميم البطاقة */
    .info-box {
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 8px;
        background-color: #f8f9fa;
        margin-bottom: 10px;
        align-items: center; /* محاذاة العناصر عموديًا داخل الصندوق */
    }

    .info-box strong {
        color: #333;
        font-size: 1.1rem;

    }

    .info-box span {
        font-size: 1rem;
        color: #666;
    }

    .modal-header.bg-primary {
        background-color: #007bff;
        color: white;
    }

    .modal-footer .btn {
        width: 100px;
    }

    .modal-lg {
        max-width: 700px;
    }
</style>

</x-master-layout>
