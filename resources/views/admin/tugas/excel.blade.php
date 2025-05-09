<table>
    <thead>
        <tr>
            <td colspan="5" align="center">Data Tugas</td>
        </tr>
        <tr>
            <td colspan="5" align="center">tanggal : {{$tanggal}}</td>
        </tr>
        <tr>
            <td colspan="5" align="center">Pukul : {{$jam}}</td>
        </tr>
        <tr>
            <th width="20" align="center">No.</th>
            <th width="20" align="center">Nama</th>
            <th width="20" align="center">Email</th>
            <th width="20" align="center">Tugas</th>
            <th width="20" align="center">tanggal Mulai</th>
            <th width="20" align="center">Tanggal Selesai</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($tugas as $item)
            <tr>
                <td align="center">{{ $loop->iteration }}</td>
                <td>{{ $item->user->nama }}</td>
                <td>{{ $item->user->email }}</td>
                <td>{{ $item->tugas }}</td>
                <td align="center">{{ $item->tanggal_mulai }}</td>
                <td align="center">{{ $item->tanggal_selesai }}</td>
        @endforeach
    </tbody>
</table>