@extends('layouts.base')
@section('content')

<div class="container d-flex flex-column min-vh-100 ">
    <form class="" action="{{ route('text.store') }}" method="post">
        @csrf
        <div class="form-group">
        <label for="text">{{ __('Текст') }}</label>
       <input type="text"  class="form-control mb-3"  id="text" name="text" placeholder="{{ __('Введите текст') }}" maxlength="255" required>
       <!-- <textarea name="text" class="form-control mb-3" placeholder="{{ __('Введите текст') }}" maxlength="255" required rows="5" cols="33"></textarea>--->
        <button type="submit" class="btn btn-primary mb-5  btn-dark">
            {{ __('Сохранить') }}</button>
    </form>
    <h2 class="display-5">Сохраненные заметки</h2>

    @foreach ($userTexts as $text )
    <!--Сделать в базе элемент, который будет отмечать, что добавлена ссылка и под ней для перихода будет кнопка-->
    <!--Изменине ссылок может быть вынесено на первую страницу, чтобы была система SPA-->
      <div class="card mt-3">
          <div class="card-body">
              <a class=""  href="{{ route('text.show',$text->id) }}" title="
                  Дата сохранения текста: {{ $text->created_at }}
                  Дата обновления текста: {{ $text->updated_at }}">{{ $text->text }}
                                   </a>
              {{-- <form action="{{ $text->text }}">
                  <button>Перейти</button>
              </form> --}}

              <div class="button__delete mt-4 d-flex">
                  <form action="{{ route('text.delete',$text->id) }}" method="post">
                  @csrf
                  @method('delete')
                  <a href="#" class="delete-text btn btn-primary  btn-dark" data-file-id="{{$text->id }} " >Удалить текст</a>
                  {{-- <button class="btn btn-primary  btn-dark" type="submit">{{ __('Удалить') }}</button> --}}
                  </form>
              </div>
          </div>
        </div>

        <div id="deleteModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Подтвердите удаление текста</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Закрыть">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Вы уверены, что хотите удалить этот текст?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>

                        <form action="{{ route('text.delete',$text->id) }}" method="post" class="mb-4 ">
                            @csrf
                            @method('delete')
                            <button class="btn btn-primary  btn-danger" type="submit">{{ __('Удалить') }}</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
      @endforeach
    <div>{{ $userTexts->links() }}</div>
    <script>
        $(document).ready(function() {
            var textIdToDelete;

            $('.delete-text').on('click', function(e) {
                e.preventDefault();
                textIdToDelete = $(this).data('text-id');
                $('#deleteModal').modal('show');
            });

            $('#confirmDeleteText').on('click', function() {
                $('#deleteModal').modal('hide');
                deleteText(textIdToDelete);
            });

        });
    </script>

</div>

@endsection
