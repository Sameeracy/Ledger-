<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ledger+ Dashboard Report</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            color: #212529;
            background-color: #ffffff;
            margin: 0;
            padding: 24px;
            font-size: 13px;
            line-height: 1.5;
        }

        /* Header / Brand */
        .header-table {
            width: 100%;
            border-bottom: 2px solid #dee2e6;
            padding-bottom: 14px;
            margin-bottom: 24px;
        }
        .brand-title {
            font-size: 22px;
            font-weight: 700;
            color: #212529;
        }
        .brand-plus {
            color: #0d6efd;
            font-weight: 800;
        }
        .logo-img {
            height: 32px;
            width: auto;
            vertical-align: middle;
            margin-right: 8px;
        }
        .user-details {
            text-align: right;
            font-size: 11px;
            color: #6c757d;
            line-height: 1.4;
        }

        /* Cards Layout */
        .cards-table {
            width: 100%;
            margin-bottom: 28px;
            border-spacing: 12px 0;
            margin-left: -12px;
            margin-right: -12px;
        }
        .card {
            background-color: #ffffff;
            border: 1px solid #dee2e6;
            border-radius: 6px;
            padding: 14px 16px;
        }
        .card-green-border {
            border-left: 5px solid #198754;
        }
        .card-red-border {
            border-left: 5px solid #dc3545;
        }
        .card-label {
            font-size: 10px;
            text-transform: uppercase;
            font-weight: 700;
            color: #495057;
            letter-spacing: 0.5px;
            margin-bottom: 6px;
        }
        .card-value {
            font-size: 17px;
            font-weight: 700;
        }
        .text-success {
            color: #198754 !important;
        }
        .text-danger {
            color: #dc3545 !important;
        }

        /* Table */
        .section-header {
            font-size: 14px;
            font-weight: 700;
            color: #212529;
            margin-bottom: 10px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 1rem;
        }
        .table th, .table td {
            padding: 9px 12px;
            border-top: 1px solid #dee2e6;
            font-size: 12px;
            text-align: left;
        }
        .table thead th {
            border-bottom: 2px solid #dee2e6;
            background-color: #f8f9fa;
            font-weight: 600;
            color: #495057;
        }
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, 0.02);
        }
        .text-end {
            text-align: right;
        }
        .badge {
            display: inline-block;
            padding: 3px 8px;
            font-size: 10px;
            font-weight: 700;
            border-radius: 50rem;
            text-transform: uppercase;
        }
    </style>
</head>
<body>

    <!-- Header Section -->
    <table class="header-table">
        <tr>
            <td style="vertical-align: middle;">
                @if(file_exists(public_path('images/logo/favicon.jpeg')))
                    <img src="{{ public_path('images/logo/favicon.jpeg') }}" class="logo-img" alt="Logo">
                @endif
                <span class="brand-title">Ledger<span class="brand-plus">+</span></span>
            </td>
            <td class="user-details">
                <strong>Account:</strong> {{ $user->name }}<br>
                <strong>Email:</strong> {{ $user->email }}<br>
                <strong>Date:</strong> {{ now()->format('d M Y, h:i A') }}
            </td>
        </tr>
    </table>

    <!-- 3 Summary Cards -->
    <table class="cards-table">
        <tr>
            <!-- People Owe You -->
            <td class="card card-green-border" style="width: 33%;">
                <div class="card-label">Credit</div>
                <div class="card-value text-success">
                    +Rs. {{ number_format($cards['people_owe_you'], 2) }}
                </div>
            </td>

            <!-- You Owe Others -->
            <td class="card card-red-border" style="width: 33%;">
                <div class="card-label">Debit</div>
                <div class="card-value text-danger">
                    -Rs. {{ number_format($cards['you_owe_others'], 2) }}
                </div>
            </td>

            <!-- Overall Position -->
            <td class="card {{ $cards['overall_position'] >= 0 ? 'card-green-border' : 'card-red-border' }}" style="width: 33%;">
                <div class="card-label">OVERALL POSITION ({{ $cards['overall_position'] >= 0 ? 'SURPLUS' : 'DEFICIT' }})</div>
                <div class="card-value {{ $cards['overall_position'] >= 0 ? 'text-success' : 'text-danger' }}">
                    {{ $cards['overall_position'] >= 0 ? '+Rs. ' : '-Rs. ' }}{{ number_format(abs($cards['overall_position']), 2) }}
                </div>
            </td>
        </tr>
    </table>

    <!-- Records Table -->
    <div class="section-header">Transaction Records</div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th style="width: 5%;">#</th>
                <th style="width: 15%;">Date</th>
                <th style="width: 30%;">Title</th>
                <th style="width: 20%;">Person</th>
                <th style="width: 15%;">Status</th>
                <th style="width: 15%;" class="text-end">Amount</th>
            </tr>
        </thead>
        <tbody>
            @forelse($records as $index => $record)
                @php
                    $isDebit = $record->type === 'you_owe';
                    $isSettled = $record->status === 'settled';
                @endphp
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ \Carbon\Carbon::parse($record->transaction_date)->format('M d, Y') }}</td>
                    <td><strong>{{ $record->title }}</strong></td>
                    <td>{{ $record->person_name }}</td>
                    <td>
                        <span class="badge" style="{{ $isSettled ? 'background-color: #198754; color: #ffffff;' : 'background-color: #ffc107; color: #212529;' }}">
                            {{ strtoupper($record->status) }}
                        </span>
                    </td>
                    <td class="text-end {{ $isDebit ? 'text-danger' : 'text-success' }}">
                        <strong>
                            {{ $isDebit ? '-Rs. ' : '+Rs. ' }}{{ number_format($record->amount, 2) }}
                        </strong>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center; color: #6c757d; padding: 18px;">
                        No records found.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>