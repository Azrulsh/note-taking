@foreach ($remarks as $remark )
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $remark->description }}</td>
        <td><a href="#" class='btn btn-primary edit' data-id='{{ $remark->id }}' data-description='{{ $remark->description}}'> <i class="fa-solid fa-pen-to-square"></i> Edit</a>
            <a href="#" class='btn btn-danger delete' data-id='{{ $remark->id }}'> <i class="fa-solid fa-trash"></i> Delete</a>
        </td>
    </tr>
@endforeach