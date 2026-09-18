<x-app-layout>

    <x-slot name="header">
        <div class="posts-header flex items-center justify-between gap-4">
            <div>
                <h2 class="posts-header-title text-xl font-black text-black">
                    Create Post
                </h2>
                <p class="posts-header-subtitle text-sm font-bold text-slate-600">
                    Share something with the community
                </p>
            </div>
        </div>
    </x-slot>

    <div class="posts-page bg-[#F4F0EA] min-h-screen">

        <div class="posts-container posts-container-narrow max-w-2xl mx-auto px-4 sm:px-6 py-8">

            <div class="form-card bg-white border-2 border-black rounded-xl shadow-[4px_4px_0px_0px_#000000] p-6 sm:p-8">

                <div class="form-card-header mb-6 pb-5 border-b-2 border-black">
                    <h1 class="posts-title text-2xl font-black text-black tracking-tight">Create Post</h1>
                    <p class="form-card-subtitle mt-1 text-sm font-bold text-slate-600">
                        Fill in the details below to publish your post.
                    </p>
                </div>

                @if ($errors->any())
                    <div class="form-errors bg-red-50 border-2 border-black rounded-lg p-3 mb-5 shadow-[2px_2px_0px_0px_#000000]">
                        @foreach ($errors->all() as $error)
                            <p class="m-0 text-sm font-bold text-red-600">{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <form
                    action="{{ route('posts.store') }}"
                    method="POST"
                    enctype="multipart/form-data"
                    class="post-form flex flex-col gap-5"
                >

                    @csrf

                    <div class="form-group flex flex-col gap-2">
                        <label for="title" class="form-label block text-sm font-bold text-black">Title</label>

                        <input
                            id="title"
                            type="text"
                            name="title"
                            value="{{ old('title') }}"
                            class="form-input w-full bg-white border-2 border-black rounded-lg px-3 py-2 text-sm text-black placeholder:text-slate-500 shadow-[2px_2px_0px_0px_#000000] focus:outline-none focus:ring-0 focus:border-black"
                            placeholder="Give your post a title..."
                        >
                    </div>

                    <div class="form-group flex flex-col gap-2">
                        <label for="content" class="form-label block text-sm font-bold text-black">Content</label>

                        <textarea
                            id="content"
                            name="content"
                            class="form-textarea w-full bg-white border-2 border-black rounded-lg px-3 py-2 text-sm text-black placeholder:text-slate-500 shadow-[2px_2px_0px_0px_#000000] focus:outline-none focus:ring-0 min-h-[130px] leading-relaxed resize-y"
                            placeholder="What would you like to share?"
                            rows="6"
                        >{{ old('content') }}</textarea>
                    </div>

                    <div class="form-group flex flex-col gap-2">
                        <label class="form-label block text-sm font-bold text-black">Images / Videos</label>

                        <div class="file-upload relative">
                            <input
                                type="file"
                                name="media[]"
                                multiple
                                accept="image/*,video/*"
                                id="media-upload"
                                class="file-input absolute w-px h-px opacity-0 overflow-hidden"
                                data-preview-target="new-media-preview"
                            >
                            <label for="media-upload" class="file-label flex flex-col items-center justify-center gap-1.5 p-7 border-2 border-dashed border-black rounded-lg bg-[#F4F0EA] cursor-pointer text-sm font-bold text-black hover:bg-white hover:shadow-[2px_2px_0px_0px_#000000] transition text-center">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-black">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="17 8 12 3 7 8"></polyline>
                                    <line x1="12" y1="3" x2="12" y2="15"></line>
                                </svg>
                                <span>Choose files or drag & drop</span>
                                <small class="text-xs font-bold text-slate-600">PNG, JPG, MP4 supported</small>
                            </label>
                        </div>

                        {{-- New Media Preview (populated via JS) --}}
                        <div
                            id="new-media-preview"
                            class="media-preview-grid grid gap-3 mt-3 hidden data-[empty=false]:grid grid-cols-2 sm:grid-cols-3"
                            data-empty="true"
                        ></div>
                    </div>

                    <div class="form-actions flex flex-col-reverse sm:flex-row justify-end gap-3 pt-2">
                        <a href="{{ url('/posts') }}" class="btn-secondary inline-flex items-center justify-center bg-white text-black font-bold border-2 border-black rounded-lg px-4 py-2 text-sm shadow-[2px_2px_0px_0px_#000000] hover:bg-slate-100 hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-[4px_4px_0px_0px_#000000] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all text-center">
                            Cancel
                        </a>
                        <button type="submit" class="btn-primary inline-flex items-center justify-center bg-[#2563EB] text-white font-bold border-2 border-black rounded-lg px-4 py-2 text-sm shadow-[2px_2px_0px_0px_#000000] hover:bg-blue-700 hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-[4px_4px_0px_0px_#000000] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all">
                            Create Post
                        </button>
                    </div>

                </form>

            </div>

        </div>

    </div>

    @vite([
        'resources/css/posts/posts.css',
        'resources/js/posts/posts.js'
    ])

</x-app-layout>
