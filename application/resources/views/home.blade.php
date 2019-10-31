@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="float-left">
                        Semua Barang
                    </h1>
                    <br>
                </div>
                <div class="col-md-12">
                    @if (count($barang) != 0)
                    <table class="table w-100 table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Barang</th>
                                    <th>Nama Supplier</th>
                                    <th>Kategori</th>
                                    <th>Jumlah Barang</th>
                                    <th>Harga Barang</th>
                                    <th>Pilihan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($barang as $barangs)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $barangs->nama_barang }}</td>
                                    <td>{{ $barangs->supplier['nama_supplier'] }}</td>
                                    <td>{{ $barangs->categorie['nama_kategori'] }}</td>
                                    <td>{{ $barangs->jumlah_barang }}</td>
                                    <td data-harga="{{$loop->iteration}}">{{ $barangs->harga_barang }}</td>
                                    <td>
                                        <a href="{{ route('barang.edit', $barangs->id) }}" title="edit" class="btn btn-outline-primary">
                                            Edit
                                        </a>
                                        <a href="{{ route('barang.delete', $barangs->id) }}" title="hapus" class="btn btn-outline-danger">
                                            Hapus
                                        </a>
                                        <a href="#" id_barang="{{$barangs->id}}" nama="{{$barangs->nama_barang}}" jumlah="{{$barangs->jumlah_barang}}" harga="{{$barangs->harga_barang}}" data-toggle="modal" data-target="#exampleModal" title="beli" class="btn btn-outline-success beli">
                                            Beli
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <a href="{{ route('barang.create') }}" style="margin-top:10px" class="float-right btn btn-outline-success">
                            + Tambah
                        </a>
                    @else
                    <hr>
                    <div class="container">
                        <div class="row">
                            <div class="col text-center">
                                <h1>Data Tidak Ada</h1>
                                <a href="{{ route('barang.create') }}" style="margin-top:10px" class="btn btn-lg btn-outline-success">
                                    + Tambah
                                </a>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="col-md-12 hidden" id="div-cart">
                    <form action="{{ route('trans.store') }}" id="cart_form" method="post">
                        @csrf
                    <h1>
                        Cart Transaksi
                    </h1>
                    <table class="table w-100 table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Barang</th>
                                <th>Jumlah Beli</th>
                                <th>Harga Satuan</th>
                                <th>Total Harga</th>
                                <th>Pilihan</th>
                            </tr>
                        </thead>
                        <tbody id="tbody-cart">

                        </tbody>
                    </table>
                    <div class="container-fluid">
                        <input type="number" id="total_data" name="total" hidden>
                        <input type="submit" style="margin-top:10px" class="float-right btn btn-outline-success btn-simpan" value="Simpan">
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- MODAL --}}
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-body">
              <form action="#" method="POST" class="form-modal">
                <h3 id="nama"></h3>
                <input name="barang_id" id="barang_id" type="number" class="form-control" hidden>
                <div class="form-group">
                        <label for="jumlah_beli">
                            Jumlah Beli
                        </label>
                        <input name="jumlah_beli" id="jumlah" type="number" class="form-control" placeholder="Jumlah Beli" required>
                  </div>
                  <div class="form-group">
                        <label for="harga_satuan">
                            Harga per Satuan :
                        </label>
                        <input name="harga_satuan" class="form-control" type="text" id="harga" readonly>
                  </div>
                  <div class="form-group">
                        <label for="total_harga">
                            Total Harga :
                        </label>
                        <input name="total_harga" class="form-control" type="text" id="total" readonly>
                  </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Close</button>
              <button type="button" id="addCart" stok="" data-dismiss="modal5" class="btn btn-success">+ Add to Cart</button>
            </div>
          </div>
        </div>
    </div>

{{-- JS LOGIC --}}
@push('js')
    
    <script type="text/javascript">

        var iteration = 1;

        $('.beli').on('click', function(){
            var id = $(this).attr('id_barang');
            var nama = $(this).attr('nama');
            var harga = $(this).attr('harga');
            var jumlah = $(this).attr('jumlah');
            $('#barang_id').val(id);
            $('#nama').text(nama);
            $('#harga').val(harga);
            $('#addCart').attr('stok', jumlah);

        });

        $('#jumlah').on('keyup', function(){
            var harga = $('#harga').val();
            var jumlah = $(this).val();
            var total = harga * jumlah;
            $('#total').val(total);

        });

        // CART JS

        $('#addCart').on('click', function(){
            var stok = $(this).attr('stok');
            var nama = $('#nama').text();
            var id = $('#barang_id').val();
            var total = $('#total').val();
            var harga = $('#harga').val();
            var jumlah = $('#jumlah').val();

            if(jumlah > parseInt(stok)){

                Swal.fire({
                    type: 'error',
                    title: 'Maaf...',
                    text: 'Jumlah Beli Lebih besar Dari Stok Barang'
                });
                return;
            }

            $('#div-cart').removeClass('hidden');

            $('#tbody-cart').append(
                '<tr>' +
                '<td>' +
                iteration +
                '<input name="id_cart[]" data-id-input="' + iteration + '" value="' + id + '" type="number" hidden>' +
                '</td>' +
                '<td>' +
                '<span data-nama-span="' + iteration + '">'+ nama + '</span>' +
                '<input name="nama_cart[]" data-nama-input="' + iteration + '" value="' + nama + '" type="text" hidden>' +
                '</td>' +
                '<td>' +
                '<span data-jumlah-span="' + iteration + '">'+ jumlah + '</span>' +
                '<input name="jumlah_cart[]" data-jumlah-input="' + iteration + '" value="' + jumlah + '" type="number" hidden>' +
                '</td>' +
                '<td>' +
                '<span data-harga-span="' + iteration + '">'+ harga + '</span>' +
                '<input name="harga_cart[]" data-harga-input="' + iteration + '" value="' + harga + '" type="number" hidden>' +
                '</td>' +
                '<td>' +
                '<span data-total-span="' + iteration + '">'+ total + '</span>' +
                '<input name="total_cart[]" data-total-input="' + iteration + '" value="' + total + '" type="number" hidden>' +
                '</td>' +
                '<td>' +
                '<a href="#" data-edit="' + iteration + '" title="editCart" class="btn btn-cart-edit btn-outline-primary">Edit</a>' +
                '<a href="#" data-save="' + iteration + '" title="saveCart" class="btn btn-cart-save btn-outline-success hidden">Save</a>' +
                '<a href="#" title="hapusCart" class="btn btn-cart-delete btn-outline-danger">Hapus</a>' +
                '</td>' +
                '</tr>'
            );
            iteration++;

            $(document).on('click', '.btn-cart-edit', function(){

                var data = $(this).attr('data-edit');
                $('[data-jumlah-input="' + data + '"]').removeAttr('hidden');

                $('[data-save="' + data + '"]').removeClass('hidden');
                $('[data-edit="' + data + '"]').addClass('hidden');

                $('[data-jumlah-span="' + data + '"]').addClass('hidden');
                // console.log('test');
            });

            $(document).on('click', '.btn-cart-delete', function(){
                $(this).parent().parent().remove();
            });

            $(document).on('click', '.btn-cart-save', function(){
                var data = $(this).attr('data-save');

                var newData = $('[data-jumlah-input="' + data + '"]').val();
                var harga = $('[data-harga-input="' + data + '"]').val();
                var total = harga * newData;

                $('[data-jumlah-input="' + data + '"]').attr('hidden', '');

                $('[data-edit="' + data + '"]').removeClass('hidden');
                $('[data-save="' + data + '"]').addClass('hidden');

                $('[data-jumlah-span="' + data + '"]').text(newData);
                $('[data-total-span="' + data + '"]').text(total);

                $('[data-jumlah-span="' + data + '"]').removeClass('hidden');
                
            });

        });

        $('.btn-simpan').on('click', function(e){
            var total = 0, jumlahcheck;
            var arrcheckid = [];
            var elspan;
            e.preventDefault();
            for (let index = 1; index < iteration; index++) {
                elspan = $('[data-nama-span=' + index + ']').text();
                if(arrcheckid.includes(elspan)){
                    jumlahcheck = parseInt($('[data-jumlah-span="' + (arrcheckid.indexOf(elspan)+1) + '"]').text()) + parseInt($('[data-jumlah-span="' + index + '"]').text());
                    if(jumlahcheck < $('[nama=' + elspan + ']').attr(jumlah)){
                        Swal.fire({
                            type: 'error',
                            title: 'Maaf...',
                            text: 'Jumlah Beli Lebih besar Dari Stok Barang'
                        });
                        return;
                    }
                } else {
                    arrcheckid.push($('[data-nama-span=' + index + ']').text())
                    // console.log(typeof(parseInt($('[data-jumlah-span="' + (arrcheckid.indexOf(elspan)+1) + '"]').text())));
                }
            //     data.push(
            //         {
            //             id: $('[data-id-input=' + index + ']').val(),
            //             nama: $('[data-nama-input=' + index + ']').val(),
            //             jumlah: $('[data-harga-input=' + index + ']').val(),
            //             total: $('[data-total-input=' + index + ']').val()
            //         }
            //     );
                total += parseInt(($('[data-total-span=' + index + ']').text() ? $('[data-total-span=' + index + ']').text() : '0'));
                
            }
            Swal.fire({
                title: 'Anda Yakin?',
                text: "Total Belanjaan : " + total + "!",
                type: 'warning',
                showCancelButton: true,
                // confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Aku Beli!'
                }).then((result) => {
                if (result.value) {
                    $('#total_data').val(total);
                    $('#cart_form').submit();
                    
                } else if (result.dismiss === Swal.DismissReason.cancel){
                    Swal.fire(
                    'Transaksi Digagalkan!',
                    'Anda Tidak Jadi Membeli \u2639',
                    'success'
                    );
                }
            });
        });
    </script>

@endpush
@endsection
