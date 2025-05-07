@extends('layouts.layout.admin')

@section('content')
<div class="container-fluid mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">
            <h5 class="mb-0">Users, Cars and Spare Parts</h5>
        </div>
        <div class="card-body">
            @foreach($users as $user)
            <div class="mb-4 border p-3 rounded shadow-sm">
                <h5 class="text-primary">{{ $user->name }} <small class="text-muted">({{ $user->phone }})</small></h5>
                
                @if($user->cratecars->count() > 0)
                <table class="table table-bordered table-hover text-center align-middle mt-3">
                    <thead class="table-dark">
                        <tr>
                            <th>Car ID</th>
                            <th>Make</th>
                            <th>Model</th>
                            <th>KM</th>
                            <th>Total Price</th>
                            <th>Spare Parts</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($user->cratecars as $car)
                        <tr>
                            <td>{{ $car->id }}</td>
                            <td>{{ $car->make }}</td>
                            <td>{{ $car->model }}</td>
                            <td>{{ $car->km }}</td>
                            <td>{{ $car->total_price }} $</td>
                            <td>
@if($car->spareParts && $car->spareParts->count())
    <ul class="list-unstyled text-start mb-0">
        @foreach($car->spareParts as $spare)
            <li>
                <strong>{{ $spare->type }}</strong>: {{ $spare->item }} <br>
                <small>Price: {{ $spare->price }}$, Qty: {{ $spare->quantity }}</small>
            </li>
        @endforeach
    </ul>
@else
    <span class="text-muted">No Spare Parts</span>
@endif
                            </td>
                            <td>
                                <a href="" class="btn btn-sm btn-outline-primary mb-1">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">
                                        <i class="fas fa-trash-alt"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                    <p class="text-muted">No cars found for this user.</p>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
