<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactController extends Controller
{
    /**
     * Topics offered in the "What is it about?" dropdown. Kept here rather
     * than in the view so the store() validation can check against the same
     * list instead of accepting anything the browser sends.
     */
    public const TOPICS = [
        'Order & delivery',
        'Product advice',
        'Returns & refunds',
        'Partnership enquiry',
        'Something else',
    ];

    public function index(): View
    {
        return view('petsaathi.contact', ['topics' => self::TOPICS]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:190'],
            'phone' => ['nullable', 'string', 'max:20'],
            'topic' => ['required', 'string', 'in:'.implode(',', self::TOPICS)],
            'message' => ['required', 'string', 'min:10', 'max:3000'],
        ], [
            'topic.required' => 'Please pick what your message is about.',
            'topic.in' => 'Please pick what your message is about.',
            'message.min' => 'A little more detail helps us answer properly.',
        ]);

        // $data['subscribed'] = $request->boolean('subscribed');

        ContactMessage::create($data);

        return redirect()
            ->to(route('contact').'#contact-form')
            ->with('contact_success', 'Thanks '.$data['name'].'! Your message is with our support team — we usually reply within 24 hours.');
    }
}
