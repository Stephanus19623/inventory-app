<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory</title>
</head>
<body>
    <h1>Tool Inventory</h1>
    <table border="1">
        <thead>
            <tr>
                <th>Item</th>
                <th>Description</th>
                <th>Quantity Available</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->description }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>
                        @if ($item->quantity > 0)
                            <form action="{{ route('inventory.borrow', $item->id) }}" method="POST">
                                @csrf
                                <button type="submit">Borrow</button>
                            </form>
                        @else
                            <form action="{{ route('inventory.return', $item->id) }}" method="POST">
                                @csrf
                                <button type="submit">Return</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
