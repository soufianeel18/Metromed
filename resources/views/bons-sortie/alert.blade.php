@extends('layouts.app')

@section('content')
    <script>
        alert('{{ $message }}');
        window.location = '{{ $adresse }}';
    </script>
@endsection
