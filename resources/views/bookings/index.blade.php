@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Bookings</h1>

        <!-- Button to Create New Booking -->
        <a href="{{ route('bookings.create') }}" class="btn btn-success mb-4">Create New Booking</a>

        <a href="{{ route('revenue') }}" class="btn btn-info mb-4">Show Revenue</a>
        <!-- Search Form -->
        <form action="{{ route('bookings.index') }}" method="GET" class="mb-4">
            <div class="row">
                <div class="col-md-3 mb-2">
                    <input type="text" name="reservation_number" class="form-control" placeholder="Reservation Number"
                        value="{{ request('reservation_number') }}">
                </div>
                <div class="col-md-3 mb-2">
                    <input type="text" name="name" class="form-control" placeholder="Guest Name"
                        value="{{ request('name') }}">
                </div>
                <div class="col-md-3 mb-2">
                    <input type="date" name="check_in" class="form-control" value="{{ request('check_in') }}">
                </div>
                <div class="col-md-3 mb-2">
                    <input type="date" name="check_out" class="form-control" value="{{ request('check_out') }}">
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 mb-2">
                    <select name="payment_status" class="form-control">
                        <option value="">Payment Status</option>
                        <option value="paid" {{ request('payment_status') == 'paid' ? 'selected' : '' }}>Paid</option>
                        <option value="unpaid" {{ request('payment_status') == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                    </select>
                </div>
                <div class="col-md-3 mb-2">
                    <input type="text" name="country" class="form-control" placeholder="Guest Country"
                        value="{{ request('country') }}">
                </div>
                <div class="col-md-3 mb-2">
                    <input type="text" name="reservation_date_from" class="form-control"
                        placeholder="Reservation Date From" value="{{ request('reservation_date_from') }}">
                </div>
                <div class="col-md-3 mb-2">
                    <input type="text" name="reservation_date_to" class="form-control" placeholder="Reservation Date To"
                        value="{{ request('reservation_date_to') }}">
                </div>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Search</button>
        </form>

        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>Reservation Number</th>
                        <th>Guest Name</th>
                        <th>Check-in</th>
                        <th>Check-out</th>
                        <th>Payment Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($bookings as $booking)
                        <tr>
                            <td>{{ $booking->reservation_number }}</td>
                            <td>{{ $booking->name }}</td>
                            <td>{{ $booking->check_in }}</td>
                            <td>{{ $booking->check_out }}</td>
                            <td>{{ $booking->payment_status }}</td>
                            <td>
                                <form action="{{ route('bookings.cancel', $booking->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('POST')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to cancel this booking?');">Cancel</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No bookings found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
