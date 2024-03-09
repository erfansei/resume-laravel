<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight self-center">
                {{ __('Experiences') }}
            </h2>
            <a href="{{route('experiences.create')}}"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Add</a>
        </div>
    </x-slot>
    <div class="my-20 max-w-7xl m-auto">


        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            #
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Description
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Date
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Settings
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($exps as $exp)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{$loop->index + $exps->firstItem()}}
                        </th>
                        <td class="px-6 py-4">
                            {{$exp->title}}
                        </td>
                        <td class="px-6 py-4">
                            {{$exp->description}}
                        </td>
                        <td class="px-6 py-4">
                            {{$exp->created_at}}
                        </td>
                        <td class="px-6 py-4">
                        <a href="{{route('experiences.destroy',['id'=>$exp->id])}}"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {!! $exps->links() !!}
        </div>

    </div>
</x-app-layout>