@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="http://cdn.datatables.net/1.10.18/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" rel="stylesheet" />
   <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <a href="javascript:void(0);" class="btn btn-sm btn-danger delete-all" style="display: none" data-url="{{ route('buku-delete-selected') }}">
                        <i class="fa fa-trash">
                            <span id="lengthcek">0</span>
                        </i> Delete Selected
                    </a>
                </div>

                <div class="card-body">
                    <table class="table table-bordered" id="buku">
                        <thead>
                            <tr>
                                <th>
                                    <div id="checkAll">
                                        <input type="checkbox" class="checkall" />
                                    </div>
                                </th>
                                <th>Nama Buku</th>
                                <th>Penuli</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src = "http://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js" defer></script>
<script src="{{ asset('js/checked.js') }}"></script>
<script type="text/javascript">
    $(function(){
        Otable =
        $('#buku').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('buku.index') }}",
            columns: [
                { data: 'id', name: 'id', orderable: false, searchable: false},
                { data: 'nama_buku', name: 'nama_buku' },
                { data: 'penulis', name: 'penulis' },
            ],
            order: [[0, 'desc']],
            drawCallback: function(setting){
                checkedContent();
                DeleteAll();
                uncheckedContent();
            }
        });
    });
</script>

@endsection
