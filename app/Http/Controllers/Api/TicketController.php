<?php

namespace App\Http\Controllers\Api;

use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TicketController extends Controller
{
    public function index()
    {
        return Ticket::all();
    }

    public function view($id)
    {
        return Ticket::find($id);
    }
}
