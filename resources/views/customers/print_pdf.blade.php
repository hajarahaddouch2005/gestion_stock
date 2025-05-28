<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Customers PDF</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 6px; text-align: left; }
        th { background-color: #f2f2f2; }
        h2 { text-align: center; }
    </style>
</head>
<body>
    <h2>List of Customers</h2>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Address</th>
                <th>Email</th>
                <th>Phone</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($customers as $customer)
                <tr>
                    <td>{{ $customer->first_name }} {{ $customer->last_name }}</td>
                    <td>{{ $customer->address }}</td>
                    <td>{{ $customer->email }}</td>
                    <td>{{ $customer->phone }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
