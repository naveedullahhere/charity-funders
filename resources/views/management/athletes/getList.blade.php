<table class="table">
    <thead>
        <tr>
            <!-- <th class="col-lg-3">S no.</th> -->
            <th class="col-lg-3">Name</th>
            <th class="col-lg-2">Name</th>
            <th class="col-lg-5">Action</th>
            <th class="col-lg-3">Action</th>
        </tr>
    </thead>
    <tbody>
        @if(count($AthleteProfiles) != 0)
        @foreach ($AthleteProfiles as $key => $AthleteProfile)

        <tr>
            <td>
                <a href="javascript:;" onclick="openModal('{{ route('athletes.edit',$AthleteProfile->id) }}','View Athletes',true)">
                    {{ $AthleteProfile->name }} <br>
                    {{ $AthleteProfile->email }} <br>
                </a>
            </td>
            <td>
                @if($AthleteProfile->user)
                <label for="" class="badge btn-success">
                    Registered
                </label>
                @else
                <label for="" class="badge btn-danger">
                    Not Registered
                </label>
                @endif
            </td>
            <td>
                <input type="text" readonly class="form-control" value="{{url('athlete-profile',$AthleteProfile->unique_string)}}">
            </td>
            <td>
                @can('role-edit')
                <button class="btn btn-primary" onclick="openModal('{{ route('athletes.edit',$AthleteProfile->id) }}','Edit Athletes')"><span class="material-symbols-outlined">edit</span></button>

                @endcan

                @can('role-delete')

                <button class="btn btn-danger " {{$AthleteProfile->user != null ? 'disabled' : ''}} onclick="deletemodal('{{ route('athletes.destroy',$AthleteProfile->id) }}')"><span class="material-symbols-outlined">delete</span></button>

                @endcan
                <form class="send-email-form d-inline" action="{{route('send-email',$AthleteProfile->id)}}" method="get">
                    <button class="btn btn-warning my-2">
                        Send Email
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
        @else
        <tr>
            <td colspan="3" class="text-center py-5 error-box-table">
                No record found
            </td>
        </tr>
        @endif
    </tbody>
</table>
<div id="paginationLinks">
    {{ $AthleteProfiles->links() }}
</div>