<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Create your CV') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Create your CV for your profile.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.add') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="competence" :value="__('Compétences')" />
            <x-text-input id="competence" name="competence" type="text" class="mt-1 block w-full" autofocus autocomplete="competence" />
            <x-input-error class="mt-2" :messages="$errors->get('competence')" />
        </div>

        <div>
            <x-input-label for="experience" :value="__('Professional experiences')" />
            <x-text-input id="experience" name="experience" type="text" class="mt-1 block w-full" autofocus autocomplete="experience" />
            <x-input-error class="mt-2" :messages="$errors->get('experience')" />
        </div>

        <div>
            <x-input-label for="education" :value="__('Education')" />
            <x-text-input id="education" name="education" type="text" class="mt-1 block w-full" autofocus autocomplete="education" />
            <x-input-error class="mt-2" :messages="$errors->get('education')" />
        </div>

        <div>
            <x-input-label for="langue" :value="__('Languages')" />
            <x-text-input id="langue" name="langue" type="text" class="mt-1 block w-full" autofocus autocomplete="language" />
            <x-input-error class="mt-2" :messages="$errors->get('langue')" />
        </div>

        <div class="flex flex-row items-center gap-4">
            <x-primary-button>{{ __('Add') }}</x-primary-button>

            <a href="{{ route('download-pdf') }}" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                {{ __('Download PDF') }}
            </a>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
