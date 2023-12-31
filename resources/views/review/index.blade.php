@extends('admin')
@section('content')
    <h2 class="intro-y text-lg font-medium mt-10">
        Reviews
    </h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
            <button data-tw-toggle="modal" data-tw-target="#create-modal" class="btn btn-primary shadow-md mr-2">Add New Category</button>
            <div class="dropdown">
                <button class="dropdown-toggle btn px-2 box" aria-expanded="false" data-tw-toggle="dropdown">
                    <span class="w-5 h-5 flex items-center justify-center"> <i class="w-4 h-4" data-lucide="plus"></i> </span>
                </button>
                <div class="dropdown-menu w-40">
                    <ul class="dropdown-content">
                        <li>
                            <a href="" class="dropdown-item"> <i data-lucide="printer" class="w-4 h-4 mr-2"></i> Print </a>
                        </li>
                        <li>
                            <a href="" class="dropdown-item"> <i data-lucide="file-text" class="w-4 h-4 mr-2"></i> Export to Excel </a>
                        </li>
                        <li>
                            <a href="" class="dropdown-item"> <i data-lucide="file-text" class="w-4 h-4 mr-2"></i> Export to PDF </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="hidden md:block mx-auto text-slate-500">Showing 1 to {{count($reviews)}}</div>
            <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                <div class="w-56 relative text-slate-500">
                    <input type="text" class="form-control w-56 box pr-10" placeholder="Search...">
                    <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-lucide="search"></i>
                </div>
            </div>
        </div>
        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            <table class="table table-report -mt-2">
                <thead>
                <tr>
                    <th class="whitespace-nowrap">Image</th>
                    <th class="whitespace-nowrap">Category name</th>
                    <th class="whitespace-nowrap">Parent Category</th>
                    <th class="whitespace-nowrap">Order</th>
                    <th class="text-center whitespace-nowrap">Desciption</th>
                    <th class="text-center whitespace-nowrap">Status</th>
                    <th class="text-center whitespace-nowrap">ACTIONS</th>
                </tr>
                </thead>
                <tbody>
                @foreach($reviews as $review)
                    <tr id="{{$review->id}}" class="intro-x" data-action="{{$review->id}}">
                        <td class="">
                            <div class="flex items-center">
                                @for ($i = 0; $i < 5; $i++)
                                    <button class="rate" value="{{$i+1}}" data-field="rate">
                                        @if ($i < $review->rate)
                                            <svg color="yellow" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-star"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                                        @else
                                            {{-- Light Slate Star for Unrated --}}
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-star text-slate-500"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                                        @endif
                                    </button>
                                @endfor
                            </div>
                        </td>
                        <td class="editable" data-field="title" data-action="read" data-selectable="text">
                            <a href="#" class="font-medium whitespace-nowrap">{{ $review->text }}</a>
                        </td>
                        <td class="edition text-center" data-field="order_id" data-action="read" data-selectable="number">
                            <div class="w-full mt-3 xl:mt-0 flex-1">
                                <select class="form-select edition" data-field="user_id">
{{--                                    @foreach($users as $user)--}}
{{--                                            <option value="{{$user->id}}" {{($user->id == $review->user_id) ? 'selected' : ''}}>{{$user->name}}</option>--}}
{{--                                    @endforeach--}}
{{--                                    <option value="" {{ is_null($review->user_id) ? 'selected' : '' }}>Not Selected</option>--}}
                                    <option value="1" selected >Not Selected</option>
                                </select>
                            </div>
                        </td>
                        <td class="edition text-center" data-field="order_id" data-action="read" data-selectable="number">
                            <div class="w-full mt-3 xl:mt-0 flex-1">
                                <select class="form-select edition" data-field="product_id">
{{--                                    @foreach($products as $product)--}}
{{--                                        <option value="{{$product->id}}" {{($product->id == $review->product_id) ? 'selected' : ''}}>{{$product->name}}</option>--}}
{{--                                    @endforeach--}}
{{--                                    <option value="" {{ is_null($review->product_id) ? 'selected' : '' }}>Not Selected</option>--}}
                                    <option value="1" selected >Not Selected</option>
                                </select>
                            </div>
                        </td>
                        <td class="edition">
                            <div class="form-check form-switch w-full h-full flex justify-center">
                                <select class="form-select edition" data-field="status">
                                    <option value="approved"  >Approved</option>
                                    <option value="disabled"  >Disabled</option>
                                    <option value="new" selected >New</option>
                                </select>
                            </div>
                        </td>
                        <td class="table-report__action w-56">
                            <div class="flex justify-center items-center">
                                <a class="flex items-center mr-3" href="javascript:;"> <i data-lucide="check-square" class="w-4 h-4 mr-1"></i> Edit </a>
                                <a class="flex items-center text-danger deletion" href="javascript:;" data-tw-toggle="modal" data-tw-target="#delete-confirmation-modal"> <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i> Delete </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- END: Data List -->
        <!-- BEGIN: Pagination -->
        {{--            <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">--}}
        {{--                <nav class="w-full sm:w-auto sm:mr-auto">--}}
        {{--                    <ul class="pagination">--}}
        {{--                        <li class="page-item">--}}
        {{--                            <a class="page-link" href="#"> <i class="w-4 h-4" data-lucide="chevrons-left"></i> </a>--}}
        {{--                        </li>--}}
        {{--                        <li class="page-item">--}}
        {{--                            <a class="page-link" href="#"> <i class="w-4 h-4" data-lucide="chevron-left"></i> </a>--}}
        {{--                        </li>--}}
        {{--                        <li class="page-item"> <a class="page-link" href="#">...</a> </li>--}}
        {{--                        <li class="page-item"> <a class="page-link" href="#">1</a> </li>--}}
        {{--                        <li class="page-item active"> <a class="page-link" href="#">2</a> </li>--}}
        {{--                        <li class="page-item"> <a class="page-link" href="#">3</a> </li>--}}
        {{--                        <li class="page-item"> <a class="page-link" href="#">...</a> </li>--}}
        {{--                        <li class="page-item">--}}
        {{--                            <a class="page-link" href="#"> <i class="w-4 h-4" data-lucide="chevron-right"></i> </a>--}}
        {{--                        </li>--}}
        {{--                        <li class="page-item">--}}
        {{--                            <a class="page-link" href="#"> <i class="w-4 h-4" data-lucide="chevrons-right"></i> </a>--}}
        {{--                        </li>--}}
        {{--                    </ul>--}}
        {{--                </nav>--}}
        {{--                <select class="w-20 form-select box mt-3 sm:mt-0">--}}
        {{--                    <option>10</option>--}}
        {{--                    <option>25</option>--}}
        {{--                    <option>35</option>--}}
        {{--                    <option>50</option>--}}
        {{--                </select>--}}
        {{--            </div>--}}
        <!-- END: Pagination -->
    </div>
    <div id="message" class="m-0 fixed alert border-success bg-white show px-3 py-2 rounded absolute flex items-center text-success font-bold" style=" left:50%; transform: translateX(-50%); z-index: 9999; top: 100px; display: none" role="alert"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clipboard-check"><rect width="8" height="4" x="8" y="2" rx="1" ry="1"/><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/><path d="m9 14 2 2 4-4"/></svg>  Updated</div>
    <!-- BEGIN: Delete Confirmation Modal -->
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
{{--    @include('categories.create-modal')--}}
    <!-- END: Delete Confirmation Modal -->
@endsection

@section('script')
    <script type="text/javascript">
        $("#modal-form-3").each(function () {
            const el = this;
            ClassicEditor.create(el).catch((error) => {
                console.error(error);
            });
        });
        let id;
        $("body").bind("ajaxSend", function(elm, xhr, s){
            if (s.type == "POST") {
                xhr.setRequestHeader('X-CSRF-Token', getCSRFTokenValue());
            }
        });
        $(document).ready(function () {
            $('.editable').on('dblclick', function () {
                if ($(this).data('action') === 'read') {
                    var $input = $('<input type="' + $(this).data('selectable') + '" class="form-control" value="' + $.trim($(this).text()) + '" />');
                    $(this).html($input).data('action', 'write');
                    $input.focus();
                }
            });
            $(document).on('blur', '.editable input', function () {
                var $editable = $(this).parent('.editable');
                $editable.data('action', 'read');
                var newValue = '<div class="font-medium whitespace-nowrap">' + $(this).val() + '</div>';
                ajax($editable.data('field'), $(this).val(), $editable.parents('.intro-x').data('action'), 'PUT');
                $editable.html(newValue);
            });
            $('.rate').on('click', function () {
                var value = $(this).val();
                ajax($(this).data('field'), value, $(this).parents('.intro-x').data('action'), 'PUT');
            });
            $('.edition, .activation').on('change', function () {
                var value = $(this).hasClass('activation') ? this.checked ? 1 : 0 : $(this).val();
                ajax($(this).data('field'), value, $(this).parents('.intro-x').data('action'), 'PUT');
            });
            $(document).on('click', '.deletion', function () {
                id = $(this).parents('.intro-x').data('action');
            });
            $(document).on('click', '#delete', function () {
                $('#'+id).addClass('hidden');
                ajax('', '', id, 'Delete');
            });
            function ajax(field, newValue, reviewID, method) {
                $.ajax({
                    url: "reviews/" + reviewID, // Replace with your route for updating the category
                    method: method,
                    dataType: "json",
                    encode: true,
                    data: {
                        field: field,
                        value: newValue,
                        reviewID: reviewID,
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
