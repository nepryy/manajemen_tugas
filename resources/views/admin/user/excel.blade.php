<table>
    <thead>
        <tr>
            <td colspan="5" align="center">Data User</td>
        </tr>
        <tr>
            <td colspan="5" align="center">tanggal : {{$tanggal}}</td>
        </tr>
        <tr>
            <td colspan="5" align="center">Pukul : {{$jam}}</td>
        </tr>
        <tr>
            <th width="20"  align="center">No.</th>
            <th width="20" align="center">Nama</th>
            <th width="20" align="center">Email</th>
            <th width="20" align="center">Jabatan</th>
            <th width="20" align="center">Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($user as $item)
            <tr>
                <td align="center">{{ $loop->iteration }}</td>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->email }}</td>
                <td align="center">{{ $item->jabatan }}</td>
                @if ($item->is_tugas == 0)
                <td align="center">Belum di tugaskan</td>
                @else
                <td align="center">Sudah di tugaskan</td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>