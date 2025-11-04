<?php

use App\Models\Setting;
use JsonSchema\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use App\Models\LightOfGuidance;
use Illuminate\Support\Facades\Log;
use libphonenumber\PhoneNumberUtil;
use libphonenumber\PhoneNumberFormat;

if (! function_exists('eThrowable')) {
    function eThrowable(string $_class, string $message, string $trace = null, array $data = []): object
    {
        $LOG = new LightOfGuidance;
        $LOG->_uid = Str::uuid();
        $LOG->_class = $_class;
        $LOG->message = $message;
        $LOG->trace = $trace;
        $LOG->user_id = $data['user_id'] ?? null;
        $LOG->exception_type = $data['exception_type'] ?? null;
        $LOG->exception_code = $data['exception_code'] ?? null;
        $LOG->request_info = $data['request_info'] ?? null;
        $LOG->job_class = $data['job_class'] ?? null;
        $LOG->job_id = $data['job_id'] ?? null;
        $LOG->queue_name = $data['queue_name'] ?? null;
        $LOG->queue_connection = $data['queue_connection'] ?? null;
        $LOG->model_class = $data['model_class'] ?? null;
        $LOG->model_id = $data['model_id'] ?? null;
        $LOG->payload = $data['payload'] ?? null;
        $LOG->environment = $data['environment'] ?? null;
        $LOG->_status = $data['_status'] ?? LightOfGuidance::PENDING;

        $LOG->save();

        return $LOG->fresh();
    }
}

if (! function_exists('extractFullName')) {
    function extractFullName(string $value): array
    {
        // Split the full name into an array by spaces
        $data = explode(' ', $value);

        // Extract and process the first and last names
        $result['first_name'] = strtolower(trim($data[0]));
        $result['last_name'] = strtolower(trim(end($data)));
        $result['middle_name'] = null; // Initialize middle name as null

        // If there are more than two parts, extract the middle name(s)
        if (count($data) > 2) {
            array_pop($data); // Remove the last element (last name)
            array_shift($data); // Remove the first element (first name)
            // Join the remaining elements as the middle name
            $result['middle_name'] = strtolower(trim(implode(' ', $data)));
        }

        // Return the associative array
        return $result;
    }
}

if (! function_exists('excelDateToPhpDate')) {
    function excelDateToPhpDate(string $date): datetime
    {
        return \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject(trim($date));
    }
}

if (! function_exists('greetings')) {
    function greetings(): string
    {
        $hour = date('H');

        $greetings = [
            'morning' => ['Good morning'],
            'afternoon' => ['Good afternoon'],
            'evening' => ['Good evening']
        ];

        switch ($hour) {
            case 6:
            case 7:
            case 8:
            case 9:
            case 10:
                return $greetings['morning'][0];
            case 11:
            case 12:
            case 13:
            case 14:
            case 15:
            case 16:
                return $greetings['afternoon'][0];
            case 17:
            case 18:
            case 19:
            case 20:
            case 21:
            case 22:
            case 23:
            case 0:
                return $greetings['evening'][0];
            default:
                return 'Greetings';
        }
    }
}

if (! function_exists('pluralSentence')) {
    function pluralSentence(string $sentence): string
    {
        $words = explode(' ', $sentence);

        $pluralWords = array_map(function ($word) {
            return Str::plural($word);
        }, $words);

        return implode(' ', $pluralWords);
    }
}

if (! function_exists('singularSentence')) {
    function singularSentence(string $sentence): string
    {
        $words = explode(' ', $sentence);

        $singularWords = array_map(function($word) {
            return Str::singular($word);
        }, $words);

        return implode(' ', $singularWords);
    }
}

if (! function_exists('phoneNumberPrefix')) {
    function phoneNumberPrefix(string $telephone, string $code = 'KE', int $length = -9): string
    {
        $number = substr($telephone, $length);
        $phoneUtil = PhoneNumberUtil::getInstance();

        return $phoneUtil->format($phoneUtil->parse($number, $code), PhoneNumberFormat::E164);
    }
}

if (! function_exists('ensureNumericString')) {
    function ensureNumericString(string $value): ?string
    {
        if (ctype_digit($value)) {
            return $value;
        }

        return null;
    }
}