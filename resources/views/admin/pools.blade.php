@extends('layouts.admin')

@section('content')
   <div class="container">
       <div class="row mt-5">
           <div class="col-md-12">
               <div class="card panel-default">
                   <div class="card-header">Pools list</div>
                   <div class="card-body p-0">
                       @if (session('status'))
                           <div class="alert alert-success">
                               {{ session('status') }}
                           </div>
                       @endif
                       <table class="table">
                           <thead class="thead-light">
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th>First option</th>
                                    <th>Second option</th>
                                    <th class="text-center">First votes</th>
                                    <th class="text-center">Second votes</th>
                                    <th class="text-center">Votes</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                           </thead>
                           <tbody>
                           @foreach($pools as $pool)
                               <tr>
                                <th scope="row" class="text-center">{{$pool->id}}</th>
                                <td>{{$pool->first_option}}</td>
                                <td>{{$pool->second_option}}</td>
                                <td class="text-center">{{$pool->first_votes}}</td>
                                <td class="text-center">{{$pool->second_votes}}</td>
                                <td class="text-center">{{$pool->first_votes + $pool->second_votes}}</td>
                                <td class="text-center"><a href="{{route('pool.close_pool', $pool)}}"><button class="btn btn-secondary">Close pool</button></a></td>
                                <td class="text-center"><a href="{{route('pool.edit', $pool)}}"><button class="btn btn-warning">Edit</button></a></td>
                                <td class="text-center"><a href="{{route('pool.delete', $pool)}}"><button class="btn btn-danger">Delete</button></a></td>
                               </tr>
                           @endforeach
                           </tbody>
                       </table>
                   </div>
                   {{--Pagination--}}
                   {{--<div class="card-footer">--}}
                       {{----}}
                   {{--</div>--}}
               </div>
           </div>
       </div>
   </div>
@endsection