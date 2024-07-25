@extends('layouts.app')
@section('title', 'Studenten lijst')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-12 text-center pt-5">
            <h1>Student manager testprojectje</h1>
            <p>Laravel test project</p>
            <br>
            <h1>Studenten lijst</h1>
            @forelse($students as $student)
                <tr>
                    <td>{{ $student->first_name }}</td>
                    <td>{{ $student->last_name }}</td>
                    <td>{{ $student->dob }}</td>
                    <td>{{ $student->email }}</td>
                    <td>{{ $student->phone }}</td>
                </tr>
            @empty
                <p>Geen studenten gevonden.</p>
            @endforelse
            </table>
        </div>
    </div>
</div>

@endsection