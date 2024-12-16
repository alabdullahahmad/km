@if(isset($query->id))
    @if($query->user_type === 'user')
       
            <div class="d-flex gap-3 align-items-center">
                <img src="{{ getSingleMedia($query, 'profile_image', null) }}" alt="avatar" class="avatar avatar-40 rounded-pill">
                <div class="text-start">
                    <h6 class="m-0">{{ $query->first_name }} {{ $query->last_name }}</h6>
                    
                </div>
            </div>
        
    @elseif($query->user_type === 'provider')
        
            <div class="d-flex gap-3 align-items-center">
                <img src="{{ getSingleMedia($query, 'profile_image', null) }}" alt="avatar" class="avatar avatar-40 rounded-pill">
                <div class="text-start">
                    <h6 class="m-0">{{ $query->first_name }} {{ $query->last_name }}</h6>
                    
                </div>
            </div>
       
    @elseif($query->user_type === 'handyman')
       
            <div class="d-flex gap-3 align-items-center">
                <img src="{{ getSingleMedia($query, 'profile_image', null) }}" alt="avatar" class="avatar avatar-40 rounded-pill">
                <div class="text-start">
                    <h6 class="m-0">{{ $query->display_name }}</h6>
                    
                </div>
            </div>
      
    @else
        <div class="align-items-center">
            <h6 class="text-center">-</h6>
        </div>
    @endif
@else
  <div class="align-items-center">
    <h6 class="text-center">-</h6>
  </div>
@endif


