@extends('layouts.admin')

@section('title', 'Document Requests')

@section('content')
<div class="py-3">
    <!-- button options here-->    
</div>

<div class="table-responsive">
    <table id="document-requests-table" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Request Code</th>
                <th>Parishioner</th>
                <th>Document Type</th>
                <th>Availability</th>
                <th>Date Submitted</th>
                <th>Payment Amount</th>
                <th>Option</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($documentRequests as $documentRequest)
                <tr>
                    <td>{{ $documentRequest->request_code }}</td>
                    <td>{{ $documentRequest->parishioner->name }}</td>
                    <td>{{ $documentRequest->document_type }}</td>
                    <td class="text-center">
                        {{-- {{ dd($documentRequest->parishioner->documents) }} --}}
                        @if ($documentRequest->parishioner->documents->where('document_type', $documentRequest->document_type)->count())
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="icon-size text-success">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                            </svg>
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="icon-size text-danger">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z" clip-rule="evenodd" />
                            </svg>
                        @endif

                    </td>
                    <td>{{ $documentRequest->created_at }}</td>
                    <td class="">
                        <div class="d-flex justify-content-between w-full">
                            <strong>Php {{ number_format($documentRequest->payment->amount, 2) }}</strong>
                            @if ($documentRequest->payment->is_verified)
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="icon-size text-success">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                                </svg>
                                                                            
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="icon-size text-danger">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z" clip-rule="evenodd" />
                                </svg>              
                            @endif
                        </div>
                    </td>
                    <td>
                        <form action="#" method="post" class="d-inline">
                            @csrf
                            <button class="btn btn-primary btn-sm" {{ $documentRequest->is_ready ? '' : 'disabled' }}>Ready to Pick up</button>
                        </form>
                        <button class="btn btn-danger btn-sm">Reject</button>
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
            $('#document-requests-table').DataTable({

            });
            
        });

    </script>
@endpush
