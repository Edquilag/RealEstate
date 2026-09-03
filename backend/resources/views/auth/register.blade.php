<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div>
            <x-input-label for="role" :value="__('Account Type')" />
            <select id="role" name="role" class="block mt-1 w-full border-gray-300 focus:border-black focus:ring-black rounded-md shadow-sm" required>
                <option value="client" {{ old('role') !== 'broker' ? 'selected' : '' }}>Client</option>
                <option value="broker" {{ old('role') === 'broker' ? 'selected' : '' }}>Broker</option>
            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div id="broker-fields" class="mt-6 space-y-4 {{ old('role') === 'broker' ? '' : 'hidden' }}">
            <div>
                <x-input-label for="company_name" :value="__('Company Name')" />
                <x-text-input id="company_name" class="block mt-1 w-full" type="text" name="company_name" :value="old('company_name')" />
                <x-input-error :messages="$errors->get('company_name')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="office_address" :value="__('Office Address')" />
                <x-text-input id="office_address" class="block mt-1 w-full" type="text" name="office_address" :value="old('office_address')" />
                <x-input-error :messages="$errors->get('office_address')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="prc_license_number" :value="__('PRC License Number')" />
                <x-text-input id="prc_license_number" class="block mt-1 w-full" type="text" name="prc_license_number" :value="old('prc_license_number')" />
                <x-input-error :messages="$errors->get('prc_license_number')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="prc_license_expiry" :value="__('PRC License Expiry')" />
                <x-text-input id="prc_license_expiry" class="block mt-1 w-full" type="date" name="prc_license_expiry" :value="old('prc_license_expiry')" />
                <x-input-error :messages="$errors->get('prc_license_expiry')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="tin" :value="__('TIN')" />
                <x-text-input id="tin" class="block mt-1 w-full" type="text" name="tin" :value="old('tin')" />
                <x-input-error :messages="$errors->get('tin')" class="mt-2" />
            </div>
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>

    <script>
        const roleSelect = document.getElementById('role');
        const brokerFields = document.getElementById('broker-fields');

        function toggleBrokerFields() {
            brokerFields.classList.toggle('hidden', roleSelect.value !== 'broker');
        }

        roleSelect.addEventListener('change', toggleBrokerFields);
    </script>
</x-guest-layout>
