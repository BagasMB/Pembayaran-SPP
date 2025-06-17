<div>
    <div class="card card-responsive mb-3">
        <div class="card-header">
            <div class="d-flex align-items-center justify-content-between">
                <h5 class="mb-2">Data Siswa</h5>
            </div>
        </div>
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-start">
                <div class="table-responsive text-nowrap">
                    <table class="table table-borderless">
                        <tr>
                            <td>Nis </td>
                            <td>:</td>
                            <td>{{ $student->nis }} </td>
                        </tr>
                        <tr>
                            <td>Nama Siswa </td>
                            <td>:</td>
                            <td>{{ $student->name }} </td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin </td>
                            <td>:</td>
                            <td>{{ $student->gender }} </td>
                        </tr>
                        <tr>
                            <td>Kelas </td>
                            <td>:</td>
                            <td>{{ $kelas_now }} </td>
                        </tr>
                        <tr>
                            <td>Jurusan </td>
                            <td>:</td>
                            <td>{{ $student->class->majors->name }} </td>
                        </tr>
                    </table>
                </div>
            </div>
            <hr class="my-3 mb-4">
            <div class="row">
                <div class="col-xxl-6 mb-3">
                    <div class="table-responsive text-nowrap">
                        <table class="table table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <th>-</th>
                                    <th>Sudah DiBayar</th>
                                    <th>Tagihan Thn.{{ $tahun_ajaran }}</th>
                                    <th>Sisa</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>SPP</td>
                                    <td>
                                        {{ formatRupiah($sppsudahdibayar) }}
                                    </td>
                                    <td>
                                        {{ formatRupiah($spptagihan) }}
                                    </td>
                                    <td>{{ formatRupiah($sisa) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                @can('pembayaran')
                    <div class="col-xxl-6">
                        <div class="table-responsive text-nowrap">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Pembayaran</th>
                                        <th>Nominal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <form wire:submit.prevent="bayar">
                                        <tr>
                                            <td> Spp </td>
                                            <td>
                                                <div class="input-group input-group-merge">
                                                    <span class="input-group-text">
                                                        Rp.
                                                    </span>
                                                    <input type="number" class="form-control" wire:model="nominal">
                                                </div>
                                                @error('nominal')
                                                    <span class="text-sm text-danger font-semibold">{{ $message }}</span>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> Tanggal </td>
                                            <td>
                                                <input type="date" wire:model="tanggal_bayar" name="tanggal_bayar"
                                                    class="form-control">
                                                @error('tanggal_bayar')
                                                    <span class="text-sm text-danger font-semibold">{{ $message }}</span>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                @if ($sisa > 0)
                                                    <button type="submit" class="btn btn-danger">Bayar</button>
                                                @else
                                                    <button type="button" class="btn btn-success" disabled>Lunas</button>
                                                @endif
                                            </td>
                                        </tr>
                                    </form>
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endcan
            </div>
        </div>
    </div>
</div>
