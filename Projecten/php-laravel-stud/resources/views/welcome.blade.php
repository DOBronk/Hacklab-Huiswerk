@extends('layouts.app')
@section('title', 'Hoofdpagina')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 text-center pt-5">
            <h1 class="display-one mt-5">Student manager testprojectje</h1>
            <p>Laravel test project</p>
            <br>
            <a href="students" class="btn btn-outline-primary">Toon studenten</a>
        </div>
    </div>
</div>
@endsection