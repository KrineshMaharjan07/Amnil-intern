<?php
use App\Models\Category;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/css/app.css')

</head>

<body class="flex items-center justify-center min-h-screen bg-gray-100">

    <form action="/addproduct" method="POST" class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md space-y-4">
        @csrf

        <div>
            <label for="title" class="block text-sm font-medium text-gray-700">Product Title</label>
            <input type="text" id="title" name="title"
                class="w-full mt-1 p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                required>
        </div>

        <div>
            <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
            <input type="number" id="price" name="price"
                class="w-full mt-1 p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                required>
        </div>
        <div>
            <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
            <select id="category" name="category_id"
                class="w-full mt-1 p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                required>
                <option value="">Select a category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">
                        {{ $category->title }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <span class="block text-sm font-medium text-gray-700">Status</span>
            <div class="mt-1 flex gap-4">
                <label class="flex items-center">
                    <input type="radio" name="status" value="1"
                        class="h-4 w-4 text-blue-600 border-gray-300 focus:ring-blue-500">
                    <span class="ml-2 text-gray-600">Yes</span>
                </label>
                <label class="flex items-center">
                    <input type="radio" name="status" value="0" checked
                        class="h-4 w-4 text-blue-600 border-gray-300 focus:ring-blue-500">
                    <span class="ml-2 text-gray-600">No</span>
                </label>
            </div>
        </div>

        <div>
            <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
            <input type="number" id="quantity" name="quantity" min="1"
                class="w-full mt-1 p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                required>
        </div>

        <div>
            <label for="order" class="block text-sm font-medium text-gray-700">Order</label>
            <input type="number" id="order" name="order" value="0"
                class="w-full mt-1 p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div class="flex justify-end">
            <button type="submit"
                class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400">
                Submit
            </button>
        </div>
    </form>


</body>

</html>