<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages.
    |
    */

    'accepted'             => 'يجب قبول ( :attribute ).',
    'active_url'           => '( :attribute ) لا يُمثّل رابطًا صحيحًا.',
    'after'                => 'يجب على ( :attribute ) أن يكون تاريخًا لاحقًا للتاريخ :date.',
    'after_or_equal'       => '( :attribute ) يجب أن يكون تاريخاً لاحقاً أو مطابقاً للتاريخ :date.',
    'alpha'                => 'يجب أن لا يحتوي ( :attribute ) سوى على حروف.',
    'alpha_dash'           => 'يجب أن لا يحتوي ( :attribute ) سوى على حروف، أرقام ومطّات.',
    'alpha_num'            => 'يجب أن يحتوي ( :attribute ) على حروفٍ وأرقامٍ فقط.',
    'array'                => 'يجب أن يكون ( :attribute ) ًمصفوفة.',
    'before'               => 'يجب على ( :attribute ) أن يكون تاريخًا سابقًا للتاريخ :date.',
    'before_or_equal'      => '( :attribute ) يجب أن يكون تاريخا سابقا أو مطابقا للتاريخ :date.',
    'between'              => [
        'numeric' => 'يجب أن تكون قيمة ( :attribute ) بين :min و :max.',
        'file'    => 'يجب أن يكون حجم الملف ( :attribute ) بين :min و :max كيلوبايت.',
        'string'  => 'يجب أن يكون عدد حروف النّص ( :attribute ) بين :min و :max.',
        'array'   => 'يجب أن يحتوي ( :attribute ) على عدد من العناصر بين :min و :max.',
    ],
    'boolean'              => 'يجب أن تكون قيمة ( :attribute ) إما true أو false .',
    'confirmed'            => 'حقل التأكيد غير مُطابق للحقل ( :attribute ).',
    'date'                 => '( :attribute ) ليس تاريخًا صحيحًا.',
    'date_format'          => 'لا يتوافق ( :attribute ) مع الشكل :format.',
    'different'            => 'يجب أن يكون الحقلان ( :attribute ) و :other مُختلفان.',
    'digits'               => 'يجب أن يحتوي ( :attribute ) على :digits رقمًا/أرقام.',
    'digits_between'       => 'يجب أن يحتوي ( :attribute ) بين :min و :max رقمًا/أرقام .',
    'dimensions'           => 'الـ ( :attribute ) يحتوي على أبعاد صورة غير صالحة.',
    'distinct'             => 'للحقل ( :attribute ) قيمة مُكرّرة.',
    'email'                => 'يجب أن يكون ( :attribute ) عنوان بريد إلكتروني صحيح البُنية.',
    'exists'               => 'القيمة المحددة ( :attribute ) غير موجودة.',
    'file'                 => 'الـ ( :attribute ) يجب أن يكون ملفا.',
    'filled'               => '( :attribute ) إجباري.',
    'gt'                   => [
        'numeric' => 'يجب أن تكون قيمة ( :attribute ) أكبر من :value.',
        'file'    => 'يجب أن يكون حجم الملف ( :attribute ) أكبر من :value كيلوبايت.',
        'string'  => 'يجب أن يكون طول النّص ( :attribute ) أكثر من :value حروفٍ/حرفًا.',
        'array'   => 'يجب أن يحتوي ( :attribute ) على أكثر من :value عناصر/عنصر.',
    ],
    'gte'                  => [
        'numeric' => 'يجب أن تكون قيمة ( :attribute ) مساوية أو أكبر من :value.',
        'file'    => 'يجب أن يكون حجم الملف ( :attribute ) على الأقل :value كيلوبايت.',
        'string'  => 'يجب أن يكون طول النص ( :attribute ) على الأقل :value حروفٍ/حرفًا.',
        'array'   => 'يجب أن يحتوي ( :attribute ) على الأقل على :value عُنصرًا/عناصر.',
    ],
    'image'                => 'يجب أن يكون ( :attribute ) صورةً.',
    'in'                   => '( :attribute ) غير موجود.',
    'in_array'             => '( :attribute ) غير موجود في :other.',
    'integer'              => 'يجب أن يكون ( :attribute ) عددًا صحيحًا.',
    'ip'                   => 'يجب أن يكون ( :attribute ) عنوان IP صحيحًا.',
    'ipv4'                 => 'يجب أن يكون ( :attribute ) عنوان IPv4 صحيحًا.',
    'ipv6'                 => 'يجب أن يكون ( :attribute ) عنوان IPv6 صحيحًا.',
    'json'                 => 'يجب أن يكون ( :attribute ) نصآ من نوع JSON.',
    'lt'                   => [
        'numeric' => 'يجب أن تكون قيمة ( :attribute ) أصغر من :value.',
        'file'    => 'يجب أن يكون حجم الملف ( :attribute ) أصغر من :value كيلوبايت.',
        'string'  => 'يجب أن يكون طول النّص ( :attribute ) أقل من :value حروفٍ/حرفًا.',
        'array'   => 'يجب أن يحتوي ( :attribute ) على أقل من :value عناصر/عنصر.',
    ],
    'lte'                  => [
        'numeric' => 'يجب أن تكون قيمة ( :attribute ) مساوية أو أصغر من :value.',
        'file'    => 'يجب أن لا يتجاوز حجم الملف ( :attribute ) :value كيلوبايت.',
        'string'  => 'يجب أن لا يتجاوز طول النّص ( :attribute ) :value حروفٍ/حرفًا.',
        'array'   => 'يجب أن لا يحتوي ( :attribute ) على أكثر من :value عناصر/عنصر.',
    ],
    'max'                  => [
        'numeric' => 'يجب أن تكون قيمة ( :attribute ) مساوية أو أصغر من :max.',
        'file'    => 'يجب أن لا يتجاوز حجم الملف ( :attribute ) :max كيلوبايت.',
        'string'  => 'يجب أن لا يتجاوز طول النّص ( :attribute ) :max حروفٍ/حرفًا.',
        'array'   => 'يجب أن لا يحتوي ( :attribute ) على أكثر من :max عناصر/عنصر.',
    ],
    'mimes'                => 'يجب أن يكون ملفًا من نوع : :values.',
    'mimetypes'            => 'يجب أن يكون ملفًا من نوع : :values.',
    'min'                  => [
        'numeric' => 'يجب أن تكون قيمة ( :attribute ) مساوية أو أكبر من :min.',
        'file'    => 'يجب أن يكون حجم الملف ( :attribute ) على الأقل :min كيلوبايت.',
        'string'  => 'يجب أن يكون طول النص ( :attribute ) على الأقل :min حروفٍ/حرفًا.',
        'array'   => 'يجب أن يحتوي ( :attribute ) على الأقل على :min عُنصرًا/عناصر.',
    ],
    'not_in'               => '( :attribute ) موجود.',
    'not_regex'            => 'صيغة ( :attribute ) غير صحيحة.',
    'numeric'              => 'يجب على ( :attribute ) أن يكون رقمًا.',
    'present'              => 'يجب تقديم ( :attribute ).',
    'regex'                => 'صيغة ( :attribute ) .غير صحيحة.',
    'required'             => 'حقل ( :attribute ) مطلوب.',
    'required_if'          => '( :attribute ) مطلوب في حال ما إذا كان :other يساوي :value.',
    'required_unless'      => '( :attribute ) مطلوب في حال ما لم يكن :other يساوي :values.',
    'required_with'        => '( :attribute ) مطلوب إذا توفّر :values.',
    'required_with_all'    => '( :attribute ) مطلوب إذا توفّر :values.',
    'required_without'     => '( :attribute ) مطلوب إذا لم يتوفّر :values.',
    'required_without_all' => '( :attribute ) مطلوب إذا لم يتوفّر :values.',
    'same'                 => 'يجب أن يتطابق ( :attribute ) مع :other.',
    'size'                 => [
        'numeric' => 'يجب أن تكون قيمة ( :attribute ) مساوية لـ :size.',
        'file'    => 'يجب أن يكون حجم الملف ( :attribute ) :size كيلوبايت.',
        'string'  => 'يجب أن يحتوي النص ( :attribute ) على :size حروفٍ/حرفًا بالضبط.',
        'array'   => 'يجب أن يحتوي ( :attribute ) على :size عنصرٍ/عناصر بالضبط.',
    ],
    'string'               => 'يجب أن يكون ( :attribute ) نصآ.',
    'timezone'             => 'يجب أن يكون ( :attribute ) نطاقًا زمنيًا صحيحًا.',
    'unique'               => 'قيمة ( :attribute ) مُستخدمة من قبل.',
    'uploaded'             => 'فشل في تحميل الـ ( :attribute ).',
    'url'                  => 'صيغة الرابط ( :attribute ) غير صحيحة.',
    'uuid'                 => '( :attribute ) يجب أن يكون بصيغة UUID سليمة.',
    'uniqueMonth'          => 'تم اصدار مسير رواتب لهذا الشهر',
    'current_password'    => 'كلمة المرور الحالية غير صحيحة.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
        'amount_paid' => [
            'required_unless' => 'يجب ادخال المبلغ المستحق',
        ],
        'main_analysis_id' => [
                'required_without'     => 'حقل ( :attribute ) مطلوب إذا لم تتوفر :values.'
        ],

        'company_id' => [
            'required_if' => 'حقل ( :attribute ) مطلوب في حالة التأمين الطبي.',
        ],

        'category_id' => [
            'required_if' => 'حقل ( :attribute ) مطلوب في حالة التأمين الطبي.',
        ],

        'policy_no' => [
            'required_if' => 'حقل ( :attribute ) مطلوب في حالة التأمين الطبي.',
        ],
        'code_id' => [
            'required_if' => 'حقل ( :attribute ) مطلوب إذا كان العميل يمتلك كود خصم.',
        ],
        'hospital_id' => [
            'required_if' => 'حقل ( :attribute ) مطلوب إذا كانت جهة التحويل مستشفي.',
        ],
        'doctor_id' => [
            'required_if' => 'حقل ( :attribute ) مطلوب إذا كانت جهة التحويل طبيب.',
        ],
        'sector_id' => [
            'required_if' => 'حقل ( :attribute ) مطلوب إذا كان العميل تابع الي قطاع.',
        ],
        'high_sensitive_to.*.name' => [
            'required_if' => 'حقل ( :attribute ) مطلوب.',
        ],
        'moderate_sensitive_to.*.name' => [
            'required_if' => 'حقل ( :attribute ) مطلوب.',
        ],
        'resistant_to.*.name' => [
            'required_if' => 'حقل ( :attribute ) مطلوب.',
        ],
        'cultivation' => [
            'required_if' => 'حقل ( :attribute ) مطلوب.',
        ],
        'phone' => [
            'regex' => 'رقم الجوال يجب ان يبدء ب 05 وان يتكون من 10 ارقام',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [
        'patient_id'            => 'المريض',
        'main_analysis_id'      => 'التحاليل',
        'package_id'            => 'العروض',
        'company_id'            => 'الشركات',
        'category_id'           => 'الفئة',
        'hospital_id'           => 'المستشفى',
        'doctor_id'             => 'الطبيب',
        'code_id'               => 'كود الخصم',
        'sector_id'             => 'القطاع',
        'amount_paid'           => 'المبلغ المدفوع',
        'pay_method'            => 'طريقة الدفع',
        'home_visit_fees'       => 'رسوم الزيارة المنزلية',
        'policy_no'             => 'رقم البوليصة',
        'date'                  => 'التاريخ',
        'email'                  => 'البريد الإلكتروني',
        'branch_id'                  => 'معرف الفرع',
        'fname_arabic'                  => 'الاسم الاول بالعربية',
        'mname_arabic'                  => 'الاسم الثاني بالعربية',
        'lname_arabic'                  => 'الاسم الاخير بالعربية',
        'fname_english'                  => 'الاسم الاول بالنجليزية',
        'mname_english'                  => 'الاسم الثاني بالنجليزية',
        'lname_english'                  => 'الاسم الاخير بالنجليزية',
        'birthdate'                  => 'تاريخ الميلاد',
        'nationality_id'                  => 'الجنسية',
        'marital_status'                  => 'الحالة الاجتماعية',
        'gender'                  => 'الجنس',
        'identity_type'                  => 'نوع الهوية',
        'id_num'                  => 'رقم الهوية',
        'id_issue_date'                  => 'تاريخ إصدار رقم الهوية',
        'id_expire_date'                  => 'تاريخ انتهاء رقم الهوية',
        'passport_num'                  => 'رقم جواز السفر',
        'passport_issue_date'                  => 'تاريخ اصدار جواز السفر',
        'passport_expire_date'                  => 'تاريخ انتهاء صلاحية جواز السفر',
        'issue_place'                  => 'مكان الاصدار',
        'emp_num'                  => 'الرقم الوظيفي',
        'joined_date'                  => 'تاريخ الالتحاق',
        'shift_type'                  => 'نوع الدوام',
        'contract_type'                  => 'نوع العقد',
        'start_date'                  => 'تاريخ البدء',
        'contract_period'                  => 'مدة العقد',
        'basic_salary'                  => 'الراتب اساسي',
        'phone'                  => 'رقم الجوار',
        'password'                  => 'كلمة السر',
        'sub_analyses.*.name' => 'الاسم',
        'sub_analyses.*.unit' => 'الوحدة',
        'sub_analyses.*.classification' => 'التصنيف',
        'high_sensitive_to.*.name' => 'الاسم',
        'moderate_sensitive_to.*.name' => 'الاسم',
        'resistant_to.*.name' => 'الاسم',
        'main_analyses.*.id' => 'التحليل الرئبسي',
        'main_analyses.*.price' => 'السعر',
        'name' => 'الاسم',
        'name_english' => 'الاسم بالانجليزية',
        'amount' => 'السعر',
        'nationality' => 'الاسم بالعربي',
        'amount_type' => 'نوع المعاملة',
    ],

    'values' => [
        'required_unless' => [
            config('enums.payMethod.overdue') => 'مؤجل'
        ],
    ]
];
