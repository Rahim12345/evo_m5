<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function contact()
    {
        return view('front.pages.contact');
    }

    public function contactPost(Request $request)
    {
        $request->validate([
            'name' => 'required|max:30',
            'email' => 'required|email',
            'subject' => 'required|max:200',
            'message' => 'required|max:1000',
        ], [], [
            'name' => 'Tam ad',
            'email' => 'Email',
            'subject' => 'Mövzu',
            'message' => 'Mesaj',
        ]);


        $contact = Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        try {
            $url = 'https://7107.api.green-api.com/' . config('app.WP_INSTANCE') . '/sendMessage/' . config('app.WP_TOKEN');

            $data = array(
                'chatId' => '994555552517' . '@c.us',
                'message' => "Yeni müraciət:\n\n" .
                    "Ad: " . $request->name . "\n" .
                    "Email: " . $request->email . "\n" .
                    "Mövzu: " . $request->subject . "\n" .
                    "Mesaj: " . $request->message
            );

            $options = array(
                'http' => array(
                    'header' => "Content-Type: application/json\r\n",
                    'method' => 'POST',
                    'content' => json_encode($data)
                )
            );

            $context = stream_context_create($options);
            $result = file_get_contents($url, false, $context);

            return response()->json([
                'status' => 'success',
                'message' => 'Message sent successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }

        return response()->json([
            'message' => 'Mesajınız uğurla göndərildi'
        ]);
    }

    public function index()
    {
        $contacts = Contact::orderByDesc('id')->paginate(10);

        return view('back.pages.contact.index', [
            'contacts' => $contacts
        ]);
    }
}
