@extends('Layout')

@section('content')
<div class="card mt-5">
    <h2 class="card-header">Remark for Note:</h2>
    <div class="card-body">
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <h2>
            <button type="button" id="add" data-bs-toggle="modal" data-bs-target="#addmodal" class="btn btn-success pull-right"> <i class="fa fa-plus"></i> Create Remark</button>
        </h2>
        <h2>
            <a class="btn btn-primary pull-right" href="{{ route('manage-note.IndexNote') }}"> <i class="fa fa-arrow-left"></i> Back</a>
        </h2>
    </div>
        <table class="table table-bordered table-striped mt-4">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Remark Description</th>
                    <th width="190px">Action</th>
                </tr>
            </thead>
            <tbody id="remarkbody">
            <!-- Displayed using AJAX request -->
            </tbody>      
        </table>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            showRemark();
            
            //Create Remark function
            $('#addremark').on('submit', function(e){
                e.preventDefault();
                var form = $(this).serialize();
                var url = $(this).attr('action');
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: form,
                    dataType: 'json',
                    success: function(){
                        $('#addmodal').modal('hide');
                        $('#addremark')[0].reset();
                        showRemark();
                    }
                });
            });

            //Display description on edit from
            $(document).on('click', '.edit', function(event){
                event.preventDefault();
                var id = $(this).data('id');
                var description = $(this).data('description');
                $('#editmodal').modal('show');
                $('#description').val(description);
                $('#remarkid').val(id); 
            });

            //Edit Remark function
            $('#editremark').on('submit', function(e){
                e.preventDefault();
                var form = $(this).serialize();
                var url = $(this).attr('action');
                $.post(url,form,function(data){
                    $('#editmodal').modal('hide');
                    showRemark();
                });
            });

            //Confirmaiton for deleting
            $(document).on('click', '.delete', function(event){
                event.preventDefault();
                var id = $(this).data('id');
                $('#deleteremark').data('id', id); // Set the remark ID for deletion
                $('#deletemodal').modal('show'); // Show delete confirmation modal
            });

            //Delete Remark function
            $('#deleteremark').click(function(){
                var id = $(this).data('id');
                $.post("{{ route('manage-remark.DeleteRemark') }}", {id: id}, function(){
                    $('#deletemodal').modal('hide');
                    showRemark(); // Refresh the list
                });
            });
             
        });

            //Display remark data on table using AJAX request
            function showRemark(){
            $.get("{{ route('manage-remark.ListRemark') }}", function(data){
                $('#remarkbody').empty().html(data);
            })
        }
    </script>
@endsection