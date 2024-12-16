

<x-master-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-block card-stretch">
                    <div class="card-body p-0">
                        <div class="d-flex justify-content-between align-items-center p-3 flex-wrap gap-3">
                            <h5 class="font-weight-bold">{{ __('messages.player_name') . " : " . $user->name }} </h5>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-lg-12 text-center mb-4 scroll-horizontal" id="category-buttons">
                {{-- سيتم تعبئة الأزرار هنا ديناميكيًا --}}
            </div>


            <div class="col-lg-12 text-center mb-4 scroll-horizontal" id="class-categories">

            </div>


                <div class="col-lg-12" id="class-details" style="display: none; overflow-x: auto;">
                    <div class="d-flex gap-3 scroll-horizontal" id="subscription-cards">

                    </div>
                </div>



                <div class="col-lg-12 text-center mb-4 scroll-horizontal" id="Coash">

                </div>

                <!-- قسم الفترات (Shifts) -->
                <div class="col-lg-12 scroll-horizontal shift-card" id="shifts" style="display: none;">

                </div>
    </div>
    <br>
    <div class="col-lg-12">
        {{ Form::open(['method' => 'POST', 'route' => 'addBill', 'enctype' => 'multipart/form-data', 'data-toggle' => "validator", 'id' => 'addBillForm']) }}
        <div class="row">
            <!-- الحقول الأساسية -->
            <div class="form-group col-md-6">
                {{ Form::label('discountAmount', __('messages.discount_value') . ' <span class="text-danger">*</span>', ['class' => 'form-control-label'], false) }}
                {{ Form::text('discountAmount', null, ['placeholder' => __('messages.discount_value'), 'class' => 'form-control', 'required']) }}
                <small class="help-block with-errors text-danger"></small>
            </div>

            <div class="form-group col-md-6">
                {{ Form::label('discountBecouse', __('messages.Discount_reason') . ' <span class="text-danger">*</span>', ['class' => 'form-control-label'], false) }}
                {{ Form::text('discountBecouse', null, ['placeholder' => __('messages.Discount_reason'), 'class' => 'form-control', 'required']) }}
                <small class="help-block with-errors text-danger"></small>
            </div>



            <div class="form-group col-md-6">
                {{ Form::label('description', __('messages.payment_note') . ' <span class="text-danger">*</span>', ['class' => 'form-control-label'], false) }}
                {{ Form::text('description', null, ['placeholder' => __('messages.payment_note'), 'class' => 'form-control', 'required']) }}
                <small class="help-block with-errors text-danger"></small>
            </div>

            <!-- الحقول المخفية: إدخال البيانات التي تم اختيارها -->
            {{ Form::hidden('categoryId', '', ['id' => 'category_id']) }}
            {{ Form::hidden('subscriptionId', '', ['id' => 'subscription_id']) }}
            {{ Form::hidden('coachId', '', ['id' => 'coach_id']) }}
            {{ Form::hidden('shifts', '', ['id' => 'shifts']) }}
            {{ Form::hidden('tags', '', ['id' => 'tags']) }}
            {{ Form::hidden('userId', $user->id) }}
            {{ Form::hidden('price', '' , ['id' => 'subsceriptionPrice']) }}
            {{ Form::hidden('numOfDays', '' , ['id' => 'numOfDays']) }}

            <div class="form-group col-md-4">
                {{ Form::label('amount', __('messages.Amount_Due :') , [ 'id' => 'amountDue', 'class' => 'form-control-label'], false) }}
                {{ Form::number('amount', null, ['placeholder' => __('messages.Enter_Amount_Due'), 'class' => 'form-control', 'step' => '0.01', 'required']) }}
                <small class="help-block with-errors text-danger"></small>
            </div>
            <div class="form-group col-md-6">
                {{ Form::label('startDate', __('messages.Date') . ' <span class="text-danger">*</span>', ['class' => 'form-control-label'], false) }}
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                    <input type="text" class="form-control datepicker" id="startDate" name="startDate" placeholder="{{ __('messages.Select_Date') }}" required>
                </div>

            </div>


        </div>

        {{ Form::submit(__('messages.save'), ['class' => 'btn btn-md btn-primary float-right']) }}
        {{ Form::close() }}
    </div>

                </div>
            </div>
 </div>
    @section('bottom_script')
    <script>








           $(document).ready(function () {
        // تشغيل طلب Ajax تلقائي عند تحميل الصفحة
        $.ajax({
            url: '{{ route("categories") }}', // رابط الراوت
            type: 'GET', // نوع الطلب (GET أو POST)
            success: function (response) {
                console.log("Data fetched successfully:", response);

                // التأكد من أن البيانات موجودة ضمن الحقل "data"
                if (response.data && Array.isArray(response.data)) {
                    // تحديد عنصر يحتوي على الأزرار
                    const buttonsContainer = $('#category-buttons');

                    // مسح أي محتوى سابق (اختياري)
                    buttonsContainer.empty();

                    // تعبئة الأزرار بناءً على البيانات المستلمة
                    response.data.forEach(function (category) {
                        // استخراج الاسم (تم فك الترميز تلقائيًا من النص المشفر)
                        const categoryName = category.name;

                        // إنشاء الزر ديناميكيًا
                        const button = `
                            <button class="btn category-btn btn-outline-secondary rounded-pill px-5 py-3 mx-2"
                                    data-category="${category.id}">
                                ${categoryName}
                            </button>
                        `;

                        // إضافة الزر إلى الحاوية
                        buttonsContainer.append(button);
                    });
                } else {
                    console.error("Invalid response format");
                }
            },
            error: function (xhr, status, error) {
                console.error("Error fetching data:", error);
            }
        });
    });

    $(document).ready(function () {
        // عند الضغط على زر التصنيف
        $(document).on('click', '.category-btn', function () {
            // الحصول على الفئة التي تم الضغط عليها
            const category = $(this).data('category');
            $('#category_id').val(category);

            console.log(category );
            $('.category-btn').removeClass('btn-success').addClass('btn-outline-secondary');
            $(this).removeClass('btn-outline-secondary').addClass('btn-success');
            // طلب Ajax لجلب الـ tags الخاصة بالفئة
            $.ajax({
                url: '{{ route("Tag") }}', // رابط الراوت
                type: 'GET', // نوع الطلب (GET)
                data: { category: category }, // إرسال الفئة في البيانات
                success: function (response) {
                    console.log("Tags fetched successfully:", response);

                    // حاوية الأزرار للـ tags
                    const classCategoriesContainer = $('#class-categories');

                    // مسح أي محتوى سابق
                    classCategoriesContainer.empty();

                    // التحقق من وجود بيانات وتعبئة الأزرار
                    if (response.data && response.data.length > 0) {
                        response.data.forEach(function (tag) {
                            // إنشاء الزر باستخدام اسم الـ tag
                            const button = `
                                <button class="btn btn-outline-secondary class-btn mx-2 px-4 py-2"
                                        data-class="${tag.id}">
                                    ${tag.name}
                                </button>
                            `;

                            // إضافة الزر إلى الحاوية
                            classCategoriesContainer.append(button);
                        });
                    } else {
                        classCategoriesContainer.append('<p>No tags found for this category.</p>'); // في حالة عدم وجود tags
                    }
                },
                error: function (xhr, status, error) {
                    console.error("Error fetching tags:", error);
                }
            });
        });
    });

    $(document).ready(function () {
        // عند الضغط على زر الـ tag
        $(document).on('click', '.class-btn', function () {
            // الحصول على الـ tag الذي تم الضغط عليه
            const tagId = $(this).data('class');
         $('.class-btn').removeClass('btn-success').addClass('btn-outline-secondary');
        $(this).removeClass('btn-outline-secondary').addClass('btn-success');
            // طلب Ajax لجلب تفاصيل الاشتراك
            $.ajax({
                url: '{{ route("Subscription.all") }}', // رابط الراوت
                type: 'GET', // نوع الطلب (GET)
               // إرسال الـ tag_id في البيانات
                success: function (response) {
                    console.log("Subscription data fetched successfully:", response);

                    // حاوية البطاقات
                    const subscriptionCardsContainer = $('#subscription-cards');

                    // مسح أي بطاقات سابقة
                    subscriptionCardsContainer.empty();

                    // التحقق من وجود بيانات وتعبئة البطاقات
                    if (response.data && response.data.length > 0) {
                        response.data.forEach(function (subscription) {
                            // إنشاء بطاقة جديدة باستخدام بيانات الاشتراك
                            const card = `
                                <div class="card bg-light text-center p-3 mb-3 shadow-sm" style="min-width: 300px;"
                                data-subscription-id=${subscription.id} data-subscription-price=${subscription.price}
                                data-num-of-days=${subscription.numOfDays}>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <p class="mb-0">${subscription.name}</p>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mt-3">
                                        <div>
                                            <p class="mb-0"><strong>${subscription.price}</strong> ليرة</p>
                                        </div>
                                        <div>
                                            <p class="mb-0">${subscription.numOfDays} يوم</p>
                                        </div>
                                        <div>
                                            <p class="mb-0">${subscription.numOfSessions} جلسة</p>
                                        </div>
                                    </div>
                                </div>
                            `;

                            // إضافة البطاقة إلى الحاوية
                            subscriptionCardsContainer.append(card);
                        });

                        // إظهار القسم
                        $('#class-details').show();
                    } else {
                        subscriptionCardsContainer.append('<p>No subscriptions found for this tag.</p>'); // في حالة عدم وجود بيانات
                        $('#class-details').show(); // إظهار القسم مع الرسالة
                    }
                },
                error: function (xhr, status, error) {
                    console.error("Error fetching subscription data:", error);
                }
            });
        });
    });

    $(document).ready(function () {
    $(document).on('click', '.card', function () {
        // التحقق مما إذا كان الكارت خاص بالفترات
        if ($(this).hasClass('shift-card')) {
            console.log("Shift card clicked. Skipping AJAX request.");
            return; // منع تنفيذ AJAX إذا كان الكارت خاصًا بالفترات
        }
        highlightSubscriptionCard($(this));
        const subscriptionId = $(this).data('subscription-id'); // الحصول على معرف الاشتراك
        const subscriptionPrice = $(this).data('subscription-price'); // الحصول على معرف الاشتراك
        const numOfDays = $(this).data('num-of-days'); // الحصول على معرف الاشتراك
        $('#subsceriptionPrice').val(subscriptionPrice);
        $('#subscription_id').val(subscriptionId);
        $('#numOfDays').val(numOfDays);
        $("#amountDue").text(`{{  __('messages.Amount_Due :')}} ${subscriptionPrice}`)
        // طلب AJAX
        $.ajax({
            url: '{{ route("SubscriptionCoach") }}',
            type: 'GET',
            data: { subscription_id: subscriptionId },
            success: function (response) {
                console.log("Response:", response);

                const data = response.data;
                const uniqueCoaches = {}; // لتتبع المدربين وعرضهم مرة واحدة فقط

                // ضبط لغة مكتبة moment.js إلى العربية
                moment.locale('ar');

                // تعبئة بيانات المدربين
                const coachContainer = $('#Coash');
                const shiftContainer = $('#shifts');
                coachContainer.empty();
                shiftContainer.empty();

                data.forEach(item => {
                    const coach = item.coach;

                    if (!uniqueCoaches[coach.id]) {
                        uniqueCoaches[coach.id] = {
                            name: coach.name,
                            photo: coach.photo,
                            phoneNumber: coach.phoneNumber,
                            periods: {}
                        };
                    }

                    // استخراج اليوم من created_at باستخدام moment.js
                    const dayName = moment(item.created_at).format('dddd'); // اسم اليوم بالعربية

                    // تحديد ما إذا كان صباحًا أم مساءً
                    const fromHour = parseInt(item.fromHouer.split(':')[0], 10); // ساعة البداية
                    const periodTime = fromHour >= 12 ? "مساءً" : "صباحًا";

                    // إضافة الأوقات إلى الفترة المناسبة للمدرب
                    if (!uniqueCoaches[coach.id].periods[item.period]) {
                        uniqueCoaches[coach.id].periods[item.period] = [];
                    }

                    uniqueCoaches[coach.id].periods[item.period].push({
                        day: `${dayName} (${periodTime})`, // اليوم مع توقيت اليوم
                        fromHouer: item.fromHouer,
                        toHouer: item.toHouer
                    });
                });

                // إنشاء أزرار المدربين
                for (const coachId in uniqueCoaches) {
                    const coach = uniqueCoaches[coachId];

                    const coachButton = `
                        <button class="btn btn-outline-primary coach-btn mx-2 px-4 py-2" data-coach-id="${coachId}">
                            ${coach.name}
                        </button>
                    `;
                    coachContainer.append(coachButton);
                }

                // إظهار قسم المدربين
                coachContainer.show();

                // التعامل مع النقر على زر مدرب
                $(document).on('click', '.coach-btn', function () {
                    const coachId = $(this).data('coach-id');
                    $('#coach_id').val(coachId);
                    const selectedCoach = uniqueCoaches[coachId];
                    shiftContainer.empty(); // تفريغ القسم قبل عرض الفترات
                    $('.coach-btn').removeClass('btn-success').addClass('btn-outline-secondary');
                    $(this).removeClass('btn-outline-secondary').addClass('btn-success');
                    // إنشاء بطاقات الفترات
                    for (const period in selectedCoach.periods) {
                        const timesHtml = selectedCoach.periods[period].map(time => `
                            <li style="margin-bottom: 5px;">
                                ${time.day}: <span>${time.fromHouer}</span> ← <span>${time.toHouer}</span>
                            </li>
                        `).join('');

                        const shiftCard = `
                            <div class="cardd bg-light text-center p-3 mb-3 shadow-sm shift-card" style="min-width: 300px;">
                                <h6 class="text-end" style="margin-bottom: 5px;">الفترة: ${period}</h6>
                                <ul class="list-unstyled text-end">
                                    ${timesHtml}
                                </ul>
                            </div>
                        `;
                        shiftContainer.append(shiftCard);
                    }

                    // إظهار قسم الفترات
                    shiftContainer.show();
                });
                $(document).on('click', '.cardd', function () {
                 highlightShiftCard($(this));
                });
            },

            error: function (xhr, status, error) {
                console.error("Error fetching data:", error);
            }
        });
    });
});

function highlightSubscriptionCard(card) {
        $('.card').removeClass('border-success bg-success text-white').addClass('bg-light');
        card.removeClass('bg-light').addClass('border-success bg-success text-white');
    }


    function highlightShiftCard(card) {
        $('.shift-card').removeClass('border-success bg-success text-white').addClass('bg-light');
        card.removeClass('bg-light').addClass('border-success bg-success text-white');
    }

// // تلوين البطاقة عند الضغط عليها (سواء كانت كارت مدرب أو غيره)
// $(document).on('click', '.card', function () {
//     // إزالة التلوين من جميع الكروت
//     $('.card').removeClass('selected-card');

//     // إضافة التلوين للكرت المختار
//     $(this).addClass('bg-primary text-white');
// });
// $(document).on('click', '.cardd', function () {
//     // إزالة التلوين من جميع الكروت
//     $('.cardd').removeClass('selected-card');

//     // إضافة التلوين للكرت المختار
//     $(this).addClass('bg-primary text-white');
// });






///////////////////////

$(document).ready(function () {


    $('#addBillForm').on('submit', function (e) {
    e.preventDefault(); // منع الإرسال الافتراضي
    let isValid = true;
    let errorMessage = '';

    // التحقق من الحقول المطلوبة
    if (!$('#category_id').val()) {
        isValid = false;
        errorMessage += 'يرجى اختيار تصنيف.\n';
    }

    if (!$('#subscription_id').val()) {
        isValid = false;
        errorMessage += 'يرجى اختيار اشتراك.\n';
    }

    if (!$('#coach_id').val()) {
        isValid = false;
        errorMessage += 'يرجى اختيار مدرب.\n';
    }

    // if (!$('#shifts').val()) {
    //     isValid = false;
    //     errorMessage += 'يرجى اختيار فترة.\n';
    // }

    if (!$('#startDate').val()) {
        isValid = false;
        errorMessage += 'يرجى اختيار تاريخ البدء.\n';
    }

    // عرض رسالة خطأ في حال عدم صحة البيانات
    if (!isValid) {
        alert(errorMessage); // استبدل بـ toastr أو sweetalert إذا كنت تستخدمهما
        return false; // منع الإرسال
    }

    // إرسال النموذج إذا كانت البيانات صحيحة
    this.submit();
});

});



    </script>

   <style>
   .cardd {
    border-radius: 10px;
    border: none;
}

.cardd p {
    margin: 0;
    font-size: 0.9rem;
    font-weight: 500;
    text-align: center;
}

.cardd div {
    flex: 1;
}
    .card {
    border-radius: 10px;
    border: none;
}

.card p {
    margin: 0;
    font-size: 0.9rem;
    font-weight: 500;
    text-align: center;
}

.card div {
    flex: 1;
}

.bg-light {
    background-color: #f8f9fa !important;
}

.d-flex {
    display: flex;
}

.justify-content-between {
    justify-content: space-between;
}

.align-items-center {
    align-items: center;
}
.card {
    border-radius: 10px;
    border: none;
}

.card p {
    margin: 0;
    font-size: 0.9rem;
    font-weight: 500;
    text-align: center;
}

.card div {
    flex: 1;
}

.bg-light {
    background-color: #f8f9fa !important;
}

.d-flex {
    display: flex;
}

.justify-content-between {
    justify-content: space-between;
}

.align-items-center {
    align-items: center;
}
.list-unstyled {
    padding-right: 0 !important;
    list-style: none;
}
#shifts .row {
    flex-wrap: wrap; /* السماح بالالتفاف */
}
#shifts .col-md-4 {
    flex: 0 0 33.33%; /* تأكد من أن كل بطاقة تأخذ 1/3 من العرض */
    max-width: 33.33%;
}
.scroll-horizontal {
    display: flex;
    overflow-x: auto; /* تمكين التمرير الأفقي */
    white-space: nowrap; /* الحفاظ على العناصر بجانب بعضها */
    gap: 10px; /* مسافة بين العناصر */
    padding-bottom: 10px; /* مساحة بين العناصر وأسفل القسم */

}

.scroll-horizontal::-webkit-scrollbar {
    height: 8px; /* حجم شريط التمرير */
}

.scroll-horizontal::-webkit-scrollbar-thumb {
    background: #ccc; /* لون شريط التمرير */
    border-radius: 10px; /* جعل شريط التمرير مستديرًا */
}

.scroll-horizontal::-webkit-scrollbar-track {
    background: #f1f1f1; /* خلفية مسار شريط التمرير */
}





   </style>
    @endsection
</x-master-layout>
