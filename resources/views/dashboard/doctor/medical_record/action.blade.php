@extends('dashboard.template.main')
@section('content')
    <div class="flex justify-between">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="{{ route('dashboard.show.doctor') }}"
                        class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                        Dashboard
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <a href="{{ route('medical_record.list') }}"
                            class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">
                            Medical Record
                        </a>
                    </div>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <a href="{{ route('medical_record.action', $id) }}"
                            class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">Action</a>
                    </div>
                </li>
            </ol>
        </nav>
    </div>

    <hr class="h-px my-4 bg-gray-200 border-0 dark:bg-gray-500">

    <form action="" method="POST">
        @csrf

        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <tbody>
                <tr class="bg-white  dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        Check Date
                    </th>
                    <td class="px-6 py-4">
                        {{ $item->check_date }}
                    </td>
                    <td class="px-6 py-4">

                    </td>
                    <td class="px-6 py-4">

                    </td>
                    <td class="px-6 py-4">
                    </td>
                </tr>
                <tr class="bg-white  dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        Owner
                    </th>
                    <td class="px-6 py-4">
                        {{ $item->pet->owner->name }}
                    </td>
                    <td class="px-6 py-4">

                    </td>
                    <td class="px-6 py-4">

                    </td>
                    <td class="px-6 py-4">

                    </td>
                </tr>
                <tr class="bg-white dark:bg-gray-800">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        Pet
                    </th>
                    <td class="px-6 py-4">
                        {{ $item->pet->name }}
                    </td>
                    <td class="px-6 py-4">

                    </td>
                    <td class="px-6 py-4">
                    </td>
                    <td class="px-6 py-4">
                    </td>
                </tr>
                <tr class="bg-white dark:bg-gray-800">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        Complaints
                    </th>
                    <td class="px-6 py-4">
                        {{ $item->complaint }}
                    </td>
                    <td class="px-6 py-4">

                    </td>
                    <td class="px-6 py-4">

                    </td>
                    <td class="px-6 py-4">
                    </td>
                </tr>
                <tr class="bg-white dark:bg-gray-800">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        Doctor
                    </th>
                    <td class="px-6 py-4">
                        {{ $item->doctor->name }}
                    </td>
                    <td class="px-6 py-4">

                    </td>
                    <td class="px-6 py-4">

                    </td>
                    <td class="px-6 py-4">
                    </td>
                </tr>
                <tr class="bg-white dark:bg-gray-800">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        Diagnosa
                    </th>
                    <td class="px-6 py-4">
                        @if ($item->diagnosis == null || $item->diagnosis == '')
                            <span
                                class="bg-pink-100 text-pink-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-pink-900 dark:text-pink-300">
                                Belum mengisi diagnosa
                            </span>
                        @else
                            {{ $item->diagnosis }}
                        @endif
                    </td>

                    <td class="px-6 py-4">

                    </td>
                    <td class="px-6 py-4">

                    </td>
                    <td class="px-6 py-4">
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="mb-3">
            <div class="mb-3">
                <label for="check_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Check Date
                </label>
                <input type="date" id="check_date" name="check_date" value="{{ $item->check_date }}" disabled
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>
        </div>

        <div class="mb-3">
            <label for="owner_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                Owner / Pemilik
            </label>
            <input type="text" id="owner_id" name="owner_id" value="{{ $item->pet->owner->name }}" disabled
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        </div>

        <div class="mb-3">
            <label for="pet_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                Pet
            </label>
            <input type="pet_id" id="pet_id" name="pet_id" value="{{ $item->pet->name }}" disabled
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <div class="flex justify-end">
                <div class="text-black dark:text-white mr-2">
                    Update pet?
                </div>
                <a href="{{ route('pet.check', $item->pet->id) }}" class="text-blue-500">klik sini</a>
            </div>
        </div>

        <div class="mb-3">
            <label for="complaints" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                Complaints
            </label>
            <textarea id="complaints" rows="4" name="complaints" disabled
                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Ketik disini...">{{ $item->complaint }}</textarea>
        </div>

        <div class="mb-3">
            <label for="doctor_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                Doctor Specialize
            </label>
            <input type="text" id="doctor_id" name="doctor_id" value="{{ $item->doctor->name }}" disabled
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        </div>

        <div class="mb-3">
            <label for="diagnosis" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                Diagnosis <span class="text-red-500">*</span>
            </label>
            <textarea id="diagnosis" rows="4" name="diagnosis" required
                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Diagnosis ...">{{ $item->diagnosis }}</textarea>
        </div>

        <input type="text" value="{{ $item->id }}" name="id" hidden>

        <div class="flex justify-end my-10">
            <button type="submit"
                class="px-5 py-2.5 text-sm font-medium text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Simpan
            </button>
        </div>

    </form>
@endsection()

@section('script-js')
    <script>
        var currentStep = 1;

        function goToStep(step) {
            var forms = document.querySelectorAll('form');
            if (step < 1 || step > forms.length) return;

            forms.forEach(function(form) {
                form.classList.add('hidden');
            });

            document.getElementById('formStep' + step).classList.remove('hidden');
            currentStep = step;
        }

        var now = new Date();
        var year = now.getFullYear();
        var month = String(now.getMonth() + 1).padStart(2, '0');
        var day = String(now.getDate()).padStart(2, '0');
        var today = year + '-' + month + '-' + day;

        document.getElementById('check_date').value = today;
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var ownerSelect = document.getElementById('owner_id');
            var petSelect = document.getElementById('pet_id');

            ownerSelect.addEventListener('change', function() {
                // Enable pet select
                petSelect.removeAttribute('disabled');

                // Filter pets based on selected owner
                var selectedOwnerId = ownerSelect.value;
                Array.from(petSelect.options).forEach(function(option) {
                    if (option.dataset.ownerId === selectedOwnerId || option.value === '') {
                        option.style.display = 'block';
                    } else {
                        option.style.display = 'none';
                    }
                });
            });
        });
    </script>
@endsection
