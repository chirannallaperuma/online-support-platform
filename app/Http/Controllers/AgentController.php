<?php

namespace App\Http\Controllers;

use App\Mail\AgentResponse;
use App\TicketModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AgentController extends Controller
{
    public function __construct(TicketModel $ticketModel)
    {
        $this->ticketModel = $ticketModel;
    }

    //function for customer ticket list
    public function index()
    {
        $tickets = $this->ticketModel
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('home', compact('tickets'));
    }

    //function for view of a ticket
    public function view($id)
    {
        $ticket = $this->ticketModel::findOrFail($id);
        return view('view_ticket', compact('ticket'));
    }

    //function for update ticket
    public function update(Request $request)
    {

        $request->validate([
            'response' => ['required', 'string', 'max:255']
        ]);

        $ticketId = $request->ticketId;
        $ticket = $this->ticketModel->findOrFail($ticketId);
        $reference = $ticket->reference;
        $email = $ticket->email;

        $ticket->response = $request->response;
        $ticket->agent_viewed_at = date('Y-m-d H:i:s');
        $ticket->save();


        $data = ['reference' => $reference];
        Mail::to($email)->send(new AgentResponse($data));

        return redirect()->back()->with('alert', 'Ticket successfully updated');
    }
}
