@extends('front.layouts.app')
@section('content')
    <div class="container my-5">
        <div class="card">
            <div class="card-body">
                <!-- Reservation details -->
                <table>
                    <tr>
                        <td>
                            <h3 class="text-xl">Reservation Details</h3>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table>
                                <tr>
                                    <td>Reservation number:</td>
                                    <td>{{ $reservation->code }}</td>
                                </tr>
                                <tr>
                                    <td>Reservation date:</td>
                                    <td>{{ $reservation->created_at->format('d/m/Y') }}</td>
                                </tr>
                                <tr>
                                    <td>Reservation status:</td>
                                    <td>{{ strtoupper($reservation->status) }}</td>
                                </tr>
                                <tr>
                                    <td>Reservation total:</td>
                                    <td>{{ number_format($reservation->payment_amount,2,'.',' ') }} €</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                {!! $bank_transfer_page->content !!}
            </div>
        </div>

    </div>
@endsection
