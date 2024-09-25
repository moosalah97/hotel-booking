@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Create New Booking</h1>

        <!-- Booking Form -->
        <form action="{{ route('bookings.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-3 mb-2">
                    <input type="date" name="reservation_date" class="form-control" required>
                </div>
                <div class="col-md-3 mb-2">
                    <input type="text" name="name" class="form-control" placeholder="Guest Name" required>
                </div>
                <div class="col-md-3 mb-2">
                    <input type="date" name="check_in" class="form-control" required>
                </div>
                <div class="col-md-3 mb-2">
                    <input type="date" name="check_out" class="form-control" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 mb-2">
                    <input type="text" name="email" class="form-control" placeholder="Email" required>
                </div>
                <div class="col-md-3 mb-2">
                    <input type="text" name="phone_number" class="form-control" placeholder="Phone Number" required>
                </div>
                <div class="col-md-3 mb-2">
                    <input type="text" name="country" class="form-control" placeholder="Country" required>
                </div>
                <div class="col-md-3 mb-2">
                    <input type="number" name="total" class="form-control" placeholder="Total Amount" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 mb-2">
                    <select name="room_id" class="form-control" required>
                        <option value="">Select Room</option>
                        @foreach ($rooms as $room)
                            <option value="{{ $room->id }}">{{ $room->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 mb-2">
                    <select name="rateplan_id" class="form-control" required>
                        <option value="">Select Rate Plan</option>
                        @foreach ($rateplans as $rateplan)
                            <option value="{{ $rateplan->id }}">{{ $rateplan->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 mb-2">
                    <select name="calendar_id" class="form-control" required>
                        <option value="">Select Calendar</option>
                        @foreach ($calendars as $calendar)
                            <option value="{{ $calendar->id }}">{{ $calendar->date }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 mb-2">
                    <select name="payment_status" class="form-control" required>
                        <option value="">Payment Status</option>
                        <option value="paid">Paid</option>
                        <option value="pending">Pending</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                </div>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Submit Booking</button>
        </form>
    </div>
@endsection
