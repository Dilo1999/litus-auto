<?php

namespace App\Http\Controllers;

use App\Mail\PartsInquiryMail;
use App\Mail\ServiceAppointmentMail;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class InquiryFormController extends Controller
{
    public function serviceAppointment(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'mobile' => ['required', 'string', 'max:50'],
            'model' => ['nullable', 'string', 'max:255'],
            'reg_no' => ['nullable', 'string', 'max:100'],
            'centre' => ['nullable', 'string', 'max:255'],
            'date' => ['nullable', 'date'],
            'service_type' => ['nullable', 'string', 'max:255'],
            'notes' => ['nullable', 'string', 'max:5000'],
        ]);

        Mail::to(config('mail.service_appointment_to'))
            ->send(new ServiceAppointmentMail(
                name: $validated['name'],
                mobile: $validated['mobile'],
                model: $validated['model'] ?? null,
                regNo: $validated['reg_no'] ?? null,
                centre: $validated['centre'] ?? null,
                date: $validated['date'] ?? null,
                serviceType: $validated['service_type'] ?? null,
                notes: $validated['notes'] ?? null,
            ));

        return response()->json(['message' => 'Appointment request submitted.']);
    }

    public function partsInquiry(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'brand' => ['required', 'string', 'max:255'],
            'year' => ['nullable', 'string', 'max:20'],
            'model' => ['nullable', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:255'],
            'parts' => ['nullable', 'string', 'max:5000'],
            'name' => ['required', 'string', 'max:255'],
            'contact' => ['required', 'string', 'max:50'],
        ]);

        Mail::to(config('mail.parts_inquiry_to'))
            ->send(new PartsInquiryMail(
                brand: $validated['brand'],
                year: $validated['year'] ?? null,
                model: $validated['model'] ?? null,
                category: $validated['category'] ?? null,
                parts: $validated['parts'] ?? null,
                name: $validated['name'],
                contact: $validated['contact'],
            ));

        return response()->json(['message' => 'Parts inquiry submitted.']);
    }
}
