<?php

namespace App\Http\Controllers;

use App\Mail\TicketSubmit;
use App\TicketModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class CustomerController extends Controller
{
    //function for create new ticket view
    public function ticket()
    {
        return view('customer.ticket_create');
    }

    public function __construct(TicketModel $ticketModel)
    {
        $this->ticketModel = $ticketModel;
    }

    //function for view of ticket list
    public function tickets()
    {
        return view('customer.ticket_list');
    }

    //function for create ticket
    public function create(Request $request)
    {
        $request->validate([
            'customer_name' => ['required', 'string', 'max:50'],
            'description' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:50'],
            'phone' => ['required', 'numeric', 'digits:10']
        ]);


        $ticket = $this->ticketModel->create([
            'reference' => Str::random(5),
            'customer_name' => $request->customer_name,
            'description' => $request->description,
            'email' => $request->email,
            'phone' => $request->phone
        ]);

        $id = $ticket->id;
        $reference = $ticket->reference;

        if ($id) {
            $email = $request->email;
            $data = ['reference' => $reference];
            Mail::to($email)->send(new TicketSubmit($data));
        }

        return redirect()->back()->with('alert', 'Ticket successfully submitted');
    }

    //function for search ticket by reference
    public function search(Request $request)
    {
        $search = $request->input('search');
        if ($search != null) {
            $tickets = $this->ticketModel::where('reference', $search)->get();
            if (count($tickets) > 0) {
                return view('customer.ticket_list', compact('tickets'));
            } else {
                return view('customer.ticket_list')->withMessage(" No ticket Found !");
            }
        }
        return redirect('/ticket-list');
    }
}
