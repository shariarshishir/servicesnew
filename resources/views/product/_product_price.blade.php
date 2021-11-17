@php
    $count= count(json_decode($product->attribute));
    $count = $count-2;
@endphp
@foreach (json_decode($product->attribute) as $k => $v)
    @if($k == 0 && $v[2] == 'Negotiable')
    {{ '(Negotiable)' }}
    @endif
    @if($loop->last && $v[2] != 'Negotiable')
        ${{ $v[2] }} {{-- $ is the value for price unite --}}
    @endif
    @if($loop->last && $v[2] == 'Negotiable')
        @foreach (json_decode($product->attribute) as $k => $v)
                @if($k == $count)
                    ${{ $v[2]  }} {{ '(Negotiable)' }} {{-- $ is the value for price unite --}}
                @endif
        @endforeach
    @endif
@endforeach