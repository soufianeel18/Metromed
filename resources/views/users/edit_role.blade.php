@extends('layouts.app')

@section('content')
<div class="container">
    <form action="/user/{{ $user->id }}/role" method="post">
        @csrf
        @method('PATCH')
        <div class="row">
            <div class="col-8 offset-2">
                <div class="row pb-5 d-flex justify-content-center">
                    <h1>Modifier le rôle</h1>
                </div>
                <table class="table">
                    @if(Auth::User()->role == 'admin')
                        <tr>
                            <td>
                                <label for="admin">Administrateur</label>
                            </td>
                            <td>
                                <input id="admin" type="radio" class="@error('admin') is-invalid @enderror" name="role" value="admin" autocomplete="admin" @if($user->role == 'admin') checked @endif>
                            </td>
                        </tr>
                        <tr>
                            @error('admin')
                            <td class="invalid-feedback" role="alert" colspan="2">
                                <strong>{{ $message }}</strong>
                            </td>
                            @enderror
                        </tr>
                    @endif
                    @if(Auth::User()->role == 'chef technicien')
                        <tr>
                            <td>
                                <label for="chef technicien">Chef des techniciens</label>
                            </td>
                            <td>
                                <input id="chef technicien" type="radio" class="@error('chef technicien') is-invalid @enderror" name="role" value="chef technicien" autocomplete="chef technicien" @if($user->role == 'chef technicien') checked @endif>
                            </td>
                        </tr>
                        <tr>
                            @error('chef technicien')
                            <td class="invalid-feedback" role="alert" colspan="2">
                                <strong>{{ $message }}</strong>
                            </td>
                            @enderror
                        </tr>
                        <tr>
                            <td>
                                <label for="technicien">Technicien</label>
                            </td>
                            <td>
                                <input id="technicien" type="radio" class="@error('technicien') is-invalid @enderror" name="role" value="technicien" autocomplete="technicien" @if($user->role == 'technicien') checked @endif>
                            </td>
                        </tr>
                        <tr>
                            @error('technicien')
                            <td class="invalid-feedback" role="alert" colspan="2">
                                <strong>{{ $message }}</strong>
                            </td>
                            @enderror
                        </tr>
                    @endif
                    @if(Auth::User()->role == 'chef commercial')
                        <tr>
                            <td>
                                <label for="chef commercial">Chef des commerciaux</label>
                            </td>
                            <td>
                                <input id="chef commercial" type="radio" class="@error('chef commercial') is-invalid @enderror" name="role" value="chef commercial" autocomplete="chef commercial" @if($user->role == 'chef commercial') checked @endif>
                            </td>
                        </tr>
                        <tr>
                            @error('chef commercial')
                            <td class="invalid-feedback" role="alert" colspan="2">
                                <strong>{{ $message }}</strong>
                            </td>
                            @enderror
                        </tr>
                        <tr>
                            <td>
                                <label for="commercial">Commercial</label>
                            </td>
                            <td>
                                <input id="commercial" type="radio" class="@error('commercial') is-invalid @enderror" name="role" value="commercial" autocomplete="commercial" @if($user->role == 'commercial') checked @endif>
                            </td>
                        </tr>
                        <tr>
                            @error('commercial')
                            <td class="invalid-feedback" role="alert" colspan="2">
                                <strong>{{ $message }}</strong>
                            </td>
                            @enderror
                        </tr>
                    @endif
                    @if(Auth::User()->role == 'chef stock')
                        <tr>
                            <td>
                                <label for="chef stock">Chef du stock</label>
                            </td>
                            <td>
                                <input id="chef stock" type="radio" class="@error('chef stock') is-invalid @enderror" name="role" value="chef stock" autocomplete="chef stock" @if($user->role == 'chef stock') checked @endif>
                            </td>
                        </tr>
                        <tr>
                            @error('chef stock')
                            <td class="invalid-feedback" role="alert" colspan="2">
                                <strong>{{ $message }}</strong>
                            </td>
                            @enderror
                        </tr>
                        <tr>
                            <td>
                                <label for="agent stock">Agent du stock</label>
                            </td>
                            <td>
                                <input id="agent stock" type="radio" class="@error('agent stock') is-invalid @enderror" name="role" value="agent stock" autocomplete="agent stock" @if($user->role == 'agent stock') checked @endif>
                            </td>
                        </tr>
                        <tr>
                            @error('agent stock')
                            <td class="invalid-feedback" role="alert" colspan="2">
                                <strong>{{ $message }}</strong>
                            </td>
                            @enderror
                        </tr>
                    @endif
                </table>
                <div class="row pt-1 d-flex justify-content-center">
                    <button class="btn btn-primary">Valider</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
