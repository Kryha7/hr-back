<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditPoolRequest;
use App\Http\Requests\PoolRequest;
use App\Http\Requests\VoteRequest;
use App\Pool;
use App\PoolsVote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PoolsController extends Controller
{
    public function index()
    {
        $pools = Pool::orderBy('id', 'desc')->where('end',0)->get();
        return view('admin.pools', compact('pools'));
    }

    public function create()
    {
        return view('admin.pool.create');
    }

    public function edit(Pool $pool)
    {
        return view('admin.pool.edit', compact('pool'));
    }

    public function close_pool(Pool $pool)
    {
        $pool->end = 1;
        $pool->update();

        return back();
    }

    public function store(PoolRequest $request)
    {
        $pool = new Pool();
        $pool->first_option = $request->first_option;
        $pool->second_option = $request->second_option;
        $pool->first_votes = $request->first_votes;
        $pool->second_votes = $request->second_votes;
        $pool->first_thumb = 997;
        $pool->second_thumb = 997;
        $pool->end = 0;
        $pool->save();

        $path = base_path().'/public/img/pools/'.$pool->id;
        mkdir($path, 0777);

        $first_thumb_name = str_random(20).'.'.$request->file('first_thumb')->getClientOriginalExtension();
        $second_thumb_name = str_random(20).'.'.$request->file('second_thumb')->getClientOriginalExtension();

        $request->file('first_thumb')->move($path, $first_thumb_name);
        $request->file('second_thumb')->move($path, $second_thumb_name);

        $pool->first_thumb = $first_thumb_name;
        $pool->second_thumb = $second_thumb_name;
        $pool->save();

        return redirect()->route('pool.index');
    }

    public function update(EditPoolRequest $request, Pool $pool)
    {
        $pool->first_option = $request->input('first_option');
        $pool->second_option = $request->input('second_option');
        $pool->update();

        return redirect()->route('pool.index');
    }

    public function delete(Pool $pool)
    {
        $path = base_path().'/public/img/pools/'.$pool->id;

        $files = glob(base_path().'/public/img/pools/'.$pool->id.'/*'); // get all file names
        foreach($files as $file){ // iterate files
            if(is_file($file))
                unlink($file); // delete file from directory
        }
        rmdir($path);// delete directory
        $pool->delete();
        return redirect()->route('pool.index');
    }

    public function vote(VoteRequest $request, Pool $pool)
    {
        $id = Auth::user()->id;
        $pool_votes = PoolsVote::where('pool_id', $pool->id)->get();

        foreach ($pool_votes as $pool_vote)
        {
            if ($pool_vote->user_id == $id)
            {
                session()->flash('status', 'Już oddałeś vote');
                return redirect()->route('home');
            }
        }

        if($request->vote == 1)
        {
            $pool_vote = new PoolsVote();
            $pool_vote->pool_id = $pool->id;
            $pool_vote->user_id = $id;
            $pool_vote->vote = 1;
            $pool_vote->save();

            $pool->first_votes = $pool->first_votes += 1;
            $pool->update();

            session()->flash('status', 'Oddałeś głos poprawnie');
            return redirect()->route('home');
        }
        else
        {
            $pool_vote = new PoolsVote();
            $pool_vote->pool_id = $pool->id;
            $pool_vote->user_id = $id;
            $pool_vote->vote = 2;
            $pool_vote->save();

            $pool->second_votes = $pool->second_votes += 1;
            $pool->update();

            session()->flash('status', 'Oddałeś głos poprawnie');
            return redirect()->route('home');
        }
    }
}
