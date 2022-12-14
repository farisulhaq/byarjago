@extends('layouts.app')

@section('title', ' Dashboard')

@section('content')

  <main class="h-full overflow-y-auto">
    @if (auth()->user()->role_user->role == '1')
      <div class="container mx-auto">
        <div class="grid w-full gap-5 px-10 mx-auto md:grid-cols-12">
          <div class="col-span-8">
            <h2 class="mt-8 mb-1 text-2xl font-semibold text-gray-700">
              Overviews
            </h2>
            <p class="text-sm text-gray-400">
              Monthly Reports
            </p>
          </div>

          <div class="col-span-4 text-right">
            <div @click.away="open = false" class="relative z-10 hidden mt-5 lg:block" x-data="{ open: false }">
              <button
                class="flex flex-row items-center w-full px-4 py-2 mt-2 text-left bg-white rounded-lg dark-mode:bg-transparent dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:focus:bg-gray-600 dark-mode:hover:bg-gray-600 md:w-auto md:inline md:mt-0 md:ml-4">

                @if (auth()->user()->detail_user()->first()->photo != null)
                  <img src="{{ url(Storage::url(auth()->user()->detail_user()->first()->photo)) }}" alt="photo profile"
                    class="inline w-12 h-12 mr-3 rounded-full">
                @else
                  <svg class="inline w-12 h-12 mr-3 rounded-full text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                    <path
                      d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                  </svg>
                @endif

                Halo, {{ Auth::user()->name }}

              </button>
            </div>
          </div>
        </div>
      </div>

      <section class="container px-6 mx-auto mt-5">
        <div class="grid gap-5 md:grid-cols">
          <main class="p-4 lg:col-span-7 md:col-span-12 md:pt-0">
            <div class="">
              <div class="flex flex-col justify-center px-4 py-4 mb-4 bg-white rounded-xl">
                <div>
                  <div>
                    <img src="{{ asset('/assets/images/services-progress-icon.svg') }}" alt="" class="w-8 h-8">
                  </div>
                  <p class="mt-2 text-2xl font-semibold text-left text-gray-800">{{ $progress ?? '' }}</p>
                  <p class="text-sm text-left text-gray-500">
                    Mentoring <br class="hidden lg:block">
                    On Progress
                  </p>
                </div>
              </div>
              <div class="flex flex-col justify-center px-4 py-4 mb-4 bg-white rounded-xl">
                <div>
                  <div>
                    <img src="{{ asset('/assets/images/services-completed-icon.svg') }}" alt="" class="w-8 h-8">
                  </div>
                  <p class="mt-2 text-2xl font-semibold text-left text-gray-800">{{ $completed ?? '' }}</p>
                  <p class="text-sm text-left text-gray-500">
                    Mentoring <br class="hidden lg:block">
                    Completed
                  </p>
                </div>
              </div>
              {{-- <div class="flex flex-col justify-center px-4 py-4 mb-4 bg-white rounded-xl">
                            <div>
                                <div>
                                    <img src="{{ asset('/assets/images/new-freelancer-icon.svg') }}" alt="" class="w-8 h-8">
                                </div>
                                <p class="mt-2 text-2xl font-semibold text-left text-gray-800">{{ $freelancer ?? '' }}</p>
                                <p class="text-sm text-left text-gray-500">
                                    New Freelancer <br class="hidden lg:block">
                                    Work for You
                                </p>
                            </div>
                        </div> --}}
            </div>
            <div class="p-6 mt-8 bg-white rounded-xl">
              <div>
                <h2 class="mb-1 text-xl font-semibold">
                  Latest Orders
                </h2>
                <p class="text-sm text-gray-400">
                  {{ $progress ?? '' }} Total Orders On Progress
                </p>
              </div>
              <table class="w-full mt-4" aria-label="Table">
                <thead>
                  <tr class="text-sm font-normal text-left text-gray-900 border-b border-b-gray-600">
                    <th class="py-4" scope="">Name</th>
                    <th class="py-4" scope="">Class Mentor</th>
                    <th class="py-4" scope="">Deadline</th>
                  </tr>
                </thead>
                <tbody class="bg-white">

                  @forelse ($orders as $key => $item)
                    <tr class="text-gray-700">
                      <td class="w-1/3 px-1 py-5">
                        <div class="flex items-center text-sm">
                          <div class="relative w-10 h-10 mr-3 rounded-full md:block">

                            @if ($item->user_buyer->detail_user->photo != null)
                              <img src="{{ url(Storage::url($item->user_buyer->detail_user->photo)) }}"
                                alt="photo profile" class="object-cover w-full h-full rounded-full">
                            @else
                              <svg class="object-cover w-full h-full rounded text-gray-300" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path
                                  d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                              </svg>
                            @endif

                            <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                          </div>
                          <div>
                            <p class="font-medium text-black">{{ $item->user_buyer->name ?? '' }}</p>
                            @if ($item->order_status_id == '1')
                              <p class="text-sm text-green-500">{{ $item->order_status->name ?? '' }}</p>
                            @elseif ($item->order_status_id == '2')
                              <p class="text-sm text-yellow-500">{{ $item->order_status->name ?? '' }}</p>
                            @elseif ($item->order_status_id == '3')
                              <p class="text-sm text-red-500">{{ $item->order_status->name ?? '' }}</p>
                            @else
                              <p class="text-sm text-black">{{ $item->order_status->name ?? '' }}</p>
                            @endif
                          </div>
                        </div>
                      </td>

                      <td class="w-2/4 px-1 py-5">
                        <div class="flex items-center text-sm">
                          <div class="relative w-10 h-10 mr-3 rounded-full md:block">

                            {{-- validation photo --}}
                            @if (count($item->service->thumbnail_service))
                              @if ($item->service->thumbnail_service[0]->thumbnail != null)
                                <img class="object-cover w-full h-full rounded"
                                  src="{{ url(Storage::url($item->service->thumbnail_service[0]->thumbnail)) }}" alt=""
                                  loading="lazy" />
                              @else
                                <svg class="object-cover w-full h-full rounded text-gray-300" fill="currentColor"
                                  viewBox="0 0 24 24">
                                  <path
                                    d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                              @endif
                            @else
                              <svg class="object-cover w-full h-full rounded text-gray-300" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path
                                  d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                              </svg>
                            @endif

                            <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                          </div>
                          <div>
                            <p class="font-medium text-black">
                              {{ $item->service->title ?? '' }}
                            </p>
                          </div>
                        </div>
                      </td>

                      <td class="px-1 py-5 text-xs text-red-500">
                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg"
                          class="inline mb-1">
                          <path
                            d="M7.0002 12.8332C10.2219 12.8332 12.8335 10.2215 12.8335 6.99984C12.8335 3.77818 10.2219 1.1665 7.0002 1.1665C3.77854 1.1665 1.16687 3.77818 1.16687 6.99984C1.16687 10.2215 3.77854 12.8332 7.0002 12.8332Z"
                            stroke="#F26E6E" stroke-linecap="round" stroke-linejoin="round" />
                          <path d="M7 3.5V7L9.33333 8.16667" stroke="#F26E6E" stroke-linecap="round"
                            stroke-linejoin="round" />
                        </svg>

                        {{ date('d/m/Y', strtotime($item->expired)) ?? '' }}
                      </td>
                    </tr>
                  @empty
                    {{-- empty --}}
                  @endforelse
                </tbody>
              </table>
            </div>
          </main>
        </div>
      </section>
    @else
      <div class="container mx-auto">
        <div class="col-span-4 text-right">
            <div @click.away="open = false" class="relative z-10 hidden mt-5 lg:block" x-data="{ open: false }">
              <button
                class="flex flex-row items-center w-full px-4 py-2 mt-2 text-left bg-white rounded-lg dark-mode:bg-transparent dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:focus:bg-gray-600 dark-mode:hover:bg-gray-600 md:w-auto md:inline md:mt-0 md:ml-4">

                @if (auth()->user()->detail_user()->first()->photo != null)
                  <img src="{{ url(Storage::url(auth()->user()->detail_user()->first()->photo)) }}" alt="photo profile"
                    class="inline w-12 h-12 mr-3 rounded-full">
                @else
                  <svg class="inline w-12 h-12 mr-3 rounded-full text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                    <path
                      d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                  </svg>
                @endif

                Halo, {{ Auth::user()->name }}

              </button>
            </div>
      </div>
    @endif
  </main>

@endsection
