@extends('admin')

@section('content')
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Update Profile
        </h2>
    </div>
    <div class="col-span-12 lg:col-span-8 2xl:col-span-9">
        <!-- BEGIN: Display Information -->
        <div class="intro-y box lg:mt-5">
            <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                <h2 class="font-medium text-base mr-auto">
                    Display Information
                </h2>
            </div>
            <div class="p-5">
                <div class="flex flex-col-reverse xl:flex-row flex-col">
                    <form method="POST" class="form-control" action="{{ route('admin.account.update', $account->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="flex-1 mt-6 col xl:mt-0">
                                <div class="grid grid-cols-12 gap-x-5">
                                    <div class="col-span-5 2xl:col-span-5">
                                        <div>
                                            <label for="update-profile-form-1" class="form-label">Name</label>
                                            <input id="update-profile-form-1" type="text" class="form-control"
                                                   placeholder="Kevin" name="name" value="{{ $account->name }}">
                                        </div>
                                        <div class="mt-3">
                                            <label for="update-profile-form-1" class="form-label">E-Mail</label>
                                            <input id="update-profile-form-1" type="email" class="form-control"
                                                   placeholder="username@lumenlux.uz" name="email" value="{{ $account->email }}">
                                        </div>
                                    </div>
                                    <div class="col-span-5 2xl:col-span-5">
                                        <div class="mt-3 2xl:mt-0">
                                            <label for="update-profile-form-1" class="form-label">Lastname</label>
                                            <input id="update-profile-form-1" type="text" class="form-control"
                                                   placeholder="Spacey" name="lastname" value="{{ $account->lastname }}">
                                        </div>
                                        <div class="mt-3">
                                            <label for="update-profile-form-4" class="form-label">Phone Number</label>
                                            <input id="update-profile-form-4" type="text" class="form-control"
                                                   placeholder="+998 (__) ___-__-__" name="phone" value="{{ $account->phone }}">
                                        </div>
                                    </div>
                                    <div class="mx-auto xl:mr-0 col-span-2 xl:ml-6">
                                        <div class="border-2 border-dashed shadow-sm border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                                            <div class="h-40 relative image-fit cursor-pointer zoom-in mx-auto">
                                                <img id="file-image" class="rounded-md" alt="Profile picture" src="{{ asset('storage/' . $account->image) }}">
                                                <div class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-danger right-0 top-0 -mr-2 -mt-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                         stroke-linecap="round" stroke-linejoin="round" icon-name="x"
                                                         data-lucide="x" class="lucide lucide-x w-4 h-4">
                                                        <line x1="18" y1="6" x2="6" y2="18"></line>
                                                        <line x1="6" y1="6" x2="18" y2="18"></line>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="mx-auto cursor-pointer relative mt-5">
                                                <button type="button" class="btn btn-primary w-full">Change Photo</button>
                                                <input id="file-upload" name="image" type="file"
                                                       class="w-full h-full top-0 left-0 absolute opacity-0">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-12">
                                        <div class="mt-3">
                                            <label for="update-profile-form-5" class="form-label">Address</label>
                                            <textarea id="update-profile-form-5" name="address" class="form-control"
                                                      placeholder="Address">{{ $account->address }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary w-20 mt-3">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- END: Display Information -->
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        let profile = document.getElementById("file-image");
        let inputFile = document.getElementById("file-upload");

        inputFile.onchange = function () {
            profile.src = URL.createObjectURL(inputFile.files[0]);
        }
    </script>
@endsection