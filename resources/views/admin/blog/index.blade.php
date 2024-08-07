@extends('admin')

@section('styles')
    <style>
        .justify-content-around{
            justify-content: space-around;
        }
    </style>
@endsection

@section('content')
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Blog News
        </h2>
        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
            <a href="{{ route('admin.blog.create') }}" class="btn btn-primary shadow-md mr-2">Add New Post</a>
        </div>
    </div>

    <div class="intro-y grid grid-cols-12 gap-6 mt-5">
        <!-- BEGIN: Blog Layout -->

        @foreach($news as $item)
            <div id="{{$item->id}}" data-field="{{$item->id}}" class="intro-y col-span-12 md:col-span-6 box">
                <div
                    class="h-[320px] before:block before:absolute before:w-full before:h-full before:top-0 before:left-0 before:z-10 before:bg-gradient-to-t before:from-black/90 before:to-black/10 image-fit">
                    <img class="rounded-t-md" src="{{ asset('storage/' . $item->image) }}">
                    <div class="absolute w-full flex items-center px-5 pt-6 z-10">
                        <div class="w-10 h-10 flex-none image-fit">
                            {{--<img alt="Midone - HTML Admin Template" class="rounded-full" src="dist/images/profile-15.jpg">--}}
                        </div>
                        <div class="ml-3 text-white mr-auto">
                            <a href="" class="font-medium">{{ $item->author->name }}</a>
                            <div class="text-xs mt-0.5">{{ $item->created_at->diffForHumans() }}</div>
                        </div>
                    </div>
                    <div class="absolute bottom-0 text-white px-5 pb-6 z-10"><a href="{{route('admin.blog.index', ['category' => $item->category->id])}}"
                            class="bg-white/20 px-2 py-1 rounded">{{ $item->category->title }}</a>
                        <a href="{{ route('admin.blog.show', $item->id) }}" class="block font-medium text-xl mt-3">{{ $item->title }}</a></div>
                </div>
                <div class="p-5 text-slate-600 dark:text-slate-500">
                    {{ $item->description }}
                </div>
                <div class="mb-auto flex items-center justify-content-around px-5 py-3 border-t border-slate-200/60 dark:border-darkmode-400">
                    <div class=""> Likes: <span class="font-medium">{{ $item->likes->count() }}</span> </div>
                    <a href="{{route('admin.blog.edit', $item->id)}}" class="flex">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                             viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                             stroke-linecap="round" stroke-linejoin="round" icon-name="edit-2"
                             data-lucide="edit-2" class="lucide lucide-edit-2 w-4 h-4 mr-2">
                            <path d="M17 3a2.828 2.828 0 114 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                        </svg>
                        Edit Post </a>
                    <a href="javascript:;" data-tw-toggle="modal"
                       data-tw-target="#delete-confirmation-modal" class="deletion flex">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                             viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                             stroke-linecap="round" stroke-linejoin="round" icon-name="trash"
                             data-lucide="trash" class="lucide lucide-trash w-4 h-4 mr-2">
                            <polyline points="3 6 5 6 21 6"></polyline>
                            <path
                                d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2"></path>
                        </svg>
                        Delete Post </a>
                </div>
            </div>
        @endforeach
        <!-- END: Blog Layout -->

        <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center grid grid-cols-12">
            <div class="" style="grid-column: span 8 / span 8;">
                {{ $news->links('vendor.pagination.bootstrap-5') }}
            </div>
            <div class="pagination-count col-span-4 flex justify-end">
                <form action="{{ route('admin.blog.index') }}" method="get">
                    @csrf
                    <label for="perPage">Items per page:</label>
                    <select name="perPage" id="perPage" onchange="this.form.submit()">
                        <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10</option>
                        <option value="25" {{ $perPage == 25 ? 'selected' : '' }}>25</option>
                        <option value="100" {{ $perPage == 100 ? 'selected' : '' }}>100</option>
                        <!-- Add more options as needed -->
                    </select>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete modal -->
    <div id="delete-confirmation-modal" class="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="p-5 text-center">
                        <i data-lucide="x-circle" class="w-16 h-16 text-danger mx-auto mt-3"></i>
                        <div class="text-3xl mt-5">Are you sure?</div>
                        <div class="text-slate-500 mt-2">
                            Do you really want to delete these records?
                            <br>
                            This process cannot be undone.
                        </div>
                    </div>
                    <div class="px-5 pb-8 text-center">
                        <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-24 mr-1">Cancel</button>
                        <button id="delete" data-tw-dismiss="modal" type="button" class="btn btn-danger w-24">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">

        let id;
        $("body").bind("ajaxSend", function(elm, xhr, s){
            if (s.type == "POST") {
                xhr.setRequestHeader('X-CSRF-Token', getCSRFTokenValue());
            }
        });
        $(document).ready(function () {
            $(document).on('click', '.deletion', function () {
                id = $(this).parents('.intro-y').data('field');
            });
            $(document).on('click', '#delete', function () {
                $('#'+id).addClass('hidden');
                ajax('', '', id, 'Delete');
            });

            function ajax(field, newValue, categoryId, method) {
                $.ajax({
                    url: 'blog/' + categoryId,
                    type: method,
                    dataType: "json",
                    encode: true,
                    processData: field !== 'image',
                    contentType: field === 'image' ? false : 'application/x-www-form-urlencoded; charset=UTF-8',
                    data: {
                        field,
                        value: newValue,
                        categoryId,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function (response) {
                        $("#message").fadeIn(500).fadeOut(2000);
                        console.log(response);
                    },
                    error: function (error) {
                        console.error('Update failed:', error);
                    }
                });
            }
        });
    </script>

@endsection
