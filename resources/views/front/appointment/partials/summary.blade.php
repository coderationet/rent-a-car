<div class="flex flex-col gap-5">
    <h2 class="text-xl font-bold">
        {{ $item->title }}
    </h2>
    <img src="{{ route('front.image.show.mode',['image_id' => $item->thumbnail_id,'size' => 'medium','mode' => 'fill']) }}" alt="{{ $item->title }}" class="w-full">
    <div class="flex">
        <span>Pick Up Date:</span>
        <span class="ml-auto">{{ $start_date }}</span>
    </div>
    <div class="flex">
        <span>Drop Off Date:</span>
        <span class="ml-auto">{{ $end_date }}</span>
    </div>
    <div class="flex">
        <small>
            <a class="font-bold" href="{{route('front.page.show',\App\Models\Page::find(2)->slug)}}">Click</a> to see rental terms and conditions.
        </small>
    </div>
</div>
