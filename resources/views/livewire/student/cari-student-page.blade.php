<div class="card m-5">
    <x-slot:title>{{ $title }}</x-slot:title>
    <h5 class="card-header">Table data siswa</h5>
    <div class="card-body">
        <div class="table-responsive text-nowrap">
            <table id="myTable" class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nis</th>
                        <th>Nama Nama</th>
                        <th>Kelas</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($students as $list)
                        @php
                            $kelas = new \App\Models\ClassRoom();
                        @endphp
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $list->nis }}</td>
                            <td>{{ $list->name }}</td>
                            <td>{{ $kelas->now_class($list->tahun_masuk, $list->class->name_class) }} </td>
                            <td>
                                <a href="transaksi-siswa/{{ $list->id }}" class="btn btn-primary btn-sm">
                                    <i class="bx bx-wallet"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">
                                <span class="badge bg-danger">Nama Siswa "{{ $nama }}" Tidak Ada</span>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <a class="btn btn-primary mt-3" href="/login">Klik disini untuk
                kembali. . .</a>
        </div>
    </div>
</div>
