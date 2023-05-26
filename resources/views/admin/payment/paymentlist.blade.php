@extends('layouts.admin')

@section('title', 'Payments')

@section('content')
<div class="py-3">
    <!-- button options here-->    
</div>

<div class="table-responsive">
    <table id="payments-table" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Payment Amount</th>
                <th>Parishioner</th>
                <th>Document Type</th>
                <th>Date Submitted</th>
                <th class="text-center">Verified</th>
                <th>Option</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($payments as $payment)
                <tr>
                    <td>Php {{ number_format($payment->amount, 2) }}</td>
                    <td>{{ $payment->parishioner->name }}</td>
                    <td>{{ $payment->documentRequest->document_type }}</td>
                    <td>{{ $payment->created_at }}</td>
                    <td class="text-center">
                        @if ($payment->is_verified)
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="icon-size text-success">
                                <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd" />
                            </svg>                                               
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="icon-size text-danger">
                                <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm-1.72 6.97a.75.75 0 10-1.06 1.06L10.94 12l-1.72 1.72a.75.75 0 101.06 1.06L12 13.06l1.72 1.72a.75.75 0 101.06-1.06L13.06 12l1.72-1.72a.75.75 0 10-1.06-1.06L12 10.94l-1.72-1.72z" clip-rule="evenodd" />
                            </svg>
                                                
                        @endif
                    </td>
                    <td>
                        <button class="btn btn-success btn-sm" {{ $payment->is_verified ? 'disabled' : '' }} data-bs-toggle="modal" data-bs-target="#paymentModal{{ $payment->id }}">Verify</button>
                        <div class="modal fade" id="paymentModal{{ $payment->id }}" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h1 class="modal-title fs-5" id="paymentModalLabel">Verify Payment</h1>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                        
                                <form action="{{ route('paymentverify', ['payment' => $payment->id]) }}" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        Please confirm on verifying payment.
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary">Confirm</button>
                                    </div>
                                </form>
                        
                              </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @empty
                
            @endforelse
            
        </tbody>
    </table>
</div>

@endsection


@push('scripts')
    <link rel="stylesheet" href="/vendor/datatables/dataTables.bootstrap5.min.css">
@endpush

@push('scripts')
    <script src="/vendor/jquery/jquery-3.5.1.js"></script>
    <script src="/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="/vendor/datatables/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#payments-table').DataTable({
                'sort': false
            });
            
        });

    </script>
@endpush
