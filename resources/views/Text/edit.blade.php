@extends('layouts.base')
@section('content')
@section('title', 'Изменить текст')
<div class="container">
  <h2>{{ __('Сохраненый текст') }}</h2>
    <form action="{{ route('text.update', $find_text->id) }}" method="post">

        @csrf
        @method('put')

        <div class="form-group">

             {{-- <input type="text"  class="form-control mb-3"  id="text" name="text" placeholder="{{ __('Введите текст') }}" maxlength="255" required> --}}
       <textarea name="text" class="form-control mb-3" placeholder="{{ __('Введите текст') }}" maxlength="555" required rows="3" cols="33">{{$find_text->text}}</textarea>
        </div>
            <button type="submit" class="btn btn-primary mb-3 "> {{ __('Обновить') }}</button>
    </form>

    <div class="card mt-3" style="">
        <div class="card-body ">
        <div class="card-text ">
            <p class="border-bottom border-dark">{{$find_text->text}} </p>

            <P>{{ __('Запись создана: ') }}{{  $find_text->created_at}}</P>

            <P>{{ __('Запись обновлена: ') }}{{ $find_text->updated_at }}</P>
        </div>
        </div>
        <div class="button__back">
            <a  class="btn btn-primary  ms-3 mb-3 " href="{{ route('text.index') }}">{{ __('Назад') }}</a>
        </div>
    </div>
</div>
@endsection
