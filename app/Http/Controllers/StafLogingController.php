<?php

namespace App\Http\Controllers;

use App\Http\Requests\StafLogingRequest;
use App\Models\StafLoging;
use Illuminate\Http\Request;

class StafLogingController extends Controller
{
    public function __invoke(StafLogingRequest $request)
    {
        $data = $request->validated();
        $data['date'] = date('Y-m-d');

        // جلب السجل الأخير للمستخدم في هذا اليوم
        $lastLog = StafLoging::where('stafId', $data['stafId'])
            ->where('date', $data['date'])
            ->latest()
            ->first();

        // ✅ عند تسجيل الدخول (Enter Time)
        if ($request->enterTime) {
            // ❌ إذا كان هناك سجل دخول بدون خروج، لا يُسمح بتسجيل دخول جديد
            if ($lastLog && !$lastLog->exitTime) {
                return response()->json(['message' => 'يجب تسجيل الخروج أولًا قبل تسجيل دخول جديد.'], 400);
            }

            // ✅ إذا سجل خروجًا سابقًا، يتم إنشاء سجل جديد
            StafLoging::create($data);
        }

        // ✅ عند تسجيل الخروج (Exit Time)
        elseif ($request->exitTime) {
            // تحديث آخر سجل دخول بنفس اليوم بنفس المستخدم
            if ($lastLog) {
                $lastLog->update(['exitTime' => $data['exitTime']]);
            } else {
                return response()->json(['message' => 'لا يوجد سجل دخول لإضافة الخروج.'], 400);
            }
        }

        return response()->json(['message' => 'تم تسجيل العملية بنجاح.']);
    }
}
