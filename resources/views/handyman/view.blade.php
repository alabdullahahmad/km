<x-master-layout>
    <main class="main-area">
        <div class="main-content">
            <div class="container-fluid">
                {{-- @include('partials._provider') --}}
                <div class="card">
                    <div class="card-body p-30">
                        <div class="service-man-list">
                            @foreach($data as $handyman)
                            @php
                                // تحديد حالة المبلغ لكل حرفي
                                $is_ready_to_receive = true ;//$handyman->amount_status == 'ready'; // افتراض أن `amount_status` هي الحقل الذي يحتوي على حالة المبلغ
                            @endphp
                            <div class="service-man-list__item">
                                <div class="service-man-list__item_header">
                                    <h4 class="service-man-name">{{ $handyman->staf->name ?? '-' }}</h4>
                                    <a class="service-man-phone" href="tel:{{ $handyman->staf->phoneNumber }}">{{ $handyman->staf->phoneNumber ?? '-' }}</a>
                                </div>

                                <div class="service-man-list__item_body">
                                    <p class="service-man-amount">{{ __('messages.amount_due') }}: {{ $handyman->amount ?? '-' }}</p>
                                    <p class="service-man-amount">{{ __('messages.branchName') }}: {{ $handyman->branch->name ?? '-' }}</p>
                                    @if ($is_ready_to_receive)
                                        <form action="{{ route('editFundLog') }}" method="POST">
                                            @csrf
                                            @method('post')
                                        <input type="hidden" value="{{ $handyman->id }}" name="fundLogId">
                                        <p style="color: green;">{{ __('messages.ready_to_receive') }}</p>
                                        <button type="submit" class="btn btn-success">{{ __('messages.receive') }}</button>
                                        </form>
                                    @else
                                        <p style="color: red;">{{ __('messages.processing_amount') }}</p>
                                        <button class="btn btn-secondary" disabled>{{ __('messages.receive') }}</button>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    {{ Form::close() }}
    @section('bottom_script')
    @endsection
</x-master-layout>
