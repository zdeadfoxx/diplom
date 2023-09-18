@extends('layouts.base')
@section('content')

<div class="container d-flex flex-column min-vh-100">
    <div class="show__message--pc mt-2" style="display: none;" id="show__message">
        <div class="message__box">
         <div class="box">
             <span id="copy__textshow" class="textshow" >Текст скопирован</span>
         </div>
        </div>
     </div>
    <h2>{{ __('Текст') }}</h2>
    <form class="" action="{{ route('text.store') }}" method="post">
        @csrf
        <div class="form-group">
            <textarea name="text" class="form-control mb-3"  placeholder="{{ __('Введите текст') }}" maxlength="555" required rows="3" cols="33"></textarea>
            <button type="submit" class="btn btn-primary mb-5">
                {{ __('Сохранить') }}
            </button>
        </div>
    </form>

    <h2 class="display-5">Сохраненные заметки</h2>
    @foreach ($userTexts as $text)
    <div class="card mt-3">
        <div class="card-body">
            <p class="saved__text" id="content-{{ $text->id }}">{{ $text->text }}</p>

            <div class="button__savedtext">
                <div class="button__change">
                    <a class="btn btn-primary" href="{{ route('text.show',$text->id) }}">Редактировать</a>
                </div>
                <div class="copy__text">
                    <a href="#" class="copy__button  btn btn-primary" data-content-id="{{ $text->id }}">Копировать</a>
                    {{-- <span id="copy__textshow" class="textshow" style="display: none;">Текст скопирован</span> --}}
                </div>
                <div class="button__delete">
                    <form action="{{ route('text.delete',$text->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <a  class="delete-text btn btn-primary" data-text-id="{{ $text->id }}">Удалить текст</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="deleteModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Подтвердите удаление текста</h5>
                    <button type="button" class="close" id="close" data-dismiss="modal" aria-label="Закрыть">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Вы уверены, что хотите удалить этот текст?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal " id="cancellationDelete"> Отмена</button>

                    <form action="{{ route('text.delete',$text->id) }}" method="post" class="mt-1 ">
                        @csrf
                        @method('delete')
                        <button class="btn btn-primary  btn-danger" type="submit">{{ __('Удалить') }}</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
    @endforeach

    <div class="paginate__links">{{ $userTexts->links() }}</div>
</div>

<script>
   // Обработчик клика на кнопке "Copy"
    document.querySelectorAll(".copy__button").forEach(function (button) {
            button.addEventListener("click", function () {
                var contentId = this.getAttribute("data-content-id");
                var text = document.getElementById("content-" + contentId).innerText;
                copyTextToClipboard(text);

                // Показываем скрытый элемент
                var copyTextShow = document.getElementById("show__message");
                copyTextShow.style.display = "block";

                // Прокрутка к верхней части страницы после копирования
                window.scrollTo({ top: 0, behavior: 'smooth' });


                // Скрываем элемент через некоторое время (например, через 2 секунды)
                setTimeout(function () {
                    copyTextShow.style.display = "none";
                }, 1500); // 2000 миллисекунд (2 секунды)
            });
    });

    async function copyTextToClipboard(text) {
        try {
            await navigator.clipboard.writeText(text);
            console.log('Text copied to clipboard');
        } catch (err) {
            console.error('Error in copying text: ', err);
        }
    }


    $(document).ready(function () {
        var textIdToDelete;

        $('.delete-text').on('click', function (e) {
            e.preventDefault();
            textIdToDelete = $(this).data('text-id');
            $('#deleteModal').modal('show');
        });

        $('#confirmDeleteText').on('click', function () {
            $('#deleteModal').modal('hide');
            deleteText(textIdToDelete);
        });

        $('#cancellationDelete').on('click', function () {
            $('#deleteModal').modal('hide');
        });

        $('#close').on('click', function () {
            $('#deleteModal').modal('hide');
        });
    });

</script>

@endsection
