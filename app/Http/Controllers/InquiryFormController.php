<?php

namespace App\Http\Controllers;

use App\Mail\MotorcycleEnquiryMail;
use App\Mail\PartsInquiryMail;
use App\Mail\ServiceAppointmentMail;
use App\Services\TelegramNotifier;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class InquiryFormController extends Controller
{
    public function __construct(
        protected TelegramNotifier $telegramNotifier,
    ) {}

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

        $telegramSent = $this->telegramNotifier->sendServiceAppointment($validated);

        try {
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
        } catch (\Throwable $e) {
            Log::error('Service appointment email failed.', [
                'mobile' => $validated['mobile'],
                'error' => $e->getMessage(),
            ]);
        }

        if (! $this->telegramNotifier->isServiceConfigured()) {
            Log::warning('Service appointment submitted but Telegram service group is not configured.', [
                'bot_token_set' => filled(config('services.telegram.bot_token')),
                'service_chat_id' => config('services.telegram.service_chat_id'),
            ]);
        }

        if ($this->telegramNotifier->isServiceConfigured() && ! $telegramSent) {
            return response()->json([
                'message' => 'Could not send your appointment request. Please try again.',
            ], 500);
        }

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

        $telegramSent = $this->telegramNotifier->sendPartsInquiry($validated);

        try {
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
        } catch (\Throwable $e) {
            Log::error('Parts inquiry email failed.', [
                'contact' => $validated['contact'],
                'error' => $e->getMessage(),
            ]);
        }

        if ($this->telegramNotifier->isPartsConfigured() && ! $telegramSent) {
            return response()->json([
                'message' => 'Could not send your inquiry. Please try again.',
            ], 500);
        }

        return response()->json(['message' => 'Parts inquiry submitted.']);
    }

    public function motorcycleEnquiry(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'mobile' => ['required', 'string', 'max:50'],
            'model' => ['required', 'string', 'max:255'],
            'showroom' => ['nullable', 'string', 'max:255'],
            'payment' => ['nullable', 'string', 'max:255'],
        ]);

        $telegramSent = $this->telegramNotifier->sendMotorcycleEnquiry($validated);

        try {
            Mail::to(config('mail.motorcycle_enquiry_to'))
                ->send(new MotorcycleEnquiryMail(
                    name: $validated['name'],
                    mobile: $validated['mobile'],
                    model: $validated['model'],
                    showroom: $validated['showroom'] ?? null,
                    payment: $validated['payment'] ?? null,
                ));
        } catch (\Throwable $e) {
            Log::error('Motorcycle enquiry email failed.', [
                'mobile' => $validated['mobile'],
                'model' => $validated['model'],
                'error' => $e->getMessage(),
            ]);
        }

        if (! $this->telegramNotifier->isSalesConfigured()) {
            Log::warning('Motorcycle enquiry submitted but Telegram sales group is not configured.', [
                'bot_token_set' => filled(config('services.telegram.bot_token')),
                'sales_chat_id' => config('services.telegram.sales_chat_id'),
            ]);
        }

        if ($this->telegramNotifier->isSalesConfigured() && ! $telegramSent) {
            return response()->json([
                'message' => 'Could not send your enquiry. Please try again.',
            ], 500);
        }

        return response()->json(['message' => 'Enquiry submitted.']);
    }
}
