@extends('layouts.admin')
@php
    $rows = collect();

    foreach ($contacts as $contact) {
        $rows->push([
            'type' => 'Брза пријава',
            'full_name' => $contact->full_name,
            'company' => $contact->company,
            'email' => $contact->email,
            'phone' => $contact->phone,
            'participants' => $contact->participants ?? '-',
            'created_at' => $contact->created_at,
        ]);
    }

    foreach ($applications as $application) {
        $rows->push([
            'type' => 'Академија',
            'full_name' => $application->full_name,
            'company' => $application->company,
            'email' => $application->email,
            'phone' => $application->phone,
            'participants' => $application->participants ?? 1,
            'created_at' => $application->created_at,
        ]);
    }

    $rows = $rows->sortByDesc('created_at');
@endphp
@section('content')
<div class="max-w-7xl mx-auto mb-8 flex items-center justify-between">
    <div>
        <h1 class="text-2xl font-bold text-slate-900">Административна табла</h1>
        <p class="text-sm text-slate-500">Управувајте со пријавите и содржините на платформата.</p>
    </div>
    
    <a href="{{ route('admin.events.index') }}" 
       class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2.5 rounded-lg text-sm font-semibold transition shadow-sm">
    Менаџирање со Настани
    </a>
</div>
<div class="min-h-screen bg-slate-50/60 px-4 py-10 mt-5 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto space-y-14">

        <div class="space-y-4">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-xl font-semibold text-slate-900 tracking-tight">
                Сите пријави
            </h2>
            <p class="text-xs text-slate-500 mt-0.5">
                Брзи пријави и пријави за академија.
            </p>
        </div>

        <span class="inline-flex items-center rounded-md bg-slate-100 px-2.5 py-1 text-xs font-medium text-slate-600 border border-slate-200/60">
            {{ $rows->count() }} вкупно
        </span>
    </div>

    <div class="overflow-hidden rounded-xl border border-slate-200/80 bg-white shadow-sm ring-1 ring-purple-100 ring-opacity-5">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-slate-50/70 border-b border-slate-200/60 text-slate-500 text-xs font-semibold uppercase tracking-wider">
                    <tr>
                        <th class="py-3.5 px-6">Тип</th>
                        <th class="py-3.5 px-6">Име</th>
                        <th class="py-3.5 px-6">Компанија</th>
                        <th class="py-3.5 px-6">Е-пошта</th>
                        <th class="py-3.5 px-6">Телефон</th>
                        <th class="py-3.5 px-6">Учесници</th>
                        <th class="py-3.5 px-6">Датум</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">
                    @foreach($rows as $row)
                        <tr class="hover:bg-slate-50/80 transition-colors duration-150 ease-in-out">

                            <td class="py-4 px-6">
                                @if($row['type'] === 'Академија')
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-indigo-50 text-indigo-700 border border-indigo-100">
                                        Академија
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-slate-100 text-slate-700 border border-slate-200">
                                        Брза пријава
                                    </span>
                                @endif
                            </td>

                            <td class="py-4 px-6 whitespace-nowrap">
                                <div class="flex items-center gap-3">
                                    <div class="h-8 w-8 rounded-full bg-slate-100 flex items-center justify-center font-medium text-slate-600 text-xs border border-slate-200/40">
                                        {{ mb_substr($row['full_name'], 0, 1) }}
                                    </div>
                                    <span class="font-medium text-slate-900">
                                        {{ $row['full_name'] }}
                                    </span>
                                </div>
                            </td>

                            <td class="py-4 px-6 text-slate-600 whitespace-nowrap">
                                @if($row['company'])
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-slate-100 text-slate-800 border border-slate-200/30">
                                        {{ $row['company'] }}
                                    </span>
                                @else
                                    <span class="text-slate-400">-</span>
                                @endif
                            </td>

                            <td class="py-4 px-6 text-slate-600 whitespace-nowrap">
                                {{ $row['email'] }}
                            </td>

                            <td class="py-4 px-6 text-slate-500 whitespace-nowrap">
                                {{ $row['phone'] ?? '-' }}
                            </td>

                            <td class="py-4 px-6 whitespace-nowrap">
                                {{ $row['participants'] }}
                            </td>

                            <td class="py-4 px-6 text-slate-500 whitespace-nowrap text-xs">
                                <time class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-slate-100/80 text-slate-600 font-medium border border-slate-200/30">
                                    {{ $row['created_at']->format('d.m.Y H:i') }}
                                </time>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


        <div class="space-y-4">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-semibold text-slate-900 tracking-tight">Прашања од корисници</h2>
                    <p class="text-xs text-slate-500 mt-0.5">Разни прашања испратени од корисниците.</p>
                </div>
                <span class="inline-flex items-center rounded-md bg-slate-100 px-2.5 py-1 text-xs font-medium text-slate-600 border border-slate-200/60">{{ count($questions) }} вкупно</span>
            </div>

            <div class="overflow-hidden rounded-xl border border-slate-200/80 bg-white shadow-sm ring-1 ring-purple-100 ring-opacity-5">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-slate-50/70 border-b border-slate-200/60 text-slate-500 text-xs font-semibold uppercase tracking-wider">
                            <tr>
                                <th scope="col" class="py-3.5 px-6">Име</th>
                                <th scope="col" class="py-3.5 px-6">Е-пошта</th>
                                <th scope="col" class="py-3.5 px-6">Прашање</th>
                                <th scope="col" class="py-3.5 px-6">Датум</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach($questions as $question)
                                <tr class="hover:bg-slate-50/80 transition-colors duration-150 ease-in-out">
                                    <td class="py-4 px-6 whitespace-nowrap">
                                        <div class="flex items-center gap-3">
                                            <div class="h-8 w-8 rounded-full bg-slate-100 flex items-center justify-center font-medium text-slate-600 text-xs border border-slate-200/40">
                                                {{ mb_substr($question->name, 0, 1) }}
                                            </div>
                                            <span class="font-medium text-slate-900">{{ $question->name }}</span>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6 text-slate-600 whitespace-nowrap">{{ $question->email }}</td>
                                    <td class="py-4 px-6 text-slate-500 max-w-xs sm:max-w-md">
                                        <p class="truncate" title="{{ $question->question }}">{{ $question->question }}</p>
                                    </td>
                                    <td class="py-4 px-6 text-slate-500 whitespace-nowrap text-xs">
                                        <time class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-slate-100/80 text-slate-600 font-medium border border-slate-200/30">
                                            {{ $question->created_at->format('d.m.Y H:i') }}
                                        </time>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>


@endsection
