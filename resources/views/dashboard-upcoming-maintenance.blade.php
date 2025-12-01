
<section>
    <h3 class="text-xl font-semibold text-gray-800 mb-4">Upcoming Maintenance</h3>
    <div class="bg-white p-6 rounded-lg shadow">
        @php
            $now = now();
            $month = $now->month;
            $year = $now->year;
            $daysInMonth = $now->daysInMonth;
            $firstDayOfMonth = $now->copy()->firstOfMonth()->dayOfWeek;
        @endphp
        <div class="text-center mb-4">
            <h5 class="text-xl font-bold">{{ $now->format('F Y') }}</h5>
        </div>
        <div class="grid grid-cols-7 gap-2 text-center">
            <div class="font-semibold text-gray-700 py-2">Sun</div>
            <div class="font-semibold text-gray-700 py-2">Mon</div>
            <div class="font-semibold text-gray-700 py-2">Tue</div>
            <div class="font-semibold text-gray-700 py-2">Wed</div>
            <div class="font-semibold text-gray-700 py-2">Thu</div>
            <div class="font-semibold text-gray-700 py-2">Fri</div>
            <div class="font-semibold text-gray-700 py-2">Sat</div>
            @for ($i = 0; $i < $firstDayOfMonth; $i++)
                <div class="p-4 min-h-20 rounded-lg"></div>
            @endfor
            @for ($day = 1; $day <= $daysInMonth; $day++)
                @php
                    $date = \Carbon\Carbon::create($year, $month, $day)->format('Y-m-d');
                    $dayMaintenances = \App\Models\Maintenance::where('date', $date)->get();
                @endphp
                <a href="/maintenance/{{ $year }}/{{ $month }}/{{ $day }}" class="block p-4 border border-gray-200 min-h-20 rounded-lg shadow-sm {{ $dayMaintenances->count() > 0 ? 'bg-blue-50' : 'bg-gray-50' }} text-gray-500 hover:bg-gray-100 transition">
                    <div class="text-lg">{{ $day }}</div>
                    <div class="text-xs mt-2 {{ $dayMaintenances->count() > 0 ? 'text-blue-600' : 'text-gray-400' }}">
                        @if($dayMaintenances->count() > 0)
                            @foreach($dayMaintenances as $maintenance)
                                {{ $maintenance->user_name }}<br>
                            @endforeach
                        @else
                            No maintenance
                        @endif
                    </div>
                </a>
            @endfor
        </div>
    </div>
</section>