<table class="table tab-des">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
        </tr>
    </thead>
    <tbody>
        @if (count($newsletters) != 0)
            @foreach ($newsletters as $row)
                <tr>
                    <td class="td-set new-lead">{{ $row->name }}</td>
                    <td class="td-set new-lead">{{ $row->email }}</td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="10" class="text-center py-5 error-box-table">
                    No record found
                </td>
            </tr>
        @endif
    </tbody>
</table>
<div id="paginationLinks">
    {{ $newsletters->links() }}
</div>
