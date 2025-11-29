
<section>
    <h3 class="text-xl font-semibold text-gray-800 mb-4">Scheduled Maintenance</h3>
    @if($assets_with_maintenance->isNotEmpty())
        <div class="bg-white p-6 rounded-lg shadow">
            @php
                $now = now();
                $month = $now->month;
                $year = $now->year;
                $daysInMonth = $now->daysInMonth;
                $firstDayOfMonth = $now->copy()->firstOfMonth()->dayOfWeek;
                $maintenancesByDate = $assets_with_maintenance->filter(function ($asset) {
                    return $asset->last_maintenance;
                })->groupBy(function ($asset) {
                    return $asset->last_maintenance->format('Y-m-d');
                });
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
                        $hasMaintenance = isset($maintenancesByDate[$date]);
                    @endphp
                    <div class="p-4 border border-gray-200 min-h-20 rounded-lg shadow-sm {{ $hasMaintenance ? 'bg-blue-100 text-blue-800 font-semibold' : 'bg-gray-50 text-gray-500' }}">
                        <div class="text-lg">{{ $day }}</div>
                        @if($hasMaintenance)
                            <div class="text-xs mt-2 space-y-1">
                                @foreach($maintenancesByDate[$date] as $asset)
                                    <div class="bg-blue-200 rounded p-2">
                                        <div>{{ $asset->type }}</div>
                                        <div>{{ str_replace(['Mr. ', 'Ms. '], '', $asset->user ?? 'Unassigned') }} ({{ $asset->office }})</div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-xs mt-2 text-gray-400">
                                No maintenance
                            </div>
                        @endif
                    </div>
                @endfor
            </div>
        </div>
    @else
        <div class="bg-white p-6 rounded-lg shadow text-center text-gray-500">
            No scheduled maintenance.
        </div>
    @endif
</section>