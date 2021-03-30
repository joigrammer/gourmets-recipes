@if(!$ration->users->isEmpty())
<table class="table">
    <thead>
        <tr>
            <th scope="col">Nombre</th>
            <th scope="col">Ha reservado</th>
            <th scope="col">Email</th>
        </tr>
    </thead>
    <tbody>
        @foreach($ration->users as $user)
        <tr>
            <th scope="row">{{ $user->name }}</th>
            <td>({{ $user->pivot->rations }}) raciones.</td>
            <td>{{ $user->email }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<p>No hay registros.</p>
@endif