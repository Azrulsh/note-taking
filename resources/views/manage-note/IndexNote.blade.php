@extends('Layout')
@section('title', 'Index Page')
@section('content')
<div class="card mt-5">
  <h2 class="card-header">Simple Note-Taking Web Application</h2>
    <div class="card-body">
        @session('success')
            <div id="flash-message" class="alert alert-success" role="alert"> {{ $value }} </div>
        @endsession
        
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a class="btn btn-success btn-sm" id="create "href="{{ route('manage-note.CreateNote') }}"> <i class="fa fa-plus"></i> Create New Note</a>
        </div>
        <table class="table table-bordered table-striped mt-4">
            <thead>
                <tr>
                    <th width="50px">No</th>
                    <th>Creator</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th width="320px">Action</th>
                </tr>
            </thead>
  
            <tbody>
            @forelse ($notes as $note)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $note->user->name }}</td>
                    <td>{{ $note->name }}</td>
                    <td>{{ $note->description }}</td>
                    <td>
                        <form action="{{ route('manage-note.DeleteNote', $note->id) }}" method="POST">
                            <!-- If the user is NOT the creator, center the Remark and Show buttons -->
                            @if ($note->user_id !== auth()->id())
                                <div class="d-flex justify-content-center">
                                    <a class="btn btn-secondary btn-sm mx-1" href="{{ route('manage-remark.IndexRemark') }}" ><i class="fa-solid fa-comment"></i> Remark</a>
                                    <a class="btn btn-info btn-sm mx-1" href="{{ route('manage-note.ListAllNote', $note->id) }}" ><i class="fa-solid fa-list"></i> Show</a>
                                </div>
                            @else
                                <!-- for creators: buttons stay as is -->
                                <a class="btn btn-secondary btn-sm" href="{{ route('manage-remark.IndexRemark') }}" ><i class="fa-solid fa-comment"></i> Remark</a>
                                <a class="btn btn-info btn-sm" href="{{ route('manage-note.ListAllNote', $note->id) }}" ><i class="fa-solid fa-list"></i> Show</a>
                            @endif

                            <!-- Show Edit and Delete buttons only for the creator of the notes -->
                            @if ($note->user_id === auth()->id())
                                <a class="btn btn-primary btn-sm" href="{{ route('manage-note.EditNote', $note->id) }}"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" id="delete" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i> Delete</button>
                            @endif
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">There are no saved note from you.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
        {!! $notes->links() !!}
    </div>
</div>  
@endsection