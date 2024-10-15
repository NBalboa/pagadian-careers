<div>
    <section class="bg-gray-50 ">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">

            <div class="w-full bg-white rounded-lg shadow  md:mt-0 sm:max-w-md xl:p-0  ">

                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                        Forgot Password
                        <span wire:loading wire:target="verifyOTP">
                            <x-loading />
                        </span>
                        <span wire:loading wire:target="resendOTP">
                            <x-loading />
                        </span>
                    </h1>
                    <form class="space-y-4 md:space-y-6" wire:submit.prevent="verifyOTP" wire:loading.class="opacity-50"
                        wire:loading.attr="disabled">
                        <div>
                            <p class="block mb-2 text-sm font-medium text-gray-900">
                                {{ $email }}
                            </p>
                            <label for="otp" class="block mb-2 text-sm font-medium text-gray-900">OTP</label>

                            <input type="text" name="otp" id="otp"
                                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                placeholder="" wire:model="otp">
                            @error('otp')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" wire:click="verifyOTP"
                            class="w-full text-white bg-blue-700 bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Submit</button>
                    </form>

                    <div wire:poll.1000ms="calculateTimeRemaining">

                        @if (abs(floor($time_remaining)) > 0)
                            <p>Resend OTP: {{ abs(floor($time_remaining)) }}</p>
                        @else
                            <button type="submit" wire:click="resendOTP"
                                class="w-full text-white bg-green-700 bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Resend
                                OTP</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
