<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">

    <title>Product Report</title>

    <style>

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        h1 {
            text-align: center;
            margin-bottom: 5px;
        }

        .subtitle {
            text-align: center;
            color: #666;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background-color: #15803d;
            color: white;
            padding: 8px;
            text-align: left;
        }

        td {
            padding: 8px;
            border: 1px solid #ddd;
        }

        .price {
            color: #15803d;
            font-weight: bold;
        }

    </style>

</head>

<body>

    <h1>Smart Local Farmer Product Report</h1>

    <div class="subtitle">
        Product Listing Report
    </div>

    <table>

        <thead>

            <tr>
                <th>No.</th>
                <th>Product</th>
                <th>Category</th>
                <th>Grade</th>
                <th>Quantity</th>
                <th>Unit</th>
                <th>Price (RM)</th>
                <th>Farmer</th>
            </tr>

        </thead>

        <tbody>

            @forelse($products as $index => $product)

                <tr>

                    <td>
                        {{ $index + 1 }}
                    </td>

                    <td>
                        {{ $product->name }}
                    </td>

                    <td>
                        {{ $product->category }}
                    </td>

                    <td>
                        {{ $product->grade }}
                    </td>

                    <td>
                        {{ $product->quantity }}
                    </td>

                    <td>
                        {{ $product->unit }}
                    </td>

                    <td class="price">
                        RM {{ number_format($product->price, 2) }}
                    </td>

                    <td>
                        {{ $product->user->name ?? '-' }}
                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="8" style="text-align:center;">
                        No products found.
                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>

</body>
</html>