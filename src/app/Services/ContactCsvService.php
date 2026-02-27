<?php

namespace App\Services;

use App\Models\Contact;
use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ContactCsvService
{
    public function download(Collection $contacts): StreamedResponse
    {
        $response = new StreamedResponse(function () use ($contacts) {
            $handle = fopen('php://output', 'w');

            fwrite($handle, "\xEF\xBB\xBF");

            fputcsv($handle, Contact::csvHeader());

            foreach ($contacts as $contact) {
                fputcsv($handle, $contact->toCsvRow());
            }

            fclose($handle);
        });

        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="contacts.csv"');

        return $response;
    }
}
