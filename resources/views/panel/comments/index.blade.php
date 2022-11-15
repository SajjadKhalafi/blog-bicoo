<x-panel-layout>
    <x-slot name="title">
        - مدیریت نظرات
    </x-slot>
    <x-slot name="styles">
        <link rel="stylesheet" href="{{ asset('blog/css/style.css') }}">
    </x-slot>
    <div class="breadcrumb">
        <ul>
            <li><a href="{{ route('dashboard') }}">پیشخوان</a></li>
            <li><a href="{{ route('comments.index') }}" class="is-active"> نظرات</a></li>
        </ul>
    </div>
    <div class="main-content">
        <div class="tab__box">
            <div class="tab__items">
                <a class="tab__item is-active" href="{{ route('comments.index') }}"> همه نظرات</a>
                <a class="tab__item " href="{{ route('comments.index' , ['approved' => 0]) }}">نظرات تاییده نشده</a>
                <a class="tab__item " href="{{ route('comments.index' , ['approved' => 1]) }}">نظرات تاییده شده</a>
            </div>
        </div>


        <div class="table__box">
            <table class="table">
                <thead role="rowgroup">
                <tr role="row" class="title-row">
                    <th>شناسه</th>
                    <th>ارسال کننده</th>
                    <th>برای</th>
                    <th>دیدگاه</th>
                    <th>تاریخ</th>
                    <th>تعداد پاسخ ها</th>
                    <th>وضعیت</th>
                    <th>عملیات</th>
                </tr>
                </thead>
                <tbody>
                @foreach($comments as $comment)
                    <tr role="row">
                        <td>{{ $comment->id }}</td>
                        <td>{{ $comment->user->name }}</td>
                        <td>{{ $comment->post->title }}</td>
                        <td>{{ $comment->content }}</td>
                        <td>{{ $comment->getCreatedAtInJalali() }}</td>
                        <td>{{ $comment->replies_count }}</td>
                        <td class="{{ $comment->is_approved ? 'text-success' : 'text-error' }}">{{ $comment->getStatusInFarsi() }}</td>
                        <td>
                            <a href="{{ route('comments.destroy' , $comment->id) }}" class="item-delete mlg-15"
                               title="حذف" onclick="destroyComment(event , {{ $comment->id }})"></a>
                            @if($comment->is_approved)
                                <a href="{{ route('comments.update' , $comment->id) }}" class="item-reject mlg-15"
                                   title="رد" onclick="updateComment(event , {{ $comment->id }})"></a>
                            @else
                                <a href="{{ route('comments.update' , $comment->id) }}" class="item-confirm mlg-15"
                                   title="تایید" onclick="updateComment(event , {{ $comment->id }})"></a>
                            @endif
                            <form action="{{ route('comments.destroy' , $comment->id) }}" method="POST"
                                  id="destroy-comment-{{ $comment->id }}">
                                @csrf
                                @method('DELETE')
                            </form>
                            <form action="{{ route('comments.update' , $comment->id) }}" method="POST" id="update-comment-{{ $comment->id }}">
                                @csrf
                                @method('PUT')
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $comments->appends(request()->query())->links() }}
        </div>
    </div>
    <x-slot name="scripts">
        <script>
            function destroyComment(event, id) {
                event.preventDefault();
                Swal.fire({
                    title: 'آیا از حذف این نظر مطمئنید؟',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: 'rgb(221, 51, 51)',
                    cancelButtonColor: 'rgb(48, 133, 214)',
                    confirmButtonText: 'بله خذفش کن!',
                    cancelButtonText: 'خیر',
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('destroy-comment-' + id).submit();
                    }
                })
            }

            function updateComment(event , id){
                event.preventDefault();
                document.getElementById('update-comment-' + id).submit();
            }
        </script>
    </x-slot>
</x-panel-layout>
