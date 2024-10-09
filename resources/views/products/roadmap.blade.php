<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>{{ $title }}</h1>
    <p>Date: {{ $date }}</p>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Start date</th>
                <th>End date</th>
               
            </tr>
        </thead>
        <tbody>
            @foreach ($roadmaps as $index => $item) <!-- Use roadmapData for subject names -->
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item['start_date'] }}</td>
                    <td>{{ $item['end_time'] }}</td>

                </tr>
            @endforeach
        </tbody>
    </table>


</body>
</html>
