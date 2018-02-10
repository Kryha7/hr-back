<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditRaffleRequest;
use App\Http\Requests\RaffleRequest;
use App\Http\Requests\TakeInRequest;
use App\Raffle;
use App\TicketsTransactions;
use App\User;
use Illuminate\Support\Facades\Auth;

class RafflesController extends Controller
{
    public function index()
    {
        $raffles = Raffle::orderBy('id', 'desc')->get();

        return view('admin.raffles', compact('raffles'));
    }

    public function create()
    {
        return view('admin.raffle.create');
    }

    public function edit(Raffle $raffle)
    {
        return view('admin.raffle.edit', compact('raffle'));
    }

    public function store(RaffleRequest $request)
    {
        $raffle = new Raffle();
        $raffle->brand = $request->brand;
        $raffle->title = $request->title;
        $raffle->type = $request->type;
        $raffle->tickets = 0;
        $raffle->max_tickets = $request->max_tickets;
        $raffle->description = $request->description;
        $raffle->thumb = 997;
        $raffle->end = 0;
        $raffle->save();

        $path = base_path().'/public/img/raffles/'.$raffle->id;
        mkdir($path, 0777);

        $thumb_name = str_random(20).'.'.$request->file('thumb')->getClientOriginalExtension();
        $request->file('thumb')->move($path, $thumb_name);

        $raffle->thumb = $thumb_name;
        $raffle->save();

        if ($request->images)
        {
            $count = count($request->images);

            for ($int = 0; $int < $count; $int++)
            {
                $image_name = str_random(20).'.'.$request->images[$int]->getClientOriginalExtension();
                $request->images[$int]->move($path, $image_name);
            }
        }

        return redirect()->route('raffle.index');
    }

    public function update(EditRaffleRequest $request, Raffle $raffle)
    {
        $raffle->brand = $request->brand;
        $raffle->title = $request->title;
        $raffle->max_tickets = $request->max_tickets;
        $raffle->type = $request->type;
        $raffle->description = $request->description;
        $raffle->update();

        return redirect()->route('raffle.index');
    }

    public function delete(Raffle $raffle)
    {
        $path = base_path().'/public/img/raffles/'.$raffle->id;

        $files = glob(base_path().'/public/img/raffles/'.$raffle->id.'/*'); // get all file names
        foreach($files as $file){ // iterate files
            if(is_file($file))
                unlink($file); // delete file from directory
        }
        rmdir($path);// delete directory
        $raffle->delete();
        return redirect()->route('raffle.index');
    }

    public function participants(Raffle $raffle)
    {
        $transactions = TicketsTransactions::where('raffle_id', $raffle->id)->get();
        return view('admin.raffle.participants', compact('transactions', 'raffle'));
    }

    public function raffle_winner(Raffle $raffle)
    {
        if ($raffle->tickets == $raffle->max_tickets && empty($raffle->winner))
        {
            $transactions = TicketsTransactions::where('raffle_id', $raffle->id)->get();
            $basket = array();

            foreach ($transactions as $transaction)
            {
                for ($i = 0; $i < $transaction->amount; $i++)
                {
                    array_push($basket, $transaction->user_id);
                }
            }

            $winner = $basket[rand(0, $raffle->max_tickets-1)];

            $raffle->winner = $winner;
            $raffle->end = 1;
            $raffle->update();

            return redirect()->route('raffle.index');
        }
        else
        {
            session()->flash('status', 'Nie mozna jeszcze wylosowac :(');
            return redirect()->route('raffle.index');
        }
    }

    public function take_in(TakeInRequest $request, Raffle $raffle)
    {
        $user = Auth::user();
        $transactions = TicketsTransactions::where('raffle_id', $raffle->id)->get();

        foreach ($transactions as $trasaction)
        {
            if ($trasaction->user_id == $user->id)
            {
                session()->flash('raffle', 'Już zapisałeś sie na raffle');
                return redirect()->route('home');
            }
        }

        if ($request->tickets <= $user->tickets)
        {
            $sum_tickets = $raffle->tickets += $request->tickets;
            if ($sum_tickets <= $raffle->max_tickets)
            {
                $user2 = User::where('id', $user->id)->first();

                $transaction = new TicketsTransactions();
                $transaction->raffle_id = $raffle->id;
                $transaction->user_id = $user->id;
                $transaction->amount = $request->tickets;
                $transaction->save();

                $user2->tickets = $user2->tickets -= $request->tickets;
                $user2->update();

                $raffle->tickets = $sum_tickets;
                $raffle->update();

                session()->flash('raffle', 'Udalo ci sie zapisac na raffle ;)');
                return redirect()->route('home');
            }
            else
            {
                session()->flash('raffle', 'Nie ma tyle miejsc na tickety');
                return redirect()->route('home');
            }
        }
        else
        {
            session()->flash('raffle', 'Nie masz wystarczajaco tiketuw');
            return redirect()->route('home');
        }
    }

    public function show_winner(Raffle $raffle)
    {
        $user = User::where('id', $raffle->winner)->first();
        return $user;
    }
}
