<section>
    <header>
        <h2 class="text-lg font-black text-black">
            {{ __('Profile Image') }}
        </h2>
        <p class="mt-1 text-sm font-bold text-slate-600">
            {{ __('Update your profile avatar. Upload a new image to personalize your account.') }}
        </p>
    </header>

    <form method="POST" action="{{ route('profile.image.update') }}" enctype="multipart/form-data" class="mt-6 space-y-4">
        @csrf
        <div>
            <label class="block text-sm font-bold text-black mb-2">Update Profile Image</label>
            <input type="file" name="image" accept="image/*" required class="block w-full bg-white border-2 border-black rounded-lg px-3 py-2 text-sm text-black file:mr-3 file:py-1.5 file:px-3 file:rounded-md file:border-2 file:border-black file:bg-blue-200 file:text-black file:font-bold file:text-xs file:shadow-[1px_1px_0px_0px_#000000] hover:file:bg-blue-300 cursor-pointer shadow-[2px_2px_0px_0px_#000000] focus:outline-none focus:ring-0">
            <x-input-error :messages="$errors->get('image')" class="mt-2" />
        </div>
        <button type="submit" class="w-full inline-flex items-center justify-center bg-[#2563EB] text-white font-bold border-2 border-black rounded-lg px-4 py-2 text-sm shadow-[2px_2px_0px_0px_#000000] hover:bg-blue-700 hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-[4px_4px_0px_0px_#000000] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all">
            Upload Image
        </button>
    </form>
</section>
