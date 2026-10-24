{{-- <section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')


        Just show the avater Image with live preview
        <div>
            <img id="avatarPreview" src="{{ public_path('images/'.$user->avatar) }}" alt="Avatar preview">
            <x-input-label for="avatar" :value="__('Avatar')" />
            <x-text-input id="avatar" name="avatar" type="file" class="mt-1 block w-full" :value="old('avatar', $user->avatar)" required autofocus autocomplete="avatar" />
            <x-input-error class="mt-2" :messages="$errors->get('avatar')" />
        </div>

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

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
</section> --}}

<section>
    <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5">
        {{-- Header --}}
        <div class="d-flex flex-wrap justify-content-between align-items-start gap-3">
            <div>
                <h2 class="h4 fw-semibold text-dark mb-1">
                    <i class="fas fa-user-circle me-2" style="color:#4f46e5;"></i>{{ __('Profile Information') }}
                </h2>
                <p class="text-muted small mb-0">
                    {{ __("Update your account's profile information and email address.") }}
                </p>
            </div>

            @if (session('status') === 'profile-updated')
                <span class="badge bg-success-subtle text-success-emphasis border border-success-subtle rounded-pill px-3 py-2"
                      x-data="{ show: true }"
                      x-show="show"
                      x-transition
                      x-init="setTimeout(() => show = false, 2000)">
                    <i class="fas fa-check-circle me-1"></i>{{ __('Saved.') }}
                </span>
            @endif
        </div>

        <hr class="my-4">

        {{-- Hidden form for resending verification email --}}
        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
            @csrf
        </form>

        {{-- Main update form --}}
        <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('patch')

            {{-- ===== AVATAR with LIVE PREVIEW ===== --}}
            <div class="row align-items-center g-4 mb-4">
                <div class="col-auto">
                    <img id="avatarPreview"
                         src="{{ $user->avatar ? asset('images/'.$user->avatar) : 'https://ui-avatars.com/api/?background=4f46e5&color=fff&size=120&name='.urlencode($user->name) }}"
                         alt="{{ __('Avatar preview') }}"
                         class="rounded-circle border border-3 border-white shadow"
                         style="width:120px;height:120px;object-fit:cover;background:#e9ecef;"
                         onerror="this.onerror=null;this.src='https://ui-avatars.com/api/?background=4f46e5&color=fff&size=120&name={{ urlencode($user->name) }}';">
                </div>
                <div class="col">
                    <label for="avatar" class="form-label text-uppercase small fw-semibold text-secondary">
                        <i class="far fa-image me-1"></i>{{ __('Avatar') }}
                    </label>
                    <input id="avatar"
                           name="avatar"
                           type="file"
                           accept="image/*"
                           class="form-control @error('avatar') is-invalid @enderror"
                           onchange="previewAvatar(this)">
                    @error('avatar')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-text small">{{ __('Choose a new avatar. Preview updates instantly.') }}</div>
                </div>
            </div>

            {{-- ===== NAME ===== --}}
            <div class="mb-3">
                <label for="name" class="form-label text-uppercase small fw-semibold text-secondary">
                    <i class="far fa-user me-1"></i>{{ __('Name') }}
                </label>
                <input id="name"
                       name="name"
                       type="text"
                       class="form-control @error('name') is-invalid @enderror"
                       value="{{ old('name', $user->name) }}"
                       required autofocus autocomplete="name">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- ===== EMAIL ===== --}}
            <div class="mb-3">
                <label for="email" class="form-label text-uppercase small fw-semibold text-secondary">
                    <i class="far fa-envelope me-1"></i>{{ __('Email') }}
                </label>
                <input id="email"
                       name="email"
                       type="email"
                       class="form-control @error('email') is-invalid @enderror"
                       value="{{ old('email', $user->email) }}"
                       required autocomplete="username">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div class="alert alert-warning d-flex flex-wrap align-items-center gap-2 mt-3 py-2 px-3 rounded-3 small mb-0">
                        <i class="fas fa-exclamation-triangle"></i>
                        <span>{{ __('Your email address is unverified.') }}</span>
                        <button form="send-verification"
                                class="btn btn-link btn-sm p-0 align-baseline text-decoration-underline"
                                style="color:#4f46e5;">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </div>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 small text-success mb-0">
                            <i class="fas fa-check-circle me-1"></i>
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                @endif
            </div>

            <hr class="my-4">

            {{-- ===== ACTIONS ===== --}}
            <div class="d-flex flex-wrap align-items-center gap-3">
                <button type="submit" class="btn btn-primary rounded-pill px-4">
                    <i class="fas fa-save me-2"></i>{{ __('Save') }}
                </button>

                @if (session('status') === 'profile-updated')
                    <span class="text-muted small"
                          x-data="{ show: true }"
                          x-show="show"
                          x-transition
                          x-init="setTimeout(() => show = false, 2000)">
                        <i class="fas fa-check-circle text-success me-1"></i>{{ __('Saved.') }}
                    </span>
                @endif
            </div>
        </form>
    </div>
</section>

{{-- Live avatar preview script --}}
<script>
    function previewAvatar(input) {
        const preview = document.getElementById('avatarPreview');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
