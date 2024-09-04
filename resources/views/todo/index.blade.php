<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Todos') }} <span class="text-xl text-black-500">({{count($todos)}})</span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Left Column: Todo List -->
                        <div>
                            <h2 class="text-xl font-semibold mb-4">Todo List</h2>
                            @if(session('success'))
                                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4"
                                     role="alert">
                                    <p>{{ session('success') }}</p>
                                </div>
                            @endif
                            <ul class="list-disc pl-5 space-y-2 mb-4">
                                @foreach($todos as $key => $todo)
                                    <li class="text-gray-700 flex justify-between items-center">
                                        {{$todo}}
                                        <div class="flex space-x-2">
                                            <a href="{{route('todo.edit',$key)}}"
                                               class="px-2 py-1 bg-blue-500 text-white rounded-md">
                                                Edit
                                            </a>
                                            <form action="{{ route('todo.destroy', $key) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="px-2 py-1 bg-red-500 text-white rounded-md">Delete
                                                </button>
                                            </form>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <!-- Right Column: Add Form -->
                        <div class="flex justify-center items-center">
                            <div>
{{--                                @if(!isset($todo))--}}
                                    <h2 class="text-xl font-semibold mb-4">Add New Todo</h2>
                                    <form action="{{ route('todo.store') }}" method="POST" class="mb-4">
                                        @csrf
                                        <div class="flex items-center">
                                            <input type="text" name="todo"
                                                   class="border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                                   placeholder="New Todo">
                                            <button type="submit"
                                                    class="ml-2 px-4 py-2 bg-blue-500 text-white rounded-md">
                                                Add
                                            </button>
                                        </div>
                                    </form>
{{--                                @else--}}
{{--                                    <h2 class="text-xl font-semibold mb-4">Edit Todo</h2>--}}
{{--                                    <form action="{{ route('todo.store') }}" method="POST" class="mb-4">--}}
{{--                                        @csrf--}}
{{--                                        <div class="flex items-center">--}}
{{--                                            <input type="text" name="todo"--}}
{{--                                                   class="border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"--}}
{{--                                                   placeholder="New Todo">--}}
{{--                                            <button type="submit"--}}
{{--                                                    class="ml-2 px-4 py-2 bg-blue-500 text-white rounded-md">--}}
{{--                                                Add--}}
{{--                                            </button>--}}
{{--                                        </div>--}}
{{--                                    </form>--}}
{{--                                @endif--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
