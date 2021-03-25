@extends('layouts.app')

@section('content')
    <script>
        alert('{{ $message }}');
        window.location = '/equipement-stock/{{ $equipement_stock->id }}/piece/choose';
    </script>
@endsection
