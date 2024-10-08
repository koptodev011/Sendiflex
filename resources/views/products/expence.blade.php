<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense List - {{ $month_name }}</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 20px;
            background-color: #f8f9fa;
            color: #333;
        }
        h1, h3 {
            text-align: center;
            color: #0056b3;
        }
        h1 {
            margin-bottom: 10px;
        }
        h3 {
            margin-top: 5px;
            font-weight: normal;
        }
        p {
            text-align: center;
            font-size: 14px;
            margin-bottom: 20px;
            color: #555;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #e2e6ea;
        }
        .total {
            margin-top: 20px;
            font-size: 18px;
            font-weight: bold;
            text-align: center;
            color: #d9534f;
        }
    </style>
</head>
<body>
    <h1>{{ $title }}</h1>
    <h3>Expense List for {{ $month_name }}</h3>
    <p>Date: {{ $date }}</p>

    <table>
        <thead>
            <tr>
                <th>Sr No</th>
                <th>Expense Title</th>
                <th>Amount</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $index => $expense)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $expense->expence_title }}</td>
                    <td>{{ number_format($expense->expence_amount, 2) }}</td>
                    <td>
                        <input type="checkbox" name="expense_status[{{ $expense->id }}]" {{ $expense->status ? 'checked' : '' }}>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align:center;">No expenses found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="total">
        Total Expense: {{ number_format($totalExpence, 2) }}
    </div>
</body>
</html>
