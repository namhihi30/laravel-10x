<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('My Avatar') }}
        </h2>
        <img src="{{ "/storage/$user->avatar" }}" alt="">

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Add or update avatar user") }}
        </p>
    </header>

    @if (session('message'))
        <div style="color: red" class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <form method="post" action="{{route('profile.avatar')}}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="avatar" :value="__('Avatar')"/>
            <x-text-input id="avatar" name="avatar" type="file" class="mt-1 block w-full"
                          :value="old('avatar', $user->avatar)"  autofocus autocomplete="name"/>
            <x-input-error class="mt-2" :messages="$errors->get('avatar')"/>
        </div>


        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
        </div>
    </form>
</section>
