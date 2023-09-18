@extends('layouts.base')
@section('content')
@section('title', 'Файлы')
    <div class="container mt-1">
        <h2>{{ __('Файл') }}</h2>
        
        <a href="#" class="d-flex justify-content-center" onclick="location.reload(); return false;">
            Обновить страницу
        </a>
        
          <form action="{{route('file.create')}}" method="post" enctype="multipart/form-data" class="dropzone mb-4 dz-message " id="dropzone" required >
            @csrf
            
            <div>
                {{-- <img src="{{ asset('img/upload-16.png') }}" alt=""> --}}
            </div>
            <div class="dz-message" data-dz-message><span class="display-6"><span class="dropzone__choice">Выберите файл</span> для загрузки или перетащите его</span></div>

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </form>
        </div>
        <h2 class="display-5">Сохранненые файлы</h2>
        @foreach ($userFiles as $files)

                <div class="card mb-4">
                    <div class="card-body button__delete d-flex flex-column mb-4">
                        <a href="{{ route('file.download', $files->id) }}" class="blockquote files__link" title="
                            Имя файла: {{ $files->name}}
                            Размер файла: {{  $files->Size }} килобайт
                            Дата загрузки файла: {{ $files->created_at }}
                            Дата обновления файла: {{ $files->updated_at }}">{{$files->name }}
                        </a>
                        <form action="{{ route('file.delete',$files->id) }}" method="post" class="files ">
                            @csrf
                            @method('delete')
                            <a href="#" class="delete-file  btn btn-primary" data-file-id="{{$files->id }} " >{{ __('Удалить файл') }}</a>
                        </form>
                    </div>
                </div>


                <div id="deleteModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel">Подтвердите удаление файла</h5>
                                <button type="button" class="close" id="close" data-dismiss="modal" aria-label="Закрыть">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Вы уверены, что хотите удалить этот файл?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal " id="cancellationDelete">Отмена</button>

                                <form action="{{ route('file.delete',$files->id) }}" method="post" class="files ">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-primary  btn-danger" type="submit">{{ __('Удалить') }}</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>

        @endforeach

    <div class="paginate__links">{{ $userFiles->links()}}</div>

    <script type="text/javascript">
        Dropzone.options.dropzone =
                {
                    dictDefaultMessage: "Выберите файл для загрузки или перетащите его",
                    uploadMultiple: false,
                    parallelUploads: true,
                    maxFilesize: 6000000000,
                    maxFiles: 12,
                    acceptedFiles: "",
                    addRemoveLinks: true,

                };
    </script>
 <script>
              $(document).ready(function() {
        $('.delete-file').on('click', function(e) {
            e.preventDefault();
            var fileId = $(this).data('file-id');
            $('#deleteModal').modal('show');

            $('#confirmDelete').on('click', function() {
                $('#deleteModal').modal('hide');
                // Перенаправьте пользователя на маршрут удаления с передачей параметра fileId
                window.location.href = '/delete/files/' + fileId; // Измените маршрут по вашим нуждам
            });

            $('#cancellationDelete').on('click', function() {
                    $('#deleteModal').modal('hide');
                });

                $('#close').on('click', function() {
                    $('#deleteModal').modal('hide');
                });
        });
    });
        </script>

@endsection
