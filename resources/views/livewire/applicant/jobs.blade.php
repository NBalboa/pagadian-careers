<div>
    @if ($jobs->count() > 0)

        @foreach ($jobs as $job)
            <div
                class="group mx-2 mt-10 grid max-w-screen-md grid-cols-12 space-x-8 overflow-hidden rounded-lg border py-8 text-gray-700 shadow transition hover:shadow-lg sm:mx-auto">
                <a href="#"
                    class="order-2 col-span-1 mt-4 -ml-14 text-left text-gray-600 hover:text-gray-700 sm:-order-1 sm:ml-4">
                    <div class="group relative h-16 w-16 overflow-hidden rounded-lg">
                        <img src="{{ asset('storage/' . $job->hiring_manager->company->profile) }}" alt=""
                            class="h-full w-full object-cover text-gray-700" />
                    </div>
                </a>
                <div class="col-span-11 flex flex-col pr-8 text-left sm:pl-4">
                    <h3 class="text-sm text-gray-600">{{ $job->hiring_manager->company->name }}</h3>
                    <a href="#" class="mb-3 overflow-hidden pr-7 text-lg font-semibold sm:text-xl">
                        {{ $job->job_title }}
                    </a>
                    <p class="overflow-hidden pr-7 text-sm">
                        {{ $job->description }}
                    </p>

                    <div
                        class="mt-5 flex flex-col space-y-3 text-sm font-medium text-gray-500 sm:flex-row sm:items-center sm:space-y-0 sm:space-x-2">
                        <div class="">Experience:<span
                                class="ml-2 mr-3 rounded-full bg-green-100 px-2 py-0.5 text-green-900">
                                {{ $job->experience }} {{ $job->experience > 1 ? 'Years' : 'Year' }}
                            </span>
                        </div>
                        @if ($job->show_salary === 1 && $job->salary !== null)
                            <div class="">Salary:<span
                                    class="ml-2 mr-3 rounded-full bg-blue-100 px-2 py-0.5 text-blue-900">{{ $job->salary }}</span>
                            </div>
                        @endif
                        <a href="/jobs/{{ $job->id }}"
                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Details
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="flex items-center justify-center my-10">
            {{ $jobs->links() }}
        </div>
    @else
        <div>No Jobs Found</div>
    @endif
</div>
