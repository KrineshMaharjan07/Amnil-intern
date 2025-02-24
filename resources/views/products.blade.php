<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite('resources/css/app.css')
</head>

<body>
    <div class="m-4">
        <a href="{{ route('products.create') }}" class=" px-4 py-2 bg-blue-500 text-white
        font-bold rounded-lg hover:bg-blue-600 focus:ring focus:ring-blue-300">Add Product</a>
    </div>
    <div name='Products' class="m-4">
        @csrf
        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-blue-500 text-white">
                    <th class="p-2 border border-gray-300">Title</th>
                    <th class="p-2 border border-gray-300">Price</th>
                    <th class="p-2 border border-gray-300">Status</th>
                    <th class="p-2 border border-gray-300">Quantity</th>
                    <th class="p-2 border border-gray-300">Order</th>
                    <th class="p-2 border border-gray-300">Category Name</th> <!-- New Column -->
                    <th class="p-2 border border-gray-300">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr class="bg-white hover:bg-gray-100">
                        <td class="p-2 border border-gray-300">{{ $product->title }}</td>
                        <td class="p-2 border border-gray-300">{{ $product->price }}</td>
                        <td class="p-2 border border-gray-300">{{ $product->status }}</td>
                        <td class="p-2 border border-gray-300">{{ $product->quantity }}</td>
                        <td class="p-2 border border-gray-300">{{ $product->order }}</td>
                        <td class="p-2 border border-gray-300">
                            {{ $product->category->title ?? 'No Category' }} <!-- Display Category Name -->
                        </td>
                        <td class="p-2 border border-gray-300">
                            <a href='{{ route('products.edit', $product->id) }}'
                                class=" px-4 py-2 bg-blue-500 text-white
                                                            font-bold rounded-lg hover:bg-blue-600 focus:ring focus:ring-blue-300">Edit</a>
                            <a href="{{ route('products.delete', $product->id) }}"
                                class="px-4 py-2 bg-red-500 text-white font-bold rounded-lg hover:bg-red-600 focus:ring focus:ring-red-300"
                                onclick="return confirm('Are you sure you want to delete this product?');">
                                Delete
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>