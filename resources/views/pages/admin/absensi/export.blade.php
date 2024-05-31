<table class="table table-bordered table-striped table-sm">
    <thead>
        <tr>
            <th style="vertical-align: middle;">No.</th>
            <th style="vertical-align: middle;">NIP</th>
            <th style="vertical-align: middle;">Nama</th>
            <th style="vertical-align: middle;">Jabatan</th>
            <th style="vertical-align: middle;">Tanggal Awal</th>
            <th style="vertical-align: middle;">Tanggal Akhir</th>
            <th style="vertical-align: middle;" class="text-center">Jumlah <br> Hadir</th>
            <th style="vertical-align: middle;" class="text-center">Jumlah <br> Izin</th>
            <th style="vertical-align: middle;" class="text-center">Jumlah <br> Sakit</th>
        </tr>
    </thead>
    <tbody>
        @php
            $no = 1;
        @endphp
        @forelse ($users as $user)
            <tr>
                <td>{{ $no++; }}</td>
                <td>{{ $user->nip }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->position }}</td>
                <td>{{ date('d-m-Y', strtotime($date1)) }}</td>
                <td>{{ date('d-m-Y', strtotime($date2)) }}</td>
                <td class="text-center">
                    @php
                        $attendance = App\Models\Absensi::where([
                            ['user_id','=', $user->id],
                            ['description','=', 'Hadir'],
                        ])->whereBetween('date', [$date1, $date2])->count();
                    @endphp
                    {{ $attendance }}
                </td>
                <td class="text-center">
                    @php
                        $permission = App\Models\Absensi::where([
                            ['user_id','=', $user->id],
                            ['description','=', 'Izin'],
                        ])->whereBetween('date', [$date1, $date2])->count();
                    @endphp
                    {{ $permission }}
                </td>
                <td class="text-center">
                    @php
                        $sick = App\Models\Absensi::where([
                            ['user_id','=', $user->id],
                            ['description','=', 'Sakit'],
                        ])->whereBetween('date', [$date1, $date2])->count();
                    @endphp
                    {{ $sick }}
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="9" class="text-center">Data tidak ditemukan</td>
            </tr>
        @endforelse
    </tbody>
</table>