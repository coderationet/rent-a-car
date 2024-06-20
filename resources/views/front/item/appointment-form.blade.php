<div class="mt-4">
    <div>
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    {{ __('front/appointment-form.title') }}
                </h5>
            </div>
            <div class="card-body">
                <form action="{{route('front.appointment.driver_info_step')}}" method="get" enctype="multipart/form-data"
                      class="flex gap-5 flex-col">
                    <div class="data-range-container rounded border text-black flex gap-5 open-calendar justify-around p-2 items-center">
                        <div class="calendar-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="w-8 h-8">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z"/>
                            </svg>
                        </div>
                        <input type="text" id="date-range" name="daterange" autocomplete="off"
                               class="flex-1 mw-3/4 rounded"
                               required
                               data-item-calendar-url="{{route('front.api.item-calendar.index')}}"
                               value="{{old('daterange') ? old('daterange') : $date_value}}"
                               placeholder="Select A Date Range">
                    </div>
                    <p class="text-sm">
                        Select a date range for your appointment.
                    </p>
                    <input type="hidden" name="item_id" id="item-id" value="{{$item->id}}">
                    @if(session()->has('errors'))
                        <ul class="error_list">
                            @foreach($errors->all() as $error)
                                <li>
                                    {{ $error }}
                                </li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="mt-3">
                        <button type="submit" class="bg-blue-600 text-white text-bold p-2 w-full">
                            {{__('front/appointment-form.book_now')}}
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
<script>
    var available_dates = {!! json_encode($available_dates) !!};
</script>
