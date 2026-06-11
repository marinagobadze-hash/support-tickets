<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    // კლიენტის მიერ ბილეთის შექმნა და ბაზაში შენახვა
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'priority_id' => 'required|exists:priorities,id',
        ]);

        Ticket::create([
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'priority_id' => $request->priority_id,
            'user_id' => Auth::id(), // ვინც შესულია, იმის ID მიებმება
        ]);

        return back()->with('success', 'Ticket submitted successfully!');
    }

    // ადმინის მიერ ბილეთის სტატუსის განახლება (Resolved)
    public function resolve($id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->status = 'Resolved';
        $ticket->save();

        return back()->with('success', 'Ticket marked as resolved successfully!');
    }
}