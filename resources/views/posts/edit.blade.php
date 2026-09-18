<x-app-layout>

    <x-slot name="header">
        <div class="posts-header flex items-center justify-between gap-4">
            <div>
                <h2 class="posts-header-title text-xl font-black text-black">
                    Edit Post
                </h2>
                <p class="posts-header-subtitle text-sm font-bold text-slate-600">
                    Update your post details
                </p>
            </div>
        </div>
    </x-slot>

    <div class="posts-page bg-[#F4F0EA] min-h-screen">

        <div class="posts-container posts-container-narrow max-w-2xl mx-auto px-4 sm:px-6 py-8">

            <div class="form-card bg-white border-2 border-black rounded-xl shadow-[4px_4px_0px_0px_#000000] p-6 sm:p-8 mb-6">

                <div class="form-card-header mb-6 pb-5 border-b-2 border-black">
                    <h1 class="posts-title text-2xl font-black text-black tracking-tight">Edit Post</h1>
                    <p class="form-card-subtitle mt-1 text-sm font-bold text-slate-600">
                        Update the title, content, or media of your post.
                    </p>
                </div>

                @if ($errors->any())
                    <div class="form-errors bg-red-50 border-2 border-black rounded-lg p-3 mb-5 shadow-[2px_2px_0px_0px_#000000]">
                        @foreach ($errors->all() as $error)
                            <p class="m-0 text-sm font-bold text-red-600">{{ $error }}</p>
                        @endforeach
                    </div>
                @endif


                {{-- ========================= --}}
                {{-- Update Post Form --}}
                {{-- ========================= --}}

                <form
                    action="{{ route('posts.update', $post) }}"
                    method="POST"
                    enctype="multipart/form-data"
                    class="post-form flex flex-col gap-5"
                >

                    @csrf
                    @method('PUT')


                    {{-- Title --}}
                    <div class="form-group flex flex-col gap-2">
                        <label for="title" class="form-label block text-sm font-bold text-black">Title</label>

                        <input
                            id="title"
                            type="text"
                            name="title"
                            value="{{ old('title', $post->title) }}"
                            class="form-input w-full bg-white border-2 border-black rounded-lg px-3 py-2 text-sm text-black placeholder:text-slate-500 shadow-[2px_2px_0px_0px_#000000] focus:outline-none focus:ring-0 focus:border-black"
                        >
                    </div>


                    {{-- Content --}}
                    <div class="form-group flex flex-col gap-2">
                        <label for="content" class="form-label block text-sm font-bold text-black">Content</label>

                        <textarea
                            id="content"
                            name="content"
                            class="form-textarea w-full bg-white border-2 border-black rounded-lg px-3 py-2 text-sm text-black placeholder:text-slate-500 shadow-[2px_2px_0px_0px_#000000] focus:outline-none focus:ring-0 min-h-[130px] leading-relaxed resize-y"
                            rows="6"
                        >{{ old('content', $post->content) }}</textarea>
                    </div>


                    {{-- Add New Media --}}
                    <div class="form-group flex flex-col gap-2">

                        <label class="form-label block text-sm font-bold text-black">Add New Images / Videos</label>

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


                    {{-- Update --}}
                    <div class="form-actions flex flex-col-reverse sm:flex-row justify-end gap-3 pt-2">
                        <a href="{{ url('/posts') }}" class="btn-secondary inline-flex items-center justify-center bg-white text-black font-bold border-2 border-black rounded-lg px-4 py-2 text-sm shadow-[2px_2px_0px_0px_#000000] hover:bg-slate-100 hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-[4px_4px_0px_0px_#000000] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all text-center">
                            Cancel
                        </a>
                        <button type="submit" class="btn-primary inline-flex items-center justify-center bg-[#2563EB] text-white font-bold border-2 border-black rounded-lg px-4 py-2 text-sm shadow-[2px_2px_0px_0px_#000000] hover:bg-blue-700 hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-[4px_4px_0px_0px_#000000] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all">
                            Update Post
                        </button>
                    </div>

                </form>

            </div>


            {{-- ========================= --}}
            {{-- Current Media --}}
            {{-- ========================= --}}

            <div class="form-card bg-white border-2 border-black rounded-xl shadow-[4px_4px_0px_0px_#000000] p-6 sm:p-8">

                <div class="form-card-header mb-6 pb-5 border-b-2 border-black">
                    <h3 class="form-section-title text-lg font-black text-black">Current Media</h3>
                    <p class="form-card-subtitle mt-1 text-sm font-bold text-slate-600">
                        Manage media attached to this post.
                    </p>
                </div>

                @if ($post->media->count())

                    <div class="media-grid grid grid-cols-2 sm:grid-cols-3 gap-3">

                        @foreach ($post->media as $media)

                            <div class="post-media-item relative rounded-xl overflow-hidden border-2 border-black bg-[#F4F0EA] aspect-square shadow-[2px_2px_0px_0px_#000000]">

                                {{-- Image --}}
                                @if ($media->media_type === 'image')

                                    <img
                                        src="{{ asset('storage/' . $media->media_path) }}"
                                        alt="Post Image"
                                        class="media-preview w-full h-full object-cover block"
                                    >

                                {{-- Video --}}
                                @elseif ($media->media_type === 'video')

                                    <video
                                        controls
                                        class="media-preview w-full h-full object-cover block bg-black"
                                        preload="metadata"
                                    >

                                        <source
                                            src="{{ asset('storage/' . $media->media_path) }}"
                                            type="video/mp4"
                                        >

                                        Your browser does not support the video tag.

                                    </video>

                                @endif


                                {{-- Delete Media --}}
                                <form
                                    action="{{ route('post-media.destroy', $media) }}"
                                    method="POST"
                                    class="media-delete-form absolute top-2 right-2 m-0"
                                >

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="media-delete-button w-7 h-7 rounded-full border-2 border-black bg-white text-black flex items-center justify-center shadow-[1px_1px_0px_0px_#000000] hover:bg-red-500 hover:text-white transition-colors"
                                        title="Delete media"
                                    >
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <line x1="18" y1="6" x2="6" y2="18"></line>
                                            <line x1="6" y1="6" x2="18" y2="18"></line>
                                        </svg>
                                    </button>

                                </form>

                            </div>

                        @endforeach

                    </div>

                @else

                    <p class="media-empty text-sm font-bold text-slate-600 text-center py-6 border-2 border-dashed border-black rounded-lg bg-[#F4F0EA]">No media attached to this post.</p>

                @endif

            </div>


            {{-- Back --}}
            <div class="back-link-wrapper text-center mt-4">
                <a href="{{ url('/posts') }}" class="back-link inline-flex items-center gap-1.5 bg-white text-black font-bold border-2 border-black rounded-lg px-4 py-2 text-sm shadow-[2px_2px_0px_0px_#000000] hover:bg-slate-100 hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-[4px_4px_0px_0px_#000000] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="19" y1="12" x2="5" y2="12"></line>
                        <polyline points="12 19 5 12 12 5"></polyline>
                    </svg>
                    Back to Posts
                </a>
            </div>

        </div>

    </div>


    {{-- Posts CSS & JS --}}
    @vite([
        'resources/css/posts/posts.css',
        'resources/js/posts/posts.js'
    ])

</x-app-layout>
