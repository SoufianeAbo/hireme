<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Your CV information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Here's the information for your entire CV.") }}
        </p>
    </header>
    
    
    <div class="mt-6 space-y-6">
        <div>
            <p>Compétences</p>
            <ul class = "mt-1 text-sm text-gray-600">
                @foreach($user->competence as $competence)
                <div class = "flex flex-row items-center gap-4">
                    <li>{{ $competence->name }}</li>
                    <form action="{{ route('delete.competence') }}" method = "POST">
                        @csrf
                        <input class="hidden" type="text" name = "id" value = "{{ $competence->id }}">
                        <button type = "submit" class = "bg-red-500 p-2 rounded text-white"><i class="fa-solid fa-trash"></i></button>
                    </form>
                </div>
                @endforeach
            </ul>
        </div>

        <div>
            <p>Professional experiences</p>
            <ul class = "mt-1 text-sm text-gray-600">
                @foreach($user->experience as $experience)
                    <li>{{ $experience->name }}</li>
                    <form action="{{ route('delete.experience') }}" method = "POST">
                        @csrf
                        <input class="hidden" type="text" name = "id" value = "{{ $experience->id }}">
                        <button type = "submit" class = "bg-red-500 p-2 rounded text-white"><i class="fa-solid fa-trash"></i></button>
                    </form>
                @endforeach
            </ul>
        </div>

        <div>
            <p>Education</p>
            <ul class = "mt-1 text-sm text-gray-600">
                @foreach($user->education as $education)
                    <li>{{ $education->name }}</li>
                    <form action="{{ route('delete.education') }}" method = "POST">
                        @csrf
                        <input class="hidden" type="text" name = "id" value = "{{ $education->id }}">
                        <button type = "submit" class = "bg-red-500 p-2 rounded text-white"><i class="fa-solid fa-trash"></i></button>
                    </form>
                @endforeach
            </ul>
        </div>

        <div>
            <p>Languages</p>
            <ul class = "mt-1 text-sm text-gray-600">
                @foreach($user->language as $language)
                    <li>{{ $language->name }}</li>
                    <form action="{{ route('delete.language') }}" method = "POST">
                        @csrf
                        <input class="hidden" type="text" name = "id" value = "{{ $language->id }}">
                        <button type = "submit" class = "bg-red-500 p-2 rounded text-white"><i class="fa-solid fa-trash"></i></button>
                    </form>
                @endforeach
            </ul>
        </div>
    </div>

</section>
